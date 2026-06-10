<!-- SECTION 4: FORM THU LEAD -->
@php
    // Đọc an toàn ảnh nền ngang cho desktop
    $bgImageRaw = theme_option('ldp_s4_bg');
    if (!empty($bgImageRaw)) {
        // Nếu đã là URL đầy đủ hoặc đường dẫn tuyệt đối
        if (filter_var($bgImageRaw, FILTER_VALIDATE_URL) || str_starts_with($bgImageRaw, '/') || str_contains($bgImageRaw, 'storage/')) {
            $bgImage = $bgImageRaw;
        } else {
            $bgImage = RvMedia::getImageUrl($bgImageRaw);
        }
    } else {
        $bgImage = Theme::asset()->url('images/58ccb2e902e84249abf9f017170b1b87b5a2560c.png');
    }

    // Đọc an toàn ảnh nền cho mobile, ưu tiên ldp_s4_bg_mb, sau đó là ldp_s1_bg_mb, và cuối cùng fallback về ảnh desktop
    $s4BgMb = theme_option('ldp_s4_bg_mb');
    $s1BgMb = theme_option('ldp_s1_bg_mb');

    if (!empty($s4BgMb)) {
        if (filter_var($s4BgMb, FILTER_VALIDATE_URL) || str_starts_with($s4BgMb, '/') || str_contains($s4BgMb, 'storage/')) {
            $bgMobile = $s4BgMb;
        } else {
            $bgMobile = RvMedia::getImageUrl($s4BgMb);
        }
    } elseif (!empty($s1BgMb)) {
        if (filter_var($s1BgMb, FILTER_VALIDATE_URL) || str_starts_with($s1BgMb, '/') || str_contains($s1BgMb, 'storage/')) {
            $bgMobile = $s1BgMb;
        } else {
            $bgMobile = RvMedia::getImageUrl($s1BgMb);
        }
    } else {
        $bgMobile = $bgImage;
    }

    /* 
       Kỹ thuật Ngrok / Local Network Path Cleansing:
       Khi test bằng điện thoại thật qua ngrok hoặc IP nội bộ, nếu đường dẫn ảnh là URL tuyệt đối 
       chứa domain ảo "http://kia-ldp.code/...", điện thoại thật sẽ bị lỗi ERR_NAME_NOT_RESOLVED 
       do không thể phân giải được domain ảo này.
       Bằng cách chuyển đổi URL tuyệt đối thành đường dẫn tương đối (/storage/...), 
       cả máy tính local và điện thoại thật qua ngrok đều sẽ tự động tải tài nguyên từ 
       domain tương ứng cực kỳ mượt mà và an toàn!
    */
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

    // Đọc động các văn bản (text) từ Theme Option, tự động fallback về giá trị mặc định chuẩn nếu chưa cấu hình
    $subtitle  = theme_option('ldp_s4_subtitle') ?: "Đăng ký ngay hôm nay để bắt đầu hành trình khám phá";
    $title     = theme_option('ldp_s4_title') ?: "Kỷ nguyên mới - Công nghệ mới";
    $btnText   = theme_option('ldp_s4_btn_text') ?: "Đăng ký ngay";
    
    $link1Text = theme_option('ldp_s4_link1_text') ?: "Đại lý gần nhất";
    $link1Url  = theme_option('ldp_s4_link1_url') ?: "#dealer";
    
    $link2Text = theme_option('ldp_s4_link2_text') ?: "Sản phẩm";
    $link2Url  = theme_option('ldp_s4_link2_url') ?: "#products";
    
    $link3Text = theme_option('ldp_s4_link3_text') ?: "Liên hệ";
    $link3Url  = theme_option('ldp_s4_link3_url') ?: "#contact";
@endphp

