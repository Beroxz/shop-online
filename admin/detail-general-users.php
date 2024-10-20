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
                            <h3 class="text-center fw-bold mb-4">รายละเอียดลูกค้า : <?php echo $_GET["username"] ?> </h3>
                            <div class="row g-3">
                                <div class="col-md-12 mb-3">
                                    <label for="username" class="form-label fw-bold">Username</label>
                                    <div class=""><?php echo $rowGetUsers["user_name"] ?></div>

                                </div>
                                <div class="col-md-6">
                                    <label for="firstName" class="form-label fw-bold">ชื่อ</label>
                                    <div class=""><?php echo $rowGetUsers["firstname"] ?></div>
                                </div>
                                <div class="col-md-6">
                                    <label for="lastName" class="form-label fw-bold">นามสกุล</label>
                                    <div class=""><?php echo $rowGetUsers["lastname"] ?></div>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label fw-bold">E-mail</label>
                                    <div class=""><?php echo $rowGetUsers["email"] ?></div>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label fw-bold">เบอร์โทร</label>
                                    <div class=""><?php echo $rowGetUsers["tel"] ?></div>
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

</body>

</html>