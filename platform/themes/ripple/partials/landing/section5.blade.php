@php
    $heading = theme_option('ldp_s5_heading', 'QUYẾT ĐỊNH LÊN ĐỜI<br>CÙNG SOLENA BY GREEN TOWN');
    
    $features = [
        [
            'title' => theme_option('ldp_s5_f1_title', 'MẢNH GHÉP MỚI'),
            'desc' => theme_option('ldp_s5_f1_desc', 'Mảnh ghép cuối cùng hoàn thiện Green Town Binh Tan - tâm điểm KĐT Vĩnh Lộc 110ha'),
        ],
        [
            'title' => theme_option('ldp_s5_f2_title', 'BLOCK MỚI, NHÀ MỚI'),
            'desc' => theme_option('ldp_s5_f2_desc', 'Căn hộ thiết kế tối ưu - Bàn giao đầy đủ nội thất - Hình thức sở hữu lâu dài'),
        ],
        [
            'title' => theme_option('ldp_s5_f3_title', 'TIỆN ÍCH MỚI, DIỆN MẠO MỚI'),
            'desc' => theme_option('ldp_s5_f3_desc', 'Đặc quyền dành riêng cho cư dân với công viên trung tâm, bể bơi vô cực, trung tâm thương mại...'),
        ],
        [
            'title' => theme_option('ldp_s5_f4_title', 'CUỘC SỐNG MỚI, HÀNG XÓM MỚI'),
            'desc' => theme_option('ldp_s5_f4_desc', 'Cộng đồng cư dân hiện hữu, văn minh & thân thiện'),
        ],
        [
            'title' => theme_option('ldp_s5_f5_title', 'CƠ HỘI MỚI, CỘT MỐC TĂNG GIÁ MỚI'),
            'desc' => theme_option('ldp_s5_f5_desc', 'Dễ dàng sở hữu căn hộ với mức giá hấp dẫn, tiềm năng gia tăng giá trị cao trong tương lai.'),
        ]
    ];
@endphp

<section id="section5" class="kia-section-5" style="background-color: #295420; position: relative; z-index: 2;">
    <!-- Lotus Image -->
    <div class="s5-lotus-bg"></div>

    <div class="s5-container">
        <div class="s5-content-wrapper">
            <h2 class="s5-heading text-uppercase font-selecta-bold js-reveal">{!! $heading !!}</h2>

            <div class="s5-features">
                @foreach ($features as $index => $feature)
                    @if ($feature['title'])
                        <div class="s5-feature-item js-reveal" style="transition-delay: {{ $index * 150 }}ms;">
                            <h3 class="s5-feature-title text-uppercase font-selecta-bold">{{ $feature['title'] }}</h3>
                            @if ($feature['desc'])
                                <p class="s5-feature-desc">{{ $feature['desc'] }}</p>
                            @endif
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</section>
