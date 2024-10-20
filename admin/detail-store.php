<?php
error_reporting(0);
require_once("../config/config.inc.php");
session_start();

$sqlGetUsers = "SELECT stores.*, 
p1.name_th as personal_province, 
a1.name_th as personal_district, 
d1.name_th as personal_sub_district, 
p2.name_th as store_province, 
a2.name_th as store_district, 
d2.name_th as store_sub_district,
pt_name
FROM stores
LEFT JOIN provinces p1 ON p1.id = stores.personal_province
LEFT JOIN amphures a1 ON a1.id = stores.personal_district
LEFT JOIN districts d1 ON d1.id = stores.personal_sub_district
LEFT JOIN provinces p2 ON p2.id = stores.store_province
LEFT JOIN amphures a2 ON a2.id = stores.store_district
LEFT JOIN districts d2 ON d2.id = stores.store_sub_district
LEFT JOIN products_type ON products_type.pt_id = stores.store_category
WHERE user_name = '" . $_GET["username"] . "';";
$resultGetUsers = $conn->query($sqlGetUsers);

$rowGetUsers = $resultGetUsers->fetch_assoc();

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
    <link rel="icon" type="image/x-icon" href="../assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bulma/bulma.css">

</head>

<body class="d-flex flex-column min-vh-100">
    <!-- Navigation-->
    <?php include("./components/navbar.php"); ?>

    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-4">
            <div class="row gx-4 gx-lg-5 row-cols-1 row-cols-md-1 row-cols-xl-1 justify-content-center">
                <div class="col mb-5">
                    <div class="card h-100 shadow rounded-4">
                        <div class="card-body px-5 py-5">
                            <h3 class="text-center fw-bold mb-4">รายละเอียดร้านค้า : <?php echo $_GET["username"] ?> </h3>
                            <div class="row g-3">

                                <div class="d-flex justify-content-center">
                                    <h3 class="fw-bold fs-4" style="border-bottom: 3px solid #a6d445; padding-bottom: 3px;">ข้อมูลสมาชิก</h3>
                                </div>
                                <div class="col-md-4">
                                    <label for="firstName" class="form-label fw-bold">ชื่อ</label>
                                    <div class=""><?php echo $rowGetUsers["firstname"] ?></div>
                                </div>
                                <div class="col-md-4">
                                    <label for="lastName" class="form-label fw-bold">นามสกุล</label>

                                    <div class=""><?php echo $rowGetUsers["lastname"] ?></div>
                                </div>
                                <div class="col-md-4">
                                    <label for="email" class="form-label fw-bold text-start">เพศ</label>
                                    <div class=""><?php
                                                    if ($rowGetUsers["sex"] == 1) {
                                                        echo "ชาย";
                                                    } elseif ($rowGetUsers["sex"] == 2) {
                                                        echo "หญิง";
                                                    } ?></div>

                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="birth_date" class="form-label fw-bold">วันเกิด</label>
                                    <div class=""><?php
                                                    $timestamp = strtotime($rowGetUsers["birth_date"]);

                                                    // Format the date in Thai
                                                    $formattedDate = strftime("%d/%m/%Y", $timestamp);
                                                    echo $formattedDate ?></div>

                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="id_card_number" class="form-label fw-bold">บัตรประชาชน 13 หลัก </label>
                                    <div class=""><?php echo $rowGetUsers["id_card_number"] ?></div>

                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="img_id_card" class="form-label fw-bold">สำเนาบัตรประชาชน </label>

                                    <?php if ($rowGetUsers["img_id_card"]) { ?>
                                    <div class="mt-4" align="center">
                                        <img src="../images/id-card/<?php echo $rowGetUsers["img_id_card"] ?>" class="mb-4 rounded-2 shadow" id="output" style="width: 60%;" />
                                    </div>
                                    <?php } else {
                                        echo "-";
                                    } ?>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="img_house_registration" class="form-label fw-bold">สำเนาทะเบียนบ้าน</label>

                                    <?php if ($rowGetUsers["img_house_registration"]) { ?>
                                    <div class="mt-4" align="center">
                                        <img src="../images/house-registration/<?php echo $rowGetUsers["img_house_registration"] ?>" class="mb-4 rounded-2 shadow" id="output1" style="width: 60%;" />
                                    </div>
                                    <?php } else {
                                        echo "-";
                                    } ?>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="personal_address" class="form-label fw-bold">ที่อยู่</label>
                                    <div class=""><?php echo $rowGetUsers["personal_address"] ?></div>

                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="personal_province" class="form-label fw-bold">จังหวัด</label>
                                    <div class=""><?php echo $rowGetUsers["personal_province"] ?></div>

                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="personal_district" class="form-label fw-bold">อำเภอ</label>
                                    <div class=""><?php echo $rowGetUsers["personal_district"] ?></div>

                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="personal_sub_district" class="form-label fw-bold">ตำบล</label>
                                    <div class=""><?php echo $rowGetUsers["personal_sub_district"] ?></div>

                                </div>


                                <div class="col-md-4 mb-3">
                                    <label for="personal_postcode" class="form-label fw-bold">ไปรษณีย์</label>
                                    <div class=""><?php echo $rowGetUsers["personal_postcode"] ?></div>

                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="personal_tel" class="form-label fw-bold">เบอร์โทรศัพท์</label>
                                    <div class=""><?php echo $rowGetUsers["personal_tel"] ?></div>

                                </div>
                                <div class="d-flex justify-content-center mt-4">
                                    <h3 class="fw-bold fs-4" style="border-bottom: 3px solid #a6d445; padding-bottom: 3px;">ข้อมูลร้านค้า</h3>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="store_name" class="form-label fw-bold">ชื่อร้านค้า</label>
                                    <div class=""><?php echo $rowGetUsers["store_name"] ?></div>

                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="store_category" class="form-label fw-bold">หมวดหมู่ร้านค้า</label>
                                    <div class=""><?php echo $rowGetUsers["pt_name"] ?></div>


                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="store_email" class="form-label fw-bold">E-mail ร้านค้า</label>
                                    <div class=""><?php echo $rowGetUsers["store_email"] ?></div>

                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="store_description" class="form-label fw-bold">รายละเอียดร้านค้า</label>
                                    <div class=""><?php echo $rowGetUsers["store_description"] ?></div>

                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="store_address" class="form-label fw-bold">ที่อยู่</label>
                                    <div class=""><?php echo $rowGetUsers["store_address"] ?></div>

                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="store_province" class="form-label fw-bold">จังหวัด</label>
                                    <div class=""><?php echo $rowGetUsers["store_province"] ?></div>

                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="store_district" class="form-label fw-bold">อำเภอ</label>
                                    <div class=""><?php echo $rowGetUsers["store_district"] ?></div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="store_sub_district" class="form-label fw-bold">ตำบล</label>
                                    <div class=""><?php echo $rowGetUsers["store_sub_district"] ?></div>
                                </div>


                                <div class="col-md-4 mb-3">
                                    <label for="store_postcode" class="form-label fw-bold">ไปรษณีย์</label>
                                    <div class=""><?php echo $rowGetUsers["store_postcode"] ?></div>

                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="store_tel" class="form-label fw-bold">เบอร์โทรศัพท์</label>
                                    <div class=""><?php echo $rowGetUsers["store_tel"] ?></div>

                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="store_image" class="form-label fw-bold">รูปภาพร้าน</label>

                                    <?php if ($rowGetUsers["store_image"]) { ?>
                                        <div class="mt-4" align="center">
                                            <img src="../images/store-image/<?php echo $rowGetUsers["store_image"] ?>" class="mb-4 rounded-2 shadow" id="output1" style="width: 60%;" />

                                        </div>
                                    <?php } else {
                                        echo "-";
                                    } ?>
                                </div>
                                <div class="d-flex justify-content-center mt-4">
                                    <h3 class="fw-bold fs-4" style="border-bottom: 3px solid #a6d445; padding-bottom: 3px;">Package การใช้บริการ</h3>
                                </div>
                                <div class="col-md-4">
                                    <label for="package" class="form-label fw-bold text-start me-5">Package</label>
                                    <div class=""><?php echo $rowGetUsers["package"] ? "Basic" : "-" ?></div>

                                </div>


                            </div>
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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

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
        $firstName = $conn->real_escape_string($_POST['firstName']);
        $lastName = $conn->real_escape_string($_POST['lastName']);
        $email = $conn->real_escape_string($_POST['email']);
        $password = $_POST['password'] ? $conn->real_escape_string($_POST['password']) : $conn->real_escape_string($_POST['passwordOld']);
        $role = $conn->real_escape_string($_POST['role']);

        $sqlUpCustomers = "UPDATE `customers` SET `firstname`='" . $firstName . "',
