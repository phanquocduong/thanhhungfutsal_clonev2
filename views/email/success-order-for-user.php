<div style="font-family: Arial, sans-serif; max-width: 600px; margin: auto; background-color: #f9f9f9; border: 1px solid #ddd; border-radius: 8px; overflow: hidden;">
    <div style="background-color: #d9121f; color: white; padding: 20px; text-align: center;">
        <h1 style="margin: 0;">Thanh Hùng Futsal</h1>
        <p style="margin: 0;">Hóa đơn đặt hàng của bạn</p>
    </div>
    <div style="padding: 20px;">
        <p style="margin-bottom: 10px;">Xin chào <strong><?= $fullname ?></strong>,</p>
        <p style="margin-bottom: 20px;">Cảm ơn bạn đã đặt hàng tại <strong>Thanh Hùng Futsal</strong>. Dưới đây là thông tin đơn hàng của bạn:</p>
        <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
            <thead>
                <tr style="background-color: #f5f5f5;">
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: left;">Sản phẩm</th>
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: center;">Kích thước</th>
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: center;">Số lượng</th>
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: right;">Đơn giá</th>
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: right;">Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                <?=$order_items?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" style="text-align: right; padding: 10px; border: 1px solid #ddd;"><strong>Giảm giá:</strong></td>
                    <td style="text-align: right; padding: 10px; border: 1px solid #ddd;"><?= $discount_value ? $discount_value . '%' : 'Không có' ?></td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: right; padding: 10px; border: 1px solid #ddd;"><strong>Phí vận chuyển:</strong></td>
                    <td style="text-align: right; padding: 10px; border: 1px solid #ddd;"><?=number_format($transport_fee)?>₫</td>
                </tr>
                <tr style="background-color: #f5f5f5;">
                    <td colspan="4" style="text-align: right; padding: 10px; border: 1px solid #ddd;"><strong>Tổng cộng:</strong></td>
                    <td style="text-align: right; padding: 10px; border: 1px solid #ddd;"><strong><?=number_format($total)?>₫</strong></td>
                </tr>
            </tfoot>
        </table>
        <p style="margin-bottom: 5px;"><strong>Địa chỉ giao hàng: </strong><?=$address . ', ' . $ward->getName() . ', ' . $district->getName() . ', ' . $province->getName()?></p>
        <p style="margin-bottom: 5px;"><strong>Số điện thoại: </strong><?=$phone?></p>
        <p style="margin-bottom: 5px;"><strong>Phương thức thanh toán: </strong><?=$method?></p>
        <?php if ($note): ?>
            <p style="margin-bottom: 20px;"><strong>Ghi chú: </strong><?=$note?></p>
        <?php endif; ?>
        <p style="margin: 20px 0; text-align: center;">
            <strong>Thanh Hùng Futsal</strong> xin chân thành cảm ơn và hân hạnh được phục vụ quý khách!
        </p>
    </div>
    <div style="background-color: #f5f5f5; padding: 10px; text-align: center;">
        <p style="margin: 0;">Ngũ Long Bakery - Giày đá banh chính hãng</p>
        <p style="margin: 0;">📍 27 Đường D52, P.12, Q.Tân Bình, TP.HCM </p>
        <p style="margin: 0;">📞 082 828 3169 | 🌐 <a href="https://thanhhungfutsal.com/" style="color: #d9121f; text-decoration: none;">thanhhungfutsal.com</a></p>
    </div>
</div>
