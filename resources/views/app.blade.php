<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $metaTitle ?? 'Creative Granite & Design — Stone, shaped with intention.' }}</title>
    <meta name="description" content="{{ $metaDescription ?? 'Premium granite, quartz, marble &amp; quartzite countertops in Utah. Precision fabrication and thoughtful design for kitchens, baths, fireplaces and beyond.' }}">
    <meta name="author" content="Creative Granite & Design">

    <!-- Open Graph / Facebook -->
    <meta property="og:title" content="Creative Granite &amp; Design — Stone, shaped with intention.">
    <meta property="og:description" content="Premium granite, quartz, marble &amp; quartzite countertops in Utah. Precision fabrication and thoughtful design for kitchens, baths, fireplaces and beyond.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://www.creativegranite.com/">
    <meta property="og:site_name" content="Creative Granite">

    <!-- Facebook Share Image -->
    <meta property="og:image" content="https://www.creativegranite.com/storage/site/9M3QVnLQTnfSQZX6oc7hLGj5G8PZvyjAAQdPa3S1.jpg">
    <meta property="og:image:secure_url" content="https://www.creativegranite.com/storage/site/9M3QVnLQTnfSQZX6oc7hLGj5G8PZvyjAAQdPa3S1.jpg">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="Creative Granite &amp; Design countertops">

    <!-- Locale -->
    <meta property="og:locale" content="en_US">

    <!-- Twitter / X -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Creative Granite &amp; Design — Stone, shaped with intention.">
    <meta name="twitter:description" content="Premium granite, quartz, marble &amp; quartzite countertops in Utah. Precision fabrication and thoughtful design for kitchens, baths, fireplaces and beyond.">
    <meta name="twitter:image" content="https://www.creativegranite.com/storage/site/9M3QVnLQTnfSQZX6oc7hLGj5G8PZvyjAAQdPa3S1.jpg">
    <meta name="twitter:image:alt" content="Creative Granite &amp; Design countertops">

    @php
        $faviconUrl = \App\Models\SiteSetting::faviconUrl();
        $faviconType = \App\Models\SiteSetting::faviconMimeType();
    @endphp
    <link rel="icon" href="{{ $faviconUrl }}" type="{{ $faviconType }}">
    <link rel="shortcut icon" href="{{ $faviconUrl }}" type="{{ $faviconType }}">
    <link rel="apple-touch-icon" href="{{ $faviconUrl }}">
    @if (!empty($siteContent['heroSlides'][0]['src']))
        <link rel="preload" as="image" href="{{ $siteContent['heroSlides'][0]['src'] }}" fetchpriority="high">
    @endif
    @if (!empty($siteContent['settings']['logo']))
        <link rel="preload" as="image" href="{{ $siteContent['settings']['logo'] }}">
    @endif
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500&display=swap">
    @if (filled(config('services.adobe_fonts.kit')))
        <link rel="stylesheet" href="https://use.typekit.net/{{ config('services.adobe_fonts.kit') }}.css">
    @endif
    @viteReactRefresh
    @vite(['resources/css/site.css', 'resources/js/site.tsx'])
    <script>
        window.__SITE_CONTENT__ = @json($siteContent ?? []);
        window.__SITE_PAGE__ = @json($page ?? 'home');
        window.__SITE_SERVICE__ = @json($service ?? null);
    </script>
</head>
<body>
    <div id="app" data-page="{{ $page ?? 'home' }}"></div>
</body>
</html>
