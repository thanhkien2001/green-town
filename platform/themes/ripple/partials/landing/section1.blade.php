    <!-- SECTION 1: HERO BANNER -->
    @php
        $heroTagline    = theme_option('ldp_hero_tagline') ?: "Kỷ nguyên mới - Công nghệ mới||Điều đặc biệt đang dần lộ diện";
        $countdownLabel = theme_option('ldp_countdown_label') ?: "SẼ XUẤT HIỆN SAU";
        $countdownDate  = theme_option('ldp_countdown_date') ?: "2024/05/20 18:00:00";
        $ctaText        = theme_option('ldp_cta_text') ?: "Đăng ký ngay để khám phá sản phẩm sớm nhất!";
        $ctaBtnText     = theme_option('ldp_cta_btn_text') ?: "Đăng Ký Ngay";
        $logoSrc        = theme_option('logo') ? RvMedia::getImageUrl(theme_option('logo')) : Theme::asset()->url('images/logo.png');

        $bgDesktop      = theme_option('ldp_s1_bg') ? RvMedia::getImageUrl(theme_option('ldp_s1_bg')) : Theme::asset()->url('images/banner-section.jpg');
        $bgMobile       = theme_option('ldp_s1_bg_mb') ? RvMedia::getImageUrl(theme_option('ldp_s1_bg_mb')) : $bgDesktop;
    @endphp
    
    <section class="s1-hero" style="--bg-desktop: url('{{ $bgDesktop }}'); --bg-mobile: url('{{ $bgMobile }}');">
        <div class="s1-hero__inner">
            {{-- Tagline --}}
            <div class="s1-hero__tagline js-reveal" style="transition-delay: 0.2s">
                @foreach(explode('||', $heroTagline) as $line)
                    <p>{{ trim($line) }}</p>
                @endforeach
            </div>

            {{-- Headline --}}
            <div class="s1-hero__headline js-reveal" style="transition-delay: 0.5s">
                <h1>COMING SOON</h1>
                <span class="s1-hero__date">{{ $countdownLabel }}</span>

                <div class="s1-hero__countdown" data-countdown="{{ $countdownDate }}">
                    <div class="countdown-block">
                        <span class="countdown-number" id="cd-days">00</span>
                        <span class="countdown-label font-kia-light">Ngày</span>
                    </div>
                    <div class="countdown-block">
                        <span class="countdown-number" id="cd-hours">00</span>
                        <span class="countdown-label font-kia-light">Giờ</span>
                    </div>
                    <div class="countdown-block">
                        <span class="countdown-number" id="cd-minutes">00</span>
                        <span class="countdown-label font-kia-light">Phút</span>
                    </div>
                    <div class="countdown-block">
                        <span class="countdown-number" id="cd-seconds">00</span>
                        <span class="countdown-label font-kia-light">Giây</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Text mô tả CTA & Nút bấm --}}
        <div class="s1-hero__cta-wrap js-reveal" style="transition-delay: 0.8s">
            <div class="s1-hero__cta">
                <p class="cta-text" style="margin-bottom: 0;">{{ $ctaText }}</p>
            </div>
            <a href="#section4" class="btn-kia-cta">
                {{ $ctaBtnText }}
                <span class="btn-arrow">›</span>
            </a>
        </div>
        {{-- Logo (Absolute Positioned) --}}
        <div class="s1-hero__logo js-reveal" style="transition-delay: 1.2s">
            <img src="{{ $logoSrc }}" alt="KIA Logo">
        </div>
    </section>
