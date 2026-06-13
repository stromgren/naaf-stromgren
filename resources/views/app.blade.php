<!DOCTYPE html>
<html lang="sv" @class(['dark' => ($appearance ?? 'system') == 'dark'])>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        @php
            $shareTitle = 'Amanda & Andreas';
            $shareDescription = 'Vi gifter oss 1 augusti 2026. Välkomna till vigsel under ekarna på Erlandstorp och picknick i trädgården.';
            $shareUrl = rtrim(config('app.url'), '/');
            $shareImage = $shareUrl.'/og-image.png';
        @endphp

        <title>{{ $shareTitle }} · 1 augusti 2026</title>
        <meta name="description" content="{{ $shareDescription }}">
        <meta name="theme-color" content="#FBF5F7">

        <meta property="og:type" content="website">
        <meta property="og:site_name" content="{{ $shareTitle }}">
        <meta property="og:title" content="{{ $shareTitle }}">
        <meta property="og:description" content="{{ $shareDescription }}">
        <meta property="og:url" content="{{ $shareUrl }}">
        <meta property="og:image" content="{{ $shareImage }}">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="630">
        <meta property="og:locale" content="sv_SE">

        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{ $shareTitle }}">
        <meta name="twitter:description" content="{{ $shareDescription }}">
        <meta name="twitter:image" content="{{ $shareImage }}">

        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/og-image.png">

        @fonts

        @vite(['resources/css/app.css', 'resources/js/app.ts', "resources/js/pages/{$page['component']}.vue"])
        <x-inertia::head />
    </head>
    <body class="font-sans antialiased">
        <x-inertia::app />
    </body>
</html>
