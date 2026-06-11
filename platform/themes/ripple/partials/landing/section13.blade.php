@php
    $bgImageRaw = theme_option('ldp_s13_bg');
    if (!empty($bgImageRaw)) {
        if (filter_var($bgImageRaw, FILTER_VALIDATE_URL) || str_starts_with($bgImageRaw, '/') || str_contains($bgImageRaw, 'storage/')) {
            $bgImage = $bgImageRaw;
        } else {
            $bgImage = RvMedia::getImageUrl($bgImageRaw);
        }
    } else {
        $bgImage = '/themes/ripple/images/section13-bg-placeholder.jpg'; // Just a fallback if nothing is uploaded
    }
@endphp

<section id="section13" class="s13-wrap">
    <div class="s13-image-container">
        <!-- The background image that contains the design -->
        <img src="{{ $bgImage }}" alt="Section 13" class="s13-bg-image">
        
        <!-- Visible form overlaying the image -->
        <div class="s13-form-overlay">
            <form class="s13-contact-form">
                <input type="text" class="s13-input" placeholder="Họ và tên*">
                <input type="text" class="s13-input" placeholder="Số điện thoại*">
                <input type="email" class="s13-input" placeholder="Email*">
                <input type="text" class="s13-input" placeholder="Lời nhắn">
                <button type="submit" class="s13-submit-btn">ĐĂNG KÝ NHẬN THÔNG TIN</button>
            </form>
        </div>
    </div>
</section>
