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
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../css/styles.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">

</head>

<body class="d-flex flex-column min-vh-100">
    <?php 
    $page = "manage-product";
    include("./components/navbar.php"); ?>


    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="d-flex justify-content-between">
                <h5 class="card-title mb-4">การจัดการผู้ใช้งานทั่วไป</h5>
                


            </div>
            <div class="table-responsive">
                <table class="table" id="tableUsersGeneral">
                    <thead>
                        <tr class="text-nowrap">
                            <th>วันที่สมัคร</th>
                            <th>Useruname</th>
                            <th>ชื่อ - นามสกุล</th>
                            <th>email</th>
                            <!-- <th class="text-center">Action</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sqlGetUsers = "SELECT * FROM `customers` WHERE role = '1';";
                        $resultGetUsers = $conn->query($sqlGetUsers);

                        // output data of each row
                        while ($rowGetUsers = $resultGetUsers->fetch_assoc()) {
                        ?>
                            <tr>
                                <td class="py-1">
                                    <?php echo date("d-m-Y H:i", strtotime($rowGetUsers["created_at"]))?>
                                </td>
                                <td class="py-1">
                                    <a href="detail-general-users?username=<?php echo $rowGetUsers["user_name"] ?>" class="fw-bold text-dark text-decoration-none">
                                        <?php echo $rowGetUsers["user_name"] ?>
                                    </a>
                                </td>
                                <td class="py-1">
                                    <?php echo $rowGetUsers["firstname"]." ".$rowGetUsers["lastname"] ?>
                                </td>
                                <td class="py-1">
                                    <?php echo $rowGetUsers["email"] ?>
                                </td>

                                <!-- <td class="text-center">

                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="edit-customer?username=<?php echo $rowGetUsers["user_name"]; ?>">
                                            <button type="button" class="btn btn-outline-primary" id="<?php echo $rowGetUsers["user_name"]; ?>">
                                                <i class="bi bi-pencil-fill"></i>
                                            </button>
                                        </a>
                                    </div>
                                </td> -->
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
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
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#tableUsersGeneral').DataTable({
                order: [
                    [0, 'desc']
                ],
            });
        });
    </script>
</body>

</html>