<?php
session_start();
error_reporting(0);
require_once("../config/config.inc.php");
if (empty($_SESSION['user_name']) && $_SESSION["role"] == 2) {
    header("Location: ../auth/login");
    exit();
}

$sqlGetProducts = "SELECT products.*, pst_id, pst_name, pt_name, store_name FROM `products` 
LEFT JOIN products_type ON products.type = products_type.pt_id
LEFT JOIN products_sub_type ON products.subType = products_sub_type.pst_id
LEFT JOIN stores ON products.created_by = stores.user_name
WHERE id = '" . $_GET["product_id"] . "';";
$resultGetProducts = $conn->query($sqlGetProducts);

$rowGetProducts = $resultGetProducts->fetch_assoc();
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
    <link href="../css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bulma/bulma.css">
    <style>

    </style>
</head>

<body>
    <?php include("./components/navbar.php"); ?>


    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">

            <div class="row gx-4 gx-lg-5">
                <div class="col-12 col-md-6 col-lg-6 col-xl-6 mb-5 text-center">
                    <img class="card-img-top" src="../images/products/<?php echo $rowGetProducts["image"] ? $rowGetProducts["image"] : "-" ?>" alt="<?php echo $rowGetProducts["name"] ? $rowGetProducts["name"] : "-" ?>" />
                </div>
                <div class="col-12 col-md-6 col-lg-6 col-xl-6 mb-5">
                    <div class="text-center">
                        <h5 class="fw-bolder"> <?php echo $rowGetProducts["name"] ?></h5>
                    </div>
                 
                    <div class="fs-4 fw-bolder mt-4 text-primary-bold">฿<?php echo number_format($rowGetProducts["price"], 2) ?></div>
                    <div class="fs-6 text-muted fw-normal">จำนวนคงเหลือ : &nbsp;<?php echo $rowGetProducts["qty"] ?></div>
                
                    <div class="text-muted mt-2">ประเภท : &nbsp; <?php echo $rowGetProducts["pt_name"] ?></div>
                    <div class="text-muted">ซับประเภท : &nbsp;<?php echo $rowGetProducts["pst_name"] ?></div>
                    <div class="text-muted">ลงสินค้าโดย : &nbsp;<?php echo $rowGetProducts["store_name"] ?></div>



                </div>
                <?php if (!empty($rowGetProducts["description"])) { ?>
                    <div class="col-12 col-md-12 col-lg-12 col-xl-12 mb-5">
                        <div class="card h-100">
                            <div class="card-body p-4">
                                <div class="">
                                    <?php echo $rowGetProducts["description"] ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <!-- Footer-->
    <?php include("./components/footer.php"); ?>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="../js/scripts.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

</body>

</html>