<?php
    $message = $_SESSION['message'] ?? null;
    $error = $_SESSION['error'] ?? null;
    unset($_SESSION['message'], $_SESSION['error']);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Admin - Thanh Hùng Futsal</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />

        <!-- Favicon -->
        <link href="img/favicon.ico" rel="icon" />

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap"
            rel="stylesheet"
        />

        <!-- Icon Font Stylesheet -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />

        <!-- Libraries Stylesheet -->
        <link href="/thanhhungfutsal_v2/admin/public/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet" />
        <link href="/thanhhungfutsal_v2/admin/public/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

        <!-- Customized Bootstrap Stylesheet -->
        <link href="/thanhhungfutsal_v2/admin/public/css/bootstrap.min.css" rel="stylesheet" />

        <!-- Template Stylesheet -->
        <link href="/thanhhungfutsal_v2/admin/public/css/style.css" rel="stylesheet" />
    </head>

    <body>
        <div class="container-fluid position-relative d-flex p-0">
            <!-- Sidebar Start -->
            <div class="sidebar pe-4 pb-3">
                <nav class="navbar bg-secondary navbar-dark">
                    <a href="index.html" class="navbar-brand mx-4 mb-3">
                        <h3 class="text-primary">THF ADMIN</h3>
                    </a>
                    <div class="d-flex align-items-center ms-4 mb-4">
                        <div class="ms-3">
                            <h6 class="mb-0">Phan Quốc Dương</h6>
                            <span>Quản trị viên</span>
                        </div>
                    </div>
                    <div class="navbar-nav w-100">
                        <a href="/thanhhungfutsal_v2/admin/categories" class="nav-item nav-link"><i class="fa-solid fa-layer-group me-2"></i>Danh mục</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                                ><i class="fa-brands fa-product-hunt me-2"></i>Sản phẩm</a
                            >
                            <div class="dropdown-menu bg-transparent border-0">
                                <a href="/thanhhungfutsal_v2/admin/products" class="dropdown-item">Nguyên bản</a>
                                <a href="/thanhhungfutsal_v2/admin/products/variants" class="dropdown-item">Biến thể</a>
                            </div>
                        </div>
                        <a href="/thanhhungfutsal_v2/admin/news" class="nav-item nav-link"><i class="fa-solid fa-newspaper me-2"></i>Tin tức</a>
                        <a href="/thanhhungfutsal_v2/admin/users" class="nav-item nav-link"><i class="fa-solid fa-user me-2"></i>Người dùng</a>
                        <a href="/thanhhungfutsal_v2/admin/orders" class="nav-item nav-link"><i class="fa-brands fa-first-order me-2"></i>Đơn hàng</a>
                        <a href="/thanhhungfutsal_v2/admin/vouchers" class="nav-item nav-link"><i class="fa-solid fa-ticket me-2"></i>Mã giảm giá</a>
                    </div>
                </nav>
            </div>
            <!-- Sidebar End -->

            <!-- Content Start -->
            <div class="content">
                <!-- Navbar Start -->
                <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                    <a href="#" class="sidebar-toggler flex-shrink-0">
                        <i class="fa fa-bars"></i>
                    </a>
                    <div class="navbar-nav align-items-center ms-auto">
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                <span class="d-none d-lg-inline-flex">Phan Quốc Dương</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                                <a href="#" class="dropdown-item"><i class="fa-solid fa-house"></i></a>
                                <a href="#" class="dropdown-item">Đăng xuất</a>
                            </div>
                        </div>
                    </div>
                </nav>
                <!-- Navbar End -->

                <?php require_once $viewFile; ?>

                <!-- Footer Start -->
                <div class="container-fluid pt-4 px-4">
                    <div class="bg-secondary rounded-top p-4">
                        <div class="row">
                            <div class="col-12 col-sm-6 text-center text-sm-start">
                                © Bản quyền thuộc về <a href="#">Thanh Hùng Futsal</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Footer End -->
            </div>
            <!-- Content End -->

            <!-- Back to Top -->
            <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
        </div>

        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="/thanhhungfutsal_v2/admin/public/lib/chart/chart.min.js"></script>
        <script src="/thanhhungfutsal_v2/admin/public/lib/easing/easing.min.js"></script>
        <script src="/thanhhungfutsal_v2/admin/public/lib/waypoints/waypoints.min.js"></script>
        <script src="/thanhhungfutsal_v2/admin/public/lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="/thanhhungfutsal_v2/admin/public/lib/tempusdominus/js/moment.min.js"></script>
        <script src="/thanhhungfutsal_v2/admin/public/lib/tempusdominus/js/moment-timezone.min.js"></script>
        <script src="/thanhhungfutsal_v2/admin/public/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

        <!-- Template Javascript -->
        <script src="/thanhhungfutsal_v2/admin/public/js/main.js"></script>
    </body>
</html>
