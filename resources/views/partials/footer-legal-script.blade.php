<script>
(function(){
"use strict";
const $  = (s,el=document)=>el.querySelector(s);
const $$ = (s,el=document)=>[...el.querySelectorAll(s)];

const yearEl = $("#year");
if (yearEl) yearEl.textContent = new Date().getFullYear();

/* ==================================================================
   LEGAL / REGULATORY — Privacy · Terms · Pharmacovigilance
   Template copy for review by Mega Pharma Group before go-live.
   ================================================================== */
const LEGAL={
  privacy:{k:"Privacy",t:"Privacy policy",h:
    '<p>Mega Pharma Group respects the privacy of every visitor, healthcare professional and partner who contacts us through this website.</p>'+
    '<h4>What we collect</h4><p>When you use the enquiry form we receive the name, email address, enquiry category and message you provide. This site uses no advertising or tracking cookies.</p>'+
    '<h4>How we use it</h4><p>Your details are used only to respond to your enquiry and, where relevant, to route it to the correct house — Mega Pharma or Mega Meditech. We never sell or rent personal information.</p>'+
    '<h4>Retention &amp; your rights</h4><p>Correspondence is kept only as long as needed to serve your request and meet our record-keeping obligations. To access, correct or delete your information, write to <a class="lnk" href="mailto:info@megapharma.lk">info@megapharma.lk</a>.</p>'+
    '<p class="modal-note">Template summary — to be reviewed by Mega Pharma Group’s legal team before publication.</p>'},
  terms:{k:"Legal",t:"Terms of use",h:
    '<p>This website is provided for general information about Mega Pharma Group and its portfolio.</p>'+
    '<h4>Not medical advice</h4><p>Product information is intended for healthcare professionals; prescription medicines are promoted ethically, to the profession only. Nothing here substitutes for professional diagnosis, prescribing or device training — always refer to the approved prescribing or instructions-for-use documentation.</p>'+
    '<h4>Intellectual property</h4><p>Brand names, logos and content are the property of Mega Pharma (Pvt) Ltd. or its principals and may not be reproduced without permission.</p>'+
    '<h4>External links &amp; availability</h4><p>We are not responsible for the content of third-party sites, and provide this site without warranty as to uninterrupted availability.</p>'+
    '<p class="modal-note">Template summary — to be reviewed by Mega Pharma Group’s legal team before publication.</p>'},
  pv:{k:"Patient safety",t:"Pharmacovigilance &amp; adverse event reporting",h:
    '<p>Patient safety is central to how we work. If you have experienced or observed a side effect, adverse drug reaction, product-quality issue or medical-device incident involving a Mega Pharma Group product, please tell us.</p>'+
    '<h4>How to report</h4><p>Email <a class="lnk" href="mailto:info@megapharma.lk">info@megapharma.lk</a> or call <a class="lnk" href="tel:+94114203596">+94 11 420 3596</a> with the product name, batch number if available, and a description of what happened. Reports may be made by healthcare professionals, patients and carers.</p>'+
    '<h4>Regulatory reporting</h4><p>Serious adverse reactions should also be reported to the National Medicines Regulatory Authority (NMRA) of Sri Lanka. We cooperate fully with the NMRA and our principals on every safety report we receive.</p>'+
    '<p class="modal-note">Template guidance — to be reviewed by Mega Pharma Group’s regulatory / pharmacovigilance team before publication.</p>'}
};
const legalModal=$("#legalModal"), legalPanel=$(".modal-panel",legalModal);
let lastLegalFocus=null;
function openLegal(key){
  const d=LEGAL[key]; if(!d) return;
  lastLegalFocus=document.activeElement;
  $("#legalKicker").textContent=d.k;
  $("#legalTitle").innerHTML=d.t;
  $("#legalBody").innerHTML=d.h;
  legalModal.hidden=false; legalModal.classList.add("open");
  document.body.style.overflow="hidden";
  $(".modal-close",legalModal).focus();
}
function closeLegal(){
  legalModal.classList.remove("open"); legalModal.hidden=true;
  document.body.style.overflow="";
  if(lastLegalFocus) lastLegalFocus.focus();
}
legalModal.addEventListener("click",e=>{ if(e.target.closest("[data-close]")) closeLegal(); });
$$("[data-legal]").forEach(b=>b.addEventListener("click",()=>openLegal(b.dataset.legal)));
document.addEventListener("keydown",e=>{
  if(legalModal.hidden) return;
  if(e.key==="Escape") closeLegal();
  if(e.key==="Tab"){
    const f=$$('button, a[href], input, [tabindex]:not([tabindex="-1"])',legalPanel).filter(el=>!el.disabled);
    if(!f.length) return;
    const first=f[0], last=f[f.length-1];
    if(e.shiftKey&&document.activeElement===first){ last.focus(); e.preventDefault(); }
    else if(!e.shiftKey&&document.activeElement===last){ first.focus(); e.preventDefault(); }
  }
});
})();
</script>
