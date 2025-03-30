<?php $this->layout("layouts/default", ["title" => APPNAME]) ?>

<?php $this->start("page_specific_css") ?>
<link href="https://cdn.datatables.net/v/dt/jq-3.7.0/dt-2.0.8/r-3.0.2/sp-2.3.1/datatables.min.css" rel="stylesheet">
<?php $this->stop() ?>

<?php $this->start("page") ?>

<main class="main">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb ol-collection">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Library</li>
            </ol>
        </nav>
    </div>
    <section class="collection-page">
        <div class="collection-body">
            <div class="container">
                <div class="row d-flex flex-wrap">
                    <div class="col-lg-3 col-md-12 col-12 sidebar-collection">
                        <div class="wrap-filter">
                            <button class="close-filter">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                            <div class="box-sidebar">
                                <div class="shop-sidebar sidebar-webget">
                                    <h4 class="title minus">
                                        Danh mục sản phẩm
                                    </h4>
                                    <div class="group-filter" id="categories" style="display: block;">
                                        <ul class="scrollbar">
                                            <li class="item active">
                                                <input type="" name="" id="">
                                                <a href="/product-list" class="cust-checkbox-label">
                                                    Tất cả
                                                    <span class="cust-check"></span>
                                                </a>
                                            </li>
                                            <?php foreach ($brands as $brand): ?>
                                                <li class="item">
                                                    <a href="/product-list/<?= $this->e($brand['name']) ?>" class="cust-checkbox-label">
                                                        <?= $this->e($brand['name']) ?>
                                                        <span class="cust-check"></span>
                                                    </a>
                                                </li>
                                            <?php endforeach ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="shop-sidebar sidebar-webget">
                                    <h4 class="title minus">
                                        Lọc giá
                                    </h4>
                                    <div class="group-filter" style="display: block;">
                                        <div class="layered-content bl-filter filter-price">
                                            <ul class="check-box-list scrollbar">
                                                <li>
                                                    <label for="">
                                                        <input type="checkbox" name="" id="">
                                                        Dưới 500,000₫
                                                        <span class="cust-check"></span>
                                                    </label>
                                                </li>
                                                <li>
                                                    <label for="">
                                                        <input type="checkbox" name="" id="">
                                                        Dưới 500,000₫
                                                        <span class="cust-check"></span>
                                                    </label>
                                                </li>
                                                <li>
                                                    <label for="">
                                                        <input type="checkbox" name="" id="">
                                                        Dưới 500,000₫
                                                        <span class="cust-check"></span>
                                                    </label>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="shop-sidebar sidebar-webget">
                                    <h4 class="title minus">
                                        Kích thước
                                    </h4>
                                    <div class="group-filter" style="display: block;">
                                        <div class="layered-content bl-filter filter-size s-filter">
                                            <ul class="check-box-list scrollbar">
                                                <?php foreach ($sizes as $size): ?>
                                                    <?php $formattedSize = (fmod(floatval($size), 1) == 0) ? intval($size) : $size; ?>
                                                    <li>
                                                        <label>
                                                            <input type="checkbox" name="sizes[]" id="size_<?= htmlspecialchars($size) ?>" value="<?= htmlspecialchars($size) ?>">
                                                            <?= htmlspecialchars($formattedSize) ?>
                                                            <span class="cust-check"></span>
                                                        </label>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-12 col-12 main-collection">
                        <div class="banner-collection">
                            <img src="/images/banner_list_product.webp" alt="">
                        </div>
                        <div class="collection-top-bar">
                            <div class="collection-title">
                                <h1>Giày Nike</h1>
                            </div>
                            <div class="product-short">
                                <button class="btn-filter-mob">
                                    Bộ lọc
                                </button>
                                <div class="wrap-box-sort">
                                    <!-- <label for="SortBy">Sắp xếp:</label>
                                    <select class="sort-by custom-dropdown__select">
                                        <option value="">Sản phẩm nổi bật</option>
                                        <option value="">Giá: Tăng dần</option>
                                        <option value="">Giá: Giảm dần</option>
                                    </select> -->
                                </div>
                            </div>
                        </div>
                        <div class="content-product-list row d-flex flex-wrap">
                            <?php foreach ($products as $product): ?>
                                <?php
                                $original_price = $product->price;
                                $discounted_price = $original_price * (1 - $product->discount_percent / 100);
                                ?>
                                <div class="d-flex flex-column col-md-3 col-sm-4 col-6 product-block">
                                    <div class="card">
                                        <div class="card-image">
                                            <a href="/products/<?= $this->e($product->id) ?>">
                                                <img src="<?= $this->e($product->image) ?>" class="card-img-top" alt="...">
                                                <img src="/images/product_3.webp" alt="" class="rear-img">
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <h3 class="card-title">
                                                <a href="/products/<?= $this->e($product->id) ?>">
                                                    <?= $this->e($product->name) ?>
                                                </a>
                                            </h3>
                                            <p class="card-text">
                                                <span><?= number_format($discounted_price, 0, ',', '.') ?>₫</span>
                                                <del><?= number_format($original_price, 0, ',', '.') ?>₫</del>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>

                        </div>
                    </div>
                </div>
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

</script>
<?php $this->stop() ?>