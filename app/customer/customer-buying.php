<!-- PHP -->
<?php
include '../connect.php';
include '../service.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../main.css">
    <title>Cart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="is-flex is-flex-direction-column">
    <!-- HEADER NAVBAR -->
    <header>
        <nav id="nav">
            <div class="nav-left">
                <img src="assets/FASION.png" alt="">
            </div>
            <div class="nav-right">
                <button class="nav-list">
                    <a href="../customer/customer-home.php" class="nav-link active">HOME</a>
                </button>
                <button class="nav-list">
                    <a href="../customer/customer-buying.php" class="nav-link active">CART</a>
                </button>
                <button class="nav-list">
                    <?php if (!isset($_SESSION['username'])) { ?>
                        <a href="../service.php?login='1'" class="nav-link active">LOGIN</a>
                    <?php } else { ?>
                        <a href="../service.php?logout='1'" class="nav-link active">LOGOUT</a>
                    <?php } ?>
                </button>
            </div>
        </nav>
    </header>
    <br>
    <div class="container is-desktop is-flex is-flex-direction-column" style="width: 60%; min-width: 400px;">
        <h1 class="title is-3">ตะกร้าสินค้า</h3>
            <br>
            <?php
            $sql =  "SELECT \r\n" .
                "	 loads.ID,\r\n" .
                "	 loads.PRODUCT_ID,\r\n" .
                "    loads.QTY,\r\n" .
                "    loads.USER_NAME,\r\n" .
                "    loads.USER_TEL,\r\n" .
                "    loads.UPDATED_DT,\r\n" .
                "    loads.CREATED_DT,\r\n" .
                "    loads.STATUS,\r\n" .
                "    prod.NAME,\r\n" .
                "    prod.DETAIL,\r\n" .
                "    prod.PROMPAY,\r\n" .
                "    pt.NAME as PRODUCT_TYPE,\r\n" .
                "    prod.IN_STOCK,\r\n" .
                "    prod.PRICE,\r\n" .
                "    filep.FILE_PATH\r\n" .
                "FROM product_loading loads\r\n" .
                "LEFT JOIN fasion_product prod ON loads.PRODUCT_ID = prod.ID\r\n" .
                "LEFT JOIN product_type pt ON prod.PRODUCT_TYPE = pt.ID\r\n" .
                "LEFT JOIN product_file prodf on prod.ID = prodf.PRODUCT_ID\r\n" .
                "LEFT JOIN file_temp filep on prodf.FILE_ID = filep.ID";
            $db_query = mysqli_query($conn, $sql);
            $i = 0;
            while ($result = mysqli_fetch_array($db_query)) {
                $load_id = $result['ID'];
                $load_product_id = $result['PRODUCT_ID'];
                $load_name = $result['NAME'];
                $load_detail = $result['DETAIL'];
                $load_status = $result['STATUS'];
                $load_price = $result['PRICE'];
                $load_prompay = $result['PROMPAY'];
                $load_qty = $result['QTY'];
                $load_update = $result['UPDATED_DT'];
                $load_create = $result['CREATED_DT'];
                $load_username = $result['USER_NAME'];
                // $load_usertel = $result['USER_TEL'];
                $load_file = "../" . $result['FILE_PATH'];
            ?>
                <div class="box">
                    <article class="media">
                        <div class="media-left">
                            <figure class="image is-64x64">
                                <img src="<?php echo $load_file ?>" alt="Image">
                            </figure>
                        </div>
                        <div class="media-content">
                            <div class="content">
                                <p>
                                    <strong><?php echo $load_name ?></strong> <small>@ <?php echo $load_username ?></small>
                                    <small>
                                        <?php
                                        $timestamp = strtotime($load_create);
                                        $cur_time = time();

                                        $time_diff = $cur_time - $timestamp;

                                        if ($time_diff < 60) {
                                            echo "1m";
                                        } else if ($time_diff < 3600) {
                                            echo floor($time_diff / 60) . "m";
                                        } else if ($time_diff < 86400) {
                                            echo floor($time_diff / 3600) . "h";
                                        } else {
                                            echo date('F j, Y \a\t g:i A', $timestamp);
                                        }
                                        ?>
                                    </small>
                                    <br>
                                    <?php echo $load_detail ?>
                                </p>
                            </div>
                            <form action="../add_product.php" method="post" enctype="multipart/form-data">
                                <nav class="level is-mobile is-flex is-flex-direction-row is-justify-content-flex-between is-align-items-end" style="height: fit-content !important;">
                                    <div class="is-flex is-flex-direction-column">
                                        <small>จำนวน : <?php echo $load_qty; ?></small>
                                        <small>ราคา/ชิ้น : <?php echo $load_price; ?></small>
                                        <small>สถานะ : <?php
                                                        if ($load_status == 'wait_check_bills') {
                                                            echo 'รอชำระเงิน';
                                                        } else if ($load_status == 'wait_verify') {
                                                            echo 'รอตรวจสอบ';
                                                        } else if ($load_status == 'product_packing') {
                                                            echo 'จัดเตรียมสินค้า';
                                                        } else if ($load_status == 'transporting') {
                                                            echo 'กำลังขนส่ง';
                                                        } else if ($load_status == 'success') {
                                                            echo 'ส่งสินค้าสำเร็จ';
                                                        }
                                                        ?> </small>
                                    </div>
                                    <div class="level-left">
                                        <form action="../add_product.php" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="id" value="<?php echo $load_id; ?>">
                                            <?php if ($load_status == 'transporting') { ?>
                                                <button class="level-item button is-primary" aria-label="reply" type="submit" name="cart_verify">
                                                    <span class="is-small" style="color: white;">
                                                        <i class="fas fa-edit" aria-hidden="true" style="color: white;"></i> ยืนยันรับสินค้า
                                                    </span>
                                                </button>
                                            <?php } else if ($load_status == 'wait_check_bills') { ?>
                                                <div class="is-flex is-flex-direction-column">
                                                    <small>Prompay : <?php echo $load_prompay; ?></small>
                                                    <div class="file is-primary">
                                                        <label class="file-label">
                                                            <input class="file-input" type="file" name="fileuploadbin">
                                                            <span class="file-cta">
                                                                <span class="file-icon">
                                                                    <i class="fas fa-upload" style="color: white;"></i>
                                                                </span>
                                                                <span class="file-label spantext" style="color: white;">
                                                                    อัพโหลดบิลชำระค่าสินค้า
                                                                </span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                    <button class="button" type="submit" name="fileupload_bin">ส่ง</button>

                                                    <!-- JS Func -->
                                                    <script>
                                                        const fileInput = document.querySelector(".file-input");
                                                        const fileNameSpan = document.querySelector(".spantext");

                                                        fileInput.addEventListener("change", function() {
                                                            fileNameSpan.textContent = this.files[0].name;
                                                        });
                                                    </script>
                                                </div>
                                            <?php } ?>
                                        </form>
                                    </div>
                                </nav>
                            </form>
                        </div>
                    </article>
                </div>
            <?php } ?>
    </div>
    <br>
    <?php include '../shared/footer.php'; ?>
    <div id="modal-js-example" class="modal">
        <div class="modal-background"></div>

        <div class="modal-content">
            <div class="box">
                <p>Modal JS example</p>
                <!-- Your content -->
            </div>
        </div>

        <button class="modal-close is-large" aria-label="close"></button>
    </div>

    <!-- JS -->
    <script src="../main_js.js"></script>
</body>

</html>