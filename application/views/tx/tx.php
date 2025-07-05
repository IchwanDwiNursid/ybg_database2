<!-- HTML -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <form method="post" action="<?php echo base_url('tx/search_tx'); ?>" class="float-center mx-5">
              <div class="input-group">
                <input type="text" name="keyword" class="form-control" placeholder="Search by idtransaction number, brand, or SKU">
                <div class="input-group-append">
                  <button class="btn btn-primary" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
                </div>
              </div>
            </form>

          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <form action="<?= base_url('tx') ?>" method="get" class="float-right mb-3">
              <div class="input-daterange input-group">
                <input type="date" class="form-control" name="start_date" placeholder="Start Date" value="<?= isset($start_date) ? $start_date : '' ?>">
                <div class="input-group-append">
                  <span class="input-group-text">to</span>
                </div>
                <input type="date" class="form-control" name="end_date" placeholder="End Date" value="<?= isset($end_date) ? $end_date : '' ?>">
                <button type="submit" class="btn btn-primary ml-2">Filter</button>
              </div>
            </form>

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
                    <tr>
                      <th>No</th>
                      <th>No Transaksi</th>
                      <th>Tipe</th>
                      <th>Brand</th>
                      <th>Category Produk</th>
                      <th>Status Shipping</th>
                      <th>Ongkir</th>
                      <th>Asuransi</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (!empty($orders)) : ?>
                      <?php $no = 1;
                      foreach ($orders as $order) : ?>
                        <tr>
                          <td><?= $no++; ?></td>
                          <td><?= $order['kd_transaksi']; ?></td>
                          <td><?= $order['Tipe']; ?></td>
                          <td><?= $order['Brand']; ?></td>
                          <td><?= $order['CategoryProduk']; ?></td>
                          <td><?= $order['status_shipping']; ?></td>
                          <td>
                              <?= !empty($order['ongkir']) ? 'Rp ' . number_format($order['ongkir'], 0, ',', '.') : '' ?>
                          </td>
                          <td>
                              <?= !empty($order['asuransi']) ? 'Rp ' . number_format($order['asuransi'], 0, ',', '.') : '' ?>
                          </td>

                          <td>
                            <a class="btn btn-warning"  href="<?= base_url('tx/edit/' . $order['kd_transaksi'].  '/' . $order['Tipe']) . '/'. $order['id']. '/'. $order['ongkir'].'/'. $order['asuransi'].'/'. $order['status_shipping'] ; ?>">Edit</a>
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