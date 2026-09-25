<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title') — Mega Pharma Group</title>
<meta name="description" content="@yield('description')">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400;1,500&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

<style>
@include('partials.site-styles')
</style>
</head>
<body>
<a class="skip-link" href="#main">Skip to content</a>

<!-- fixed cinematic world (single calm scene, same as the product pages) -->
<div id="world" aria-hidden="true"></div>
<div id="grain" aria-hidden="true"></div>
<div id="vignette" aria-hidden="true"></div>

<div id="loader" aria-hidden="true">
  <div class="loader-mark"><b>Mega Pharma</b><span>Group</span></div>
  <div class="loader-track"><div class="loader-bar" id="loaderBar"></div></div>
  <div class="loader-pct" id="loaderPct">0%</div>
</div>

<div id="progress" aria-hidden="true"></div>

@include('partials.site-nav')

<main id="main">
@yield('content')
</main>

@include('partials.partners')
@include('partials.site-footer')
@include('partials.legal-modal')
@include('partials.chatbot')
@include('partials.calm-world-script', ['themeColors' => $themeColors])
@include('partials.footer-legal-script')
</body>
</html>
