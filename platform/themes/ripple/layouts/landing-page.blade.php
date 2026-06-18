<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=5, user-scalable=1"/>
    <title>{{ theme_option('ldp_seo_title') ?: theme_option('site_title', 'KIA Vietnam') }}</title>
    <meta name="description" content="{{ theme_option('ldp_seo_description') ?: '' }}">
    @php
        $cssPath = public_path('themes/ripple/css/landing-page.css');
        $ldpCssUrl = asset('themes/ripple/css/landing-page.css') . (file_exists($cssPath) ? '?v=' . filemtime($cssPath) : '');
        $jsPath = public_path('themes/ripple/js/landing-page.js');
        $ldpJsUrl = asset('themes/ripple/js/landing-page.js') . (file_exists($jsPath) ? '?v=' . filemtime($jsPath) : '');
    @endphp
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ $ldpCssUrl }}">

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-S8GXLKFKBV"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-S8GXLKFKBV');
    </script>

    <!-- Meta Pixel Code -->
    <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '2153605741856694');
    fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=2153605741856694&ev=PageView&noscript=1"
    /></noscript>
    <!-- End Meta Pixel Code -->
</head>
<body @if (BaseHelper::isRtlEnabled()) dir="rtl" @endif>

<div class="landing-page-wrapper">
    <!-- HEADER MENU -->
    {!! Theme::partial('landing.header') !!}

    <!-- SECTION 1: HERO BANNER -->
    {!! Theme::partial('landing.section1') !!}

    <!-- SECTION 2: OVERVIEW -->
    {!! Theme::partial('landing.section2') !!}
    <!-- SECTION 3: VỊ TRÍ & KẾT NỐI -->
    {!! Theme::partial('landing.section3') !!}

    <!-- SECTION 4: KẾT NỐI TIỆN ÍCH -->
    {!! Theme::partial('landing.section4') !!}

    {{-- SECTION 5 --}}
    {!! Theme::partial('landing.section5') !!}

    {{-- SECTION 6 --}}
    {!! Theme::partial('landing.section6') !!}

    {{-- SECTION 7 --}}
    {!! Theme::partial('landing.section7') !!}
    {!! Theme::partial('landing.section8') !!}
    {!! Theme::partial('landing.section9') !!}

    {{-- SECTION 10 --}}
    {!! Theme::partial('landing.section10') !!}
    {{-- SECTION 11 --}}
    {!! Theme::partial('landing.section11') !!}

    {{-- SECTION 12 --}}
    {!! Theme::partial('landing.section12') !!}

    {{-- SECTION 13 --}}
    {!! Theme::partial('landing.section13') !!}

    <!-- SECTION 2: VIDEO TEASER -->

    <!-- SECTION 3: 3 ĐIỂM NỔI BẬT -->

    <!-- SECTION 4: FORM THU LEAD -->

    <!-- SECTION 5: FOOTER -->
    {!! Theme::partial('landing.footer') !!}
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

