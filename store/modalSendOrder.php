
<?php
session_start();
error_reporting(0);
require('../config/config.inc.php');
$id = $_POST["id"];
// echo $_POST["id"];
// echo "test";
$output = "";

$output .= '
                <div class="col-12 col-lg-12">
                    <form class="row g-3 mt-2 needs-validation" novalidate method="post" action="" enctype="multipart/form-data">
                           <input type="hidden" name="order_id" id="order_id" value="' . $_POST["id"] . '"/>
                  
                          
             
                   <div class="col-12">
                       <label for="parcel_number" class="form-label">เลขพัสดุ</label>
                       <input type="text" class="form-control" id="parcel_number" name="parcel_number" placeholder="กรุณากรอกเลขพัสดุ" required />
                   </div>
                   
              
         
                            <div class="col-12 text-center">
                                <input type="submit" class="btn btn-primary" value="Save" name="save" />
                            </div>
                        </form>
                        </div>';

echo $output;
