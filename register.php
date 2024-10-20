<?php 
error_reporting(0);
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
    <link rel="icon" type="image/x-icon" href="../assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="./css/styles.css" rel="stylesheet" />

</head>

<body class="d-flex flex-column min-vh-100">
    <!-- Navigation-->
    <?php include("./components/navbar.php"); ?>

    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-2 row-cols-xl-2 justify-content-center">
                <div class="col mb-5">
                    <a href="./register-customer" class="text-decoration-none text-black">
                    <div class="card h-100 shadow rounded-4">
                        <div class="card-body px-5 py-5">
                            <h4 class="text-center fw-bold">สมัครสมาชิกทั่วไป</h4>
                            
                        </div>

                    </div>
                    </a>
                </div>
                <div class="col mb-5">
                <a href="./auth/register-store" class="text-decoration-none text-black">
                    <div class="card h-100 shadow rounded-4">
                        <div class="card-body px-5 py-5">
                            <h4 class="text-center fw-bold">สมัครสมาชิกร้านค้า</h4>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer-->
    <?php include("./components/footer.php"); ?>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="./js/scripts.js"></script>
    </body>

</html>