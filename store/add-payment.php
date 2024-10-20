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
                            <h2 class="text-center fw-bold">เพิ่มบัญชีธนาคาร</h2>
                            <form class="row g-3 mt-2 needs-validation" novalidate method="post" action="" enctype="multipart/form-data">
                                <div class="col-md-12 mb-3">
                                    <label for="bank_type" class="form-label fw-bold">ช่องทางการชำระเงิน <span class="text-danger">*</span></label>
                                    <select class="form-select" aria-label="bank_type" id="bank_type" name="bank_type" required>
                                        <option value="" disabled selected>กรุณาเลือกช่องทางการชำระเงิน</option>
                                        <?php
                                        $sqlGetPayment = "SELECT * FROM `payment_method`";
                                        $resultGetPayment = $conn->query($sqlGetPayment);
                                        while ($rowGetPayment = $resultGetPayment->fetch_assoc()) {

                                        ?>
                                            <option value="<?php echo $rowGetPayment["payment_id"]; ?>"><?php echo $rowGetPayment["payment_name"]; ?></option>
                                        <?php } ?>
                                    </select>

                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="bank" class="form-label fw-bold">ธนาคาร</label>
                                    <select class="form-select" aria-label="bank" id="bank" name="bank">
                                        <option value="" disabled selected>กรุณาเลือกธนาคาร</option>
                                        <?php
                                        $sqlGetBank = "SELECT * FROM `bank`";
                                        $resultGetBank = $conn->query($sqlGetBank);
                                        while ($rowGetBank = $resultGetBank->fetch_assoc()) {

                                        ?>
                                            <option value="<?php echo $rowGetBank["bank_id"]; ?>"><?php echo $rowGetBank["bank_name"]; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="account_name" class="form-label fw-bold">ชื่อบัญชี<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control rounded-3" id="account_name" name="account_name" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="branch" class="form-label fw-bold">สาขา</label>
                                    <input type="text" class="form-control rounded-3" id="branch" name="branch">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="account_type" class="form-label fw-bold">ประเภทบัญชี</label>
                                    <input type="text" class="form-control rounded-3" id="account_type" name="account_type">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="account_number" class="form-label fw-bold">เลขที่บัญชี<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control rounded-3" id="account_number" name="account_number" minlength="8" maxlength="15" required>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="qr_code" class="form-label fw-bold">Qr Code</label>
                                    <input class="form-control" type="file" id="qr_code" name="qr_code" accept="image/png, image/jpg, image/jpeg" onchange="loadFile(event)">
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
      
    </script>
    <?php
    if (!empty($_POST["submit"])) {
        $bank_type = $conn->real_escape_string($_POST['bank_type']);
        $bank = $conn->real_escape_string($_POST['bank']);
        $account_name = $conn->real_escape_string($_POST['account_name']);
        $branch = $conn->real_escape_string($_POST['branch']);
        $account_type = $conn->real_escape_string($_POST['account_type']);
        $account_number = $conn->real_escape_string($_POST['account_number']);
        // $qr_code = $conn->real_escape_string($_POST['qr_code']);

        $check = "SELECT * FROM store_payment WHERE account_number = '$account_number'";
        // echo $check;
        $resultCheck = mysqli_query($conn, $check);
        $fetch = mysqli_fetch_assoc($resultCheck);
        $num = mysqli_num_rows($resultCheck);
        if ($num > 0) {
            echo  '<script type="text/javascript">
        
            swal.fire({
                title: "Oops!!!",
                text: "บัญชีนี้มีอยู่แล้ว!!",
                icon: "warning",
                allowOutsideClick: false
            })
        </script>';
        } else {
            if (!empty($_FILES['qr_code']['tmp_name'])) {
                $imgPro1 = $_FILES['qr_code']['tmp_name'];
                $imgPro1_name = $_FILES['qr_code']['name'];
                $array_lastimgPro1 = explode(".", $imgPro1_name);
                $c_imgPro1 = count($array_lastimgPro1) - 1;
                $last_imgPro1_name = strtolower($array_lastimgPro1[$c_imgPro1]);
                $namePro1 = "qr-code-" . date("YmdHis") . "_1." . $last_imgPro1_name;
                copy($imgPro1, "../images/qr-store/" . $namePro1);
            } else {
                $namePro1 = "";
            }

            $sqlInStorePayment = "INSERT INTO `store_payment`(`bank`, `account_name`, 
            `branch`, `account_type`, `account_number`, 
            `bank_type`, `qr_code`, `username`, created_at) VALUES ('" . $bank . "','" . $account_name . "',
            '" . $branch . "','" . $account_type . "','" . $account_number . "',
            '" . $bank_type . "','" . $namePro1 . "','" . $_SESSION["user_name"] . "', '" .date('Y-m-d H:i:s'). "')";

            $resInStorePayment = mysqli_query($conn, $sqlInStorePayment);
            if ($resInStorePayment) {
    ?>
                <script type="text/javascript">
                    swal.fire({
                        title: "Successfully",
                        html: "เพิ่มบัญชีสำเร็จแล้ว",
                        icon: "success",
                        timer: 2000,
                        allowOutsideClick: false
                    }).then(function() {
                        window.location.href = 'manage-payment';
                    })
                </script>

            <?php   } else {
            ?>
                <script type="text/javascript">
                    swal.fire({
                        title: "Oops Error...",
                        text: "เพิ่มบบัญชีไม่สำเร็จแล้ว",
                        icon: "error",
                        allowOutsideClick: false
                    }).then(function() {
                        window.location.href = 'add-payment';
                    })
                </script>
    <?php
            }
        }
    }
    ?>

</body>

</html>