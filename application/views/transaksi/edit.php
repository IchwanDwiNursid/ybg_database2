<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Form <?= $judul ?></h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <div class="card-body">
                        <?php echo validation_errors(); ?>
                        <?php echo form_open('transaksi/update/' . $customer['id']); ?>

                        <div class="form-group">
                            <label for="kd_transaksi">Kode Transaksi</label>
                            <input type="text" class="form-control" id="kd_transaksi" name="kd_transaksi" value="<?php echo $customer['kd_transaksi']; ?>">
                        </div>

                        <div class="form-group">
                            <label for="dateTransaction">Tanggal Transaksi</label>
                            <input type="date" class="form-control" id="dateTransaction" name="dateTransaction" value="<?php echo $customer['dateTransaction']; ?>">
                        </div>

                        <div class="form-group">
                            <label for="idCategoryCust">Category Customer</label>
                            <select class="form-control" id="idCategoryCust" name="idCategoryCust">
                                <?php foreach ($CategoryCust as $catCust): ?>
                                    <option value="<?php echo $catCust['idCategoryCust']; ?>" <?php echo ($customer['idCategoryCust'] == $catCust['CategoryCust']) ? 'selected' : ''; ?>><?php echo $catCust['CategoryCust']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="IdSales">Sales Advisor</label>
                            <select class="form-control" id="IdSales" name="IdSales">
                                <?php foreach ($salesadvisors as $sales): ?>
                                    <option value="<?php echo $sales['IdSales']; ?>" <?php echo ($customer['IdSales'] == $sales['IdSales']) ? 'selected' : ''; ?>><?php echo $sales['Name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="idMethode">Payment Method</label>
                            <select class="form-control" id="idMethode" name="idMethode">
                                <?php foreach ($payment as $methode): ?>
                                    <option value="<?php echo $methode['idMethode']; ?>" <?php echo ($customer['idMethode'] == $methode['idMethode']) ? 'selected' : ''; ?>><?php echo $methode['Methode']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="Brand">Brand</label>
                            <input type="text" class="form-control" id="Brand" name="Brand" value="<?php echo $customer['Brand']; ?>">
                        </div>

                        <div class="form-group">
                            <label for="SKUName">SKU</label>
                            <input type="text" class="form-control" id="SKUName" name="SKUName" value="<?php echo $customer['SKUName']; ?>">
                        </div>

                        <div class="form-group">
                            <label for="idCategoryProduk">Category Produk</label>
                            <select class="form-control" id="idCategoryProduk" name="idCategoryProduk">
                                <?php foreach ($CategoryProduk as $catProd): ?>
                                    <option value="<?php echo $catProd['idCategoryProduk']; ?>" <?php echo ($customer['idCategoryProduk'] == $catProd['idCategoryProduk']) ? 'selected' : ''; ?>><?php echo $catProd['CategoryProduk']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="QtyOrder">Qty</label>
                            <input type="number" class="form-control" id="QtyOrder" name="QtyOrder" value="<?php echo $customer['QtyOrder']; ?>">
                        </div>

                        <div class="form-group">
                            <label for="BasePrice">Base Price</label>
                            <input type="number" class="form-control" id="BasePrice" name="BasePrice" value="<?php echo $customer['BasePrice']; ?>" oninput="calculateDiscount()">
                        </div>

                        <div class="form-group">
                            <label for="BeforeDisc">Before Disc</label>
                            <input type="number" class="form-control" id="BeforeDisc" name="BeforeDisc" value="<?php echo $customer['BeforeDisc']; ?>">
                        </div>

                        <div class="form-group">
                            <label for="Discount">Discount</label>
                            <input type="number" class="form-control" id="Discount" name="Discount" value="<?php echo $customer['Discount']; ?>">
                        </div>

                        <div class="form-group">
                            <label for="AfterDisc">After Disc</label>
                            <input type="number" class="form-control" id="AfterDisc" name="AfterDisc" value="<?php echo $customer['AfterDisc']; ?>">
                        </div>

                        <div class="form-group">
                            <label for="idvoucher">Voucher</label>
                            <select multiple class="form-control" id="idvoucher" name="idvoucher[]" onchange="calculateDiscount()">
                                <?php foreach ($voucher_options as $voucher): ?>
                                    <option value="<?php echo $voucher['idvoucher']; ?>" data-nominal="<?= $voucher['nominal']; ?>"
                                        <?php
                                        foreach ($customer['idvoucher']  as $idv) {
                                            echo ($voucher['idvoucher'] == $idv ? 'selected' : '');
                                        }
                                        ?>><?php echo $voucher['namavoucher']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="Point">Point Gained</label>
                            <input type="number" class="form-control" id="Point" name="Point" value="<?php echo $customer['Point']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="pointclaim">Claim Point</label>
                            <input type="number" class="form-control" id="pointclaim" name="pointclaim" value="<?php echo $customer['pointclaim']; ?>">
                        </div>

                        <div class="form-group">
                            <label for="Keterangan">Keterangan</label>
                            <textarea class="form-control" id="Keterangan" name="Keterangan"><?php echo $customer['Keterangan']; ?></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="<?php echo base_url('transaksi'); ?>" class="btn btn-secondary">Batal</a>
                        <?php echo form_close(); ?>
                    </div>
                </div>
                <!-- /.card -->


            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
    </div>
    <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->