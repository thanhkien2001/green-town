@php
    // Đọc ảnh bản đồ bên trái từ Theme Options, fallback về ảnh trong assets
    $mapRaw = theme_option('ldp_s4_map_img');
    if (!empty($mapRaw) && $mapRaw != '0' && $mapRaw != 'null') {
        if (filter_var($mapRaw, FILTER_VALIDATE_URL) || str_starts_with($mapRaw, '/') || str_contains($mapRaw, 'storage/')) {
            $mapImg = $mapRaw;
        } else {
            $mapImg = RvMedia::getImageUrl($mapRaw);
        }
    } else {
        $mapImg = asset('themes/ripple/images/map-left-section4.webp');
    }

    // Làm sạch URL để tương thích ngrok/local IP
    if (str_contains($mapImg, '/storage/')) {
        $mapImg = strstr($mapImg, '/storage/');
    } elseif (str_contains($mapImg, '/themes/')) {
        $mapImg = strstr($mapImg, '/themes/');
    }

    // Đọc text từ Theme Options
    $s4Title = theme_option('ldp_s4_title') ?: 'GREEN TOWN BÌNH TÂN';
    $s4Subtitle = theme_option('ldp_s4_subtitle') ?: 'ĐÔ THỊ 15 PHÚT PHÍA TÂY TP. HỒ CHÍ MINH';
    
    $s4ItemsRaw = theme_option('ldp_s4_items');
    $s4Items = [];
    if (!empty($s4ItemsRaw)) {
        // Tách theo dòng
        $lines = preg_split('/\r\n|\r|\n/', $s4ItemsRaw);
        foreach ($lines as $line) {
            $trimmed = trim($line);
            if (!empty($trimmed)) {
                $s4Items[] = $trimmed;
            }
        }
    }

    // Mặc định nếu chưa nhập dữ liệu
    if (empty($s4Items)) {
        $s4Items = [
            'Chỉ 300m tới trung tâm hành chính Bình Hưng Hoà',
            'Chỉ 500m tới trường học các cấp: Trường mầm non - tiểu học Trí Tuệ Việt, Trường Tiểu học Ngô Quyền, Trường THPT Vĩnh Lộc, THCS Huỳnh Văn Nghệ...',
            'Đối diện công viên hồ trái tim.',
            'Liền kề trung tâm thể dục thể thao.',
            '5 phút tới trung tâm thương mại AEON Mall Tân Phú',
            '5 phút tới trung tâm thương mại Pandora City',
            '7 phút tới Bến xe An Sương',
            '10 phút tới Sân bay Tân Sơn Nhất',
            '10 phút tới KCN Vĩnh Lộc, KCN Tân Bình, KCN Tân Tạo',
            '10 phút tới Tòa nhà Etown Tower phường Tân Bình'
        ];
    }
@endphp

<section id="section-utilities" class="utilities-section">
    <div class="utilities-wrapper">
        <!-- 1. BÊN TRÁI: Ảnh bản đồ lớn tràn viền -->
        <div class="utilities-map-panel js-reveal">
            <img src="{{ $mapImg }}" alt="Bản đồ kết nối tiện ích Green Town Bình Tân" class="map-image" />
        </div>

        <!-- 2. BÊN PHẢI: Khối thông tin kết nối và hình trang trí -->
        <div class="utilities-info-panel">
            <!-- Khối chữ tiêu đề và danh sách -->
            <div class="info-content-box">
                <h2 class="utility-title font-selecta-black js-reveal">{{ $s4Title }}</h2>
                <h3 class="utility-subtitle font-selecta-bold js-reveal" style="transition-delay: 100ms;">{{ $s4Subtitle }}</h3>

                <ul class="utility-list">
                    @foreach($s4Items as $index => $item)
                        <li class="utility-item js-reveal" style="transition-delay: {{ 150 + ($index * 50) }}ms;">
                            <span class="bullet-dot"></span>
                            <div class="item-text font-montserrat-medium">{{ $item }}</div>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Hình ảnh lá cây trang trí bay rải rác -->
            <div class="decor-leaves js-reveal" style="transition-delay: 600ms;">
                <img src="{{ asset('themes/ripple/images/la-s4.png') }}" alt="Lá xanh trang trí" class="leaves-image" />
            </div>

            <!-- Mascot cậu bé vẫy tay ở góc phải -->
            <div class="decor-mascot js-reveal" style="transition-delay: 750ms;">
                <img src="{{ asset('themes/ripple/images/btv.png') }}" alt="Mascot Green Town" class="mascot-image" />
            </div>
        </div>
    </div>
</section>
