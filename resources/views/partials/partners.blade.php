<!-- ============ OUR PARTNERS ============ -->
<section class="chapter chapter--partners" aria-labelledby="partners-h">
  <div class="wrap chapter-inner">
    <div class="pane pane--c rv" style="background:transparent;border:none;box-shadow:none;backdrop-filter:none">
      <p class="eyebrow"><i>&middot;</i>Our partners</p>
      <h2 id="partners-h">Global principals we represent in Sri Lanka.</h2>
    </div>
  </div>
  @php
    $partnerNames = ['Micro Labs','Himalaya','ACME','EAR India','Dr. F. Köhler Chemie','TaiDoc','YuWell','B.Well Swiss','DeRoyal','Eucare','Humeca','Telea','MedGyn','KLS Martin','XVIVO Perfusion','Medispec','Tynor','Connexicon','Yasee QY Medical','Sky Nutraceuticals'];
  @endphp
  <div class="partner-marquee rv">
    <div class="partner-track">
      <ul class="partner-list" aria-label="Our partners">
        @foreach ($partnerNames as $name)<li>{{ $name }}</li>@endforeach
      </ul>
      <ul class="partner-list" aria-hidden="true">
        @foreach ($partnerNames as $name)<li>{{ $name }}</li>@endforeach
      </ul>
    </div>
  </div>
</section>
