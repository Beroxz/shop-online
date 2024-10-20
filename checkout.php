<?php
session_start();
error_reporting(0);
require_once("./config/config.inc.php");

if (empty($_SESSION['user_name']  && $_SESSION["role"] == 1)) {
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
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bulma/bulma.css">
    <style>

    </style>
</head>

<body>
    <?php
    include("./components/navbar.php"); ?>


    <section class="py-4">
        <div class="container px-4 px-lg-5">
            <form class="needs-validation" novalidate method="post" action="" enctype="multipart/form-data">
                <h2 class="page-header text-center mt-4">ข้อมูลผู้สั่งซื้อ</h2>
                <div class="row px-5">
                    <div class="col-md-6">
                        <label for="firstName" class="form-label fw-bold">ชื่อ</label>
                        <input type="text" class="form-control" id="firstName" name="firstName" minlength="3" value="<?php echo $_SESSION["firstname"] ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="lastName" class="form-label fw-bold">นามสกุล</label>
                        <input type="text" class="form-control" id="lastName" name="lastName" minlength="3" value="<?php echo $_SESSION["lastname"] ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label fw-bold">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $_SESSION["email"] ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="tel" class="form-label fw-bold">เบอร์โทร</label>
                        <input type="text" class="form-control" id="tel" name="tel" minlength="10" maxlength="10" value="<?php echo $_SESSION["tel"] ?>" required>
                    </div>
                </div>
                <h2 class="page-header text-center mt-4">จัดส่งที่อยู่</h2>
                <div class="row px-5 g-3">
                    <div class="col-md-8">
                        <label for="ship_address" class="form-label fw-bold">ที่อยู่</label>
                        <input type="text" class="form-control" id="ship_address" name="ship_address" minlength="3" required>
                    </div>
                    <div class="col-12 col-md-4">
                        <?php
                        $sql_provinces = "SELECT * FROM provinces";
                        $query = mysqli_query($conn, $sql_provinces);
                        ?>
                        <div class="form-group">
                            <label for="province" class="form-label fw-bold">จังหวัด</label>
                            <select class="form-control" name="ship_province" id="province" required>
                                <!-- <option value="" disabled>จังหวัด</option> -->
                                <option value="" selected disabled>กรุณาเลือกจังหวัด</option>
                                <?php
                                $sql_provinces = "SELECT * FROM provinces";
                                $query = mysqli_query($conn, $sql_provinces);
                                foreach ($query as $value) {
                                ?>
                                    <option value="<?= $value['id'] ?>"><?= $value['name_th'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="district" class="form-label fw-bold">อำเภอ</label>
                            <select class="form-control" name="ship_district" id="district" required>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="sub_district" class="form-label fw-bold">ตำบล</label>
                            <select class="form-control" name="ship_sub_district" id="sub_district" required>

                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="postcode" class="form-label fw-bold">รหัสไปรษณีย์</label>
                            <input type="text" class="form-control" name="ship_postcode" id="postcode" placeholder="รหัสไปรษณีย์" readonly>
                        </div>
                    </div>
                </div>
                <h2 class="page-header text-center mt-4">รายละเอียดสินค้า</h2>
                <div class="row">
                    <div class="col-md-12 col-md-offset-2 px-5">


                        <table class="table table-bordered table-striped mt-4">
                            <thead>
                                <th>ชื่อสินค้า</th>
                                <th>ราคา</th>
                                <th>จำนวน</th>
                                <th>ยอดรวม</th>
                            </thead>
                            <tbody>
                                <?php
                                //initialize total
                                $total = 0;
                                if (!empty($_SESSION['cart'])) {

                                    $index = 0;
                                    if (!isset($_SESSION['qty_array'])) {
                                        $_SESSION['qty_array'] = array_fill(0, count($_SESSION['cart']), 1);
                                    }
                                    $sql = "SELECT * FROM products WHERE id IN (" . implode(',', $_SESSION['cart']) . ")";
                                    $query = $conn->query($sql);
                                    while ($row = $query->fetch_assoc()) {
                                ?>
                                        <tr>
                                            <td>
                                                <?php echo $row['name']; ?>
                                                <input type="hidden" name="id[]" value="<?php echo $row['id'] ?>" />
                                            </td>
                                            <td>
                                                <?php echo number_format($row['price'], 2); ?>
                                                <input type="hidden" name="price[]" value="<?php echo $row['price'] ?>" />
                                            </td>
                                            <input type="hidden" name="indexes[]" value="<?php echo $index; ?>">
                                            <td><input type="hidden" class="form-control" value="<?php echo $_SESSION['qty_array'][$index]; ?>" name="qty_<?php echo $index; ?>"><?php echo $_SESSION['qty_array'][$index]; ?></td>
                                            <td><?php echo number_format($_SESSION['qty_array'][$index] * $row['price'], 2); ?></td>
                                            <?php $total += $_SESSION['qty_array'][$index] * $row['price']; ?>

                                        </tr>
                                    <?php
                                        $index++;
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="3" class="text-center">No Item in Cart</td>
                                    </tr>
                                <?php
                                }

                                ?>
                                <tr>
                                    <td colspan="3" align="right"><b>รวมทั้งสิ้น</b></td>
                                    <td><b><?php echo number_format($total, 2); ?></b></td>
                                    <input type="hidden" name="total" value="<?php echo $total; ?>">
                                </tr>
                            </tbody>
                        </table>


                    </div>
                </div>

                <h2 class="page-header text-center mt-4">Payment</h2>
                <div class="row px-5">
                    <div class="col-md-12">
                        <div class="form-group mb-4">
                            <label for="payment" class="form-label fw-bold">ช่องทางการจ่าย</label>
                            <select class="form-control" name="payment" id="payment" required>
                                <option value="">กรุณาเลือก</option>
                                <?php
                                $sqlGetProductsType = "SELECT payment_id, payment_name FROM `store_payment` 
                                        LEFT JOIN payment_method ON store_payment.bank_type = payment_method.payment_id
                                        WHERE username = '" . $_SESSION['store'] . "'";
                                // echo $sqlGetProductsType;
                                $resultGetProductsType = $conn->query($sqlGetProductsType);
                                while ($rowGetProductsType = $resultGetProductsType->fetch_assoc()) {


                                ?>
                                    <option value="<?php echo $rowGetProductsType["payment_id"]; ?>"><?php echo $rowGetProductsType["payment_name"]; ?></option>
                                <?php } ?>

                            </select>
                        </div>
                    </div>

                    <div class="col-md-12">


                        <div id="bank">
                            <div id="div_slip"></div>
                            <div align="center">
                                <img id="output" style="width: 60%;" />
                            </div>
                        </div>

                        <div id="gift">
                            <div id="div_gift"></div>
                            <div align="center">
                                <img id="output1" style="width: 60%;" />
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="view-cart" class="btn btn-warning"><i class="bi bi-arrow-left"></i> Back</a>
                        <input type="submit" class="btn btn-primary" name="submit" value="สั่งซื้อสินค้า" />
                    </div>
                </div>


            </form>
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
    <script type="text/javascript">
        $('#province').change(function() {
            var id_province = $(this).val();

            $.ajax({
                type: "POST",
                url: "get_provine.php",
                data: {
                    id: id_province,
                    function: 'province'
                },
                success: function(data) {
                    // console.log(data)
                    $('#district').html(data);
                    $('#sub_district').html(' ');
                    $('#sub_district').val(' ');
                    $('#postcode').val(' ');
                }
            });
        });

        $('#district').change(function() {
            var id_amphures = $(this).val();

            $.ajax({
                type: "POST",
                url: "get_provine.php",
                data: {
                    id: id_amphures,
                    function: 'amphures'
                },
                success: function(data) {
                    $('#sub_district').html(data);
                }
            });
        });

        $('#sub_district').change(function() {
            var id_districts = $(this).val();

            $.ajax({
                type: "POST",
                url: "get_provine.php",
                data: {
                    id: id_districts,
                    function: 'districts'
                },
                success: function(data) {
                    $('#postcode').val(data)
                }
            });

        });
        $('#payment').on('change', function() {
            var selectData = $(this).val();

            // Make AJAX request to fetch payment details
            $.ajax({
                url: 'fetch_payment_details.php',
                method: 'POST',
                data: {
                    selectData: selectData
                },
                success: function(response) {
                    // Parse JSON response
                    var data = JSON.parse(response);
                    // Check if selectData is "1"
                    if (selectData == "1") {
                        $('#div_slip').html(`<div class="d-flex justify-content-between px-5">
                            <div>
                                <p>ธนาคาร: ${data.bank_name}</p>
                                <p>สาขา: ${data.branch}</p>
                            </div>
                            <div>
                                <p>ชื่อบัญชี: ${data.account_name}</p>
                                <p>เลขบัญชี: ${data.account_number}</p>
                            </div>
                        </div>
                        <label for="imgSlip" class="form-label fw-bold mt-4">อัพโหลดสลิป</label>

<input class="form-control" type="file" id="imgSlip" name="imgSlip" accept="image/png, image/jpg, image/jpeg" onchange="loadFile(event)" required> `);
                    } else {
                        // Otherwise, hide it
                        $('#div_slip').html("");
                    }

                    // Check if selectData is "2"
                    if (selectData == "2") {
                        $('#div_gift').html(`<div class="d-flex justify-content-center px-5">
                            <div class="text-center">
                                <img src="./images/qr-store/${data.qr_code ? data.qr_code : "-"}" class="" style="width:50%;" />
                                <p class="fs-5 mb-4">${data.account_name}</p>
                            </div>
                        </div>
                        <label for="imgSlip" class="form-label fw-bold mt-4">อัพโหลดสลิป</label>

                        <input class="form-control" type="file" id="imgSlip" name="imgSlip" accept="image/png, image/jpg, image/jpeg" onchange="loadFile1(event)" required>`);
                    } else {
                        // Otherwise, hide it
                        $('#div_gift').html("");
                    }
                }
            });
        });

        let loadFile = function(event) {
            let output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src)
            }
        };

        let loadFile1 = function(event) {
            let output1 = document.getElementById('output1');
            output1.src = URL.createObjectURL(event.target.files[0]);
            output1.onload = function() {
                URL.revokeObjectURL(output1.src)
            }
        };
    </script>

    <?php
    if (isset($_POST["submit"])) {
        $ship_address = $conn->real_escape_string($_POST['ship_address']);
        $ship_province = $conn->real_escape_string($_POST['ship_province']);
        $ship_district = $conn->real_escape_string($_POST['ship_district']);
        $ship_sub_district = $conn->real_escape_string($_POST['ship_sub_district']);
        $ship_postcode = $conn->real_escape_string($_POST['ship_postcode']);
        $payment = $conn->real_escape_string($_POST['payment']);
        $total = $conn->real_escape_string($_POST['total']);


        $strNextSeq = "";

        $strSQL = "SELECT * FROM prefix_order WHERE 1";
        $objQuery = mysqli_query($conn, $strSQL) or die("Error Query [" . $strSQL . "]");
        $objResult = mysqli_fetch_array($objQuery);

        if ($objResult["val"] == date("Y") . "" . date("m")) {
            $Seq = substr("0000" . $objResult["seq"], -4, 4);
            $strNextSeq = "ORDER" . "" . substr($objResult["val"], 2) . "" . $Seq;

            $strSQL = "UPDATE prefix_order SET seq= seq+1";
            $objQuery = mysqli_query($conn, $strSQL) or die("Error Query [" . $strSQL . "]");
        } else {
            $Seq = substr("0001", -4, 4);
            $strNextSeq = "ORDER" . "" . substr(date("Y") . "" . date("m"), 2) . "" . $Seq;


            $strSQL = "UPDATE prefix_order SET val = '" . date("Y") . "" . date("m") . "' , seq = '1'";
            $objQuery = mysqli_query($conn, $strSQL) or die("Error Query [" . $strSQL . "]");
        }

        if (!empty($_FILES['imgSlip']['tmp_name'])) {
            $imgPro1 = $_FILES['imgSlip']['tmp_name'];
            $imgPro1_name = $_FILES['imgSlip']['name'];
            $array_lastimgPro1 = explode(".", $imgPro1_name);
            $c_imgPro1 = count($array_lastimgPro1) - 1;
            $last_imgPro1_name = strtolower($array_lastimgPro1[$c_imgPro1]);
            $namePro1 = "imgSlip" . date("YmdHis") . "_1." . $last_imgPro1_name;
            copy($imgPro1, "./images/slip/" . $namePro1);
        } else {
            $namePro1 = "";
        }

        $sqlOrderHeader =  "INSERT INTO `order_header`(`order_id`, `cus_id`, 
        `ship_address`, `ship_sub_district`, `ship_district`, 
        `ship_province`, `ship_postcode`, `total`, 
        `payment`, `slip`, `parcel_number`, 
        `status`, `store_id`, `created_at`) VALUES ('" . strtoupper($strNextSeq) . "','" . $_SESSION["user_name"] . "',
        '" . $ship_address . "','" . $ship_sub_district . "','" . $ship_district . "',
        '" . $ship_province . "','" . $ship_postcode . "','" . $total . "',
        '" . $payment . "','" . $namePro1 . "','',
        '0','" . $_SESSION['store'] . "','" . date('Y-m-d H:i:s') . "')";

        $queryOrderHeader = mysqli_query($conn, $sqlOrderHeader);

        foreach ($_SESSION["cart"] as $x => $item) {

            $sqlOrderDetail = "INSERT INTO `order_line`(`order_id`, `line`, 
            `product_id`, `qty`, `price`) VALUES ('" . strtoupper($strNextSeq) . "','" . ($x + 1) . "0000',
            '" . $conn->real_escape_string($_POST['id'][$x]) . "',
            '" . $conn->real_escape_string($_POST['qty_'.$x]) . "',
            '" . $conn->real_escape_string($_POST['price'][$x]) . "')";

            //     // echo $sqlBookingHeader;
            $queryOrderDetail = mysqli_query($conn, $sqlOrderDetail);
        }
        if ($queryOrderHeader) {

                   
               
                   
    ?>
                    <script type="text/javascript">
                        swal.fire({
                            title: "Successfully",
                            text: "สั่งซื้อสินค้าสำเร็จ.",
                            icon: "success",
                            allowOutsideClick: false,
                            timer: 1500,
                        }).then(function() {
                            window.location.href = 'index';
                            // window.location.href = 'mail_user?email=// $email ?>&name=<php //$name ?>&type=<php //$type ?>';
                        })
                    </script>

            <?php
            unset($_SESSION['cart']);
            unset($_SESSION['store']);
        } else {
            ?>
            <script type="text/javascript">
                swal.fire({
                    title: "สั่งซื้อสินค้าไม่สำเร็จ",
                    // text: "กรอกใหม่อีกครั้ง",
                    icon: "error",
                    allowOutsideClick: false
                }).then(function() {
                    window.location.href = 'checkout';
                    // window.location.href = 'mail_user?email=// $email ?>&name=<php //$name ?>&type=<php //$type ?>';
                })
            </script>
    <?php

        }
    }
    ?>

</body>

</html>