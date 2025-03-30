<?php $this->layout("layouts/default", ["title" => APPNAME]) ?>

<?php $this->start("page_specific_css") ?>
<link href="https://cdn.datatables.net/v/dt/jq-3.7.0/dt-2.0.8/r-3.0.2/sp-2.3.1/datatables.min.css" rel="stylesheet">
<?php $this->stop() ?>

<?php $this->start("page") ?>

<main class="main">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Library</li>
            </ol>
        </nav>
    </div>
    <div class="product-container container">
        <div class="product__detail row">
            <div class="detail__left col-lg-5 col-md-6">
                <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleInterval" data-bs-slide-to="0"
                            class="active">
                            <img src="<?= $this->e($product->image) ?>" alt="<?= $this->e($product->name) ?>" class="img-fluid">
                        </button>
                        <?php foreach ($productImages as $index => $image): ?>
                            <button type="button" data-bs-target="#carouselExampleInterval" data-bs-slide-to="<?= $index + 1 ?>">
                                <img src="<?= $this->e($image['image_path']) ?>" alt="Ảnh sản phẩm" class="img-fluid">
                            </button>
                        <?php endforeach ?>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active" data-bs-interval="2000">
                            <img src="<?= $this->e($product->image) ?>" class="d-block w-100" alt="Ảnh sản phẩm">
                        </div>
                        <?php foreach ($productImages as $image): ?>
                            <div class="carousel-item" data-bs-interval="2000">
                                <img src="<?= $this->e($image['image_path']) ?>" class="d-block w-100" alt="Ảnh sản phẩm">
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
            <div class="detail__right col-lg-7 col-md-6">
                <h1 class="detail__right__header"><?= $this->e($product->name) ?></h1>
                <div class="d-flex product-info">
                    <div class="pro-band">
                        <span>Thương hiệu: </span>
                        <a class="title" href="#"><?= $this->e($brandName) ?></a>
                    </div>
                </div>
                <div class="detail__right__price">
                    <span class="price-now"><?= number_format($discountedPrice, 0, ',', '.') ?>₫</span>
                    <span class="price-compare"><del><?= number_format($product->price, 0, ',', '.') ?>₫</del></span>
                </div>
                <div class="detail__right__size select-option">
                    <p class="detail__right__list-header">size</p>
                    <ul class="detail__right__list">
                        <?php foreach ($productSizes as $size): ?>
                            <li><span><?= $this->e($size['size'] == intval($size['size'])) ? intval($size['size']) : $size['size'] ?></span></li>
                        <?php endforeach ?>
                    </ul>
                </div>
                <div class="detail__right__quantily">
                    <input type="button" value="-" class="btn-decrease">
                    <input type="text" name="product-quantily" value="1" disabled>
                    <input type="button" value="+" class="btn-increase">
                </div>
                <div class="detail__right__action row d-flex">
                    <div class="col-lg-6 col-md-6">
                        <button class="btn btn-cart"><i class="fa-solid fa-cart-shopping"></i>Thêm vào
                            giỏ</button>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <button class="btn btn-buy">Mua ngay</button>
                    </div>
                </div>
                <div class="detail__right__policy__container">
                    <div class="detail__right__policy">
                        <div class="item__policy">
                            <img src="/images/img_policy_product_1.webp" alt="">
                        </div>
                        <div class="item__policy">
                            <img src="/images/img_policy_product_2.webp" alt="">
                        </div>
                        <div class="item__policy">
                            <img src="/images/img_policy_product_3.webp" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product__description">
            <div class="product-description-tab">
                <div class="scroll-nav-tab">
                    <ul class="nav nav-tabs" id="productTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="tab1-tab" data-bs-toggle="tab" href="#tab1"
                                role="tab" aria-controls="tab1" aria-selected="true">
                                Mô tả
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="tab2-tab" data-bs-toggle="tab" href="#tab2" role="tab"
                                aria-controls="tab2" aria-selected="false">
                                Chính sách thanh toán
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="tab3-tab" data-bs-toggle="tab" href="#tab3" role="tab"
                                aria-controls="tab3" aria-selected="false">
                                Chính sách đổi trả
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="accordion" id="productAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse1">
                                Mô tả
                            </button>
                        </h2>
                        <div id="collapse1" class="accordion-collapse collapse show">
                            <div class="accordion-body" data-tab-content="tab1">
                                <p>
                                    <strong><a href="#">Giày Nike</a> <?= $this->e($product->name) ?></strong>
                                </p>
                                <p><?= $this->e($product->description) ?></p>
                                <p>
                                    <strong>Thương hiệu</strong>: <?= $this->e($brandName) ?>
                                </p>
                                <p>
                                    <strong>Chất liệu</strong>: <?= $this->e($product->material) ?>
                                </p>
                                <p>
                                    <strong>Xuất xứ</strong>: <?= $this->e($product->origin) ?>
                                </p>
                                <p>
                                    <strong>Tình trạng</strong>: Hàng Fullbox - New 100%
                                </p>
                                <!-- <div>
                                    <p style="text-align: center;">
                                        <img src="/images/product_banner_1.webp" alt="" width="600"
                                            height="600">
                                    </p>
                                    <p style="text-align: center;">
                                        <img src="/images/product_2.webp" alt="" width="600" height="600">
                                    </p>
                                </div> -->
                                <div>&nbsp;</div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse2">
                                Chính sách thanh toán
                            </button>
                        </h2>
                        <div id="collapse2" class="accordion-collapse collapse">
                            <div class="accordion-body" data-tab-content="tab2">
                                <p><strong>1. Giới thiệu</strong></p>
                                <p>Chào mừng quý khách hàng đến với website của NK Store.</p>
                                <p>
                                    Khi quý khách hàng truy cập vào trang website của chúng tôi có nghĩa là quý
                                    khách đồng ý với các điều khoản này. Trang web có quyền thay đổi, chỉnh sửa,
                                    thêm hoặc lược bỏ bất kỳ phần nào trong Điều khoản mua bán hàng hóa này, vào
                                    bất cứ lúc nào. Các thay đổi có hiệu lực ngay khi được đăng trên trang web
                                    mà không cần thông báo trước. Và khi quý khách tiếp tục sử dụng trang web,
                                    sau khi các thay đổi về Điều khoản này được đăng tải, có nghĩa là quý khách
                                    chấp nhận với những thay đổi đó.
                                </p>
                                <p>
                                    Quý khách hàng vui lòng kiểm tra thường xuyên để cập nhật những thay đổi của
                                    chúng tôi.
                                </p>
                                <p><strong>2. Hướng dẫn sử dụng website</strong></p>
                                <p>
                                    Khi vào web của chúng tôi, khách hàng phải đảm bảo đủ 18 tuổi, hoặc truy cập
                                    dưới sự giám sát của cha mẹ hay người giám hộ hợp pháp. Khách hàng đảm bảo
                                    có đầy đủ hành vi dân sự để thực hiện các giao dịch mua bán hàng hóa theo
                                    quy định hiện hành của pháp luật Việt Nam.
                                </p>
                                <p>
                                    Trong suốt quá trình đăng ký, quý khách đồng ý nhận email quảng cáo từ
                                    website. Nếu không muốn tiếp tục nhận mail, quý khách có thể từ chối bằng
                                    cách nhấp vào đường link ở dưới cùng trong mọi email quảng cáo.
                                </p>
                                <p><strong>3. Thanh toán an toàn và tiện lợi</strong></p>
                                <p>
                                    Người mua có thể tham khảo các phương thức thanh toán sau đây và lựa chọn áp
                                    dụng phương thức phù hợp:
                                </p>
                                <p class="d-flex flex-column">
                                    <span>
                                        <strong>Cách 1</strong>: Thanh toán trực tiếp (người mua nhận hàng tại
                                        địa chỉ cửa hàng)
                                    </span>
                                    <span>
                                        <strong>Cách 2</strong>: Thanh toán sau (COD – giao hàng và thu tiền tận
                                        nơi)
                                    </span>
                                    <span>
                                        <strong>Cách 3</strong>: Thanh toán online qua chuyển khoản
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse3">
                                Chính sách đổi trả
                            </button>
                        </h2>
                        <div id="collapse3" class="accordion-collapse collapse">
                            <div class="accordion-body" data-tab-content="tab3">
                                <p><strong>NK Store luôn trân trọng sự tín nhiệm của quý khách giành cho chúng
                                        tôi. Chính vì vậy, chúng tôi luôn cố gắng để mang đến quý khách hàng
                                        những sản phẩm chất lượng cao và tiết kiệm chi phí.</strong></p>
                                <p>Thay cho cam kết về chất lượng sản phẩm, NK Store thực hiện chính sách đổi
                                    trả hàng hóa. Theo đó, tất cả các sản phẩm được mua tại NK Store đều có
                                    thể đổi size và mẫu trong vòng 07 ngày sau khi nhận hàng.</p>
                                <p> Để được thực hiện đổi hàng hoá, Quý khách cần giữ lại Hóa đơn mua hàng tại
                                    NK Store. Sản phẩm được đổi là những sản phẩm đáp ứng được những điều
                                    kiện trong Chính sách đổi trả hàng hóa.</p>
                                <p><strong>NK Store thực hiện đổi hàng/trả lại tiền cho Quý khách, nhưng
                                        không hoàn lại phí vận chuyển hoặc lệ phí giao hàng, trừ những trường
                                        hợp sau:</strong></p>
                                <ul>
                                    <li>Không đúng chủng loại, mẫu mã như quý khách đặt hàng.</li>
                                    <li>Tình trạng bên ngoài bị ảnh hưởng như bong tróc, bể vỡ xảy ra trong quá
                                        trình vận chuyển,…</li>
                                    <li>Không đạt chất lượng như: phát hiện hàng fake, hàng kém chất lượng,
                                        không phải hàng chính hãng</li>
                                </ul>
                                <p>
                                    Quý khách vui lòng kiểm tra hàng hóa và ký nhận tình trạng với nhân viên
                                    giao hàng ngay khi nhận được hàng. Khi phát hiện một trong các trường hợp
                                    trên, quý khách có thể trao đổi trực tiếp với nhân viên giao hàng hoặc phản
                                    hồi cho chúng tôi trong vòng 24h theo số Hotline : 0353.168.108
                                </p>
                                <p>
                                    <strong>NK Store sẽ không chấp nhận đổi/trả hàng khi:</strong>
                                </p>
                                <ul>
                                    <li>Hàng hoá là hàng order</li>
                                    <li>Thời điểm thông báo đổi trả quá 07 ngày kể từ khi Quý khách nhận hàng
                                    </li>
                                    <li>Quý khách tự làm ảnh hưởng tình trạng bên ngoài như rách bao bì, bong
                                        tróc, bể vỡ, bị bẩn, hư hại (không còn như
                                        nguyên vẹn ban đầu),...</li>
                                    <li>Quý khách vận hành không đúng chỉ dẫn gây hỏng hóc hàng hóa.</li>
                                    <li>Quý khách đã kiểm tra và ký nhận tình trạng hàng hóa nhưng không có phản
                                        hồi trong vòng 24h kể từ lúc ký nhận
                                        hàng.</li>
                                    <li>Không còn size/ mẫu mà khách hàng muốn đổi.</li>
                                    <li>Không đổi từ hàng hóa có sẵn sang hàng phải order.</li>
                                    <li>Sản phẩm đã cắt tag/mác.</li>
                                    <li>Sản phẩm đã qua sử dụng.</li>
                                </ul>
                                <p>
                                    <strong>NK Store thực hiện đổi trả theo quy trình sau:</strong>
                                </p>
                                <ul>
                                    <li><strong>Bước 1:</strong>&nbsp;Quý khách liên hệ trực tiếp với NK Store
                                        qua số Hotline : 084. 850. 6666 để thông báo tình trạng hàng hoá cần
                                        đổi/trả trong vòng 07 ngày kể từ khi nhận hàng.</li>
                                    <li><strong>Bước 2:</strong>&nbsp;Nhân viên NK Store sẽ tiếp nhận phản hồi
                                        và hướng dẫn bạn cung cấp thông tin đơn hàng để chúng tôi truy soát.
                                    </li>
                                    <li><strong>Bước 3:&nbsp;</strong>Quý khách ship hàng cần đổi/ trả kèm hoá
                                        đơn lại về địa chỉ của NK Store để chúng tôi kiểm tra.&nbsp;</li>
                                    <li><strong>Bước 4:&nbsp;</strong>Sau khi kiểm tra hàng và xác nhận đủ sản
                                        phẩm đủ điều kiện đổi/trả, NK Store sẽ liên hệ lại xác nhận với bạn và
                                        gửi hàng về cho bạn theo địa chỉ bạn cung cấp.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-content d-none d-md-block" id="productTabContent">
                    <div class="tab-pane fade show active tab-product-pane" id="tab1"></div>
                    <div class="tab-pane fade tab-product-pane" id="tab2"></div>
                    <div class="tab-pane fade tab-product-pane" id="tab3"></div>
                </div>
            </div>
        </div>
    </div>
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