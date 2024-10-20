<?php
session_start();
error_reporting(0);
require_once("../config/config.inc.php");

if (empty($_SESSION['user_name']  && $_SESSION["role"] == 0)) {
    header("Location: ../auth/login");
    exit();
}

$sqlGetProducts = "SELECT products.*, pst_id, pst_name, pt_name FROM `products` 
LEFT JOIN products_type ON products.type = products_type.pt_id
LEFT JOIN products_sub_type ON products.subType = products_sub_type.pst_id
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
    <link rel="icon" type="../image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../css/styles.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bulma/bulma.css">
    <script src="//cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
    <!-- <script src="https://cdn.ckeditor.com/4.24.0-lts/full/ckeditor.js"></script> -->

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
                            <h2 class="text-center fw-bold">แก้ไขสินค้า</h2>
                            <form class="row g-3 mt-2 needs-validation" novalidate method="post" action="" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="sku" class="form-label fw-bold">sku</label>
                                    <input type="text" class="form-control rounded-3" id="sku" name="sku" value="<?php echo $rowGetProducts["sku"]; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="productName" class="form-label fw-bold">ชื่อสินค้า</label>
                                    <input type="text" class="form-control rounded-3" id="productName" name="productName" required value="<?php echo $rowGetProducts["name"]; ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="productType" class="form-label fw-bold">ประเภท</label>
                                    <select class="form-select" aria-label="productType" id="productType" name="productType" required>
                                        <option value="" disabled selected>กรุณาเลือกประเภท</option>
                                        <?php
                                        $sqlGetProductsType = "SELECT * FROM `products_type`";
                                        $resultGetProductsType = $conn->query($sqlGetProductsType);
                                        while ($rowGetProductsType = $resultGetProductsType->fetch_assoc()) {

                                            if ($rowGetProducts["type"] == $rowGetProductsType["pt_id"]) {
                                                $selected = "selected";
                                            } else {
                                                $selected = "";
                                            }
                                        ?>
                                            <option value="<?php echo $rowGetProductsType["pt_id"]; ?>" <?php echo $selected; ?>><?php echo $rowGetProductsType["pt_name"]; ?></option>
                                        <?php } ?>
                                    </select>

                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="productTypeSub" class="form-label fw-bold">ซับประเภท</label>
                                    <select class="form-control rounded-3" id="productTypeSub" name="productTypeSub" required>
                                        <option value="">เลือกซับประเภท</option>
                                        <?php
                                        $sqlGetProductsTypeSub = "SELECT * FROM `products_sub_type`";
                                        $resultGetProductsTypeSub = $conn->query($sqlGetProductsTypeSub);
                                        while ($rowGetProductsTypeSub = $resultGetProductsTypeSub->fetch_assoc()) {

                                            if ($rowGetProducts["subType"] == $rowGetProductsTypeSub["pst_id"]) {
                                                $selected = "selected";
                                            } else {
                                                $selected = "";
                                            }
                                        ?>
                                            <option value="<?php echo $rowGetProductsTypeSub["pst_id"]; ?>" <?php echo $selected; ?>><?php echo $rowGetProductsTypeSub["pst_name"]; ?></option>
                                        <?php } ?>
                                    </select>


                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="productPrice" class="form-label fw-bold">ราคา</label>
                                    <input type="number" class="form-control rounded-3" id="productPrice" name="productPrice" required value="<?php echo $rowGetProducts["price"]; ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="productRam" class="form-label fw-bold">หน่วยความจำ</label>
                                    <input type="number" class="form-control rounded-3" id="productRam" name="productRam" required value="<?php echo $rowGetProducts["ram"]; ?>">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="productDescription" class="form-label fw-bold">คำอธิบายสินค้า</label>
                                    <textarea class="form-control" id="productDescription" name="productDescription" rows="5">
                                    <?php echo $rowGetProducts["description"] ? $rowGetProducts["description"] : "" ?>
                                    </textarea>

                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="productSpec" class="form-label fw-bold">Spec</label>
                                    <textarea class="form-control" id="productSpec" name="productSpec" rows="5">
                                    <?php echo $rowGetProducts["spec"] ? $rowGetProducts["spec"] : "" ?>
                                    </textarea>

                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="imgCom" class="form-label fw-bold">ภาพคอม</label>
                                    <input type="hidden" class="form-control rounded-3" id="imgComOld" name="imgComOld" value="<?php echo $rowGetProducts["image"]; ?>">
                                    <input class="form-control" type="file" id="imgCom" name="imgCom" accept="image/png, image/jpg, image/jpeg" onchange="loadFile(event)">
                                </div>

                                <div class="" align="center">
                                    <img src="../images/products/<?php echo $rowGetProducts["image"] ? $rowGetProducts["image"] : "-" ?>" class="mb-4 rounded-2 shadow" id="output" style="width: 60%;" />
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
        $imgComOld = $conn->real_escape_string($_POST['imgComOld']);

        
            if (!empty($_FILES['imgCom']['tmp_name'])) {
                $imgPro1 = $_FILES['imgCom']['tmp_name'];
                $imgPro1_name = $_FILES['imgCom']['name'];
                $array_lastimgPro1 = explode(".", $imgPro1_name);
                $c_imgPro1 = count($array_lastimgPro1) - 1;
                $last_imgPro1_name = strtolower($array_lastimgPro1[$c_imgPro1]);
                $namePro1 = "imgCom" . date("YmdHis") . "_1." . $last_imgPro1_name;
                copy($imgPro1, "../images/products/" . $namePro1);
            } else {
                $namePro1 = $imgComOld;
            }

            $sqlUpProducts = "UPDATE `products` SET `sku`='" . $sku . "',
            `name`='" . $productName . "',
            `type`='" . $productType . "',
            `subType`='" . $productTypeSub . "',
            `price`='" . $productPrice . "',
            `ram`='" . $productRam . "',
            `description`='" . $productDescription . "',
            `spec`='" . $productSpec . "',
            `image`='" . $namePro1 . "'
            WHERE `id` = '".$_GET["product_id"]."'";
            echo $sqlUpProducts;
            $resUpProducts = mysqli_query($conn, $sqlUpProducts);
            if ($resUpProducts) {
    ?>
                <script type="text/javascript">
                    swal.fire({
                        title: "Successfully",
                        html: "อัปเดตสินค้าสำเร็จแล้ว",
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
                        text: "อัปเดตสินค้าไม่สำเร็จแล้ว",
                        icon: "error",
                        allowOutsideClick: false
                    }).then(function() {
                        window.location.href = 'edit-product';
                    })
                </script>
    <?php
            }
        
    }
    ?>

</body>

</html>