<!-- MODAL -->
<div id="modal-js-add" class="modal">
    <form action="../add_product.php" method="post" enctype="multipart/form-data">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">ADD PRODUCT</p>
                <button class="delete" type="button" aria-label="close"></button>
            </header>
            <section class="modal-card-body">
                <div class="file is-warning has-name is-boxed is-flex is-justify-content-center">
                    <label class="file-label">
                        <input class="file-input" type="file" name="fileupload">
                        <span class="file-cta">
                            <span class="file-icon">
                                <i class="fas fa-upload"></i>
                            </span>
                            <span class="file-label">
                                Choose a file…
                            </span>
                        </span>
                        <span class="file-name">
                            File name <!-- here -->
                        </span>
                    </label>
                </div>
                <br>
                <!-- <br>
                    <div class="form-container columns is-align-items-center" style="gap: 10px;">
                        <label style="width: 150px; text-align: end; height: fit-content;">รหัสสินค้า :</label>
                        <input id="product_id" style="max-width: 10%;" class="input" type="text" name="product_id" readonly>
                    </div> -->
                <br>
                <div class="form-container columns is-align-items-center" style="gap: 10px;">
                    <label style="width: 150px; text-align: end; height: fit-content;">ชื่อสินค้า :</label>
                    <input id="product_name" style="max-width: 50%;" class="input" type="text" name="product_name" placeholder="กรอกชื่อสินค้า">
                </div>
                <br>
                <div class="form-container columns is-align-items-center" style="gap: 10px;">
                    <label style="width: 150px; text-align: end; height: fit-content;">รายละเอียดสินค้า :</label>
                    <input id="product_detail" style="max-width: 50%;" class="input" type="text" name="product_detail" placeholder="กรอกรายละเอียดสินค้า">
                </div>
                <br>
                <div class="form-container columns is-align-items-center" style="gap: 10px;">
                    <label style="width: 150px; text-align: end; height: fit-content;">ประเภทสินค้า :</label>
                    <div class="select">
                        <select name="product_type">
                            <?php
                            $sql = "SELECT * FROM product_type";
                            $db_query = mysqli_query($conn, $sql);
                            while ($result = mysqli_fetch_array($db_query)) {
                                $name = $result['NAME'];
                                $id = $result['ID'];
                            ?>
                                <option value="<?php echo $id; ?>"><?php echo $name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <br>
                <div class="form-container columns is-align-items-center" style="gap: 10px;">
                    <label style="width: 150px; text-align: end; height: fit-content;">จำนวนสินค้า :</label>
                    <input id="stock" style="max-width: 20%;" class="input" type="text" name="stock" placeholder="กรอกจำนวน">
                    <label>ชิ้น</label>
                </div>
                <br>
                <div class="form-container columns is-align-items-center" style="gap: 10px;">
                    <label style="width: 150px; text-align: end; height: fit-content;">ราคาสินค้า :</label>
                    <input id="price" style="max-width: 20%;" class="input" type="text" name="price" placeholder="กรอกราคา">
                    <label>บาท</label>
                </div>
                <br>


                <!-- JS Func -->
                <script>
                    const fileInput = document.querySelector(".file-input");
                    const fileNameSpan = document.querySelector(".file-name");

                    fileInput.addEventListener("change", function() {
                        fileNameSpan.textContent = this.files[0].name;
                    });
                </script>

            </section>
            <footer class="modal-card-foot">
                <button class="button is-success" type="submit" name="add_product">Add Product</button>
                <button class="button" type="button">Cancel</button>
            </footer>
        </div>
    </form>
</div>

<div id="modal-js-addtype" class="modal">
    <form action="../add_product.php" method="post" enctype="multipart/form-data">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">ADD PRODUCT TYPE</p>
                <button class="delete" type="button" aria-label="close"></button>
            </header>
            <section class="modal-card-body">
                <div class="form-container columns is-align-items-center" style="gap: 10px;">
                    <label style="width: 150px; text-align: end; height: fit-content;">ชื่อประเภท :</label>
                    <input id="product_name" style="max-width: 50%;" class="input" type="text" name="product_type_name" placeholder="กรอกประเภทสินค้า">
                </div>
            </section>
            <footer class="modal-card-foot">
                <button class="button is-success" type="submit" name="add_product_type">Add Product Type</button>
                <button class="button" type="button">Cancel</button>
            </footer>
        </div>
    </form>
</div>

