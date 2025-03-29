<?php $this->layout("layouts/default", ["title" => APPNAME]) ?>

<?php $this->start("page_specific_css") ?>
<link href="https://cdn.datatables.net/v/dt/jq-3.7.0/dt-2.0.8/r-3.0.2/sp-2.3.1/datatables.min.css" rel="stylesheet">
<?php $this->stop() ?>

<?php $this->start("page") ?>

<main>
    <section class="banner">
        <div class="container">
            <div id="carouselExampleDark" class="carousel carousel-dark slide">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="1000">
                        <a href="product1.html"><img src="/images/banner_1.webp" class="d-block w-100"
                                alt="..."></a>
                    </div>
                    <div class="carousel-item" data-bs-interval="200">
                        <a href="product2.html"><img src="/images/banner_2.webp" class="d-block w-100"
                                alt="..."></a>
                    </div>
                    <div class="carousel-item">
                        <a href="product3.html"><img src="/images/banner_3.webp" class="d-block w-100"
                                alt="..."></a>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>

    <section class="section-home-product">
        <div class="container">
            <div class="product-header">
                <h2 class="title-header">
                    <span>Giày Sneaker</span>
                </h2>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <?php foreach ($brands as $index => $brand): ?>
                        <li class="nav-item" role="presentation">
                            <a href="#tab-<?= $this->e($brand['id']) ?>"
                                class="nav-link-product <?= $index === 0 ? 'active' : '' ?>"
                                id="tab-btn-<?= $this->e($brand['id']) ?>"
                                data-bs-toggle="tab"
                                role="tab"
                                aria-controls="tab-<?= $this->e($brand['id']) ?>"
                                aria-selected="<?= $index === 0 ? 'true' : 'false' ?>">
                                <?= $this->e($brand['name']) ?>
                            </a>
                        </li>
                    <?php endforeach ?>
                </ul>
            </div>
            <div class="tab-content" id="myTabContent">
                <?php foreach ($brands as $index => $brand): ?>
                    <div class="tab-pane fade <?= $index === 0 ? 'show active' : '' ?>"
                        id="tab-<?= $this->e($brand['id']) ?>"
                        role="tabpanel"
                        aria-labelledby="tab-btn-<?= $this->e($brand['id']) ?>"
                        tabindex="0">
                        <div class="row d-flex flex-wrap">
                            <div class="d-flex flex-column col-lg-2 col-md-3 col-sm-4 col-6 product-block">
                                <div class="card">
                                    <div class="card-image">
                                        <a href="/products">
                                            <img src="/images/product_1.webp" class="card-img-top" alt="...">
                                            <img src="/images/product_3.webp" alt="" class="rear-img">
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <h3 class="card-title">
                                            <a href="/products">Card title</a>
                                        </h3>
                                        <p class="card-text"><span>9,999,999₫</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </section>

    <section class="banner">
        <div class="container">
            <div class="item">
                <a href="">
                    <img src="/images/banner_4.webp" alt="" class="d-block w-100">
                </a>
            </div>
        </div>
    </section>

    <section class="news">
        <div class="container">
            <div class="news-header">
                <h2 class="title-header">
                    <span>Tin Tức</span>
                </h2>
            </div>
            <div class="slide-container swiper mySwiper">
                <div class="card-wrapper swiper-wrapper">
                    <div class="card-news swiper-slide">
                        <div class="image-box">
                            <a href="#">
                                <img src="/images/news_1.webp" alt="">
                            </a>
                        </div>
                        <div class="content-box">
                            <h3 class="blog-title">
                                <a href="#">Mùa mưa bảo quản giày sao cho chuẩn</a>
                            </h3>
                            <p class="blog-desc">
                                Nắng mưa là việc của trời còn việc của các sneakerhead vẫn là diện những đôi sneaker theo ý thích của mình....
                            </p>
                            <div class="card-footer">
                                <div class="blog-publish">
                                    <span class="date-time"><i
                                            class="fa-solid fa-calendar-days"></i>09/09/2025</span>
                                </div>
                                <div class="btn-view">
                                    <a href="#"><span>Xem thêm »</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-news swiper-slide">
                        <div class="image-box">
                            <a href="#">
                                <img src="/images/news_2.webp" alt="">
                            </a>
                        </div>
                        <div class="content-box">
                            <h3 class="blog-title">
                                <a href="#">Tips mix đồ ăn dơ cùng Sneaker cổ cao cực chất cho bạn</a>
                            </h3>
                            <p class="blog-desc">
                                Sneaker cổ cao là một trong những item không thể thiếu trong tủ giày của bất cứ sneakerhead nào. Những đôi giày cổ ca...
                            </p>
                            <div class="card-footer">
                                <div class="blog-publish">
                                    <span class="date-time"><i
                                            class="fa-solid fa-calendar-days"></i>09/09/2025</span>
                                </div>
                                <div class="btn-view">
                                    <a href="#"><span>Xem thêm »</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-news swiper-slide">
                        <div class="image-box">
                            <a href="#">
                                <img src="/images/news_3.webp" alt="">
                            </a>
                        </div>
                        <div class="content-box">
                            <h3 class="blog-title">
                                <a href="#">Những lý do bạn nên đưa giày đi Spa</a>
                            </h3>
                            <p class="blog-desc">
                                Tại Việt Nam việc đưa giày đi spa không còn là việc quá xa lạ. Spa giày được mở ra như một sự “cứu cánh” cho những me...
                            </p>
                            <div class="card-footer">
                                <div class="blog-publish">
                                    <span class="date-time"><i
                                            class="fa-solid fa-calendar-days"></i>09/09/2025</span>
                                </div>
                                <div class="btn-view">
                                    <a href="#"><span>Xem thêm »</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-news swiper-slide">
                        <div class="image-box">
                            <a href="#">
                                <img src="/images/news_4.webp" alt="">
                            </a>
                        </div>
                        <div class="content-box">
                            <h3 class="blog-title">
                                <a href="#">Cách đo chân để chọn size giày cho chuẩn</a>
                            </h3>
                            <p class="blog-desc">
                                Có bao giờ bạn băn khoăn về việc mua giày online nhưng không chắc chắn đôi chân mình sẽ vừa với size giày nào không? ...
                            </p>
                            <div class="card-footer">
                                <div class="blog-publish">
                                    <span class="date-time"><i
                                            class="fa-solid fa-calendar-days"></i>09/09/2025</span>
                                </div>
                                <div class="btn-view">
                                    <a href="#"><span>Xem thêm »</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-news swiper-slide">
                        <div class="image-box">
                            <a href="#">
                                <img src="/images/news_5.jpg" alt="">
                            </a>
                        </div>
                        <div class="content-box">
                            <h3 class="blog-title">
                                <a href="#">Những tips làm sạch giày trắng cực hiệu quả cho tín đồ sneaker “all
                                    white”</a>
                            </h3>
                            <p class="blog-desc">
                                Sneaker trắng là item không thể thiếu trong tủ giày của bất kỳ tín đồ thời trang
                                nào. Sắc trắng đơn giản vừa thanh lị...
                            </p>
                            <div class="card-footer">
                                <div class="blog-publish">
                                    <span class="date-time"><i
                                            class="fa-solid fa-calendar-days"></i>09/09/2025</span>
                                </div>
                                <div class="btn-view">
                                    <a href="#"><span>Xem thêm »</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-button-next swiper-btn"></div>
                <div class="swiper-button-prev swiper-btn"></div>
            </div>
        </div>
    </section>
