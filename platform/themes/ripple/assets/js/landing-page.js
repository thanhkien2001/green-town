/* =============================================================
   KIA Landing Page — JavaScript
   ============================================================= */

(function () {
    'use strict';

    // ── Scroll Reveal (IntersectionObserver) ───────────────────────────────────
    function initScrollReveal() {
        const elements = document.querySelectorAll('.js-reveal');
        if (!elements.length) return;

        const observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-revealed');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12 });

        elements.forEach(function (el) {
            observer.observe(el);
        });
    }

    // ── Countdown ─────────────────────────────────────────────────────────────
    function initCountdown() {
        var countdownEl = document.querySelector('[data-countdown]');
        if (!countdownEl) return;

        var targetDate = new Date(countdownEl.getAttribute('data-countdown')).getTime();

        var daysEl    = document.getElementById('cd-days');
        var hoursEl   = document.getElementById('cd-hours');
        var minutesEl = document.getElementById('cd-minutes');
        var secondsEl = document.getElementById('cd-seconds');

        if (!daysEl || !hoursEl || !minutesEl || !secondsEl) return;

        var pad = function (n) {
            return String(n).padStart(2, '0');
        };

        var tick = function () {
            var now      = new Date().getTime();
            var distance = targetDate - now;

            if (distance <= 0) {
                daysEl.textContent    = '00';
                hoursEl.textContent   = '00';
                minutesEl.textContent = '00';
                secondsEl.textContent = '00';
                return;
            }

            var days    = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours   = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            daysEl.textContent    = pad(days);
            hoursEl.textContent   = pad(hours);
            minutesEl.textContent = pad(minutes);
            secondsEl.textContent = pad(seconds);
        };

        tick();
        setInterval(tick, 1000);
    }

    // ── Smooth scroll for CTA button ──────────────────────────────────────────
    function initSmoothScroll() {
        document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
            anchor.addEventListener('click', function (e) {
                var targetId = this.getAttribute('href').slice(1);
                var target   = document.getElementById(targetId);
                if (target) {
                    e.preventDefault();
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });
    }

    // ── Video Player ──────────────────────────────────────────────────────────
    function initVideoPlayer() {
        var playBtn = document.querySelector('.js-play-btn');
        var video   = document.querySelector('.js-teaser-video');
        var overlay = document.querySelector('.js-video-overlay');

        if (!playBtn || !video || !overlay) return;

        playBtn.addEventListener('click', function () {
            if (video.paused) {
                video.play();
                overlay.classList.add('is-hidden');
            } else {
                video.pause();
            }
        });
        
        video.addEventListener('ended', function () {
            overlay.classList.remove('is-hidden');
        });
    }

    // ── Premium Custom Province Selector via Live CAS API ───────────────────────
    function initProvinceSelect() {
        var container = document.getElementById('kia-province-select-container');
        var trigger = document.getElementById('kia-province-select-trigger');
        var optionsList = document.getElementById('kia-custom-options-list');
        var hiddenInput = document.getElementById('kia-hidden-province-input');
        var selectedValSpan = container ? container.querySelector('.selected-value') : null;

        if (!container || !trigger || !optionsList || !hiddenInput || !selectedValSpan) return;

        // Danh sách dự phòng (Fallback) 34 tỉnh thành sau sáp nhập chuẩn xác
        var fallbackProvinces = [
            "Hà Nội", "Cao Bằng", "Tuyên Quang", "Điện Biên", "Lai Châu", "Sơn La", 
            "Lào Cai", "Thái Nguyên", "Lạng Sơn", "Quảng Ninh", "Bắc Ninh", "Phú Thọ", 
            "Hải Phòng", "Hưng Yên", "Ninh Bình", "Thanh Hóa", "Nghệ An", "Hà Tĩnh", 
            "Quảng Trị", "Thừa Thiên Huế", "Đà Nẵng", "Quảng Ngãi", "Gia Lai", "Khánh Hòa", 
            "Đắk Lắk", "Lâm Đồng", "Đồng Nai", "TP. Hồ Chí Minh", "Tây Ninh", "Đồng Tháp", 
            "Vĩnh Long", "An Giang", "Cần Thơ", "Cà Mau"
        ];

        // Thứ tự vàng ưu tiên hiển thị của 6 Thành phố trực thuộc Trung ương
        var hotProvincesOrder = [
            "Hà Nội",
            "TP. Hồ Chí Minh",
            "Đà Nẵng",
            "Hải Phòng",
            "Cần Thơ",
            "Thừa Thiên Huế"
        ];

        // Lọc sạch tên rườm rà "Thành phố", "Tỉnh"
        var cleanName = function (name) {
            var cleaned = name.replace(/^(Tỉnh|Thành phố)\s+/i, '').trim();
            if (cleaned.toLowerCase() === "hồ chí minh") {
                return "TP. Hồ Chí Minh";
            }
            if (cleaned.toLowerCase() === "huế") {
                return "Thừa Thiên Huế";
            }
            return cleaned;
        };

        // Render danh sách options li tự xây dựng (Custom Select)
        var renderOptions = function (provinces) {
            optionsList.innerHTML = '';
            
            var priorityList = [];
            var normalList = [];

            provinces.forEach(function (p) {
                var cleaned = cleanName(p);
                var isPriority = hotProvincesOrder.some(function (hot) {
                    return cleaned.toLowerCase() === hot.toLowerCase();
                });
                
                if (isPriority) {
                    priorityList.push(cleaned);
                } else {
                    normalList.push(cleaned);
                }
            });

            // Sắp xếp mảng ưu tiên
            priorityList.sort(function (a, b) {
                return hotProvincesOrder.indexOf(a) - hotProvincesOrder.indexOf(b);
            });

            // Sắp xếp mảng bình thường
            normalList.sort(function (a, b) {
                return a.localeCompare(b, 'vi', { sensitivity: 'base' });
            });

            var createLiOption = function (cleanedName) {
                var li = document.createElement('li');
                li.className = 'custom-option';
                li.setAttribute('data-value', cleanedName);
                li.textContent = cleanedName;

                li.addEventListener('click', function (e) {
                    e.stopPropagation(); // Tránh kích hoạt lại sự kiện trigger
                    
                    // Cập nhật giao diện
                    selectedValSpan.textContent = cleanedName;
                    container.classList.add('has-value');
                    
                    // Cập nhật giá trị gửi đi
                    hiddenInput.value = cleanedName;

                    // Đánh dấu active item
                    optionsList.querySelectorAll('.custom-option').forEach(function (el) {
                        el.classList.remove('selected');
                    });
                    li.classList.add('selected');

                    // Đóng dropdown
                    container.classList.remove('is-open');
                });

                return li;
            };

            // Vẽ 6 thành phố lớn lên đầu
            priorityList.forEach(function (name) {
                optionsList.appendChild(createLiOption(name));
            });

            // Kẻ phân cách
            if (priorityList.length && normalList.length) {
                var divider = document.createElement('li');
                divider.className = 'custom-divider';
                divider.textContent = '──────────────────────────';
                optionsList.appendChild(divider);
            }

            // Vẽ các tỉnh còn lại
            normalList.forEach(function (name) {
                optionsList.appendChild(createLiOption(name));
            });
        };

        // Bật/tắt trạng thái mở dropdown
        trigger.addEventListener('click', function (e) {
            e.stopPropagation();
            container.classList.toggle('is-open');
        });

        // Click ra ngoài thì đóng dropdown tự động
        document.addEventListener('click', function (e) {
            if (!container.contains(e.target)) {
                container.classList.remove('is-open');
            }
        });

        // Kỹ thuật Bảo hiểm mạng (Abort Timeout) sau 1.8 giây
        var controller = new AbortController();
        var timeoutId = setTimeout(function () {
            controller.abort();
        }, 1800);

        // Fetch danh sách 34 tỉnh thành mới nhất từ CAS API chính thức
        fetch('https://production.cas.so/address-kit/2025-07-01/provinces', {
            signal: controller.signal
        })
        .then(function (response) {
            return response.json();
        })
        .then(function (res) {
            clearTimeout(timeoutId);
            if (res && Array.isArray(res.provinces)) {
                var list = res.provinces.map(function (item) {
                    return item.name;
                });
                renderOptions(list);
            } else {
                throw new Error('Invalid CAS API response structure');
            }
        })
        .catch(function (err) {
            clearTimeout(timeoutId);
            console.warn('CAS Live API failed, fallback to local 34 provinces engaged:', err);
            renderOptions(fallbackProvinces);
        });
    }

    // ── Ajax Contact Form Submission ──────────────────────────────────────────
    function initContactForm() {
        var form = document.querySelector('.kia-contact-ajax-form');
        if (!form) return;

        var submitBtn = form.querySelector('.submit-btn');
        var btnTextEl = submitBtn.querySelector('.btn-text');
        var originalBtnText = btnTextEl ? btnTextEl.textContent : 'Đăng ký ngay';

        // Tạo Toast container nếu chưa có
        var toastContainer = document.querySelector('.kia-toast-container');
        if (!toastContainer) {
            toastContainer = document.createElement('div');
            toastContainer.className = 'kia-toast-container';
            document.body.appendChild(toastContainer);
        }

        var showToast = function (type, message) {
            var toast = document.createElement('div');
            toast.className = 'kia-toast ' + type;
            
            var icon = type === 'success' ? '✓' : '✗';
            
            toast.innerHTML = 
                '<span class="toast-icon">' + icon + '</span>' +
                '<span class="toast-message">' + message + '</span>';
            
            toastContainer.appendChild(toast);
            
            // Trigger animation
            setTimeout(function () {
                toast.classList.add('show');
            }, 100);

            // Auto remove
            setTimeout(function () {
                toast.classList.remove('show');
                setTimeout(function () {
                    toast.remove();
                }, 500);
            }, 4500);
        };

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            // Khóa nút submit tránh double post
            submitBtn.disabled = true;
            if (btnTextEl) btnTextEl.textContent = 'Đang gửi đăng ký...';

            var ho = form.querySelector('input[name="ho"]').value.trim();
            var ten = form.querySelector('input[name="ten"]').value.trim();
            var email = form.querySelector('input[name="email"]').value.trim();
            var phone = form.querySelector('input[name="phone"]').value.trim();
            var tinhThanh = form.querySelector('input[name="tinh_thanh"]').value;

            // Kiểm tra xem đã chọn tỉnh thành chưa (Validation cho input hidden)
            if (!tinhThanh) {
                showToast('error', 'Vui lòng chọn tỉnh thành trước khi đăng ký!');
                submitBtn.disabled = false;
                if (btnTextEl) btnTextEl.textContent = originalBtnText;
                return;
            }

            var fullName = ho + ' ' + ten;
            var content = 'Đăng ký nhận thông tin KIA Sorento từ Landing Page.\nTỉnh/Thành phố: ' + tinhThanh;

            var formData = new FormData();
            formData.append('_token', form.querySelector('input[name="_token"]').value);
            formData.append('name', fullName);
            formData.append('email', email);
            formData.append('phone', phone);
            formData.append('content', content);

            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'Accept': 'application/json'
                }
            })
            .then(function (response) {
                return response.json().then(function (data) {
                    if (response.ok && !data.error) {
                        return { success: true, message: 'Đăng ký nhận thông tin thành công!' };
                    } else {
                        var errMsg = data.message || 'Đã xảy ra lỗi, vui lòng thử lại sau.';
                        if (data.errors) {
                            // Tổng hợp toàn bộ các lỗi validation
                            errMsg = Object.values(data.errors).flat().join('<br>');
                        }
                        return { success: false, message: errMsg };
                    }
                });
            })
            .then(function (result) {
                if (result.success) {
                    showToast('success', result.message);
                    form.reset(); // Reset form thành công
                    // Reset custom select
                    var container = document.getElementById('kia-province-select-container');
                    if (container) {
                        container.classList.remove('has-value');
                        var selectedValSpan = container.querySelector('.selected-value');
                        if (selectedValSpan) selectedValSpan.textContent = 'Vui lòng chọn tỉnh thành';
                    }
                } else {
                    showToast('error', result.message);
                }
            })
            .catch(function (error) {
                console.error('Error submitting form:', error);
                showToast('error', 'Không thể kết nối máy chủ. Vui lòng thử lại sau!');
            })
            .finally(function () {
                // Mở lại nút submit
                submitBtn.disabled = false;
                if (btnTextEl) btnTextEl.textContent = originalBtnText;
            });
        });
    }

    // ── Init all ──────────────────────────────────────────────────────────────
    document.addEventListener('DOMContentLoaded', function () {
        initScrollReveal();
        initCountdown();
        initSmoothScroll();
        initVideoPlayer();
        initProvinceSelect();
        initContactForm();
    });

})();
