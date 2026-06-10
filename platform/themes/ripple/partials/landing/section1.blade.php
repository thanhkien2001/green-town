@php
    $bgImageRaw = theme_option('ldp_s1_bg');
    if (!empty($bgImageRaw)) {
        if (filter_var($bgImageRaw, FILTER_VALIDATE_URL) || str_starts_with($bgImageRaw, '/') || str_contains($bgImageRaw, 'storage/')) {
            $bgImage = $bgImageRaw;
        } else {
            $bgImage = RvMedia::getImageUrl($bgImageRaw);
        }
    } else {
        $bgImage = '/themes/ripple/images/HeroNew.webp';
    }
@endphp

<section id="section-hero" class="kia-hero-section" style="background-image: url('{{ $bgImage }}');">
</section>
