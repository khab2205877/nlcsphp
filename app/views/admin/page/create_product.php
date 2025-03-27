<?php $this->layout("layouts/default", ["title" => APPNAME]) ?>
<?php $this->start("page") ?>
<div class="container-fluid py-5">
    <div class="card card-custom">
        <div class="card-header bg-white border-0 py-4">
            <h2 class="card-title text-center mb-0 text-danger">
                <i class="bi bi-phone me-2"></i>Thêm Điện Thoại Mới
            </h2>
        </div>

        <div class="card-body pt-0">
            <form action="/admin/store" method="POST" enctype="multipart/form-data">
                <!-- Main Content -->
                <div class="row g-3">
                    <!-- Left Column -->
                    <div class="col-lg-6">
                        <!-- Product Name -->
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control form-control-custom <?= isset($errors['name']) ? ' is-invalid' : '' ?>" name="name"
                                        placeholder="Tên điện thoại" value="<?= isset($old['name']) ? $this->e($old['name']) : '' ?>" required>
                                    <label>Tên Điện Thoại</label>
                                    <?php if (isset($errors['name'])) : ?>
                                        <span class="invalid-feedback">
                                            <strong><?= $this->e($errors['name']) ?></strong>
                                        </span>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>

                        <!-- Brand  -->
                        <div class="row mt-3 g-3">
                            <div class="col mt-0">
                                <div class="form-floating">
                                    <select class="form-select form-control-custom <?= isset($errors['brand_id']) ? ' is-invalid' : '' ?>" name="brand_id">
                                        <?php foreach ($brands as $brand): ?>
                                            <option value="<?= $brand['id'] ?>" <?= isset($old['brand_id']) && $old['brand_id'] == $brand['id'] ? 'selected' : '' ?>><?= $brand['name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <label>Thương Hiệu</label>
                                    <?php if (isset($errors['brand_id'])) : ?>
                                        <span class="invalid-feedback">
                                            <strong><?= $this->e($errors['brand_id']) ?></strong>
                                        </span>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>

                        <!-- Price & Discount -->
                        <div class="row mt-3 g-3">
                            <div class="col-md-6 mt-0">
                                <div class="form-floating">
                                    <input type="number" class="form-control form-control-custom <?= isset($errors['price']) ? ' is-invalid' : '' ?>" name="price"
                                        value="<?= isset($old['price']) ? $this->e($old['price']) : '' ?>" placeholder="Giá" required>
                                    <label>Giá (VNĐ)</label>
                                    <?php if (isset($errors['price'])) : ?>
                                        <span class="invalid-feedback">
                                            <strong><?= $this->e($errors['price']) ?></strong>
                                        </span>
                                    <?php endif ?>
                                </div>
                            </div>
                            <div class="col-md-6 mt-0">
                                <div class="form-floating">
                                    <input type="number" class="form-control form-control-custom <?= isset($errors['discount_percent']) ? ' is-invalid' : '' ?>"
                                        value="<?= isset($old['discount_percent']) ? $this->e($old['discount_percent']) : '' ?>" name="discount_percent" placeholder="Giảm giá" min="0" max="100">
                                    <label>Giảm Giá (%)</label>
                                    <?php if (isset($errors['discount_percent'])) : ?>
                                        <span class="invalid-feedback">
                                            <strong><?= $this->e($errors['discount_percent']) ?></strong>
                                        </span>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                        <!-- img -->
                        <div class="row g-3 mt-0">
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="file" class="form-control <?= isset($errors['image']) ? ' is-invalid' : '' ?>" name="image" id="imageInput" accept="image/*"
                                        onchange="previewImage(event)">
                                    <label>Hình Ảnh</label>
                                </div>
                                <img id="preview" class="preview-image mt-3" style="display: none; border: 2px dashed #dee2e6; border-radius: 0.5rem; max-width: 100px;">
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="col-lg-6">
                        <div class="row g-3">
                            <!-- Product Image -->
                            <div class="col-12">
                                <div class="form-floating">
                                    <input multiple type="file" class="form-control <?= isset($errors['image']) ? ' is-invalid' : '' ?>"
                                        name="img_product[]" id="imageInput" accept="image/*"
                                        onchange="previewImageProduct(event)">
                                    <label>Hình Ảnh</label>
                                </div>
                                <div id="previewContainer" class=""></div>
                            </div>

                            <!-- Material & Origin -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control form-control-custom <?= isset($errors['color']) ? ' is-invalid' : '' ?>" name="color"
                                        value="<?= isset($old['color']) ? $this->e($old['color']) : '' ?>" placeholder="Chất liệu">
                                    <label>Chất liệu</label>
                                    <?php if (isset($errors['color'])) : ?>
                                        <span class="invalid-feedback">
                                            <strong><?= $this->e($errors['color']) ?></strong>
                                        </span>
                                    <?php endif ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control form-control-custom <?= isset($errors['origin']) ? ' is-invalid' : '' ?>" name="origin"
                                        value="<?= isset($old['origin']) ? $this->e($old['origin']) : '' ?>" placeholder="Xuất xứ" required>
                                    <label>Xuất Xứ</label>
                                    <?php if (isset($errors['origin'])) : ?>
                                        <span class="invalid-feedback">
                                            <strong><?= $this->e($errors['origin']) ?></strong>
                                        </span>
                                    <?php endif ?>
                                </div>
                            </div>
                            <!-- Description -->
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea type="text" class="form-control form-control-custom <?= isset($errors['processor']) ? ' is-invalid' : '' ?>"  name="processor"
                                        value="<?= isset($old['processor']) ? $this->e($old['processor']) : '' ?>" placeholder="Mô tả sản phẩm" style="height: 130px"></textarea>
                                    <label>Mô tả sản phẩm</label>
                                    <?php if (isset($errors['processor'])) : ?>
                                        <span class="invalid-feedback">
                                            <strong><?= $this->e($errors['processor']) ?></strong>
                                        </span>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Control Buttons -->
                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-danger btn-lg px-5 me-3" name="submit">
                            <i class="bi bi-save2 me-2"></i>Lưu lại
                        </button>
                        <a href="/admin/products" class="btn btn-outline-secondary btn-lg px-5">
                            <i class="bi bi-arrow-left me-2"></i>Quay lại
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $this->stop() ?>
<?php $this->start("page_specific_js") ?>
<script>
    function previewImage(event) {
        const preview = document.getElementById('preview');
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = e => {
                preview.style.display = 'block';
                preview.src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    }

    function previewImageProduct(event) {
    const imageInput = event.target;
    const previewContainer = document.getElementById("previewContainer");

    // Xóa nội dung cũ trước khi hiển thị ảnh mới
    previewContainer.innerHTML = "";

    // Kiểm tra nếu có ảnh được chọn
    if (imageInput.files.length > 0) {
        for (let file of imageInput.files) {
            const reader = new FileReader();

            reader.onload = function (e) {
                // Tạo phần tử ảnh
                const imgElement = document.createElement("img");
                imgElement.src = e.target.result;
                imgElement.classList.add("preview-image", "mt-2");
                imgElement.style.border = "2px dashed #dee2e6";
                imgElement.style.borderRadius = "0.5rem";
                imgElement.style.maxWidth = "100px";
                imgElement.style.marginRight = "10px";

                // Thêm ảnh vào container
                previewContainer.appendChild(imgElement);
            };

            // Đọc file dưới dạng URL
            reader.readAsDataURL(file);
        }
    }
}

</script>
<?php $this->stop() ?>