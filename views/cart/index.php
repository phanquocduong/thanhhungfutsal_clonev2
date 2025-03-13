<div class="crossbar">
    <span class="crossbar__title">Thanh Hùng Futsal - Giày Đá Bóng Chính Hãng - 2013</span>
</div>

<div class="container">
    <div class="grid wide">
        <div class="cart-wrap">
            <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
                <div class="row">
                    <div class="col l-8">
                        <div class="cart-body-left">
                            <div class="cart-body-left__heading">
                                <div class="row">
                                    <div class="col l-1"></div>
                                    <div class="col l-11">
                                        <div class="row">
                                            <div class="col l-5">Sản phẩm</div>
                                            <div class="col l-2">Đơn giá</div>
                                            <div class="col l-3">Số lượng</div>
                                            <div class="col l-2">Thành tiền</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="cart-body-left__content">
                                <?php foreach ($_SESSION['cart'] as $index => $item): ?>
                                    <div class="row order-item">
                                        <div class="col l-1">
                                            <a onclick="deleteProduct(<?=$index?>)" class="delete-item">
                                                <i class="delete-item__icon fa-solid fa-x"></i>
                                            </a>
                                        </div>
                                        <div class="col l-11">
                                            <div class="row">
                                                <div class="col l-2">
                                                    <a href="/thanhhungfutsal_v2/products/<?=$item['id']?>" class="product-link">
                                                        <img
                                                            src="/thanhhungfutsal_v2/public/images/products/<?=$item['image']?>"
                                                            alt="<?=$item['name']?>"
                                                            class="product-link__img"
                                                        />
                                                    </a>
                                                </div>
                                                <div class="col l-3">
                                                    <a href="/thanhhungfutsal_v2/products/<?=$item['id']?>" class="product-link">
                                                        <h5 class="product-link__title"><?=$item['name']?></h5>
                                                    </a>
                                                    <div class="product-classify">
                                                        <span class="product-classify__title">Mã SP: <?=$item['id']?></span>
                                                        <span class="product-classify__title">Kích thước: <?=$item['size']?></span>
                                                    </div>
                                                </div>
                                                <div class="col l-2">
                                                    <span class="product-price"><?=number_format($item['price'])?>₫</span>
                                                </div>
                                                <div class="col l-3">
                                                    <form class="quantity-form">
                                                        <input type="hidden" name="index" value="<?=$index?>">
                                                        <div class="quantity-wrapper">
                                                            <button 
                                                                type="button" 
                                                                onclick="decreaseQuantityInCart(this)" 
                                                                class="quantity-minus"
                                                            >-</button>
                                                            <input 
                                                                type="text" 
                                                                name="quantity" 
                                                                class="quantity" 
                                                                value="<?=$item['quantity']?>" 
                                                                readonly>
                                                            <button 
                                                                type="button" 
                                                                onclick="increaseQuantityInCart(this)" 
                                                                class="quantity-plus"
                                                                >+</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="col l-2">
                                                    <span 
                                                        class="line-item-total" 
                                                        data-index="<?=$index?>"
                                                    ><?=number_format($item['price'] * $item['quantity'])?>₫</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <div class="cart-body-left__footer">
                                <div class="row">
                                    <div class="col l-1"></div>
                                    <div class="col l-11">
                                        <a href="allproduct.html" class="continue-shopping">
                                            <i class="fa-solid fa-angle-left"></i>
                                            TIẾP TỤC MUA SẮM
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col l-4">
                        <div class="cart-body-right">
                            <div class="cart-total">
                                <label for="" class="total-label">Thành tiền</label>
                                <span class="total-price"><?=number_format($grand_total)?>₫</span>
                            </div>
                            <a class="cart-btn-link" href="/thanhhungfutsal_v2/payment">
                                <button class="cart-btn">Thanh toán</button>
                            </a>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="cart-empty">
                    <h2 class="cart-empty__title">Giỏ hàng của bạn đang trống!</h2>
                    <a href="/thanhhungfutsal_v2/collection" class="continue-buy__btn">Tiếp tục mua hàng</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>