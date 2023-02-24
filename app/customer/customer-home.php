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
    <title>Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
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
                <!-- <button class="nav-list">
                    <a href="#about" class="nav-link active">ABOUT US</a>
                </button> -->
                <button class="nav-list">
                    <?php if(!isset($_SESSION['username'])) { ?>
                        <a href="../service.php?login='1'" class="nav-link active">LOGIN</a>
                    <?php } else { ?>
                        <a href="../service.php?logout='1'" class="nav-link active">LOGOUT</a>
                    <?php } ?>
                </button>
            </div>
        </nav>
        <!-- PRE BODY -->
        <section class="hero is-large header-img">
            <div class="hero-head">
                <nav class="navbar">
                    <div class="container">
                        <div class="navbar-brand">
                            <a class="navbar-item">
                                <p class="title">Fasion-Satle.com</p>
                                <!-- <img src="https://bulma.io/images/bulma-type-white.png" alt="Logo"> -->
                            </a>
                            <span class="navbar-burger" data-target="navbarMenuHeroB">
                                <span></span>
                                <span></span>
                                <span></span>
                            </span>
                        </div>
                        <!-- <div id="navbarMenuHeroB" class="navbar-menu">
                        <div class="navbar-end">
                            <a class="navbar-item is-active">
                                Home
                            </a>
                            <a class="navbar-item">
                                Examples
                            </a>
                            <a class="navbar-item">
                                Documentation
                            </a>
                            <span class="navbar-item">
                                <a class="button is-info is-inverted">
                                    <span class="icon">
                                        <i class="fab fa-github"></i>
                                    </span>
                                    <span>Download</span>
                                </a>
                            </span>
                        </div>
                    </div> -->
                    </div>
                </nav>
            </div>

            <div class="hero-body">
                <div class="container has-text-centered">
                    <p class="title">
                        FASION
                    </p>
                    <p class="subtitle">
                        เว็บไซต์ขายเสื้อผ้ายอดนิยม
                    </p>
                </div>
            </div>

            <div class="hero-foot">
                
            </div>
        </section>
    </header>

    <br>
    <div class="container is-fullhd card-flex is-flex is-flex-wrap-wrap">
        <?php
        $sql = "SELECT fp.ID, fp.NAME, fp.DETAIL, fp.PRICE, fp.IN_STOCK, pt.NAME AS PRODUCT_TYPE, fp.UPDATE_DT, fp.UPDATE_USER, ft.FILE_PATH FROM fasion_product fp \r\n" .
            "LEFT JOIN product_file pf ON fp.ID = pf.PRODUCT_ID\r\n" .
            "LEFT JOIN file_temp ft ON pf.FILE_ID = ft.ID\r\n" .
            "LEFT JOIN product_type pt ON fp.PRODUCT_TYPE = pt.ID\r\n" .
            "WHERE fp.IS_DELETE != 1\r\n";
        $db_query = mysqli_query($conn, $sql);
        $i = 0;
        while ($result = mysqli_fetch_array($db_query)) {
            $product_id = $result['ID'];
            $product_name = $result['NAME'];
            $product_detail = $result['DETAIL'];
            $product_price = $result['PRICE'];
            $product_type = $result['PRODUCT_TYPE'];
            $product_stock = $result['IN_STOCK'];
            $product_update = $result['UPDATE_DT'];
            $product_update_by = $result['UPDATE_USER'];
            $product_file = "../" . $result['FILE_PATH'];
            $i += 1;
        ?>
            <!-- Card 1 -->
            <div class="card column margin-4  my-card-custom" style="min-width: 250px;">
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
                        เหลือ <?php echo $product_stock; ?> ตัว <br>
                        ราคา <?php echo $product_price; ?> บาท <br>

                        <a>@Fasion-Satle.com</a>.
                        <a href="#">#<?php echo $product_type; ?></a>
                        <br>
                        <time datetime="2016-1-1"><?php echo $product_update; ?></time>
                    </div>

                    <nav class="tabs is-boxed is-fullwidth">
                        <div class="container">
                            <form action="../add_product.php" method="post" enctype="multipart/form-data">
                                <div class="buttons">
                                    <input type="hidden" name="id" value="<?php echo $product_id; ?>">
                                    <button type="button" class="button is-primary js-modal-trigger" data-target="modal-js-buy-product">
                                        <i class="fa-solid fa-cart-shopping" style="color: rgb(228, 255, 247);"></i>
                                    </button>
                                    <!-- <button class="button is-info" onclick="window.location.href = 'customer-product.html';">View</button> -->
                                    <?php include '../shared/modal_buy.php'; ?>
                                </div>
                            </form>
                        </div>
                    </nav>
                </div>
            </div>
        <?php } ?>
    </div>

    <br>

    <?php include '../shared/footer.php';?>

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