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
            <form action="/admin/products/store" method="POST" enctype="multipart/form-data">
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
                                        name="images[]" id="imageInput" accept="image/*"
                                        onchange="previewImageProduct(event)">
                                    <label>Hình Ảnh</label>
                                </div>
                                <div id="previewContainer" class=""></div>
                            </div>

                            <!-- Material & Origin -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control form-control-custom <?= isset($errors['material']) ? ' is-invalid' : '' ?>" name="material"
                                        value="<?= isset($old['material']) ? $this->e($old['material']) : '' ?>" placeholder="Chất liệu">
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
                                        value="<?= isset($old['origin']) ? $this->e($old['origin']) : '' ?>" placeholder="Xuất xứ" required>
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
                                        <div class="size-input-wrapper mb-2 me-2" style="display: flex; align-items: center;">
                                            <input type="number" step="any" class="form-control form-control-custom" name="sizes[]"
                                                placeholder="Nhập size" style="max-width: 150px;" min="0">
                                            <button type="button" class="btn btn-danger btn-sm ms-2" onclick="removeNumberField(this)">Xóa</button>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-info mt-2" onclick="addNumberField()">Thêm size</button>
                                </div>
                            </div>
                            <!-- Description -->
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea type="text" class="form-control form-control-custom <?= isset($errors['description']) ? ' is-invalid' : '' ?>" name="description"
                                        value="<?= isset($old['description']) ? $this->e($old['description']) : '' ?>" placeholder="Mô tả sản phẩm" style="height: 130px"></textarea>
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
</script>
<?php $this->stop() ?>