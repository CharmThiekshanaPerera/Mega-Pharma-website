<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Mega Pharma Group — A Mega Commitment to Medicine</title>
<meta name="description" content="A cinematic journey through Mega Pharma Group — Mega Pharma (pharmaceuticals) and Mega Meditech (medical technology). Three decades of ethical healthcare across Sri Lanka.">

<!-- ==================================================================
     MEGA PHARMA GROUP — Immersive 3D Experience Edition
     Architecture:
       · One fixed full-viewport WebGL canvas (#world) renders the
         cinematic world: Higgsfield film planes, the capsule
         protagonist, particles, lighting.
       · The document is a normal scroll flow of chapter <section>s.
         A rAF loop maps global scroll progress onto a CAMERA TIMELINE
         (authored keyframes per chapter) — scrolling moves the camera
         and crossfades film worlds; chapter copy glides above.
       · Chapter 05 (Collections) calms the world and raises a fully
         interactive product explorer (129 real products).
     Films & textures were generated with Higgsfield (Cinema Studio
     Video 3.0 · Nano Banana Pro). URLs in the ASSETS block below.
     Contact form + legal/pharmacovigilance pages are now implemented in-page.
     Remaining owner TODOs: TODO(logo) TODO(brand) TODO(assets)
     TODO(assets): re-host Higgsfield URLs on your own CDN before
     production — generated asset URLs are not a permanent host.
     ================================================================== -->

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400;1,500&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

<style>
@include('partials.site-styles')
</style>
</head>
<body>
<a class="skip-link" href="#main">Skip to content</a>

<!-- fixed cinematic world -->
<div id="world" aria-hidden="true"></div>
<div id="grain" aria-hidden="true"></div>
<div id="vignette" aria-hidden="true"></div>

<!-- preloader -->
<div id="loader" aria-hidden="true">
  <div class="loader-mark"><b>Mega Pharma</b><span>Group</span></div>
  <div class="loader-track"><div class="loader-bar" id="loaderBar"></div></div>
  <div class="loader-pct" id="loaderPct">0%</div>
</div>

<div id="progress" aria-hidden="true"></div>

<!-- ============ NAV ============ -->
<header class="nav" id="nav">
  <div class="nav-inner">
    <!-- TODO(logo): replace wordmark with official logo image -->
    <a class="brand" href="#top" aria-label="Mega Pharma Group — home">
      <b>Mega Pharma</b><span>Group</span>
    </a>
    <nav aria-label="Primary">
      <button class="nav-toggle" id="navToggle" aria-expanded="false" aria-controls="navLinks" aria-label="Open menu"><span></span></button>
      <ul class="nav-links" id="navLinks">
        <li><a class="lnk" href="#group">The Group</a></li>
        <li><a class="lnk" href="#pharma">Mega Pharma</a></li>
        <li><a class="lnk" href="#meditech">Mega Meditech</a></li>
        <li><a class="lnk" href="#collections">Collections</a></li>
        <li><a class="lnk" href="#standards">Standards</a></li>
        <li><a class="lnk nav-cta" href="#contact">Contact</a></li>
      </ul>
    </nav>
  </div>
</header>

<!-- chapter rail -->
<nav id="rail" aria-label="Chapters">
  <a href="#top" aria-current="true">01<span class="rail-label"> — Overture</span></a>
  <a href="#group">02<span class="rail-label"> — The Group</span></a>
  <a href="#pharma">03<span class="rail-label"> — Mega Pharma</span></a>
  <a href="#meditech">04<span class="rail-label"> — Mega Meditech</span></a>
  <a href="#collections">05<span class="rail-label"> — Collections</span></a>
  <a href="#standards">06<span class="rail-label"> — Standards</span></a>
  <a href="#contact">07<span class="rail-label"> — Contact</span></a>
</nav>

<a class="scroll-cue" id="scrollCue" href="#group">Scroll to discover</a>

<main id="main">

<!-- ============ 01 · OVERTURE ============ -->
<section class="chapter" id="top" data-scene="0" aria-label="Overture">
  <div class="wrap chapter-inner">
    <div id="heroCopy" style="max-width:720px">
      <p class="kicker rv">Colombo, Sri Lanka — Est. 1995</p>
      <h1 class="rv">A <em>Mega</em> commitment to medicine.</h1>
      <p class="lede rv">For three decades, Mega Pharma Group has sourced quality pharmaceuticals and medical technology from around the globe — to strengthen the healing of Sri Lanka through ethical promotion and island-wide reach.</p>
      <div class="hero-entries rv">
        <a class="entry entry--pharma" href="#pharma">
          <small>House of Pharmaceuticals</small>
          <h3>Mega Pharma</h3>
          <p>Prescription medicine across nine specialty divisions, promoted ethically to the profession.</p>
          <span class="entry-go" aria-hidden="true">Begin the journey &rarr;</span>
        </a>
        <a class="entry entry--medi" href="#meditech">
          <small>House of Medical Technology</small>
          <h3>Mega Meditech</h3>
          <p>Diagnostics, wound care, surgical systems and homecare devices from world-leading makers.</p>
          <span class="entry-go" aria-hidden="true">Begin the journey &rarr;</span>
        </a>
      </div>
    </div>
  </div>
</section>

<!-- ============ 02 · THE GROUP ============ -->
<section class="chapter" id="group" data-scene="1" aria-labelledby="group-h">
  <div class="wrap chapter-inner">
    <div class="pane pane--r rv">
      <p class="eyebrow"><i>02</i>The Group</p>
      <h2 id="group-h">Three decades of trusted healthcare, under one name.</h2>
      <p class="lede">Mega Pharma (Pvt) Ltd. was incorporated in June 1995 as a specialised pharmaceutical company. Today the group imports, markets and distributes high-quality prescription medicines and innovative medical devices across Sri Lanka — built on an unblemished reputation for ethical practice.</p>
      <div class="stats">
        <div class="stat"><b data-count="30">0<i>+</i></b><span>Years</span><small>Since June 1995</small></div>
        <div class="stat"><b data-count="200">0<i>+</i></b><span>Employees</span><small>Nationwide</small></div>
        <div class="stat"><b data-count="9">0</b><span>Divisions</span><small>Specialty teams</small></div>
        <div class="stat"><b data-count="16">0</b><span>Distributors</span><small>Island-wide</small></div>
        <div class="stat"><b data-count="16">0<i>+</i></b><span>Principals</span><small>Four continents</small></div>
      </div>
      <div class="vm">
        <article><h3>Our vision</h3><p>To be the role model in the healthcare industry in Sri Lanka.</p></article>
        <article><h3>Our mission</h3><p>To source quality pharmaceuticals and medical technology from around the globe to strengthen the healing of Sri Lanka.</p></article>
      </div>
    </div>
  </div>
</section>

<!-- ============ 03 · MEGA PHARMA ============ -->
<section class="chapter chapter--pharma" id="pharma" data-scene="2" aria-labelledby="pharma-h">
  <div class="wrap chapter-inner">
    <div class="pane pane--l rv" data-rv="left">
      <p class="eyebrow"><i>03</i>House No. 1 — Pharmaceuticals</p>
      <span class="house-num" aria-hidden="true">No. 1</span>
      <h2 id="pharma-h">Mega Pharma</h2>
      <p class="lede">Ethical promotion of prescription medicine through highly trained specialty teams. From pioneering Sri Lanka&rsquo;s first dedicated cardiac division to today&rsquo;s fastest-growing diabetology arm, Mega Pharma reaches the medical fraternity through CME programmes, specialty associations and lasting professional relationships.</p>
      <ul class="co-tags" aria-label="Therapeutic divisions">
        <li>Cardiology</li><li>Diabetology</li><li>Dermatology</li><li>Neuropsychiatry</li><li>Ayurvedic</li><li>Urology</li><li>Nutrition</li>
      </ul>
      <div class="facts">
        <div class="fact"><b>#1</b><div><span>Largest in cardiology</span><small>The leading pharmaceutical company in Sri Lanka&rsquo;s cardiology segment, with firsts like Angizaar and Angizaar-H.</small></div></div>
        <div class="fact"><b>5</b><div><span>Manufacturing partners</span><small>Micro Labs, Himalaya Wellness, EAR India, Acme and Sky Nutraceuticals.</small></div></div>
        <div class="fact"><b>120+</b><div><span>Product SKUs</span><small>Across cardio-metabolic, CNS, dermatology and research-led Ayurvedic care.</small></div></div>
      </div>
      <a class="co-link lnk" href="#collections" data-jump="pharma">Browse the pharmaceutical collection &rarr;</a>
    </div>
  </div>
</section>

<!-- ============ 04 · MEGA MEDITECH ============ -->
<section class="chapter chapter--medi" id="meditech" data-scene="3" aria-labelledby="medi-h">
  <div class="wrap chapter-inner">
    <div class="pane pane--r rv" data-rv="right">
      <p class="eyebrow"><i>04</i>House No. 2 — Medical Technology</p>
      <span class="house-num" aria-hidden="true">No. 2</span>
      <h2 id="medi-h">Mega Meditech</h2>
      <p class="lede">High-tech medical devices for hospital, clinic and home — installed and supported. Mega Meditech brings blood-glucose monitoring, respiratory care, negative-pressure wound therapy, burn micrografting systems, orthopaedic supports and organ-preservation solutions to Sri Lanka&rsquo;s tertiary institutions and families alike.</p>
      <ul class="co-tags" aria-label="Device categories">
        <li>Diagnostics</li><li>Respiratory</li><li>Wound Care</li><li>Surgical &amp; Burn</li><li>Orthopaedics</li><li>Women&rsquo;s Health</li><li>Physiotherapy</li>
      </ul>
      <div class="facts">
        <div class="fact"><b>12</b><div><span>Device principals worldwide</span><small>From TaiDoc and Yuwell to DeRoyal, Humeca, Telea and MedGyn — Taiwan to Tennessee.</small></div></div>
        <div class="fact"><b>1st</b><div><span>Introduced to Sri Lanka</span><small>The Video Colposcope and Cryo systems for women&rsquo;s health screening, among other national firsts.</small></div></div>
        <div class="fact"><b>40+</b><div><span>Device &amp; consumable lines</span><small>Diagnostics, NPWT wound care, burn surgery, orthopaedics and organ preservation.</small></div></div>
      </div>
      <a class="co-link lnk" href="#collections" data-jump="meditech">Browse the medical technology collection &rarr;</a>
    </div>
  </div>
</section>

<!-- ============ 05 · THE COLLECTIONS ============ -->
<section class="chapter" id="collections" data-scene="4" aria-labelledby="collections-h">
  <div class="wrap chapter-inner">
    <!-- No scroll-reveal on this pane: it's ~9000px tall (all 129 products),
         so a per-element IntersectionObserver reveal can never reach its
         threshold and would leave the whole section stuck at opacity:0.
         The catalogue is always visible. -->
    <div class="pane">
      <div class="prod-head">
        <div>
          <p class="eyebrow"><i>05</i>The Collections</p>
          <h2 id="collections-h">A portfolio curated for the profession.</h2>
          <p class="lede">The camera rests. Explore the group portfolio, organised by therapeutic collection — filter by house and category, or search by brand, composition or manufacturer.</p>
        </div>
        <p class="prod-note">Product information is intended for healthcare professionals. Prescription medicines are promoted ethically, to the profession only.</p>
      </div>

      <div class="prod-controls">
        <div class="prod-row">
          <div class="tabs" role="tablist" aria-label="Filter by company">
            <button class="tab" role="tab" data-co="all" aria-selected="true">All Houses</button>
            <button class="tab" role="tab" data-co="pharma" aria-selected="false">Mega Pharma</button>
            <button class="tab" role="tab" data-co="meditech" aria-selected="false">Mega Meditech</button>
          </div>
          <div class="search-box">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
            <input type="search" id="prodSearch" placeholder="Search brand, composition, manufacturer…" aria-label="Search products">
          </div>
          <span class="prod-count" id="prodCount" role="status" aria-live="polite"></span>
        </div>
        <div class="chips" id="chipRow" role="group" aria-label="Filter by category"></div>
      </div>

      <div id="prodGrid" aria-live="polite"></div>
    </div>
  </div>
</section>

<!-- ============ 06 · STANDARDS ============ -->
<section class="chapter" id="standards" data-scene="5" aria-labelledby="standards-h">
  <div class="wrap chapter-inner">
    <div class="pane pane--c rv">
      <p class="eyebrow"><i>06</i>Standards</p>
      <h2 id="standards-h">Six values that shape every decision.</h2>
      <p class="lede">Mega Pharma Group is built on fundamental values that create a unique environment within the organisation and guide individual conduct — the foundation of an unblemished, three-decade reputation.</p>
      <div class="values">
        <div class="value"><i aria-hidden="true">i.</i><div><h3>Honesty &amp; integrity</h3><p>The highest priority for honesty and integrity in every employee. We do not compromise — for any person or any circumstance.</p></div></div>
        <div class="value"><i aria-hidden="true">ii.</i><div><h3>Care for our people</h3><p>We treasure every employee equally and act as their guardian, regardless of situation or context.</p></div></div>
        <div class="value"><i aria-hidden="true">iii.</i><div><h3>Dynamism</h3><p>We address market issues swiftly — even the most trivial — because momentum is part of how we serve.</p></div></div>
        <div class="value"><i aria-hidden="true">iv.</i><div><h3>Customer responsibility</h3><p>The highest priority is given to our customer base — doctor, hospital, patient and chemist.</p></div></div>
        <div class="value"><i aria-hidden="true">v.</i><div><h3>People &amp; team spirit</h3><p>We move together. A strong team culture supports the quality our customers and partners rely on.</p></div></div>
        <div class="value"><i aria-hidden="true">vi.</i><div><h3>Journey toward excellence</h3><p>There is always room for improvement. We are receptive to constructive criticism and suggestions.</p></div></div>
      </div>
      <div class="partners">
        <p>Our global principals</p>
        <ul class="partner-cloud">
          <li>Micro Labs</li><li>Himalaya</li><li>ACME</li><li>EAR India</li><li>Dr. F. Köhler Chemie</li><li>TaiDoc</li><li>YuWell</li><li>B.Well Swiss</li><li>DeRoyal</li><li>Eucare</li><li>Humeca</li><li>Telea</li><li>MedGyn</li><li>KLS Martin</li><li>XVIVO Perfusion</li><li>Medispec</li><li>Tynor</li><li>Connexicon</li><li>Yasee QY Medical</li><li>Sky Nutraceuticals</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- ============ 07 · CONTACT ============ -->
<section class="chapter" id="contact" data-scene="6" aria-labelledby="contact-h">
  <div class="wrap chapter-inner">
    <div class="pane pane--c rv" style="max-width:980px">
      <p class="eyebrow"><i>07</i>Correspondence</p>
      <h2 id="contact-h">Let&rsquo;s strengthen the healing of Sri Lanka — together.</h2>
      <div class="contact-grid">
        <div>
          <div class="c-item"><i aria-hidden="true">📍</i><div><b>Registered office</b><address>93/5, Dutugemunu Street,<br>Colombo 06, Sri Lanka</address></div></div>
          <div class="c-item"><i aria-hidden="true">📞</i><div><b>Telephone</b><p><a class="lnk" href="tel:+94114203596">+94 11 420 3596–7</a><br><a class="lnk" href="tel:+94112812390">+94 11 281 2390–1</a></p></div></div>
          <div class="c-item"><i aria-hidden="true">📠</i><div><b>Facsimile</b><p>+94 11 552 2784 &nbsp;·&nbsp; +94 11 282 8481</p></div></div>
          <div class="c-item"><i aria-hidden="true">✉</i><div><b>Email &amp; web</b><p><a class="lnk" href="mailto:info@megapharma.lk">info@megapharma.lk</a><br><a class="lnk" href="https://www.megapharma.lk" rel="noopener">www.megapharma.lk</a></p></div></div>
        </div>
        <!-- Contact form: POSTs to the Laravel /contact route (see
             ContactMessageController) and is stored in the contact_messages
             table. See CONTACT FORM in the ENGINE script below. -->
        <form class="cform" id="contactForm" novalidate>
          <h3>Send us a message</h3>
          <div class="hp-field" aria-hidden="true"><label>Leave this field empty<input type="text" name="company" tabindex="-1" autocomplete="off"></label></div>
          <div class="f-row">
            <div class="f-group"><label for="cf-name">Full name</label><input id="cf-name" name="name" type="text" autocomplete="name" required></div>
            <div class="f-group"><label for="cf-email">Email</label><input id="cf-email" name="email" type="email" autocomplete="email" required></div>
          </div>
          <div class="f-group"><label for="cf-topic">I&rsquo;m contacting about</label>
            <select id="cf-topic" name="topic">
              <option>General enquiry</option>
              <option>Mega Pharma — pharmaceuticals</option>
              <option>Mega Meditech — medical devices</option>
              <option>Becoming a distribution partner</option>
              <option>Global principal / manufacturer partnership</option>
              <option>Careers</option>
            </select>
          </div>
          <div class="f-group"><label for="cf-msg">Message</label><textarea id="cf-msg" name="message" required></textarea></div>
          <button class="btn" type="submit">Send message</button>
          <p class="form-status" id="formStatus" role="status" aria-live="polite"></p>
        </form>
      </div>
    </div>
  </div>
</section>
</main>

<!-- ============ FOOTER ============ -->
<footer>
  <div class="wrap">
    <div class="foot-grid">
      <div class="foot-brand">
        <img class="foot-logo rv" src="https://d8j0ntlcm91z4.cloudfront.net/user_3CB7QbfiArx9VIufTgzDQat3bei/hf_20260707_064703_64d42d90-cb34-4a6d-a133-ffa9fabc2b31.png" alt="" aria-hidden="true" width="46" height="72" loading="lazy" decoding="async">
        <a class="brand" href="#top"><b>Mega Pharma</b><span>Group</span></a>
        <p>A specialised healthcare group importing, marketing and distributing quality medicine and medical technology across Sri Lanka since 1995.</p>
      </div>
      <div><h4>Group</h4><ul>
        <li><a class="lnk" href="#group">About the group</a></li>
        <li><a class="lnk" href="#standards">Our standards</a></li>
        <li><a class="lnk" href="#contact">Contact</a></li>
      </ul></div>
      <div><h4>Houses</h4><ul>
        <li><a class="lnk" href="#pharma">Mega Pharma</a></li>
        <li><a class="lnk" href="#meditech">Mega Meditech</a></li>
        <li><a class="lnk" href="#collections">The collections</a></li>
      </ul></div>
      <div><h4>Legal</h4><ul>
        <li><button class="lnk foot-legal" type="button" data-legal="privacy">Privacy policy</button></li>
        <li><button class="lnk foot-legal" type="button" data-legal="terms">Terms of use</button></li>
        <li><button class="lnk foot-legal" type="button" data-legal="pv">Pharmacovigilance</button></li>
      </ul></div>
    </div>
    <div class="foot-base">
      <span>© <span id="year">2026</span> Mega Pharma (Pvt) Ltd. All rights reserved.</span>
      <span>Films crafted with Higgsfield · Incorporated June 1995 · Colombo</span>
    </div>
  </div>
</footer>

@include('partials.legal-modal')

<script>
/* ==========================================================
   PRODUCT DATA — extracted from the Mega Pharma SKU list.
   Multi-strength / multi-size SKUs are merged into one entry;
   all variants are listed in `v` and shown in the modal.
   Fields: n=name, g=generic/composition, v=variants/pack,
           co=company, cat=category, mfr=principal, d=description
   ========================================================== */
const PRODUCTS = @json($products);
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
<script>
/* ==================================================================
   THE ENGINE — preloader · chrome · explorer · cinematic world
   ================================================================== */
(function(){
"use strict";
const $  = (s,el=document)=>el.querySelector(s);
const $$ = (s,el=document)=>[...el.querySelectorAll(s)];
const reduceMotion = matchMedia("(prefers-reduced-motion: reduce)").matches;
const isMobile = matchMedia("(max-width:760px)").matches;

/* ------------------------------------------------------------------
   ASSETS — Higgsfield-generated films & textures.
   TODO(assets): re-host these URLs on your own CDN for production.
   Every asset has a brand-gradient fallback; a failed URL can never
   produce a black hole.
   ------------------------------------------------------------------ */
/* Higgsfield job IDs (Cinema Studio Video 3.0, 1080p, 5s · Nano Banana Pro):
     hero_master        cc834fab-7215-46ad-b7d7-3689385e3434
     chapter_pharma     7409122e-321f-4e2b-ae94-b1477b2ace03
     chapter_meditech   ae32af8d-3ff2-4c6d-9997-b8a1d0e0eab3
     chapter_island     eac4f90b-0a4f-487d-b4ec-5c85985f6f88
     chapter_standards  5d71758f-fce0-4971-98ea-4022832ff99e
     texture_grain      4f89a8e3-528c-4b5e-8005-7c8026577193\n     emblem (logo)      user render 64d42d90… — matted locally, embedded as data URI
     (capsule reference 3a6fd358-ba58-4d26-8f9d-271bb4f26ebd — superseded
      by the procedural Three.js capsule for a mathematically clean mesh)
     Each film below is wired to its job's CloudFront result URL.
     TODO(assets): before production, download these and re-host them on
     your own CDN with CORS enabled (Access-Control-Allow-Origin) — the
     engine needs CORS to use films as WebGL textures, and falls back to
     brand-gradient worlds automatically if a URL ever fails. */
const ASSETS = {
  films: [
    { key:"hero",      url:"https://d8j0ntlcm91z4.cloudfront.net/user_3CB7QbfiArx9VIufTgzDQat3bei/hf_20260707_041018_cc834fab-7215-46ad-b7d7-3689385e3434.mp4",      tintA:"#f6e9e4", tintB:"#b5121b" }, // 01 capsule & silk
    { key:"pharma",    url:"https://d8j0ntlcm91z4.cloudfront.net/user_3CB7QbfiArx9VIufTgzDQat3bei/hf_20260707_041030_7409122e-321f-4e2b-ae94-b1477b2ace03.mp4",    tintA:"#f7ece7", tintB:"#8c0e15" }, // 03 tablet ballet
    { key:"meditech",  url:"https://d8j0ntlcm91z4.cloudfront.net/user_3CB7QbfiArx9VIufTgzDQat3bei/hf_20260707_041040_ae32af8d-3ff2-4c6d-9997-b8a1d0e0eab3.mp4",      tintA:"#e9edf6", tintB:"#1d3e7e" }, // 04 navy instruments
    { key:"island",    url:"https://d8j0ntlcm91z4.cloudfront.net/user_3CB7QbfiArx9VIufTgzDQat3bei/hf_20260707_041049_eac4f90b-0a4f-487d-b4ec-5c85985f6f88.mp4",    tintA:"#f4efe6", tintB:"#c9a34a" }, // 02 porcelain island
    { key:"standards", url:"https://d8j0ntlcm91z4.cloudfront.net/user_3CB7QbfiArx9VIufTgzDQat3bei/hf_20260707_041056_5d71758f-fce0-4971-98ea-4022832ff99e.mp4", tintA:"#f6f2ea", tintB:"#b5121b" }  // 06 marble line
  ],
  grain: "https://d8j0ntlcm91z4.cloudfront.net/user_3CB7QbfiArx9VIufTgzDQat3bei/hf_20260707_041352_4f89a8e3-528c-4b5e-8005-7c8026577193.png"
};

/* ==================================================================
   PRELOADER — real load progress across films, grain, fonts
   ================================================================== */
const loader = $("#loader"), loaderBar = $("#loaderBar"), loaderPct = $("#loaderPct");
const loadItems = []; let loadDone = 0, siteRevealed = false;
function trackItem(){ loadItems.push(1); return ()=>{ loadDone++; paintLoad(); }; }
function paintLoad(){
  const p = loadItems.length ? Math.round((loadDone/loadItems.length)*100) : 100;
  if(loaderBar){ loaderBar.style.width = p+"%"; loaderPct.textContent = p+"%"; }
  if(p >= 100) revealSite();
}
function revealSite(){
  if(siteRevealed) return; siteRevealed = true;
  setTimeout(()=>{
    if(loader){ loader.classList.add("done"); setTimeout(()=>loader.remove(), 1400); }
  }, 350);
}
if(reduceMotion && loader) loader.remove();

/* fonts count as one item */
if(!reduceMotion){
  const fDone = trackItem();
  if(document.fonts && document.fonts.ready) document.fonts.ready.then(fDone).catch(fDone);
  else fDone();
  setTimeout(revealSite, 9000); // absolute safety net
}

/* grain texture */
(function(){
  if(ASSETS.grain && !ASSETS.grain.includes("{"+"{")){
    const done = reduceMotion ? ()=>{} : trackItem();
    const im = new Image();
    im.onload = ()=>{ $("#grain").style.setProperty("--grain-url", "url('"+ASSETS.grain+"')"); done(); };
    im.onerror = ()=>{ done(); };
    im.src = ASSETS.grain;
    setTimeout(done, 6000);
  }
})();

/* ==================================================================
   CHROME — nav · progress · rail · cue · reveal · counters · ripple
   ================================================================== */
const nav = $("#nav"), navToggle = $("#navToggle"), navLinks = $("#navLinks");
const progress = $("#progress"), cue = $("#scrollCue");

navToggle.addEventListener("click", ()=>{
  const open = navLinks.classList.toggle("open");
  navToggle.setAttribute("aria-expanded", open);
  navToggle.setAttribute("aria-label", open ? "Close menu" : "Open menu");
});
navLinks.addEventListener("click", e=>{ if(e.target.closest("a")){ navLinks.classList.remove("open"); navToggle.setAttribute("aria-expanded","false"); } });

/* active chapter → rail + nav */
const chapterIds = ["top","group","pharma","meditech","collections","standards","contact"];
const secIO = new IntersectionObserver(entries=>{
  entries.forEach(en=>{
    if(!en.isIntersecting) return;
    const id = "#"+en.target.id;
    $$("#rail a").forEach(a=>a.setAttribute("aria-current", a.getAttribute("href")===id));
    $$(".nav-links a").forEach(a=>a.setAttribute("aria-current", a.getAttribute("href")===id));
  });
},{rootMargin:"-45% 0px -50% 0px"});
chapterIds.forEach(id=>{ const s=document.getElementById(id); if(s) secIO.observe(s); });

/* scroll reveal with stagger */
const revealIO = new IntersectionObserver(entries=>{
  let i=0;
  entries.forEach(en=>{
    if(!en.isIntersecting) return;
    en.target.style.transitionDelay = Math.min(i++*90,360)+"ms";
    en.target.classList.add("in");
    revealIO.unobserve(en.target);
  });
},{threshold:.14,rootMargin:"0px 0px -6% 0px"});
$$(".rv").forEach(el=>revealIO.observe(el));

/* Safety net: a direct #hash load (e.g. clicking "Collections" in the nav,
   or opening a link straight to /#collections) can jump the browser to a
   section that's already in the viewport before this script runs. Some
   browsers don't reliably fire the IntersectionObserver's first callback
   for elements that are already visible at observe()-time, which left
   those sections permanently stuck at opacity:0. Force-reveal anything
   that's already on screen right now, and anything still hidden after a
   couple of seconds no matter what (belt-and-braces). */
function revealIfVisible(el){
  const r=el.getBoundingClientRect();
  if(r.bottom>0&&r.top<innerHeight){
    el.classList.add("in");
    revealIO.unobserve(el);
    return true;
  }
  return false;
}
$$(".rv").forEach(revealIfVisible);
if(location.hash){
  setTimeout(()=>$$(".rv").forEach(revealIfVisible),50);
}
setTimeout(()=>{ $$(".rv:not(.in)").forEach(el=>{ el.classList.add("in"); revealIO.unobserve(el); }); },2500);

/* stat counters */
const countIO = new IntersectionObserver(entries=>{
  entries.forEach(en=>{
    if(!en.isIntersecting) return;
    const el=en.target, target=+el.dataset.count, tail=el.querySelector("i");
    countIO.unobserve(el);
    const suffix = tail ? tail.outerHTML : "";
    if(reduceMotion){ el.innerHTML = target+suffix; return; }
    const t0=performance.now(), dur=1500;
    (function tick(t){
      const p=Math.min((t-t0)/dur,1), e=1-Math.pow(1-p,3);
      el.innerHTML = Math.round(target*e)+suffix;
      if(p<1) requestAnimationFrame(tick);
    })(t0);
  });
},{threshold:.6});
$$("[data-count]").forEach(el=>countIO.observe(el));

/* ripple micro-interaction */
document.addEventListener("click", e=>{
  const btn=e.target.closest(".btn");
  if(!btn||reduceMotion) return;
  const r=btn.getBoundingClientRect(), d=Math.max(r.width,r.height);
  const rip=document.createElement("span");
  rip.className="ripple";
  rip.style.width=rip.style.height=d+"px";
  rip.style.left=(e.clientX-r.left-d/2)+"px";
  rip.style.top =(e.clientY-r.top -d/2)+"px";
  btn.appendChild(rip);
  rip.addEventListener("animationend",()=>rip.remove(),{once:true});
});

/* ==================================================================
   COLLECTIONS EXPLORER — tabs · chips · search · groups · modal
   ================================================================== */
const gridHost=$("#prodGrid"), chipRow=$("#chipRow"), countEl=$("#prodCount"), searchInput=$("#prodSearch");
let curCo="all", curCat="All", curQ="", renderToken=0;
const CAT_ORDER={
  pharma:["Cardiology","Diabetology","Dermatology","Neuropsychiatry","Ayurvedic","Urology","Nutrition & Wellness"],
  meditech:["Diagnostics & Monitoring","Respiratory Care","Wound Care","Surgical & Burn Care","Orthopaedic Care","Women's Health","Physiotherapy","Home Wellness"]
};
const catsFor=co=>co==="all"?[...CAT_ORDER.pharma,...CAT_ORDER.meditech]:CAT_ORDER[co];
const coLabel=co=>co==="pharma"?"Mega Pharma":"Mega Meditech";

function renderChips(){
  chipRow.innerHTML="";
  ["All",...catsFor(curCo)].forEach(cat=>{
    const b=document.createElement("button");
    b.className="chip"; b.type="button"; b.textContent=cat;
    b.setAttribute("aria-pressed",cat===curCat);
    b.addEventListener("click",()=>{ curCat=cat; renderChips(); requestRender(); });
    chipRow.appendChild(b);
  });
}
function matches(p){
  if(curCo!=="all"&&p.co!==curCo) return false;
  if(curCat!=="All"&&p.cat!==curCat) return false;
  if(curQ){ const hay=(p.n+" "+p.g+" "+p.mfr+" "+p.cat).toLowerCase(); if(!hay.includes(curQ)) return false; }
  return true;
}
function showSkeletons(){
  let sk='<div class="pgroup"><div class="grid">';
  for(let i=0;i<8;i++) sk+='<div class="sk" aria-hidden="true"><i></i><i></i><i></i><i></i><i></i></div>';
  gridHost.innerHTML=sk+"</div></div>";
}
function requestRender(){
  const token=++renderToken;
  countEl.textContent="…";
  if(reduceMotion){ renderGrid(); return; }
  showSkeletons();
  setTimeout(()=>{ if(token===renderToken) renderGrid(); },320);
}
function cardHTML(p,idx,i){
  return '<a class="card" href="/products/'+p.slug+'" data-co="'+p.co+'" data-idx="'+idx+'" style="animation-delay:'+Math.min(i*35,350)+'ms">'+
    '<span class="card-cat">'+p.cat+'</span>'+
    '<span class="card-name">'+p.n+'</span>'+
    '<p class="generic">'+p.g+'</p>'+
    '<p class="meta"><em>'+p.mfr+'</em><span>'+coLabel(p.co)+'</span></p>'+
  '</a>';
}
function renderGrid(){
  const items=PRODUCTS.filter(matches);
  countEl.textContent=items.length+" of "+PRODUCTS.length+" products";
  if(!items.length){
    gridHost.innerHTML='<div class="grid" style="margin-top:2.2rem"><div class="grid-empty"><b>No products match your filters.</b>Try a different search term or category.</div></div>';
    return;
  }
  const houses=curCo==="all"?["pharma","meditech"]:[curCo];
  let html="";
  houses.forEach(co=>{
    CAT_ORDER[co].forEach(cat=>{
      const group=items.filter(p=>p.co===co&&p.cat===cat).sort((a,b)=>a.n.localeCompare(b.n));
      if(!group.length) return;
      html+='<section class="pgroup" aria-label="'+cat+' — '+coLabel(co)+'">';
      html+='<div class="pgroup-head"><h3>'+cat+'</h3><span class="g-co '+co+'">'+coLabel(co)+'</span><span class="g-count">'+group.length+(group.length>1?" products":" product")+'</span></div>';
      html+='<div class="grid">';
      group.forEach((p,i)=>{ html+=cardHTML(p,PRODUCTS.indexOf(p),i); });
      html+="</div></section>";
    });
  });
  gridHost.innerHTML=html;
}
if(!reduceMotion&&matchMedia("(hover:hover) and (pointer:fine)").matches){
  gridHost.addEventListener("pointermove",e=>{
    const card=e.target.closest(".card"); if(!card) return;
    const r=card.getBoundingClientRect();
    const rx=((e.clientY-r.top)/r.height-.5)*-5, ry=((e.clientX-r.left)/r.width-.5)*7;
    card.style.transform="perspective(760px) rotateX("+rx.toFixed(2)+"deg) rotateY("+ry.toFixed(2)+"deg) translateY(-3px)";
  });
  gridHost.addEventListener("pointerout",e=>{
    const card=e.target.closest(".card");
    if(card&&!card.contains(e.relatedTarget)) card.style.transform="";
  });
}
$$(".tab").forEach(tab=>{
  tab.addEventListener("click",()=>{
    curCo=tab.dataset.co; curCat="All";
    $$(".tab").forEach(t=>t.setAttribute("aria-selected",t===tab));
    renderChips(); requestRender();
  });
});
$$("[data-jump]").forEach(a=>{
  a.addEventListener("click",()=>{
    const co=a.dataset.jump;
    $$(".tab").forEach(t=>{ const sel=t.dataset.co===co; t.setAttribute("aria-selected",sel); if(sel) curCo=co; });
    curCat="All"; renderChips(); requestRender();
  });
});
let sT;
searchInput.addEventListener("input",()=>{
  clearTimeout(sT);
  sT=setTimeout(()=>{ curQ=searchInput.value.trim().toLowerCase(); requestRender(); },160);
});

/* ==================================================================
   CONTACT FORM — real submission
   Set FORM_ENDPOINT to a POST URL (Formspree, Getform, or your own API)
   to send messages server-side. Left blank, the form composes a pre-filled
   email to CONTACT_EMAIL via the visitor's mail app — so it works today.
   A hidden "company" honeypot silently drops bot submissions.
   ================================================================== */
const FORM_ENDPOINT = "{{ route('contact.store') }}";
const CSRF_TOKEN = "{{ csrf_token() }}";
const CONTACT_EMAIL = "info@megapharma.lk";
const cForm=$("#contactForm"), cStatus=$("#formStatus");
function setStatus(msg,ok){ cStatus.textContent=msg; cStatus.classList.toggle("ok",!!ok); }
cForm.addEventListener("submit",async e=>{
  e.preventDefault();
  const f=cForm.elements;
  if(f["company"]&&f["company"].value) return;               // honeypot → silent drop
  if(!cForm.checkValidity()){ cForm.reportValidity(); return; }
  const data={ name:f["name"].value.trim(), email:f["email"].value.trim(),
               topic:f["topic"].value, message:f["message"].value.trim() };
  const first=data.name.split(" ")[0];
  const btn=$("button[type=submit]",cForm);
  const label=btn.textContent; btn.disabled=true; btn.textContent="Sending…"; setStatus("",false);
  try{
    const res=await fetch(FORM_ENDPOINT,{method:"POST",
      headers:{"Accept":"application/json","Content-Type":"application/json","X-CSRF-TOKEN":CSRF_TOKEN},
      body:JSON.stringify(data)});
    if(res.status===422){
      const body=await res.json();
      const firstError=body.errors ? Object.values(body.errors)[0][0] : body.message;
      throw new Error(firstError||"Please check the form and try again.");
    }
    if(!res.ok) throw new Error();
    setStatus("Thank you, "+first+". Your message has reached Mega Pharma Group — we'll be in touch shortly.",true);
    cForm.reset();
  }catch(err){
    setStatus(err.message||("We couldn't send that just now. Please email "+CONTACT_EMAIL+" or call +94 11 420 3596."),false);
  }finally{ btn.disabled=false; btn.textContent=label; }
});

renderChips(); requestRender();

/* ==================================================================
   THE CINEMATIC WORLD — scroll-driven camera through film chapters
   ================================================================== */
(function world(){
  const host=$("#world");
  if(!window.THREE||!host) return;                       // CSS fallback stands
  let renderer;
  try{ renderer=new THREE.WebGLRenderer({antialias:true,alpha:true}); }
  catch(err){ return; }

  renderer.setPixelRatio(Math.min(devicePixelRatio, isMobile?1.5:2));
  renderer.setSize(innerWidth,innerHeight);
  host.appendChild(renderer.domElement);

  const scene=new THREE.Scene();
  scene.fog=new THREE.Fog(0xfaf8f4,18,42);
  const cam=new THREE.PerspectiveCamera(42,innerWidth/innerHeight,.1,80);
  cam.position.set(0,0,10);

  scene.add(new THREE.AmbientLight(0xffffff,.75));
  const key=new THREE.DirectionalLight(0xfff6ea,.9);  key.position.set(6,9,7);   scene.add(key);
  const fill=new THREE.PointLight(0x1d3e7e,.25,40);   fill.position.set(-7,-3,5); scene.add(fill);
  const rim=new THREE.PointLight(0xb5121b,.35,40);    rim.position.set(0,4,-6);   scene.add(rim);

  /* ---------- film screens: two planes crossfading Higgsfield films ---------- */
  const SCREEN_Z=-14;
  function gradientTexture(a,b){
    const c=document.createElement("canvas"); c.width=64; c.height=36;
    const x=c.getContext("2d");
    const g=x.createLinearGradient(0,0,64,36);
    g.addColorStop(0,a); g.addColorStop(1,b);
    x.fillStyle=g; x.fillRect(0,0,64,36);
    return new THREE.CanvasTexture(c);
  }
  /* one <video> + texture (or gradient fallback) per film */
  const films=ASSETS.films.map(f=>{
    const entry={ key:f.key, video:null, tex:gradientTexture(f.tintA,f.tintB), ready:false };
    if(!f.url||f.url.includes("{"+"{")||reduceMotion) return entry;   // fallback / static
    const done=trackItem();
    const v=document.createElement("video");
    v.muted=true; v.loop=true; v.playsInline=true; v.setAttribute("playsinline","");
    v.crossOrigin="anonymous"; v.preload="auto"; v.src=f.url;
    let settled=false;
    const settle=ok=>{ if(settled) return; settled=true;
      if(ok){ entry.video=v; entry.tex=new THREE.VideoTexture(v); entry.tex.minFilter=THREE.LinearFilter; entry.ready=true; }
      done();
    };
    v.addEventListener("canplaythrough",()=>settle(true),{once:true});
    v.addEventListener("error",()=>settle(false),{once:true});
    setTimeout(()=>settle(v.readyState>=3),9000);                  // never block the site
    v.load();
    return entry;
  });

  function screenPlane(){
    const m=new THREE.Mesh(
      new THREE.PlaneGeometry(1,1,1,1),
      new THREE.MeshBasicMaterial({transparent:true,opacity:0,depthWrite:false})
    );
    m.position.z=SCREEN_Z; scene.add(m); return m;
  }
  const screenA=screenPlane(), screenB=screenPlane();
  let onA=-1,onB=-1;                                                // film index on each screen
  function fitScreens(){
    const dist=cam.position.z-SCREEN_Z;
    const h=2*dist*Math.tan(THREE.MathUtils.degToRad(cam.fov/2))*1.4;   // oversize for camera drift
    const w=h*(innerWidth/innerHeight)*1.15;
    [screenA,screenB].forEach(s=>{ s.scale.set(w,h,1); });
  }

  /* paper veil above the film — dims the world (e.g. Collections chapter) */
  const veil=new THREE.Mesh(
    new THREE.PlaneGeometry(1,1),
    new THREE.MeshBasicMaterial({color:0xfaf8f4,transparent:true,opacity:0,depthWrite:false})
  );
  veil.position.z=SCREEN_Z+.5; scene.add(veil);
  function fitVeil(){ veil.scale.copy(screenA.scale); }

  /* ---------- the protagonist: the official Mega Pharma emblem ---------- */
  /* The Vitruvian-Man plaque (user's logo, matted locally) replaces the
     earlier capsule. Texture chain: embedded cutout (data URI — needs no
     CORS) → original Higgsfield render URL → procedural capsule fallback. */
  const capsule=new THREE.Group();
  scene.add(capsule);
  let stillRender=null;
@include('partials.emblem-protagonist-script')

  /* dust particles */
  const P=isMobile?70:160;
  const pos=new Float32Array(P*3);
  for(let i=0;i<P;i++){ pos[i*3]=(Math.random()-.5)*24; pos[i*3+1]=(Math.random()-.5)*14; pos[i*3+2]=-2-Math.random()*10; }
  const pGeo=new THREE.BufferGeometry();
  pGeo.setAttribute("position",new THREE.BufferAttribute(pos,3));
  const dust=new THREE.Points(pGeo,new THREE.PointsMaterial({color:0x9aa5c4,size:.045,transparent:true,opacity:.5}));
  scene.add(dust);

  /* ---------- CAMERA TIMELINE — one keyframe per chapter ---------- */
  /* film: index into films[] · dim: paper veil opacity · cap: protagonist pose */
  const KF=[
    {film:0,dim:0,  cam:[0,0,10],    look:[0,0],   cap:[ 4.8,-.1, 2, 1.05]},   // 01 overture — pushed right, clear of the hero copy
    {film:3,dim:.06,cam:[-1.1,.35,9.6],look:[-.3,.1],cap:[-3.6, .7, 1,  .85]}, // 02 group / island
    {film:1,dim:.04,cam:[1.3,-.25,9.2],look:[.35,0], cap:[ 3.7, .3, .5, .98]}, // 03 pharma
    {film:2,dim:.04,cam:[-1.3,.25,9.2],look:[-.35,0],cap:[-3.7,-.3, .5, .98]}, // 04 meditech
    {film:1,dim:.8, cam:[0,.15,11],  look:[0,.05], cap:[ 0, 3.1,-2,  .4]},     // 05 collections (world rests)
    {film:4,dim:.14,cam:[.6,0,10],   look:[.15,0], cap:[ 3.1,-1.7, 0, .6]},    // 06 standards
    {film:0,dim:.3, cam:[0,-.15,10.4],look:[0,-.05],cap:[-3.0,-2.0, 1, .5]}    // 07 contact
  ];
  if(isMobile) KF.forEach(k=>{ k.cap[0]*=.45; k.cap[1]+=(k.cap[1]>0?1.2:-.6); k.cap[3]*=.7; });

  /* map chapters to scroll segments */
  let SEG=[];
  function measure(){
    SEG=chapterIds.map(id=>{
      const el=document.getElementById(id);
      return {top:el.offsetTop, h:el.offsetHeight};
    });
    fitScreens(); fitVeil();
  }

  const smooth=t=>t*t*(3-2*t);
  const lerp=(a,b,t)=>a+(b-a)*t;

  /* which chapter + local progress for a given scroll */
  function locate(y){
    const probe=y+innerHeight*.5;
    for(let i=SEG.length-1;i>=0;i--){
      if(probe>=SEG[i].top){
        const nextTop=i<SEG.length-1?SEG[i+1].top:SEG[i].top+SEG[i].h;
        const p=Math.min(Math.max((probe-SEG[i].top)/Math.max(nextTop-SEG[i].top,1),0),1);
        return {i,p};
      }
    }
    return {i:0,p:0};
  }

  /* film swapping with crossfade */
  function setFilms(cur,next,fade){
    if(onA!==cur){ onA=cur; screenA.material.map=films[cur].tex; screenA.material.needsUpdate=true; }
    if(next!==null&&onB!==next){ onB=next; screenB.material.map=films[next].tex; screenB.material.needsUpdate=true; }
    screenA.material.opacity=1-fade;
    screenB.material.opacity=next===null?0:fade;
    films.forEach((f,idx)=>{
      if(!f.video) return;
      const active=idx===cur||(next!==null&&idx===next);
      if(active&&f.video.paused){ f.video.play().catch(()=>{}); }
      else if(!active&&!f.video.paused){ f.video.pause(); }
    });
  }

  /* mouse tracking */
  let mx=0,my=0;
  if(!reduceMotion){
    addEventListener("pointermove",e=>{ mx=e.clientX/innerWidth-.5; my=e.clientY/innerHeight-.5; },{passive:true});
  }

  addEventListener("resize",()=>{
    cam.aspect=innerWidth/innerHeight; cam.updateProjectionMatrix();
    renderer.setSize(innerWidth,innerHeight);
    measure();
  },{passive:true});

  /* ---------- the render loop: scroll → world state ---------- */
  const clock=new THREE.Clock();
  let raf=null;
  function frame(){
    raf=null;
    if(document.hidden){ return; }                                   // pause off-tab
    const t=clock.getElapsedTime();
    const y=scrollY;

    /* chrome driven here too (one rAF for everything) */
    const max=document.documentElement.scrollHeight-innerHeight;
    progress.style.width=(max>0?(y/max)*100:0)+"%";
    nav.classList.toggle("scrolled",y>24);
    cue.classList.toggle("hide",y>innerHeight*.35);

    const {i,p}=locate(y);
    const a=KF[i], b=KF[Math.min(i+1,KF.length-1)];
    const tp=smooth(p);

    /* camera */
    cam.position.x=lerp(a.cam[0],b.cam[0],tp)+mx*.6;
    cam.position.y=lerp(a.cam[1],b.cam[1],tp)-my*.4;
    cam.position.z=lerp(a.cam[2],b.cam[2],tp);
    cam.lookAt(lerp(a.look[0],b.look[0],tp),lerp(a.look[1],b.look[1],tp),SCREEN_Z*.5);

    /* protagonist */
    capsule.position.set(
      lerp(a.cap[0],b.cap[0],tp)+mx*.5,
      lerp(a.cap[1],b.cap[1],tp)-my*.35,
      lerp(a.cap[2],b.cap[2],tp)
    );
    const s=lerp(a.cap[3],b.cap[3],tp);
    capsule.scale.setScalar(s);
    capsule.rotation.y=Math.sin(t*.5)*.24+mx*.35;   /* gentle sway keeps the emblem readable */
    capsule.rotation.x=Math.sin(t*.36)*.05+my*.12;

    /* film crossfade during the first 45% of each transition */
    const fadeT=i<KF.length-1?Math.min(tp/.45,1):1;
    const nextFilm=(i<KF.length-1&&b.film!==a.film)?b.film:null;
    setFilms(a.film,nextFilm,nextFilm===null?0:smooth(fadeT));

    /* veil dim */
    veil.material.opacity=lerp(a.dim,b.dim,tp);

    /* ambience */
    dust.rotation.y=t*.012;
    key.intensity=.85+Math.sin(t*.7)*.08;

    renderer.render(scene,cam);
    raf=requestAnimationFrame(frame);
  }

  measure();

  if(reduceMotion){
    /* calm editorial mode: static hero frame on gradients, no journey */
    stillRender=()=>renderer.render(scene,cam);   /* re-render once the emblem texture arrives */
    setFilms(0,null,0);
    veil.material.opacity=.5;
    capsule.position.set(isMobile?0:4.8,-.1,2); capsule.scale.setScalar(1.1);
    renderer.render(scene,cam);
    addEventListener("resize",()=>renderer.render(scene,cam),{passive:true});
    return;
  }

  document.addEventListener("visibilitychange",()=>{
    if(!document.hidden&&raf===null) raf=requestAnimationFrame(frame);
  });
  /* start once fonts settle so first paint is clean */
  raf=requestAnimationFrame(frame);
})();

})();
</script>

@include('partials.footer-legal-script')
</body>
</html>
