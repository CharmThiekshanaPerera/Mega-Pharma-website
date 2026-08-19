/* ============================================================
   1. TOKENS — TODO(brand): confirm exact logo hex values
   ============================================================ */
:root{
  --paper:#faf8f4; --paper-2:#f2efe8; --ink:#131a2e; --muted:#6f6a5e;
  --hair:#e2dccd; --red:#b5121b; --red-deep:#8c0e15;
  --navy:#1d3e7e; --navy-deep:#0f2050;
  --serif:"Cormorant Garamond",Georgia,serif;
  --sans:"Inter",system-ui,sans-serif;
  --ease:cubic-bezier(.22,.68,.24,1);
  --wrap:1240px;
}

/* ============================================================
   2. BASE
   ============================================================ */
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth}
@media (prefers-reduced-motion:reduce){
  html{scroll-behavior:auto}
  *,*::before,*::after{animation-duration:.01ms!important;animation-iteration-count:1!important;transition-duration:.01ms!important}
}
body{
  background:var(--paper);color:var(--ink);
  font-family:var(--sans);font-size:16px;line-height:1.7;
  -webkit-font-smoothing:antialiased;overflow-x:hidden;
}
img{max-width:100%;display:block}
a{color:inherit}
button{font:inherit;color:inherit;background:none;border:none;cursor:pointer}
::selection{background:var(--red);color:#fff}
:focus-visible{outline:2px solid var(--red);outline-offset:3px}
.skip-link{position:absolute;left:-9999px;top:0;z-index:600;background:var(--ink);color:var(--paper);padding:.7rem 1.2rem}
.skip-link:focus{left:0}
.wrap{max-width:var(--wrap);margin:0 auto;padding:0 clamp(1.2rem,4.5vw,3rem)}

/* ============================================================
   3. THE WORLD — fixed WebGL canvas + cinematic overlays
   ============================================================ */
#world{
  position:fixed;inset:0;z-index:0;pointer-events:none;
  /* graceful CSS fallback if WebGL/videos are unavailable */
  background:
    radial-gradient(60% 50% at 72% 34%,rgba(181,18,27,.06),transparent 70%),
    radial-gradient(50% 44% at 24% 70%,rgba(29,62,126,.07),transparent 72%),
    var(--paper);
}
#world canvas{display:block;width:100%;height:100%}

/* film grain + vignette for cinematic cohesion (grain texture from Higgsfield) */
#grain{
  position:fixed;inset:0;z-index:2;pointer-events:none;opacity:.5;
  background-image:var(--grain-url,none);
  background-size:cover;mix-blend-mode:multiply;
}
#vignette{
  position:fixed;inset:0;z-index:2;pointer-events:none;
  background:radial-gradient(120% 90% at 50% 46%,transparent 62%,rgba(19,26,46,.10) 100%);
}

/* ============================================================
   4. PRELOADER — real asset progress
   ============================================================ */
