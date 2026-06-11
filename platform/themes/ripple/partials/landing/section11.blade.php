@php
    // Mock data for 5 rows
    $rows = [
        [
            'title' => 'HÌNH ẢNH PHỐI CẢNH DỰ ÁN',
            'subtitle' => '',
            'images' => [
                '/themes/ripple/images/s11_1.png',
                '/themes/ripple/images/s11_1.png',
                '/themes/ripple/images/s11_1.png',
                '/themes/ripple/images/s11_1.png',
                '/themes/ripple/images/s11_1.png',
                '/themes/ripple/images/s11_1.png',
            ]
        ],
        [
            'title' => 'HÌNH ẢNH THỰC TẾ TẠI DỰ ÁN',
            'subtitle' => 'NGOẠI KHU',
            'images' => [
                '/themes/ripple/images/s11_1.png',
                '/themes/ripple/images/s11_1.png',
                '/themes/ripple/images/s11_1.png',
                '/themes/ripple/images/s11_1.png',
                '/themes/ripple/images/s11_1.png',
                '/themes/ripple/images/s11_1.png',
            ]
        ],
        [
            'title' => 'HÌNH ẢNH THỰC TẾ TẠI DỰ ÁN',
            'subtitle' => 'KHU VỰC SINH HOẠT CHUNG & TIỆN ÍCH',
            'images' => [
                '/themes/ripple/images/s11_1.png',
                '/themes/ripple/images/s11_1.png',
                '/themes/ripple/images/s11_1.png',
                '/themes/ripple/images/s11_1.png',
                '/themes/ripple/images/s11_1.png',
                '/themes/ripple/images/s11_1.png',
            ]
        ],
        [
            'title' => 'HÌNH ẢNH THỰC TẾ TẠI DỰ ÁN',
            'subtitle' => 'NỘI KHU',
            'images' => [
                '/themes/ripple/images/s11_1.png',
                '/themes/ripple/images/s11_1.png',
                '/themes/ripple/images/s11_1.png',
                '/themes/ripple/images/s11_1.png',
                '/themes/ripple/images/s11_1.png',
                '/themes/ripple/images/s11_1.png',
            ]
        ],
        [
            'title' => 'HÌNH ẢNH THỰC TẾ TẠI DỰ ÁN',
            'subtitle' => 'TIẾN ĐỘ XÂY DỰNG TẦNG 09',
            'images' => [
                '/themes/ripple/images/s11_1.png',
                '/themes/ripple/images/s11_1.png',
                '/themes/ripple/images/s11_1.png',
                '/themes/ripple/images/s11_1.png',
                '/themes/ripple/images/s11_1.png',
                '/themes/ripple/images/s11_1.png',
            ]
        ],
    ];
@endphp


<section id="section11" class="kia-section-11">
    <div class="s11-container">
        @foreach ($rows as $index => $row)
            <div class="s11-row-container js-reveal">
                <h3 class="s11-row-title font-selecta-bold" @if(empty($row['subtitle'])) style="margin-bottom: 30px;" @endif>{{ $row['title'] }}</h3>
                @if($row['subtitle'])
                    <div class="s11-row-subtitle font-selecta-bold">{{ $row['subtitle'] }}</div>
                @endif
                
                <div class="s11-slider-wrapper">
                    <div class="swiper s11-swiper-{{ $index }}">
                        <div class="swiper-wrapper">
                            @foreach ($row['images'] as $img)
                                <div class="swiper-slide">
                                    <div class="s11-slide-item">
                                        <div class="s11-slide-img-wrap">
                                            <img src="{{ $img }}" alt="" class="s11-slide-img" onerror="this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 16 9\' fill=\'%23e0e0e0\'%3E%3Crect width=\'16\' height=\'9\'/%3E%3C/svg%3E'" />
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- Navigation -->
                    <div class="s11-swiper-button-prev s11-prev-{{ $index }}">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15 18L9 12L15 6" stroke="#5EA345" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="s11-swiper-button-next s11-next-{{ $index }}">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 18L15 12L9 6" stroke="#5EA345" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>
            </div>

            @if(!$loop->last)
                <div class="s11-separator"></div>
            @endif
        @endforeach
    </div>
</section>


