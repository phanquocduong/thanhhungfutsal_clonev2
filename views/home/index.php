<div class="slideshow-container">
    <div class="slides">
        <img src="./public/images/slideshow/slideshow_1.webp" alt="" class="slide" />
        <img src="./public/images/slideshow/slideshow_2.webp" alt="" class="slide" />
        <img src="./public/images/slideshow/slideshow_3.webp" alt="" class="slide" />
        <img src="./public/images/slideshow/slideshow_4.webp" alt="" class="slide" />
        <img src="./public/images/slideshow/slideshow_5.webp" alt="" class="slide" />
        <img src="./public/images/slideshow/slideshow_6.webp" alt="" class="slide" />
        <img src="./public/images/slideshow/slideshow_7.webp" alt="" class="slide" />
        <img src="./public/images/slideshow/slideshow_8.webp" alt="" class="slide" />
    </div>

    <a class="slideshow-prev"><i class="fa-solid fa-chevron-left"></i></a>
    <a class="slideshow-next"><i class="fa-solid fa-chevron-right"></i></a>
</div>

<section class="new-products-section">
    <h2 class="section-title">MỚI RA MẮT</h2>
    <div class="grid wide">
        <div class="row">
            <?php foreach($newProducts as $product): ?>
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
    </div>
</section>

<section class="categories-section">
    <h2 class="section-title">BẠN ĐANG QUAN TÂM</h2>
    <div class="grid wide">
        <div class="row">
            <?php foreach($categories as $category): ?>
                <div class="col l-4 m-4 c-10">
                    <a href="/thanhhungfutsal_v2/collection/<?=$category->getId()?>">
                        <img src="/thanhhungfutsal_v2/public/images/categories/<?=$category->getImage()?>" alt="<?=$category->getName()?>" class="category-img" />
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="stores-section">
    <div class="grid wide">
        <img class="stores-img" src="./public/images/stores/stores.webp" alt="Các cửa hàng Thanh Hùng Futsal" />
    </div>
</section>

<section class="benefits-section">
    <h2 class="section-title">TRẢI NGHIỆM MUA SẮM TẠI CỬA HÀNG</h2>
    <div class="benefits-wrap">
        <div class="benefit-item">
            <img src="./public/images/benefits/benefit-1.webp" class="benefit-item__img" />
            <div class="benefit-item__name-wrap">
                <span class="benefit-item__name">Tư vấn bán hàng chuyên nghiệp.</span>
            </div>
        </div>
        <div class="benefit-item">
            <img src="./public/images/benefits/benefit-2.jpg" class="benefit-item__img" />

            <div class="benefit-item__name-wrap">
                <span class="benefit-item__name">Hỗ trợ đo chân bằng thiết bị chuyên dụng.</span>
            </div>
        </div>
        <div class="benefit-item">
            <img src="./public/images/benefits/benefit-3.webp" class="benefit-item__img" />

            <div class="benefit-item__name-wrap">
                <span class="benefit-item__name">Quà tặng khi mua giày (Vớ, Balo).</span>
            </div>
        </div>
        <div class="benefit-item">
            <img src="./public/images/benefits/benefit-4.webp" class="benefit-item__img" />

            <div class="benefit-item__name-wrap">
                <span class="benefit-item__name">Thanh toán linh hoạt (Tiền mặt, Thẻ, Chuyển khoản).</span>
            </div>
        </div>
        <div class="benefit-item">
            <img src="./public/images/benefits/benefit-5.webp" class="benefit-item__img" />

            <div class="benefit-item__name-wrap">
                <span class="benefit-item__name">Hỗ trợ trả góp 0% lãi suất qua Fundiin (Thủ tục đơn giản).</span>
            </div>
        </div>
        <div class="benefit-item">
            <img src="./public/images/benefits/benefit-6.webp" class="benefit-item__img" />

            <div class="benefit-item__name-wrap">
                <span class="benefit-item__name">Dịch vụ giao hàng nhanh chóng (Grab & GHTK).</span>
            </div>
        </div>
    </div>
</section>

<section class="featured-categories-section">
    <div class="featured-categories__header">
        <h2 class="featured-category__title featured-category__title--active">GIÀY SÂN CỎ NHÂN TẠO</h2>
        <h2 class="featured-category__title">GIÀY SÂN FUTSAL</h2>
    </div>
    <div class="featured-category__products featured-category__products--active">
        <div class="grid wide">
            <div class="row">
                <?php foreach($tfProducts as $product): ?>
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
                <a href="/thanhhungfutsal_v2/collection/<?=$tfProducts[0]->getCategoryId()?>" class="see-more-btn__link">Xem thêm</a>
            </div>
        </div>
    </div>
    <div class="featured-category__products">
        <div class="grid wide">
            <div class="row">
                <?php foreach($icProducts as $product): ?>
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
                <a href="/thanhhungfutsal_v2/collection/<?=$icProducts[0]->getCategoryId()?>" class="see-more-btn__link">Xem thêm</a>
            </div>
        </div>
    </div>
</section>

<section class="hot-sales-section">
    <h2 class="section-title">HOTSALE</h2>
    <div class="grid wide">
        <div class="row">
            <?php foreach($hotSaleProducts as $product): ?>
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
    </div>
</section>

<section class="customers-section">
    <h2 class="section-title">KHÁCH HÀNG CỦA THF</h2>
    <div class="grid wide">
        <img class="customers-img" src="./public/images/customers/customers.webp" alt="Khách hàng của THF" />
    </div>
</section>

<section class="news-section">
    <h2 class="section-title">TIN TỨC GIÀY</h2>
    <div class="grid wide">
        <div class="row">
            <?php foreach($latestNewsList as $news): ?>
                <div class="col l-4 m-4 c-10">
                    <div class="newspaper-item">
                        <a href="/thanhhungfutsal_v2/news/<?=$news->getId()?>" class="newspaper-item__img-link">
                            <img
                                src="/thanhhungfutsal_v2/public/images/news/<?=$news->getThumbnail()?>"
                                alt="<?=$news->getTitle()?>"
                                class="newspaper-item__img"
                            />
                        </a>
                        <div class="newspaper__info">
                            <h3 class="newspaper__info-heading">
                                <a href="/thanhhungfutsal_v2/news/<?=$news->getId()?>" class="newspaper__info-heading-link"
                                    ><?=$news->getTitle()?></a
                                >
                            </h3>
                            <span class="newspaper__info-dsc"><?=$news->getShortContent()?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="see-more-title">
            <a href="/thanhhungfutsal_v2/news" class="see-more-title__link">
                XEM TẤT CẢ
                <i class="see-more-title__icon fa-solid fa-angle-right"></i>
            </a>
        </div>
    </div>
</section>
