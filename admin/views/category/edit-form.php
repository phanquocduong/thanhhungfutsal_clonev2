<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Chỉnh sửa danh mục</h6>
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger"><?=$error?></div>
                <?php endif; ?>
                <form action="/thanhhungfutsal_v2/admin/categories/edit/<?=$category->getId()?>/handle" method="POST" enctype="multipart/form-data">
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Tên</label>
                        <div class="col-sm-10">
                            <input required name="name" type="text" class="form-control" value="<?=$category->getName()?>" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Ảnh</label>
                        <div class="col-sm-10">
                            <?php if (!empty($category->getImage())): ?>
                                <img
                                    class="me-3"
                                    style="width: 100px; height: 100px"
                                    src="/thanhhungfutsal_v2/public/images/categories/<?=$category->getImage()?>"
                                    alt="<?=$category->getName()?>"
                                />
                            <?php endif; ?>
                            <input name="image" type="file" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Mô tả</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="description"><?=$category->getDescription()?></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Trạng thái</label>
                        <div class="col-sm-10">
                            <select class="form-select" name="status">
                                <option value="0" <?=$category->getStatus() == 0 ? 'selected' : ''?>>Ẩn</option>
                                <option value="1" <?=$category->getStatus() == 1 ? 'selected' : ''?>>Hiện</option>
                            </select>
                        </div>
                    </div>
                    <button class="btn btn-primary">Lưu</button>
                </form>
            </div>
        </div>
    </div>
</div>