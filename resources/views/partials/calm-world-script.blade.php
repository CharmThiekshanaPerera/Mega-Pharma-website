<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
<script>
/* ==================================================================
   THE ENGINE (single-scene edition) — preloader · chrome · calm world
   Trimmed from the homepage engine: same building blocks (renderer,
   lights, protagonist emblem, grain, dust) but with a FIXED camera —
   there's only one scene here, not seven chapters to scroll through —
   and no Higgsfield video film (just the existing gradient-texture
   fallback), so 129 product pages don't each stream video.
   ================================================================== */
(function(){
"use strict";
const $  = (s,el=document)=>el.querySelector(s);
const $$ = (s,el=document)=>[...el.querySelectorAll(s)];
const reduceMotion = matchMedia("(prefers-reduced-motion: reduce)").matches;
const isMobile = matchMedia("(max-width:760px)").matches;

const ASSETS = {
  grain: "https://d8j0ntlcm91z4.cloudfront.net/user_3CB7QbfiArx9VIufTgzDQat3bei/hf_20260707_041352_4f89a8e3-528c-4b5e-8005-7c8026577193.png"
};

/* ==================================================================
   PRELOADER
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

if(!reduceMotion){
  const fDone = trackItem();
  if(document.fonts && document.fonts.ready) document.fonts.ready.then(fDone).catch(fDone);
  else fDone();
  setTimeout(revealSite, 9000);
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
   CHROME — nav toggle, reveal-on-scroll, scroll shadow / progress
   ================================================================== */
const nav = $("#nav"), navToggle = $("#navToggle"), navLinks = $("#navLinks");
const progress = $("#progress");

navToggle.addEventListener("click", ()=>{
  const open = navLinks.classList.toggle("open");
  navToggle.setAttribute("aria-expanded", open);
  navToggle.setAttribute("aria-label", open ? "Close menu" : "Open menu");
});
navLinks.addEventListener("click", e=>{ if(e.target.closest("a")){ navLinks.classList.remove("open"); navToggle.setAttribute("aria-expanded","false"); } });

addEventListener("scroll",()=>{
  const y=scrollY;
  const max=document.documentElement.scrollHeight-innerHeight;
  progress.style.width=(max>0?(y/max)*100:0)+"%";
  nav.classList.toggle("scrolled",y>24);
},{passive:true});

const revealIO = new IntersectionObserver(entries=>{
  let i=0;
  entries.forEach(en=>{
    if(!en.isIntersecting) return;
    en.target.style.transitionDelay = Math.min(i++*90,360)+"ms";
    en.target.classList.add("in");
    revealIO.unobserve(en.target);
  });
},{threshold:.14,rootMargin:"0px 0px -6% 0px"});
function revealIfVisible(el){
  const r=el.getBoundingClientRect();
  if(r.bottom>0&&r.top<innerHeight){ el.classList.add("in"); revealIO.unobserve(el); return true; }
  return false;
}
$$(".rv").forEach(el=>revealIO.observe(el));
$$(".rv").forEach(revealIfVisible);
setTimeout(()=>{ $$(".rv:not(.in)").forEach(el=>{ el.classList.add("in"); revealIO.unobserve(el); }); },2500);

/* ripple micro-interaction (same as home) */
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

if(!reduceMotion&&matchMedia("(hover:hover) and (pointer:fine)").matches){
  $$(".card").forEach(card=>{
    card.addEventListener("pointermove",e=>{
      const r=card.getBoundingClientRect();
      const rx=((e.clientY-r.top)/r.height-.5)*-5, ry=((e.clientX-r.left)/r.width-.5)*7;
      card.style.transform="perspective(760px) rotateX("+rx.toFixed(2)+"deg) rotateY("+ry.toFixed(2)+"deg) translateY(-3px)";
    });
    card.addEventListener("pointerout",()=>{ card.style.transform=""; });
  });
}

/* ==================================================================
   THE CALM WORLD — same building blocks as the homepage, fixed camera
   ================================================================== */
(function world(){
  const host=$("#world");
  if(!window.THREE||!host) return;
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
  cam.lookAt(0,0,-7);

  scene.add(new THREE.AmbientLight(0xffffff,.75));
  /* this product's own brand colours — pharma red / meditech navy by
     default, or a specific product's real brand colour (see
     Product::getThemeColorsAttribute()) */
  const THEME_A = @json($themeColors[0]);
  const THEME_B = @json($themeColors[1]);

  const key=new THREE.DirectionalLight(0xfff6ea,.9);  key.position.set(6,9,7);   scene.add(key);
  const fill=new THREE.PointLight(0x1d3e7e,.25,40);   fill.position.set(-7,-3,5); scene.add(fill);
  const rim=new THREE.PointLight(new THREE.Color(THEME_B),.35,40); rim.position.set(0,4,-6); scene.add(rim);

  /* single calm gradient screen — no video film on product pages */
  const SCREEN_Z=-14;
  function gradientTexture(a,b){
    const c=document.createElement("canvas"); c.width=64; c.height=36;
    const x=c.getContext("2d");
    const g=x.createLinearGradient(0,0,64,36);
    g.addColorStop(0,a); g.addColorStop(1,b);
    x.fillStyle=g; x.fillRect(0,0,64,36);
    return new THREE.CanvasTexture(c);
  }
  const screen=new THREE.Mesh(
    new THREE.PlaneGeometry(1,1,1,1),
    new THREE.MeshBasicMaterial({map:gradientTexture(THEME_A,THEME_B),transparent:true,opacity:1,depthWrite:false})
  );
  screen.position.z=SCREEN_Z; scene.add(screen);
  function fitScreen(){
    const dist=cam.position.z-SCREEN_Z;
    const h=2*dist*Math.tan(THREE.MathUtils.degToRad(cam.fov/2))*1.4;
    const w=h*(innerWidth/innerHeight)*1.15;
    screen.scale.set(w,h,1);
  }

  /* paper veil — calm, keeps the content pane legible */
  const veil=new THREE.Mesh(
    new THREE.PlaneGeometry(1,1),
    new THREE.MeshBasicMaterial({color:0xfaf8f4,transparent:true,opacity:.55,depthWrite:false})
  );
  veil.position.z=SCREEN_Z+.5; scene.add(veil);
  function fitVeil(){ veil.scale.copy(screen.scale); }

  /* ---------- the protagonist: the official Mega Pharma emblem ---------- */
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

  let mx=0,my=0;
  if(!reduceMotion){
    addEventListener("pointermove",e=>{ mx=e.clientX/innerWidth-.5; my=e.clientY/innerHeight-.5; },{passive:true});
  }

  function resize(){
    cam.aspect=innerWidth/innerHeight; cam.updateProjectionMatrix();
    renderer.setSize(innerWidth,innerHeight);
    fitScreen(); fitVeil();
  }
  addEventListener("resize",resize,{passive:true});
  resize();

  capsule.position.set(isMobile?0:3.6,0,0);
  capsule.scale.setScalar(1.05);

  if(reduceMotion){
    stillRender=()=>renderer.render(scene,cam);
    renderer.render(scene,cam);
    return;
  }

  const clock=new THREE.Clock();
  let raf=null;
  function frame(){
    raf=null;
    if(document.hidden) return;
    const t=clock.getElapsedTime();

    cam.position.x=mx*.5; cam.position.y=-my*.35;
    cam.lookAt(0,0,-7);

    capsule.rotation.y=Math.sin(t*.5)*.2+mx*.3;
    capsule.rotation.x=Math.sin(t*.36)*.05+my*.1;

    dust.rotation.y=t*.012;
    key.intensity=.85+Math.sin(t*.7)*.08;

    renderer.render(scene,cam);
    raf=requestAnimationFrame(frame);
  }
  document.addEventListener("visibilitychange",()=>{
    if(!document.hidden&&raf===null) raf=requestAnimationFrame(frame);
  });
  raf=requestAnimationFrame(frame);
})();

})();
</script>
