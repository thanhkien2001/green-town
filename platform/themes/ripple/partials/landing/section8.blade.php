@php
    $heading = theme_option('ldp_s8_heading', 'LAYOUT CĂN HỘ ĐIỂN HÌNH');
    $kidImgOpt = theme_option('ldp_s8_kid_img');
    $kidImgUrl = $kidImgOpt ? RvMedia::getImageUrl($kidImgOpt) : asset('themes/ripple/images/kid.jpg');
    
    $img1Opt = theme_option('ldp_s8_img1');
    $img1Url = $img1Opt ? RvMedia::getImageUrl($img1Opt) : asset('themes/ripple/images/section8-1.png');
    $title1 = theme_option('ldp_s8_title1', 'CĂN HỘ LOẠI A');
    $desc1 = theme_option('ldp_s8_desc1', '(2PN1WC)');
    
    $img2Opt = theme_option('ldp_s8_img2');
    $img2Url = $img2Opt ? RvMedia::getImageUrl($img2Opt) : asset('themes/ripple/images/section8-2.png');
    $title2 = theme_option('ldp_s8_title2', 'CĂN HỘ LOẠI B');
    $desc2 = theme_option('ldp_s8_desc2', '(2PN2WC <70M2)');
    
    $img3Opt = theme_option('ldp_s8_img3');
    $img3Url = $img3Opt ? RvMedia::getImageUrl($img3Opt) : asset('themes/ripple/images/section8-3.png');
    $title3 = theme_option('ldp_s8_title3', 'CĂN HỘ LOẠI C');
    $desc3 = theme_option('ldp_s8_desc3', '(2PN2WC >70M2)');
    
    $img4Opt = theme_option('ldp_s8_img4');
    $img4Url = $img4Opt ? RvMedia::getImageUrl($img4Opt) : asset('themes/ripple/images/section8-4.png');
    $title4 = theme_option('ldp_s8_title4', 'CĂN HỘ LOẠI D');
    $desc4 = theme_option('ldp_s8_desc4', '(3PN2WC)');
@endphp

<section id="section8" class="kia-section-8">
    <!-- Cậu bé góc phải trên -->
    <div class="s8-kid-bg js-reveal">
        <img src="{{ $kidImgUrl }}" alt="Kid" />
    </div>

    <div class="s8-container">
        <h2 class="s8-heading font-selecta-bold js-reveal">{{ $heading }}</h2>

        <div class="s8-layouts-wrapper">
            <div class="s8-row js-reveal" style="transition-delay: 200ms;">
                <div class="s8-item">
                    <img src="{{ $img1Url }}" alt="{{ $title1 }}" class="img-fluid" />
                    <div class="s8-text-box">
                        <h3 class="s8-item-title font-selecta-bold">{{ $title1 }}</h3>
                        <p class="s8-item-desc font-selecta-bold">{{ $desc1 }}</p>
                    </div>
                </div>
                <div class="s8-item">
                    <img src="{{ $img2Url }}" alt="{{ $title2 }}" class="img-fluid" />
                    <div class="s8-text-box">
                        <h3 class="s8-item-title font-selecta-bold">{{ $title2 }}</h3>
                        <p class="s8-item-desc font-selecta-bold">{{ $desc2 }}</p>
                    </div>
                </div>
            </div>
            <div class="s8-row js-reveal" style="transition-delay: 400ms;">
                <div class="s8-item">
                    <img src="{{ $img3Url }}" alt="{{ $title3 }}" class="img-fluid" />
                    <div class="s8-text-box">
                        <h3 class="s8-item-title font-selecta-bold">{{ $title3 }}</h3>
                        <p class="s8-item-desc font-selecta-bold">{{ $desc3 }}</p>
                    </div>
                </div>
                <div class="s8-item">
                    <img src="{{ $img4Url }}" alt="{{ $title4 }}" class="img-fluid" />
                    <div class="s8-text-box">
                        <h3 class="s8-item-title font-selecta-bold">{{ $title4 }}</h3>
                        <p class="s8-item-desc font-selecta-bold">{{ $desc4 }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
