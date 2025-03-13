<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Chi tiết đơn hàng</h6>
                <form action="/thanhhungfutsal_v2/admin/orders/edit/<?=$order->getId()?>/handle" method="POST">
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Mã</label>
                        <div class="col-sm-9 col-form-label">
                            <span><?=$order->getId()?></span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Khách hàng</label>
                        <div class="col-sm-9 col-form-label">
                            <span><?=$order->getCustomer()?></span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9 col-form-label">
                            <span><?=$order->getEmail()?></span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Số điện thoại</label>
                        <div class="col-sm-9 col-form-label">
                            <span><?=$order->getPhone()?></span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Địa chỉ giao hàng</label>
                        <div class="col-sm-9 col-form-label">
                            <span><?=$order->getShippingAddress()?></span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Tỉnh/thành</label>
                        <div class="col-sm-9 col-form-label">
                            <span><?=$order->province_name?></span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Quận/huyện</label>
                        <div class="col-sm-9 col-form-label">
                            <span><?=$order->district_name?></span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Phường/xã</label>
                        <div class="col-sm-9 col-form-label">
                            <span><?=$order->ward_name?></span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Tổng tiền</label>
                        <div class="col-sm-9 col-form-label">
                            <span><?=number_format($order->getTotalAmount())?>₫</span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Phương thức thanh toán</label>
                        <div class="col-sm-9 col-form-label">
                            <span><?=$order->getPaymentMethod()?></span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Ngày tạo đơn</label>
                        <div class="col-sm-9 col-form-label">
                            <span><?=$order->getCreatedAt()?></span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Ghi chú</label>
                        <div class="col-sm-9 col-form-label">
                            <span><?=$order->getNote()?></span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Mã giảm giá</label>
                        <div class="col-sm-9 col-form-label">
                            <span><?=$order->discount_code?></span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Trạng thái</label>
                        <div class="col-sm-9">
                            <select class="form-select" name="status">
                                <option value="<?=$order->getStatus()?>" selected><?=$order->getStatus()?></option>
                                <?php if ($order->getStatus() == 'Chờ xác nhận'): ?>
                                    <option value="Đã xác nhận">Đã xác nhận</option>
                                    <option value="Đang giao hàng">Đang giao hàng</option>
                                    <option value="Giao hàng thành công">Giao hàng thành công</option>
                                <?php elseif ($order->getStatus() == 'Đã xác nhận'): ?>
                                    <option value="Đang giao hàng">Đang giao hàng</option>
                                    <option value="Giao hàng thành công">Giao hàng thành công</option>
                                <?php elseif ($order->getStatus() == 'Đang giao hàng'): ?>
                                    <option value="Giao hàng thành công">Giao hàng thành công</option>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>

                    <div class="my-4">
                        <table class="table table-bordered" style="text-align: center; vertical-align: middle">
                            <thead>
                                <tr>
                                    <th scope="col">Sản phẩm</th>
                                    <th scope="col">Kích thước</th>
                                    <th scope="col">Đơn giá</th>
                                    <th scope="col">Số lượng</th>
                                    <th scope="col">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($orderItems as $item): ?>
                                    <tr>
                                        <td><?=$item->product_name?></td>
                                        <td><?=$item->getSize()?></td>
                                        <td><?=number_format($item->getUnitPrice())?>₫</td>
                                        <td><?=$item->getQuantity()?></td>
                                        <td><?=number_format($item->getUnitPrice() * $item->getQuantity())?>₫</td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <td colspan="4">Giảm giá</td>
                                    <td><?=$order->discount_value?>%</td>
                                </tr>
                                <tr>
                                    <td colspan="4">Phí vận chuyển</td>
                                    <td><?=number_format($order->getDeliveryFee())?>₫</td>
                                </tr>
                                <tr>
                                    <td colspan="4">Tổng tiền</td>
                                    <td><?=number_format($order->getTotalAmount())?>₫</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <button type="submit" class="btn btn-primary">Lưu</button>
                </form>
            </div>
        </div>
    </div>
</div>