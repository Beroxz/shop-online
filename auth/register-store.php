<?php
error_reporting(0);
require_once("../config/config.inc.php");
session_start();
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
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
                            <h1 class="text-center fw-bold">สมัครสมาชิกร้านค้า</h1>
                            <form class="row g-3 mt-3 needs-validation" novalidate method="post" action="" enctype="multipart/form-data">
                                <div class="d-flex justify-content-center">
                                    <h3 class="fw-bold fs-4" style="border-bottom: 3px solid #a6d445; padding-bottom: 3px;">ข้อมูลสมาชิก</h3>
                                </div>
                                <div class="col-md-4">
                                    <label for="firstName" class="form-label fw-bold">ชื่อ <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="firstName" name="firstName" minlength="3" value="<?php echo $_POST["firstName"] ?>" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="lastName" class="form-label fw-bold">นามสกุล<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="lastName" name="lastName" minlength="3" value="<?php echo $_POST["lastName"] ?>" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="email" class="form-label fw-bold text-start">เพศ</label>
                                    <div class="d-flex justify-content-around text-start">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="sex" id="sex1" value="1" checked>
                                            <label class="form-check-label" for="sex1">ชาย</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="sex" id="sex2" value="2">
                                            <label class="form-check-label" for="sex2">หญิง</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="birth_date" class="form-label fw-bold">วันเกิด<span class="text-danger">*</span></label>
                                    <input type="date" class="form-control rounded-3" id="birth_date" name="birth_date" value="<?php echo $_POST["birth_date"] ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="id_card_number" class="form-label fw-bold">บัตรประชาชน 13 หลัก <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control rounded-3" id="id_card_number" name="id_card_number" minlength="13" maxlength="13" value="<?php echo $_POST["id_card_number"] ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="img_id_card" class="form-label fw-bold">สำเนาบัตรประชาชน <span class="text-danger">*</span></label>
                                    <input class="form-control" type="file" id="img_id_card" name="img_id_card" accept="image/png, image/jpg, image/jpeg" onchange="loadFile(event)" required>
                                    <div class="mt-4" align="center">
                                        <img class="mb-4 rounded-2 shadow" id="output" style="width: 60%;" />
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="img_house_registration" class="form-label fw-bold">สำเนาทะเบียนบ้าน<span class="text-danger">*</span></label>
                                    <input class="form-control" type="file" id="img_house_registration" name="img_house_registration" accept="image/png, image/jpg, image/jpeg" onchange="loadFile1(event)" required>
                                    <div class="mt-4" align="center">
                                        <img class="mb-4 rounded-2 shadow" id="output1" style="width: 60%;" />
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="personal_address" class="form-label fw-bold">ที่อยู่<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control rounded-3" id="personal_address" name="personal_address" value="<?php echo $_POST["personal_address"] ?>" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="personal_province" class="form-label fw-bold">จังหวัด<span class="text-danger">*</span></label>
                                    <select class="form-control" name="personal_province" id="personal_province" required>
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
                                <div class="col-md-4 mb-3">
                                    <label for="personal_district" class="form-label fw-bold">อำเภอ<span class="text-danger">*</span></label>
                                    <select class="form-control" name="personal_district" id="personal_district" required>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="personal_sub_district" class="form-label fw-bold">ตำบล<span class="text-danger">*</span></label>
                                    <select class="form-control" name="personal_sub_district" id="personal_sub_district" required>

                                    </select>
                                </div>


                                <div class="col-md-4 mb-3">
                                    <label for="personal_postcode" class="form-label fw-bold">ไปรษณีย์</label>
                                    <input type="text" class="form-control" name="personal_postcode" id="personal_postcode" placeholder="รหัสไปรษณีย์" readonly>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="personal_tel" class="form-label fw-bold">เบอร์โทรศัพท์<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control rounded-3" id="personal_tel" name="personal_tel" value="<?php echo $_POST["personal_tel"] ?>" minlength="10" maxlength="10" required>
                                </div>
                                <div class="d-flex justify-content-center mt-4">
                                    <h3 class="fw-bold fs-4" style="border-bottom: 3px solid #a6d445; padding-bottom: 3px;">ข้อมูลร้านค้า</h3>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="store_name" class="form-label fw-bold">ชื่อร้านค้า<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control rounded-3" id="store_name" name="store_name" value="<?php echo $_POST["store_name"] ?>" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="store_email" class="form-label fw-bold">E-mail ร้านค้า<span class="text-danger">*</span></label>
                                    <input type="email" class="form-control rounded-3" id="store_email" name="store_email" value="<?php echo $_POST["store_email"] ?>" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="store_category" class="form-label fw-bold">หมวดหมู่ร้านค้า<span class="text-danger">*</span></label>
                                    <select class="form-control" name="store_category" id="store_category" required>
                                        <!-- <option value="" disabled>จังหวัด</option> -->
                                        <option value="" selected disabled>กรุณาเลือกหมวดหมู่ร้านค้า</option>
                                        <?php
                                        $sql_provinces = "SELECT * FROM products_type order by pt_id desc";
                                        $query = mysqli_query($conn, $sql_provinces);
                                        foreach ($query as $value) {
                                            
                                        ?>
                                            <option value="<?= $value['pt_id'] ?>"><?= $value['pt_name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="store_description" class="form-label fw-bold">รายละเอียดร้านค้า<span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="store_description" name="store_description" rows="5" required><?php echo $_POST["store_description"]? $_POST["store_description"]:"" ?></textarea>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="store_address" class="form-label fw-bold">ที่อยู่<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control rounded-3" id="store_address" name="store_address" value="<?php echo $_POST["store_address"] ?>" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="store_province" class="form-label fw-bold">จังหวัด<span class="text-danger">*</span></label>
                                    <select class="form-control" name="store_province" id="store_province" required>
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
                                <div class="col-md-4 mb-3">
                                    <label for="store_district" class="form-label fw-bold">อำเภอ<span class="text-danger">*</span></label>
                                    <select class="form-control" name="store_district" id="store_district" required>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="store_sub_district" class="form-label fw-bold">ตำบล<span class="text-danger">*</span></label>
                                    <select class="form-control" name="store_sub_district" id="store_sub_district" required>

                                    </select>
                                </div>


                                <div class="col-md-4 mb-3">
                                    <label for="store_postcode" class="form-label fw-bold">ไปรษณีย์</label>
                                    <input type="text" class="form-control" name="store_postcode" id="store_postcode" placeholder="รหัสไปรษณีย์" readonly>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="store_tel" class="form-label fw-bold">เบอร์โทรศัพท์<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control rounded-3" id="store_tel" name="store_tel" value="<?php echo $_POST["store_tel"] ?>" minlength="10" maxlength="10" required>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="store_image" class="form-label fw-bold">รูปภาพร้าน</label>
                                    <input class="form-control" type="file" id="store_image" name="store_image" accept="image/png, image/jpg, image/jpeg" onchange="loadFile2(event)">

                                    <div class="mt-4" align="center">
                                        <img class="mb-4 rounded-2 shadow" id="output2" style="width: 60%;" />
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center mt-4">
                                    <h3 class="fw-bold fs-4" style="border-bottom: 3px solid #a6d445; padding-bottom: 3px;">Package การใช้บริการ</h3>
                                </div>
                                <div class="col-md-4">
                                    <label for="package" class="form-label fw-bold text-start me-5">Package</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="package" id="package" value="1" checked>
                                        <label class="form-check-label" for="package">Basic</label>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center mt-4">
                                    <h3 class="fw-bold fs-4" style="border-bottom: 3px solid #a6d445; padding-bottom: 3px;">Username & Password</h3>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="username" class="form-label fw-bold">Username<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control rounded-3" id="username" name="username" value="<?php echo $_POST["username"] ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label fw-bold">Password<span class="text-danger">*</span></label>
                                    <input type="password" class="form-control rounded-3" id="password" name="password" minlength="8" required>
                                </div>
                                <div class="text-center mt-4">
                                    <input type="submit" class="btn btn-primary rounded-2 fw-bold" value="สมัครสมาชิก" name="submit" />
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
    <script type="text/javascript">
        $('#personal_province').change(function() {
            var personal_province = $(this).val();

            $.ajax({
                type: "POST",
                url: "get_provine.php",
                data: {
                    id: personal_province,
                    function: 'province'
                },
                success: function(data) {
                    // console.log(data)
                    $('#personal_district').html(data);
                    $('#personal_sub_district').html(' ');
                    $('#personal_sub_district').val(' ');
                    $('#personal_postcode').val(' ');
                }
            });
        });

        $('#personal_district').change(function() {
            var personal_district = $(this).val();

            $.ajax({
                type: "POST",
                url: "get_provine.php",
                data: {
                    id: personal_district,
                    function: 'amphures'
                },
                success: function(data) {
                    $('#personal_sub_district').html(data);
                }
            });
        });

        $('#personal_sub_district').change(function() {
            var personal_sub_district = $(this).val();

            $.ajax({
                type: "POST",
                url: "get_provine.php",
                data: {
                    id: personal_sub_district,
                    function: 'districts'
                },
                success: function(data) {
                    $('#personal_postcode').val(data)
                }
            });

        });



        $('#store_province').change(function() {
            var store_province = $(this).val();

            $.ajax({
                type: "POST",
                url: "get_provine.php",
                data: {
                    id: store_province,
                    function: 'province'
                },
                success: function(data) {
                    // console.log(data)
                    $('#store_district').html(data);
                    $('#store_sub_district').html(' ');
                    $('#store_sub_district').val(' ');
                    $('#store_postcode').val(' ');
                }
            });
        });

        $('#store_district').change(function() {
            var store_district = $(this).val();

            $.ajax({
                type: "POST",
                url: "get_provine.php",
                data: {
                    id: store_district,
                    function: 'amphures'
                },
                success: function(data) {
                    $('#store_sub_district').html(data);
                }
            });
        });

        $('#store_sub_district').change(function() {
            var store_sub_district = $(this).val();

            $.ajax({
                type: "POST",
                url: "get_provine.php",
                data: {
                    id: store_sub_district,
                    function: 'districts'
                },
                success: function(data) {
                    $('#store_postcode').val(data)
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
        let loadFile2 = function(event) {
            let output2 = document.getElementById('output2');
            output2.src = URL.createObjectURL(event.target.files[0]);
            output2.onload = function() {
                URL.revokeObjectURL(output2.src)
            }
        };
    </script>
    <?php
    function valid_citizen_id($personID)
    {

        if (strlen($personID) != 13) {
            return false;
        }

        $rev = strrev($personID); // reverse string ขั้นที่ 0 เตรียมตัว
        $total = 0;
        for ($i = 1; $i < 13; $i++) // ขั้นตอนที่ 1 - เอาเลข 12 หลักมา เขียนแยกหลักกันก่อน
        {
            $mul = $i + 1;
            $count = $rev[$i] * $mul; // ขั้นตอนที่ 2 - เอาเลข 12 หลักนั้นมา คูณเข้ากับเลขประจำหลักของมัน
            $total = $total + $count; // ขั้นตอนที่ 3 - เอาผลคูณทั้ง 12 ตัวมา บวกกันทั้งหมด
        }
        $mod = $total % 11; //ขั้นตอนที่ 4 - เอาเลขที่ได้จากขั้นตอนที่ 3 มา mod 11 (หารเอาเศษ)
        $sub = 11 - $mod; //ขั้นตอนที่ 5 - เอา 11 ตั้ง ลบออกด้วย เลขที่ได้จากขั้นตอนที่ 4
        $check_digit = $sub % 10; //ถ้าเกิด ลบแล้วได้ออกมาเป็นเลข 2 หลัก ให้เอาเลขในหลักหน่วยมาเป็น Check Digit

        if ($rev[0] == $check_digit)  // ตรวจสอบ ค่าที่ได้ กับ เลขตัวสุดท้ายของ บัตรประจำตัวประชาชน
            return true; /// ถ้า ตรงกัน แสดงว่าถูก
        else
            return false; // ไม่ตรงกันแสดงว่าผิด

    }

    if (!empty($_POST["submit"])) {
        if (valid_citizen_id($_POST['id_card_number'])) {
            $firstName = $conn->real_escape_string($_POST['firstName']);
            $lastName = $conn->real_escape_string($_POST['lastName']);
            $sex = $conn->real_escape_string($_POST['sex']);
            $birth_date = $conn->real_escape_string($_POST['birth_date']);
            $id_card_number = $conn->real_escape_string($_POST['id_card_number']);
            // $img_id_card = $conn->real_escape_string($_POST['img_id_card']);
            // $img_house_registration = $conn->real_escape_string($_POST['img_house_registration']);
            $personal_address = $conn->real_escape_string($_POST['personal_address']);
            $personal_province = $conn->real_escape_string($_POST['personal_province']);
            $personal_district = $conn->real_escape_string($_POST['personal_district']);
            $personal_sub_district = $conn->real_escape_string($_POST['personal_sub_district']);
            $personal_postcode = $conn->real_escape_string($_POST['personal_postcode']);
            $personal_tel = $conn->real_escape_string($_POST['personal_tel']);

            $store_name = $conn->real_escape_string($_POST['store_name']);
            $store_email = $conn->real_escape_string($_POST['store_email']);
            $store_category = $conn->real_escape_string($_POST['store_category']);
            $store_description = $conn->real_escape_string($_POST['store_description']);
            $store_address = $conn->real_escape_string($_POST['store_address']);
            $store_province = $conn->real_escape_string($_POST['store_province']);
            $store_district = $conn->real_escape_string($_POST['store_district']);
            $store_sub_district = $conn->real_escape_string($_POST['store_sub_district']);
            $store_postcode = $conn->real_escape_string($_POST['store_postcode']);
            $store_tel = $conn->real_escape_string($_POST['store_tel']);
            // $store_image = $conn->real_escape_string($_POST['store_image']);

            $package = $conn->real_escape_string($_POST['package']);

            $username = $conn->real_escape_string($_POST['username']);
            $password = $conn->real_escape_string($_POST['password']);

            $sqlStore = "SELECT * FROM stores WHERE user_name = '" . $username . "'";
            $queryStore = mysqli_query($conn, $sqlStore);
            $fetchStore = mysqli_fetch_assoc($queryStore);
            $rowcountStore = mysqli_num_rows($queryStore);

            if ($rowcountStore > 0) {

    ?>
                <script type="text/javascript">
                    Swal.fire(
                            'กรุณากรอกใหม่',
                            'Username นี้มีอยู่ในระบบแล้ว!!!',
                            'error'
                        ),
                        setTimeout(function() {
                            window.location.href = "./register-store";
                        }, 1500);
                </script>

                <?php


            } else {
                if (!empty($_FILES['img_id_card']['tmp_name'])) {
                    $imgPro1 = $_FILES['img_id_card']['tmp_name'];
                    $imgPro1_name = $_FILES['img_id_card']['name'];
                    $array_lastimgPro1 = explode(".", $imgPro1_name);
                    $c_imgPro1 = count($array_lastimgPro1) - 1;
                    $last_imgPro1_name = strtolower($array_lastimgPro1[$c_imgPro1]);
                    $namePro1 = "img-id-card-" . date("YmdHis") . "_1." . $last_imgPro1_name;
                    copy($imgPro1, "../images/id-card/" . $namePro1);
                } else {
                    $namePro1 = "";
                }


                if (!empty($_FILES['img_house_registration']['tmp_name'])) {
                    $imgPro2 = $_FILES['img_house_registration']['tmp_name'];
                    $imgPro2_name = $_FILES['img_house_registration']['name'];
                    $array_lastimgPro2 = explode(".", $imgPro2_name);
                    $c_imgPro2 = count($array_lastimgPro2) - 1;
                    $last_imgPro2_name = strtolower($array_lastimgPro2[$c_imgPro2]);
                    $namePro2 = "img-house-registration-" . date("YmdHis") . "_1." . $last_imgPro2_name;
                    copy($imgPro2, "../images/house-registration/" . $namePro2);
                } else {
                    $namePro2 = "";
                }


                if (!empty($_FILES['store_image']['tmp_name'])) {
                    $imgPro3 = $_FILES['store_image']['tmp_name'];
                    $imgPro3_name = $_FILES['store_image']['name'];
                    $array_lastimgPro3 = explode(".", $imgPro3_name);
                    $c_imgPro3 = count($array_lastimgPro3) - 1;
                    $last_imgPro3_name = strtolower($array_lastimgPro3[$c_imgPro3]);
                    $namePro3 = "store-image-" . date("YmdHis") . "_1." . $last_imgPro3_name;
                    copy($imgPro3, "../images/store-image/" . $namePro3);
                } else {
                    $namePro3 = "";
                }

                $sqlInStores = "INSERT INTO `stores`(`user_name`, `firstname`, 
            `lastname`, `password`, `sex`, 
            `birth_date`, `id_card_number`, `img_id_card`, 
            `img_house_registration`, `personal_address`, `personal_sub_district`, 
            `personal_district`, `personal_province`, `personal_postcode`, 
            `personal_tel`, `store_address`, `store_sub_district`, 
            `store_district`, `store_province`, `store_postcode`, 
            `store_name`, `store_tel`, `store_email`, 
            `store_description`, `store_category`, `store_image`, 
            `role`, `status`, `package`, 
            `created_at`) VALUES ('" . $username . "','" . $firstName . "',
            '" . $lastName . "','" . md5(md5(md5($password))) . "','" . $sex . "',
            '" . date("Y-m-d", strtotime($birth_date)) . "','" . $id_card_number . "','" . $namePro1 . "',
            '" . $namePro2 . "','" . $personal_address . "','" . $personal_sub_district . "',
            '" . $personal_district . "','" . $personal_province . "','" . $personal_postcode . "',
            '" . $personal_tel . "','" . $store_address . "','" . $store_sub_district . "',
            '" . $store_district . "','" . $store_province . "','" . $store_postcode . "',
            '" . $store_name . "','" . $store_tel . "','" . $store_email . "',
            '" . $store_description . "','" . $store_category . "','" . $namePro3 . "',
            '2','1','" . $package . "',
            '" . date('Y-m-d H:i:s') . "')";


                // echo $sqlInCustomers;
                $resInStores = mysqli_query($conn, $sqlInStores);



                if ($resInStores) {
                ?>
                    <script type="text/javascript">
                        swal.fire({
                            title: "สมัครสมาชิกร้านค้าสำเร็จแล้ว",
                            html: "กรุณา Log in",
                            icon: "success",
                            timer: 2000,
                            allowOutsideClick: false
                        }).then(function() {
                            window.location.href = './login';
                        })
                    </script>

                <?php   } else {
                ?>
                    <script type="text/javascript">
                        swal.fire({
                            title: "Oops Error...",
                            text: "สมัครสมาชิกร้านค้าไม่สำเร็จ",
                            icon: "error",
                            allowOutsideClick: false
                        }).then(function() {
                            window.location.href = './register-store';
                        })
                    </script>
            <?php
                }
            }
        } else {
            ?>
            <script type="text/javascript">
                swal.fire({
                    title: "Oops Error...",
                    text: "เลขที่บัตรประชาชนนี้ไม่ถูกต้อง",
                    icon: "error",
                    allowOutsideClick: false
                })
            </script>
    <?php
        }
    }
    ?>
</body>

</html>