<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('payment_webhook_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('payment_gateway');
            $table->string('request_url');
            $table->string('request_ip');
            $table->json('request_headers')->nullable();
            $table->json('request_body')->nullable();
            $table->text('request_exception')->nullable();
            $table->string('request_hash')->unique();
            $table->timestamps();
        });
    }
};
