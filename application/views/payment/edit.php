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
                     <form action="" method="post">
                        <input type="hidden" name="id" value="<?= $payment['idMethode']; ?>">
                        <div class="form-group">
                            <label for="payment">Payment Methode</label>
                            <input type="text" class="form-control" id="payment" name="payment" value="<?= $payment['Methode']; ?>">
                            <?= form_error('payment', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="<?= base_url('payment'); ?>" class="btn btn-secondary">Cancel</a>
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