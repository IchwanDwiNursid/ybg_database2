<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card p-3">
                    <div class="d-flex justify-content-between">
                        <h3>Birthdate: </h3>
                        <div class="d-flex align-items-center justify-content-center">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                    Month
                                </button>
                                <div class="dropdown-menu">
                                    <?php 
                                    $months = [
                                        1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
                                        5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
                                        9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
                                    ];
                                    foreach($months as $num => $name): ?>
                                        <a class="dropdown-item" href="<?= base_url('nurturing/index/'.$num) ?>">
                                            <?= $name ?>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <a href="<?= base_url('nurturing/download_csv_birthdate?month=' . $month) ?>" class="btn btn-success ml-3">
                               Download CSV
                            </a>
                        </div>
                    </div>
                    <table class="table w-100 mt-4">
                        <thead>
                            <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Age</th> 
                            <th scope="col">Birthdate</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($customer as $c): ?>
                                <tr>
                                    <td><?= $c['FirstName']; ?> <?= $c['LastName']; ?></td>
                                    <td><?= $c['PhoneNumber'] ?></td>
                                    <td>
                                    <?php
                                            $birthDate = new DateTime($c['Birthdate']);
                                            $today = new DateTime();
                                            $age = $today->diff($birthDate)->y;
                                            echo $age;
                                        ?>
                                    </td>
                                    <td><?= date('d-m-Y', strtotime($c['Birthdate'])); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="card p-3">
                    <div class="d-flex justify-content-between">
                        <h3>Last Transaction </h3>
                        <div class="d-flex align-items-center justify-content-center">
                            <form action="<?= base_url('nurturing') ?>" method="get" class="float-right">
                                <div class="input-daterange input-group">
                                    <input type="date" class="form-control" name="tx_start_date" placeholder="Start Date" value="<?= isset($tx_start_date) ? $tx_start_date : '' ?>">
                                    <div class="input-group-append">
                                    <span class="input-group-text">to</span>
                                    </div>
                                    <input type="date" class="form-control" name="tx_end_date" placeholder="End Date" value="<?= isset($tx_end_date) ? $tx_end_date : '' ?>">
                                    <button type="submit" class="btn btn-primary ml-2">Filter</button>
                                </div>
                            </form>
                            <a href="<?= base_url('nurturing/download_csv_transaction?start_date=' . $tx_start_date . '&end_date=' . $tx_end_date) ?>" class="btn btn-success ml-3">
                               Download CSV
                            </a>
                        </div>
                    </div> <br>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Kode Transaksi</th>
                                <th scope="col">Name</th>
                                <th scope="col">No Hp</th>
                                <th scope="col">Instagram</th>
                                <th scope="col">Point Gained</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($last_transaction)) : ?>
                            <?php $no = 1;
                            foreach ($last_transaction as $ltx) : ?>
                                <tr>
                                    
                                    <td><?= $ltx['kd_transaksi']; ?></td>
                                    <td><?= $ltx['FirstName']; ?></td>
                                    <td><?= $ltx['PhoneNumber']; ?></td>
                                    <td><?= $ltx['instagram']; ?></td>
                                    <td><?= $ltx['Point']; ?></td>
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
        </div>
    </div>
</section>

<script src="<?= base_url('LTE') ?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('LTE') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url('LTE') ?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('LTE') ?>/dist/js/adminlte.min.js"></script>
<!-- ChartJS -->
<script src="<?= base_url('LTE') ?>/plugins/chart.js/Chart.min.js"></script>
<!-- Select2 -->
<script src="<?= base_url('LTE') ?>/plugins/select2/js/select2.full.min.js"></script>
<script>
  $(function() {
    $('.select2').select2()
  });
</script>
</body>

</html>