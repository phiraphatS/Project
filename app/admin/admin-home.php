<!-- PHP -->
<?php
include '../connect.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../main.css">
    <title>CMS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <!-- HEADER NAVBAR -->
    <header>
        <nav id="nav">
            <a class="navbar-burger" data-target="navbar-menu" style="margin-left: 10px; padding-top: 10px;">
                <i class="fas fa-bars" style="font-size: 40px; text-align: center;color: #f1f1f1;"></i>
            </a>

            <div class="nav-right">
                <button class="nav-list">
                    <a href="../service.php?logout" class="nav-link active">LOGOUT</a>
                </button>
            </div>
        </nav>
    </header>

    <div class="content-all">
        <!-- NAVBAR -->
        <div class="content-menu navbar-menu my-nav-bar-config" id="navbar-menu">
            <aside class="menu">
                <p class="menu-label">
                    General (Admin)
                </p>
                <ul class="menu-list">
                    <li><a class="is-active" id="product-manage">หน้าหลักการจัดการสินค้าส่งออก</a></li>
                    <li>
                        <a id="all-product">Product</a>
                        <ul>
                            <li><a id="recommend-product">- สินค้าแนะนำ</a></li>
                            <li><a id="all-product">- สินค้าทั้งหมด</a></li>
                            <li><a id="setting-group-product">- ตั้งค่าหมวดหมู่สินค้า</a></li>
                        </ul>
                    </li>
                    <li><a id="user-setting">User Data</a></li>
                </ul>
                <p class="menu-label">
                    Administration (Advance)
                </p>
                <ul class="menu-list">
                    <li><a id="manage-history">ประวัติการจัดการข้อมูล</a></li>
                    <!-- <li><a id="about-us-message">About us</a></li> -->
                </ul>
            </aside>
        </div>
        <!-- CONTENT -->
        <div class="content-space rows">
            <div class="header-content">
                <h3 class="title is-3" style="margin: 0;">จัดการสินค้า</h3>

                <button type="button" name="addproduct" class="is-primary button js-modal-trigger" data-target="modal-js-add">
                    <i class="fa-solid fa-plus" style="color:white; margin-right: 5px;"> </i>
                    <span style="color:white;"> Add Product</span>
                </button>
            </div>
            <br>
            <div class="manage-content-menu">

                <!-- All -->
                <div class="admin-content rows is-desktop is-hidden card-flex" id="all-product-element">
                    <?php
                    $sql = "SELECT fp.ID, fp.NAME, fp.DETAIL, fp.PRICE, fp.IN_STOCK, pt.NAME AS PRODUCT_TYPE, fp.IS_RECOMMEND, fp.UPDATE_DT, fp.UPDATE_USER, ft.FILE_PATH FROM fasion_product fp \r\n" .
                        "LEFT JOIN product_file pf ON fp.ID = pf.PRODUCT_ID\r\n" .
                        "LEFT JOIN file_temp ft ON pf.FILE_ID = ft.ID\r\n" .
                        "LEFT JOIN product_type pt ON fp.PRODUCT_TYPE = pt.ID\r\n" .
                        "WHERE fp.IS_DELETE != 1\r\n" .
                        "ORDER BY fp.IS_RECOMMEND DESC;\r\n";
                    $db_query = mysqli_query($conn, $sql);
                    $i = 0;
                    while ($result = mysqli_fetch_array($db_query)) {
                        $product_id = $result['ID'];
                        $product_name = $result['NAME'];
                        $product_detail = $result['DETAIL'];
                        $product_price = $result['PRICE'];
                        $product_type = $result['PRODUCT_TYPE'];
                        $product_recommend = $result['IS_RECOMMEND'];
                        $product_stock = $result['IN_STOCK'];
                        $product_update = $result['UPDATE_DT'];
                        $product_update_by = $result['UPDATE_USER'];
                        $product_file = "../" . $result['FILE_PATH'];
                        $i += 1;
                    ?>

                        <div class="card column margin-4 my-card-custom" style="min-width: 250px;">
                            <div class="card-image">
                                <figure class="image is-4by4">
                                    <img src="<?php echo $product_file; ?>" alt="Placeholder image">
                                </figure>
                            </div>
                            <div class="card-content is-flex is-flex-direction-column">
                                <div class="media">
                                    <div class="media-left">
                                        <figure class="image is-48x48">
                                            <img src="<?php echo $product_file; ?>" alt="Placeholder image">
                                        </figure>
                                    </div>
                                    <div class="media-content">
                                        <p class="title is-5"><?php echo $product_name; ?></p>
                                        <p class="subtitle is-6"><?php echo $product_update_by; ?></p>
                                    </div>
                                </div>

                                <div class="content" style="min-height: 150px;">
                                    <?php echo $product_detail; ?> <br>
                                    <small>เหลือ <?php echo $product_stock; ?> ตัว </small><br>
                                    <small>ราคา <?php echo $product_price; ?> บาท </small><br>

                                    <a>@Fasion-Satle.com</a>.
                                    <a href="#">#<?php echo $product_type; ?></a>
                                    <br>
                                    <time datetime="2016-1-1"><?php echo $product_update; ?></time>
                                </div>

                                <nav class="tabs is-boxed is-fullwidth">
                                    <div class="container">
                                        <div class="buttons">
                                            <form action="../add_product.php" method="post">
                                                <input type="hidden" name="id" value="<?php echo $product_id; ?>">
                                                <button class="button is-danger" name="delete_product">
                                                    <i class="fa fa-trash" style="color: #f1f1f1;"></i>
                                                </button>
                                                <?php if($product_recommend == 0){?>
                                                    <button class="button" name="set_recommend_product">
                                                        <i class="fa-solid fa-star" style="color: hsl(48, 100%, 67%);"></i>
                                                    </button>
                                                <?php }?>
                                                <?php if($product_recommend == 1){?>
                                                    <button class="button is-warning" name="set_norecommend_product">
                                                        <i class="fa-solid fa-star" style="color: #f1f1f1;"></i>
                                                    </button>
                                                <?php }?>
                                            </form>
                                        </div>
                                    </div>
                                </nav>
                            </div>
                        </div>
                    <?php } ?>
                </div>

                <div class="admin-content rows is-desktop is-hidden card-flex" id="recommend-product-element">
                    <?php
                    $sql = "SELECT fp.ID, fp.NAME, fp.DETAIL, fp.PRICE, fp.IN_STOCK, pt.NAME AS PRODUCT_TYPE, fp.IS_RECOMMEND, fp.UPDATE_DT, fp.UPDATE_USER, ft.FILE_PATH FROM fasion_product fp \r\n" .
                        "LEFT JOIN product_file pf ON fp.ID = pf.PRODUCT_ID\r\n" .
                        "LEFT JOIN file_temp ft ON pf.FILE_ID = ft.ID\r\n" .
                        "LEFT JOIN product_type pt ON fp.PRODUCT_TYPE = pt.ID\r\n" .
                        "WHERE fp.IS_DELETE != 1 AND fp.IS_RECOMMEND\r\n";
                    $db_query = mysqli_query($conn, $sql);
                    $i = 0;
                    while ($result = mysqli_fetch_array($db_query)) {
                        $product_id = $result['ID'];
                        $product_name = $result['NAME'];
                        $product_detail = $result['DETAIL'];
                        $product_price = $result['PRICE'];
                        $product_type = $result['PRODUCT_TYPE'];
                        $product_recommend = $result['IS_RECOMMEND'];
                        $product_stock = $result['IN_STOCK'];
                        $product_update = $result['UPDATE_DT'];
                        $product_update_by = $result['UPDATE_USER'];
                        $product_file = "../" . $result['FILE_PATH'];
                        $i += 1;
                    ?>
                        <div class="card column margin-4 my-card-custom">
                            <div class="card-image">
                                <figure class="image is-4by4">
                                    <img src="<?php echo $product_file; ?>" alt="Placeholder image">
                                </figure>
                            </div>
                            <div class="card-content is-flex is-flex-direction-column">
                                <div class="media">
                                    <div class="media-left">
                                        <figure class="image is-48x48">
                                            <img src="<?php echo $product_file; ?>" alt="Placeholder image">
                                        </figure>
                                    </div>
                                    <div class="media-content">
                                        <p class="title is-5"><?php echo $product_name; ?></p>
                                        <p class="subtitle is-6"><?php echo $product_update_by; ?></p>
                                    </div>
                                </div>

                                <div class="content" style="min-height: 150px;">
                                    <?php echo $product_detail; ?> <br>
                                    <small>เหลือ <?php echo $product_stock; ?> ตัว </small><br>
                                    <small>ราคา <?php echo $product_price; ?> บาท </small><br>

                                    <a>@Fasion-Satle.com</a>.
                                    <a href="#">#<?php echo $product_type; ?></a>
                                    <br>
                                    <time datetime="2016-1-1"><?php echo $product_update; ?></time>
                                </div>

                                <nav class="tabs is-boxed is-fullwidth">
                                    <div class="container">
                                        <div class="buttons">
                                            <!-- <form action="../add_product.php" method="post">
                                                <input type="hidden" name="id" value="<?php echo $product_id; ?>">
                                                <button class="button is-danger" name="delete_product">
                                                    <i class="fa fa-trash" style="color: #f1f1f1;"></i>
                                                </button>
                                            </form> -->
                                        </div>
                                    </div>
                                </nav>
                            </div>
                        </div>
                    <?php } ?>
                </div>

                <div class="admin-content rows is-desktop" id="loading-product-element">
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
                        "    loads.PATH_BILL,\r\n" .
                        "    loads.ADDRESS,\r\n" .
                        "    prod.NAME,\r\n" .
                        "    prod.DETAIL,\r\n" .
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
                        $load_address = $result['ADDRESS'];
                        $load_bill = $result['PATH_BILL'];
                        $load_qty = $result['QTY'];
                        $load_update = $result['UPDATED_DT'];
                        $load_create = $result['CREATED_DT'];
                        $load_username = $result['USER_NAME'];
                        // $load_usertel = $result['USER_TEL'];
                        $load_file = "../" . $result['FILE_PATH'];
                        include '../shared/modal_img.php';
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
                                            <?php echo $load_address ?>
                                        </p>
                                    </div>
                                    <form action="../add_product.php" method="post" enctype="multipart/form-data">
                                        <nav class="level is-mobile is-flex is-flex-direction-row is-justify-content-flex-between is-align-items-end" style="height: fit-content !important;">
                                            <div class="is-flex is-flex-direction-column">
                                                <small>จำนวน : <?php echo $load_qty; ?></small>
                                                <small>ราคา/ชิ้น : <?php echo $load_price; ?></small>
                                                <br>
                                                <div class="is-flex is-flex-direction-row">
                                                    <div class="select is-primary">
                                                        <select id="status" name="status">
                                                            <option value="wait_check_bills" <?php if ($load_status == 'wait_check_bills') echo 'selected'; ?>>รอชำระเงิน</option>
                                                            <option value="wait_verify" <?php if ($load_status == 'wait_verify') echo 'selected'; ?>>รอตรวจสอบ</option>
                                                            <option value="product_packing" <?php if ($load_status == 'product_packing') echo 'selected'; ?>>จัดเตรียมสินค้า</option>
                                                            <option value="transporting" <?php if ($load_status == 'transporting') echo 'selected'; ?>>กำลังขนส่ง</option>
                                                            <option value="success" <?php if ($load_status == 'success') echo 'selected'; ?>>ส่งสินค้าสำเร็จ</option>
                                                        </select>
                                                    </div>
                                                    <?php if ($load_status != "wait_check_bills") { ?>
                                                    <button type="button" class="button is-light js-modal-trigger" style="margin-left: 10px;" data-target="modal-js-bill-img">ดูบิล</button>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="level-left">
                                                <input type="hidden" name="id" value="<?php echo $load_id; ?>">
                                                <button class="level-item button is-primary" aria-label="reply" type="submit" name="load_product_update_status">
                                                    <span class="is-small">
                                                        <i class="fas fa-edit" aria-hidden="true"></i>Save
                                                    </span>
                                                </button>
                                            </div>
                                        </nav>
                                    </form>
                                </div>
                            </article>
                        </div>
                    <?php } ?>
                </div>

                <div class="admin-content rows is-desktop is-hidden" id="setting-group-element">
                    <table class="table table table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
                        <thead>
                            <tr>
                                <th>ลำดับที่</th>
                                <th>ชื่อประเภทสินค้า</th>
                                <th>
                                    <button class="button is-primary js-modal-trigger" type="submit" name="delete_product_type" data-target="modal-js-addtype">
                                        <i class="fa-solid fa-plus" style="color:white; margin-right: 5px;"> </i>
                                        <span style="color:white;"> Add Type</span>
                                    </button>
                                </th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>...</th>
                                <th>...</th>
                                <th>...</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $sql =  "SELECT \r\n" .
                                "    *\r\n" .
                                "FROM product_type\r\n" .
                                "WHERE IS_DELETE = 0\r\n";
                            $db_query = mysqli_query($conn, $sql);
                            $i = 0;
                            while ($result = mysqli_fetch_array($db_query)) {
                                $group_id = $result['ID'];
                                $group_name = $result['NAME'];
                            ?>
                                <tr>
                                    <th> <?php echo ++$i; ?></th>
                                    <td> <?php echo $group_name ?></td>
                                    <td>
                                        <form action="../add_product.php" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="id" value="<?php echo $group_id; ?>">
                                            <button class="button is-danger" type="submit" name="delete_product_type">
                                                <i class="fa-solid fa-trash" style="color:white; margin-right: 5px;"> </i>
                                                <span style="color:white;"> Delete</span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <div class="admin-content rows is-desktop is-hidden" id="setting-user-element">
                    <table class="table table table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
                        <thead>
                            <tr>
                                <th>ลำดับที่</th>
                                <th>Username</th>
                                <th class="is-hidden-mobile">Email</th>
                                <th class="is-hidden-mobile">User type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>...</th>
                                <th>...</th>
                                <th class="is-hidden-mobile">...</th>
                                <th class="is-hidden-mobile">...</th>
                                <th>...</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $sql =  "SELECT \r\n" .
                                "    fu.ID,\r\n" .
                                "    fu.USER_NAME,\r\n" .
                                "    fu.EMAIL,\r\n" .
                                "    ft.NAME\r\n" .
                                "FROM fasion_user fu\r\n" .
                                "LEFT JOIN fasion_user_type ft ON fu.USER_TYPE = ft.ID\r\n" .
                                "WHERE fu.IS_DELETE = 0\r\n";
                            $db_query = mysqli_query($conn, $sql);
                            $i = 0;
                            while ($result = mysqli_fetch_array($db_query)) {
                                $user_id = $result['ID'];
                                $user_name = $result['USER_NAME'];
                                $user_email = $result['EMAIL'];
                                $user_type = $result['NAME'];
                            ?>
                                <tr>
                                    <th> <?php echo ++$i; ?></th>
                                    <td> <?php echo $user_name ?></td>
                                    <td class="is-hidden-mobile"> <?php echo $user_email ?></td>
                                    <td class="is-hidden-mobile"> <?php echo $user_type ?></td>
                                    <td>
                                        <form action="../add_product.php" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="id" value="<?php echo $user_id; ?>">
                                            <button class="button is-danger" type="submit" name="delete_user_type">
                                                <i class="fa-solid fa-trash" style="color:white; margin-right: 5px;"> </i>
                                                <span style="color:white;"> Delete</span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <div class="admin-content rows is-desktop is-hidden table-responsive" id="setting-deleted-element">
                    <h4 class="title is-4" style="margin: 0;">จัดการฐานข้อมูลสินค้าที่ถูกลบ</h4>
                    <br>
                    <table class="table table table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
                        <thead>
                            <tr>
                                <th>ลำดับที่</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th class="is-hidden-mobile">Detail</th>
                                <th class="is-hidden-mobile">Price</th>
                                <th class="is-hidden-mobile">Stock</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>...</th>
                                <th>...</th>
                                <th class="is-hidden-mobile">...</th>
                                <th class="is-hidden-mobile">...</th>
                                <th class="is-hidden-mobile">...</th>
                                <th>...</th>
                                <th>...</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $sql = "SELECT fp.ID, fp.NAME, fp.DETAIL, fp.PRICE, fp.IN_STOCK, pt.NAME AS PRODUCT_TYPE, fp.UPDATE_DT, fp.UPDATE_USER, ft.FILE_PATH FROM fasion_product fp \r\n" .
                                "LEFT JOIN product_file pf ON fp.ID = pf.PRODUCT_ID\r\n" .
                                "LEFT JOIN file_temp ft ON pf.FILE_ID = ft.ID\r\n" .
                                "LEFT JOIN product_type pt ON fp.PRODUCT_TYPE = pt.ID\r\n" .
                                "WHERE fp.IS_DELETE = 1\r\n";
                            $db_query = mysqli_query($conn, $sql);
                            $i = 0;
                            while ($result = mysqli_fetch_array($db_query)) {
                                $deleted_prod_id = $result['ID'];
                                $deleted_prod_name = $result['NAME'];
                                $deleted_prod_detail = $result['DETAIL'];
                                $deleted_prod_price = $result['PRICE'];
                                $deleted_prod_type = $result['PRODUCT_TYPE'];
                                $deleted_prod_stock = $result['IN_STOCK'];
                                $deleted_prod_update = $result['UPDATE_DT'];
                                $deleted_prod_update_by = $result['UPDATE_USER'];
                                $deleted_prod_file = "../" . $result['FILE_PATH'];
                            ?>
                                <tr>
                                    <th> <?php echo ++$i; ?></th>
                                    <td>
                                        <figure class="image is-96x96 is-48x48-mobile">
                                            <img src="<?php echo $deleted_prod_file ?>">
                                        </figure>
                                    </td>
                                    <td> <?php echo $deleted_prod_name ?></td>
                                    <td class="is-hidden-mobile"> <?php echo $deleted_prod_detail ?></td>
                                    <td class="is-hidden-mobile"> <?php echo $deleted_prod_price ?></td>
                                    <td class="is-hidden-mobile"> <?php echo $deleted_prod_stock ?></td>
                                    <td>
                                        <form action="../add_product.php" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="id" value="<?php echo $deleted_prod_id; ?>">
                                            <button class="button is-info" type="submit" name="restore_prod_type">
                                                <span style="color:white;"> Restore</span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>

    <?php include '../shared/modal.php'; ?>
    <!-- JS -->
    <script src="../main_js.js"></script>


</body>

</html>