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
    <script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
</head>

<body class="d-flex flex-column min-vh-100">
    <?php include("./components/navbar.php"); ?>


    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-3">
            <div class="row gx-4 gx-lg-5 row-cols-1 row-cols-md-1 row-cols-xl1 justify-content-center">
                <div class="col mb-5">
                    <div class="card h-100 shadow rounded-4">
                        <div class="card-body px-5 py-5">
                            <h2 class="text-center fw-bold">เพิ่มสินค้า</h2>
                            <form class="row g-3 mt-2 needs-validation" novalidate method="post" action="" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="sku" class="form-label fw-bold">sku</label>
                                    <input type="text" class="form-control rounded-3" id="sku" name="sku">
                                </div>
                                <div class="mb-3">
                                    <label for="productName" class="form-label fw-bold">ชื่อสินค้า <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control rounded-3" id="productName" name="productName" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="productType" class="form-label fw-bold">ประเภท <span class="text-danger">*</span></label>
                                    <select class="form-select" aria-label="productType" id="productType" name="productType" required>
                                        <option value="" disabled selected>กรุณาเลือกประเภท</option>
                                        <?php
                                        $sqlGetProductsType = "SELECT * FROM `products_type`";
                                        $resultGetProductsType = $conn->query($sqlGetProductsType);
                                        while ($rowGetProductsType = $resultGetProductsType->fetch_assoc()) {

                                        ?>
                                            <option value="<?php echo $rowGetProductsType["pt_id"]; ?>"><?php echo $rowGetProductsType["pt_name"]; ?></option>
                                        <?php } ?>
                                    </select>

                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="productTypeSub" class="form-label fw-bold">ซับประเภท <span class="text-danger">*</span></label>
                                    <select class="form-control rounded-3" id="productTypeSub" name="productTypeSub" required>
                                        <option value="">เลือกซับประเภท</option>
                                    </select>


                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="productPrice" class="form-label fw-bold">ราคา<span class="text-danger">*</span></label>
                                    <input type="number" class="form-control rounded-3" id="productPrice" name="productPrice" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="productRam" class="form-label fw-bold">หน่วยความจำ<span class="text-danger">*</span></label>
                                    <input type="number" class="form-control rounded-3" id="productRam" name="productRam" required>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="productDescription" class="form-label fw-bold">คำอธิบายสินค้า</label>
                                    <textarea class="form-control" id="productDescription" name="productDescription" rows="5"></textarea>

                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="productSpec" class="form-label fw-bold">Spec</label>
                                    <textarea class="form-control" id="productSpec" name="productSpec" rows="5"></textarea>

                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="imgCom" class="form-label fw-bold">ภาพคอม<span class="text-danger">*</span></label>
                                    <input class="form-control" type="file" id="imgCom" name="imgCom" accept="image/png, image/jpg, image/jpeg" onchange="loadFile(event)" required>
                                </div>

                                <div class="" align="center">
                                    <img class="mb-4 rounded-2 shadow" id="output" style="width: 60%;" />
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

        let loadFile = function(event) {
            let output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src)
            }
        };
        CKEDITOR.replace('productDescription', {
            height: 400
        });

        CKEDITOR.replace('productSpec', {
            height: 400
        });
        $(`#productType`).change(function() {
            let productType = $(this).val();
            // console.log(productType)
            $(`#productTypeSub`).html('<option value="" selected disabled>เลือกซับประเภท</option>');
            $.ajax({
                type: "POST",
                url: "./get/sub-type.php",
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
    <?php
    if (!empty($_POST["submit"])) {
        $sku = $conn->real_escape_string($_POST['sku']);
        $productName = $conn->real_escape_string($_POST['productName']);
        $productType = $conn->real_escape_string($_POST['productType']);
        $productTypeSub = $conn->real_escape_string($_POST['productTypeSub']);
        $productPrice = $conn->real_escape_string($_POST['productPrice']);
        $productRam = $conn->real_escape_string($_POST['productRam']);
        $productDescription = $conn->real_escape_string($_POST['productDescription']);
        $productSpec = $conn->real_escape_string($_POST['productSpec']);

        $check = "SELECT * FROM products WHERE name = '$productName'";
        // echo $check;
        $resultCheck = mysqli_query($conn, $check);
        $fetch = mysqli_fetch_assoc($resultCheck);
        $num = mysqli_num_rows($resultCheck);
        if ($num > 0) {
            echo  '<script type="text/javascript">
        
            swal.fire({
                title: "Oops!!!",
                text: "สินค้านี้มีอยู่แล้ว!!",
                icon: "warning",
                allowOutsideClick: false
            })
        </script>';
        } else {
            if (!empty($_FILES['imgCom']['tmp_name'])) {
                $imgPro1 = $_FILES['imgCom']['tmp_name'];
                $imgPro1_name = $_FILES['imgCom']['name'];
                $array_lastimgPro1 = explode(".", $imgPro1_name);
                $c_imgPro1 = count($array_lastimgPro1) - 1;
                $last_imgPro1_name = strtolower($array_lastimgPro1[$c_imgPro1]);
                $namePro1 = "imgCom" . date("YmdHis") . "_1." . $last_imgPro1_name;
                copy($imgPro1, "../images/products/" . $namePro1);
            } else {
                $namePro1 = "";
            }

            $sqlInProducts = "INSERT INTO `products`(`sku`, `name`, 
            `type`, `subType`, `price`, `ram`, 
            `description`, `spec`, `image`, 
            `status`, created_by, `create_at`) VALUES ('" . $sku . "','" . $productName . "',
            '" . $productType . "','" . $productTypeSub . "','" . $productPrice . "','" . $productRam . "',
            '" . $productDescription . "','" . $productSpec . "','" . $namePro1 . "',
            '1','" . $_SESSION['user_name'] . "','" . date('Y-m-d H:i:s') . "')";

            $resInProducts = mysqli_query($conn, $sqlInProducts);
            if ($resInProducts) {
    ?>
                <script type="text/javascript">
                    swal.fire({
                        title: "Successfully",
                        html: "เพิ่มสินค้าสำเร็จแล้ว",
                        icon: "success",
                        timer: 2000,
                        allowOutsideClick: false
                    }).then(function() {
                        window.location.href = 'manage-product';
                    })
                </script>

            <?php   } else {
            ?>
                <script type="text/javascript">
                    swal.fire({
                        title: "Oops Error...",
                        text: "เพิ่มสินค้าไม่สำเร็จแล้ว",
                        icon: "error",
                        allowOutsideClick: false
                    }).then(function() {
                        window.location.href = 'add-product';
                    })
                </script>
    <?php
            }
        }
    }
    ?>

</body>

</html>