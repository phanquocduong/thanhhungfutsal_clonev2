<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Thêm danh mục</h6>
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger"><?=$error?></div>
                <?php endif; ?>
                <form action="/thanhhungfutsal_v2/admin/categories/add/handle" method="POST" enctype="multipart/form-data">
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Tên</label>
                        <div class="col-sm-10">
                            <input required type="text" name="name" class="form-control" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Ảnh</label>
                        <div class="col-sm-10">
                            <input type="file" name="image" />
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
                    <button class="btn btn-primary">Thêm</button>
                </form>
            </div>
        </div>
    </div>
</div>