</main>

<div class="prefooter-customer">
    <div class="container">
        <div class="bg-prefooter">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="d-flex flex-column col-lg-3 col-md-4 col-sm-4 d-flex align-items-center justify-content-center">
                    <p class="title-regis">Đăng kí nhận tin</p>
                </div>
                <div class="d-flex flex-column col-lg-9 col-md-8 col-sm-8">
                    <div class="form-ft-wanda">
                        <form action="" class="contact-form">
                            <div class="form-group mb-0">
                                <input type="email" placeholder="Email">
                            </div>
                            <button class="btn" type="submit">
                                <i class="fa-solid fa-paper-plane"></i>
                                Đăng ký
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->stop() ?>

<?php $this->start("page_specific_js") ?>
<script src="https://cdn.datatables.net/v/dt/jq-3.7.0/dt-2.0.8/r-3.0.2/sp-2.3.1/datatables.min.js"></script>
<script>
    const tabs = document.querySelectorAll(".nav-link-product");

    tabs.forEach(tab => {
        tab.addEventListener("click", function(event) {
            event.preventDefault();

            // Xóa class active khỏi tất cả tab
            tabs.forEach(t => t.classList.remove("active"));

            // Ẩn tất cả nội dung tab
            document.querySelectorAll(".tab-pane").forEach(pane => {
                pane.classList.remove("show", "active");
            });

            // Thêm class active vào tab được click
            this.classList.add("active");

            // Hiển thị tab content tương ứng
            const targetPane = document.querySelector(this.getAttribute("href"));
            if (targetPane) {
                targetPane.classList.add("show", "active");
            }
        });
    });

    // Kích hoạt tab đầu tiên nếu không có tab nào được chọn
    if (!document.querySelector(".nav-link-product.active")) {
        tabs[0].classList.add("active");
        document.querySelector(".tab-pane").classList.add("show", "active");
    }
</script>
<?php $this->stop() ?>