`lastname`='" . $lastName . "',
`email`='" . $email . "',
`password`='" . $password . "'
WHERE `user_name` = '" . $_GET["username"] . "' and `role` = '" . $role . "'";




        $resUpCustomers = mysqli_query($conn, $sqlUpCustomers);



        if ($resUpCustomers) {
            if ($role == 1) {
    ?>
                <script type="text/javascript">
                    swal.fire({
                        title: "สมาชิกทั่วไป",
                        html: "อัพเดทข้อมูลสมาชิกสำเร็จแล้ว",
                        icon: "success",
                        timer: 1500,
                        allowOutsideClick: false
                    }).then(function() {
                        window.location.href = './general-users';
                    })
                </script>

            <?php  } elseif ($role == 2) {
            ?>
                <script type="text/javascript">
                    swal.fire({
                        title: "สมาชิกร้านค้า mod",
                        html: "อัพเดทข้อมูลสมาชิกสำเร็จแล้ว",
                        icon: "success",
                        timer: 1500,
                        allowOutsideClick: false
                    }).then(function() {
                        window.location.href = './store-mod-users';
                    })
                </script>

            <?php
            }
        } else {
            ?>
            <script type="text/javascript">
                swal.fire({
                    title: "Oops Error...",
                    text: "อัพเดทข้อมูลสมาชิกไม่สำเร็จ",
                    icon: "error",
                    allowOutsideClick: false
                }).then(function() {
                    window.location.href = './edit-customer';
                })
            </script>
    <?php
        }
    }
    ?>
</body>

</html>