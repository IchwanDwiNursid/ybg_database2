<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-8">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Form Tambah Customer</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->

                    <div class="mx-3 mt-3">
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger"><?= $error; ?></div>
                        <?php endif; ?>
                        <form action="<?= base_url('Transaksi/simpanCust/' . $hp); ?>" method="post">
                            <input type="hidden" name="kd_transaksi" value="<?= $data_order['kd_transaksi'] ?>">
                            <input type="hidden" name="dateTransaction" value="<?= $data_order['dateTransaction'] ?>">
                            <input type="hidden" name="IdSales" value="<?= $data_order['IdSales'] ?>">
                            <input type="hidden" name="idMethode" value="<?= $data_order['idMethode'] ?>">
                            <input type="hidden" name="Brand" value="<?= $data_order['Brand'] ?>">
                            <input type="hidden" name="SKUName" value="<?= $data_order['SKUName'] ?>">
                            <input type="hidden" name="QtyOrder" value="<?= $data_order['QtyOrder'] ?>">
                            <input type="hidden" name="BasePrice" value="<?= $data_order['BasePrice'] ?>">
                            <input type="hidden" name="BeforeDisc" value="<?= $data_order['BeforeDisc'] ?>">
                            <input type="hidden" name="Discount" value="<?= $data_order['Discount'] ?>">
                            <input type="hidden" name="AfterDisc" value="<?= $data_order['AfterDisc'] ?>">
                            <input type="hidden" name="Point" value="<?= $data_order['Point'] ?>">
                            <input type="hidden" name="pointclaim" value="<?= $data_order['pointclaim'] ?>">
                            <input type="hidden" name="idCategoryCust" value="<?= $data_order['idCategoryCust'] ?>">
                            <input type="hidden" name="idCategoryProduk" value="<?= $data_order['idCategoryProduk'] ?>">
                            <input type="hidden" name="Keterangan" value="<?= $data_order['Keterangan'] ?>">
                            <input type="hidden" name="idvoucher" value="<?= $data_order['idvoucher'] ?>">
                            <div class="card-body">
                                <?php if ($this->session->flashdata('error')): ?>
                                    <div class="alert alert-danger">
                                        <?= $this->session->flashdata('error'); ?>
                                    </div>
                                <?php endif; ?>
                                <div class="form-group">
                                    <label for="FirstName">First Name</label>
                                    <input type="text" class="form-control" id="FirstName" name="FirstName">
                                    <?= form_error('Customer', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="LastName">Last Name</label>
                                    <input type="text" class="form-control" id="LastName" name="LastName">
                                    <?= form_error('Customer', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="Birthdate">Birthday</label>
                                    <input type="date" class="form-control" id="Birthdate" name="Birthdate">
                                </div>
                                <div class="form-group">
                                    <label for="PhoneNumber">Phone Number</label>
                                    <input type="text" class="form-control" id="PhoneNumber" name="PhoneNumber" placeholder="" value="<?= $hp ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="Instagram">Instagram</label>
                                    <input type="text" class="form-control" id="Instagram" name="Instagram" placeholder="@example">
                                </div>
                            </div>
                            <button class="btn btn-primary mb-3 mt-3" type="submit" name="tambah_customer">Tambah Customer dan Transaksi</button>
                            <a class="btn btn-danger" href="<?= base_url('transaksi') ?>">Cancel</a>
                        </form>
                    </div>
                    <!-- /.card-body -->
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