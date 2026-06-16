@php
    $heading = theme_option('ldp_s10_heading', 'PHƯƠNG THỨC THANH TOÁN');
    
    $img1Opt = theme_option('ldp_s10_img_1');
    $img1Url = $img1Opt ? RvMedia::getImageUrl($img1Opt) : asset('themes/ripple/images/section10-1.png');
    if ($img1Opt == 'section10-1.png') $img1Url = asset('themes/ripple/images/section10-1.png');

    $img2Opt = theme_option('ldp_s10_img_2');
    $img2Url = $img2Opt ? RvMedia::getImageUrl($img2Opt) : asset('themes/ripple/images/section10-2.png');
    if ($img2Opt == 'section10-2.png') $img2Url = asset('themes/ripple/images/section10-2.png');
@endphp

<style>
    .kia-section-10 {
        position: relative;
    }
    .s10-btn-wrapper {
        position: absolute;
        bottom: -27px; /* Nửa chiều cao nút */
        left: 0;
        width: 100%;
        text-align: center;
        z-index: 50;
    }
    .s10-register-btn {
        display: inline-block;
        background-color: #1a421e;
        color: #ffffff;
        padding: 14px 50px;
        border-radius: 8px;
        font-size: 24px;
        text-transform: uppercase;
        text-decoration: none !important;
        box-shadow: 0 4px 15px rgba(0,0,0,0.15);
        transition: all 0.3s ease;
        white-space: nowrap;
        letter-spacing: 0.5px;
    }
    .s10-register-btn:hover {
        background-color: #0f2711;
        color: #DFEE5D;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.2);
    }
    
    @media (max-width: 767px) {
        .s10-btn-wrapper {
            bottom: -22px; /* Điều chỉnh cho mobile */
        }
        .s10-register-btn {
            font-size: 15px;
            padding: 12px 30px;
        }
    }
</style>

<section id="section-payment" class="kia-section-10">
    <!-- Leaf Decoration Top Right -->
    <div class="s10-leaf-bg js-reveal" style="transition-delay: 200ms;"></div>

    <div class="s10-container">
        
        <h2 class="s10-heading font-selecta-bold text-center js-reveal">
            {{ $heading }}
        </h2>

        <div class="s10-slider-wrapper js-reveal" style="transition-delay: 400ms;">
            <div class="swiper-container s10-swiper">
                <div class="swiper-wrapper">
                    <!-- Slide 1 -->
                    <div class="swiper-slide">
                        <div class="s10-slide-img-wrap">
                            <img src="{{ $img1Url }}" alt="Phương thức thanh toán 1" />
                        </div>
                    </div>
                    <!-- Slide 2 -->
                    <div class="swiper-slide">
                        <div class="s10-slide-img-wrap">
                            <img src="{{ $img2Url }}" alt="Phương thức thanh toán 2" />
                        </div>
                    </div>
                </div>
                <!-- Pagination / Navigation (hidden per user request) -->
                <!-- <div class="s10-swiper-pagination"></div> -->
            </div>
            
            <!-- Navigation Buttons (hidden per user request) -->
            <!--
            <div class="s10-swiper-button-prev">
                ...
            </div>
            -->
        </div>

    </div>
    
    <div class="s10-btn-wrapper js-reveal" style="transition-delay: 600ms;">
        <a href="#section-contact" class="s10-register-btn font-selecta-bold">ĐĂNG KÝ NGAY</a>
    </div>
</section>
