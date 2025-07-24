<!doctype html>
<html lang="en" data-bs-theme="auto">
<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Carousel Template · Bootstrap v5.3</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    .carousel-caption {
      bottom: 3rem;
      z-index: 10;
    }

    .carousel-item {
      height: 32rem;
      background-color: #777;
      color: white;
      position: relative;
      text-align: center;
    }

    .carousel-item > img {
      position: absolute;
      top: 0;
      left: 0;
      min-width: 100%;
      height: 32rem;
      object-fit: cover;
      opacity: 0.6;
    }
  </style>
</head>
<body>
<header>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Carousel</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Link</a></li>
          <li class="nav-item"><a class="nav-link disabled">Disabled</a></li>
        </ul>
        <div class="d-flex align-items-center me-3">
       
         <a class="text-white position-relative text-decoration-none" 
  id="cart-icon"
  href="/DAY5/frontend/pages/PlaceOrder.php">
  <i class="fas fa-shopping-cart fa-lg"></i>
  <span id="item-count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger item-count">
    <?php
      if (session_status() === PHP_SESSION_NONE) {
          session_start();
      }
      echo isset($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'], 'quantity')) : 0;
    ?>
  </span>
</a>
        </div>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>
</header>
<main>
<script>
document.addEventListener("DOMContentLoaded", function () {
  const addButtons = document.querySelectorAll('.add-to-cart');

  addButtons.forEach(button => {
    button.addEventListener('click', function (e) {
      e.preventDefault();

      const id = this.getAttribute('data-id');
      const name = this.getAttribute('data-name');
      const price = this.getAttribute('data-price');
      const image = this.getAttribute('data-img');

      fetch('/DAY5/frontend/pages/addToCart.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `id=${id}&name=${encodeURIComponent(name)}&price=${price}&image=${encodeURIComponent(image)}`
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          
          const itemCount = document.getElementById('item-count');
          if (itemCount) {
            itemCount.textContent = data.count;
          }
        } else {
          alert("Lỗi: " + data.message);
        }
      })
      .catch(error => {
        console.error("Lỗi khi thêm giỏ hàng:", error);
      });
    });
  });
});
</script>
