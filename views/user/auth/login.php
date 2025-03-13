<div class="crossbar">
    <span class="crossbar__title">Thanh Hùng Futsal - Giày Đá Bóng Chính Hãng - 2013</span>
</div>

<div class="container">
    <form id="loginForm" method="POST" action="/thanhhungfutsal_v2/login/handle" class="login-form">
        <h4 class="login-title">Đăng nhập</h4>
        <?php if(!empty($error)): ?>
            <div class="errors">
                <ul>
                    <li><?=$error?></li>
                </ul>
            </div>
        <?php endif; ?>
        <?php if(!empty($message)): ?>
            <div class="messages">
                <ul>
                    <li><?=$message?></li>
                </ul>
            </div>
        <?php endif; ?>
        <div class="form-group email-form">
            <label for="email" class="form-label">EMAIL</label>
            <input
                required
                rules="required|email"
                type="email"
                id="email"
                name="email"
                class="form-control"
                placeholder="Nhập Email của bạn"
            />
            <div class="form-message"></div>
        </div>
        <div class="form-group password-form">
            <label for="password" class="form-label">MẬT KHẨU</label>
            <input
                required
                type="password"
                rules="required"
                id="password"
                name="password"
                class="form-control"
                placeholder="Nhập Mật khẩu"
            />
            <div class="form-message"></div>
        </div>
        <div class="login-action">
            <button class="login-btn">Đăng nhập</button>
            <div class="register-title">
                Bạn chưa có tài khoản?
                <a href="register.html" class="register-title__link">Đăng ký ngay</a>
            </div>
            <a href="" class="forgot-pass__link">Quên mật khẩu?</a>
        </div>
    </form>
</div>