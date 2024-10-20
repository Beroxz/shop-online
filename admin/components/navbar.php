<?php
session_start();
error_reporting(0);

if (empty($_SESSION['user_name']  && $_SESSION["role"] == 0)) {
	header("Location: ../auth/login");
	exit();
}

?>
<div class="container-fuild shadow-sm px-4">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between  mb-1">
        <a href="./index" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">

        <p class="m-4 text-center fs-5 fw-bold text-primary">24Shop</p>
        </a>

        <ul class="nav nav-pills nav-fill col-12 col-md-auto mb-2 justify-content-center mb-md-0 fw-bold">
            <li class="nav-item"><a href="./index" class="nav-link px-2 link-dark">Home</a></li>
            <li class="nav-item"><a href="./order" class="nav-link px-2 link-dark">รายการสั่งซื้อ</a></li>
            <li class="nav-item"><a href="./manage-product" class="nav-link px-2 link-dark">สินค้า</a></li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-decoration-none text-black" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">ประเภทสินค้า</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="./manage-product-type">ประเภทสินค้า</a></li>
                    <li><a class="dropdown-item" href="./manage-product-type-sub">ซับประเภทสินค้า</a></li>
                    
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-decoration-none text-black" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">การจัดการผู้ใช้งาน</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="./general-users">ผู้ใช้ทั่วไป</a></li>
                    <li><a class="dropdown-item" href="./store-users">ร้านค้า</a></li>
                    
                </ul>
            </li>
            <!-- <li><a href="#" class="nav-link px-2 link-dark">จัดการร</a></li> -->
            <!-- <li><a href="#" class="nav-link px-2 link-dark">About</a></li> -->
        </ul>

        <div class="col-md-1 text-end">
          

        </div>
        <div class="dropdown text-end">
          <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="../images/avatars/avatar-5.png" alt="mdo" width="32" height="32" class="rounded-circle" style="margin-right: 5px;">
          <span class="fw-bold"><?php echo $_SESSION["user_name"]; ?></span>
            
            
          </a>
          <ul class="dropdown-menu text-small rounded-3 mt-1" style="">
            
            <li><a class="dropdown-item" href="./logout">ออจากระบบ</a></li>
          </ul>
        </div>
    </header>
</div>