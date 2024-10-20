<?php
session_start(); // Start the session if not already started

// Check if the user is logged in
if (!empty($_SESSION['user_name']) && $_SESSION["role"] == 1) {
?>
    <div class="container-fuild shadow-sm px-4">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between">
            <a href="./index" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
                <!-- <img src="./images/logo.png" alt="Logo" width="84" height="84"> -->
                <p class="m-4 text-center fs-5 fw-bold text-primary">24Shop</p>
            </a>

            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0 fw-bold">
                <li><a href="./index" class="nav-link px-2 link-dark" <?php if ($page == 'index' || $page == 'detail') {
                                                                            echo 'style="border-bottom: 3px solid #a6d445; padding-bottom: 3px;"';
                                                                        } else {
                                                                            echo 'style=""';
                                                                        }  ?>>หน้าหลัก</a></li>
                                                                         <li><a href="./order" class="nav-link px-2 link-dark" <?php if ($page == 'order'|| $page == 'order-detail') {
                                                                            echo 'style="border-bottom: 3px solid #a6d445; padding-bottom: 3px;"';
                                                                        } else {
                                                                            echo 'style=""';
                                                                        }  ?>>รายการซื้อ</a></li>
                <!-- <li><a href="./products" class="nav-link px-2 link-dark">Product</a></li> -->
                <li><a href="./package" class="nav-link px-2 link-dark" <?php if ($page == 'package') {
                                                                            echo 'style="border-bottom: 3px solid #a6d445; padding-bottom: 3px;"';
                                                                        } else {
                                                                            echo 'style=""';
                                                                        }  ?>>Package</a></li>
               
                <li><a href="./contact" class="nav-link px-2 link-dark" <?php if ($page == 'contact') {
                                                                            echo 'style="border-bottom: 3px solid #a6d445; padding-bottom: 3px;"';
                                                                        } else {
                                                                            echo 'style=""';
                                                                        }  ?>>ติดต่อเรา</a></li>
            </ul>
            <div class="col-md-1 text-end">
            </div>
            <div class="d-flex justify-content-between">
                <a class="me-2 text-decoration-none text-muted fw-bold text-black-50" href="view-cart">
                    <i class="bi bi-cart-fill"></i> <span class="badge bg-primary rounded-pill text-black-50"><?php echo count($_SESSION['cart']); ?></span>
                </a>
                <div class="dropdown text-end">
                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="./images/avatars/avatar-1.png" alt="mdo" width="32" height="32" class="rounded-circle" style="margin-right: 5px;">
                        <span class="fw-bold"><?php echo $_SESSION["user_name"]; ?></span>
                    </a>
                    <ul class="dropdown-menu text-small rounded-3 mt-1" style="">
                        <li><a class="dropdown-item" href="./logout">ออจากระบบ</a></li>
                    </ul>
                </div>
            </div>
        </header>
    </div>

<?php } else {  ?>
    <div class="container-fuild shadow-sm px-4">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between">
            <a href="./index" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
                <!-- <img src="./images/logo.png" alt="Logo" width="84" height="84"> -->
                <p class="m-4 text-center fs-5 fw-bold text-primary">24Shop</p>
            </a>

            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0 fw-bold">
                <li><a href="./index" class="nav-link px-2 link-dark" <?php if ($page == 'index' || $page == 'detail') {
                                                                            echo 'style="border-bottom: 3px solid #a6d445; padding-bottom: 3px;"';
                                                                        } else {
                                                                            echo 'style=""';
                                                                        }  ?>>หน้าหลัก</a></li>
                <!-- <li><a href="./products" class="nav-link px-2 link-dark">Product</a></li> -->
                <li><a href="./package" class="nav-link px-2 link-dark" <?php if ($page == 'package') {
                                                                            echo 'style="border-bottom: 3px solid #a6d445; padding-bottom: 3px;"';
                                                                        } else {
                                                                            echo 'style=""';
                                                                        }  ?>>Package</a></li>
                <li><a href="./contact" class="nav-link px-2 link-dark" <?php if ($page == 'contact') {
                                                                            echo 'style="border-bottom: 3px solid #a6d445; padding-bottom: 3px;"';
                                                                        } else {
                                                                            echo 'style=""';
                                                                        }  ?>>ติดต่อเรา</a></li>
            </ul>

            <div class="col-md-4 text-end">

                <a class="me-2 text-decoration-none text-muted fw-bold text-black-50" href="./index">
                    <i class="bi bi-cart-fill"></i> <span class="badge bg-primary rounded-pill text-black-50">0</span>
                </a>
                <!-- <a href="./auth/login"><button type="button" class="btn btn-outline-primary me-2 fw-bold">Login</button></a> -->
                <a href="./login"><button type="button" class="btn btn-outline-primary me-2 fw-bold">Login</button></a>
                <a href="./register"><button type="button" class="btn btn-primary fw-bold">สมัครสมาชิก</button></a>
            </div>
        </header>
    </div>
<?php } ?>