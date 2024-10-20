<?php
session_start();
error_reporting(0);
require_once("../config/config.inc.php");

if (empty($_SESSION['user_name']  && $_SESSION["role"] == 0)) {
    header("Location: ../auth/login");
    exit();
}
$sqlGetOrder = "SELECT order_header.*, customers.firstname, customers.tel, customers.email,
                        customers.lastname, provinces.name_th as provinces, amphures.name_th as districts,
                        districts.name_th as sub_districts, payment_name FROM `order_header` 
                        LEFT JOIN customers ON customers.user_name = order_header.cus_id
                        LEFT JOIN provinces ON provinces.id = order_header.ship_province
                        LEFT JOIN amphures ON amphures.id = order_header.ship_district
                        LEFT JOIN districts ON districts.id = order_header.ship_sub_district
                        LEFT JOIN payment_method ON payment_method.payment_id = order_header.payment
                        WHERE order_id = '" . $_GET['order_id'] . "'";
// echo $sqlGetOrder;
$resultGetOrder = $conn->query($sqlGetOrder);

$rowGetOrder = $resultGetOrder->fetch_assoc();
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
    <?php
    $page = "order-detail";
    include("./components/navbar.php"); ?>


    <section class="py-4">
        <div class="container px-4 px-lg-5">

            <?php if($rowGetOrder["parcel_number"]) { ?>
                <div class="row px-5 g-3 mt-4">
                    <div class="fw-bold">เลขพัสดุ : <?php echo $rowGetOrder["parcel_number"] ?>
                        <input type="hidden" value=" <?php echo $rowGetOrder["parcel_number"] ?>" id="inputCopy">
                        <button class="btn btn-light rounded-5" id="buttonCopy"><i class="bi bi-files"></i></button>
                    </div>
                </div>
            <?php } ?>
            <h2 class="page-header text-center mt-4">ข้อมูลผู้สั่งซื้อ</h2>
            <div class="row px-5">
                <div class="col-md-6">
                    <label for="firstName" class="form-label fw-bold">ชื่อ</label>
                    <div class=""><?php echo $rowGetOrder["firstname"] ?></div>
                </div>
                <div class="col-md-6">
                    <label for="lastName" class="form-label fw-bold">นามสกุล</label>
                    <div class=""><?php echo $rowGetOrder["lastname"] ?></div>
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label fw-bold">E-mail</label>
                    <div class=""><?php echo $rowGetOrder["email"] ?></div>
                </div>
                <div class="col-md-6">
                    <label for="tel" class="form-label fw-bold">เบอร์โทร</label>
                    <div class=""><?php echo $rowGetOrder["tel"] ?></div>
                </div>
            </div>
            <h2 class="page-header text-center mt-4">จัดส่งที่อยู่</h2>
            <div class="row px-5 g-3">
                <div class="col-md-8">
                    <label for="ship_address" class="form-label fw-bold">ที่อยู่</label>
                    <div class=""><?php echo $rowGetOrder["ship_address"] ?></div>
                </div>
                <div class="col-12 col-md-4">
                    <label for="province" class="form-label fw-bold">จังหวัด</label>
                    <div class=""><?php echo $rowGetOrder["provinces"] ?></div>


                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="district" class="form-label fw-bold">อำเภอ</label>
                        <div class=""><?php echo $rowGetOrder["districts"] ?></div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="sub_district" class="form-label fw-bold">ตำบล</label>
                        <div class=""><?php echo $rowGetOrder["sub_districts"] ?></div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="postcode" class="form-label fw-bold">รหัสไปรษณีย์</label>
                        <div class=""><?php echo $rowGetOrder["ship_postcode"] ?></div>
                    </div>
                </div>
            </div>
            <h2 class="page-header text-center mt-4">รายละเอียดสินค้า</h2>
            <div class="row">
                <div class="col-md-12 col-md-offset-2 px-5">


                    <table class="table table-bordered table-striped mt-4">
                        <thead>
                            <th>ชื่อสินค้า</th>
                            <th>หมวดหมู่</th>
                            <th>ราคา</th>
                            <th>จำนวน</th>
                            <th>ยอดรวม</th>
                        </thead>
                        <tbody>

                            <?php
                            $sqlGetOrderLine = "SELECT order_line.*, name, pt_name FROM `order_line`
                         LEFT JOIN products ON products.id = order_line.product_id
                         LEFT JOIN products_type ON products.type = products_type.pt_id
                         WHERE order_id = '" . $_GET['order_id'] . "'";
                            // echo $sqlGetOrder;
                            $resultGetOrderLine = $conn->query($sqlGetOrderLine);

                            // output data of each row
                            while ($rowGetOrderLine = $resultGetOrderLine->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td>
                                        <?php echo $rowGetOrderLine['name']; ?>
                                    </td>
                                    <td>
                                        <?php echo $rowGetOrderLine['pt_name']; ?>
                                    </td>
                                    <td>
                                        <?php echo number_format($rowGetOrderLine['price'], 2); ?>
                                    </td>
                                    <td>
                                        <?php echo $rowGetOrderLine['qty']; ?>
                                    </td>
                                    <td>
                                        <?php echo number_format($rowGetOrderLine['qty'] * $rowGetOrderLine['price'], 2); ?>
                                    </td>

                                </tr>
                            <?php } ?>
                            <tr>
                                <td colspan="4" align="right"><b>รวมทั้งสิ้น</b></td>
                                <td><b><?php echo number_format($rowGetOrder["total"], 2); ?></b></td>
                            </tr>
                        </tbody>
                    </table>


                </div>
            </div>

            <h2 class="page-header text-center mt-4">Payment</h2>
            <div class="row px-5">
                <div class="col-md-12 text-center">
                    <div class="form-group mb-4">
                        <label for="payment" class="form-label fw-bold">ช่องทางการจ่าย</label>
                        <div class=""><?php echo $rowGetOrder["payment_name"] ?></div>
                    </div>
                </div>

                <div class="col-md-12 text-center">
                    <label for="payment" class="form-label fw-bold mt-4">สลิปอัพโหลด</label>
                    <div>
                        <img src="../images/slip/<?php echo $rowGetOrder["slip"] ?>" style="width: 60%;" />
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

        $('#buttonCopy').on('click', function(e) {
            e.preventDefault();
            /* Get the text field */
            let copyText = document.getElementById("inputCopy");
            copyText.readOnly = true;
            copyText.type = 'text';
            copyText.select();
            copyText.setSelectionRange(0, 99999); /* For mobile devices */
            navigator.clipboard.writeText(copyText.value);
            copyText.type = 'hidden';
        });
    </script>

</body>

</html>