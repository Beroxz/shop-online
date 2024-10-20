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
            
            <h1 class="page-header text-center mt-4">รายละเอียดสินค้า</h1>
            <div class="row">
                <div class="col-md-12 col-md-offset-2">

                    <form method="POST" action="save_cart.php">
                        <table class="table table-bordered table-striped mt-4">
                            <thead>
                                <th></th>
                                <th>ชื่อสินค้า</th>
                                <th>ราคา</th>
                                <th>จำนวน</th>
                                <th>ยอดรวม</th>
                            </thead>
                            <tbody>
                                <?php
                                //initialize total
                                $total = 0;
                                $store = "";
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
                                                <a href="delete_item.php?id=<?php echo $row['id']; ?>&index=<?php echo $index; ?>" class="btn btn-danger btn-sm">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                            </td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo number_format($row['price'], 2); ?></td>
                                            <input type="hidden" name="indexes[]" value="<?php echo $index; ?>">
                                            <td><input type="text" class="form-control" value="<?php echo $_SESSION['qty_array'][$index]; ?>" name="qty_<?php echo $index; ?>"></td>
                                            <td><?php echo number_format($_SESSION['qty_array'][$index] * $row['price'], 2); ?></td>
                                            <?php $total += $_SESSION['qty_array'][$index] * $row['price']; ?>
                                            <?php $_SESSION['store'] = $row["created_by"]; ?>
                                            <!-- <input type="hidden" value="<?php echo $row["created_by"] ?>" name="store"> -->
                                        </tr>
                                    <?php
                                        $index++;
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="5" class="text-center">No Item in Cart</td>
                                    </tr>
                                <?php
                                }

                                ?>
                                <tr>
                                    <td colspan="4" align="right"><b>รวมทั้งสิ้น</b></td>
                                    <td><b><?php echo number_format($total, 2); ?></b></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-between mt-4">
                            <a href="index" class="btn btn-warning"><i class="bi bi-arrow-left"></i> Back</a>
                            <button type="submit" class="btn btn-success" name="save"><i class="bi bi-save"></i> Save Changes</button>
                            <a href="checkout?store=<?php echo $_SESSION['store']; ?>" class="btn btn-primary"><i class="bi bi-check"></i> Checkout</a>
                        </div>

                    </form>
                </div>
            </div>
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

        $(`#productType`).change(function() {
            let productType = $(this).val();
            // console.log(productType)
            $(`#productTypeSub`).html('<option value="" selected disabled>เลือกซับประเภท</option>');
            $.ajax({
                type: "POST",
                url: "./admin/get/sub-type.php",
                data: {
                    id: productType,
                    function: 'productType'
                },
                success: function(data) {
                    const result = JSON.parse(data);
                    $.each(result, function(index, item) {
                        $(`#productTypeSub`).append(
                            $('<option></option>').val(item.pst_id).html(item.pst_name)
                        );
                    });
                }
            });
        });
    </script>
</body>

</html>