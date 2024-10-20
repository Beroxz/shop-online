<?php
error_reporting(0);
require_once("../config/config.inc.php");
session_start();

$sqlGetUsers = "SELECT * FROM `customers`
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
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-2 row-cols-xl-2 justify-content-center">
                <div class="col mb-5">
                    <div class="card h-100 shadow rounded-4">
                        <div class="card-body px-5 py-5">
                            <h3 class="text-center fw-bold">แก้ไขรายละเอียดสมาชิก : <?php echo $_GET["username"] ?> </h3>
                            <form class="row g-3 mt-3 needs-validation" novalidate method="post" action="" enctype="multipart/form-data">
                                <input type="hidden" class="form-control rounded-3" id="role" name="role" value="<?php echo $rowGetUsers["role"]; ?>">
                                <div class="col-md-6">
                                    <label for="firstName" class="form-label fw-bold">ชื่อ</label>
                                    <input type="text" class="form-control" id="firstName" name="firstName" minlength="3" value="<?php echo $rowGetUsers["firstname"]; ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="lastName" class="form-label fw-bold">นามสกุล</label>
                                    <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo $rowGetUsers["lastname"]; ?>" minlength="3" required>
                                </div>
                                <div class="col-md-12">
                                    <label for="email" class="form-label fw-bold">E-mail</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $rowGetUsers["email"]; ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="username" class="form-label fw-bold">Username</label>
                                    <input type="text" class="form-control rounded-3" id="username" name="username" value="<?php echo $rowGetUsers["user_name"]; ?>" disabled readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label fw-bold">Password</label>
                                    <input type="hidden" class="form-control rounded-3" id="passwordOld" name="passwordOld" value="<?php echo $rowGetUsers["password"]; ?>">
                                    <input type="password" class="form-control rounded-3" id="password" name="password" minlength="8">
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
            if($role == 1){
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

        <?php  }elseif ($role == 2){
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