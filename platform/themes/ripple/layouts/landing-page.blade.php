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

    <!-- SECTION 2: VIDEO TEASER -->
    <!-- {!! Theme::partial('landing.section2') !!} -->

    <!-- SECTION 3: 3 ĐIỂM NỔI BẬT -->
    <!-- {!! Theme::partial('landing.section3') !!} -->

    <!-- SECTION 4: FORM THU LEAD -->
    <!-- {!! Theme::partial('landing.section4') !!} -->

    <!-- SECTION 5: FOOTER -->
    <!-- {!! Theme::partial('landing.section5') !!} -->
</div>
    <script src="{{ $ldpJsUrl }}"></script>
</body>
</html>
