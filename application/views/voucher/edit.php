<!-- Main content -->
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-6">
          <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Form <?= $judul?></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <div class="card-body">
                     <?= validation_errors(); ?>
                     <form action="<?= base_url('voucher/edit/' . $voucher['idvoucher']); ?>" method="post">
                     <div class="form-group">
                     <label for="voucher">Kode Voucher</label>
                        <input readonly name="idvoucher"class="form-control" value="<?= $voucher['idvoucher']; ?>">
                        <?= form_error('voucher', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="voucher">Nama Voucher</label>
                            <input type="text" class="form-control" id="namavoucher" name="namavoucher" value="<?= $voucher['idvoucher']; ?>">
                            <?= form_error('voucher', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="voucher">Nama Voucher</label>
                            <input type="text" class="form-control" id="namavoucher" name="namavoucher" value="<?= $voucher['namavoucher']; ?>">
                            <?= form_error('voucher', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="voucher">Nominal</label>
                            <input type="text" class="form-control" id="nominal" name="nominal" value="<?= $voucher['nominal']; ?>">
                            <?= form_error('voucher', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="<?= base_url('voucher'); ?>" class="btn btn-secondary">Cancel</a>
                    </form>
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