#loader{
  position:fixed;inset:0;z-index:500;background:var(--paper);
  display:flex;flex-direction:column;align-items:center;justify-content:center;gap:1.8rem;
}
#loader.done{animation:curtain 1s var(--ease) .15s forwards}
@keyframes curtain{to{transform:translateY(-101%)}}
.loader-mark{font-family:var(--serif);font-size:2rem;letter-spacing:.04em;display:flex;align-items:baseline;gap:.6rem}
.loader-mark b{font-weight:500}
.loader-mark span{font-family:var(--sans);font-size:.6rem;font-weight:600;letter-spacing:.44em;text-transform:uppercase;color:var(--muted)}
.loader-track{width:200px;height:1px;background:var(--hair);overflow:hidden}
.loader-bar{height:100%;width:0;background:var(--red);transition:width .35s ease}
.loader-pct{font-size:.62rem;font-weight:600;letter-spacing:.34em;color:var(--muted)}
@media (prefers-reduced-motion:reduce){#loader{display:none}}

/* ============================================================
   5. FIXED CHROME — nav · progress · chapter rail · scroll cue
   ============================================================ */
#progress{position:fixed;top:0;left:0;height:2px;width:0;background:var(--red);z-index:260}

.nav{position:fixed;inset:0 0 auto 0;z-index:250;border-bottom:1px solid transparent;transition:background .4s,border-color .4s}
.nav.scrolled{background:rgba(250,248,244,.82);backdrop-filter:blur(14px);-webkit-backdrop-filter:blur(14px);border-color:var(--hair)}
.nav-inner{max-width:var(--wrap);margin:0 auto;padding:1.05rem clamp(1.2rem,4.5vw,3rem);display:flex;align-items:center;justify-content:space-between;gap:1rem}
/* TODO(logo): replace wordmark with the official logo image */
.brand{font-family:var(--serif);font-size:1.28rem;text-decoration:none;display:flex;align-items:baseline;gap:.55rem}
.brand b{font-weight:600}
.brand span{font-family:var(--sans);font-size:.58rem;font-weight:600;letter-spacing:.42em;text-transform:uppercase;color:var(--muted)}
.nav-links{display:flex;gap:2rem;list-style:none;align-items:center}
.nav-links a{font-size:.68rem;font-weight:600;letter-spacing:.24em;text-transform:uppercase;color:var(--ink)}
.nav-cta{color:var(--red)!important}
.lnk{
  text-decoration:none;padding-bottom:2px;
  background-image:linear-gradient(currentColor,currentColor);
  background-size:0% 1px;background-repeat:no-repeat;background-position:left 100%;
  transition:background-size .45s var(--ease);
}
.lnk:hover,.lnk:focus-visible,.lnk[aria-current="true"]{background-size:100% 1px}

.nav-toggle{display:none;width:44px;height:44px;position:relative}
.nav-toggle span,.nav-toggle span::before,.nav-toggle span::after{content:"";position:absolute;left:11px;width:22px;height:1.6px;background:var(--ink);transition:transform .3s,top .3s,background .2s}
.nav-toggle span{top:21px}
.nav-toggle span::before{left:0;top:-7px}
.nav-toggle span::after{left:0;top:7px}
.nav-toggle[aria-expanded="true"] span{background:transparent}
.nav-toggle[aria-expanded="true"] span::before{top:0;transform:rotate(45deg)}
.nav-toggle[aria-expanded="true"] span::after{top:0;transform:rotate(-45deg)}
@media (max-width:900px){
  .nav-toggle{display:block}
  .nav-links{
    position:fixed;inset:66px 0 auto 0;flex-direction:column;align-items:flex-start;
    background:rgba(250,248,244,.97);backdrop-filter:blur(16px);
    padding:1.2rem clamp(1.2rem,4.5vw,3rem) 2rem;gap:1.1rem;border-bottom:1px solid var(--hair);
    opacity:0;transform:translateY(-10px);pointer-events:none;transition:opacity .3s,transform .3s;
  }
  .nav-links.open{opacity:1;transform:none;pointer-events:auto}
}

/* chapter rail — 01..07, right edge */
#rail{
  position:fixed;right:clamp(.7rem,2vw,1.6rem);top:50%;transform:translateY(-50%);
  z-index:240;display:flex;flex-direction:column;gap:1.05rem;
}
#rail a{
  display:flex;align-items:center;gap:.55rem;text-decoration:none;
  font-size:.58rem;font-weight:600;letter-spacing:.22em;color:var(--muted);
  transition:color .3s;
}
#rail a::before{content:"";width:14px;height:1px;background:var(--hair);transition:width .45s var(--ease),background .3s}
#rail a:hover{color:var(--ink)}
#rail a[aria-current="true"]{color:var(--red)}
#rail a[aria-current="true"]::before{width:30px;background:var(--red)}
#rail .rail-label{position:absolute;left:-9999px}
@media (max-width:900px){#rail{display:none}}

.scroll-cue{
  position:fixed;bottom:1.7rem;left:50%;transform:translateX(-50%);z-index:230;
  font-size:.6rem;font-weight:600;letter-spacing:.34em;text-transform:uppercase;color:var(--muted);
  display:flex;flex-direction:column;align-items:center;gap:.6rem;text-decoration:none;
  transition:opacity .5s;
}
.scroll-cue::after{content:"";width:1px;height:40px;background:linear-gradient(var(--red),transparent);animation:drip 2.4s ease-in-out infinite}
@keyframes drip{0%{transform:scaleY(.15);transform-origin:top}55%{transform:scaleY(1)}100%{opacity:0;transform:scaleY(1)}}
.scroll-cue.hide{opacity:0;pointer-events:none}

/* ============================================================
   6. CHAPTERS — content glides over the world
   ============================================================ */
main{position:relative;z-index:10}
.chapter{min-height:100svh;display:flex;align-items:center;position:relative;padding:7.5rem 0 6rem}
.chapter-inner{width:100%}

/* frosted panel keeps copy readable above film */
.pane{
  background:rgba(250,248,244,.66);
  backdrop-filter:blur(14px) saturate(1.05);-webkit-backdrop-filter:blur(14px) saturate(1.05);
  border:1px solid rgba(226,220,205,.8);border-radius:8px;
  padding:clamp(1.6rem,4vw,3rem);
  box-shadow:0 30px 70px -40px rgba(19,26,46,.25);
}
.pane--r{margin-left:auto;max-width:620px}
.pane--l{margin-right:auto;max-width:620px}
.pane--c{margin:0 auto;max-width:760px;text-align:left}

.eyebrow{
  display:flex;align-items:center;gap:1rem;margin-bottom:1.4rem;
  font-size:.66rem;font-weight:600;letter-spacing:.3em;text-transform:uppercase;color:var(--muted);
}
.eyebrow i{font-style:normal;color:var(--red);letter-spacing:.12em}
.eyebrow::after{content:"";flex:1;max-width:110px;height:1px;background:var(--hair)}
.chapter--medi .eyebrow i{color:var(--navy)}

h1,h2,h3{font-family:var(--serif);font-weight:500;line-height:1.06}
h1{font-size:clamp(2.9rem,7.6vw,5.8rem);letter-spacing:-.01em;max-width:13ch}
h1 em{font-style:italic;color:var(--red)}
h2{font-size:clamp(2rem,4.6vw,3.4rem);max-width:20ch}
.lede{color:#4d493f;max-width:56ch;margin-top:1.3rem;font-size:1.02rem}

.kicker{
  font-size:.66rem;font-weight:600;letter-spacing:.34em;text-transform:uppercase;color:var(--muted);
  display:flex;align-items:center;gap:1rem;margin-bottom:2rem;
}
.kicker::before{content:"";width:44px;height:1px;background:var(--red)}

/* reveal variants (scrollytelling) */
.rv{opacity:0;transform:translateY(30px);transition:opacity .9s var(--ease),transform .9s var(--ease)}
.rv[data-rv="left"]{transform:translateX(-40px)}
.rv[data-rv="right"]{transform:translateX(40px)}
.rv.in{opacity:1;transform:none}
@media (prefers-reduced-motion:reduce){.rv{opacity:1;transform:none}}

/* hero entries */
.hero-entries{display:flex;gap:0;margin-top:2.8rem;max-width:640px;border-top:1px solid var(--hair)}
.entry{flex:1;text-decoration:none;padding:1.4rem 1.5rem 1.4rem 0;position:relative}
.entry + .entry{border-left:1px solid var(--hair);padding-left:1.5rem}
.entry::before{content:"";position:absolute;top:-1px;left:0;height:1px;width:0;transition:width .5s var(--ease)}
.entry--pharma::before{background:var(--red)}
.entry--medi::before{background:var(--navy)}
.entry:hover::before{width:100%}
.entry small{font-size:.6rem;font-weight:600;letter-spacing:.3em;text-transform:uppercase;color:var(--muted)}
.entry h3{margin:.45rem 0 .3rem;font-size:1.5rem}
.entry p{color:var(--muted);font-size:.84rem;line-height:1.55}
.entry-go{display:inline-block;margin-top:.8rem;font-size:.7rem;font-weight:600;letter-spacing:.16em;text-transform:uppercase;transition:transform .4s var(--ease)}
.entry--pharma .entry-go{color:var(--red)}
.entry--medi .entry-go{color:var(--navy)}
.entry:hover .entry-go{transform:translateX(6px)}
@media (max-width:620px){
  .hero-entries{flex-direction:column;border-top:none}
  .entry{border-top:1px solid var(--hair);padding-left:0!important}
  .entry + .entry{border-left:none}
}

/* stats */
.stats{display:grid;grid-template-columns:repeat(auto-fit,minmax(150px,1fr));gap:0;margin-top:2.6rem;border-top:1px solid var(--hair)}
.stat{padding:1.4rem 1.2rem 0 0;border-right:1px solid var(--hair)}
.stat:last-child{border-right:none}
.stat b{font-family:var(--serif);font-weight:500;font-size:clamp(2.2rem,4vw,3rem);line-height:1;display:block}
.stat b i{font-style:normal;color:var(--red);font-size:.6em;vertical-align:.28em}
.stat span{display:block;margin-top:.6rem;font-size:.66rem;font-weight:600;letter-spacing:.22em;text-transform:uppercase}
.stat small{color:var(--muted);font-size:.74rem}
@media (max-width:640px){.stats{grid-template-columns:1fr 1fr}.stat{border-right:none;border-bottom:1px solid var(--hair);padding:1rem 0}}

.vm{display:grid;grid-template-columns:1fr 1fr;gap:1.8rem;margin-top:2.6rem}
.vm article{border-top:1px solid var(--ink);padding-top:1.1rem}
.vm h3{font-size:.66rem;font-family:var(--sans);font-weight:600;letter-spacing:.3em;text-transform:uppercase;color:var(--red)}
.vm article:last-child h3{color:var(--navy)}
.vm p{font-family:var(--serif);font-size:clamp(1.15rem,1.9vw,1.45rem);line-height:1.35;margin-top:.8rem}
@media (max-width:680px){.vm{grid-template-columns:1fr}}

/* founder message */
.founder-block{margin:2.6rem auto 0}
.founder-grid{display:grid;grid-template-columns:280px 1fr;gap:2.6rem;align-items:start}
@media (max-width:760px){.founder-grid{grid-template-columns:1fr}}
.founder-photo{margin:0;position:relative;border-radius:6px;overflow:hidden;background:var(--paper-2)}
.founder-photo img{width:100%;aspect-ratio:3/4;object-fit:cover;display:block}
.founder-photo-placeholder{
  width:100%;aspect-ratio:3/4;display:flex;align-items:center;justify-content:center;
  background:linear-gradient(160deg,var(--paper-2),var(--hair));
  color:var(--muted);font-size:.7rem;font-weight:600;letter-spacing:.16em;text-transform:uppercase;text-align:center;
}
.founder-photo figcaption{
  position:absolute;left:0;right:0;bottom:0;padding:1.1rem 1.2rem;
  background:linear-gradient(0deg,rgba(19,26,46,.82),rgba(19,26,46,0));
  display:flex;flex-direction:column;gap:.15rem;
}
.founder-photo figcaption strong{color:#fff;font-family:var(--serif);font-size:1.1rem;font-weight:600}
.founder-photo figcaption span{color:rgba(255,255,255,.75);font-size:.62rem;font-weight:600;letter-spacing:.14em;text-transform:uppercase}
.founder-photo figcaption em{color:rgba(255,255,255,.6);font-style:normal;font-size:.66rem;margin-top:.2rem}
.founder-copy h3{font-size:clamp(1.5rem,2.6vw,2rem);margin-top:.2rem}
.founder-copy p{color:#4d493f;font-size:.94rem;line-height:1.65;margin-top:1rem}
.founder-copy blockquote{
  margin:1.6rem 0 0;padding-left:1.2rem;border-left:2px solid var(--red);
  font-family:var(--serif);font-style:italic;font-size:1.08rem;line-height:1.5;
}
.founder-copy blockquote cite{display:block;margin-top:.6rem;font-family:var(--sans);font-style:normal;font-size:.7rem;font-weight:600;letter-spacing:.12em;text-transform:uppercase;color:var(--muted)}

/* house facts */
.house-num{
  font-family:var(--serif);font-style:italic;font-weight:400;
  font-size:clamp(3rem,5.4vw,4.4rem);line-height:1;display:block;margin-bottom:.8rem;
  color:transparent;-webkit-text-stroke:1px rgba(181,18,27,.45);
}
.chapter--medi .house-num{-webkit-text-stroke:1px rgba(29,62,126,.45)}
.co-tags{display:flex;flex-wrap:wrap;gap:.4rem .9rem;margin-top:1.4rem;list-style:none}
.co-tags li{font-size:.64rem;font-weight:600;letter-spacing:.18em;text-transform:uppercase;color:var(--muted);display:flex;align-items:center;gap:.5rem}
.co-tags li::before{content:"";width:4px;height:4px;border-radius:50%;background:var(--red)}
.chapter--medi .co-tags li::before{background:var(--navy)}
.facts{margin-top:1.8rem;border-top:1px solid var(--ink)}
.fact{display:flex;gap:1.2rem;align-items:baseline;padding:1.05rem 0;border-bottom:1px solid var(--hair);transition:padding-left .4s var(--ease)}
.fact:hover{padding-left:.55rem}
.fact b{font-family:var(--serif);font-weight:500;font-size:1.9rem;line-height:1;min-width:3.2ch;color:var(--red)}
.chapter--medi .fact b{color:var(--navy)}
.fact span{font-weight:600;font-size:.88rem;display:block}
.fact small{color:var(--muted);font-size:.78rem;line-height:1.5;display:block;margin-top:.1rem}
.co-link{display:inline-block;margin-top:1.6rem;font-size:.7rem;font-weight:600;letter-spacing:.2em;text-transform:uppercase;color:var(--red)}
.chapter--medi .co-link{color:var(--navy)}

/* ============================================================
   7. COLLECTIONS — interactive product explorer chapter
   ============================================================ */
/* THE LIGHT LOOK — Collections rests on clean paper (the film pane dissolves),
   a calm catalogue "reading room" that rises over the cinematic world. */
#collections{
  display:block;padding:clamp(5rem,9vw,7.5rem) 0 7rem;
  /* was a fully opaque var(--paper-2) — that sat above #world (z-index:0)
     and hid the cinematic backdrop completely no matter the veil dim set
     in the KF timeline. Translucent instead, so the world stays visible
     through the gaps; individual .card elements are still opaque white,
     so the product grid itself stays fully legible. */
  background:rgba(242,239,232,.55);position:relative;z-index:11;
  backdrop-filter:blur(10px) saturate(1.05);-webkit-backdrop-filter:blur(10px) saturate(1.05);
  box-shadow:0 -34px 66px -38px rgba(19,26,46,.35),0 34px 66px -38px rgba(19,26,46,.35);
}
#collections .pane{
  max-width:none;background:transparent;border:none;box-shadow:none;border-radius:0;
  padding:0;backdrop-filter:none;-webkit-backdrop-filter:none;
}
.prod-head{display:flex;justify-content:space-between;align-items:flex-end;gap:2rem;flex-wrap:wrap}
.prod-note{font-size:.76rem;color:var(--muted);max-width:36ch;border-left:2px solid var(--red);padding-left:1rem}

.prod-controls{
  position:sticky;top:64px;z-index:60;margin-top:2.4rem;
  background:var(--paper-2);
  border-top:1px solid var(--hair);border-bottom:1px solid var(--hair);
  padding:.95rem 0;display:flex;flex-direction:column;gap:.85rem;
}
.prod-row{display:flex;gap:1.5rem;flex-wrap:wrap;align-items:center}
.tabs{display:flex;flex-wrap:wrap;gap:.6rem 1.7rem}
.tab{position:relative;padding:.4rem 0;font-size:.7rem;font-weight:600;letter-spacing:.22em;text-transform:uppercase;color:var(--muted);transition:color .3s}
.tab::after{content:"";position:absolute;left:0;bottom:0;height:2px;width:0;background:var(--red);transition:width .45s var(--ease)}
.tab:hover{color:var(--ink)}
.tab[aria-selected="true"]{color:var(--ink)}
.tab[aria-selected="true"]::after{width:100%}
.tab[data-co="meditech"]::after{background:var(--navy)}
.search-box{position:relative;flex:1;min-width:210px;max-width:360px}
.search-box svg{position:absolute;left:0;top:50%;transform:translateY(-50%);opacity:.45;transition:opacity .3s,transform .3s}
.search-box:focus-within svg{opacity:1;transform:translateY(-50%) scale(1.12)}
.search-box input{
  width:100%;background:transparent;border:none;border-bottom:1px solid var(--hair);
  padding:.5rem .2rem .5rem 1.7rem;color:var(--ink);font:inherit;font-size:.9rem;transition:border-color .3s;border-radius:0;
}
.search-box input::placeholder{color:var(--muted)}
.search-box input:focus{outline:none;border-color:var(--red)}
@media (max-width:760px){.search-box input{font-size:16px}}
.prod-count{font-size:.66rem;font-weight:600;letter-spacing:.2em;text-transform:uppercase;color:var(--muted);margin-left:auto}
.chips{display:flex;gap:.4rem;flex-wrap:wrap}
.chip{
  font-size:.64rem;font-weight:600;letter-spacing:.12em;text-transform:uppercase;
  border:1px solid var(--hair);border-radius:999px;padding:.4rem .9rem;color:var(--muted);
  transition:all .3s var(--ease);
}
.chip:hover{border-color:var(--ink);color:var(--ink);transform:translateY(-2px)}
.chip[aria-pressed="true"]{background:var(--ink);border-color:var(--ink);color:var(--paper)}

.pgroup{margin-top:2.8rem}
.pgroup-head{display:flex;align-items:baseline;gap:1.1rem;margin-bottom:1.2rem}
.pgroup-head h3{font-size:clamp(1.4rem,2.4vw,1.85rem);font-weight:500}
.pgroup-head .g-co{font-size:.58rem;font-weight:600;letter-spacing:.26em;text-transform:uppercase}
.pgroup-head .g-co.pharma{color:var(--red)}
.pgroup-head .g-co.meditech{color:var(--navy)}
.pgroup-head .g-count{font-size:.68rem;color:var(--muted);letter-spacing:.1em}
.pgroup-head::after{content:"";flex:1;height:1px;background:var(--hair);align-self:center}

.grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(252px,1fr));gap:1rem}
@keyframes cardin{from{opacity:0;transform:translateY(18px)}to{opacity:1;transform:none}}
.grid .card{animation:cardin .55s var(--ease) both}
@media (prefers-reduced-motion:reduce){.grid .card{animation:none}}
.card{
  text-decoration:none;text-align:left;background:#fff;border:1px solid var(--hair);border-radius:4px;
  padding:1.35rem 1.35rem 1.15rem;display:flex;flex-direction:column;gap:.45rem;min-height:176px;position:relative;
  transition:transform .4s var(--ease),box-shadow .4s,border-color .4s;
  transform-style:preserve-3d;will-change:transform;
}
.card:hover{box-shadow:0 22px 44px -22px rgba(19,26,46,.3)}
.card[data-co="pharma"]:hover{border-color:rgba(181,18,27,.45)}
.card[data-co="meditech"]:hover{border-color:rgba(29,62,126,.45)}
.card::after{content:"";position:absolute;top:1.2rem;right:1.15rem;width:6px;height:6px;border-radius:50%}
.card[data-co="pharma"]::after{background:var(--red)}
.card[data-co="meditech"]::after{background:var(--navy)}
.card.has-img::after{display:none}
.card-img{width:calc(100% + 2.7rem);height:150px;object-fit:cover;margin:-1.35rem -1.35rem .3rem;border-radius:4px 4px 0 0;display:block;background:var(--paper-2)}
.card-cat{font-size:.56rem;font-weight:600;letter-spacing:.24em;text-transform:uppercase;color:var(--muted);padding-right:1.4rem}
.card-name{font-family:var(--serif);font-size:1.32rem;font-weight:600;line-height:1.15}
.card .generic{font-size:.78rem;color:var(--muted);line-height:1.5;flex:1}
.card .meta{font-size:.66rem;color:var(--muted);border-top:1px solid var(--hair);padding-top:.55rem;display:flex;justify-content:space-between;gap:.6rem;letter-spacing:.04em}
.card .meta em{font-style:normal;color:var(--ink);white-space:nowrap;overflow:hidden;text-overflow:ellipsis}

