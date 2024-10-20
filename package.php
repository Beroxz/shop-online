<?php
session_start();
error_reporting(0);
require_once("./config/config.inc.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content />
    <meta name="author" content />
    <title>Shop Homepage - Start Bootstrap Template</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bulma/bulma.css">
    <style>

    </style>
</head>

<body>
    <?php 
    $page = "package";
    include("./components/navbar.php"); ?>

    <section class="py-4">
        <div class="container px-4 px-lg-5">
            <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
                <h1 class="display-4 fw-normal">ค่าแพ็คเกจ 24Shop</h1>
                <p class="fs-5 text-muted">เป็นบริการเว็บที่ออกแบบมาเพื่อช่วยให้ธุรกิจขนาดเล็กถึงกลางสามารถสร้างเว็บไซต์ขายของออนไลน์ได้อย่างง่ายดายและมีความสะดวกสบาย นับเป็นเครื่องมือที่มีประสิทธิภาพในการสร้างร้านค้าออนไลน์ที่มีคุณภาพและมีประสิทธิภาพในการขายสินค้าและบริการออนไลน์.</p>
            </div>
        </div>
    </section>
    <section class="py-4">
        <div class="container px-4 px-lg-5">
            <div class="row row-cols-1 row-cols-md-3 mb-3 justify-content-center text-center">
                <div class="col">
                    <div class="card mb-4 rounded-3 shadow-sm border-primary">
                        <div class="card-header py-3 text-bg-primary border-primary">
                            <h4 class="my-0 fw-normal">Basic</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">Free<small class="text-muted fw-light">/mo</small></h1>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>ระบบการจัดการสินค้า</li>
                                <li>การชำระเงินออนไลน์</li>
                                <li>การชำระเงินออนไลน์</li>
                                <li>ระบบการจัดส่งสินค้า</li>
                            </ul>
                            <a href="./auth/register-store">
                                <button type="button" class="w-100 btn btn-lg btn-primary">สมัครการร้านค้า</button>
                                </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer-->
    <?php include("./components/footer.php"); ?>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script>
        (() => {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            const forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
        })()

        $(`#productType`).change(function() {
            let productType = $(this).val();
            // console.log(productType)
            $(`#productTypeSub`).html('<option value="" selected disabled>เลือกซับประเภท</option>');
            $.ajax({
                type: "POST",
                url: "./admin/get/sub-type.php",
                data: {
                    id: productType,
                    function: 'productType'
                },
                success: function(data) {
                    const result = JSON.parse(data);
                    $.each(result, function(index, item) {
                        $(`#productTypeSub`).append(
                            $('<option></option>').val(item.pst_id).html(item.pst_name)
                        );
                    });
                }
            });
        });
    </script>
</body>

</html>