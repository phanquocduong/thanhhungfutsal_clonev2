<div class="crossbar">
    <span class="crossbar__title">Thanh Hùng Futsal - Giày Đá Bóng Chính Hãng - 2013</span>
</div>

<div class="container">
    <div class="grid wide news-content-box">
        <div class="news-content">
            <h1 class="news-content__title"><?=$news->getTitle()?></h1>
            <div class="news-content__date"><?=$news->getCreatedAt()?></div>
            <div class="news-content__body">
               <?=$news->getContent()?>
            </div>
        </div>
    </div>
</div>