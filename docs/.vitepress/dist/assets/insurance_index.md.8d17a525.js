import{_ as s,c as a,o as n,a as l}from"./app.49ea0346.js";const C=JSON.parse('{"title":"Insurance API","description":"","frontmatter":{},"headers":[{"level":2,"title":"Get Insurance List","slug":"get-insurance-list","link":"#get-insurance-list","children":[]},{"level":2,"title":"Get Insurance","slug":"get-insurance","link":"#get-insurance","children":[]},{"level":2,"title":"Get Premium Insurance","slug":"get-premium-insurance","link":"#get-premium-insurance","children":[]},{"level":2,"title":"Purchase Insurace","slug":"purchase-insurace","link":"#purchase-insurace","children":[]}],"relativePath":"insurance/index.md"}'),p={name:"insurance/index.md"},e=l(`<h1 id="insurance-api" tabindex="-1">Insurance API <a class="header-anchor" href="#insurance-api" aria-hidden="true">#</a></h1><h2 id="get-insurance-list" tabindex="-1">Get Insurance List <a class="header-anchor" href="#get-insurance-list" aria-hidden="true">#</a></h2><p>This method allows you to retrieve a list of insurance premiums available for a user.</p><div class="language-php"><button title="Copy Code" class="copy"></button><span class="lang">php</span><pre class="shiki"><code><span class="line"><span style="color:#89DDFF;">$</span><span style="color:#A6ACCD;">payload </span><span style="color:#89DDFF;">=</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">[</span></span>
<span class="line"><span style="color:#A6ACCD;">    </span><span style="color:#89DDFF;">&quot;</span><span style="color:#C3E88D;">perPage</span><span style="color:#89DDFF;">&quot;</span><span style="color:#89DDFF;">:</span><span style="color:#A6ACCD;"> </span><span style="color:#F78C6C;">50</span><span style="color:#89DDFF;">,</span></span>
<span class="line"><span style="color:#A6ACCD;">    </span><span style="color:#89DDFF;">&quot;</span><span style="color:#C3E88D;">page</span><span style="color:#89DDFF;">&quot;</span><span style="color:#89DDFF;">:</span><span style="color:#A6ACCD;"> </span><span style="color:#F78C6C;">3</span></span>
<span class="line"><span style="color:#89DDFF;">];</span></span>
<span class="line"></span>
<span class="line"><span style="color:#676E95;">// The $payload parameter is optional.</span></span>
<span class="line"><span style="color:#89DDFF;">$</span><span style="color:#A6ACCD;">insuranceList </span><span style="color:#89DDFF;">=</span><span style="color:#A6ACCD;"> </span><span style="color:#FFCB6B;">TerminalAfrica</span><span style="color:#89DDFF;">::</span><span style="color:#82AAFF;">getInsuranceList</span><span style="color:#89DDFF;">($</span><span style="color:#A6ACCD;">payload</span><span style="color:#89DDFF;">);</span></span>
<span class="line"></span></code></pre></div><h2 id="get-insurance" tabindex="-1">Get Insurance <a class="header-anchor" href="#get-insurance" aria-hidden="true">#</a></h2><p>This method allows you to retrieve details of a specific insurance purchase.</p><div class="language-php"><button title="Copy Code" class="copy"></button><span class="lang">php</span><pre class="shiki"><code><span class="line"><span style="color:#89DDFF;">$</span><span style="color:#A6ACCD;">insuranceId </span><span style="color:#89DDFF;">=</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">&#39;</span><span style="color:#C3E88D;">xxxxxxxxx</span><span style="color:#89DDFF;">&#39;</span><span style="color:#89DDFF;">;</span></span>
<span class="line"><span style="color:#89DDFF;">$</span><span style="color:#A6ACCD;">insurance </span><span style="color:#89DDFF;">=</span><span style="color:#A6ACCD;"> </span><span style="color:#FFCB6B;">TerminalAfrica</span><span style="color:#89DDFF;">::</span><span style="color:#82AAFF;">getInsurance</span><span style="color:#89DDFF;">($</span><span style="color:#A6ACCD;">insuranceId</span><span style="color:#89DDFF;">);</span></span>
<span class="line"></span></code></pre></div><h2 id="get-premium-insurance" tabindex="-1">Get Premium Insurance <a class="header-anchor" href="#get-premium-insurance" aria-hidden="true">#</a></h2><p>This method allows you to retrieve premium charge for insurance coverage.</p><div class="language-php"><button title="Copy Code" class="copy"></button><span class="lang">php</span><pre class="shiki"><code><span class="line"><span style="color:#89DDFF;">$</span><span style="color:#A6ACCD;">premiumInsurance </span><span style="color:#89DDFF;">=</span><span style="color:#A6ACCD;"> </span><span style="color:#FFCB6B;">TerminalAfrica</span><span style="color:#89DDFF;">::</span><span style="color:#82AAFF;">getPremiumInsurance</span><span style="color:#89DDFF;">();</span></span>
<span class="line"></span></code></pre></div><h2 id="purchase-insurace" tabindex="-1">Purchase Insurace <a class="header-anchor" href="#purchase-insurace" aria-hidden="true">#</a></h2><p>This method allows you to purchase insurance coverage for a shipment.</p><div class="language-php"><button title="Copy Code" class="copy"></button><span class="lang">php</span><pre class="shiki"><code><span class="line"><span style="color:#89DDFF;">$</span><span style="color:#A6ACCD;">insurancePayload </span><span style="color:#89DDFF;">=</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">[</span></span>
<span class="line"><span style="color:#A6ACCD;">          </span><span style="color:#89DDFF;">&#39;</span><span style="color:#C3E88D;">description</span><span style="color:#89DDFF;">&#39;</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">=&gt;</span><span style="color:#A6ACCD;">  </span><span style="color:#89DDFF;">&quot;</span><span style="color:#C3E88D;">My laptop was damaged during shipment</span><span style="color:#89DDFF;">&quot;</span><span style="color:#89DDFF;">,</span></span>
<span class="line"><span style="color:#A6ACCD;">            </span><span style="color:#89DDFF;">&#39;</span><span style="color:#C3E88D;">reason</span><span style="color:#89DDFF;">&#39;</span><span style="color:#A6ACCD;">  </span><span style="color:#89DDFF;">=&gt;</span><span style="color:#A6ACCD;">  </span><span style="color:#89DDFF;">&quot;</span><span style="color:#C3E88D;">damage</span><span style="color:#89DDFF;">&quot;</span><span style="color:#89DDFF;">,</span></span>
<span class="line"><span style="color:#A6ACCD;">            </span><span style="color:#89DDFF;">&#39;</span><span style="color:#C3E88D;">signature</span><span style="color:#89DDFF;">&#39;</span><span style="color:#A6ACCD;">  </span><span style="color:#89DDFF;">=&gt;</span><span style="color:#A6ACCD;">  </span><span style="color:#89DDFF;">&quot;</span><span style="color:#C3E88D;">xxxxxxxxxxxxxxxx</span><span style="color:#89DDFF;">&quot;</span><span style="color:#89DDFF;">,</span></span>
<span class="line"><span style="color:#A6ACCD;">            </span><span style="color:#89DDFF;">&#39;</span><span style="color:#C3E88D;">witnesses</span><span style="color:#89DDFF;">&#39;</span><span style="color:#A6ACCD;">  </span><span style="color:#89DDFF;">=&gt;</span><span style="color:#A6ACCD;">  </span><span style="color:#89DDFF;">[</span></span>
<span class="line"><span style="color:#A6ACCD;">              </span><span style="color:#89DDFF;">[</span><span style="color:#89DDFF;">&quot;</span><span style="color:#C3E88D;">John Doe</span><span style="color:#89DDFF;">&quot;</span><span style="color:#89DDFF;">,</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">&quot;</span><span style="color:#C3E88D;">+2348000000000</span><span style="color:#89DDFF;">&quot;</span><span style="color:#89DDFF;">],</span></span>
<span class="line"><span style="color:#A6ACCD;">              </span><span style="color:#89DDFF;">[</span><span style="color:#89DDFF;">&quot;</span><span style="color:#C3E88D;">Jane Doe</span><span style="color:#89DDFF;">&quot;</span><span style="color:#89DDFF;">,</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">&quot;</span><span style="color:#C3E88D;">+2348000000000</span><span style="color:#89DDFF;">&quot;</span><span style="color:#89DDFF;">]</span></span>
<span class="line"><span style="color:#A6ACCD;">            </span><span style="color:#89DDFF;">]</span></span>
<span class="line"><span style="color:#A6ACCD;">    </span><span style="color:#89DDFF;">];</span></span>
<span class="line"></span>
<span class="line"><span style="color:#89DDFF;">$</span><span style="color:#A6ACCD;">insurance </span><span style="color:#89DDFF;">=</span><span style="color:#A6ACCD;"> </span><span style="color:#FFCB6B;">TerminalAfrica</span><span style="color:#89DDFF;">::</span><span style="color:#82AAFF;">purchaseInsurance</span><span style="color:#89DDFF;">($</span><span style="color:#A6ACCD;">insurancePayload</span><span style="color:#89DDFF;">);</span></span>
<span class="line"></span></code></pre></div>`,13),o=[e];function c(r,t,D,i,F,y){return n(),a("div",null,o)}const A=s(p,[["render",c]]);export{C as __pageData,A as default};