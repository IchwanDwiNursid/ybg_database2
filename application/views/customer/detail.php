<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <!-- Main content -->
                <div class="invoice p-3 mb-3">
                    <!-- title row -->
                    <!-- info row -->
                    <div class="row invoice-info">
                        <?php if (!empty($customer)): ?>
                            <div class="col-sm-4 invoice-col">
                                Name : <b><?= htmlspecialchars($customer['FirstName'] . ' ' . $customer['LastName']); ?></b><br><br>
                                Birthdate : <b><?= htmlspecialchars($customer['Birthdate'] ?? 'N/A'); ?></b><br>
                            </div>
                            <!-- /.col -->

                            <div class="col-sm-4 invoice-col">
                                Telp : <b><?= htmlspecialchars($customer['PhoneNumber'] ?? 'N/A'); ?></b><br><br>
                                Instagram : <b><?= htmlspecialchars($customer['instagram'] ?? 'N/A'); ?></b><br>
                            </div>
                            <!-- /.col -->
                        <?php else: ?>
                            <div class="col-sm-4 invoice-col">
                                Name : <b></b><br><br>
                                Birthdate : <b>N/A</b><br>
                            </div>
                            <!-- /.col -->

                            <div class="col-sm-4 invoice-col">
                                Telp : <b>N/A</b><br><br>
                                Instagram : <b>N/A</b><br>
                            </div>
                            <!-- /.col -->
                        <?php endif; ?>
                    </div>

                    <!-- /.row -->

                    <!-- Table row -->
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <p class="lead mt-3">Log Transaksi:</p>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Kode Transaksi</th>
                                        <th>Point</th>
                                        <th>Point Claim</th>
                                        <th>Tanggal Transaksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($customer['kd_transaksi'])): ?>
                                        <?php
                                        // Mengurutkan array transaksi berdasarkan dateTransaction
                                        array_multisort($customer['datetransactions'], SORT_ASC, $customer['kd_transaksi'], $customer['points'], $customer['pointclaims']);
                                        ?>
                                        <?php foreach ($customer['kd_transaksi'] as $index => $kd_transaksi): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($kd_transaksi); ?></td>
                                                <td><?= htmlspecialchars($customer['points'][$index] ?? 'N/A'); ?></td>
                                                <td><?= isset($customer['pointclaims'][$index]) && $customer['pointclaims'][$index] == 0 ? '0' : htmlspecialchars($customer['pointclaims'][$index] ?? 'N/A'); ?></td>
                                                <td><?= htmlspecialchars($customer['datetransactions'][$index] ?? 'N/A'); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="4">Belum ada transaksi.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                    </div>

                    <!-- /.row -->

                    <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-6">
                        </div>
                        <!-- /.col -->
                        <div class="col-6">

                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th style="width:50%">Total Point:</th>
                                        <th><?= htmlspecialchars($customer['active_points'] ?? 'N/A'); ?></th>
                                    </tr>
                                    <tr>
                                        <th>Masa Aktif:</th>
                                        <th><?= ($customer['active_points'] > 0) ? 'Valid sampai ' . htmlspecialchars($customer['expiration_date'] ?? 'N/A') : 'Hangus'; ?></th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-12">
                            <a href="<?= base_url('Customer'); ?>" class="btn btn-danger float-right mr-5"><i class="far fa-hand-point-left"></i> Back to Customers Data</a>
                        </div>
                    </div>
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
</section>