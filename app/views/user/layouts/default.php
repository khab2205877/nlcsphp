<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title><?= $this->e($title) ?></title>

  <!-- Styles -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
  <link href="/css/style.css" rel="stylesheet">

  <?= $this->section("page_specific_css") ?>
</head>

<body>
  <header id="header" class="header">
    <nav class="navbar navbar-expand-lg fixed-top">
      <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
          data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="home.html"><img src="/images/logo1.png" height="75px" width="75px"></a>
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar"
          aria-labelledby="offcanvasNavbarLabel">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasNavbarLabel"><img src="/images/logo.png" height="75px"
                width="75px"></h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
              aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">
              <li class="nav-item">
                <a class="nav-link mx-lg-2 active" aria-current="page" href="home.html">Trang Chủ</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  Giày Nike
                </a>
                <ul class="dropdown-menu border-0">
                  <li><a class="dropdown-item" href="#">Giày Nike Air Force 1</a></li>
                  <li><a class="dropdown-item" href="#">Giày Nike Air Jordan 1</a></li>
                </ul>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  Giày Adidas
                </a>
                <ul class="dropdown-menu border-0">
                  <li><a class="dropdown-item" href="#">Giày Adidas Stansmith</a></li>
                  <li><a class="dropdown-item" href="#">Giày Adidas Superstar</a></li>
                  <li><a class="dropdown-item" href="#">Giày Forum</a></li>
                </ul>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  Giày MLB
                </a>
                <ul class="dropdown-menu border-0">
                  <li><a class="dropdown-item" href="#">Giày MLB Mule</a></li>
                  <li><a class="dropdown-item" href="#">Giày MLB Chunky</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
        <div class="loginName-searchBox">
          <div class="searchBox">
            <div class="searchToggle">
              <i class="fa-solid fa-magnifying-glass search"></i>
              <i class="fa-solid fa-x cancle"></i>
            </div>
            <div class="search-field">
              <input type="text" placeholder="Search...">
              <i class="fa-solid fa-magnifying-glass"></i>
            </div>
          </div>
          <?php if (!AUTHGUARD()->isUserLoggedIn()) : ?>
            <div class="loginName">
              <a href="/login" class="login-button">Login</a>
            </div>
          <?php else : ?>
            <div class="nav-item dropend">
              <div class="loginName" data-bs-toggle="dropdown">
                <a class="login-button" href="#"><?= $this->e(AUTHGUARD()->userName()) ?></a>
              </div>
              <div class="dropdown-menu" style="min-width: 100px; width: 100%; margin-left: 5px">
                <a class="dropdown-item" href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  Logout
                </a>
                <form id="logout-form" class="d-none" action="/logout" method="POST">
                </form>
              </div>
            </div>
          <?php endif ?>
        </div>
      </div>
    </nav>
  </header>

  <?= $this->section("page") ?>

  <footer class="footer">
    <div class="container">
      <div class="d-flex row pt-4">
        <div class="d-flex flex-column col-lg-3 col-md-6 col-sm-12">
          <h3>Giới Thiệu</h3>
          <div class="container m-0 p-0">
            <p>NK Store chuyên cung cấp, order các loại giày authentic từ các hãng Nike, Adidas, Puma,
              MLB...</p>
            <p>Địa chỉ: 180 Cao Lỗ, Phường 4, Quận 8, TP.Cần thơ</p>
            <p>Điện thoại: 0363476805</p>
            <p>Email: contact@gmail.com</p>
          </div>
        </div>
        <div class="d-flex flex-column col-lg-3 col-md-6 col-sm-12">
          <h3>Thông Tin</h3>
          <ul class="list">
            <li><a href="#">Về Chúng Tôi</a></li>
            <li><a href="#">Chính Sách Bảo Mật</a></li>
            <li><a href="#">Chính Sách Đổi Trả</a></li>
            <li><a href="#">Chính Sách Vận Chuyển</a></li>
          </ul>
        </div>
        <div class="d-flex flex-column col-lg-3 col-md-6 col-sm-12">
          <h3>Chăm Sóc Khách Hàng</h3>
          <ul class="list">
            <li><a href="#">Hướng Dẫn Mua Hàng</a></li>
            <li><a href="#">Hướng Dẫn Thanh Toán</a></li>
            <li><a href="#">Hướng Dẫn Đổi Trả</a></li>
            <li><a href="#">Hướng Dẫn Vận Chuyển</a></li>
          </ul>
        </div>
        <div class="d-flex flex-column col-lg-3 col-md-6 col-sm-12">
          <h3>Theo Dõi Chúng Tôi</h3>
          <div class="social-links">
            <a href="https://www.facebook.com/" class="social-icon facebook">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="https://www.instagram.com/" class="social-icon instagram">
              <i class="fab fa-instagram"></i>
            </a>
            <a href="https://www.tiktok.com/" class="social-icon tiktok">
              <i class="fab fa-tiktok"></i>
            </a>
            <a href="https://twitter.com/" class="social-icon twitter">
              <i class="fab fa-twitter"></i>
            </a>
            <a href="https://www.youtube.com/" class="social-icon youtube">
              <i class="fab fa-youtube"></i>
            </a>
          </div>

        </div>
      </div>
    </div>
    <div class="bottom-bar d-flex justify-content-center">
      <p>© Bản quyền thuộc về NK Store</p>
    </div>
  </footer>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="/js/script.js"></script>
  <?= $this->section("page_specific_js") ?>
</body>

</html>