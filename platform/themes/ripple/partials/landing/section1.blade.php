@php
    $bgImageRaw = theme_option('ldp_s1_bg');
    $bgImage = asset('themes/ripple/images/HeroNew.webp');
    if (!empty($bgImageRaw) && $bgImageRaw != '0' && $bgImageRaw != 'null') {
        $bgImage = RvMedia::getImageUrl($bgImageRaw);
    }

    $bgMobileRaw = theme_option('ldp_s1_bg_mobile');
    $bgMobile = $bgImage; // Mặc định dùng ảnh PC nếu không up ảnh Mobile
    if (!empty($bgMobileRaw) && $bgMobileRaw != '0' && $bgMobileRaw != 'null') {
        $bgMobile = RvMedia::getImageUrl($bgMobileRaw);
    }
@endphp

<style>
    .kia-hero-section {
        background-image: url('{{ $bgImage }}');
    }
    @media (max-width: 767px) {
        .kia-hero-section {
            background-image: url('{{ $bgMobile }}') !important;
        }
    }
</style>

<section id="section-hero" class="kia-hero-section">
</section>
