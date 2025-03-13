<div class="crossbar">
    <span class="crossbar__title">Thanh Hùng Futsal - Giày Đá Bóng Chính Hãng - 2013</span>
</div>

<div class="container">
    <form action="/thanhhungfutsal_v2/register/handle" class="register-form" method="POST" id="registerForm">
        <h4 class="register-title">Đăng ký</h4>
        <?php if(!empty($error)): ?>
            <div class="errors">
                <ul>
                    <li><?=$error?></li>
                </ul>
            </div>
        <?php endif; ?>
        <div class="full-name__form">
            <div class="form-group form-group__half">
                <label for="lastName" class="form-label">HỌ:</label>
                <input required rules="required" id="lastName" name="lastname" type="text" class="form-control" />
                <div class="form-message"></div>
            </div>
            <div class="form-group form-group__half">
                <label for="firstName" class="form-label">TÊN:</label>
                <input required rules="required" id="firstName" name="firstname" type="text" class="form-control" />
                <div class="form-message"></div>
            </div>
        </div>
        <div class="form-group form-group__full">
            <label for="email" class="form-label">EMAIL:</label>
            <input required rules="required|email" type="email" id="email" name="email" class="form-control" />
            <div class="form-message"></div>
        </div>
        <div class="form-group form-group__full">
            <label for="password" class="form-label">MẬT KHẨU:</label>
            <input
                required
                rules="required|min:8|passwordComplexity"
                type="password"
                id="password"
                name="password"
                class="form-control"
            />
            <div class="form-message"></div>
        </div>
        <div class="form-group form-group__full">
            <label for="repassword" class="form-label">NHẬP LẠI MẬT KHẨU:</label>
            <input required rules="required" type="password" id="repassword" name="repassword" class="form-control" />
            <div class="form-message"></div>
        </div>
        <div class="register-action">
            <button class="register-btn">Đăng ký</button>
            <a href="/thanhhungfutsal_v2/login" class="login-title">
                Bạn đã có tài khoản?
                <span class="login-title__link">Đăng nhập</span>
            </a>
        </div>
    </form>
</div>