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
                        <?php if (isset($warning)) : ?>
                            <div class="alert alert-warning"><?= $warning; ?></div>
                        <?php endif; ?>

                        <?php if (isset($orders)) : ?>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID Transaksi</th>
                                        <th>Nomor Telepon</th>
                                        <th>Point Diperoleh</th>
                                        <th>Point Diklaim</th>
                                        <th>Tanggal Transaksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($orders as $order) : ?>
                                        <tr>
                                            <td><?= $order['kd_transaksi']; ?></td>
                                            <td><?= $order['PhoneNumber']; ?></td>
                                            <td><?= $order['Point']; ?></td>
                                            <td><?= $order['pointclaim']; ?></td>
                                            <td><?= date('Y-m-d', strtotime($order['dateTransaction'])); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                            <!-- Menampilkan total point -->
                            <div class="mt-3">
                                <strong>Total Point:</strong> <?= isset($total_points) ? $total_points : 'N/A'; ?>
                            </div>

                            <!-- Menampilkan masa aktif selama 1 tahun -->
                            <div class="mt-1">
                                <strong>Masa Aktif:</strong> <?= isset($expiry_date) ? $expiry_date : 'N/A'; ?>
                            </div>
                        <?php endif; ?>

                        <a href="<?= base_url('point'); ?>" class="btn btn-primary mt-3">Kembali</a>
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
