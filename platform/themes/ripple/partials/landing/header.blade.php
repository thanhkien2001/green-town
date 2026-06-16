@php
    // Logo 1
    $logo1Raw = theme_option('ldp_header_logo1');
    $logo1 = asset('storage/footer/logo.png');
    if (!empty($logo1Raw) && $logo1Raw != '0' && $logo1Raw != 'null') {
        $logo1 = RvMedia::getImageUrl($logo1Raw);
    }

    // Logo 2
    $logo2Raw = theme_option('ldp_header_logo2');
    $logo2 = asset('themes/ripple/images/logo2.png');
    if (!empty($logo2Raw) && $logo2Raw != '0' && $logo2Raw != 'null') {
        $logo2 = RvMedia::getImageUrl($logo2Raw);
    }

    // Menu list từ theme options (cấu hình trong admin)
    $menuRaw = theme_option('ldp_header_menu');
    $menuItems = [];
    if (!empty($menuRaw)) {
        $decodedMenu = is_array($menuRaw) ? $menuRaw : json_decode($menuRaw, true);
        if (is_array($decodedMenu)) {
            foreach ($decodedMenu as $row) {
                $rowData = [];
                if (is_array($row)) {
                    foreach ($row as $field) {
                        if (isset($field['key']) && isset($field['value'])) {
                            $rowData[$field['key']] = $field['value'];
                        }
                    }
                }
                if (!empty($rowData['title']) || !empty($rowData['anchor'])) {
                    $menuItems[] = [
                        'title'  => $rowData['title'] ?? '',
                        'anchor' => $rowData['anchor'] ?? '',
                    ];
                }
            }
        }
    }

    // Fallback menu nếu chưa cấu hình trong theme options hoặc cấu hình rỗng
    if (empty($menuItems)) {
        $menuItems = [
            ['title' => 'Tổng quan', 'anchor' => '#section-overview'],
            ['title' => 'Vị trí', 'anchor' => '#section-location'],
            ['title' => 'Tiện ích', 'anchor' => '#section-utilities'],
            ['title' => 'Mặt bằng', 'anchor' => '#section-layout'],
            ['title' => 'Thanh toán', 'anchor' => '#section-payment'],
            ['title' => 'Hình ảnh', 'anchor' => '#section-image'],
            ['title' => 'Liên hệ', 'anchor' => '#section-contact'],
        ];
    }
@endphp

<header class="ldp-header sticky-header">
    <div class="ldp-header-container">
        <!-- Logo Group (Double Logo) -->
        <a href="#section-hero" class="ldp-logo-group js-scroll-trigger">
            @if($logo1)
                <img src="{{ $logo1 }}" alt="Logo 1" class="ldp-logo logo-primary" />
            @endif
            <span class="logo-divider"></span>
            @if($logo2)
                <img src="{{ $logo2 }}" alt="Logo 2" class="ldp-logo logo-secondary" />
            @endif
        </a>

        <!-- Desktop Navigation -->
        <nav class="ldp-nav-desktop">
            <ul class="ldp-menu-list">
                @foreach($menuItems as $item)
                    @if(!empty($item['title']) && !empty($item['anchor']))
                        <li class="ldp-menu-item">
                            <a href="{{ $item['anchor'] }}" class="ldp-menu-link js-scroll-trigger" data-anchor="{{ $item['anchor'] }}">
                                {{ $item['title'] }}
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </nav>

        <!-- Mobile Hamburger Button -->
        <button type="button" class="ldp-hamburger" id="js-ldp-hamburger" aria-label="Toggle menu">
            <span class="hamburger-bar"></span>
            <span class="hamburger-bar"></span>
            <span class="hamburger-bar"></span>
        </button>
    </div>

    <!-- Mobile Navigation Panel -->
    <nav class="ldp-nav-mobile" id="js-ldp-nav-mobile">
        <ul class="ldp-menu-list-mobile">
            @foreach($menuItems as $item)
                @if(!empty($item['title']) && !empty($item['anchor']))
                    <li class="ldp-menu-item-mobile">
                        <a href="{{ $item['anchor'] }}" class="ldp-menu-link-mobile js-scroll-trigger" data-anchor="{{ $item['anchor'] }}">
                            <span class="menu-number">0{{ $loop->iteration }}.</span>
                            <span class="menu-text">{{ $item['title'] }}</span>
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </nav>
</header>
