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
                  <div class="form-group">
                    <label for="voucher">Kode Voucher</label>
                    <input type="text" class="form-control" id="kdvoucher" name="kdvoucher" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="voucher">Nama Voucher</label>
                    <input type="text" class="form-control" id="voucher" name="voucher" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="voucher">Nominal</label>
                    <input type="text" class="form-control" id="nominal" name="nominal" placeholder="">
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <a class="btn btn-danger" href="<?=base_url('voucher')?>">Cancel</a>
                </div>
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