.sk{background:#fff;border:1px solid var(--hair);border-radius:4px;min-height:170px;padding:1.25rem;display:flex;flex-direction:column;gap:.75rem}
.sk i{display:block;border-radius:3px;background:linear-gradient(100deg,var(--paper-2) 32%,#fff 48%,var(--paper-2) 64%);background-size:220% 100%;animation:shimmer 1.3s linear infinite}
@keyframes shimmer{to{background-position:-120% 0}}
.sk i:nth-child(1){height:8px;width:38%}
.sk i:nth-child(2){height:19px;width:72%}
.sk i:nth-child(3){height:10px;width:88%;flex:0}
.sk i:nth-child(4){height:10px;width:60%}
.sk i:nth-child(5){height:9px;width:100%;margin-top:auto}
@media (prefers-reduced-motion:reduce){.sk i{animation:none}}
.grid-empty{grid-column:1/-1;text-align:center;color:var(--muted);border:1px dashed var(--hair);border-radius:4px;padding:3.2rem 1rem;background:#fff}
.grid-empty b{font-family:var(--serif);font-size:1.3rem;color:var(--ink);display:block;margin-bottom:.3rem;font-weight:500}

/* ============================================================
   8. STANDARDS + CONTACT + FOOTER
   ============================================================ */
.values{display:grid;grid-template-columns:1fr 1fr;gap:0;margin-top:2.4rem;border-top:1px solid var(--ink)}
.value{padding:1.4rem 1.6rem 1.4rem 0;border-bottom:1px solid var(--hair);display:grid;grid-template-columns:auto 1fr;gap:1.1rem;transition:padding-left .4s var(--ease)}
.value:hover{padding-left:.6rem}
.value:nth-child(odd){border-right:1px solid var(--hair)}
.value:nth-child(even){padding-left:1.6rem}
.value:nth-child(even):hover{padding-left:2.2rem}
.value i{font-style:italic;font-family:var(--serif);font-size:1.1rem;color:var(--red);line-height:1.9}
.value h3{font-size:1rem;font-weight:600;font-family:var(--sans)}
.value p{color:var(--muted);font-size:.82rem;margin-top:.4rem}
@media (max-width:760px){
  .values{grid-template-columns:1fr}
  .value:nth-child(odd){border-right:none}
  .value:nth-child(even){padding-left:0}
}
.partner-marquee{margin-top:2.8rem;width:100%;overflow:hidden;-webkit-mask-image:linear-gradient(to right,transparent,#000 8%,#000 92%,transparent);mask-image:linear-gradient(to right,transparent,#000 8%,#000 92%,transparent)}
.partner-track{display:flex;width:max-content;animation:partner-scroll 38s linear infinite}
.partner-marquee:hover .partner-track{animation-play-state:paused}
.partner-list{display:flex;align-items:center;list-style:none}
.partner-list li{display:flex;align-items:center;justify-content:center;height:72px;padding:0 2.3rem;position:relative}
.partner-list li::after{content:"·";position:absolute;right:0;color:var(--hair)}
.partner-list li span{font-family:var(--serif);font-size:1.14rem;font-weight:500;color:var(--muted);white-space:nowrap;transition:color .35s}
.partner-list li:hover span{color:var(--ink)}
.partner-list li img{height:52px;max-width:190px;width:auto;object-fit:contain;opacity:1;transition:transform .35s}
.partner-list li:hover img{transform:scale(1.06)}
@keyframes partner-scroll{from{transform:translateX(-50%)}to{transform:translateX(0)}}
@media (prefers-reduced-motion:reduce){.partner-track{animation:none}}

.contact-grid{display:grid;grid-template-columns:.9fr 1.1fr;gap:clamp(1.8rem,4vw,3.4rem);margin-top:2.4rem}
@media (max-width:900px){.contact-grid{grid-template-columns:1fr}}
.c-item{display:flex;gap:1.1rem;padding:1.05rem 0;border-bottom:1px solid var(--hair)}
.c-item:first-child{padding-top:0}
.c-item i{flex:none;width:38px;height:38px;border-radius:50%;display:grid;place-items:center;font-style:normal;border:1px solid var(--hair);background:#fff;transition:transform .35s var(--ease),border-color .3s}
.c-item:hover i{transform:scale(1.12);border-color:var(--red)}
.c-item b{display:block;font-size:.6rem;letter-spacing:.26em;text-transform:uppercase;color:var(--muted);font-weight:600;margin-bottom:.15rem}
.c-item a{text-decoration:none}
.c-item p,.c-item address{font-style:normal;font-size:.9rem;line-height:1.6}

.cform{background:#fff;border:1px solid var(--hair);border-radius:6px;padding:clamp(1.5rem,3.2vw,2.2rem)}
.cform h3{margin-bottom:1.4rem;font-weight:500}
.f-row{display:grid;grid-template-columns:1fr 1fr;gap:1.1rem}
@media (max-width:560px){.f-row{grid-template-columns:1fr}}
.f-group{margin-bottom:1.1rem}
.f-group label{display:block;font-size:.6rem;font-weight:600;letter-spacing:.24em;text-transform:uppercase;margin-bottom:.35rem;color:var(--muted)}
.f-group input,.f-group select,.f-group textarea{
  width:100%;background:transparent;border:none;border-bottom:1px solid var(--hair);
  padding:.55rem .1rem;color:var(--ink);font:inherit;font-size:.92rem;transition:border-color .3s;border-radius:0;
}
.f-group textarea{resize:vertical;min-height:96px}
.f-group :is(input,select,textarea):focus{outline:none;border-bottom-color:var(--red)}
.btn{
  position:relative;overflow:hidden;display:inline-flex;align-items:center;gap:.7rem;
  background:var(--ink);color:var(--paper);border-radius:999px;
  padding:.9rem 2.1rem;font-size:.76rem;font-weight:600;letter-spacing:.18em;text-transform:uppercase;
  transition:background .35s,transform .35s var(--ease),box-shadow .35s;
}
.btn:hover{background:var(--red);transform:translateY(-2px);box-shadow:0 16px 32px -16px rgba(181,18,27,.5)}
.btn .ripple{position:absolute;border-radius:50%;pointer-events:none;background:rgba(255,255,255,.35);transform:scale(0);animation:ripple .65s var(--ease) forwards}
@keyframes ripple{to{transform:scale(3.4);opacity:0}}
.form-status{margin-top:.9rem;font-size:.84rem;color:var(--red);min-height:1.4em}
.form-status.ok{color:var(--navy)}
.btn[disabled]{opacity:.55;cursor:progress}
.btn[disabled]:hover{background:var(--ink);transform:none;box-shadow:none}
.hp-field{position:absolute!important;left:-9999px!important;width:1px;height:1px;overflow:hidden}
.foot-legal{background:none;border:0;margin:0;padding:0 0 2px;font:inherit;font-size:.88rem;color:#c6cfe6;cursor:pointer;text-align:left}
.legal-body p{margin-top:.75rem;font-size:.9rem;line-height:1.62}
.legal-body p:first-child{margin-top:0}
.legal-body h4{font-family:var(--sans);font-size:.6rem;font-weight:600;letter-spacing:.24em;text-transform:uppercase;color:var(--red);margin-top:1.35rem}
.legal-body .modal-note{margin-top:1.4rem}

footer{position:relative;z-index:10;background:var(--navy-deep);color:#e9ecf5;padding:4rem 0 2.4rem}
.foot-grid{display:grid;grid-template-columns:1.5fr 1fr 1fr 1fr;gap:2.2rem}
@media (max-width:860px){.foot-grid{grid-template-columns:1fr 1fr}}
@media (max-width:520px){.foot-grid{grid-template-columns:1fr}}
.foot-grid h4{font-size:.6rem;letter-spacing:.3em;text-transform:uppercase;color:#8fa0c9;font-weight:600;margin-bottom:1.1rem}
.foot-grid ul{list-style:none;display:grid;gap:.55rem}
.foot-grid a{font-size:.88rem;color:#c6cfe6}
.foot-grid .lnk:hover{color:#fff}
.foot-logo{width:46px;height:auto;display:block;margin-bottom:1.1rem;filter:drop-shadow(0 0 0 rgba(181,18,27,0));animation:footLogoPulse 4.4s ease-in-out infinite;transition:filter .5s var(--ease),transform .5s var(--ease)}
.foot-brand:hover .foot-logo{filter:drop-shadow(0 0 20px rgba(181,18,27,.55));transform:translateY(-2px)}
@keyframes footLogoPulse{0%,100%{transform:scale(1);filter:drop-shadow(0 0 0 rgba(181,18,27,0))}50%{transform:scale(1.045);filter:drop-shadow(0 0 12px rgba(181,18,27,.4))}}
.foot-brand .brand{color:#fff}
.foot-brand .brand span{color:#8fa0c9}
.foot-brand p{color:#9daac9;font-size:.84rem;margin-top:1rem;max-width:36ch}
.foot-base{margin-top:2.8rem;padding-top:1.4rem;border-top:1px solid rgba(255,255,255,.14);display:flex;justify-content:space-between;gap:1rem;flex-wrap:wrap;font-size:.74rem;color:#8fa0c9}

/* ============================================================
   9. MODAL
   ============================================================ */
.modal{position:fixed;inset:0;z-index:300;display:none;align-items:center;justify-content:center;padding:1.2rem}
.modal.open{display:flex}
.modal-backdrop{position:absolute;inset:0;background:rgba(19,26,46,.42);backdrop-filter:blur(5px)}
.modal-panel{
  position:relative;width:min(580px,100%);max-height:86svh;overflow:auto;background:var(--paper);
  border:1px solid var(--hair);border-radius:6px;padding:2.3rem 2.3rem 1.9rem;
  animation:pop .45s var(--ease);
}
@keyframes pop{from{opacity:0;transform:translateY(24px)}to{opacity:1;transform:none}}
@media (prefers-reduced-motion:reduce){.modal-panel{animation:none}}
.modal-close{position:absolute;top:1rem;right:1rem;width:42px;height:42px;border-radius:50%;border:1px solid var(--hair);display:grid;place-items:center;font-size:1rem;transition:transform .35s var(--ease),border-color .3s}
.modal-close:hover{transform:rotate(90deg);border-color:var(--ink)}
.modal-co{font-size:.6rem;font-weight:600;letter-spacing:.3em;text-transform:uppercase;display:inline-block;margin-bottom:1rem}
.modal-co.pharma{color:var(--red)}
.modal-co.meditech{color:var(--navy)}
.modal-panel h3{font-size:2rem;font-weight:500}
.modal-generic{color:var(--muted);font-size:.94rem;margin-top:.3rem}
.modal-desc{margin-top:1.1rem;font-size:.93rem}
.modal-specs{margin-top:1.4rem;border-top:1px solid var(--ink);font-size:.8rem}
.modal-specs div{display:flex;gap:1.2rem;padding:.65rem 0;justify-content:space-between;border-bottom:1px solid var(--hair)}
.modal-specs span{color:var(--muted);letter-spacing:.2em;text-transform:uppercase;font-size:.58rem;font-weight:600;padding-top:.2em;flex:none}
.modal-specs em{font-style:normal;text-align:right}
.modal-note{margin-top:1.1rem;font-size:.7rem;color:var(--muted)}

/* ---------- brochure-style product sections ---------- */
.product-hero-media{flex:0 0 340px;max-width:100%}
.product-hero-media img{width:100%;border-radius:6px;background:var(--paper-2);display:block}
.product-hero-award{display:flex;align-items:center;gap:.8rem;margin-top:1.1rem;padding:.8rem 1rem;background:#fff;border:1px solid var(--hair);border-radius:4px}
.product-hero-award img{width:44px;height:44px;object-fit:contain;border-radius:0;background:none}
.product-hero-award strong{display:block;font-size:.72rem;font-weight:600;line-height:1.3}
.product-hero-award span{display:block;font-size:.62rem;color:var(--muted);margin-top:.15rem}
.brochure-tagline{font-family:var(--serif);font-style:italic;font-size:1.2rem;color:var(--red);margin-top:.9rem;max-width:56ch}
.brochure-components{display:grid;grid-template-columns:repeat(3,1fr);gap:1.6rem;margin-top:2rem}
@media (max-width:820px){.brochure-components{grid-template-columns:1fr}}
.brochure-component{border-top:1px solid var(--ink);padding-top:1rem}
.brochure-component-n{font-family:var(--serif);font-size:1.6rem;color:var(--muted);display:block}
.brochure-component h3{font-family:var(--serif);font-size:1.08rem;font-weight:600;margin-top:.3rem}
.brochure-component p{font-size:.84rem;color:var(--muted);margin-top:.5rem;line-height:1.55}
.brochure-callout{margin-top:2rem;padding:1rem 1.3rem;background:var(--paper-2);border-left:3px solid var(--navy);font-size:.88rem;font-weight:500}
.brochure-highlights{display:grid;grid-template-columns:repeat(2,1fr);gap:1.6rem;margin-top:2rem}
@media (max-width:820px){.brochure-highlights{grid-template-columns:1fr}}
.brochure-highlight{background:#fff;border:1px solid var(--hair);border-radius:4px;padding:1.3rem 1.4rem}
.brochure-highlight h3{font-family:var(--serif);font-size:1.05rem;font-weight:600;letter-spacing:.02em}
.brochure-highlight ul{margin-top:.7rem;padding-left:1.1rem;font-size:.84rem;color:var(--muted);line-height:1.7}
.brochure-highlight ul.has-icons{list-style:none;padding-left:0;display:flex;flex-direction:column;gap:.7rem}
.brochure-highlight ul.has-icons li{display:flex;align-items:center;gap:.7rem}
.brochure-highlight ul.has-icons img{width:26px;height:26px;object-fit:contain;flex:none}
.brochure-highlight p{margin-top:.7rem;font-size:.84rem;color:var(--muted);line-height:1.6}
.brochure-spec-table{width:100%;border-collapse:collapse;margin-top:1.6rem;font-size:.82rem}
.brochure-spec-table caption{text-align:left;font-size:.6rem;font-weight:600;letter-spacing:.26em;text-transform:uppercase;color:var(--muted);padding-bottom:.6rem;caption-side:top}
.brochure-spec-table th,.brochure-spec-table td{padding:.6rem 0;border-bottom:1px solid var(--hair);text-align:left;font-weight:400}
.brochure-spec-table th{color:var(--muted);width:46%}
.brochure-spec-table td{color:var(--ink)}
@media (max-width:600px){
  .product-hero-media{flex-basis:100%}
  .product-hero-award{flex-wrap:wrap}
  .brochure-spec-table,.brochure-spec-table tbody,.brochure-spec-table tr{display:block}
  .brochure-spec-table tr{padding:.6rem 0;border-bottom:1px solid var(--hair)}
  .brochure-spec-table th,.brochure-spec-table td{display:block;padding:0;border:none;width:auto}
  .brochure-spec-table td{margin-top:.15rem}
}
.brochure-mfr-info{margin-top:1.8rem;padding-top:1.2rem;border-top:1px solid var(--hair);font-size:.72rem;color:var(--muted);line-height:1.7}

.chapter--partners{min-height:0;padding:5rem 0;display:block}
.chapter--partners .pane--c{text-align:center;margin:0 auto;max-width:640px}
.chapter--partners .eyebrow{justify-content:center}
.chapter--partners .eyebrow::after{display:none}

/* reduced motion: calm editorial page, world becomes still */
@media (prefers-reduced-motion:reduce){
  .scroll-cue{display:none}
}
