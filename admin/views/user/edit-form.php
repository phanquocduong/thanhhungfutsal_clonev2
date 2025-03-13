<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Chỉnh sửa người dùng</h6>
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger"><?=$error?></div>
                <?php endif; ?>
                <form action="/thanhhungfutsal_v2/admin/users/edit/<?=$user->getId()?>/handle" method="POST">
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Vai trò</label>
                        <div class="col-sm-10">
                            <select class="form-select" name="role_id">
                                <option value="0" <?=$user->getRoleId() ? '' : 'selected'?>>Người dùng</option>
                                <option value="1" <?=$user->getRoleId() ? 'selected' : ''?>>Quản trị viên</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Trạng thái</label>
                        <div class="col-sm-10">
                            <select class="form-select" name="status">
                                <option value="0" <?=$user->getStatus() ? '' : 'selected'?>>Khoá</option>
                                <option value="1" <?=$user->getStatus() ? 'selected' : ''?>>Mở</option>
                            </select>
                        </div>
                    </div>
                    <button class="btn btn-primary">Lưu</button>
                </form>
            </div>
        </div>
    </div>
</div>