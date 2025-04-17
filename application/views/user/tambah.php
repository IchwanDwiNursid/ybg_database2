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
          <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-warning">
                  <?= $this->session->flashdata('error'); ?>
                </div>
              <?php endif; ?>
            <?php if ($this->session->flashdata('success')): ?>
              <p style="color: green;"> <?= $this->session->flashdata('success'); ?> </p>
            <?php endif; ?>
            <form action="<?= site_url('User/tambah_salesadvisor'); ?>" method="post">
              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="">
              </div>
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="">
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="">
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
              <a class="btn btn-danger" href="<?= base_url('user') ?>">Cancel</a>
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