<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Biến thể sản phẩm</h6>
                <?php if (!empty($message)): ?>
                    <div class="alert alert-success"><?=$message?></div>
                <?php endif; ?>
                <?php if (!empty($error)): ?>
                    <div class="alert alert-success"><?=$error?></div>
                <?php endif; ?>
                <form action="" class="d-flex mb-4">
                    <div class="col-sm-11">
                        <input type="text" placeholder="Tìm kiếm theo mã sản phẩm" class="form-control" />
                    </div>
                    <div class="col-sm-1" style="text-align: center">
                        <button class="btn btn-danger"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>
                <a href="/thanhhungfutsal_v2/admin/products/variants/add" class="mb-4 d-block">Thêm biến thể sản phẩm</a>
                <div class="table-responsive">
                    <table class="table" style="text-align: center; vertical-align: middle">
                        <thead>
                            <tr>
                                <th scope="col">Mã biến thể</th>
                                <th scope="col">Mã sản phẩm</th>
                                <th scope="col">Kích thước</th>
                                <th scope="col">Số lượng hàng tồn kho</th>
                                <th scope="col">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($productsVariants as $item): ?>
                                <tr>
                                    <th scope="row"><?=$item->getId()?></th>
                                    <td><?=$item->getProductId()?></td>
                                    <td><?=$item->getSize()?></td>
                                    <td><?=$item->getStockQuantity()?></td>
                                    <td class="text-left">
                                        <a href="/thanhhungfutsal_v2/admin/products/variants/edit/<?=$item->getId()?>"
                                            ><button class="btn btn-warning">
                                                <i class="fa-solid fa-pen"></i></button></a
                                        ><a href="/thanhhungfutsal_v2/admin/products/variants/delete/<?=$item->getId();?>" onclick="return confirm('Bạn có chắc muốn xóa biến thể sản phẩm này không?');"
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