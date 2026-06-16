@php
    $heading = theme_option('ldp_s10_heading', 'PHƯƠNG THỨC THANH TOÁN');
    
    $img1Opt = theme_option('ldp_s10_img_1');
    $img1Url = $img1Opt ? RvMedia::getImageUrl($img1Opt) : asset('themes/ripple/images/section10-1.png');
    if ($img1Opt == 'section10-1.png') $img1Url = asset('themes/ripple/images/section10-1.png');

    $img2Opt = theme_option('ldp_s10_img_2');
    $img2Url = $img2Opt ? RvMedia::getImageUrl($img2Opt) : asset('themes/ripple/images/section10-2.png');
    if ($img2Opt == 'section10-2.png') $img2Url = asset('themes/ripple/images/section10-2.png');
@endphp

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
</section>
