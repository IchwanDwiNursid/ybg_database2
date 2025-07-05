<!-- HTML -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="row">
          </div>
          <div class="card-header">
            <form method="post" action="<?php echo base_url('transaksi/search_transaksi'); ?>" class="float-center mx-5">
              <div class="input-group">
                <input type="text" name="keyword" class="form-control" autocomplete="off" placeholder="Search by idtransaction number, brand, or SKU">
                <div class="input-group-append">
                  <button class="btn btn-primary" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
                </div>
              </div>
            </form>

          </div>
          <!-- /.card-header -->
          <div class="card-body">

            <a class="btn btn-primary mb-2" href="<?= base_url('transaksi/tambah') ?>"><i class="fas fa-plus mr-2"></i>Tambah</a>

            <form action="<?= base_url('transaksi') ?>" method="get" class="float-right">
              <div class="input-daterange input-group">
                <input type="date" class="form-control" name="start_date" placeholder="Start Date" value="<?= isset($start_date) ? $start_date : '' ?>">
                <div class="input-group-append">
                  <span class="input-group-text">to</span>
                </div>
                <input type="date" class="form-control" name="end_date" placeholder="End Date" value="<?= isset($end_date) ? $end_date : '' ?>">
                <button type="submit" class="btn btn-primary ml-2">Filter</button>
              </div>
            </form>

            <table id="example2" class="table table-responsive table-bordered table-striped table-hover">
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
                  <th>date</th>
                  <th>Customer</th>
                  <th>Category Cust</th>
                  <th>SA</th>
                  <th>Payment</th>
                  <th>Brand</th>
                  <th>Tipe</th>
                  <th>Category Produk</th>
                  <th>Qty</th>
                  <th>Base Price</th>
                  <th>Voucher</th>
                  <th>Disc</th>
                  <th>After Disc</th>
                  <th>Point gained</th>
                  <th>Point claim</th>
                  <th>Ket</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($transaksi)) : ?>
                  <?php $no = 1;
                  foreach ($transaksi as $order) : ?>
                    <?php
                      $isDeletable = empty($order['status']) || $order['status'] === 'LUNAS';
                    ?>
                    <tr>
                      <td><?= $no++; ?></td>
                      <td><?= $order['No Transaksi']; ?></td>
                      <td><?= date('d-m-Y', strtotime($order['Tanggal'])); ?></td>
                      <td><?= $order['Nama Customer']; ?></td>
                      <td><?= $order['Category Customer']; ?></td>
                      <td><?= $order['Sales Advisor']; ?></td>
                      <td><?= $order['Payment Method']; ?></td>
                      <td><?= $order['Brand']; ?></td>
                      <td><?= $order['SKU']; ?></td>
                      <td><?= $order['Category Produk']; ?></td>
                      <td><?= $order['Qty']; ?></td>
                      <td><?= 'Rp ' . number_format($order['Base Price'], 0, ',', '.'); ?></td>
                      <td><?= $order['Nama Voucher'] ? $order['Nama Voucher'] : 'Tidak ada Voucher'; ?></td>
                      <td><?= 'Rp ' . number_format($order['Disc'], 0, ',', '.'); ?></td>
                      <td><?= 'Rp ' . number_format($order['After Disc'], 0, ',', '.'); ?></td>
                      <td><?= $order['Point gained']; ?></td>
                      <td><?= $order['Point claim']; ?></td>
                      <td><?= $order['Keterangan']; ?></td>
                      <td>
                        <a class="btn btn-warning" href="<?= base_url('transaksi/edit/' . $order['id']); ?>">Edit</a>
                        <a class="btn btn-danger <?= !$isDeletable ? 'disabled' : ''; ?>" 
                          onclick="return <?= !$isDeletable ? 'false' : 'confirm(\'Yakin Hapus?\')'; ?>" 
                          href="<?= !$isDeletable ? '#' : site_url('transaksi/delete/' . $order['id']); ?>">
                          Delete
                        </a>
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