<section id="section-lead-form" class="kia-section-lead-form">
  <!-- Background Layer sử dụng thẻ picture responsive chuẩn HTML5 -->
  <div class="background-layers">
    <div class="merged-bg-container">
      <picture class="bg-picture-wrapper">
        <source media="(max-width: 768px)" srcset="{{ $bgMobile }}" />
        <img
          src="{{ $bgImage }}"
          class="bg-layer"
          alt="Background Section 4"
        />
      </picture>
    </div>
  </div>

  <div class="content-container">
    <!-- Registration Form Section -->
    <div class="registration-area">
      <p class="reg-subtitle js-reveal" style="transition-delay: 0.15s;">
        {{ $subtitle }}
      </p>
      
      <!-- Chuyển tiêu đề sang dạng văn bản CSS thuần chất lượng cao thay vì hình ảnh SVG dễ vỡ -->
      <h2 class="reg-title js-reveal" style="transition-delay: 0.35s;">{{ $title }}</h2>

      <!-- Bọc cụm ô nhập bằng thẻ Form chuẩn chỉnh, gửi dữ liệu dạng AJAX không load lại trang -->
      <form action="{{ route('public.send.contact') }}" method="POST" class="kia-contact-ajax-form form-container js-reveal" style="transition-delay: 0.55s;">
        @csrf
        <div class="form-row">
          <div class="form-label desktop-only">Họ/Tên*</div>
          <div class="form-inputs split">
            <div class="input-group">
              <div class="form-label mobile-only">Họ*</div>
              <div class="input-wrapper">
                <input type="text" name="ho" placeholder="Họ" required />
              </div>
            </div>
            <div class="input-group">
              <div class="form-label mobile-only">Tên*</div>
              <div class="input-wrapper">
                <input type="text" name="ten" placeholder="Tên" required />
              </div>
            </div>
          </div>
        </div>

        <div class="form-row">
          <div class="form-label desktop-only">
            Email*<br />
            Số Điện Thoại*
          </div>
          <div class="form-inputs split">
            <div class="input-group">
              <div class="form-label mobile-only">Email*</div>
              <div class="input-wrapper">
                <input type="email" name="email" placeholder="Email" required />
              </div>
            </div>
            <div class="input-group">
              <div class="form-label mobile-only">Số Điện Thoại*</div>
              <div class="input-wrapper">
                <input type="tel" name="phone" placeholder="Số điện thoại" required />
              </div>
            </div>
          </div>
        </div>

        <div class="form-row">
          <div class="form-label desktop-only">Tỉnh/Thành*</div>
          <div class="form-inputs full">
            <div class="input-group">
              <div class="form-label mobile-only">Tỉnh/Thành*</div>
              <!-- Tích hợp Custom Select UI hoàn toàn đồng bộ, mượt mà và cao cấp -->
              <div class="input-wrapper select-wrapper custom-select-container" id="kia-province-select-container">
                <div class="custom-select-trigger" id="kia-province-select-trigger">
                  <span class="selected-value">Vui lòng chọn tỉnh thành</span>
                </div>
                <div class="custom-options-dropdown">
                  <ul class="custom-options-list" id="kia-custom-options-list">
                    <li class="loading-text">Đang tải danh sách tỉnh thành...</li>
                  </ul>
                </div>
                <!-- Input ẩn lưu giá trị Tỉnh/Thành gửi lên Laravel Controller -->
                <input type="hidden" name="tinh_thanh" id="kia-hidden-province-input" required />
              </div>
            </div>
          </div>
        </div>

        <div class="submit-btn-wrapper">
          <button type="submit" class="submit-btn">
            <span class="btn-text">{{ $btnText }}</span>
            <span class="btn-icon">›</span>
          </button>
        </div>
      </form>
    </div>

    <!-- Footer Links Section (Tối giản 100% bằng CSS, sạch bóng các thẻ hình ảnh bị vỡ đường dẫn) -->
    <div class="footer-links js-reveal" style="transition-delay: 0.75s;">
      <a href="{{ $link1Url }}" class="footer-link">
        <span>{{ $link1Text }}</span>
      </a>
      <a href="{{ $link2Url }}" class="footer-link center-link">
        <span>{{ $link2Text }}</span>
      </a>
      <a href="{{ $link3Url }}" class="footer-link">
        <span>{{ $link3Text }}</span>
      </a>
    </div>
  </div>
</section>
