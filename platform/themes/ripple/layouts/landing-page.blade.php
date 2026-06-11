<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=5, user-scalable=1"/>
    <title>{{ theme_option('ldp_seo_title') ?: theme_option('site_title', 'KIA Vietnam') }}</title>
    <meta name="description" content="{{ theme_option('ldp_seo_description') ?: '' }}">
    @php
        $ldpCssUrl = asset('themes/ripple/css/landing-page.css');
        $ldpJsUrl  = asset('themes/ripple/js/landing-page.js');
    @endphp
    <link rel="stylesheet" href="{{ $ldpCssUrl }}">
</head>
<body @if (BaseHelper::isRtlEnabled()) dir="rtl" @endif>

<div class="landing-page-wrapper">
    <!-- SECTION 1: HERO BANNER -->
    {!! Theme::partial('landing.section1') !!}

    {{-- SECTION 5 --}}
    {!! Theme::partial('landing.section5') !!}

    {{-- SECTION 6 --}}
    {!! Theme::partial('landing.section6') !!}

    {{-- SECTION 7 --}}
    {!! Theme::partial('landing.section7') !!}

    <!-- SECTION 2: VIDEO TEASER -->

    <!-- SECTION 3: 3 ĐIỂM NỔI BẬT -->

    <!-- SECTION 4: FORM THU LEAD -->

    <!-- SECTION 5: FOOTER -->
<!-- Debug size -->
<div id="screen-size-debug" style="position: fixed; bottom: 10px; right: 10px; background: rgba(0,0,0,0.7); color: #fff; padding: 4px 8px; font-family: monospace; font-size: 11px; z-index: 999999; pointer-events: none; border-radius: 3px;">
    <span id="debug-w">0</span>
</div>
<script>
    (function() {
        function u() {
            var w = window.innerWidth;
            var h = window.innerHeight;
            var b = 'xs';
            if(w >= 1400) b = 'xxl';
            else if(w >= 1200) b = 'xl';
            else if(w >= 992) b = 'lg';
            else if(w >= 768) b = 'md';
            else if(w >= 576) b = 'sm';
            document.getElementById('debug-w').textContent = w + ' x ' + h;
        }
        u();
        window.addEventListener('resize', u);
    })();
</script>

    <script src="{{ $ldpJsUrl }}"></script>
</body>
</html>

