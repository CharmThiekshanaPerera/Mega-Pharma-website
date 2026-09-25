@extends('layouts.inner')

@section('title', $collection['name'].' — '.$houseLabel)
@section('description', \Illuminate\Support\Str::limit($collection['tagline'].' '.$collection['intro'], 155))

@section('content')
<section class="chapter" id="collection" aria-labelledby="collection-h">
  <div class="wrap chapter-inner">

    <div class="pane pane--c" style="max-width:980px">
      <p class="eyebrow"><i>&larr;</i><a class="lnk" href="{{ route('collections.index') }}">All collections</a></p>
      <span class="modal-co {{ $collection['company'] }}">{{ $houseLabel }}</span>
      <h1 id="collection-h" style="margin-top:.6rem">{{ $collection['name'] }}</h1>
      <p class="brochure-tagline">{{ $collection['tagline'] }}</p>
      <p class="lede" style="margin-top:1.4rem;max-width:68ch">{{ $collection['intro'] }}</p>

      <div class="stats">
        <div class="stat"><b>{{ $products->count() }}</b><span>{{ \Illuminate\Support\Str::plural('Product', $products->count()) }}</span><small>In this collection</small></div>
        <div class="stat"><b>{{ $principals->count() }}</b><span>{{ \Illuminate\Support\Str::plural('Principal', $principals->count()) }}</span><small>{{ $principals->implode(', ') }}</small></div>
        <div class="stat"><b style="font-size:1.5rem;padding-top:.7rem">{{ $houseLabel }}</b><span>House</span><small>{{ $collection['company'] === 'pharma' ? 'Prescription medicine' : 'Medical technology' }}</small></div>
      </div>

      <div class="brochure-highlight" style="margin-top:2.2rem">
        <h3>What this collection covers</h3>
        <ul>
          @foreach ($collection['covers'] as $item)
            <li>{{ $item }}</li>
          @endforeach
        </ul>
      </div>
    </div>

    <div class="pane" style="margin-top:2.6rem;background:transparent;border:none;box-shadow:none;backdrop-filter:none">
      <p class="eyebrow">The range &middot; {{ $products->count() }} {{ \Illuminate\Support\Str::plural('product', $products->count()) }}</p>

      @forelse ($products->groupBy('manufacturer') as $principal => $group)
        <section class="pgroup" aria-label="{{ $principal }}">
          <div class="pgroup-head">
            <h3>{{ $principal }}</h3>
            <span class="g-count">{{ $group->count() }} {{ \Illuminate\Support\Str::plural('product', $group->count()) }}</span>
          </div>
          <div class="grid">
            @foreach ($group as $p)
              <a class="card{{ $p->imageUrl ? ' has-img' : '' }}" href="{{ route('products.show', $p) }}" data-co="{{ $p->company }}">
                @if ($p->imageUrl)
                  <img class="card-img" src="{{ $p->imageUrl }}" alt="" loading="lazy" decoding="async">
                @endif
                <span class="card-cat">{{ $p->category }}</span>
                <span class="card-name">{{ $p->name }}</span>
                <p class="generic">{{ $p->generic }}</p>
                <p class="meta"><em>{{ $p->manufacturer }}</em><span>{{ $p->variant }}</span></p>
              </a>
            @endforeach
          </div>
        </section>
      @empty
        <p class="lede">No products are listed in this collection yet.</p>
      @endforelse
    </div>

    @if ($siblings->isNotEmpty())
      <div class="pane" style="margin-top:2.6rem;background:transparent;border:none;box-shadow:none;backdrop-filter:none">
        <p class="eyebrow">More from {{ $houseLabel }}</p>
        <div class="chips" style="margin-top:1.2rem">
          @foreach ($siblings as $s)
            <a class="chip" href="{{ route('collections.show', $s['slug']) }}">{{ $s['name'] }}</a>
          @endforeach
        </div>
      </div>
    @endif

    <div class="pane pane--c" style="margin-top:2.6rem;max-width:980px;text-align:center">
      <h2 style="margin:0 auto">Need help choosing?</h2>
      <p class="lede" style="margin:1rem auto 0">Our team can advise on availability, presentations and supply for the {{ $collection['name'] }} range.</p>
      <a class="btn" style="margin-top:1.8rem;display:inline-flex" href="/#contact">Contact us</a>
      <p class="modal-note" style="margin-top:1rem">Information for healthcare professionals. Prescription medicines are promoted to the profession only.</p>
    </div>

  </div>
</section>
@endsection
