export default function initSection13Form() {
    var form = document.getElementById('s13-contact-form');
    if (!form) return;

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        var submitBtn = form.querySelector('.s13-submit-btn');
        var originalText = submitBtn.textContent;
        submitBtn.disabled = true;
        submitBtn.textContent = 'ĐANG GỬI...';

        var formData = new FormData(form);

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
                    // Override the default English message with our custom Vietnamese message
                    return { success: true, message: 'Đăng ký nhận thông tin thành công! Chúng tôi sẽ liên hệ sớm nhất.' };
                } else {
                    var errMsg = data.message || 'Đã xảy ra lỗi, vui lòng thử lại sau.';
                    if (data.errors) {
                        errMsg = Object.values(data.errors).flat().join('<br>');
                    }
                    return { success: false, message: errMsg };
                }
            });
        })
        .then(function (result) {
            var popup = document.getElementById('s13-popup');
            if (popup) {
                var titleEl = document.getElementById('s13-popup-title');
                var messageEl = document.getElementById('s13-popup-message');
                
                titleEl.innerHTML = result.success ? 'Thành công' : 'Lỗi';
                titleEl.style.color = result.success ? '#4ba038' : '#e74c3c';
                messageEl.innerHTML = result.message;
                popup.style.display = 'flex';
            } else {
                alert(result.message);
            }
            
            if (result.success) {
                form.reset();
            }
        })
        .catch(function (error) {
            var popup = document.getElementById('s13-popup');
            if (popup) {
                document.getElementById('s13-popup-title').innerHTML = 'Lỗi';
                document.getElementById('s13-popup-title').style.color = '#e74c3c';
                document.getElementById('s13-popup-message').innerHTML = 'Không thể kết nối máy chủ. Vui lòng thử lại sau!';
                popup.style.display = 'flex';
            } else {
                alert('Không thể kết nối máy chủ. Vui lòng thử lại sau!');
            }
        })
        .finally(function () {
            submitBtn.disabled = false;
            submitBtn.textContent = originalText;
        });
    });
}
