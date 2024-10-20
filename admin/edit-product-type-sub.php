<?php
session_start();
error_reporting(0);
require_once("../config/config.inc.php");

if (empty($_SESSION['user_name']  && $_SESSION["role"] == 0)) {
    header("Location: ../auth/login");
    exit();
}

$sqlProductsTypeSub = "SELECT * FROM products_sub_type WHERE pst_id = '" . $_GET["pst_id"] . "'";
$queryProductsTypeSub = mysqli_query($conn, $sqlProductsTypeSub);
$fetchProductsTypeSub = mysqli_fetch_assoc($queryProductsTypeSub);
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
    <link rel="icon" type="../image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../css/styles.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bulma/bulma.css">

</head>

<body class="d-flex flex-column min-vh-100">
    <?php include("./components/navbar.php"); ?>


    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-3">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-2 row-cols-xl-2 justify-content-center">
                <div class="col mb-5">
                    <div class="card h-100 shadow rounded-4">
                        <div class="card-body px-5 py-5">
                            <h2 class="text-center fw-bold">แก้ไขซับประเภทสินค้า</h2>
                            <form class="row g-3 mt-3 needs-validation" novalidate method="post" action="" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="productTypeSub" class="form-label fw-bold">ชื่อซับประเภท</label>
                                    <input type="text" class="form-control rounded-3" id="productTypeSub" name="productTypeSub" value="<?php echo $fetchProductsTypeSub["pst_name"] ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label for="productType" class="form-label fw-bold">ประเภท</label>
                                    <select class="form-select" aria-label="productType" id="productType" name="productType" required>
                                        <?php
                                        $sqlGetProductsType = "SELECT * FROM `products_type`";
                                        $resultGetProductsType = $conn->query($sqlGetProductsType);
                                        while ($rowGetProductsType = $resultGetProductsType->fetch_assoc()) {
                                            if ($fetchProductsTypeSub["productd_type"] == $rowGetProductsType["pt_id"]) {
                                                $selected = "selected";
                                            }else{
                                                $selected = "";
                                            }
                                        ?>
                                            <option value="<?php echo $rowGetProductsType["pt_id"]; ?>" <?php echo $selected ?>><?php echo $rowGetProductsType["pt_name"]; ?></option>
                                        <?php } ?>
                                    </select>

                                </div>

                                <div class="text-center mt-4">
                                    <input type="submit" class="btn btn-success rounded-2 fw-bold" value="บันทึก" name="submit" />
                                </div>



                            </form>
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
    <script src="../js/scripts.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
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
    </script>
    <?php
    if (!empty($_POST["submit"])) {
        $productTypeSub = $conn->real_escape_string($_POST['productTypeSub']);
        $productType = $conn->real_escape_string($_POST['productType']);

        $check = "SELECT * FROM products_sub_type WHERE pst_name = '$productTypeSub'";
        // echo $check;
        $resultCheck = mysqli_query($conn, $check);
        $fetch = mysqli_fetch_assoc($resultCheck);
        $num = mysqli_num_rows($resultCheck);
        if ($num > 0) {
            echo  '<script type="text/javascript">
        
            swal.fire({
                title: "Oops!!!",
                text: "ชื่อซับประเภทนี้มีอยู่แล้ว!!",
                icon: "warning",
                allowOutsideClick: false
            })
        </script>';
        } else {
          
            $sqlUpProductsTypeSub = "UPDATE `products_sub_type` SET `pst_name`='".$productTypeSub."',
            `productd_type`='".$productType."' 
            WHERE `pst_id` = '".$_GET["pst_id"]."'";
            $resUpProductsTypeSub = mysqli_query($conn, $sqlUpProductsTypeSub);
            if ($resUpProductsTypeSub) {
    ?>
                <script type="text/javascript">
                    swal.fire({
                        title: "Successfully",
                        html: "อัปเดทซับประเภทสำเร็จแล้ว",
                        icon: "success",
                        timer: 2000,
                        allowOutsideClick: false
                    }).then(function() {
                        window.location.href = 'manage-product-type-sub';
                    })
                </script>

            <?php   } else {
            ?>
                <script type="text/javascript">
                    swal.fire({
                        title: "Oops Error...",
                        text: "Please contact prgrammer!",
                        icon: "error",
                        allowOutsideClick: false
                    }).then(function() {
                        window.location.href = 'add-product-type-sub';
                    })
                </script>
    <?php
            }
        }
    }
    ?>

</body>

</html>