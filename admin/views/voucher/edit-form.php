<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Chỉnh sửa mã giảm giá</h6>
                <form action="/thanhhungfutsal_v2/admin/vouchers/edit/<?=$voucher->getId()?>/handle" method="POST">
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Mã giảm giá</label>
                        <div class="col-sm-9">
                            <input required name="code" type="text" class="form-control" value="<?=$voucher->getCode()?>" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Phần trăm giảm giá</label>
                        <div class="col-sm-9">
                            <input required name="discount_value" type="number" class="form-control" value="<?=$voucher->getDiscountValue()?>" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Ngày bắt đầu</label>
                        <div class="col-sm-9">
                            <input required name="start_date" type="date" class="form-control" value="<?=$voucher->getStartDate()?>" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Ngày kết thúc</label>
                        <div class="col-sm-9">
                            <input required name="end_date" type="date" class="form-control" value="<?=$voucher->getEndDate()?>" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Số lần sử dụng</label>
                        <div class="col-sm-9">
                            <input required name="usage_limit" type="number" class="form-control" value="<?=$voucher->getUsageLimit()?>" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Giá trị đơn hàng tối thiểu</label>
                        <div class="col-sm-9">
                            <input required name="min_order_value" type="number" class="form-control" value="<?=$voucher->getMinOrderValue()?>" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Trạng thái</label>
                        <div class="col-sm-9">
                            <select class="form-select" name="status">
                                <option value="0" <?=$voucher->getStatus() ? '' : 'selected'?>>Ẩn</option>
                                <option value="1" <?=$voucher->getStatus() ? 'selected' : ''?>>Hiện</option>
                            </select>
                        </div>
                    </div>
                    <button class="btn btn-primary">Lưu</button>
                </form>
            </div>
        </div>
    </div>
</div>