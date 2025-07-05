<!-- Main content -->
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
            <?= validation_errors(); ?>
            <form action="" method="post">
              <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger">
                  <?= $this->session->flashdata('error'); ?>
                </div>
              <?php endif; ?>
              <input type="hidden" name="id" value="<?= $Customer['idCustomer']; ?>">
              <div class="form-group">
                <label for="FirstName">First Name</label>
                <input type="text" class="form-control" id="FirstName" name="FirstName" value="<?= $Customer['FirstName']; ?>">
                <?= form_error('Customer', '<small class="text-danger">', '</small>'); ?>
              </div>
              <div class="form-group">
                <label for="LastName">Last Name</label>
                <input type="text" class="form-control" id="LastName" name="LastName" value="<?= $Customer['LastName']; ?>">
                <?= form_error('Customer', '<small class="text-danger">', '</small>'); ?>
              </div>
              <div class="form-group">
                <label for="Birthdate">Birthdate</label>
                <input type="date" class="form-control" id="Birthdate" name="Birthdate" value="<?= $Customer['Birthdate']; ?>">
                <?= form_error('Customer', '<small class="text-danger">', '</small>'); ?>
              </div>
              <div class="form-group">
                <label for="PhoneNumber">PhoneNumber</label>
                <input type="text" class="form-control" id="PhoneNumber" name="PhoneNumber" value="<?= $Customer['PhoneNumber']; ?>">
                <?= form_error('Customer', '<small class="text-danger">', '</small>'); ?>
              </div>
              <div class="form-group">
                <label for="instagram">PhoneNumber</label>
                <input type="text" class="form-control" id="instagram" name="instagram" value="<?= $Customer['instagram']; ?>">
                <?= form_error('Customer', '<small class="text-danger">', '</small>'); ?>
              </div>
              <div class="form-group">
                <label for="Alamat">Alamat</label>
                <input type="text" class="form-control" id="Alamat" name="Alamat" value="<?= $Customer['Alamat']; ?>">
                <?= form_error('Customer', '<small class="text-danger">', '</small>'); ?>
              </div>
              <div class="form-group">
                <label for="KodePos">KodePos</label>
                <input type="text" class="form-control" id="KodePos" name="KodePos" value="<?= $Customer['KodePos']; ?>">
                <?= form_error('Customer', '<small class="text-danger">', '</small>'); ?>
              </div>
              <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
              <a href="<?= base_url('Customer'); ?>" class="btn btn-secondary">Cancel</a>
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