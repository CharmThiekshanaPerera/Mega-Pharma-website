<!-- ============ OUR PARTNERS ============ -->
<section class="chapter chapter--partners" aria-labelledby="partners-h">
  <div class="wrap chapter-inner">
    <div class="pane pane--c rv" style="background:transparent;border:none;box-shadow:none;backdrop-filter:none">
      <p class="eyebrow"><i>&middot;</i>Our partners</p>
      <h2 id="partners-h">Global principals we represent in Sri Lanka.</h2>
    </div>
  </div>
  @php
    // Real logo where we have a verified official mark; null falls back to
    // a text wordmark (no fabricated/unverified logos are used).
    $partners = [
      ['n' => 'Micro Labs', 'logo' => 'images/partners/micro-labs.jpg'],
      ['n' => 'Himalaya', 'logo' => 'images/partners/himalaya.svg'],
      ['n' => 'ACME', 'logo' => 'images/partners/acme.png'],
      ['n' => 'EAR India', 'logo' => null],
      ['n' => 'Dr. F. Köhler Chemie', 'logo' => 'images/partners/dr-f-kohler-chemie.png'],
      ['n' => 'TaiDoc', 'logo' => 'images/partners/taidoc.png'],
      ['n' => 'YuWell', 'logo' => 'images/partners/yuwell.png'],
      ['n' => 'B.Well Swiss', 'logo' => 'images/partners/bwell-swiss.png'],
      ['n' => 'DeRoyal', 'logo' => 'images/partners/deroyal.png'],
      ['n' => 'Eucare', 'logo' => null],
      ['n' => 'Humeca', 'logo' => 'images/partners/humeca.svg'],
      ['n' => 'Telea', 'logo' => 'images/partners/telea.svg'],
      ['n' => 'MedGyn', 'logo' => 'images/partners/medgyn.png'],
      ['n' => 'KLS Martin', 'logo' => null],
      ['n' => 'XVIVO Perfusion', 'logo' => null],
      ['n' => 'Medispec', 'logo' => null],
      ['n' => 'Tynor', 'logo' => 'images/partners/tynor.png'],
      ['n' => 'Connexicon', 'logo' => null],
      ['n' => 'Yasee QY Medical', 'logo' => 'images/partners/yasee-qy-medical.png'],
      ['n' => 'Sky Nutraceuticals', 'logo' => null],
    ];
  @endphp
  <div class="partner-marquee rv">
    <div class="partner-track">
      @for ($i = 0; $i < 2; $i++)
        <ul class="partner-list"@if($i === 1) aria-hidden="true" @else aria-label="Our partners" @endif>
          @foreach ($partners as $p)
            <li>
              @if ($p['logo'])
                <img src="{{ asset($p['logo']) }}" alt="{{ $p['n'] }}" loading="lazy" decoding="async">
              @else
                <span>{{ $p['n'] }}</span>
              @endif
            </li>
          @endforeach
        </ul>
      @endfor
    </div>
  </div>
</section>
