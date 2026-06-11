@php
    $heading1 = theme_option('ldp_s7_heading1', "MẶT BẰNG TẦNG ĐIỂN HÌNH\nSOLENA BY GREEN TOWN");
    $floorPlanImg = theme_option('ldp_s7_img', '/themes/ripple/images/section7.jpg');
@endphp

<section id="section7" class="kia-section-7" style="background-color: #ffffff; position: relative; z-index: 2;">
    <!-- Leaf Decoration Top Left -->
    <div class="s7-leaf-bg js-reveal" style="transition-delay: 400ms;"></div>

    <!-- Text content aligned with section 6 -->
    <div class="s7-content-wrapper text-center">
        <h2 class="s7-heading1 font-selecta-bold js-reveal">{!! nl2br(e($heading1)) !!}</h2>
    </div>

    <div class="s7-image-wrapper text-center js-reveal" style="transition-delay: 600ms;">
        <img src="{{ RvMedia::getImageUrl($floorPlanImg, null, false, RvMedia::getDefaultImage()) }}" alt="Mặt bằng" class="s7-floor-plan-img" />
    </div>
</section>
