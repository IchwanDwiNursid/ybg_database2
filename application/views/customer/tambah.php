<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-6">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Form <?= $judul ?></h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="" method="post">
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
                <label for="birthday">Birthday</label>
                <input type="date" class="form-control" id="Birthdate" name="Birthdate">
              </div>
              <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="text" class="form-control" id="PhoneNumber" name="PhoneNumber" placeholder="08..">
              </div>
              <div class="form-group">
                <label for="instagram">Instagram</label>
                <input type="text" class="form-control" id="Instagram" name="Instagram" placeholder="@example">
              </div>
              <div class="form-group">
                <label for="Alamat">Alamat</label>
                <input type="text" class="form-control" id="Alamat" name="Alamat">
              </div>
              <div class="form-group">
                <label for="KodePos">KodePos</label>
                <input type="text" class="form-control" id="KodePos" name="KodePos">
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
        <!-- /.card -->




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