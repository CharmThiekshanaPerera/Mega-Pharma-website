@extends('layouts.inner')

@php
    $houses = [
        'pharma' => ['Mega Pharma', 'Prescription medicine across seven therapeutic collections.'],
        'meditech' => ['Mega Meditech', 'Medical technology across eight device collections.'],
    ];
@endphp

@section('title', 'Collections')
@section('description', 'Browse every Mega Pharma Group collection — '.$total.' products across 15 therapeutic and medical-technology categories.')

@section('content')
<section class="chapter" id="collections-index" aria-labelledby="collections-h">
  <div class="wrap chapter-inner">
    <div class="pane pane--c" style="max-width:980px">
      <p class="eyebrow"><i>&larr;</i><a class="lnk" href="/">Home</a></p>
      <h1 id="collections-h">The collections</h1>
      <p class="lede" style="max-width:62ch">{{ $total }} products across fifteen collections, organised by therapeutic area and device type. Choose a collection for the full range, or use the search and filters in the <a class="lnk" href="/#collections">homepage explorer</a>.</p>
    </div>

    @foreach ($houses as $key => [$label, $blurb])
      <div class="pane" style="margin-top:2.6rem;background:transparent;border:none;box-shadow:none;backdrop-filter:none">
        <p class="eyebrow">{{ $label }}</p>
        <p class="lede" style="margin:-.6rem 0 1.4rem">{{ $blurb }}</p>
        <div class="grid">
          @foreach ($collections[$key] ?? [] as $c)
            <a class="card" href="{{ route('collections.show', $c['slug']) }}" data-co="{{ $c['company'] }}">
              <span class="card-cat">{{ $label }}</span>
              <span class="card-name">{{ $c['name'] }}</span>
              <p class="generic">{{ $c['tagline'] }}</p>
              <p class="meta"><em>{{ $c['count'] }} {{ \Illuminate\Support\Str::plural('product', $c['count']) }}</em><span>View &rarr;</span></p>
            </a>
          @endforeach
        </div>
      </div>
    @endforeach
  </div>
</section>
@endsection
