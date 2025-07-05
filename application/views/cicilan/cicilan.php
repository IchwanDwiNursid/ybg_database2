<!-- HTML -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="row">
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="table-responsive">
                <table id="example2" class="table table-bordered table-striped table-hover w-100">
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
                    <th>Name</th>
                    <th>Brand</th>
                    <th>Total Cicilan</th>
                    <th>Juml Angsuran</th>
                    <th>Sisa Cicilan</th>
                    <th>Cicilan Ke</th>
                    <th>Jatuh tempo</th>
                    <th>Status</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($cicilan)) : ?>
                    <?php $no = 1;
                    foreach ($cicilan as $c) : ?>
                    <?php
                        $today = date('Y-m-d');
                        $isDueOrAfter = ($c['jatuhTempo'] <= $today);
                    ?>
                        <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $c['kd_transaksi']; ?></td>
                        <td><?= $c['FirstName'] . ' ' . $c['LastName'];?></td>
                        <td><?= $c['Brand']; ?></td>
                        <td><?= 'Rp ' . number_format($c['totalCicilan'], 0, ',', '.'); ?></td>
                        <td><?= 'Rp ' . number_format($c['jumlahAngsuran'], 0, ',', '.'); ?></td>
                        <td><?= 'Rp ' . number_format($c['sisaCicilan'], 0, ',', '.'); ?></td>
                        <td><?= $c['cicilan_ke']; ?></td>
                        <td class="d-flex">
                        <div class="<?= $isDueOrAfter ? 'pulse-animation mr-2 rounded-circle bg-danger' : ''; ?>" style="width: 10px; height: 10px;"></div>
                        <div>
                          <?= date('d-m-Y', strtotime($c['jatuhTempo'])); ?>
                        </div>
                        </td>

                        <td class="<?= $c['status'] === 'LUNAS' ? 'text-success' : 'text-danger'; ?> font-weight-bold"><?= $c['status']; ?></td>
                        <td>
                            <a class="btn btn-warning" href="<?= base_url('cicilan/detail/' . $c['id']); ?>">Bayar</a>
                            <a class="btn btn-danger <?= $c['status'] === 'BELUM_LUNAS' ? 'disabled' : ''; ?>" 
                                onclick="return <?= $c['status'] === 'BELUM_LUNAS' ? 'false' : 'confirm(\'Yakin Hapus?\')'; ?>" 
                                href="<?= $c['status'] === 'BELUM_LUNAS' ? '#' : site_url('cicilan/delete/' . $c['id']); ?>"
                                >
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