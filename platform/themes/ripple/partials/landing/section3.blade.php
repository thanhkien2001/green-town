<!-- SECTION 3: 3 ĐIỂM NỔI BẬT -->
@php
    $f1Img   = theme_option('ldp_s3_f1_img') ? RvMedia::getImageUrl(theme_option('ldp_s3_f1_img')) : '';
    $f1Title = theme_option('ldp_s3_f1_title') ?: 'Ngôn Ngữ nhận diện Star-map';
    $f1Desc  = theme_option('ldp_s3_f1_desc') ?: 'DNA Thiết Kế SUV Kia';

    $f2Img   = theme_option('ldp_s3_f2_img') ? RvMedia::getImageUrl(theme_option('ldp_s3_f2_img')) : Theme::asset()->url('images/6919a0a134de4923b37b1ae474820a2e6e8c996c.png');
    $f2Title = theme_option('ldp_s3_f2_title') ?: 'Không gian nội thất';
    $f2Desc  = theme_option('ldp_s3_f2_desc') ?: 'đầy cảm hứng';

    $f3Img   = theme_option('ldp_s3_f3_img') ? RvMedia::getImageUrl(theme_option('ldp_s3_f3_img')) : '';
    $f3Title = theme_option('ldp_s3_f3_title') ?: 'Công nghệ Hybrid cao cấp';
    $f3Desc  = theme_option('ldp_s3_f3_desc') ?: 'vận hành mạnh mẽ, êm ái';

    // Cấu hình ảnh nền chính (Base Background) qua Theme Option
    $bgBaseRaw = theme_option('ldp_s3_bg');
    if (!empty($bgBaseRaw)) {
        if (filter_var($bgBaseRaw, FILTER_VALIDATE_URL) || str_starts_with($bgBaseRaw, '/') || str_contains($bgBaseRaw, 'storage/')) {
            $bgBase = $bgBaseRaw;
        } else {
            $bgBase = RvMedia::getImageUrl($bgBaseRaw);
        }
    } else {
        $bgBase = Theme::asset()->url('images/2012_405.svg');
    }

    // Đọc ảnh nền mobile của Section 3
    $s3BgMb = theme_option('ldp_s3_bg_mb');
    if (!empty($s3BgMb)) {
        if (filter_var($s3BgMb, FILTER_VALIDATE_URL) || str_starts_with($s3BgMb, '/') || str_contains($s3BgMb, 'storage/')) {
            $bgMobile = $s3BgMb;
        } else {
            $bgMobile = RvMedia::getImageUrl($s3BgMb);
        }
    } else {
        $bgMobile = $bgBase;
    }

    // Lọc sạch URL cho môi trường ngrok / điện thoại di động thật
    if (str_contains($bgBase, '/storage/')) {
        $bgBase = strstr($bgBase, '/storage/');
    } elseif (str_contains($bgBase, '/themes/')) {
        $bgBase = strstr($bgBase, '/themes/');
    }

    if (str_contains($bgMobile, '/storage/')) {
        $bgMobile = strstr($bgMobile, '/storage/');
    } elseif (str_contains($bgMobile, '/themes/')) {
        $bgMobile = strstr($bgMobile, '/themes/');
    }
@endphp

<section id="section-highlights" class="kia-section-highlights">
  <!-- Background Layers sử dụng thẻ picture responsive chuẩn HTML5 -->
  <div class="background-layers">
    <div class="merged-bg-container">
      <picture class="bg-picture-wrapper">
        <source media="(max-width: 768px)" srcset="{{ $bgMobile }}" />
        <img
          src="{{ $bgBase }}"
          class="bg-layer layer-base"
          alt="Background Base"
        />
      </picture>
    </div>
  </div>

  <div class="content-container">
    <!-- Features Top Section -->
    <div class="features-top">
      
      <!-- Cột 1 -->
      <div class="feature-col highlight-card-zoom js-reveal">
        @if ($f1Img)
          <div class="car-interior-img">
            <img src="{{ $f1Img }}" class="zoom-image" alt="{{ $f1Title }}" />
          </div>
        @endif
        <h3 class="feature-title">{{ $f1Title }}</h3>
        <p class="feature-desc">{{ $f1Desc }}</p>
      </div>

      <!-- Cột 2 -->
      <div class="feature-col center-col highlight-card-zoom js-reveal">
        @if ($f2Img)
          <div class="car-interior-img">
            <img src="{{ $f2Img }}" class="zoom-image" alt="{{ $f2Title }}" />
          </div>
        @endif
        <h3 class="feature-title">{{ $f2Title }}</h3>
        <p class="feature-desc">{{ $f2Desc }}</p>
      </div>

      <!-- Cột 3 -->
      <div class="feature-col highlight-card-zoom js-reveal">
        @if ($f3Img)
          <div class="car-interior-img">
            <img src="{{ $f3Img }}" class="zoom-image" alt="{{ $f3Title }}" />
          </div>
        @endif
        <h3 class="feature-title">{{ $f3Title }}</h3>
        <p class="feature-desc">{{ $f3Desc }}</p>
      </div>

    </div>
  </div>
</section>
