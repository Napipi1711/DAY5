<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Trang chủ</title>
  
  <?php include_once(__DIR__ . '/../frontend/layouts/partials/header.php'); ?>
<link rel="stylesheet" href="css/fly-to-cart.css">  
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

  <?php include_once(__DIR__ . '/../frontend/layouts/partials/header.php'); ?>

  <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="../assets/slides/hinh1.jpg" class="d-block w-100" alt="Slide 1">
        <div class="container">
          <div class="carousel-caption text-start">
            <h1>Example headline.</h1>
            <p>Some representative placeholder content for the first slide of the carousel.</p>
            <p><a class="btn btn-lg btn-primary" href="#">Sign up today</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <img src="../assets/slides/hinh2.jpg" class="d-block w-100" alt="Slide 2">
        <div class="container">
          <div class="carousel-caption">
            <h1>Another example headline.</h1>
            <p>Some representative placeholder content for the second slide of the carousel.</p>
            <p><a class="btn btn-lg btn-primary" href="#">Learn more</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <img src="../assets/slides/hinh3.jpg" class="d-block w-100" alt="Slide 3">
        <div class="container">
          <div class="carousel-caption text-end">
            <h1>One more for good measure.</h1>
            <p>Some representative placeholder content for the third slide of this carousel.</p>
            <p><a class="btn btn-lg btn-primary" href="#">Browse gallery</a></p>
          </div>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>
  </div>

  <div class="container marketing mt-5">
    <div class="row text-center mb-4">
      <div class="col-lg-4">
        <i class="fa fa-credit-card fa-3x mb-3 text-primary"></i>
        <h2>Thanh toán dễ dàng</h2>
        <p>Hỗ trợ nhiều hình thức như QR, ví điện tử, thẻ tín dụng.</p>
      </div>
      <div class="col-lg-4">
        <i class="fa fa-credit-card fa-3x mb-3 text-success"></i>
        <h2>Bảo mật cao</h2>
        <p>Mọi giao dịch đều được mã hóa, an toàn tuyệt đối.</p>
      </div>
      <div class="col-lg-4">
        <i class="fa fa-credit-card fa-3x mb-3 text-danger"></i>
        <h2>Hỗ trợ 24/7</h2>
        <p>Đội ngũ chăm sóc khách hàng sẵn sàng phục vụ bạn.</p>
      </div>
    </div>

    <div class="row text-center mb-4">
      <div class="col-lg-4">
        <i class="fa fa-credit-card fa-3x mb-3 text-warning"></i>
        <h2>Giao diện trực quan</h2>
        <p>Thiết kế thân thiện, dễ sử dụng với mọi đối tượng.</p>
      </div>
      <div class="col-lg-4">
        <i class="fa fa-credit-card fa-3x mb-3 text-info"></i>
        <h2>Tích hợp đa nền tảng</h2>
        <p>Hoạt động mượt mà trên cả mobile và desktop.</p>
      </div>
      <div class="col-lg-4">
        <i class="fa fa-credit-card fa-3x mb-3 text-secondary"></i>
        <h2>Thanh toán một chạm</h2>
        <p>Chỉ cần 1 cú nhấp để hoàn tất đơn hàng.</p>
      </div>
    </div>

    <div class="row text-center mb-4">
      <div class="col-lg-4">
        <i class="fa fa-credit-card fa-3x mb-3 text-dark"></i>
        <h2>Báo cáo chi tiết</h2>
        <p>Thống kê giao dịch rõ ràng, minh bạch.</p>
      </div>
      <div class="col-lg-4">
        <i class="fa fa-credit-card fa-3x mb-3 text-primary"></i>
        <h2>Khuyến mãi liên tục</h2>
        <p>Nhiều ưu đãi hấp dẫn cho khách hàng thân thiết.</p>
      </div>
    </div>
  </div>
    <?php
require_once(__DIR__ . '/pages/dbConnect.php');

$conn = connectDb();

$sql = "SELECT * FROM product ORDER BY id DESC LIMIT 6";
$result = $conn->query($sql);
?>

<div class="container my-5">
  <h2 class="text-center mb-4">product</h2>
  <div class="row">
    <?php while ($row = $result->fetch_assoc()): ?>
      <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm">
          <a href="/pages/details.php?id=<?php echo $row['id']; ?>">
            <img src="/DAY5/assets/<?php echo htmlspecialchars($row['image_url']); ?>" 
                 class="card-img-top" 
                 alt="<?php echo htmlspecialchars($row['name']); ?>">
          </a>
          <div class="card-body">
            <h5 class="card-title">
              <a href="/DAY5/frontend/pages/details.php?id=<?php echo $row['id']; ?>" class="text-decoration-none text-dark">
                <?php echo htmlspecialchars($row['name']); ?>
              </a>
            </h5>
            <p class="card-text text-muted"><?php echo htmlspecialchars($row['description']); ?></p>
            <p class="card-text fw-bold text-danger"><?php echo number_format($row['price'], 0, ',', '.') ?> đ</p>
          </div>
          <div class="card-footer bg-transparent border-top-0 text-center">
 
  <a href="/DAY5/frontend/pages/details.php?id=<?php echo $row['id']; ?>" 
     class="btn btn-outline-secondary w-100 mb-2">
     Chi tiết
  </a>

 
  <a href="#" 
     class="btn btn-primary w-100 add-to-cart"
     data-id="<?php echo $row['id']; ?>"
     data-name="<?php echo htmlspecialchars($row['name']); ?>"
     data-price="<?php echo $row['price']; ?>"
     data-img="/DAY5/assets/<?php echo htmlspecialchars($row['image_url'] ?? 'default.png'); ?>">
     Add Cart
  </a>
</div>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
</div>
      <div class="container my-5">
  <h2 class="text-center mb-4"> HUTECH</h2>
  <p class="text-center">
    <strong>475A Điện Biên Phủ, Quận Bình Thạnh, TP.HCM</strong>
  </p>
  <div class="ratio ratio-16x9">
    <iframe 
      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.065990517477!2d106.71304817490543!3d10.804896858723876!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317528c244af4c8d%3A0xd3b7cf7b2bd6e5f5!2zSFRVVEVDSCAtIEPGsOG7n25nIHPhu5EgQSAtIDQ3NUEgxJDDtG5nIELDrG5oIFBo4bqldQ!5e0!3m2!1svi!2s!4v1721721159123!5m2!1svi!2s" 
      width="600" height="450" style="border:0;" 
      allowfullscreen="" loading="lazy" 
      referrerpolicy="no-referrer-when-downgrade">
    </iframe>
  </div>
</div>

<script src="js/fly-to-cart.js"></script>
  <?php include_once(__DIR__ . '/../frontend/layouts/partials/scripts.php'); ?>
  <?php include_once(__DIR__ . '/../frontend/layouts/partials/footer.php'); ?>
</body>
</html>
