<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-6">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Form <?= $judul ?></h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->


          <form action="<?= base_url('transaksi/simpan'); ?>" method="post">
            <div class="card-body">
              <?php if (validation_errors()): ?>
                <div class="alert alert-danger">
                  <?= validation_errors(); ?>
                </div>
              <?php endif; ?>
              <div class="form-group">
                <label for="customer">Phone Number</label>
                <input type="text" class="form-control" id="phonenumber" name="phonenumber" value="">
              </div>
              <div class="form-group">
                <label for="kd_transaksi">Kode Transaksi</label>
                <input type="text" class="form-control" id="kd_transaksi" name="kd_transaksi">
              </div>
              <div class="form-group">
                <label for="datetransaksi">Tanggal Transaksi</label>
                <input type="date" class="form-control" id="dateTransaction" name="dateTransaction">
              </div>
              <div class="form-group">
                <label>Category Customer</label>
                <select class="form-control select" name="idCategoryCust" style="width: 100%;">
                  <?php foreach ($CategoryCust as $CategoryCust) : ?>
                    <option value="<?= $CategoryCust["idCategoryCust"] ?>"> <?= $CategoryCust["CategoryCust"] ?> </option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group">
                <label>Sales Advisor</label>
                <select class="form-control select" name="IdSales" style="width: 100%;">
                  <?php foreach ($salesadvisors as $salesadvisors) : ?>
                    <option value="<?= $salesadvisors["IdSales"] ?>"> <?= $salesadvisors["Name"] ?> </option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group">
                <label>Payment Method</label>
                <select class="form-control select" name="idMethode" style="width: 100%;">
                  <?php foreach ($payment as $payment) : ?>
                    <option value="<?= $payment["idMethode"] ?>"><?= $payment["Methode"] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group">
                <label for="brand">Brand</label>
                <input type="text" class="form-control" id="brand" name="Brand">
              </div>
              <div class="form-group">
                <label for="SKU">SKU</label>
                <input type="text" class="form-control" id="SKUName" name="SKUName">
              </div>
              <div class="form-group">
                <label>Category</label>
                <select class="form-control select" name="idCategoryProduk">
                  <?php foreach ($CategoryProduk as $CategoryProduk) : ?>
                    <option value="<?= $CategoryProduk['idCategoryProduk']; ?>"><?= $CategoryProduk['CategoryProduk']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group">
                <label for="qty">qty</label>
                <input type="text" class="form-control" id="qty" name="QtyOrder">
              </div>
              <div class="form-group">
                <label for="baseprice">Base Price</label>
                <input type="text" class="form-control" id="BasePrice" name="BasePrice" oninput="calculateDiscount()">
              </div>

              <div class="form-group">
                <label for="idvoucher">Voucher</label>
                <select class="form-control mb-2" id="idvoucher" name="idvoucher[]" multiple onchange="calculateDiscount()" disabled>
                  <?php foreach ($voucher_options as $voucher): ?>
                    <option value="<?= $voucher['idvoucher']; ?>" data-nominal="<?= $voucher['nominal']; ?>"><?= $voucher['namavoucher']; ?></option>
                  <?php endforeach; ?>
                </select>
                <span class="text-danger mt-3">*gunakan ctrl + click untuk pilih lebih dari 1 vouhcer</span>
              </div>
              <div class="form-group">
                <label for="Discount">Discount</label>
                <input type="text" class="form-control" id="Discount" name="Discount">
              </div>
              <div class="form-group">
                <label for="AfterDisc">AfterDisc</label>
                <input type="text" class="form-control" id="AfterDisc" name="AfterDisc">
              </div>
              <div class="form-group">
                <label for="pointgained">Point gained</label>
                <input type="text" class="form-control" id="Point" name="Point">
              </div>
              <div class="form-group">
                <label for="pointclaim">claim Point</label>
                <input type="text" class="form-control" id="pointclaim" name="pointclaim">
              </div>
              <div class="form-group">
                <label for="keterangan">Ket</label>
                <input type="text" class="form-control" id="keterangan" name="Keterangan">
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
              <a class="btn btn-secondary" href="<?= base_url('transaksi') ?>">Cancel</a>
            </div>
          </form>
        </div>

        <!-- /.card -->

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