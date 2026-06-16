@php
    // Lấy ảnh nền từ Theme Options
    $bgImageRaw = theme_option('ldp_s2_bg');
    if (!empty($bgImageRaw) && $bgImageRaw != '0' && $bgImageRaw != 'null') {
        if (filter_var($bgImageRaw, FILTER_VALIDATE_URL) || str_starts_with($bgImageRaw, '/') || str_contains($bgImageRaw, 'storage/')) {
            $bgImage = $bgImageRaw;
        } else {
            $bgImage = RvMedia::getImageUrl($bgImageRaw);
        }
    } else {
        $bgImage = asset('themes/ripple/images/section2.webp');
    }

    $bgMobileRaw = theme_option('ldp_s2_bg_mobile');
    $bgMobile = $bgImage;
    if (!empty($bgMobileRaw) && $bgMobileRaw != '0' && $bgMobileRaw != 'null') {
        if (filter_var($bgMobileRaw, FILTER_VALIDATE_URL) || str_starts_with($bgMobileRaw, '/') || str_contains($bgMobileRaw, 'storage/')) {
            $bgMobile = $bgMobileRaw;
        } else {
            $bgMobile = RvMedia::getImageUrl($bgMobileRaw);
        }
    }

    $s2Title = theme_option('ldp_s2_title') ?: 'THÔNG TIN TỔNG QUAN';

    // Cột 1: SOLENA
    $col1Title = theme_option('ldp_s2_col1_title') ?: 'SOLENA';
    $col1ItemsRaw = theme_option('ldp_s2_col1_items');
    $col1Items = [];
    if (!empty($col1ItemsRaw)) {
        $decoded = json_decode($col1ItemsRaw, true);
        if (is_array($decoded)) {
            // Lọc bỏ những dòng không chứa cả label lẫn value
            $col1Items = array_filter($decoded, function($item) {
                return !empty($item['label']) || !empty($item['value']);
            });
        }
    }
    // Nếu không có dữ liệu (hoặc sau khi lọc bị trống) thì dùng fallback mặc định
    if (empty($col1Items)) {
        $col1Items = [
            ['label' => 'Địa chỉ dự án', 'value' => 'B2, Lô 5, khu đô thị Vĩnh Lộc,<br /> phường Bình Tân, TP. Hồ Chí Minh'],
            ['label' => 'Chiều cao', 'value' => '16 tầng'],
            ['label' => 'Tổng số căn', 'value' => '252 căn hộ, 5 căn shophouse'],
            ['label' => 'Diện tích căn hộ', 'value' => ''],
            ['label' => '02 PN', 'value' => '49m2 - 71,89 m2'],
            ['label' => '03 PN', 'value' => '91,74 m2'],
            ['label' => 'Pháp lý', 'value' => 'sở hữu lâu dài'],
        ];
    }

    // Cột 2: GREEN TOWN BÌNH TÂN
    $col2Title = theme_option('ldp_s2_col2_title') ?: 'GREEN TOWN BÌNH TÂN';
    $col2ItemsRaw = theme_option('ldp_s2_col2_items');
    $col2Items = [];
    if (!empty($col2ItemsRaw)) {
        $decoded = json_decode($col2ItemsRaw, true);
        if (is_array($decoded)) {
            // Lọc bỏ những dòng không chứa cả label lẫn value
            $col2Items = array_filter($decoded, function($item) {
                return !empty($item['label']) || !empty($item['value']);
            });
        }
    }
    // Nếu không có dữ liệu (hoặc sau khi lọc bị trống) thì dùng fallback mặc định
    if (empty($col2Items)) {
        $col2Items = [
            ['label' => 'Địa chỉ dự án', 'value' => 'Lô 5, khu đô thị Vĩnh Lộc, phường Bình Tân, TP. Hồ Chí Minh'],
            ['label' => 'Chủ đầu tư', 'value' => 'Công ty TNHH IDE Việt Nam'],
            ['label' => 'Nhà thầu', 'value' => 'CTXD Toàn Thịnh Phát'],
            ['label' => 'Đơn vị quản lý vận hành', 'value' => 'CBRE'],
            ['label' => 'Tổng diện tích', 'value' => '33.740,9 m2'],
            ['label' => 'Quy mô dự án', 'value' => '5 toà tháp căn hộ A, B1, B2, B3, B4'],
            ['label' => 'Chiều cao', 'value' => '16 tầng'],
            ['label' => 'Tổng số căn', 'value' => '1.082 căn hộ'],
        ];
    }
@endphp

<style>
    .overview-section {
        background-image: url('{{ $bgImage }}');
    }
    @media (min-width: 768px) {
        .overview-section.js-reveal {
            opacity: 1 !important;
            transform: none !important;
            transition: none !important;
            visibility: visible !important;
        }
    }
    @media (max-width: 767px) {
        .overview-section {
            background-image: url('{{ $bgMobile }}') !important;
        }
        .overview-section.js-reveal {
            transition: all 1.5s cubic-bezier(0.25, 1, 0.5, 1) !important;
        }
        .overview-section .overview-container,
        .overview-section::before,
        .overview-section::after {
            display: none !important;
        }
    }
</style>

<section id="section-overview" class="overview-section js-reveal">
    <div class="overview-container">
        <!-- Tiêu đề chính -->
        <h2 class="overview-main-title font-selecta-black js-reveal">{{ $s2Title }}</h2>

        <div class="overview-grid">
            <!-- Cột 1: SOLENA (Bên trái) -->
            <div class="overview-column overview-column-left js-reveal" style="transition-delay: 150ms;">
                <div class="column-badge badge-left font-selecta-bold">{{ $col1Title }}</div>
                <ul class="column-info-list">
                    @foreach($col1Items as $item)
                        @php
                            $label = $item['label'] ?? '';
                            $value = $item['value'] ?? '';
                            $isSub = str_starts_with($label, ' ') || str_contains($label, 'PN');
                        @endphp
                        <li class="{{ $isSub ? 'info-sub-item' : '' }}">
                            <span class="info-label font-montserrat-regular">
                                @if(!empty($label))
                                    {{ trim($label) }}:
                                @else
                                    &nbsp;
                                @endif
                            </span>
                            <span class="info-value font-montserrat-bold">{!! $value !!}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Cột 2: GREEN TOWN BÌNH TÂN (Bên phải) -->
            <div class="overview-column overview-column-right js-reveal" style="transition-delay: 300ms;">
                <div class="column-badge badge-right font-selecta-bold">{{ $col2Title }}</div>
                <ul class="column-info-list">
                    @foreach($col2Items as $item)
                        @php
                            $label = $item['label'] ?? '';
                            $value = $item['value'] ?? '';
                            $isSub = str_starts_with($label, ' ') || str_contains($label, 'PN');
                        @endphp
                        <li class="{{ $isSub ? 'info-sub-item' : '' }}">
                            <span class="info-label font-montserrat-regular">
                                @if(!empty($label))
                                    {{ trim($label) }}:
                                @else
                                    &nbsp;
                                @endif
                            </span>
                            <span class="info-value font-montserrat-bold">{!! $value !!}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>
