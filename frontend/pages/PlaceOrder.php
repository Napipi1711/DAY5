<?php
session_start();
include_once(__DIR__ . '/dbConnect.php'); 
$conn = connectDb();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['place_order'])) {
    $customer_name = $_POST['customer_name'] ?? 'Khách lẻ';
    $total_amount = array_sum(array_map(function ($item) {
        return $item['price'] * $item['quantity'];
    }, $_SESSION['cart'] ?? []));

     $stmt = $conn->prepare("INSERT INTO orders (user_id, total_amount, status, order_date, shipping_address)
                            VALUES (?, ?, 'pending', NOW(), ?)");
    $stmt->bind_param("ids", $user_id, $total_amount, $address);
    $stmt->execute();
    $order_id = $stmt->insert_id;
    $stmt->close();

    $stmt = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity, price_at_time)
                            VALUES (?, ?, ?, ?)");
    foreach ($_SESSION['cart'] as $item) {
        $stmt->bind_param("iiid", $order_id, $item['id'], $item['quantity'], $item['price']);
        $stmt->execute();
    }
    $stmt->close();

    unset($_SESSION['cart']);
    echo "<script>alert('Đặt hàng thành công!'); window.location.href='PlaceOrder.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Giỏ hàng - Đặt hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-4">
        <h2 class="mb-4">🛒 Giỏ hàng của bạn</h2>

        <?php if (!empty($success_message)): ?>
            <div class="alert alert-success"><?= $success_message ?></div>
            <a href="/DAY5/index.php" class="btn btn-primary">🛍️ Tiếp tục mua sắm</a>
            <?php exit; ?>
        <?php endif; ?>

        <?php if (empty($_SESSION['cart'])): ?>
            <div class="alert alert-warning">Chưa có sản phẩm nào trong giỏ hàng.</div>
            <a href="/DAY5/frontend/index.php" class="btn btn-secondary">← Quay lại mua hàng</a>
        <?php else: ?>
            <form method="POST">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle bg-white">
                        <thead class="table-light">
                            <tr>
                                <th>Ảnh</th>
                                <th>Tên món</th>
                                <th>Đơn giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total = 0;
                            foreach ($_SESSION['cart'] as $item):
                                $subtotal = $item['price'] * $item['quantity'];
                                $total += $subtotal;
                            ?>
                                <tr>
                                    <td><img src="<?= htmlspecialchars($item['image']) ?>" width="60" class="img-thumbnail"></td>
                                    <td><?= htmlspecialchars($item['name']) ?></td>
                                    <td><?= number_format($item['price'], 0, ',', '.') ?>đ</td>
                                    <td><?= $item['quantity'] ?></td>
                                    <td><?= number_format($subtotal, 0, ',', '.') ?>đ</td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4" class="text-end">Tổng cộng:</th>
                                <th><?= number_format($total, 0, ',', '.') ?>đ</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="mb-3">
                    <label for="customer_name" class="form-label">Tên khách hàng:</label>
                    <input type="text" name="customer_name" id="customer_name" class="form-control" required placeholder="Nhập tên của bạn">
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" name="place_order" class="btn btn-success">Đặt hàng</button>
                    <a href="/DAY5/frontend/index.php" class="btn btn-secondary">Tiếp tục mua</a>
                </div>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
