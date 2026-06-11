@php
    $bgImageRaw = theme_option('ldp_s13_bg');
    if (!empty($bgImageRaw)) {
        if (filter_var($bgImageRaw, FILTER_VALIDATE_URL) || str_starts_with($bgImageRaw, '/') || str_contains($bgImageRaw, 'storage/')) {
            $bgImage = $bgImageRaw;
        } else {
            $bgImage = RvMedia::getImageUrl($bgImageRaw);
        }
    } else {
        $bgImage = asset('themes/ripple/images/section13-bg-placeholder.webp');
    }
@endphp

<section id="section13" class="s13-wrap">
    <div class="s13-image-container">
        <!-- The background image that contains the design -->
        @if($bgImage)
            <img src="{{ $bgImage }}" alt="Section 13" class="s13-bg-image">
        @endif
        
        <!-- Visible form overlaying the image -->
        <div class="s13-form-overlay">
            <form id="s13-contact-form" action="{{ route('public.send.contact') }}" method="POST" class="s13-contact-form">
                @csrf
                <input type="text" name="name" class="s13-input" placeholder="Họ và tên*" required>
                <input type="text" name="phone" class="s13-input" placeholder="Số điện thoại*" required>
                <input type="email" name="email" class="s13-input" placeholder="Email*" required>
                <input type="text" name="content" class="s13-input" placeholder="Lời nhắn*" required>
                
                <button type="submit" class="s13-submit-btn">ĐĂNG KÝ NHẬN THÔNG TIN</button>
            </form>
        </div>
    </div>
</section>

<!-- S13 Popup -->
<div id="s13-popup" class="s13-popup" style="display: none;">
    <div class="s13-popup-content">
        <h3 id="s13-popup-title">Thông báo</h3>
        <p id="s13-popup-message">Nội dung thông báo</p>
        <button type="button" class="s13-popup-close" onclick="document.getElementById('s13-popup').style.display='none'">Đóng</button>
    </div>
</div>
