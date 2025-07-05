<!-- HTML -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <h4>Riwayat cicilan</h4>
            <div class="table-responsive">
                <table id="example2" class="table table-bordered table-striped table-hover w-100">
                    <thead>
                        <tr>
                            <th>Tanggal Bayar</th>
                            <th>Cicilan Ke</th>
                            <th>Jumlah Bayar</th>
                            <th>Sales Penerima</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($cicilan)) : ?>
                        <?php $no = 1;
                        foreach ($cicilan as $c) : ?>
                            <tr>
                            <td><?= $c['tanggalBayar'];?></td>
                            <td><?= $no++ ?></td>
                            <td><?= 'Rp ' . number_format($c['jumlahBayar'], 0, ',', '.'); ?></td>
                            <td><?= $c['Username'];?></td>
                            <td><?= $c['ket'];?></td>
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
        <div class="card w-50">
          <div class="card-body">
            <h4>Bayar Cicilan</h4>
            <!-- form bayar cicilan -->
            <form action="<?= base_url('cicilan/simpan'); ?>" method="post">
              <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger">
                  <?= $this->session->flashdata('error'); ?>
                </div>
              <?php endif; ?>
              <div class="form-group">
                <input class="form-control" id="idCicilan" name="idCicilan" type="hidden">
              </div>
              <div class="form-group">
                <label for="paydate">Tanggal Bayar</label>
                <input class="form-control" id="paydate" name="paydate" type="date">
              </div>
              <div class="form-group">
                <label for="amount">Jumlah Uang</label>
                <input type="text" class="form-control" id="amount" name="amount">
              </div>
              <div class="form-group">
                <label>Sales Penerima</label>
                <select class="form-control select" name="IdSales" style="width: 100%;">
                  <?php foreach ($salesadvisors as $salesadvisors) : ?>
                    <option value="<?= $salesadvisors["IdSales"] ?>"> <?= $salesadvisors["Username"] ?> </option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group">
                <label for="ket">Keterangan</label>
                <input type="text" class="form-control" id="ket" name="ket">
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
          </form>
          </div>
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

<script>
  $(document).ready(function() {
    // Ambil path URL (misalnya: /cicilan/detail/43)
    var path = window.location.pathname;
    // Pecah path berdasarkan slash '/'
    var pathArray = path.split('/');
    var id = pathArray.pop()
  
    console.log("ID dari URL:", id);
    $('#idCicilan').val(id);
});
</script>