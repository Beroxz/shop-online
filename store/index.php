<?php
session_start();
error_reporting(0);
require_once("../config/config.inc.php");

if (empty($_SESSION['user_name']  && $_SESSION["role"] == 2)) {
    header("Location: ../auth/login");
    exit();
}

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
  
</head>

<body class="d-flex flex-column min-vh-100">
    <?php
    $page = "index";
    include("./components/navbar.php"); ?>


    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            
            <div class="d-flex justify-content-center fs-2 fw-bold">สินค้าในร้าน</div>
            <div class="row gx-4 gx-lg-5">
                <?php
                $sqlGetProductsTypeSub = "SELECT products.*, pst_id, pst_name, pt_name FROM `products` 
                        LEFT JOIN products_type ON products.type = products_type.pt_id
                        LEFT JOIN products_sub_type ON products.subType = products_sub_type.pst_id ORDER BY id DESC; ";
                $resultGetProductsTypeSub = $conn->query($sqlGetProductsTypeSub);

                // output data of each row
                $i = 0;
                while ($rowGetProductsTypeSub = $resultGetProductsTypeSub->fetch_assoc()) {
                    $i++
                ?>
                    <div class="col-6 col-md-4 col-lg-3 col-xl-3 mb-5">
                        <a class="text-decoration-none" href="detail?product_id=<?php echo $rowGetProductsTypeSub["id"] ?>">
                            <div class="card h-100 rounded-4">
                                <!-- Product image-->
                                <div class="p-2 ">
                                    <img class="card-img-top rounded-4" src="../images/products/<?php echo $rowGetProductsTypeSub["image"] ? $rowGetProductsTypeSub["image"] : "-" ?>" alt="..." />
                                </div>
                                <!-- Product details-->
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <!-- Product name-->
                                        <h6 class="fw-bolder custom-truncate text-dark"> <?php echo $rowGetProductsTypeSub["name"] ?></h6>
                                        <!-- Product price-->
                                        <div class="d-flex justify-content-between mt-4">
                                            <div class="text-primary fw-bold text-primary-bold">
                                               ฿<?php echo number_format($rowGetProductsTypeSub["price"], 2) ?>
                                            </div>
                                            <div class="text-muted fs-6 fw-normal">
                                                จำนวน: <?php echo $rowGetProductsTypeSub["qty"] ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Product actions-->
                                <!-- <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">View options</a></div>
                            </div> -->
                            </div>
                        </a>
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
</body>

</html>