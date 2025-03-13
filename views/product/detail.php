<div class="crossbar">
    <span class="crossbar__title">Thanh Hùng Futsal - Giày Đá Bóng Chính Hãng - 2013</span>
</div>

<div class="product-details grid wide">
    <div class="row">
        <div class="col l-6 m-6 c-10">
            <div class="image-collection">
                <div class="extra-images">
                    <div onclick="up()" class="change-img-btn">
                        <i class="change-img-btn__icon fa-solid fa-angle-up"></i>
                    </div>
                    <img
                        class="extra-images__item"
                        onclick="changeMainImage(this)"
                        src="/thanhhungfutsal_v2/public/images/products/<?=$product->getImage()?>"
                        alt="<?=$product->getName()?>"
                    />
                    <?php foreach($product->getExtraImages() as $image): ?>
                        <img
                            class="extra-images__item"
                            onclick="changeMainImage(this)"
                            src="/thanhhungfutsal_v2/public/images/products/<?=$image?>"
                            alt="<?=$product->getName()?>"
                        />
                    <?php endforeach; ?>
                    <div onclick="down()" class="change-img-btn swipe-down-btn">
                        <i class="change-img-btn__icon fa-solid fa-angle-down"></i>
                    </div>
                </div>
                <div class="main-image-wrap">
                    <img
                        onclick="openImageModal(this)"
                        class="main-image-item"
                        src="/thanhhungfutsal_v2/public/images/products/<?=$product->getImage()?>"
                        alt="<?=$product->getName()?>"
                    />
                    <?php if ($product->getSale()): ?>
                        <div class="sale-off__tag">-<?=$product->getPercentDiscount()?>%</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col l-6 m-6 c-10">
            <h1 class="product-name"><?=$product->getName()?></h1>
            <ul class="product-type__list">
                <li class="product-type__item">Loại: <?=$product->category_name?></li>
                <li class="product-type__item">Mã SP: <?=$product->getId()?></li>
            </ul>
            <div class="price-group">
                <?php if ($product->getSale()): ?>
                    <span class="current-price"><?=number_format($product->getSale())?>₫</span>
                    <span class="old-price"><?=number_format($product->getPrice())?>₫</span>
                    <div class="economical-price">
                        (Tiết kiệm
                        <span class="economical-price__press"><?=number_format($product->getEconomicalPrice())?>₫</span>)
                    </div>
                <?php else: ?>
                    <span class="current-price"><?=number_format($product->getPrice())?>₫</span>
                <?php endif; ?>
            </div>
            <?php if (isset($product->sizes)): ?>
                <div class="size-selection">
                    <h4 class="size-selection__title">Kích thước:</h4>
                    <ul class="size-selection__list">
                        <?php foreach($product->sizes as $index => $size): ?>
                            <li class="size-selection__item <?=($index === 0) ? 'size-selection__item--selected' : ''?>"><?=$size->getSize()?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            <div class="add-to-cart-action">
                <div class="quantity-selection">
                    <span class="quantity-selection__title">Số lượng:</span>
                    <div class="quantity-selection__action">
                        <input onclick="updateQuantity(-1)" type="button" class="quantity-selection__action-minus" value="-" />
                        <input type="text" class="quantity-selection__action-edit" value="1" />
                        <input onclick="updateQuantity(1)" type="button" class="quantity-selection__action-add" value="+" />
                    </div>
                </div>
                <div class="add-basket-btn">
                    <button data-product-id="<?=$product->getId()?>" class="add-basket-btn__title">Thêm vào giỏ</button>
                </div>
            </div>
            <button class="buy-now-btn">MUA NGAY</button>
            <div class="stores-address">
                <h4 class="stores-address__heading">
                    <img
                        src="/thanhhungfutsal_v2/public/images/stores/store-icon.webp"
                        class="stores-address__heading-icon"
                    />
                    Có TẠI 3 CỬA HÀNG
                </h4>
                <ul class="stores-address__list">
                    <li class="stores-address__item">
                        <img
                            src="/thanhhungfutsal_v2/public/images/stores/gps-icon.webp"
                            class="stores-address__item-icon"
                        />
                        27 Đường D52, P. 12, Q. Tân Bình, TP. HCM | Hotline: 0901 377 722
                    </li>
                    <li class="stores-address__item">
                        <img
                            src="/thanhhungfutsal_v2/public/images/stores/gps-icon.webp"
                            class="stores-address__item-icon"
                        />
                        32A THẠCH THỊ THANH, P. TÂN ĐỊNH, Q. 1, TP. HCM | HOTLINE: 0901 710 730
                    </li>
                    <li class="stores-address__item">
                        <img
                            src="/thanhhungfutsal_v2/public/images/stores/gps-icon.webp"
                            class="stores-address__item-icon"
                        />
                        48 PHẠM VĂN BẠCH, P. 15, Q. TÂN BÌNH, TP. HCM | HOTLINE: 0901 710 780
                    </li>
                </ul>
            </div>
            <div class="product-policy">
                <div class="product-policy__item">
                    <img
                        src="/thanhhungfutsal_v2/public/images/product-policy/product-policy-1.webp"
                        class="product-policy__item-img"
                    />
                    <div class="product-policy__item-info">
                        <h3 class="product-policy__item-info-heading">ƯU ĐÃI TẶNG KÈM</h3>
                        <span class="product-policy__item-info-body"
                            >Tặng kèm vớ dệt kim và balô chống thấm đựng giày cho mỗi đơn hàng Giày đá bóng.</span
                        >
                    </div>
                </div>
                <div class="product-policy__item">
                    <img
                        src="/thanhhungfutsal_v2/public/images/product-policy/product-policy-2.webp"
                        class="product-policy__item-img"
                    />
                    <div class="product-policy__item-info">
                        <h3 class="product-policy__item-info-heading">ĐỔI HÀNG DỄ DÀNG</h3>
                        <span class="product-policy__item-info-body"
                            >Hỗ trợ khách hàng đổi size hoặc mẫu trong vòng 7 ngày. (Sản phẩm chưa qua sử dụng).</span
                        >
                    </div>
                </div>
                <div class="product-policy__item">
                    <img
                        src="/thanhhungfutsal_v2/public/images/product-policy/product-policy-3.webp"
                        class="product-policy__item-img"
                    />
                    <div class="product-policy__item-info">
                        <h3 class="product-policy__item-info-heading">CHÍNH SÁCH GIAO HÀNG</h3>
                        <span class="product-policy__item-info-body"
                            >COD Toàn quốc | Freeship toàn quốc khi khách hàng thanh toán chuyển khoản trước với đơn hàng Giày
                            đá bóng trên 1 triệu.</span
                        >
                    </div>
                </div>
                <div class="product-policy__item">
                    <img
                        src="/thanhhungfutsal_v2/public/images/product-policy/product-policy-4.webp"
                        class="product-policy__item-img"
                    />
                    <div class="product-policy__item-info">
                        <h3 class="product-policy__item-info-heading">THANH TOÁN TIỆN LỢI</h3>
                        <span class="product-policy__item-info-body"
                            >Chấp nhận các loại hình thanh toán bằng thẻ, tiền mặt, chuyển khoản.</span
                        >
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="product-dsc">
        <ul class="tab-title__list">
            <li class="tab-title__item tab-title__item--active">MÔ TẢ SẢN PHẨM</li>
            <li class="tab-title__item">ĐÁNH GIÁ</li>
            <li class="tab-title__item">CHÍNH SÁCH BẢO HÀNH</li>
            <li class="tab-title__item">LỜI KHUYÊN CHỌN GIÀY</li>
        </ul>
        <div class="row">
            <div class="col l-10 l-o-1 m-10 m-o-1 c-10 c-o-1 tab-title__content-wrap">
                <div class="tab-title__content tab-title__content--active">
                    <?=$product->getDescription()?>
                </div>
                <div class="tab-title__content">
                    <div class="review-item">
                        <img
                            class="review-item__avatar"
                            src=""
                            alt=""
                        />
                        <div class="review-item__body">
                            <span class="review-item__name">Phan Quoc Duong</span>
                            <div class="review-item__rating">
                                <i class="star-icon fa-solid fa-star"></i>
                                <i class="star-icon fa-solid fa-star"></i>
                                <i class="star-icon fa-solid fa-star"></i>
                                <i class="star-icon fa-solid fa-star"></i>
                                <i class="star-icon fa-regular fa-star"></i>
                            </div>
                            <span class="review-item__date">22/12/2024</span>
                            <p class="review-item__comment">Giày tốt lắm, mang đầm chân, sút tốt</p>
                            <div class="review-item__images">
                                <img
                                    onclick="openImageModal(this)"
                                    class="review-item__image"
                                    src="https://product.hstatic.net/200000278317/product/sal-giay-da-bong-nike-react-phantom-gx-2-pro-tf-fj2583-300-xanh-mint-2_add06fc029754c98941893f67c100180_master.jpg"
                                    alt=""
                                />
                                <img
                                    onclick="openImageModal(this)"
                                    class="review-item__image"
                                    src="https://product.hstatic.net/200000278317/product/sal-giay-da-bong-nike-react-phantom-gx-2-pro-tf-fj2583-300-xanh-mint-2_add06fc029754c98941893f67c100180_master.jpg"
                                    alt=""
                                />
                                <img
                                    onclick="openImageModal(this)"
                                    class="review-item__image"
                                    src="https://product.hstatic.net/200000278317/product/sal-giay-da-bong-nike-react-phantom-gx-2-pro-tf-fj2583-300-xanh-mint-2_add06fc029754c98941893f67c100180_master.jpg"
                                    alt=""
                                />
                            </div>
                        </div>
                    </div>
                    <div class="review-item">
                        <img
                            class="review-item__avatar"
                            src=""
                            alt=""
                        />
                        <div class="review-item__body">
                            <span class="review-item__name">Phan Quoc Duong</span>
                            <div class="review-item__rating">
                                <i class="star-icon fa-solid fa-star"></i>
                                <i class="star-icon fa-solid fa-star"></i>
                                <i class="star-icon fa-solid fa-star"></i>
                                <i class="star-icon fa-solid fa-star"></i>
                                <i class="star-icon fa-regular fa-star"></i>
                            </div>
                            <span class="review-item__date">22/12/2024</span>
                            <p class="review-item__comment">Giày tốt lắm, mang đầm chân, sút tốt</p>
                            <div class="review-item__images">
                                <img
                                    onclick="openImageModal(this)"
                                    class="review-item__image"
                                    src="https://product.hstatic.net/200000278317/product/sal-giay-da-bong-nike-react-phantom-gx-2-pro-tf-fj2583-300-xanh-mint-2_add06fc029754c98941893f67c100180_master.jpg"
                                    alt=""
                                />
                                <img
                                    onclick="openImageModal(this)"
                                    class="review-item__image"
                                    src="https://product.hstatic.net/200000278317/product/sal-giay-da-bong-nike-react-phantom-gx-2-pro-tf-fj2583-300-xanh-mint-2_add06fc029754c98941893f67c100180_master.jpg"
                                    alt=""
                                />
                                <img
                                    onclick="openImageModal(this)"
                                    class="review-item__image"
                                    src="https://product.hstatic.net/200000278317/product/sal-giay-da-bong-nike-react-phantom-gx-2-pro-tf-fj2583-300-xanh-mint-2_add06fc029754c98941893f67c100180_master.jpg"
                                    alt=""
                                />
                            </div>
                        </div>
                    </div>
                    <div class="review-item">
                        <img
                            class="review-item__avatar"
                            src=""
                            alt=""
                        />
                        <div class="review-item__body">
                            <span class="review-item__name">Phan Quoc Duong</span>
                            <div class="review-item__rating">
                                <i class="star-icon fa-solid fa-star"></i>
                                <i class="star-icon fa-solid fa-star"></i>
                                <i class="star-icon fa-solid fa-star"></i>
                                <i class="star-icon fa-solid fa-star"></i>
                                <i class="star-icon fa-regular fa-star"></i>
                            </div>
                            <span class="review-item__date">22/12/2024</span>
                            <p class="review-item__comment">Giày tốt lắm, mang đầm chân, sút tốt</p>
                            <div class="review-item__images">
                                <img
                                    onclick="openImageModal(this)"
                                    class="review-item__image"
                                    src="https://product.hstatic.net/200000278317/product/sal-giay-da-bong-nike-react-phantom-gx-2-pro-tf-fj2583-300-xanh-mint-2_add06fc029754c98941893f67c100180_master.jpg"
                                    alt=""
                                />
                                <img
                                    onclick="openImageModal(this)"
                                    class="review-item__image"
                                    src="https://product.hstatic.net/200000278317/product/sal-giay-da-bong-nike-react-phantom-gx-2-pro-tf-fj2583-300-xanh-mint-2_add06fc029754c98941893f67c100180_master.jpg"
                                    alt=""
                                />
                                <img
                                    onclick="openImageModal(this)"
                                    class="review-item__image"
                                    src="https://product.hstatic.net/200000278317/product/sal-giay-da-bong-nike-react-phantom-gx-2-pro-tf-fj2583-300-xanh-mint-2_add06fc029754c98941893f67c100180_master.jpg"
                                    alt=""
                                />
                            </div>
                        </div>
                    </div>
                    <div class="pagination">
                        <a href="" class="pagination-link">1</a>
                        <a href="" class="pagination-link">2</a>
                        <a href="" class="pagination-link">3</a>
                        <a href="" class="pagination-link">...</a>
                        <a href="" class="pagination-link">11</a>
                        <a href="" class="pagination-link__icon">
                            <i class="fa-solid fa-chevron-right"></i>
                        </a>
                    </div>
                </div>
                <div class="tab-title__content">
                    <p>
                        <span
                            >Thanh Hùng Futsal luôn nỗ lực mang đến trải nghiệm mua sắm tuyệt vời dành cho Khách Hàng từ việc đa
                            dạng hoá mẫu mã từ nhiều thương hiệu quốc tế nổi tiếng, dịch vụ tư vấn bán hàng online, offline và
                            những dịch vụ hậu mãi không ngừng được hoàn thiện.</span
                        >
                    </p>
                    <img src="//file.hstatic.net/200000278317/file/baohanh2_93b9597ceba746559f5ba19054546a1d.jpg" />
                    <p><span>Dưới đây là chính sách bảo hành của Thanh Hùng Futsal.</span></p>
                    <p>
                        <span><strong>ĐIỀU KIỆN BẢO HÀNH</strong></span>
                    </p>
                    <p>
                        <span>- Thanh Hùng Futsal hỗ trợ khách hàng <strong>bảo hành sửa chữa 6 tháng </strong>miễn phí:</span>
                    </p>
                    <ol>
                        <li>
                            <span>Sản phẩm phải do chính Shop Thanh Hùng Futsal phân phối.</span>
                        </li>
                        <li>
                            <span
                                >Sản phẩm còn trong thời hạn bảo hành và bị hư hỏng do lỗi kỹ thuật của Nhà sản xuất: hở keo,
                                đứt chỉ.</span
                            >
                        </li>
                        <li>
                            <span
                                >Khách hàng phải xuất trình được phiếu bảo hành sản phẩm hợp lệ hoặc có thông tin mua hàng đầy
                                đủ trên hệ thống.</span
                            >
                        </li>
                    </ol>
                    <p>
                        <span>- Thanh Hùng Futsal <strong>từ chối bảo hành</strong> sản phẩm đối với các trường hợp:</span>
                    </p>
                    <ol>
                        <li><span>Không có thông tin hoá đơn mua hàng</span></li>
                        <li>
                            <span
                                >Sản phẩm bị hư hỏng và lỗi từ phía khách hàng gây nên như trầy xước, đế mòn, sản phẩm không còn
                                nguyên vẹn do bị động vật cắn, bảo quản không tốt gây ẩm mốc, phai nắng, nóng chảy.</span
                            >
                        </li>
                    </ol>
                    <p>
                        <span
                            >Sau khi hết thời gian bảo hành, shop vẫn hỗ trợ sửa chữa giày với chi phí hợp lý tại các cơ sở sửa
                            chữa uy tín cho quý khách hàng trong suốt quá trình sử dụng.</span
                        >
                    </p>
                    <img src="//file.hstatic.net/200000278317/file/baohanh1_b702947d711c4ffca5a837f8c9363d1d.jpg" />
                    <p>
                        <span><strong>THỜI GIAN BẢO HÀNH</strong></span>
                    </p>
                    <p>
                        <span
                            >Xử lý và trao trả sản phẩm đã được sửa chữa bảo hành cho khách hàng trong khoảng thời gian 05 ngày
                            làm việc kể từ khi tiếp nhận sản phẩm (trừ các tình huống đặc biệt hoặc phải tìm chất liệu khó để
                            thay thế, Shop sẽ liên hệ và đàm phán trực tiếp với khách hàng).</span
                        >
                    </p>
                </div>
                <div class="tab-title__content">
                    <p>
                        <span
                            >Giày đá banh chính hãng là một sản phẩm với công năng riêng biệt, chuyên dành cho những trận
                            thi đấu bóng đá, từ đó mà vật liệu, thiết kế và cách thi công giày cũng rất riêng, khác với
                            những dòng sản phẩm giày thông thường. Vậy nên để có được trải nghiệm "trên chân" tốt nhất, đặc biệt
                            là với những anh em chưa có nhiều kinh nghiệm trong việc chọn một đôi giày đá banh phù hợp với
                            mình, thì anh em có thể theo một số lời khuyên của ThanhHung Futsal như sau:</span
                        >
                    </p>
                    <p>
                        <span
                            ><strong
                                >1. Khi chọn size giày, anh em nên chọn size mà khi mang vào thì phần mũi giày và mũi chân
                                sẽ vừa với nhau ( hoặc dư mũi khoảng 0.5cm hoặc dư ít hơn tuỳ vào cảm giác của
                                anh em).</strong
                            ></span
                        >
                    </p>
                    <img
                        src="//file.hstatic.net/200000278317/file/trang-break-in-giay-2_8b96a8d5d72d462685947682b1963ea2.jpg"
                    />
                    <p>
                        <span
                            ><strong
                                >2. Với những đôi giày đá banh mới "cóng" thì bề ngang sẽ hơi bó làm anh em khó chịu vài trận
                                đầu (có thể sẽ làm anh em mất phong độ 1-2 trận đầu luôn), nhưng tầm trận thứ 4, thứ 5 thì
                                giày sẽ bắt đầu Break-in (giày sẽ mềm dần) và bắt đầu thuần chân của anh em. </strong
                            ></span
                        >
                    </p>
                    <p>
                        <span
                            ><em
                                >Lưu ý là trong khoảng thời gian để giày Break-in, khi ra sân anh em năng nổ chạy một
                                tý để giày nhanh thuần chân anh em hơn. Đừng ra sân khởi động nhẹ, sẽ làm giày lâu Break-in
                                hơn.</em
                            ></span
                        >
                    </p>
                    <img
                        src="//file.hstatic.net/200000278317/file/trang-break-in-giay-1_f006461552604f3bb0cccf4fe3b64c5e.jpg"
                    />
                    <p>
                        <span
                            ><strong
                                >3. Hãy luôn luôn ưu tiên đến cửa hàng để được đo kích thước chân thật chuẩn, và được thử
                                trực tiếp đôi giày trước khi quyết định mua. Ở Thanh Hùng Futsal, chúng mình luôn có bước đo
                                chân bằng dụng cụ chuyên dụng và luôn khuyến khích các bạn thử giày thật kỹ trước khi
                                mua.</strong
                            ></span
                        >
                    </p>
                    <img
                        src="//file.hstatic.net/200000278317/file/trang-break-in-giay-3_9804664335254ab3940fd6172881d3c7.jpg"
                    />
                </div>
            </div>
        </div>
    </div>

    <div class="related-products">
        <h2 class="related-products__title">SẢN PHẨM LIÊN QUAN</h2>
        <div class="row">
            <?php foreach ($relatedProducts as $product): ?>
                <div class="col l-3 m-6 c-10">
                    <a class="product-item" href="/thanhhungfutsal_v2/products/<?=$product->getId()?>">
                        <div
                            class="product-item__img"
                            style="
                                background-image: url('/thanhhungfutsal_v2/public/images/products/<?=$product->getImage()?>');
                            "
                        ></div>
                        <h4 class="product-item__name"><?=$product->getName()?></h4>
                        <div class="product-item__price">
                            <?php if($product->getSale()): ?>
                                <span class="product-item__price-current"><?=number_format($product->getSale())?>₫</span>
                                <span class="product-item__price-old"><?=number_format($product->getPrice())?>₫</span>
                            <?php else: ?>
                                <span class="product-item__price-current"><?=number_format($product->getPrice())?>₫</span>
                            <?php endif; ?>
                        </div>
                        <?php if (isset($product->sizes)): ?>
                            <div class="sizes-box">
                                <?php foreach ($product->sizes as $size): ?>
                                    <div class="size-item"><?=$size->getSize()?></div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        <?php if($product->getSale()): ?>
                            <div class="product-item__sale-off">-<?=$product->getPercentDiscount()?>%</div>
                        <?php endif; ?>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="see-more-btn">
            <a href="/thanhhungfutsal_v2/collection/<?=$product->getCategoryId()?>" class="see-more-btn__link">Xem thêm</a>
        </div>
    </div>
</div>

<div class="image-modal" onclick="closeImageModal()">
    <img class="image-modal__display" src="" onclick="event.stopPropagation()" />
    <a class="image-modal__close">
        <i class="fa-regular fa-circle-xmark"></i>
    </a>
</div>