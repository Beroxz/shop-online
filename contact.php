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
    $page = "contact";
    include("./components/navbar.php"); ?>

    <section class="py-4">
        <div class="container px-4 px-lg-5">
            <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
                <h1 class="display-4 fw-normal">ติดต่อเรา</h1>
               
            </div>
        </div>
    </section>
    <section class="py-4">
        <div class="container px-4 px-lg-5">
            <div class="row row-cols-1 row-cols-md-3 mb-3 justify-content-center text-center">
                <div class="col">
                    <div class="card mb-4 rounded-3 shadow-sm border-primary">
                        
                        <div class="card-body">
                            <h3 class="card-title fw-bold fs-3">ที่อยู่</h3>
                            <p class="text-muted">123 ม.4 กรุงเทพ</p>
                            
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mb-4 rounded-3 shadow-sm border-primary">
                        
                        <div class="card-body">
                            <h3 class="card-title fw-bold fs-3">อีเมล์</h3>
                            <p class="text-muted">admin@24shop.com</p>
                            
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mb-4 rounded-3 shadow-sm border-primary">
                        
                        <div class="card-body">
                            <h3 class="card-title fw-bold fs-3">เบอร์โทร</h3>
                            <p class="text-muted">098xxxxxxx</p>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-3">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3875.869733308563!2d100.49053347485548!3d13.726335586662907!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e2993daf49fc43%3A0x9a88b0ebde9b7f17!2z4Lin4LiH4LmA4Lin4Li14Lii4LiZ4LmD4Lir4LiN4LmI!5e0!3m2!1sth!2sth!4v1710738461992!5m2!1sth!2sth" width="800" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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