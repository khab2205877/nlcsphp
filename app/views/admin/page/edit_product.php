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
            <form action="<?= '/admin/products/update/' . $this->e($data['id']) ?>" method="POST" enctype="multipart/form-data">
                <!-- Main Content -->
                <div class="row g-3">
                    <!-- Left Column -->
                    <div class="col-lg-6">
                        <!-- Product Name -->
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control form-control-custom <?= isset($errors['name']) ? ' is-invalid' : '' ?>" name="name"
                                        placeholder="Tên điện thoại" value="<?= isset($data['name']) ? $this->e($data['name']) : '' ?>" required>
                                    <label>Tên Sản Phẩm</label>
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
                                            <option value="<?= $brand['id'] ?>" <?= isset($data['brand_id']) && $data['brand_id'] == $brand['id'] ? 'selected' : '' ?>><?= $brand['name'] ?></option>
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
                                        value="<?= isset($data['price']) ? $this->e($data['price']) : '' ?>" placeholder="Giá" required>
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
                                        value="<?= isset($data['discount_percent']) ? $this->e($data['discount_percent']) : '' ?>" name="discount_percent" placeholder="Giảm giá" min="0" max="100">
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
                                    <input type="hidden" name="existing_image" value="<?= $this->e($data['image']) ?>">
                                </div>
                                <img id="preview" class="preview-image mt-3" style="display: none; border: 2px dashed #dee2e6; border-radius: 0.5rem; max-width: 100px;">
                                <?php if (isset($data['image'])) : ?>
                                    <div class="mt-3">
                                        <label>Hình Ảnh Hiện Tại</label>
                                    </div>
                                    <div class="mt-3">
                                        <img src="<?= $this->e($data['image']) ?>" class="img-fluid" style="border: 2px dashed #dee2e6; border-radius: 0.5rem; max-width: 100px;">
                                    </div>
                                <?php endif; ?>
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
                                        name="images[]" id="imageInput" accept="image/*"
                                        onchange="previewImageProduct(event)">
                                    <label>Hình Ảnh</label>
                                </div>
                                <div id="previewContainer" class=""></div>
                                <div class="mt-3">
                                    <?php foreach ($product_images as $image): ?>
                                        <img src="<?= $this->e($image['image_path']) ?>" class="img-fluid" style="border: 2px dashed #dee2e6; border-radius: 0.5rem; max-width: 100px;">
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <!-- Material & Origin -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control form-control-custom <?= isset($errors['material']) ? ' is-invalid' : '' ?>" name="material"
                                        value="<?= isset($data['material']) ? $this->e($data['material']) : '' ?>" placeholder="Chất liệu">
                                    <label>Chất liệu</label>
                                    <?php if (isset($errors['material'])) : ?>
                                        <span class="invalid-feedback">
                                            <strong><?= $this->e($errors['material']) ?></strong>
                                        </span>
                                    <?php endif ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control form-control-custom <?= isset($errors['origin']) ? ' is-invalid' : '' ?>" name="origin"
                                        value="<?= isset($data['origin']) ? $this->e($data['origin']) : '' ?>" placeholder="Xuất xứ" required>
                                    <label>Xuất Xứ</label>
                                    <?php if (isset($errors['origin'])) : ?>
                                        <span class="invalid-feedback">
                                            <strong><?= $this->e($errors['origin']) ?></strong>
                                        </span>
                                    <?php endif ?>
                                </div>
                            </div>
                            <!-- size -->
                            <div class="col-12">
                                <div class="form-floating">
                                    <div id="numbersContainer" style="display: flex; flex-wrap: wrap;">
                                        <?php if (!empty($product_sizes)): ?>
                                            <?php foreach ($product_sizes as $index => $size): ?>
                                                <div class="size-input-wrapper mb-2 me-2" style="display: flex; align-items: center;">
                                                    <input type="number" step="any" class="form-control form-control-custom" name="sizes[]"
                                                        value="<?= $this->e($size['size']) ?>" placeholder="Nhập size" style="max-width: 150px;" min="1">
                                                    <button type="button" class="btn btn-danger btn-sm ms-2" onclick="removeNumberField(this)">Xóa</button>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <div class="size-input-wrapper mb-2 me-2" style="display: flex; align-items: center;">
                                                <input type="number" step="any" class="form-control form-control-custom" name="sizes[]"
                                                    placeholder="Nhập size" style="max-width: 150px;" min="1">
                                                <button type="button" class="btn btn-danger btn-sm ms-2" onclick="removeNumberField(this)">Xóa</button>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <button type="button" class="btn btn-info mt-2" onclick="addNumberField()">Thêm size</button>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control form-control-custom <?= isset($errors['description']) ? ' is-invalid' : '' ?>"
                                        name="description"
                                        placeholder="Mô tả sản phẩm"
                                        style="height: 130px"><?= isset($data['description']) ? $this->e($data['description']) : '' ?></textarea>
                                    <label>Mô tả sản phẩm</label>
                                    <?php if (isset($errors['description'])) : ?>
                                        <span class="invalid-feedback">
                                            <strong><?= $this->e($errors['description']) ?></strong>
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
        previewContainer.innerHTML = "";

        if (imageInput.files.length > 0) {
            for (let file of imageInput.files) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const imgElement = document.createElement("img");
                    imgElement.src = e.target.result;
                    imgElement.classList.add("preview-image", "mt-2");
                    imgElement.style.border = "2px dashed #dee2e6";
                    imgElement.style.borderRadius = "0.5rem";
                    imgElement.style.maxWidth = "100px";
                    imgElement.style.marginRight = "10px";

                    previewContainer.appendChild(imgElement);
                };
                reader.readAsDataURL(file);
            }
        }
    }

    function addNumberField() {
        let container = document.getElementById("numbersContainer");
        let wrapper = document.createElement("div");
        wrapper.classList.add("size-input-wrapper", "mb-2", "me-2");
        wrapper.style.display = "flex";
        wrapper.style.alignItems = "center";

        let newInput = document.createElement("input");
        newInput.type = "number";
        newInput.step = "any";
        newInput.name = "sizes[]";
        newInput.placeholder = "Nhập size";
        newInput.classList.add("form-control", "form-control-custom");
        newInput.style.maxWidth = "150px";
        newInput.min = "1";

        let removeButton = document.createElement("button");
        removeButton.type = "button";
        removeButton.classList.add("btn", "btn-danger", "btn-sm", "ms-2");
        removeButton.textContent = "Xóa";
        removeButton.onclick = function() {
            removeNumberField(removeButton);
        };

        wrapper.appendChild(newInput);
        wrapper.appendChild(removeButton);
        container.appendChild(wrapper);
    }

    function removeNumberField(button) {
        let wrapper = button.parentElement;
        wrapper.remove();
    }

    function autoResizeTextarea(textarea) {
        textarea.style.height = 'auto';
        textarea.style.height = textarea.scrollHeight + 'px';
    }

    document.addEventListener('DOMContentLoaded', function() {
        const textareas = document.querySelectorAll('textarea');
        textareas.forEach(textarea => {
            autoResizeTextarea(textarea);

            textarea.addEventListener('input', function() {
                autoResizeTextarea(textarea);
            });
        });
    });
</script>
<?php $this->stop() ?>