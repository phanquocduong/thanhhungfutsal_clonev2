<div class="crossbar">
    <span class="crossbar__title">Thanh Hùng Futsal - Giày Đá Bóng Chính Hãng - 2013</span>
</div>

<div class="grid wide">
    <div class="main row">
        <div class="col l-7 m-12 c-12">
            <div class="container">
                <div class="main-content">
                    <h2 class="payment-section-title">Thông tin giao hàng</h2>
                    <div class="customer-info">
                        <i class="customer-info__icon fa-solid fa-user-large"></i>
                        <div class="customer-info__body">
                            <p class="customer-info__body-title"><?=$_SESSION['user']['fullname']?> (<?=$_SESSION['user']['email']?>)</p>
                            <a href="/thanhhungfutsal_v2/logout" class="customer-info__body-logout">Đăng xuất</a>
                        </div>
                    </div>
                    <?php if(!empty($error)): ?>
                        <div class="errors">
                            <ul>
                                <li><?=$error?></li>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <form action="/thanhhungfutsal_v2/payment/handle" method="POST">
                        <input
                            required
                            type="text"
                            name="fullname"
                            class="form-name__control"
                            placeholder="Họ và tên"
                            value="<?=$_SESSION['user']['fullname']?>"
                        />
                        <div class="form-group">
                            <input
                                required
                                type="email"
                                name="email"
                                class="form-email__control"
                                placeholder="Email"
                                value="<?=$_SESSION['user']['email']?>"
                            />
                            <input
                                required
                                name="phone"
                                type="tel"
                                class="form-tel__control"
                                placeholder="Số điện thoại"
                                value="<?=$_SESSION['user']['phone']?>"
                            />
                        </div>
                        <div class="address-group">
                            <input
                                required
                                type="text"
                                name="address"
                                class="form-address__control"
                                placeholder="Địa chỉ"
                                value="<?=$_SESSION['user']['address']?>"
                            />
                            <div class="form-group">
                                <select id="province" required name="province" class="address-select">
                                    <option value="">Tỉnh / thành</option>
                                    <?php foreach ($provinces as $province): ?>
                                        <option value="<?=$province->getId()?>"><?=$province->getName()?></option>
                                    <?php endforeach; ?>
                                </select>
                                <select required id="district" name="district" class="address-select" disabled>
                                    <option value="">Quận / huyện</option>
                                </select>
                                <select required id="ward" name="ward" class="address-select" disabled>
                                    <option value="">Phường / xã</option>
                                </select>
                            </div>
                        </div>
                        <input type="text" name="note" class="form-note__control" placeholder="Ghi chú" />
                        <h2 class="payment-section-title">Phương thức thanh toán</h2>
                        <label onclick="closeTransferInformation()" for="cod" class="methods">
                            <input required id="cod" type="radio" name="method" class="methods-check" value="Tiền mặt" />
                            <div class="methods-content">
                                <img
                                    src="https://hstatic.net/0/0/global/design/seller/image/payment/cod.svg?v=6"
                                    alt="Thanh toán khi giao hàng"
                                    class="methods-content__img"
                                />
                                <span class="methods-content__title">Thanh toán khi giao hàng (COD)</span>
                            </div>
                        </label>
                        <label onclick="openTransferInformation()" for="transfer" class="methods">
                            <input
                                required
                                id="transfer"
                                type="radio"
                                name="method"
                                class="methods-check"
                                value="Chuyển khoản"
                            />
                            <div class="methods-content">
                                <img
                                    src="https://hstatic.net/0/0/global/design/seller/image/payment/other.svg?v=6"
                                    alt="Chuyển khoản qua ngân hàng"
                                    class="methods-content__img"
                                />
                                <span class="methods-content__title">Chuyển khoản qua ngân hàng</span>
                            </div>
                        </label>
                        <div class="transfer-information">
                            <h2 class="transfer-information__title">
                                Vui lòng nhập email của bạn trong phần nội dung thanh toán. Đơn hàng sẽ được giao sau khi tiền
                                đã chuyển.
                            </h2>
                            <img class="transfer-information__img" src="/thanhhungfutsal_v2/public/images/qrcode/qrcode.jpg" alt="QR code" />
                        </div>
                        <div class="step-footer">
                            <a href="/thanhhungfutsal_v2/cart" class="step-footer-previous-link">Giỏ hàng</a>
                            <input id="total-payment-hidden" type="hidden" name="total" value="0" />
                            <input id="discount-id" type="hidden" name="discount-id" value="1" />
                            <input type="hidden" class="transport-fee__price--hidden" name="transport-fee" value="0" />
                            <button class="step-footer-continue-btn">Hoàn tất đơn hàng</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="sidebar-wrap col l-5 m-12 c-12">
            <div class="sidebar">
                <?php foreach ($_SESSION['cart'] as $item): ?>
                    <div class="product-order">
                        <div class="product-order__thumbnail">
                            <img src="/thanhhungfutsal_v2/public/images/products/<?=$item['image']?>" alt="<?=$item['name']?>" class="product-order__img" />
                            <span class="product-order__quantity"><?=$item['quantity']?></span>
                        </div>
                        <div class="product-order__dsc">
                            <span class="product-order__dsc-name"><?=$item['name']?></span>
                            <span class="product-order__dsc-type"><?=$item['size']?></span>
                        </div>
                        <div class="product-order__price"><?=number_format($item['price'] * $item['quantity'])?>₫</div>
                    </div>
                <?php endforeach; ?>
                <div class="discount-code">
                    <input id="discount-code" type="text" class="discount-code__input" placeholder="Mã giảm giá" />
                    <button id="apply-discount" class="discount-code__btn">Sử dụng</button>
                </div>
                <div class="form-message"></div>
                <div class="payment-details">
                    <div class="provisional">
                        <span class="provisional-title">Tạm tính</span>
                        <span class="provisional-price"><?=number_format($grand_total)?>₫</span>
                    </div>
                    <div class="transport-fee">
                        <span class="transport-fee__title">Phí vận chuyển</span>
                        <span class="transport-fee__price">-</span>
                    </div>
                </div>
                <div class="total-payment">
                    <span class="total-payment__title">Tổng cộng</span>
                    <span class="total-payment__price">
                        <span class="total-payment__price-unit">VND</span>
                        <span id="total-payment" class="total-payment__price-main"><?=number_format($grand_total)?>₫</span>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>