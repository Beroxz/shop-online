<?php
session_start();
error_reporting(0);
require_once("./config/config.inc.php");

//initialize cart if not set or is unset
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

//unset qunatity
unset($_SESSION['qty_array']);
// Check if user is logged in
function isUserLoggedIn()
{
    // Your logic to determine if the user is logged in
    // For example, checking session variables, cookies, or database query
    return isset($_SESSION['user_name']); // Assuming you store user's ID in session after login
}

// Function to add product to cart
function addToCart($id)
{
    if (isUserLoggedIn()) {
        if (!in_array($_GET['id'], $_SESSION['cart'])) {
            array_push($_SESSION['cart'], $_GET['id']);
            $_SESSION['message'] = 'Product added to cart';
        } else {
            $_SESSION['message'] = 'Product already in cart';
        }

        header('location: index');
        // echo "Product added to cart successfully!";
    } else {
        // Redirect to login page
        header("Location: login");
        exit();
    }
}

// Handle Add to Cart request
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    addToCart($_GET["id"]);
}

$sqlGetProducts = "SELECT products.*, pst_id, pst_name, pt_name, store_name FROM `products` 
LEFT JOIN products_type ON products.type = products_type.pt_id
LEFT JOIN products_sub_type ON products.subType = products_sub_type.pst_id
LEFT JOIN stores ON products.created_by = stores.user_name
WHERE id = '" . $_GET["product_id"] . "';";
$resultGetProducts = $conn->query($sqlGetProducts);

$rowGetProducts = $resultGetProducts->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content />
    <meta name="author" content />
    <title>รายละเอียด : <?php echo $rowGetProducts["name"] ?> | 24Shop</title>
    <meta name="title" content="24Shop.com" />
    <meta name="description" content="การเปิดร้านกับเราคือการเข้าร่วมกับพื้นที่ออนไลน์ที่ทันสมัยและมีความสามารถสูงในการขายสินค้า ที่มีเครื่องมือและแพลตฟอร์มที่ทันสมัยและเป็นมิตรต่อผู้ใช้ ช่วยให้ธุรกิจของคุณเติบโตและประสบความสำเร็จในโลกออนไลน์ได้อย่างมีประสิทธิภาพ." />

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website" />
    <meta property="og:url" content="24Shop.com" />
    <meta property="og:title" content="24Shop.com" />
    <meta property="og:description" content="การเปิดร้านกับเราคือการเข้าร่วมกับพื้นที่ออนไลน์ที่ทันสมัยและมีความสามารถสูงในการขายสินค้า ที่มีเครื่องมือและแพลตฟอร์มที่ทันสมัยและเป็นมิตรต่อผู้ใช้ ช่วยให้ธุรกิจของคุณเติบโตและประสบความสำเร็จในโลกออนไลน์ได้อย่างมีประสิทธิภาพ." />
    <meta property="og:image" content="./images/logo.png" />

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:url" content="24Shop.com" />
    <meta property="twitter:title" content="24Shop.com" />
    <meta property="twitter:description" content="การเปิดร้านกับเราคือการเข้าร่วมกับพื้นที่ออนไลน์ที่ทันสมัยและมีความสามารถสูงในการขายสินค้า ที่มีเครื่องมือและแพลตฟอร์มที่ทันสมัยและเป็นมิตรต่อผู้ใช้ ช่วยให้ธุรกิจของคุณเติบโตและประสบความสำเร็จในโลกออนไลน์ได้อย่างมีประสิทธิภาพ." />
    <meta property="twitter:image" content="./images/logo.png" />
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
    $page = "detail";
    include("./components/navbar.php"); ?>

    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">

            <div class="row gx-4 gx-lg-5">
                <div class="col-12 col-md-6 col-lg-6 col-xl-6 mb-5 text-center">
                    <img class="card-img-top" src="./images/products/<?php echo $rowGetProducts["image"] ? $rowGetProducts["image"] : "-" ?>" alt="<?php echo $rowGetProducts["name"] ? $rowGetProducts["name"] : "-" ?>" />
                </div>
                <div class="col-12 col-md-6 col-lg-6 col-xl-6 mb-5">
                    <div class="text-center">
                        <h5 class="fw-bolder"> <?php echo $rowGetProducts["name"] ?></h5>
                    </div>

                    <div class="fs-4 fw-bolder mt-4 text-primary-bold">฿<?php echo number_format($rowGetProducts["price"], 2) ?></div>
                    <div class="fs-6 text-muted fw-normal">จำนวนคงเหลือ : &nbsp;<?php echo $rowGetProducts["qty"] ?></div>
                
                    <div class="text-muted mt-2">ประเภท : &nbsp; <?php echo $rowGetProducts["pt_name"] ?></div>
                    <div class="text-muted">ซับประเภท : &nbsp;<?php echo $rowGetProducts["pst_name"] ?></div>
                    <div class="text-muted">ลงสินค้าโดย : &nbsp;<?php echo $rowGetProducts["store_name"] ?></div>

                    <div class="mt-4">
                        <div class="d-flex justify-content-center">
                        <a class="btn btn-primary fw-bold rounded-3" href="detail?id=<?php echo $rowGetProducts['id']; ?>">หยิบใส่ตะกร้า</a>
                        </div>
                    </div>

                </div>

                <?php if (!empty($rowGetProducts["description"])) { ?>
                    <div class="col-12 col-md-12 col-lg-12 col-xl-12 mb-5">
                        <div class="card h-100">
                            <div class="card-body p-4">
                                <div class="">
                                    <h3 class="mb-4 fs-3 fw-bold">รายละเอียดสินค้า</h3>
                                    <hr>
                                    <?php echo $rowGetProducts["description"] ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
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

</body>

</html>