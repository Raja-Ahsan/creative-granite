<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Creative Granite &amp; Design — Stone, shaped with intention.</title>
    <meta name="description" content="Premium granite, quartz, marble &amp; quartzite countertops in Utah. Precision fabrication and thoughtful design for kitchens, baths, fireplaces and beyond.">
    <meta name="author" content="Creative Granite & Design">
    <meta property="og:title" content="Creative Granite &amp; Design — Stone, shaped with intention.">
    <meta property="og:description" content="Premium granite, quartz, marble &amp; quartzite countertops in Utah. Precision fabrication and thoughtful design for kitchens, baths, fireplaces and beyond.">
    <meta property="og:type" content="website">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="Creative Granite &amp; Design — Stone, shaped with intention.">
    <meta name="twitter:description" content="Premium granite, quartz, marble &amp; quartzite countertops in Utah. Precision fabrication and thoughtful design for kitchens, baths, fireplaces and beyond.">
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500&display=swap">
    @vite(['resources/css/site.css', 'resources/js/site.tsx'])
    <script>
        window.__SITE_CONTENT__ = @json($siteContent ?? []);
        window.__SITE_PAGE__ = @json($page ?? 'home');
    </script>
</head>
<body>
    <div id="app" data-page="{{ $page ?? 'home' }}"></div>
</body>
</html>
