<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"><?= $judul ?></h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <a class="btn btn-primary mb-2" href="<?= base_url('user/tambah_salesadvisor') ?>"><i class="fas fa-plus mr-2"></i>Tambah</a>
            <?php if ($this->session->flashdata('error')): ?>
              <p style="color: red;"> <?= $this->session->flashdata('error'); ?> </p>
            <?php endif; ?>

            <?php if ($this->session->flashdata('success')): ?>
              <p style="color: green;"> <?= $this->session->flashdata('success'); ?> </p>
            <?php endif; ?>
            <table id="example2" class="table table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Username</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1;
                foreach ($salesadvisors as $advisor):
                ?>
                  <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $advisor['Name']; ?></td>
                    <td><?= $advisor['Username']; ?></td>
                    <td>
                      <a class="btn btn-warning" href="<?= site_url('user/edit_salesadvisor/' . $advisor['IdSales']); ?>">Edit</a>
                      <a class="btn btn-danger" href="<?= site_url('user/hapus_salesadvisor/' . $advisor['IdSales']); ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</a>
                    </td>
                  </tr>
                <?php endforeach; ?>

            </table>
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