@php
    $heading = theme_option('ldp_s12_heading', 'CHIA SẺ KHÁCH HÀNG');
    
    // Parse the repeater data from theme options
    $themeTestimonials = theme_option('ldp_s12_testimonials');
    $testimonials = [];
    
    if (!empty($themeTestimonials)) {
        $decoded = json_decode($themeTestimonials, true);
        if (is_array($decoded)) {
            foreach ($decoded as $row) {
                $rowData = [];
                foreach ($row as $field) {
                    if (isset($field['key']) && isset($field['value'])) {
                        $rowData[$field['key']] = $field['value'];
                    }
                }
                if (!empty($rowData['name']) || !empty($rowData['content'])) {
                    $testimonials[] = [
                        'name'    => $rowData['name'] ?? '',
                        'content' => $rowData['content'] ?? '',
                        'avatar'  => !empty($rowData['avatar']) ? RvMedia::getImageUrl($rowData['avatar']) : '/themes/ripple/images/s12_avatar.png',
                    ];
                }
            }
        }
    }
    
    // Default data if empty
    if (empty($testimonials)) {
        $testimonials = [
            [
                'name'    => 'Chị Hoa',
                'content' => 'Điều khiến gia đình tôi hài lòng nhất khi sống tại Green Town Bình Tân là mọi thứ đều đáp ứng được nhu cầu cuộc sống hằng ngày. Con có khu vui chơi, có không gian dưới sân để chạy nhảy, còn ba mẹ thì yên tâm hơn vì không phải lúc nào cũng đưa con đi xa mới có chỗ vận động.',
                'avatar'  => '/themes/ripple/images/s12_avatar.png'
            ],
            [
                'name'    => 'Anh Minh',
                'content' => 'Trước đây tôi khá băn khoăn về việc di chuyển, nhưng sau một thời gian sống tại Green Town thì thấy vị trí này khá tiện. Từ đây đi AEON Mall Tân Phú, Pandora, tới các khu văn phòng hay trường học xung quanh đều không quá xa. Với người đi làm mỗi ngày như tôi, điều quan trọng không chỉ là căn nhà, mà là việc cuộc sống có vận hành thuận tiện hay không, có thuận tiện cho con cái học hành hay không. Green Town đáp ứng được điều đó.',
                'avatar'  => '/themes/ripple/images/s12_avatar.png'
            ],
            [
                'name'    => 'Chú Bình',
                'content' => 'Green Town cho tôi cảm giác dễ chịu vì có nhiều không gian xanh, nhịp sống không ngột ngạt. Buổi chiều đi dạo dưới sân, nhìn trẻ con chơi đùa, mọi người ngồi trò chuyện, mình cảm nhận rõ đây là một nơi đáng sống',
                'avatar'  => '/themes/ripple/images/s12_avatar.png'
            ],
            [
                'name'    => 'Chú Bình',
                'content' => 'Green Town cho tôi cảm giác dễ chịu vì có nhiều không gian xanh, nhịp sống không ngột ngạt. Buổi chiều đi dạo dưới sân, nhìn trẻ con chơi đùa, mọi người ngồi trò chuyện, mình cảm nhận rõ đây là một nơi đáng sống',
                'avatar'  => '/themes/ripple/images/s12_avatar.png'
            ]
        ];
    }
@endphp

<section class="section12-wrap">
    <div class="s12-container">
        <h2 class="section12-title text-center">{{ $heading }}</h2>
        
        <div class="s12-slider-wrapper position-relative">
            <!-- Swiper -->
            <div class="swiper">
                <div class="swiper-wrapper">
                    @foreach($testimonials as $testimonial)
                        <div class="swiper-slide">
                            <div class="testimonial-card">
                                <div class="testimonial-avatar">
                                    <img src="{{ $testimonial['avatar'] }}" alt="{{ $testimonial['name'] }}" class="img-fluid rounded-circle">
                                </div>
                                <div class="testimonial-content">
                                    <h3 class="testimonial-name">{{ $testimonial['name'] }}</h3>
                                    <p class="testimonial-text">{{ $testimonial['content'] }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            
            <!-- Navigation arrows -->
            <div class="s12-swiper-button-prev">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15 18L9 12L15 6" stroke="#A8D845" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <div class="s12-swiper-button-next">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 18L15 12L9 6" stroke="#A8D845" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
        </div>
    </div>
</section>
