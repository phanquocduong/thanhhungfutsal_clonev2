<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Chỉnh sửa tin tức</h6>
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger"><?=$error?></div>
                <?php endif; ?>
                <form action="/thanhhungfutsal_v2/admin/news/edit/<?=$news->getId()?>/handle" method="POST" enctype="multipart/form-data">
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Ảnh</label>
                        <div class="col-sm-10">
                            <img
                                class="me-3"
                                style="width: 100px; height: 100px"
                                src="/thanhhungfutsal_v2/public/images/news/<?=$news->getThumbnail()?>"
                            />
                            <input name="thumbnail" type="file" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Tiêu đề</label>
                        <div class="col-sm-10">
                            <input required name="title" type="text" class="form-control" value="<?=$news->getTitle()?>" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Nội dung</label>
                        <div class="col-sm-10">
                            <textarea required class="form-control" name="content"><?=$news->getContent()?></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Trạng thái</label>
                        <div class="col-sm-10">
                            <select class="form-select" name="status">
                                <option value="0" <?=$news->getStatus() == 0 ? 'selected' : ''?>>Ẩn</option>
                                <option value="1" <?=$news->getStatus() == 1 ? 'selected' : ''?>>Hiện</option>
                            </select>
                        </div>
                    </div>
                    <button class="btn btn-primary">Lưu</button>
                </form>
            </div>
        </div>
    </div>
</div>