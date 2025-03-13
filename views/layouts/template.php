<?php
    $message = $_SESSION['message'] ?? null;
    $error = $_SESSION['error'] ?? null;
    unset($_SESSION['message'], $_SESSION['error']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ThanhHung Futsal - Giày đá banh chính hãng</title>
    <meta name="description" content="Thanh Hùng Futsal - Cung cấp giày đá bóng chính hãng, chất lượng cao.">
    <meta name="keywords" content="giày đá bóng, giày futsal, giày cỏ nhân tạo, phụ kiện đá bóng">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" />
    <link rel="stylesheet" href="/thanhhungfutsal_v2/public/css/grid.css" />
    <link rel="stylesheet" href="/thanhhungfutsal_v2/public/css/base.css" />
    <?php if (isset($cssFile)): ?>
        <link rel="stylesheet" href="/thanhhungfutsal_v2/public/css/<?=$cssFile?>">
    <?php endif; ?>
    <link rel="stylesheet" href="/thanhhungfutsal_v2/public/fonts/fontawesome-free-6.7.2-web/css/all.min.css" />
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet"
    />
</head>
<body>
    <header>
        <div class="header-with-search">
            <div class="header__logo">
                <a href="/thanhhungfutsal_v2/" class="header__logo-link">
                    <img src="/thanhhungfutsal_v2/public/images/logo/logo.webp" alt="Thanh Hung Futsal" class="header__logo-img" />
                </a>
            </div>

            <div class="header__search">
                <input type="text" class="header__search-input" placeholder="Bạn đang tìm kiếm ..." />
                <button class="header__search-btn">
                    <i class="header__search-btn-icon fa-solid fa-magnifying-glass"></i>
                </button>
            </div>

            <div class="header__right">
                <ul class="header__right-list">
                    <li class="header__right-item">
                        <i class="header__user-icon fa-regular fa-user"></i>
                        <?php if(isset($_SESSION['user']) && !empty($_SESSION['user'])): ?>
                            <div class="user-action">
                                <?php if($_SESSION['user']['role_id'] == 1):  ?>
                                    <a href="/thanhhungfutsal_v2/admin" class="user-action__link">Trang quản trị</a>
                                <?php endif; ?>
                                <a href="/thanhhungfutsal_v2/account" class="user-action__link">Tài khoản</a>
                                <a href="/thanhhungfutsal_v2/logout" class="user-action__link">Đăng xuất</a>
                            </div>
                        <?php else: ?>
                            <div class="user-action">
                                <a href="/thanhhungfutsal_v2/login" class="user-action__link">Đăng nhập</a>
                                <a href="/thanhhungfutsal_v2/register" class="user-action__link">Đăng ký</a>
                            </div>
                        <?php endif; ?>
                    </li>
                    <li class="header__right-item">
                        <a href="/thanhhungfutsal_v2/cart" class="header__right-item-link">
                            <i class="header__cart-icon fa-solid fa-bag-shopping"></i>
                            <span class="header__cart-quantity">
                                <?php
                                    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                                        $cartQuantity = array_sum(array_column($_SESSION['cart'], 'quantity'));
                                        echo $cartQuantity;
                                    } else {
                                        echo 0;
                                    }
                                ?>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <nav>
            <ul class="navbar__list">
                <li class="navbar__item">
                    <a href="/thanhhungfutsal_v2/" class="navbar__item-link">TRANG CHỦ</a>
                </li>
                <li class="navbar__item">
                    <a href="/thanhhungfutsal_v2/collection" class="navbar__item-link">
                        SẢN PHẨM
                        <i class="navbar__item-icon-down fa-solid fa-caret-down"></i>
                    </a>
                    <ul class="navbar-sub__list">
                        <li class="navbar-sub__item">
                            <a href="/thanhhungfutsal_v2/collection/1" class="navbar-sub__item-link">GIÀY CỎ NHÂN TẠO</a>
                        </li>
                        <li class="navbar-sub__item">
                            <a href="/thanhhungfutsal_v2/collection/2" class="navbar-sub__item-link">GIÀY FUTSAL</a>
                        </li>
                        <li class="navbar-sub__item">
                            <a href="/thanhhungfutsal_v2/collection/3" class="navbar-sub__item-link">PHỤ KIỆN</a>
                        </li>
                    </ul>
                </li>
                <li class="navbar__item">
                    <a href="/thanhhungfutsal_v2/collection/1" class="navbar__item-link">GIÀY CỎ NHÂN TẠO</a>
                </li>
                <li class="navbar__item">
                    <a href="/thanhhungfutsal_v2/collection/2" class="navbar__item-link">GIÀY FUTSAL</a>
                </li>
                <li class="navbar__item">
                    <a href="/thanhhungfutsal_v2/collection/3" class="navbar__item-link">PHỤ KIỆN</a>
                </li>
                <li class="navbar__item">
                    <a href="/thanhhungfutsal_v2/news" class="navbar__item-link">TIN TỨC GIÀY</a>
                </li>
                <li class="navbar__item">
                    <a href="/thanhhungfutsal_v2/about" class="navbar__item-link">GIỚI THIỆU</a>
                </li>
                <li class="navbar__item">
                    <a href="/thanhhungfutsal_v2/contact" class="navbar__item-link">LIÊN HỆ</a>
                </li>
            </ul>
        </nav>
    </header>

    <main>
        <?php require_once $viewFile; ?>
    </main>

    <footer>
        <div class="grid wide">
            <div class="row">
                <div class="col l-4 c-4 m-10">
                    <div class="policy">
                        <h3 class="policy__heading">CHÍNH SÁCH</h3>
                        <ul class="policy__list">
                            <li class="policy__item">
                                <a href="" class="policy__item-link">Chính sách bảo hành</a>
                            </li>
                            <li class="policy__item">
                                <a href="" class="policy__item-link">Chính sách đổi trả</a>
                            </li>
                            <li class="policy__item">
                                <a href="" class="policy__item-link">Chính sách giao nhận hàng</a>
                            </li>
                            <li class="policy__item">
                                <a href="" class="policy__item-link">Chính sách bảo mật</a>
                            </li>
                            <li class="policy__item">
                                <a href="" class="policy__item-link">Chương trình Khách Hàng Thân Thiết</a>
                            </li>
                            <li class="policy__item">
                                <a href="" class="policy__item-link">
                                    <img
                                        src="https://theme.hstatic.net/200000278317/1000929405/14/logo-bct.png?v=966"
                                        alt=""
                                        class="policy__item-img"
                                    />
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col l-4 c-4 m-10">
                    <div class="about-us">
                        <h3 class="about-us__heading">VỀ THF</h3>
                        <ul class="policy__list">
                            <li class="about-us__item">
                                <a href="" class="about-us__item-link">Về chúng tôi</a>
                            </li>
                            <li class="about-us__item">
                                <a href="" class="about-us__item-link">Lĩnh vực kinh doanh</a>
                            </li>
                            <li class="about-us__item">
                                <a href="" class="about-us__item-link"
                                    >THF I: 27 Đường D52, P.12, Q.Tân Bình, TP.HCM | Hotline: 0901 377 722</a
                                >
                            </li>
                            <li class="about-us__item">
                                <a href="" class="about-us__item-link"
                                    >THF II: 32A Thạch Thị Thanh, P.Tân Định, Q.1, TP.HCM | Hotline: 0901 710 730</a
                                >
                            </li>
                            <li class="about-us__item">
                                <a href="" class="about-us__item-link"
                                    >THF III: 48 Phạm Văn Bạch, P.15, Q.Tân Bình, TP.HCM | Hotline: 0901 710 780</a
                                >
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col l-4 c-4 m-10">
                    <div class="ins">
                        <h3 class="ins__heading">INSTAGRAM</h3>
                        <ul class="ins__list">
                            <li class="ins__item">
                                <a href="" class="ins__item-link">
                                    <img
                                        src="https://theme.hstatic.net/200000278317/1000929405/14/instagram_1_large.jpg?v=966"
                                        alt=""
                                        class="ins__item-img"
                                    />
                                </a>
                            </li>
                            <li class="ins__item">
                                <a href="" class="ins__item-link">
                                    <img
                                        src="https://theme.hstatic.net/200000278317/1000929405/14/instagram_2_large.jpg?v=966"
                                        alt=""
                                        class="ins__item-img"
                                    />
                                </a>
                            </li>
                            <li class="ins__item">
                                <a href="" class="ins__item-link">
                                    <img
                                        src="https://theme.hstatic.net/200000278317/1000929405/14/instagram_3_large.jpg?v=966"
                                        alt=""
                                        class="ins__item-img"
                                    />
                                </a>
                            </li>
                            <li class="ins__item">
                                <a href="" class="ins__item-link">
                                    <img
                                        src="https://theme.hstatic.net/200000278317/1000929405/14/instagram_4_large.jpg?v=966"
                                        alt=""
                                        class="ins__item-img"
                                    />
                                </a>
                            </li>
                            <li class="ins__item">
                                <a href="" class="ins__item-link">
                                    <img
                                        src="https://theme.hstatic.net/200000278317/1000929405/14/instagram_5_large.jpg?v=966"
                                        alt=""
                                        class="ins__item-img"
                                    />
                                </a>
                            </li>
                            <li class="ins__item">
                                <a href="" class="ins__item-link">
                                    <img
                                        src="https://theme.hstatic.net/200000278317/1000929405/14/instagram_6_large.jpg?v=966"
                                        alt=""
                                        class="ins__item-img"
                                    />
                                </a>
                            </li>
                            <li class="ins__item">
                                <a href="" class="ins__item-link">
                                    <img
                                        src="https://theme.hstatic.net/200000278317/1000929405/14/instagram_7_large.jpg?v=966"
                                        alt=""
                                        class="ins__item-img"
                                    />
                                </a>
                            </li>
                            <li class="ins__item">
                                <a href="" class="ins__item-link">
                                    <img
                                        src="https://theme.hstatic.net/200000278317/1000929405/14/instagram_8_large.jpg?v=966"
                                        alt=""
                                        class="ins__item-img"
                                    />
                                </a>
                            </li>
                            <li class="ins__item">
                                <a href="" class="ins__item-link">
                                    <img
                                        src="https://theme.hstatic.net/200000278317/1000929405/14/instagram_9_large.jpg?v=966"
                                        alt=""
                                        class="ins__item-img"
                                    />
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="shop-info">
                <div class="shop-info__heading">
                    <ul class="shop-info__list">
                        <li class="shop-info__item">THANH HÙNG FUTSAL</li>
                        <li class="shop-info__item">GIÀY ĐÁ BÓNG CHÍNH HÃNG</li>
                        <li class="shop-info__item">MỞ CỬA TỪ 9h - 21h</li>
                    </ul>
                </div>
                <div class="shop-info__copyright">
                    <span class="shop-info__copyright-dsc">© Bản quyền thuộc về THANH HÙNG FUTSAL</span>
                </div>
            </div>
        </div>
    </footer>

    <script src="/thanhhungfutsal_v2/public/js/validator.js"></script>
    <?php if (isset($jsFile)): ?>
        <script src="/thanhhungfutsal_v2/public/js/<?=$jsFile?>"></script>
    <?php endif; ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php if (isset($_SESSION['success-order'])): ?>
        <script>
            Swal.fire({
                title: '<?= $_SESSION['success-order'] ?>',
                icon: 'success',
                timer: 3000,
                showConfirmButton: false
            })
        </script>
    <?php unset($_SESSION['success-order']); endif; ?>
</body>
</html>