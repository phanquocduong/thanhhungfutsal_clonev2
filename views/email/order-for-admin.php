<div style='font-family: Arial, sans-serif; max-width: 600px; margin: auto; background-color: #f9f9f9; border: 1px solid #ddd; border-radius: 8px; overflow: hidden;'>
    <div style='background-color: #d9121f; color: white; padding: 20px; text-align: center;'>
        <h1 style='margin: 0;'>Thông báo đơn hàng mới</h1>
    </div>
    <div style='padding: 20px;'>
        <p><strong>Khách hàng: </strong><?=$fullname?></p>
        <p><strong>Email: </strong><?=$email?></p>
        <p><strong>Số điện thoại: </strong><?=$phone?></p>
        <p><strong>Địa chỉ: </strong><?=$address?></p>
        <p><strong>Phương thức thanh toán: </strong><?=$method?></p>
        <p><strong>Giảm giá: </strong><?= $discount_value ? $discount_value . '%' : 'Không có' ?></p>
        <p><strong>Phí vận chuyển: </strong><?=number_format($transport_fee)?>₫</p>
        <p><strong>Tổng cộng: </strong><?=number_format($total)?>₫</p>
        <?php if ($note): ?>
            <p><strong>Ghi chú: </strong><?=$note?></p>
        <?php endif; ?>
        <h3>Chi tiết đơn hàng:</h3>
        <table style='width: 100%; border-collapse: collapse;'>
            <thead>
                <tr style='background-color: #f5f5f5;'>
                    <th style='padding: 10px; border: 1px solid #ddd; text-align: left;'>Sản phẩm</th>
                    <th style='padding: 10px; border: 1px solid #ddd; text-align: center;'>Kích thước</th>
                    <th style='padding: 10px; border: 1px solid #ddd; text-align: center;'>Số lượng</th>
                    <th style='padding: 10px; border: 1px solid #ddd; text-align: right;'>Đơn giá</th>
                    <th style='padding: 10px; border: 1px solid #ddd; text-align: right;'>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                <?=$order_items?>
            </tbody>
        </table>
    </div>
</div>