<div class="crossbar">
    <span class="crossbar__title">Thanh Hùng Futsal - Giày Đá Bóng Chính Hãng - 2013</span>
</div>

<div class="news-list">
    <div class="grid wide">
        <div class="row">
            <?php foreach ($newsList as $news): ?>
                <div class="col l-3 m-6 c-10">
                    <div class="news-item">
                        <div>
                            <a href="/thanhhungfutsal_v2/news/<?=$news->getId()?>">
                                <img
                                    class="news-img"
                                    src="/thanhhungfutsal_v2/public/images/news/<?=$news->getThumbnail()?>"
                                    alt="<?=$news->getTitle()?>"
                                />
                            </a>
                        </div>
                        <div class="news-info">
                            <h3 class="news-title">
                                <a href="/thanhhungfutsal_v2/news/<?=$news->getId()?>"
                                    ><?=$news->getTitle()?></a
                                >
                            </h3>
                            <span class="news-cut">
                                <?=$news->getShortContent()?>
                            </span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="pagination">
        <?php if ($currentPage > 1): ?>
            <a href="?page=<?= $currentPage - 1 ?>" class="pagination-link__icon">
                <i class="fa-solid fa-chevron-left"></i>
            </a>
        <?php endif; ?>
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?page=<?= $i ?>" 
            class="pagination-link <?= $i === $currentPage ? 'active' : '' ?>">
                <?= $i ?>
            </a>
        <?php endfor; ?>
        <?php if ($currentPage < $totalPages): ?>
            <a href="?page=<?= $currentPage + 1 ?>" class="pagination-link__icon">
                <i class="fa-solid fa-chevron-right"></i>
            </a>
        <?php endif; ?>
    </div>
</div>