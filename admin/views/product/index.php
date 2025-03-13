<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Sản phẩm</h6>
                <?php if (!empty($message)): ?>
                    <div class="alert alert-success"><?=$message?></div>
                <?php endif; ?>
                <?php if (!empty($error)): ?>
                    <div class="alert alert-success"><?=$error?></div>
                <?php endif; ?>
                <form action="" class="d-flex mb-4">
                    <div class="col-sm-11">
                        <input type="text" placeholder="Tìm kiếm theo tên sản phẩm" class="form-control" />
                    </div>
                    <div class="col-sm-1" style="text-align: center">
                        <button class="btn btn-danger"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>
                <a href="/thanhhungfutsal_v2/admin/products/add" class="mb-4 d-block">Thêm sản phẩm</a>
                <div class="table-responsive">
                    <table class="table" style="text-align: center; vertical-align: middle">
                        <thead>
                            <tr>
                                <th scope="col">Mã</th>
                                <th style="text-align: left" scope="col">Tên</th>
                                <th style="text-align: left" scope="col">Giá</th>
                                <th scope="col">Ảnh</th>
                                <th scope="col">Đã bán</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($products as $product): ?>
                                <tr>
                                    <th scope="row"><?=$product->getId()?></th>
                                    <td style="text-align: left"><?=$product->getName()?></td>
                                    <td style="text-align: left"><?=number_format(($product->getSale() ? $product->getSale() : $product->getPrice()))?>₫</td>
                                    <td>
                                        <img
                                            style="width: 100px; height: 100px"
                                            src="/thanhhungfutsal_v2/public/images/products/<?=$product->getImage()?>"
                                            alt="<?=$product->getName()?>"
                                        />
                                    </td>
                                    <td><?=$product->getSold()?></td>
                                    <td><i style="color: <?=$product->getStatus() ? 'green' : 'red'?>" class="fa-solid fa-circle"></i></td>
                                    <td>
                                        <a href="/thanhhungfutsal_v2/admin/products/edit/<?=$product->getId()?>"
                                            ><button class="btn btn-warning">
                                                <i class="fa-solid fa-pen"></i></button></a
                                        ><a href="/thanhhungfutsal_v2/admin/products/delete/<?=$product->getId();?>" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này không?');"
                                            ><button class="btn btn-danger ms-2"><i class="fa-solid fa-trash"></i></button
                                        ></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php if ($totalPages > 1): ?>
                        <div class="d-flex justify-content-center mt-4">
                            <nav>
                                <ul class="pagination">
                                    <?php if ($currentPage > 1): ?>
                                        <li class="page-item">
                                            <a class="page-link bg-dark text-white" href="?page=<?= $currentPage - 1 ?>">
                                                <span>&laquo;</span>
                                            </a>
                                        </li>
                                    <?php endif; ?>

                                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                        <li class="page-item <?= $i == $currentPage ? 'active' : '' ?>">
                                            <a class="page-link <?= $i == $currentPage ? 'bg-primary text-white' : 'bg-dark text-white' ?>" href="?page=<?= $i ?>"><?= $i ?></a>
                                        </li>
                                    <?php endfor; ?>

                                    <?php if ($currentPage < $totalPages): ?>
                                        <li class="page-item">
                                            <a class="page-link bg-dark text-white" href="?page=<?= $currentPage + 1 ?>">
                                                <span>&raquo;</span>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </nav>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>