<?php
session_start();
error_reporting(0);
require_once("./config/config.inc.php");


// สร้างคำสั่ง SQL สำหรับค้นหาข้อมูล
$sql = "SELECT products.*, pst_id, pst_name, pt_name FROM `products` 
LEFT JOIN products_type ON products.type = products_type.pt_id
LEFT JOIN products_sub_type ON products.subType = products_sub_type.pst_id WHERE 1 ";
$sql_conditions = array();

// เพิ่มเงื่อนไขการค้นหา
if (!empty($_GET['productType'])) {
    $productType = $_GET['productType'];
    $sql .= " AND type = '$productType'";
}

if (!empty($_GET['productTypeSub'])) {
    $productTypeSub = $_GET['productTypeSub'];
    $sql .= " AND subType = '$productTypeSub'";
}

if (!empty($_GET['start_budget']) && !empty($_GET['end_budget'])) {
    $start_budget = $_GET['start_budget'];
    $end_budget = $_GET['end_budget'];
    $sql .= " AND price BETWEEN $start_budget AND $end_budget";
}

if (!empty($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
    $sql .= " AND (name LIKE '%$keyword%' OR description LIKE '%$keyword%')";
}

// echo $sql;
// ดำเนินการค้นหา
$result = $conn->query($sql);

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


    <!-- Section-->
    <section class="py-5">

        <div class="container px-4 px-lg-5 mt-5">
            <div class="d-flex justify-content-center mb-5">
                <div class="fs-4 fw-bold">ผลการค้นหาสินค้า</div>
            </div>
            <?php if ($result->num_rows > 0) { ?>
                <div class="row gx-4 gx-lg-5">
                    <?php

                    while ($rowGetProductsTypeSub = $result->fetch_assoc()) {
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
            <?php } else { ?>
                <div class="d-flex justify-content-center mt-5">
                    <div class="text-muted fs-4 fw-bold">ไม่พบสินค้า</div>
                </div>
            <?php } ?>
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