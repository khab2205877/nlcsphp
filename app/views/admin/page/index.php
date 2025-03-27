<?php $this->layout("layouts/default", ["title" => APPNAME]) ?>

<?php $this->start("page_specific_css") ?>
<link href="https://cdn.datatables.net/v/dt/jq-3.7.0/dt-2.0.8/r-3.0.2/sp-2.3.1/datatables.min.css" rel="stylesheet">
<style>
    table#phones {
        border-radius: 10px;
        overflow: hidden;
    }

    table#phones tbody tr:hover {
        background-color: #f8f9fa;
    }

    table#phones th,
    table#phones td {
        vertical-align: middle;
        text-align: center;
    }

    td:last-child {
        white-space: nowrap;
    }

    /* Căn chỉnh dropdown Show Entries */
    #entries-per-page {
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 14px;
        cursor: pointer;
        margin-left: 5px;
    }

    /* Căn chỉnh ô tìm kiếm */
    #custom-search {
        width: 200px;
    }

    div.dt-search {
        display: none;
    }
</style>

<?php $this->stop() ?>

<?php $this->start("page") ?>
<div class="container">

    <!-- SECTION HEADING -->
    <h2 class="text-center animate__animated animate__bounce">Giới Thiệu</h2>
    <div class="row">
        <div class="col-md-6 offset-md-3 text-center">
            <p class="animate__animated animate__fadeInLeft">Trang quản trị</p>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <?php if (isset($_SESSION['success_Mess'])): ?>
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <?php echo $_SESSION['success_Mess']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php unset($_SESSION['success_Mess']); ?>
            <?php endif; ?>
            <!-- FLASH MESSAGES -->

            <h1>Xin chào</h1>
            <br />
            <p>
                Đây là hệ thống quản trị của website Thương mại điện tử do Nguyễn Văn Kha xây dựng và phát triển, dành cho Lập trình web PHP.
            </p>
            <br />
            <p>
                Hệ thống quản trị này có các chức năng quản lý sau:
                <br />
                - Quản lý Thành viên
                <br />
                - Quản lý Danh mục sản phẩm
                <br />
                - Quản lý Sản phẩm
                <br />
                - ...
            </p>
            <br />
            <p>
                Hệ thống đang trong quá trình hoàn thiện. Hệ thống vẫn tiếp tục được nâng cấp và cải tiến để quản trị viên được sử dụng những chức năng tốt nhất của hệ thống.
            </p>
            <br />
            <p>
                <b>Nguyễn Văn Kha</b>
            </p>
        </div>
    </div>
</div>


</div>
<?php $this->stop() ?>

<?php $this->start("page_specific_js") ?>
<script src="https://cdn.datatables.net/v/dt/jq-3.7.0/dt-2.0.8/r-3.0.2/sp-2.3.1/datatables.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let table = new DataTable("#phones", {
            responsive: true,
            pagingType: "simple_numbers",
            lengthChange: false, // Ẩn dropdown mặc định của DataTables
            searching: true // Tắt thanh tìm kiếm mặc định
        });

        // Thay đổi số dòng hiển thị
        document.getElementById("entries-per-page").addEventListener("change", function() {
            table.page.len(this.value).draw();
        });

        // Tìm kiếm theo từ khóa nhập vào
        document.getElementById("custom-search").addEventListener("keyup", function() {
            table.search(this.value).draw();
        });

        // Xử lý nút xóa
        const deleteButtons = document.querySelectorAll('button[name="delete-phone"]');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const form = button.closest('form');
                const nameTd = button.closest('tr').querySelector('td:first-child');
                if (nameTd) {
                    document.querySelector('.modal-body p').textContent =
                        `Do you want to delete "${nameTd.textContent}"?`;
                }
                const submitForm = function() {
                    form.submit();
                };
                document.getElementById('delete').addEventListener('click', submitForm, {
                    once: true
                });

                const modalEl = document.getElementById('delete-confirm');
                modalEl.addEventListener('hidden.bs.modal', function() {
                    document.getElementById('delete').removeEventListener('click', submitForm);
                });

                const confirmModal = new bootstrap.Modal(modalEl, {
                    backdrop: 'static',
                    keyboard: false
                });
                confirmModal.show();
            });
        });
    });
</script>
<?php $this->stop() ?>