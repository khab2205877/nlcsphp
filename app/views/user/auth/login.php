<?php $this->layout("layouts/default", ["title" => APPNAME]) ?>

<?php $this->start("page_specific_css") ?>
<link href="https://cdn.datatables.net/v/dt/jq-3.7.0/dt-2.0.8/r-3.0.2/sp-2.3.1/datatables.min.css" rel="stylesheet">
<?php $this->stop() ?>

<?php $this->start("page") ?>

<body>
    <main>
        <div class="container d-flex justify-content-center align-items-center">
            <div class="row border rounded-5 p-3 bg-white shadow box-area">
                <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box">
                    <div class="featured-image mb-3">
                        <img src="/images/image_2.png" class="img-fluid">
                    </div>
                    <div class="d-flex justify-content-center align-items-center flex-column left-text">
                        <p class="text-white fs-2" style="font-weight: 600;">Be Verified</p>
                        <small class="text-white text-wrap text-center" style="width: 17rem;">Đăng nhập để trải nghiệm tốt hơn.</small>
                    </div>
                </div>
                <div class="col-md-6 right-box">
                    <div class="row align-items-center">
                        <div class="header-text mb-4">
                            <h2>Xin Chào</h2>
                            <p>Chúng tôi rất vui khi có bạn trở lại.</p>
                        </div>
                        <form action="/login" method="post">
                            <div class="input-group mb-3">
                                <input id="email" type="email" class="form-control form-control-lg bg-light fs-6" <?= isset($errors['email']) ? 'is-invalid' : '' ?>" name="email" value="<?= isset($old['email']) ? $this->e($old['email']) : '' ?>" required autofocus placeholder="Email">
                                <?php if (isset($errors['email'])) : ?>
                                    <span class="invalid-feedback">
                                        <strong><?= $this->e($errors['email']) ?></strong>
                                    </span>
                                <?php endif ?>
                            </div>
                            <div class="input-group mb-1">
                                <input id="password" type="password" class="form-control form-control-lg bg-light fs-6" <?= isset($errors['password']) ? 'is-invalid' : '' ?>" name="password" required placeholder="Mật khẩu">
                                <?php if (isset($errors['password'])) : ?>
                                    <span class="invalid-feedback">
                                        <strong><?= $this->e($errors['password']) ?></strong>
                                    </span>
                                <?php endif ?>
                            </div>
                            <div class="input-group mb-3 d-flex justify-content-between">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="formCheck">
                                    <label for="formCheck" class="form-check-label text-secondary"><small>Ghi nhớ tôi</small></label>
                                </div>
                                <div class="forgot">
                                    <small><a href="#">Quên mật khẩu?</a></small>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <button class="btn btn-lg w-100 fs-5 text-white btn-log">Đăng nhập</button>
                            </div>
                            <div class="row">
                                <small>Bạn chưa có tài khoản?<a href="/register">Đăng ký ngay</a></small>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

<?php $this->stop() ?>

<?php $this->start("page_specific_js") ?>
<script src="https://cdn.datatables.net/v/dt/jq-3.7.0/dt-2.0.8/r-3.0.2/sp-2.3.1/datatables.min.js"></script>
<script>

</script>
<?php $this->stop() ?>