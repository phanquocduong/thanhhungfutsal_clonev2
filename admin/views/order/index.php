<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Đơn hàng</h6>
                <?php if (!empty($message)): ?>
                    <div class="alert alert-success"><?=$message?></div>
                <?php endif; ?>
                <?php if (!empty($error)): ?>
                    <div class="alert alert-success"><?=$error?></div>
                <?php endif; ?>
                <form action="" class="d-flex mb-4">
                    <div class="col-sm-11">
                        <input type="text" placeholder="Tìm kiếm theo tên khách hàng" class="form-control" />
                    </div>
                    <div class="col-sm-1" style="text-align: center">
                        <button class="btn btn-danger"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table" style="text-align: center; vertical-align: middle">
                        <thead>
                            <tr>
                                <th scope="col">Mã</th>
                                <th scope="col">Ngày</th>
                                <th style="text-align: left" scope="col">Khách hàng</th>
                                <th scope="col">Số tiền</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($orders as $order): ?>
                                <tr>
                                    <th scope="row"><?=$order->getId()?></th>
                                    <td><?=$order->getCreatedAt()?></td>
                                    <td style="text-align: left"><?=$order->getCustomer()?></td>
                                    <td><?=number_format($order->getTotalAmount())?>₫</td>
                                    <td><?=$order->getStatus()?></td>
                                    <td>
                                        <a href="/thanhhungfutsal_v2/admin/orders/edit/<?=$order->getId()?>"
                                            ><button class="btn btn-warning">
                                                <i class="fa-solid fa-file-pen"></i></button></a
                                        >
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>