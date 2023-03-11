import{_ as s,c as a,o as n,a as o}from"./app.49ea0346.js";const d=JSON.parse('{"title":"Transaction API","description":"","frontmatter":{},"headers":[{"level":2,"title":"Get Transactions","slug":"get-transactions","link":"#get-transactions","children":[]},{"level":2,"title":"Get Transaction","slug":"get-transaction","link":"#get-transaction","children":[]}],"relativePath":"transaction/index.md"}'),l={name:"transaction/index.md"},t=o(`<h1 id="transaction-api" tabindex="-1">Transaction API <a class="header-anchor" href="#transaction-api" aria-hidden="true">#</a></h1><h2 id="get-transactions" tabindex="-1">Get Transactions <a class="header-anchor" href="#get-transactions" aria-hidden="true">#</a></h2><p>This method allows you to get a list of all transactions on an account.</p><div class="language-php"><button title="Copy Code" class="copy"></button><span class="lang">php</span><pre class="shiki"><code><span class="line"><span style="color:#89DDFF;">$</span><span style="color:#A6ACCD;">transactionPayload </span><span style="color:#89DDFF;">=</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">[</span></span>
<span class="line"><span style="color:#A6ACCD;">   </span><span style="color:#89DDFF;">&#39;</span><span style="color:#C3E88D;">wallet</span><span style="color:#89DDFF;">&#39;</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">=&gt;</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">&#39;</span><span style="color:#C3E88D;">xxxxxxxxx</span><span style="color:#89DDFF;">&#39;</span><span style="color:#89DDFF;">,</span></span>
<span class="line"><span style="color:#A6ACCD;">   </span><span style="color:#89DDFF;">&quot;</span><span style="color:#C3E88D;">perPage</span><span style="color:#89DDFF;">&quot;</span><span style="color:#89DDFF;">:</span><span style="color:#A6ACCD;"> </span><span style="color:#F78C6C;">50</span><span style="color:#89DDFF;">,</span></span>
<span class="line"><span style="color:#A6ACCD;">   </span><span style="color:#89DDFF;">&quot;</span><span style="color:#C3E88D;">page</span><span style="color:#89DDFF;">&quot;</span><span style="color:#89DDFF;">:</span><span style="color:#A6ACCD;"> </span><span style="color:#F78C6C;">3</span></span>
<span class="line"><span style="color:#89DDFF;">];</span></span>
<span class="line"></span>
<span class="line"><span style="color:#89DDFF;">$</span><span style="color:#A6ACCD;">transactions </span><span style="color:#89DDFF;">=</span><span style="color:#A6ACCD;"> </span><span style="color:#FFCB6B;">TerminalAfrica</span><span style="color:#89DDFF;">::</span><span style="color:#82AAFF;">getTransactions</span><span style="color:#89DDFF;">($</span><span style="color:#A6ACCD;">transactionPayload</span><span style="color:#89DDFF;">);</span></span>
<span class="line"></span></code></pre></div><h2 id="get-transaction" tabindex="-1">Get Transaction <a class="header-anchor" href="#get-transaction" aria-hidden="true">#</a></h2><p>This method allows you to retrieve details for a transaction.</p><div class="language-php"><button title="Copy Code" class="copy"></button><span class="lang">php</span><pre class="shiki"><code><span class="line"><span style="color:#89DDFF;">$</span><span style="color:#A6ACCD;">transactionId </span><span style="color:#89DDFF;">=</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">&#39;</span><span style="color:#C3E88D;">xxxxxxxxx</span><span style="color:#89DDFF;">&#39;</span><span style="color:#89DDFF;">;</span></span>
<span class="line"><span style="color:#89DDFF;">$</span><span style="color:#A6ACCD;">transaction </span><span style="color:#89DDFF;">=</span><span style="color:#A6ACCD;"> </span><span style="color:#FFCB6B;">TerminalAfrica</span><span style="color:#89DDFF;">::</span><span style="color:#82AAFF;">getTransaction</span><span style="color:#89DDFF;">($</span><span style="color:#A6ACCD;">transactionId</span><span style="color:#89DDFF;">);</span></span>
<span class="line"></span></code></pre></div>`,7),p=[t];function e(c,r,i,D,F,y){return n(),a("div",null,p)}const A=s(l,[["render",e]]);export{d as __pageData,A as default};