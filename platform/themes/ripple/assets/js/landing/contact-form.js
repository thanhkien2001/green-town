export default function initContactForm() {
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
