<div id="modal-js-buy-product" class="modal">
    <form action="../add_product.php" method="post" enctype="multipart/form-data">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">ADD PRODUCT TYPE</p>
                <button class="delete" type="button" aria-label="close"></button>
            </header>
            <section class="modal-card-body is-flex is-flex-direction-column" style="gap: 10px;">
                <div class="form-container columns is-align-items-start" style="gap: 10px;">
                    <label style="width: 150px; text-align: end; height: fit-content;">เบอร์โทรศัพท์ :</label>
                    <input id="product_name" style="max-width: 50%;" class="input" type="text" name="user_tel" placeholder="กรอกเบอร์โทรศัพท์">
                </div>
                <div class="form-container columns is-align-items-start" style="gap: 10px;">
                    <label style="width: 150px; text-align: end; height: fit-content;">จำนวน :</label>
                    <input id="product_name" style="max-width: 50%;" class="input" type="text" name="qty" placeholder="กรอกจำนวน">
                </div>
                <div class="form-container columns is-align-items-start" style="gap: 10px;">
                    <label style="width: 150px; text-align: end; height: fit-content;">ที่อยู่ :</label>
                    <div style="width: 350px;">
                        <textarea class="textarea" placeholder="กรอกที่อยู่" name="address"></textarea>
                    </div>
                </div>
            </section>
            <footer class="modal-card-foot">
                <button class="button is-success" type="submit" name="buy_product">Add Product Type</button>
                <button class="button" type="button">Cancel</button>
            </footer>
        </div>
    </form>
</div>