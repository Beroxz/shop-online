<?php
session_start();
// error_reporting(0);
require_once("../config/config.inc.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content />
    <meta name="author" content />
    <title>Login</title>
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
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-2 row-cols-xl-2 justify-content-center">
                <div class="col mb-5">
                    <div class="card h-100 shadow rounded-4">
                        <div class="card-body px-5 py-5">
                            <h1 class="text-center fw-bold">Log in Store</h1>
                            <form class="row g-3 mt-3 needs-validation" novalidate method="post" action="" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="username" class="form-label fw-bold">Username</label>
                                    <input type="text" class="form-control rounded-3" id="username" name="username" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label fw-bold">Password</label>
                                    <input type="password" class="form-control rounded-3" id="password" name="password" minlength="8" required>
                                </div>
                                <div class="text-center mt-4">
                                    <input type="submit" class="btn btn-primary rounded-2 fw-bold" value="Log in" name="login" />
                                </div>
                                <hr>

                                <div class="text-center">
                                    <a href="./register-store" class="btn btn-info rounded-2 fw-bold">สมัครสมาชิกร้านค้า</a>
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

    if (!empty($_POST["login"])) {
        $username = $conn->real_escape_string($_POST['username']);
        $password = $conn->real_escape_string($_POST['password']);

        $sqlStore = "SELECT * FROM stores WHERE user_name = '" . $username . "' and password = '" . md5(md5(md5($password))) . "'";
        // echo $sqlStore;
        $queryStore = mysqli_query($conn, $sqlStore);
        $fetchStore = mysqli_fetch_assoc($queryStore);
        $rowcountStore = mysqli_num_rows($queryStore);

        if ($rowcountStore < 1) {
            $sqlAdmin = "SELECT * FROM employees WHERE user_name = '" . $username . "' and password = '" . md5(md5(md5($password))) . "'";
            $queryAdmin = mysqli_query($conn, $sqlAdmin);
            $fetchAdmin = mysqli_fetch_assoc($queryAdmin);
            $rowcountAdmin = mysqli_num_rows($queryAdmin);

            if ($rowcountAdmin < 1) {
    ?>
                <script type="text/javascript">
                    Swal.fire(
                            'กรุณาสมัคร admin',
                            'ไม่พบ Username นี้ในระบบ!!!',
                            'error'
                        ),
                        setTimeout(function() {
                            window.location.href = "login";
                        }, 1500);
                </script>

                <?php
            } else {
                $_SESSION["user_name"] = $fetchAdmin["user_name"];
                $_SESSION["firstname"] = $fetchAdmin["firstname"];
                $_SESSION["lastname"] = $fetchAdmin["lastname"];
                $_SESSION["role"] = $fetchAdmin["role"];

                // echo $_SESSION["cus_fname"];
                if ($fetchAdmin["status"] == 0) {
                ?>
                    <script type="text/javascript">
                        Swal.fire(
                                'กรุณาสมัครสมาชิก admin',
                                'Username นี้ไม่เปิดการใช้งาน!!!',
                                'error'
                            ),
                            setTimeout(function() {
                                window.location.href = "login";
                            }, 1500);
                    </script>

                <?php
                } else {
                ?>
                    <script type="text/javascript">
                        const ToastAdmin = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 1500,
                            timerProgressBar: true,
                        })

                        ToastAdmin.fire({
                            icon: 'success',
                            title: 'Login Admin successfully'
                        }).then(function() {
                            window.location.href = "../admin/index";
                        })
                    </script>

                <?php
                }
            }
        } else {

            $_SESSION["user_name"] = $fetchStore["user_name"];
            $_SESSION["firstname"] = $fetchStore["firstname"];
            $_SESSION["lastname"] = $fetchStore["lastname"];
            $_SESSION["role"] = $fetchStore["role"];
            $_SESSION["status"] = $fetchStore["status"];
// echo $_SESSION["user_name"];
// echo $_SESSION["role"];
            // echo $_SESSION["cus_fname"];
            if ($fetchStore["status"] == 0) {
                ?>
                <script type="text/javascript">
                    Swal.fire(
                            'กรุณาสมัครสมาชิกร้านค้า',
                            'Username นี้ไม่เปิดการใช้งาน!!!',
                            'error'
                        ),
                        setTimeout(function() {
                            window.location.href = "login";
                        }, 1500);
                </script>

            <?php
            } else {
            ?>
            
               <script type="text/javascript">
                        const ToastStore = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 1500,
                            timerProgressBar: true,
                        })

                        ToastStore.fire({
                            icon: 'success',
                            title: 'Login Store successfully'
                        }).then(function() {
                            window.location.href = "../store/index";
                        })
                    </script>

    <?php

            }
        }
    }
    ?>
</body>

</html>