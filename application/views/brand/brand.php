<!-- HTML -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
            <div class="card-header">
                <a href="<?= site_url('brand/add_brand') ?>" class="btn btn-primary float-right m-3">Add Brand</a>
            </div>
          <div class="card-body">
            <div class="table-responsive">
                <table id="example2" class="table table-bordered table-striped table-hover">
                  <?php if ($this->session->flashdata('flash')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      Transaksi <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                  <?php endif; ?>
                  <thead>
                    <tr class="text-center">
                      <th>No</th>
                      <th>Brand Name</th>
                      <th>Category Product</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (!empty($brands)) : ?>
                      <?php $no = 1;
                      foreach ($brands as $brand) : ?>
                        <tr class="text-center">
                          <td><?= $no++; ?></td>
                          <td><?= $brand['Brand']; ?></td>
                          <td><?= $brand['CategoryProduk']; ?></td>
                          <td>
                            <a href="<?= base_url() ?>brand/delete/<?= $brand['idBrand'] ?>" class="btn btn-danger">Delete</a>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    <?php else : ?>
                      <tr>
                        <td colspan="19" class="text-center">Data tidak ditemukan.</td>
                      </tr>
                    <?php endif; ?>
                  </tbody>
                </table>
            </div>
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