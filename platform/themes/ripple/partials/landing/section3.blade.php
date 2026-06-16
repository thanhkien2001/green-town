<!-- SECTION 3: VỊ TRÍ & KẾT NỐI -->
@php
    // Cấu hình ảnh nền chính (Desktop)
    $bgImageRaw = theme_option('ldp_s3_bg');
    if (!empty($bgImageRaw) && $bgImageRaw != '0' && $bgImageRaw != 'null') {
        if (filter_var($bgImageRaw, FILTER_VALIDATE_URL) || str_starts_with($bgImageRaw, '/') || str_contains($bgImageRaw, 'storage/')) {
            $bgImage = $bgImageRaw;
        } else {
            $bgImage = RvMedia::getImageUrl($bgImageRaw);
        }
    } else {
        $bgImage = asset('themes/ripple/images/section3.webp');
    }

    // Cấu hình ảnh nền Mobile
    $bgMobileRaw = theme_option('ldp_s3_bg_mobile');
    $bgMobile = $bgImage;
    if (!empty($bgMobileRaw) && $bgMobileRaw != '0' && $bgMobileRaw != 'null') {
        if (filter_var($bgMobileRaw, FILTER_VALIDATE_URL) || str_starts_with($bgMobileRaw, '/') || str_contains($bgMobileRaw, 'storage/')) {
            $bgMobile = $bgMobileRaw;
        } else {
            $bgMobile = RvMedia::getImageUrl($bgMobileRaw);
        }
    }

    // Lọc URL cho ngrok / thiết bị di động
    if (str_contains($bgImage, '/storage/')) {
        $bgImage = strstr($bgImage, '/storage/');
    } elseif (str_contains($bgImage, '/themes/')) {
        $bgImage = strstr($bgImage, '/themes/');
    }

    if (str_contains($bgMobile, '/storage/')) {
        $bgMobile = strstr($bgMobile, '/storage/');
    } elseif (str_contains($bgMobile, '/themes/')) {
        $bgMobile = strstr($bgMobile, '/themes/');
    }

    // Lấy thông tin text cột trái
    $leftTitle1 = theme_option('ldp_s3_left_title1') ?: 'KHU ĐÔ THỊ VĨNH LỘC QUY MÔ 110HA';
    $leftTitle2 = theme_option('ldp_s3_left_title2') ?: 'KHU ĐÔ THỊ KIỂU MẪU - "PHÚ MỸ HƯNG THỨ 2" TẠI KHU TÂY TP.HCM';
    $leftDesc = theme_option('ldp_s3_left_desc') ?: 'Khu đô thị Vĩnh Lộc là một trong những khu đô thị quy mô lớn đầu tiên tại khu Tây TP.HCM. Dự án được quy hoạch đồng bộ trên diện tích khoảng 110 ha với mục tiêu hình thành một khu đô thị hoàn chỉnh gồm nhà ở, thương mại, giáo dục, y tế, công viên và hạ tầng kỹ thuật.';

    // Lấy thông tin text cột phải
    $rightTitle1 = theme_option('ldp_s3_right_title1') ?: 'GREEN TOWN BÌNH TÂN';
    $rightTitle2 = theme_option('ldp_s3_right_title2') ?: 'LANDMARK DÂN CƯ CỦA KHU ĐÔ THỊ VĨNH LỘC';
@endphp

<style>
    @media (min-width: 768px) {
        #section-location.js-reveal {
            opacity: 1 !important;
            transform: none !important;
            transition: none !important;
            visibility: visible !important;
        }
    }
    @media (max-width: 767px) {
        #section-location.js-reveal {
            transition: all 1.5s cubic-bezier(0.25, 1, 0.5, 1) !important;
        }
        #section-location .location-container,
        #section-location .layer-clip,
        #section-location::before,
        #section-location::after {
            display: none !important;
        }
    }
</style>

<section id="section-location" class="location-section js-reveal">
    <!-- Background Layers -->
    <div class="background-layers">
        <picture class="bg-picture-wrapper">
            <source media="(max-width: 767px)" srcset="{{ $bgMobile }}" />
            <img src="{{ $bgImage }}" class="bg-layer layer-base" alt="Background Location" />
        </picture>
        <!-- Layer 2: Khối hình xanh lá cây góc trái từ ảnh 1920x1080 trong suốt -->
        <img src="{{ asset('themes/ripple/images/Clip_s3.png') }}" class="bg-layer layer-clip" alt="Clip Overlay" />
    </div>

    <!-- Layout Container (Align bottom) -->
    <div class="location-container">
        <!-- Cột Trái: Panel màu xanh lá cắt xéo -->
        <div class="location-left-panel js-reveal">
            <div class="panel-content">
                <h3 class="left-title-1 font-selecta-black">{!! $leftTitle1 !!}</h3>
                <h4 class="left-title-2 font-selecta-bold">{!! $leftTitle2 !!}</h4>
                <p class="left-desc font-montserrat-regular">{!! nl2br(e($leftDesc)) !!}</p>
            </div>
        </div>

        <!-- Cột Phải: Khối chữ có vạch dọc màu vàng -->
        <div class="location-right-panel js-reveal" style="transition-delay: 200ms;">
            <div class="right-bordered-content">
                <h3 class="right-title-1 font-selecta-black">{!! $rightTitle1 !!}</h3>
                <h4 class="right-title-2 font-selecta-medium">{!! $rightTitle2 !!}</h4>
            </div>
        </div>
    </div>
</section>
