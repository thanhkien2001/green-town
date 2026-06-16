@php
    $heading = theme_option('ldp_s10_heading', 'PHƯƠNG THỨC THANH TOÁN');
    
    $img1Opt = theme_option('ldp_s10_img_1');
    $img1Url = $img1Opt ? RvMedia::getImageUrl($img1Opt) : asset('themes/ripple/images/section10-1.png');
    if ($img1Opt == 'section10-1.png') $img1Url = asset('themes/ripple/images/section10-1.png');

    $img2Opt = theme_option('ldp_s10_img_2');
    $img2Url = $img2Opt ? RvMedia::getImageUrl($img2Opt) : asset('themes/ripple/images/section10-2.png');
    if ($img2Opt == 'section10-2.png') $img2Url = asset('themes/ripple/images/section10-2.png');
@endphp

<style>
    .kia-section-10 {
        position: relative;
    }
    .s10-btn-wrapper {
        position: absolute;
        bottom: -27px; /* Nửa chiều cao nút */
        left: 0;
        width: 100%;
        text-align: center;
        z-index: 50;
    }
    .s10-register-btn {
        display: inline-block;
        background-color: #1a421e;
        color: #ffffff;
        padding: 14px 50px;
        border-radius: 8px;
        font-size: 24px;
        text-transform: uppercase;
        text-decoration: none !important;
        box-shadow: 0 4px 15px rgba(0,0,0,0.15);
        transition: all 0.3s ease;
        white-space: nowrap;
        letter-spacing: 0.5px;
    }
    .s10-register-btn:hover {
        background-color: #0f2711;
        color: #DFEE5D;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.2);
    }
    
    @media (max-width: 767px) {
        .s10-btn-wrapper {
            bottom: -22px; /* Điều chỉnh cho mobile */
        }
        .s10-register-btn {
            font-size: 15px;
            padding: 12px 30px;
        }
    }

    /* Styles for Popup */
    .s10-register-popup {
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%;
        z-index: 99999;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .s10-popup-overlay {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(0,0,0,0.6);
        backdrop-filter: blur(3px);
    }
    .s10-popup-content {
        position: relative;
        background-color: #5ea345;
        padding: 40px 30px;
        border-radius: 12px;
        width: 90%;
        max-width: 600px;
        max-height: 90vh;
        overflow-y: auto;
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        text-align: center;
        color: #fff;
    }
    .s10-popup-close-btn {
        position: absolute;
        top: 10px;
        right: 15px;
        background: none;
        border: none;
        color: #fff;
        font-size: 28px;
        cursor: pointer;
        opacity: 0.8;
    }
    .s10-popup-close-btn:hover { opacity: 1; }
    .s10-popup-title {
        font-size: 30px;
        text-transform: uppercase;
        color: #fff;
    }
    .s10-popup-desc {
        font-size: 18px;
        line-height: 1.5;
        margin-bottom: 30px;
        font-family: 'Montserrat', sans-serif;
        color: #fff;
    }
    .s10-input-group {
        margin-bottom: 20px;
        text-align: left;
    }
    .s10-input-group input {
        width: 100%;
        background: transparent;
        border: none;
        border-bottom: 1px solid rgba(255,255,255,0.4);
        padding: 10px 0;
        color: #fff;
        font-size: 15px;
        font-family: 'Montserrat', sans-serif;
        transition: border-color 0.3s;
    }
    .s10-input-group input:focus {
        outline: none;
        border-bottom-color: #fff;
    }
    .s10-input-group input::placeholder {
        color: rgba(255,255,255,0.8);
    }
    .s10-submit-btn {
        margin-top: 15px;
        width: 100%;
        background-color: #1a421e;
        color: #fff;
        border: none;
        padding: 14px;
        border-radius: 8px;
        font-size: 18px;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .s10-submit-btn:hover {
        background-color: #0f2711;
        color: #DFEE5D;
    }

    @media (max-width: 767px) {
        .s10-popup-content {
            padding: 30px 20px;
            width: 95%;
        }
        .s10-popup-title {
            font-size: 22px;
        }
        .s10-popup-desc {
            font-size: 14px;
            margin-bottom: 20px;
        }
        .s10-input-group {
            margin-bottom: 15px;
        }
        .s10-submit-btn {
            padding: 12px;
            font-size: 16px;
        }
    }
</style>

<section id="section-payment" class="kia-section-10">
    <!-- Leaf Decoration Top Right -->
    <div class="s10-leaf-bg js-reveal" style="transition-delay: 200ms;"></div>

    <div class="s10-container">
        
        <h2 class="s10-heading font-selecta-bold text-center js-reveal">
            {{ $heading }}
        </h2>

        <div class="s10-slider-wrapper js-reveal" style="transition-delay: 400ms;">
            <div class="swiper-container s10-swiper">
                <div class="swiper-wrapper">
                    <!-- Slide 1 -->
                    <div class="swiper-slide">
                        <div class="s10-slide-img-wrap">
                            <img src="{{ $img1Url }}" alt="Phương thức thanh toán 1" />
                        </div>
                    </div>
                    <!-- Slide 2 -->
                    <div class="swiper-slide">
                        <div class="s10-slide-img-wrap">
                            <img src="{{ $img2Url }}" alt="Phương thức thanh toán 2" />
                        </div>
                    </div>
                </div>
                <!-- Pagination / Navigation (hidden per user request) -->
                <!-- <div class="s10-swiper-pagination"></div> -->
            </div>
            
            <!-- Navigation Buttons (hidden per user request) -->
            <!--
            <div class="s10-swiper-button-prev">
                ...
            </div>
            -->
        </div>

    </div>
    
    <div class="s10-btn-wrapper js-reveal" style="transition-delay: 600ms;">
        <a href="#" onclick="openS10Popup(event)" class="s10-register-btn font-selecta-bold">ĐĂNG KÝ NGAY</a>
    </div>
</section>

<!-- S10 Register Popup -->
<div id="s10-register-popup" class="s10-register-popup" style="display: none;">
    <div class="s10-popup-overlay" onclick="closeS10Popup()"></div>
    <div class="s10-popup-content">
        <button type="button" class="s10-popup-close-btn" onclick="closeS10Popup()">&times;</button>
        <h3 class="s10-popup-title font-selecta-bold">NHẬN THÔNG TIN DỰ ÁN</h3>
        <p class="s10-popup-desc">Để lại thông tin liên hệ, nhận tin tức mới nhất của<br>SOLENA BY GREEN TOWN từ chúng tôi</p>
        
        <form id="s10-popup-form" action="{{ route('public.send.contact') }}" method="POST">
            @csrf
            <div class="s10-input-group">
                <input type="text" name="name" placeholder="Họ và tên*" required>
            </div>
            <div class="s10-input-group">
                <input type="text" name="phone" placeholder="Số điện thoại*" required>
            </div>
            <div class="s10-input-group">
                <input type="email" name="email" placeholder="Email*" required>
            </div>
            <div class="s10-input-group">
                <input type="text" name="content" placeholder="Lời nhắn">
            </div>
            <button type="submit" class="s10-submit-btn font-selecta-bold">ĐĂNG KÝ NGAY</button>
        </form>
    </div>
</div>

<script>
    function openS10Popup(e) {
        if(e) e.preventDefault();
        document.getElementById('s10-register-popup').style.display = 'flex';
    }
    function closeS10Popup() {
        document.getElementById('s10-register-popup').style.display = 'none';
    }

    document.addEventListener('DOMContentLoaded', function() {
        var s10Form = document.getElementById('s10-popup-form');
        if (s10Form) {
            s10Form.addEventListener('submit', function (e) {
                e.preventDefault();
                var submitBtn = s10Form.querySelector('.s10-submit-btn');
                var originalText = submitBtn.textContent;
                submitBtn.disabled = true;
                submitBtn.textContent = 'ĐANG GỬI...';

                var formData = new FormData(s10Form);

                fetch(s10Form.action, {
                    method: 'POST',
                    body: formData,
                    headers: { 'Accept': 'application/json' }
                })
                .then(function (response) {
                    return response.json().then(function (data) {
                        if (response.ok && !data.error) {
                            return { success: true, message: 'Đăng ký nhận thông tin thành công! Chúng tôi sẽ liên hệ sớm nhất.' };
                        } else {
                            var errMsg = data.message || 'Đã xảy ra lỗi, vui lòng thử lại sau.';
                            if (data.errors) {
                                errMsg = Object.values(data.errors).flat().join('\n');
                            }
                            return { success: false, message: errMsg };
                        }
                    });
                })
                .then(function (result) {
                    alert(result.message);
                    if (result.success) {
                        s10Form.reset();
                        closeS10Popup();
                    }
                })
                .catch(function (error) {
                    alert('Không thể kết nối máy chủ. Vui lòng thử lại sau!');
                })
                .finally(function () {
                    submitBtn.disabled = false;
                    submitBtn.textContent = originalText;
                });
            });
        }
    });
</script>
