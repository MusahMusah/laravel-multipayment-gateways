<?php

namespace MusahMusah\LaravelMultipaymentGateways\Services;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use MusahMusah\LaravelMultipaymentGateways\Events\PaymentWebhookReceivedEvent;
use MusahMusah\LaravelMultipaymentGateways\Exceptions\InvalidPaymentWebhookConfig;
use MusahMusah\LaravelMultipaymentGateways\Exceptions\InvalidPaymentWebhookHandler;
use MusahMusah\LaravelMultipaymentGateways\Exceptions\InvalidPaymentWebhookSignature;
use MusahMusah\LaravelMultipaymentGateways\Models\PaymentWebhookLog;

class PaymentWebhookHandler
{
    protected $request;

    protected PaymentWebhookConfig $webhookConfig;

    protected $webhookPayload;

    protected $webhookHash;

    protected $databaseTable;

    const WEBHOOK_HANDLER_JOB = 'job';

    const WEBHOOK_HANDLER_EVENT = 'event';

    const WEBHOOK_RESPONSE_MESSAGE = 'successful';

    const WEBHOOK_RESPONSE_STATUS = 200;

    public function __construct(
         Request $request,
         PaymentWebhookConfig $webhookConfig
    ) {
        $this->request = $request;
        $this->webhookConfig = $webhookConfig;
        $this->databaseTable = 'payment_webhook_logs';
    }

    /**
     * Handle the webhook request
     *
     *
     * @throws InvalidPaymentWebhookConfig|InvalidPaymentWebhookHandler|InvalidPaymentWebhookSignature
     */
    public function handle(): JsonResponse
    {
        $this->setWebhookPayload();

        if (Schema::hasTable($this->databaseTable)) {
            $this->createWebhookHash();

            // check if the webhook hash has already been processed
            if ($this->hasWebhookBeenProcessed($this->webhookHash)) {
                return $this->handleDuplicateWebhook();
            }

            $webhookLog = $this->storeWebhook();
        } else {
            $webhookLog = null;
        }

        $this->validateSignature();

        $this->processPaymentWebhook($webhookLog);

        return $this->handleWebhookResponse('Webhook has been processed');
    }

    /**
     * Set the webhook payload from the request input
     */
    public function setWebhookPayload(): void
    {
        $this->webhookPayload = $this->request->input();
    }

    /**
     * Validate the signature of the webhook
     *
     *
     * @throws InvalidPaymentWebhookSignature
     */
    protected function validateSignature(): self
    {
        if (! $this->webhookConfig->signatureValidator->isValid($this->request, $this->webhookConfig)) {
            // webhook signature is not valid
            throw InvalidPaymentWebhookSignature::invalidSignature($this->webhookConfig->name);
        }

        return $this;
    }

    /**
     * Create a hash of the webhook payload
     */
    protected function createWebhookHash(): void
    {
        $this->webhookHash = hash('sha256', json_encode($this->webhookPayload));
    }

    /**
     * Check if the webhook hash has already been processed
     */
    protected function hasWebhookBeenProcessed(string $hash): bool
    {
        return $this->webhookConfig->paymentWebhookModel::where('request_hash', $hash)->exists();
    }

    /**
     * Handle the case when the webhook hash has already been processed
     */
    protected function handleDuplicateWebhook(): JsonResponse
    {
        // webhook has already been processed, return a response
        return $this->handleWebhookResponse('Webhook has already been processed');
    }

    /**
     * Handle the webhook response by returning a JSON response
     *
     * @param  string  $webhookResponse The message to be returned in the response
     */
    protected function handleWebhookResponse(string $webhookResponse = self::WEBHOOK_RESPONSE_MESSAGE): JsonResponse
    {
        return response()->json(['message' => $webhookResponse], self::WEBHOOK_RESPONSE_STATUS);
    }

    /**
     * Store the webhook in the database
     */
    protected function storeWebhook(): PaymentWebhookLog
    {
        return $this->webhookConfig->paymentWebhookModel::storePaymentWebhook($this->webhookConfig, $this->request, $this->webhookHash);
    }

    /**
     * Processes the payment webhook
     *
     *
     * @throws InvalidPaymentWebhookConfig|InvalidPaymentWebhookHandler
     */
    protected function processPaymentWebhook(PaymentWebhookLog $webhookLog = null): void
    {
        try {
            $paymentWebhookHandler = $this->webhookConfig->paymentWebhookHandler ?? self::WEBHOOK_HANDLER_JOB;
            $this->handlePaymentWebhook($paymentWebhookHandler);
        } catch (Exception $exception) {
            $webhookLog?->savePaymentWebhookException($exception);
            throw $exception;
        }
    }

    /**
     * Dispatch the job or event based on the paymentWebhookHandler
     *
     *
     * @throws InvalidPaymentWebhookConfig|InvalidPaymentWebhookHandler
     */
    protected function handlePaymentWebhook(string $paymentWebhookHandler): void
    {
        switch ($paymentWebhookHandler) {
            case self::WEBHOOK_HANDLER_JOB:
                $webhookJob = $this->createWebhookJob();
                dispatch($webhookJob);
                break;
            case self::WEBHOOK_HANDLER_EVENT:
                $webhookEvent = $this->createWebhookEvent();
                event($webhookEvent);
                break;
            default:
                throw InvalidPaymentWebhookHandler::invalidHandler($this->webhookConfig->name);
        }
    }

    /**
     * Create the webhook job
     *
     *  @throws InvalidPaymentWebhookConfig
     */
    protected function createWebhookJob()
    {
        if (empty($this->webhookConfig->paymentWebhookJobClass)) {
            // job class is missing
            throw InvalidPaymentWebhookConfig::missingJobClass($this->webhookConfig->name);
        }

        return new $this->webhookConfig->paymentWebhookJobClass($this->webhookPayload);
    }

    /**
     * Create the webhook event
     */
    protected function createWebhookEvent()
    {
        if (empty($this->webhookConfig->paymentWebhookEventClass)) {
            return new PaymentWebhookReceivedEvent($this->webhookPayload);
        }

        return new $this->webhookConfig->paymentWebhookEventClass($this->webhookPayload);
    }
}
