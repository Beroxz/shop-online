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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bulma/bulma.css">

</head>

<body class="d-flex flex-column min-vh-100">
    <?php
    $page = "order";
    include("./components/navbar.php"); ?>


    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="d-flex justify-content-between">
                <h5 class="card-title mb-0">การจัดการออเดอร์</h5>



            </div>
            <div class="table-responsive">
                <table class="table" id="tableProductsType">
                    <thead>
                        <tr class="text-nowrap">
                            <th>Order ID</th>
                            <th>ชื่อ-นามสกุล</th>
                            <th>เบอร์ติดต่อ</th>
                            <th>จัดส่งที่อยู่</th>
                            <th>ราคาทั้งหมด</th>
                            <th>เลขพัสดุ</th>
                            <th>สถานะ</th>
                            <th>ชื่อร้าน</th>
                            <th>เบอร์ติดต่อ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sqlGetOrder = "SELECT order_header.*, customers.firstname, customers.tel,
                        customers.lastname, provinces.name_th as provinces, amphures.name_th as districts,
                        districts.name_th as sub_districts, store_name, store_tel FROM `order_header` 
                        LEFT JOIN customers ON customers.user_name = order_header.cus_id
                        LEFT JOIN provinces ON provinces.id = order_header.ship_province
                        LEFT JOIN amphures ON amphures.id = order_header.ship_district
                        LEFT JOIN districts ON districts.id = order_header.ship_sub_district
                        LEFT JOIN stores ON stores.user_name = order_header.store_id
                        ORDER BY order_id DESC; ";
                        // echo $sqlGetOrder;
                        $resultGetOrder = $conn->query($sqlGetOrder);

                        // output data of each row
                        while ($rowGetOrder = $resultGetOrder->fetch_assoc()) {
                        ?>
                            <tr>
                                <td class="py-1">
                                    <a href="detail-order?order_id=<?php echo $rowGetOrder["order_id"] ?>" class="fw-bold text-dark text-decoration-none">
                                        <?php echo $rowGetOrder["order_id"] ?>
                                    </a>
                                </td>
                                <td class="py-1">
                                    <?php echo $rowGetOrder["firstname"] . " " . $rowGetOrder["lastname"] ?>
                                </td>
                                <td class="py-1">
                                    <?php echo $rowGetOrder["tel"]; ?>
                                </td>
                                <td class="py-1">
                                    <?php echo $rowGetOrder["ship_address"] . " " . $rowGetOrder["sub_districts"] . " " . $rowGetOrder["districts"] . " 
                                    " . $rowGetOrder["provinces"] . " " . $rowGetOrder["ship_postcode"] ?>
                                </td>
                                <td class="py-1">
                                    <?php echo $rowGetOrder["total"] ?>
                                </td>
                               
                                <td class="py-1">
                                    <div class="d-flex justify-content-between">
                                        <?php echo $rowGetOrder["parcel_number"] ? $rowGetOrder["parcel_number"] : "-" ?>
                                    </div>
                                </td>
                                <td class="py-1">
                                    <?php
                                    if ($rowGetOrder["status"] == 0) {
                                        echo '<span class="badge text-bg-warning">รอการตรวจสอบ</span>';
                                    } elseif ($rowGetOrder["status"] == 1) {
                                        echo '<span class="badge text-bg-info">รอจัดส่ง</span>';
                                    } elseif ($rowGetOrder["status"] == 2) {
                                        echo '<span class="badge text-bg-primary">จัดส่งแล้ว</span>';
                                    }
                                    ?>
                                </td>
                                <td class="py-1">
                                    <?php echo $rowGetOrder["store_name"] ?>
                                </td>
                                <td class="py-1">
                                    <?php echo $rowGetOrder["store_tel"] ?>
                                </td>
                                


                                
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

    <script>
      
        $(document).ready(function() {
            $('#tableProductsType').DataTable();
        });

    
    </script>
   
</body>

</html>