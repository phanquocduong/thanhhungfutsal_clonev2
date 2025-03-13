<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Thêm sản phẩm</h6>
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger"><?=$error?></div>
                <?php endif; ?>
                <form action="/thanhhungfutsal_v2/admin/products/add/handle" method="POST" enctype="multipart/form-data">
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Tên</label>
                        <div class="col-sm-10">
                            <input required type="text" name="name" class="form-control" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Giá gốc</label>
                        <div class="col-sm-10">
                            <input required type="number" name="price" class="form-control" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Giá sau khi giảm</label>
                        <div class="col-sm-10">
                            <input type="number" name="sale" class="form-control" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Ảnh</label>
                        <div class="col-sm-10">
                            <input required  name="image" type="file" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Ảnh phụ</label>
                        <div class="col-sm-10">
                            <input type="file" name="extra_images[]" class="form-control" multiple />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Mô tả</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="description"></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Trạng thái</label>
                        <div class="col-sm-10">
                            <select class="form-select" name="status">
                                <option value="1">Hiện</option>
                                <option value="0">Ẩn</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Số lượng đã bán</label>
                        <div class="col-sm-10">
                            <input type="number" name="sold" class="form-control" value="0" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Danh mục</label>
                        <div class="col-sm-10">
                            <select class="form-select" name="category_id">
                                <?php foreach($categories as $category): ?>
                                    <option value="<?=$category->getId()?>"><?=$category->getName()?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <button class="btn btn-primary">Thêm</button>
                </form>
            </div>
        </div>
    </div>
</div>