@php
    $heading1 = theme_option('ldp_s6_heading1', '20 TIỆN ÍCH NỘI KHU');
    $heading2 = theme_option('ldp_s6_heading2', 'ĐẶC QUYỀN DÀNH RIÊNG CHO CƯ DÂN');

    $features = [];
    for ($i = 1; $i <= 5; $i++) {
        $title = theme_option("ldp_s6_title{$i}");
        $img = theme_option("ldp_s6_img{$i}");
        if ($title || $img) {
            $features[] = [
                'title' => $title,
                'img'   => $img ? RvMedia::getImageUrl($img) : '',
            ];
        }
    }

    // Default mock data if empty
    if (empty($features)) {
        $features = [
            [
                'title' => '300M2 HỒ BƠI VÔ CỰC',
                'img'   => '/themes/ripple/images/pool.jpg', // Placeholder
            ],
            [
                'title' => '15.000M2 TRUNG TÂM THƯƠNG MẠI GREEN MALL (4 TẦNG)',
                'img'   => '/themes/ripple/images/mall.jpg', // Placeholder
            ],
            [
                'title' => 'PHÒNG GYM CHUẨN HIỆN ĐẠI',
                'img'   => '/themes/ripple/images/gym.jpg', // Placeholder
            ],
            [
                'title' => 'CÔNG VIÊN TRUNG TÂM',
                'img'   => '/themes/ripple/images/park.jpg', // Placeholder
            ],
        ];
    }

    // Swiper requires at least slidesPerView * 2 slides to loop smoothly.
    // Since slidesPerView is 3, we need at least 6 slides.
    if (count($features) > 0 && count($features) < 6) {
        $original = $features;
        while (count($features) < 6) {
            $features = array_merge($features, $original);
        }
    }
@endphp

<section id="section6" class="kia-section-6" style="background-color: #A8D845; overflow: hidden; position: relative;">
    <div class="s6-container">
        <!-- Text content aligned with section 5 -->
        <div class="s6-content-wrapper text-center">
            <h2 class="s6-heading1 font-selecta-bold js-reveal">{{ $heading1 }}</h2>
            <h3 class="s6-heading2 font-selecta-bold js-reveal" style="transition-delay: 150ms;">{{ $heading2 }}</h3>
        </div>

        <div class="s6-slider-wrapper js-reveal" style="transition-delay: 300ms;">
            <!-- Swiper Container -->
            <div class="swiper s6-swiper">
                <div class="swiper-wrapper">
                    @foreach ($features as $feature)
                        <div class="swiper-slide">
                            <div class="s6-slide-item text-center">
                                <div class="s6-slide-img-wrap">
                                    <img src="{{ $feature['img'] }}" alt="{{ $feature['title'] }}" class="s6-slide-img" onerror="this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 16 9\' fill=\'%23e0e0e0\'%3E%3Crect width=\'16\' height=\'9\'/%3E%3C/svg%3E'" />
                                </div>
                                <h4 class="s6-slide-title font-selecta-regular">{{ $feature['title'] }}</h4>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- Custom Navigation -->
            <div class="s6-swiper-button-prev">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15 18L9 12L15 6" stroke="#295420" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <div class="s6-swiper-button-next">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 18L15 12L9 6" stroke="#295420" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
        </div>
    </div>
</section>

<!-- Include Swiper if not globally available -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

