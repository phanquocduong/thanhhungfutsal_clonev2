<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Chỉnh sửa biến thể sản phẩm</h6>
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger"><?=$error?></div>
                <?php endif; ?>
                <form action="/thanhhungfutsal_v2/admin/products/variants/edit/<?=$productVariant->getId()?>/handle" method="POST">
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Kích thước</label>
                        <div class="col-sm-10">
                            <input required name="size" type="text" class="form-control" value="<?=$productVariant->getSize()?>" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Số lượng hàng tồn kho</label>
                        <div class="col-sm-10">
                            <input required name="stock_quantity" type="number" class="form-control" value="<?=$productVariant->getStockQuantity()?>" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Sản phẩm</label>
                        <div class="col-sm-10">
                            <select class="form-select" name="product_id">
                                <?php foreach ($products as $product): ?>
                                    <option value="<?=$product->getId()?>" <?=($product->getId() === $productVariant->getProductId()) ? 'selected' : ''?>><?=$product->getId()?> - <?=$product->getName()?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <button class="btn btn-primary">Lưu</button>
                </form>
            </div>
        </div>
    </div>
</div>