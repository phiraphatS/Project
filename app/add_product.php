<?php 
    session_start();
    include('connect.php');
    include('test.php');

    $errors = array();

    if (isset($_POST['add_product'])){
        $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
        $product_detail = mysqli_real_escape_string($conn, $_POST['product_detail']);
        $product_type = mysqli_real_escape_string($conn, $_POST['product_type']);
        $stock = mysqli_real_escape_string($conn, $_POST['stock']);
        $price = mysqli_real_escape_string($conn, $_POST['price']);
        $userid = $_SESSION['username'];
        $date_now = date("Y-m-d H:i:s");

        // ABOUT FILE
        $file = $_FILES['fileupload'];

        // FILE PROPERTY
        $file_name = $file['name'];
        $file_tmp = $file['tmp_name'];
        $file_size = $file['size'];
        $file_error = $file['error'];
        
        // File extension
        $file_ext = explode('.', $file_name);
        $file_ext = strtolower(end($file_ext));
        $file_path = "";
        
        // Allowed file types
        $allowed = array('txt', 'jpg', 'jpeg', 'png');

        if (in_array($file_ext, $allowed)) {
            // Check if there are any errors
            if ($file_error === 0) {
                // Check file size
                if ($file_size <= 10000000) {
                    // File destination
                    $file_path = 'uploads/' . $file_name;
    
                    // Move file to destination
                    if (move_uploaded_file($file_tmp, $file_path)) {
                        echo $file_path . ' was uploaded successfully';
                    }
                } else {
                    array_push($errors, "file is oversize");
                }
            } else {
                array_push($errors, "file is error");
            }
        } else {
            array_push($errors, "file ext is not math");
        }

        if (empty($product_name)) {
            array_push($errors, "product name is required");
        }
        if (empty($stock)){
            array_push($errors, "stock number is required");
        }
        if (empty($price)){
            array_push($errors, "price is required");
        }

        if(count($errors) == 0){

            // INSERT DATA
            $sql1 =  "INSERT INTO fasion_product (NAME, DETAIL, IN_STOCK, PRICE, PRODUCT_TYPE, UPDATE_DT, UPDATE_USER) \r\n"
                    ."VALUES ('$product_name','$product_detail','$stock', '$price', $product_type, '$date_now', '$userid')";
            mysqli_query($conn, $sql1);
            $product_id = mysqli_insert_id($conn);

            // SAVE FILE
            $sql2 = "INSERT INTO file_temp (FILE_PATH, FILE_NAME, FILE_EXT, FILE_TMPNAME, FILE_SIZE, FILE_TYPE) \r\n"
                    ."VALUES ('$file_path', '$file_name', '$file_ext', '$file_tmp', '$file_size', '$file_ext')";
            mysqli_query($conn, $sql2);
            $file_update_id = mysqli_insert_id($conn);

            // LINK TABLE TOGETHER
            $sql3 = "INSERT INTO product_file (PRODUCT_ID, FILE_ID) VALUES ('$product_id', '$file_update_id')";
            mysqli_query($conn, $sql3);

            echo '<div class="black"><div class="loading">Loading...</div></div>';
            echo '<style>
                    .black {
                        width: 100%;
                        height: 100%;
                        background-color: black;
                        z-index: 998;
                    }
                    .loading {
                        position: fixed;
                        top: 50%;
                        left: 50%;
                        transform: translate(-50%, -50%);
                        z-index: 999;
                    }
                </style>';

            // Add a delay before redirecting the page
            sleep(3);
            header('location: ../app/admin/admin-home.php');
        }else{
            debug_to_console($errors);
        }
    }

    if (isset($_POST['delete_product'])) {
        $id = $_POST['id'];
        $sql = "UPDATE fasion_product SET IS_DELETE = 1 WHERE ID = $id";
        mysqli_query($conn, $sql);
        header('location: ../app/admin/admin-home.php');
    }

    if (isset($_POST['set_recommend_product'])) {
        $id = $_POST['id'];
        $sql = "UPDATE fasion_product SET IS_RECOMMEND = 1 WHERE ID = $id";
        mysqli_query($conn, $sql);
        header('location: ../app/admin/admin-home.php');
    }

    if (isset($_POST['set_norecommend_product'])) {
        $id = $_POST['id'];
        $sql = "UPDATE fasion_product SET IS_RECOMMEND = 0 WHERE ID = $id";
        mysqli_query($conn, $sql);
        header('location: ../app/admin/admin-home.php');
    }

    if (isset($_POST['set_recommend_product'])) {
        $id = $_POST['id'];

        if (empty($id)) {
            die("Invalid input data");
        }

        $sql = "UPDATE fasion_product SET IS_RECOMMEND = 1 WHERE ID = $id";
        if (!mysqli_query($conn, $sql)) {
            die("SQL error: " . mysqli_error($conn));
        }

        // redirect to the admin home page
        header('location: ../app/admin/admin-home.php');
        exit();
    }

    if (isset($_POST['load_product_update_status'])) {
        $id = $_POST['id'];
        $status = $_POST['status'];

        // validate input data
        if (empty($id) || empty($status)) {
            die("Invalid input data");
        }

        // prepare and execute the SQL statement
        $sql = "UPDATE product_loading SET STATUS = '$status' WHERE ID = '$id'";
        if (!mysqli_query($conn, $sql)) {
            die("SQL error: " . mysqli_error($conn));
        }

        // redirect to the admin home page
        header('location: ../app/admin/admin-home.php');
        exit();
    }

    if (isset($_POST['delete_product_type'])) {
        $id = $_POST['id'];

        // validate input data
        if (empty($id)) {
            die("Invalid input data");
        }

        // prepare and execute the SQL statement
        $sql = "UPDATE product_type SET IS_DELETE = 1 WHERE ID = '$id'";
        if (!mysqli_query($conn, $sql)) {
            die("SQL error: " . mysqli_error($conn));
        }

        // redirect to the admin home page
        header('location: ../app/admin/admin-home.php');
        exit();
    }

    if (isset($_POST['add_product_type'])) {
        $name = $_POST['product_type_name'];
        $userid = $_SESSION['username'];
        $date_now = date("Y-m-d H:i:s");

        // validate input data
        if (empty($name)) {
            die("Invalid input data");
        }

        // prepare and execute the SQL statement
        $sql = "INSERT INTO product_type (NAME, UPDATE_DT, UPDATE_BY, IS_DELETE) VALUES ('$name', '$date_now', '$userid', 0)";
        if (!mysqli_query($conn, $sql)) {
            die("SQL error: " . mysqli_error($conn));
        }

        // redirect to the admin home page
        header('location: ../app/admin/admin-home.php');
        exit();
    }

    if (isset($_POST['delete_user_type'])) {
        $id = $_POST['id'];

        // validate input data
        if (empty($id)) {
            die("Invalid input data");
        }

        // prepare and execute the SQL statement
        $sql = "UPDATE fasion_user SET IS_DELETE = 1 WHERE ID = '$id'";
        if (!mysqli_query($conn, $sql)) {
            die("SQL error: " . mysqli_error($conn));
        }

        // redirect to the admin home page
        header('location: ../app/admin/admin-home.php');
        exit();
    }

    if (isset($_POST['restore_prod_type'])) {
        $id = $_POST['id'];

        debug_to_console($id);
        // validate input data
        if (empty($id)) {
            die("Invalid input data");
        }

        // prepare and execute the SQL statement
        $sql = "UPDATE fasion_product SET IS_DELETE = 0 WHERE ID = '$id'";
        if (!mysqli_query($conn, $sql)) {
            die("SQL error: " . mysqli_error($conn));
        }

        // redirect to the admin home page
        header('location: ../app/admin/admin-home.php');
        exit();
    }

    if (isset($_POST['cart_verify'])) {
        $id = $_POST['id'];

        debug_to_console($id);
        // validate input data
        if (empty($id)) {
            die("Invalid input data");
        }

        // prepare and execute the SQL statement
        $sql = "UPDATE product_loading SET STATUS = 'success' WHERE ID = '$id'";
        if (!mysqli_query($conn, $sql)) {
            die("SQL error: " . mysqli_error($conn));
        }

        // redirect to the admin home page
        header('location: ../app/customer/customer-buying.php');
        exit();
    }

    if (isset($_POST['fileupload_bin'])) {
        $errors = array();
        $id = $_POST['id'];

        // ABOUT FILE
        $file = $_FILES['fileuploadbin'];

        // FILE PROPERTY
        $file_name = $file['name'];
        $file_tmp = $file['tmp_name'];
        $file_size = $file['size'];
        $file_error = $file['error'];
        
        // File extension
        $file_ext = explode('.', $file_name);
        $file_ext = strtolower(end($file_ext));
        $file_path = "";
        
        // Allowed file types
        $allowed = array('txt', 'jpg', 'jpeg', 'png');

        if (in_array($file_ext, $allowed)) {
            // Check if there are any errors
            if ($file_error === 0) {
                // Check file size
                if ($file_size <= 10000000) {
                    // File destination
                    $file_path = 'uploads/' . $file_name;
    
                    // Move file to destination
                    if (move_uploaded_file($file_tmp, $file_path)) {
                        echo $file_path . ' was uploaded successfully';
                    }
                } else {
                    array_push($errors, "file is oversize");
                }
            } else {
                array_push($errors, "file is error");
            }
        } else {
            array_push($errors, "file ext is not math");
        }

        if(count($errors) == 0){
            // prepare and execute the SQL statement
            $sql = "UPDATE product_loading SET STATUS = 'wait_verify', PATH_BILL = '$file_path' WHERE ID = '$id'";
            if (!mysqli_query($conn, $sql)) {
                die("SQL error: " . mysqli_error($conn));
            }

            // redirect to the admin home page
            header('location: ../app/customer/customer-buying.php');
            exit();
        } else {
            die($errors.join(', '));
        }
    }


    if (isset($_POST['buy_product'])) {

        if (!isset($_SESSION['username'])) {
            die("Please Login Before");
            header('location: ../app/auth/auth-login.php');
            exit();
        }

        $id = $_POST['id'];
        $user_tel = $_POST['user_tel'];
        $qty = $_POST['qty'];
        $address = $_POST['address'];
        $userid = $_SESSION['username'];
        $date_now = date("Y-m-d H:i:s");

        // validate input data
        if (empty($id) && empty($textarea) && empty($qty) && empty($user_tel)) {
            die("Invalid input data");
        }

        // prepare and execute the SQL statement
        $sql = "SELECT IN_STOCK FROM fasion_product WHERE ID = $id";
        $db_query = mysqli_query($conn, $sql);
        $result = mysqli_fetch_assoc($db_query);

        if($qty > $result['IN_STOCK']) {
            die("Insufficient stock : " . mysqli_error($conn));
        }

        $sql = "UPDATE fasion_product SET IN_STOCK = (IN_STOCK - $qty) WHERE ID = '$id'";
        if (!mysqli_query($conn, $sql)) {
            die("SQL error: " . mysqli_error($conn));
        }

        $sql = "INSERT INTO product_loading (USER_TEL, ADDRESS, USER_NAME, PRODUCT_ID, QTY, CREATED_DT) \r\n" . 
        "VALUES('$user_tel', '$address', '$userid', '$id', '$qty', '$date_now')";
        if (!mysqli_query($conn, $sql)) {
            die("SQL error: " . mysqli_error($conn));
        }

        // redirect to the admin home page
        header('location: ../app/customer/customer-home.php');
        exit();
    }
