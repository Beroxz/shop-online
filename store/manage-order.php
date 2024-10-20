<?php
session_start();
error_reporting(0);
require_once("../config/config.inc.php");

if (empty($_SESSION['user_name']  && $_SESSION["role"] == 2)) {
    header("Location: ../auth/login");
    exit();
}
// Check if the order ID and status are provided
if (isset($_GET['order_id']) && isset($_GET['status'])) {
    // Sanitize input to prevent SQL injection (assuming you're using a database)
    if ($_GET['status'] == 1) {
        $sqlGetOrderLine = "SELECT order_line.*, name, pt_name FROM `order_line`
        LEFT JOIN products ON products.id = order_line.product_id
        LEFT JOIN products_type ON products.type = products_type.pt_id
        WHERE order_id = '" . $_GET['order_id'] . "'";
        // echo $sqlGetOrder;
        $resultGetOrderLine = $conn->query($sqlGetOrderLine);
        while ($rowGetOrderLine = $resultGetOrderLine->fetch_assoc()) {

            $sqlUpdateStatus = "UPDATE `products` SET `qty`= qty - " . $rowGetOrderLine['qty'] . "
                WHERE id ='" . $rowGetOrderLine['product_id'] . "'";
            $resultUpdateStatus = mysqli_query($conn, $sqlUpdateStatus);
        }
    }
    $order_id = intval($_GET['order_id']);
    $status = intval($_GET['status']);

    // Prepare and execute SQL statement to update the order status
    $sql = "UPDATE order_header SET status = $status WHERE order_id = $order_id";

    if ($conn->query($sql) === TRUE) {
        // echo "Order status updated successfully";
        echo "<script>alert('Order status updated successfully'); window.location.href = 'manage-order';</script>";
    } else {
        // echo "Error updating order status: " . $conn->error;
        echo "<script>alert('Error updating order status: " . $conn->error . "');</script>";
    }

    // Close the database connection
    $conn->close();
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
    $page = "manage-product";
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
                            <th>สลิป</th>
                            <th>สถานะ</th>
                            <th>เลขพัสดุ</th>

                            <th class="text-center" style="width: 20%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sqlGetOrder = "SELECT order_header.*, customers.firstname, customers.tel,
                        customers.lastname, provinces.name_th as provinces, amphures.name_th as districts,
                        districts.name_th as sub_districts FROM `order_header` 
                        LEFT JOIN customers ON customers.user_name = order_header.cus_id
                        LEFT JOIN provinces ON provinces.id = order_header.ship_province
                        LEFT JOIN amphures ON amphures.id = order_header.ship_district
                        LEFT JOIN districts ON districts.id = order_header.ship_sub_district
                        WHERE store_id = '" . $_SESSION['user_name'] . "' ORDER BY order_id DESC; ";
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
                                <td>
                                    <?php if ($rowGetOrder["slip"]) { ?>
                                        <img src="../images/slip/<?php echo $rowGetOrder["slip"] ? $rowGetOrder["slip"] : "-" ?>" style="width:200px;" />
                                    <?php } else {
                                        echo "-";
                                    } ?>
                                </td>
                                <td class="py-1">
                                    <?php
                                    if ($rowGetOrder["status"] == 0) {
                                        echo '<span class="badge text-bg-warning">รอการตรวจสอบ</span>';
                                    } elseif ($rowGetOrder["status"] == 1) {
                                        echo '<span class="badge text-bg-info">รอจัดส่ง</span>';
                                    } elseif ($rowGetOrder["status"] == 2) {
                                        echo '<span class="badge text-bg-primary">จัดส่งแล้ว</span>';
                                    } elseif ($rowGetOrder["status"] == 3) {
                                        echo '<span class="badge text-bg-danger">ยกเลิกออเดอร์</span>';
                                    }
                                    ?>
                                </td>
                                <td class="py-1">
                                    <div class="d-flex justify-content-between">
                                        <?php echo $rowGetOrder["parcel_number"] ? $rowGetOrder["parcel_number"] : "-" ?>
                                    </div>
                                </td>


                                <td class="text-center">


                                    <?php if ($rowGetOrder["status"] == 0) { ?>

                                        <div class="dropdown">
                                            <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                Order Status
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item text-success" href="manage-order?order_id=<?php echo $rowGetOrder["order_id"]; ?>&status=1">

                                                        ยืนยัน order

                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item text-danger" href="manage-order?order_id=<?php echo $rowGetOrder["order_id"]; ?>&status=3">

                                                        ยกเลิก
                                                    </a>
                                                </li>

                                            </ul>
                                        </div>



                                    <?php } elseif ($rowGetOrder["status"] == 1) { ?>
                                        <a href="#" class="btn btn-info btn-outline edit_data" id="<?php echo $rowGetOrder["order_id"]; ?>" data-bs-toggle="modal" data-bs-id="<?php echo $rowGetOrder["order_id"]; ?>" data-bs-target="#modalEdit">
                                            จัดส่งออเดอร์
                                        </a>

                                    <?php } elseif ($rowGetOrder["status"] == 2) {
                                        echo "";
                                    } elseif ($rowGetOrder["status"] == 3) {
                                        echo "";
                                    } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <div id="modalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Order: <span id="order_id"></span></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="detailEdit">
                    <!-- <h4>Booking Accepted</h4> -->

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </div>
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


        $(document).ready(function() {
            $('#tableProductsType').DataTable();
        });

        $(document).on('click', '.edit_data', function() {
            // $('#dataModal').modal('show');
            const uid = $(this).attr("id");
            $('#order_id').html(uid)
            console.log(uid);
            $.ajax({
                url: "modalSendOrder.php",
                type: "post",
                data: {
                    id: uid
                },
                success: function(data) {
                    $('#detailEdit').html(data)
                    $('#modalEdit').modal('show');
                    document.getElementById("docnoEdit").value = uid;
                }
            })
        });
    </script>
    <?php
    if (isset($_POST["save"])) {
        $order_id = $conn->real_escape_string($_POST['order_id']);
        $parcel_number = $conn->real_escape_string($_POST['parcel_number']);
        if ($parcel_number == "") {
    ?>
            <script type="text/javascript">
                swal.fire({
                    title: "Oops...",
                    text: "กรุณากรอกเลขพัสดุ",
                    icon: "warning",
                    timer: 1500,
                    allowOutsideClick: false
                }).then(function() {
                    window.location.href = 'manage-order';
                })
            </script>
            <?php

        } else {
            $sqlUpOrderHeader = "UPDATE `order_header` SET 
`parcel_number`='" . $parcel_number . "',
`status`='2' 
WHERE order_id = '" . $order_id . "'";

            // echo $sqlEditDoc;
            $resUpOrderHeader = mysqli_query($conn, $sqlUpOrderHeader);
            if ($resUpOrderHeader) {
            ?>
                <script type="text/javascript">
                    swal.fire({
                        title: "Successfully",
                        html: "เปลี่ยนสถานะจัดส่งแล้วสำเร็จ",
                        icon: "success",
                        timer: 1500,
                        allowOutsideClick: false
                    }).then(function() {
                        window.location.href = 'manage-order';
                    })
                </script>

            <?php   } else {
            ?>
                <script type="text/javascript">
                    swal.fire({
                        title: "Oops...",
                        text: "เปลี่ยนสถานะจัดส่งแล้ว ไม่สำเร็จ",
                        icon: "error",
                        allowOutsideClick: false
                    }).then(function() {
                        window.location.href = 'manage-order';
                    })
                </script>
    <?php
            }
        }
    }

    ?>
</body>

</html>