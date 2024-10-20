<?php
session_start();
error_reporting(0);
require_once("../config/config.inc.php");

if (empty($_SESSION['user_name']  && $_SESSION["role"] == 0)) {
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
                            <h2 class="text-center fw-bold">เพิ่มประเภทสินค้า</h2>
                            <form class="row g-3 mt-3 needs-validation" novalidate method="post" action="" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="productType" class="form-label fw-bold">ชื่อประเภท</label>
                                    <input type="text" class="form-control rounded-3" id="productType" name="productType" required>
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
    $productType = $conn->real_escape_string($_POST['productType']);

    $check = "SELECT * FROM products_type WHERE pt_name = '$productType'";
    // echo $check;
    $resultCheck = mysqli_query($conn, $check);
    $fetch = mysqli_fetch_assoc($resultCheck);
    $num = mysqli_num_rows($resultCheck);
    if ($num > 0) {
        echo  '<script type="text/javascript">
        
            swal.fire({
                title: "Oops!!!",
                text: "ชื่อประเภทนี้มีอยู่แล้ว!!",
                icon: "warning",
                allowOutsideClick: false
            })
        </script>';
    } else {
        $sqlInProductsType = "INSERT INTO `products_type`(`pt_name`) VALUES ('" . $productType . "')";
       
        $resInProductsType = mysqli_query($conn, $sqlInProductsType);
        if ($resInProductsType) {
?>
            <script type="text/javascript">
                swal.fire({
                    title: "Successfully",
                    html: "เพิ่มประเภทสินค้าสำเร็จแล้ว",
                    icon: "success",
                    timer: 2000,
                    allowOutsideClick: false
                }).then(function() {
                    window.location.href = 'manage-product-type';
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
                    window.location.href = 'add-product-type';
                })
            </script>
<?php
        }
    }
  }
?>

</body>

</html>