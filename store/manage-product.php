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

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">

</head>

<body class="d-flex flex-column min-vh-100">
    <?php 
    $page = "manage-product";
    include("./components/navbar.php"); ?>


    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="d-flex justify-content-between">
                <h5 class="card-title mb-0">การจัดการสินค้า</h5>
                <div class="btn-group">
                 
                    <a href="./add-product">
                        <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#add">
                            <i class="bi bi-plus-circle-fill"></i>
                            เพิ่มสินค้า
                        </button>
                    </a>
                </div>


            </div>
            <div class="table-responsive">
                <table class="table" id="tableProductsType">
                    <thead>
                        <tr class="text-nowrap">
                            <th>ID</th>
                            <th>ชื่อสินค้า</th>
                            <th>ประเภท</th>
                            <th>ซับประเภท</th>
                            <th>จำนวนสินค้า</th>
                            <th>ราคา</th>
                            <th>ภาพสินค้า</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sqlGetProductsTypeSub = "SELECT products.*, pst_id, pst_name, pt_name FROM `products` 
                        LEFT JOIN products_type ON products.type = products_type.pt_id
                        LEFT JOIN products_sub_type ON products.subType = products_sub_type.pst_id
                        WHERE created_by = '".$_SESSION['user_name']."' ORDER BY id DESC; ";
                        $resultGetProductsTypeSub = $conn->query($sqlGetProductsTypeSub);

                        // output data of each row
                        $i = 0;
                        while ($rowGetProductsTypeSub = $resultGetProductsTypeSub->fetch_assoc()) {
                            $i++
                        ?>
                            <tr>
                                <td class="py-1">
                                    <?php echo $rowGetProductsTypeSub["id"] ?>
                                </td>
                                <td class="py-1">
                                    <?php echo $rowGetProductsTypeSub["name"] ?>
                                </td>
                                <td class="py-1">
                                    <?php echo $rowGetProductsTypeSub["pst_name"] ?>
                                </td>
                                <td class="py-1">
                                    <?php echo $rowGetProductsTypeSub["pt_name"] ?>
                                </td>
                                <td class="py-1">
                                    <?php echo $rowGetProductsTypeSub["qty"] ?>
                                </td>
                                <td class="py-1">
                                    <?php echo $rowGetProductsTypeSub["price"] ?>
                                </td>
                                <!-- <td class="py-1">
                                    <?php echo $rowGetProductsTypeSub["description"] ?>
                                </td>
                                <td>
                                    <?php echo $rowGetProductsTypeSub["spec"] ? $rowGetProductsTypeSub["spec"] : "-" ?>
                                </td> -->
                                <td>
                                    <img src="../images/products/<?php echo $rowGetProductsTypeSub["image"] ? $rowGetProductsTypeSub["image"] : "-" ?>" style="width:200px;" />
                                </td>

                                <td class="text-center">

                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="edit-product?product_id=<?php echo $rowGetProductsTypeSub["id"]; ?>">
                                            <button type="button" class="btn btn-outline-primary" id="<?php echo $rowGetProductsTypeSub["id"]; ?>">
                                                <i class="bi bi-pencil-fill"></i>
                                            </button>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
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
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#tableProductsType').DataTable();
        });
    </script>
</body>

</html>