<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-8">
          <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Form <?= $judul?></h3>
              </div>

<div class="container">
    <form method="post" action="<?= base_url('point/search_and_save'); ?>">
        <input type="text" class="form-control my-3" name="search" placeholder="Cari berdasarkan nomor telepon" value="<?= set_value('search'); ?>">
        <button type="submit" name="search_and_save" class="btn btn-primary mb-3">Cari dan Simpan</button>
    </form>
    
    <form method="post" action="<?= base_url('point/search_and_save'); ?>">
        <input type="text" class="form-control my-3" name="search" placeholder="Cari berdasarkan nomor telepon" value="<?= set_value('search'); ?>">
    <button type="submit" name="process_expired" class="btn btn-warning mb-3">Proses Poin Kadaluarsa</button>
    </form>

    <?php if (isset($warning)) : ?>
        <div class="alert alert-warning"><?= $warning; ?></div>
    <?php endif; ?>

    <?php if (isset($orders)) : ?>
        <h3>Pesanan Baru</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Transaksi</th>
                    <th>Point Diperoleh</th>
                    <th>Point Diklaim</th>
                    <th>Tanggal Transaksi</th>
                    <th>Tanggal Kadaluarsa</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order) : ?>
                    <tr>
                        <td><?= $order['kd_transaksi']; ?></td>
                        <td><?= $order['Point']; ?></td>
                        <td><?= $order['PointClaim']; ?></td>
                        <td><?= $order['dateTransaction']; ?></td>
                        <td><?= isset($expiry_date) ? date('Y-m-d', strtotime($expiry_date)) : 'N/A'; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <?php if (isset($customer_points)) : ?>
        <h3>Poin Pelanggan</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Order</th>
                    <th>Point Aktif</th>
                    <th>Tanggal Transaksi</th>
                    <th>Point Klaim</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($customer_points as $point) : ?>
                    <tr>
                        <td><?= $point['kd_transaksi']; ?></td>
                        <td><?= $point['ActivePoint']; ?></td>
                        <td><?= date('Y-m-d', strtotime($point['datetransaction'])); ?></td>
                        <td><?= $point['PointClaim']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <?php if (isset($expiry_date)) : ?>
            <div class="point-container">
                <span class="point-label">Point Aktif:</span> <?= $active_point; ?>
                <span class="point-label">Exp Date:</span> <?= date('Y-m-d', strtotime($expiry_date)); ?>
            </div>
        <?php else : ?>
            <div class="alert alert-warning">Poin Kadaluarsa</div>
        <?php endif; ?>
    <?php endif; ?>
</div>
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

