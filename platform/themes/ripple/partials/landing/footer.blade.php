<footer class="ldp-footer">
    <!-- Logo Column -->
    <div class="ldp-footer-col ldp-footer-logo-col">
        @php
            $footerLogo = theme_option('ldp_footer_logo') ?: theme_option('logo');
        @endphp
        @if($footerLogo)
            <img src="{{ RvMedia::getImageUrl($footerLogo) }}" alt="Solena Logo" class="ldp-footer-logo">
        @else
            <h2 style="color: #A8D845; font-size: 40px; margin-bottom: 0;">SOLENA</h2>
            <p style="color: #fff; font-size: 14px; text-transform: uppercase;">An yên giữa nhịp sống đô thị</p>
        @endif
    </div>

    <!-- Info Column -->
    <div class="ldp-footer-col">
        <h3 class="ldp-footer-title">THÔNG TIN DỰ ÁN</h3>
        <ul class="ldp-footer-list">
            @if(theme_option('ldp_footer_address', 'Lô 5, khu đô thị Vĩnh Lộc, phường Bình Tân, TP. Hồ Chí Minh'))
            <li>
                <i class="fas fa-map-marker-alt"></i>
                <span>{{ theme_option('ldp_footer_address', 'Lô 5, khu đô thị Vĩnh Lộc, phường Bình Tân, TP. Hồ Chí Minh') }}</span>
            </li>
            @endif
            @if(theme_option('ldp_footer_email'))
            <li>
                <i class="fas fa-envelope"></i>
                <span>{{ theme_option('ldp_footer_email') }}</span>
            </li>
            @else
            <li>
                <i class="fas fa-envelope"></i>
                <span></span>
            </li>
            @endif
            @if(theme_option('ldp_footer_phone', '+84.97.785.07.50'))
            <li>
                <i class="fas fa-phone-alt"></i>
                <span>{{ theme_option('ldp_footer_phone', '+84.97.785.07.50') }}</span>
            </li>
            @endif
        </ul>
    </div>

    <!-- Social Column -->
    <div class="ldp-footer-col">
        <h3 class="ldp-footer-title">THEO DÕI DỰ ÁN</h3>
        <div class="ldp-footer-socials">
            @if(theme_option('ldp_footer_facebook', '#'))
                <a href="{{ theme_option('ldp_footer_facebook', '#') }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
            @endif
            @if(theme_option('ldp_footer_youtube', '#'))
                <a href="{{ theme_option('ldp_footer_youtube', '#') }}" target="_blank"><i class="fab fa-youtube"></i></a>
            @endif
        </div>
    </div>
</footer>
