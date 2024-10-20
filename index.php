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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content />
    <meta name="author" content />
   
    <link rel="icon" type="image/x-icon" href="./images/logo.png" />
    <!-- Primary Meta Tags -->
    <title>หน้าหลัก | 24Shop</title>
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

    <!-- Meta Tags Generated with https://metatags.io -->
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bulma/bulma.css">
   
</head>

<body>
    <?php
    $page = "index";
    include("./components/navbar.php"); ?>


    <!-- Header-->
    <section class="container-fluid bg-light" style="background-image: url('./images/1675408373-black-friday-elements-assortment.jpg'); height: 100%;background-position: center;background-repeat: no-repeat; background-size: cover;">
        <div class="py-5 container">
            <div class="row py-lg-5">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <div class="bg-light rounded-4 bg-opacity-75 p-4 text-center">
                        <h2 class="fw-light fs-1">ทำไมต้องเปิดร้านค้ากับเรา?</h2>
                        <p class="lead text-muted fs-5">การเปิดร้านกับเราคือการเข้าร่วมกับพื้นที่ออนไลน์ที่ทันสมัยและมีความสามารถสูงในการขายสินค้า ที่มีเครื่องมือและแพลตฟอร์มที่ทันสมัยและเป็นมิตรต่อผู้ใช้ ช่วยให้ธุรกิจของคุณเติบโตและประสบความสำเร็จในโลกออนไลน์ได้อย่างมีประสิทธิภาพ.</p>

                        <a href="./auth/register-store" class="btn btn-primary my-2 rounded-3">สมัครเปิดร้านกับเรา</a>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- <img src="./images/432846381_427760703038097_4480007291850302175_n.jpg" class="img-fluid d-block w-100 rounded" alt="..." style="background-size: cover;"> -->
    <!-- Section-->
    <section class="py-5">
        <div class="container">
            <div class="card mb-4 rounded-4 shadow-sm">
                <div class="card-body px-5">
                    <form class="row g-3 mt-3 needs-validation" novalidate method="get" action="search" enctype="multipart/form-data">
                        <div class="col-12 col-md-3 mb-3">
                            <label for="productType" class="form-label fw-bold">ประเภท</label>
                            <select class="form-select" id="productType" name="productType">
                                <option value="" disabled selected>กรุณาเลือกประเภท</option>
                                <?php
                                $sqlGetProductsType = "SELECT * FROM `products_type`";
                                $resultGetProductsType = $conn->query($sqlGetProductsType);
                                while ($rowGetProductsType = $resultGetProductsType->fetch_assoc()) {

                                ?>
                                    <option value="<?php echo $rowGetProductsType["pt_id"]; ?>"><?php echo $rowGetProductsType["pt_name"]; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-12 col-md-3 mb-3">
                            <label for="productTypeSub" class="form-label fw-bold">ซับประเภท</label>
                            <select class="form-control rounded-3" id="productTypeSub" name="productTypeSub">
                                <option value="">เลือกซับประเภท</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-3 mb-3">
                            <label for="start_budget" class="form-label fw-bold">ราคาเริ่มต้น</label>
                            <input type="number" class="form-control rounded-3" id="start_budget" name="start_budget">
                        </div>
                        <div class="col-12 col-md-3 mb-3">
                            <label for="end_budget" class="form-label fw-bold">ถึงราคา</label>
                            <input type="number" class="form-control rounded-3" id="end_budget" name="end_budget">
                        </div>
                        <div class="col-12 col-md-12 mb-3">
                            <label for="keyword" class="form-label fw-bold">Keyword</label>
                            <input type="text" class="form-control rounded-3" id="keyword" name="keyword">
                        </div>
                        <div class="text-center mt-4">
                            <input type="submit" class="btn btn-primary rounded-2 fw-bold" value="ค้นหา" name="search" />
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <div class="container px-4 px-lg-5">
            <div class="d-flex justify-content-between">
                <h4 class="mb-3 text-center" style="border-bottom: 3px solid #a6d445; padding-bottom: 3px;">ร้านค้าเปิดใหม่</h4>
                <!-- <a href="#" class="text-decoration-none text-black">ทั้งหมด</a> -->
            </div>

            <div class="row gx-3 gx-lg-4 mb-4">
                <?php
                $sqlGetStore = "SELECT * FROM `stores` WHERE role = '2' ORDER BY created_at DESC LIMIT 8;";
                $resultGetStore = $conn->query($sqlGetStore);

                while ($rowGetStore = $resultGetStore->fetch_assoc()) {

                ?>
                    <div class="col-6 col-md-3 col-lg-3 col-xl-3 mb-4">
                        <a class="text-decoration-none" href="#">
                            <div class="card h-100 rounded-4">
                                <!-- Product image-->
                                <div class="p-2 ">
                                    <img class="card-img-top rounded-4" src="<?php echo $rowGetStore["store_image"]? './images/store-image/'.$rowGetStore["store_image"]:'./images/cute1.jpg' ?>" alt="..." />
                                </div>
                                <!-- Product details-->
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <!-- Product name-->
                                        <h5 class="fw-bolder text-truncate text-muted"><?php echo $rowGetStore["firstname"] . " " . $rowGetStore["lastname"] ?></h5>
                                        <!-- Product price-->
                                        <!-- <span class="text-muted">
                                        </span> -->
                                    </div>
                                </div>
                                <!-- Product actions-->
                                <!-- <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">View options</a></div>
                            </div> -->
                            </div>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
        <section class="container-fluid" style="background-image: url('./images/mobile-shopping-how-to-create-a-perfect-customer-experience.png'); height: 100%;background-position: center;background-repeat: no-repeat; background-size: cover;">
            <div class="py-5 container text-center">
                <div class="row py-lg-5">
                    <div class="col-lg-6 col-md-8 mx-auto">
                        <div class="bg-light rounded-4 bg-opacity-75 py-4">

                            <h1 class="fw-light">ช้อปปิ้งออนไลน์</h1>
                            <!-- <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it entirely.</p> -->
                            <p>
                                <a href="#" class="btn btn-primary my-2 rounded-3">Shop Now</a>
                                <!-- <a href="#" class="btn btn-secondary my-2">Secondary action</a> -->
                            </p>

                        </div>

                    </div>
                </div>
            </div>
        </section>

        <div class="container px-4 px-lg-5 mt-5">
            <div class="d-flex justify-content-between">
                <h4 class="mb-3 text-center" style="border-bottom: 3px solid #a6d445; padding-bottom: 3px;">สินค้าทั้งหมด</h4>
                <a href="#" class="text-decoration-none text-black">ทั้งหมด</a>
            </div>
            <div class="row gx-3 gx-lg-4">
                <?php
                $sqlGetProductsTypeSub = "SELECT products.*, pst_id, pst_name, pt_name FROM `products` 
                        LEFT JOIN products_type ON products.type = products_type.pt_id
                        LEFT JOIN products_sub_type ON products.subType = products_sub_type.pst_id ORDER BY id DESC LIMIT 8; ";
                $resultGetProductsTypeSub = $conn->query($sqlGetProductsTypeSub);

                // output data of each row
                $i = 0;
                while ($rowGetProductsTypeSub = $resultGetProductsTypeSub->fetch_assoc()) {
                    $i++
                ?>
                    <div class="col-6 col-md-6 col-lg-3 col-xl-3 mb-5">
                        <a class="text-decoration-none" href="detail?product_id=<?php echo $rowGetProductsTypeSub["id"] ?>">
                            <div class="card h-100 rounded-4">
                                <!-- Product image-->
                                <div class="p-2 ">
                                    <img class="card-img-top rounded-4" src="./images/products/<?php echo $rowGetProductsTypeSub["image"] ? $rowGetProductsTypeSub["image"] : "-" ?>" alt="..." />
                                </div>

                                <!-- Product details-->
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <!-- Product name-->
                                        <h6 class="fw-bolder custom-truncate text-dark"> <?php echo $rowGetProductsTypeSub["name"] ?></h6>
                                        <!-- Product price-->
                                        <div class="d-flex justify-content-between mt-4">
                                            <div class="text-primary fw-bold text-primary-bold">
                                               ฿<?php echo number_format($rowGetProductsTypeSub["price"], 2) ?>
                                            </div>
                                            <div class="text-muted fs-6 fw-normal">
                                                จำนวน: <?php echo $rowGetProductsTypeSub["qty"] ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Product actions-->
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                    <div class="text-center">
                                        <a class="btn btn-primary mt-auto fw-bold rounded-3" href="index?id=<?php echo $rowGetProductsTypeSub['id']; ?>">
                                            หยิบใส่ตะกร้า
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="container px-4 py-5" id="icon-grid">
            <div class="d-flex justify-content-center">
                <h3 class="pb-2 mb-4" style="border-bottom: 3px solid #a6d445; padding-bottom: 3px;">บริการของเรา</h3>
            </div>


            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-2 g-4 py-4">

                <div class="col d-flex align-items-start">
                    <div class=" text-muted flex-shrink-0 me-3" width="1.75em" height="1.75em">
                        <i class="bi bi-shield-fill-check fs-4"></i>
                    </div>
                    <div class="text-muted">
                        <h3 class="fw-bold mb-0 fs-4 text-uppercase text-dark">quality guarnatee</h3>
                        <p>เรามั่นใจในคุณภาพของสินค้าที่เราจำหน่ายและให้บริการการรับประกันคุณภาพ หากมีปัญหาใด ๆ เกี่ยวกับสินค้าที่ได้รับ เช่น ความเสียหายในการขนส่งหรือสินค้าไม่ตรงตามความคาดหวัง เราจะรับผิดชอบและดำเนินการแก้ไขปัญหาให้กับลูกค้าอย่างเต็มที่.</p>
                    </div>
                </div>
                <div class="col d-flex align-items-start">
                    <div class=" text-muted flex-shrink-0 me-3" width="1.75em" height="1.75em">
                        <i class="bi bi-shield-fill-plus fs-4"></i>
                    </div>
                    <div class="text-muted">
                        <h3 class="fw-bold mb-0 fs-4 text-uppercase text-dark">100% secure payment</h3>
                        <p>เราให้ความสำคัญกับความปลอดภัยของข้อมูลและการชำระเงินของลูกค้า ดังนั้นเราใช้เทคโนโลยีที่มีความปลอดภัยสูงสุดเพื่อให้แน่ใจว่าข้อมูลการชำระเงินของลูกค้าจะถูกเก็บรักษาอย่างปลอดภัยและไม่ถูกขโมยหรือนำไปใช้โดยไม่ได้รับอนุญาต.</p>
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