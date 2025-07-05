<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex">
                            <h3 class="mr-2 font-weight-bold">Kode Transaksi : </h3><h3 class="text-success"> <?= $kd_transaksi ?></h3>
                        </div>
                        <div class="d-flex">
                            <h3 class="mr-2 font-weight-bold">Tipe :</h3><h3 class="text-success"><?= $Tipe ?></h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url('tx/simpan'); ?>" method="post">
                            <div class="form-group">
                                <label for="status">Status Shipping :</label> <br>
                                <?php
                                    $statusList = ['pending', 'processing', 'shipped', 'delivered', 'cancelled', 'returned'];
                                ?>
                                <select class="custom-select custom-select-lg mb-3" name="status" id="status">
                                <?php foreach($statusList as $s): ?>
                                    <option value="<?= $s ?>" <?= ($status_shipping == $s) ? 'selected' : '' ?>>
                                        <?= ucfirst($s) ?>
                                    </option>
                                <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="ongkir">Ongkir :</label> <br>
                                <input type="text" class="form-control" id="ongkir" value="<?= $ongkir ?>" name="ongkir">
                            </div>
                            <div class="form-group">
                                <label for="asuransi">Asuransi :</label> <br>
                                <input type="text" class="form-control" value="<?= $asuransi ?>" name="asuransi" id="asuransi">
                            </div>
                            <input type="text" value=<?= $id ?> hidden name="id">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function formatNumberOnlyDots(value) {
    // Remove anything that's not a digit
    const clean = value.replace(/\D/g, '');
    // Format with dot separator
    return clean.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
  }

  function bindFormatter(id) {
    const input = document.getElementById(id);
    input.addEventListener('input', function () {
      this.value = formatNumberOnlyDots(this.value);
    });
  }

  bindFormatter('ongkir');
  bindFormatter('asuransi');
</script>