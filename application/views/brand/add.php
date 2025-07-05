<!-- HTML -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <h4>Tambah Brand</h4>
            <form action="<?= base_url('brand/simpan'); ?>" method="post">
              <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger">
                  <?= $this->session->flashdata('error'); ?>
                </div>
              <?php endif; ?>
              <div class="form-group">
                    <label>Category Produk</label>
                    <select class="form-control" id="catprod" name="catprod">
                      <option value="">-- Pilih Category --</option>
                      <?php foreach ($catprod as $cat) : ?>
                        <option value="<?= $cat['idCategoryProduk']; ?>"><?= $cat['CategoryProduk']; ?></option>
                      <?php endforeach; ?>
                    </select>
                </div>
              <div class="form-group">
                <label for="ket">Brand Name</label>
                <input type="text" class="form-control" id="brand" name="brand">
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