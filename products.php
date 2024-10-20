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
    <?php include("./components/navbar.php"); ?>

    <div class="container mt-3 rounded d-flex justify-content-center">
        <div class="input-group mt-3">
            <div class="input-group-prepend">
                <span class="input-group-text text-light bg-danger">
                    <img src="images/cute1.jpg" style="width: 35px; height: 35px; margin-right: 5px;"> ประกาศ
                </span>
            </div>
            <marquee style="display: flex; align-items: center; padding: 10px; background-color: transparent; color: black;" class="display: flex; align-items: center; form-control bg-card text-black">
                💖🔥KIT COM TAKE 🔥💖 💯เพราะคอมที่ดีอยู่กับเรา⭐
                <a class="rainbow" style="text-decoration: none; color: black;" href="product">⭐กดดูสินค้าที่นี่ได้เลย</a>🚀
            </marquee>
        </div>
    </div>

    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">

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
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="./images/products/<?php echo $rowGetProductsTypeSub["image"] ? $rowGetProductsTypeSub["image"] : "-" ?>" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder text-truncate"> <?php echo $rowGetProductsTypeSub["name"] ?></h5>
                                    <!-- Product price-->
                                    <span class="text-muted">
                                    <?php echo number_format($rowGetProductsTypeSub["price"], 2) ?>
                                    </span>
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
    <script src="js/scripts.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
   
</body>

</html>