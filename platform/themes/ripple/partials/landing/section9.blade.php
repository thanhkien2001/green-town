@php
    $bgImgOpt = theme_option('ldp_s9_bg');
    $bgMobileOpt = theme_option('ldp_s9_bg_mobile');
    $kidImgOpt = theme_option('ldp_s9_kid_img');

    $bgImgUrl = $bgImgOpt ? RvMedia::getImageUrl($bgImgOpt) : asset('themes/ripple/images/section9_final.webp');
    // Fallback if user just typed the filename without path
    if ($bgImgOpt == 'section9_final.webp') $bgImgUrl = asset('themes/ripple/images/section9_final.webp');

    $bgMobileUrl = $bgImgUrl;
    if (!empty($bgMobileOpt) && $bgMobileOpt != '0' && $bgMobileOpt != 'null') {
        if (filter_var($bgMobileOpt, FILTER_VALIDATE_URL) || str_starts_with($bgMobileOpt, '/') || str_contains($bgMobileOpt, 'storage/')) {
            $bgMobileUrl = $bgMobileOpt;
        } else {
            $bgMobileUrl = RvMedia::getImageUrl($bgMobileOpt);
        }
    }

    $kidImgUrl = $kidImgOpt ? RvMedia::getImageUrl($kidImgOpt) : asset('themes/ripple/images/kid_section9.jpg');
    if ($kidImgOpt == 'kid_section9.jpg') $kidImgUrl = asset('themes/ripple/images/kid_section9.jpg');

    $heading = theme_option('ldp_s9_heading', "PHÁP LÝ HOÀN CHỈNH\nAN CƯ BỀN VỮNG");
    $btnText = theme_option('ldp_s9_btn_text', 'XEM CHI TIẾT');
    $btnLink = theme_option('ldp_s9_btn_link', '#');
@endphp

<style>
    .kia-section-9 {
        background-image: url('{{ $bgImgUrl }}');
    }
    @media (max-width: 767px) {
        .kia-section-9 {
            background-image: url('{{ $bgMobileUrl }}');
        }
    }
</style>

<section id="section9" class="kia-section-9">
    <div class="s9-container">
        
        <!-- Left Block -->
        <div class="s9-left-block js-reveal">
            <h2 class="s9-heading font-selecta-bold js-reveal" style="transition-delay: 400ms;">{!! nl2br(e($heading)) !!}</h2>
            <a href="{{ $btnLink }}" class="s9-btn font-selecta-bold js-reveal" style="transition-delay: 700ms; display: inline-block;">
                {{ $btnText }}
            </a>
        </div>

        <!-- Right Kid Image -->
        <div class="s9-kid-wrapper js-reveal" style="transition-delay: 200ms;">
            <img src="{{ $kidImgUrl }}" alt="Kid" class="s9-kid-img" />
        </div>

    </div>
</section>
