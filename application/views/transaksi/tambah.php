<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <form action="<?= base_url('transaksi/simpan'); ?>" method="post">
      <div class="row">
        <div class="col-6">
          
          <!-- --------- Primary Form ---------- -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Form <?= $judul ?></h3>
            </div>
            <div class="card-body">
            <?php if ($this->session->flashdata('error')): ?>
              <div class="alert alert-danger">
              <?= $this->session->flashdata('error'); ?><div class="form-group">
                <label for="datetransaksi">Tanggal Transaksi</label>
                <input type="date" class="form-control" id="dateTransaction" name="dateTransaction">
              </div>
              </div>
            <?php endif; ?>
              <div class="form-group">
                <label for="kd_transaksi">Kode Transaksi</label>
                <input type="text" class="form-control" id="kd_transaksi" name="kd_transaksi" value="" readonly>
              </div>
              <div class="form-group">
                <label for="phonenumber">Phone Number</label>
                <input class="form-control" id="phonenumber" name="phonenumber" type="text" autocomplete="off" placeholder="Cari nomor..."></input>
                <ul
                  class="list-group position-absolute w-100"
                  id="suggestions"
                  style="z-index: 1000; max-height: 200px; overflow-y: auto; display: none;"
                >
                  <!-- suggestion items akan di-inject di sini -->
                </ul>               
              </div>
              <div id="customerDetails" style="display: none;">
                <p><strong>Nama :</strong> <span id="customerName" class="text-success"></span></p>
                <p><strong>Alamat Lama :</strong> <span id="customerAddress" class="text-success"></span></p>
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
              <span class="font-weight-bold text-danger">-------------------------------------------------- ADD PRODUCT ----------------------->>>>>>>>>>></span>
              <div class="form-group">
                <label for="totalPrice">Total Price</label>
                <input type="text" class="form-control" id="totalPrice" name="totalPrice" readonly>
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
              <div class="form-group">
                <label for="alamatPilihan">Pilih Alamat</label>
                <select class="form-control" id="alamatPilihan" name="alamatPilihan" onchange="toggleInputAlamat()">
                  <option value="default">Gunakan Alamat Bawaan</option>
                  <option value="custom">Gunakan Alamat Baru</option>
                </select>
              </div>
              <div class="form-group" id="inputAlamatGroup" style="display: none;">
                <label for="Alamat">Alamat Baru</label>
                <input type="text" class="form-control" id="Alamat" name="Alamat">
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
              <a class="btn btn-secondary" href="<?= base_url('transaksi') ?>">Cancel</a>
            </div>
          </div>


        </div>
        <!-- --------------- Secondary Form --------------- -->
        <div class="col-6">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Select Product</h3>
            </div>
            <div id="product-container" class="container">
              <div class="d-flex justify-content-end mb-2 mt-2">
                <button type="button" id="addProduct" class="btn btn-warning">+ Tambah Produk</button>
              </div>
                <div class="product-group">
                  <div class="form-group">
                    <label>Category Produk</label>
                    <select class="form-control categorySelect" name="idCategoryProduk[]">
                      <option value="">-- Pilih Category --</option>
                      <?php foreach ($CategoryProduk as $cat) : ?>
                        <option value="<?= $cat['idCategoryProduk']; ?>"><?= $cat['CategoryProduk']; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="brand">Brand</label>
                    <select class="form-control brandSelect" name="Brand[]">
                      <option value="">-- Pilih Brand --</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="SKU">Tipe</label>
                    <input type="text" class="form-control" id="SKUName" name="SKUName[]">
                  </div>
                  <div class="form-group">
                    <label for="qty">qty</label>
                    <input type="text" class="form-control" id="qty" name="QtyOrder[]">
                  </div>
                  <div class="form-group">
                    <label for="baseprice">Base Price</label>
                    <input type="text" class="form-control base-price" name="BasePrice[]">
                  </div>
                  <!-- Batas -->
                  <h4 class="text-danger">----------------------------------------###--------------------------------------------</h4>
                </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</section>


<script>
  $(document).ready(function () {
    fetch("<?= site_url('transaksi/generateLastRandomCode') ?>")
      .then(response => response.json())
      .then(data => {
        $('#kd_transaksi').val(data.kode);
      })
      .catch(error => {
        console.error('Gagal mengambil kode transaksi:', error);
      });

    $('#categorySelect').on('change', function () {
      var categoryId = $(this).val();

      $.ajax({
        url: "<?= base_url('transaksi/getBrandsByCategory') ?>",
        type: "POST",
        data: { idCategoryProduk: categoryId },
        dataType: "json",
        success: function (data) {
          var brandSelect = $('#brandSelect');
          brandSelect.empty();
          brandSelect.append('<option value="">-- Pilih Brand --</option>');

          $.each(data, function (i, brand) {
            brandSelect.append('<option value="' + brand.idBrand + '">' + brand.Brand + '</option>');
          });
        },
        error: function () {
          alert("Gagal mengambil data brand. Coba lagi.");
        }
      });
    });

    $('#phonenumber').on('input', function() {
  var phoneNumber = $(this).val().trim();

  // Jika panjang input < 2 karakter, sembunyikan suggestion
  if (phoneNumber.length < 2) {
    $('#suggestions').hide();
    return;
  }

  $.ajax({
    url: "<?= base_url('transaksi/searchCustomerPhone'); ?>",  // URL controller
    type: "GET",  // Metode GET untuk mengambil data
    data: { term: phoneNumber },  // Mengirimkan input user
    dataType: "json",
    success: function(data) {
      $('#suggestions').empty();  // Kosongkan daftar suggestion

      // Jika tidak ada data, sembunyikan suggestion
      if (data.length === 0) {
        $('#suggestions').hide();
        return;
      }

      // Tampilkan suggestion
      $.each(data, function(i, item) {
        var suggestionItem = $('<li class="list-group-item">').html('<strong>' + item.PhoneNumber + '</strong> - ' + item.FirstName);
        
        suggestionItem.on('click', function() {
          $('#phonenumber').val(item.PhoneNumber);  // Isi input dengan nomor yang dipilih
          $('#suggestions').hide();  // Sembunyikan suggestion

          // Mengisi div dengan data customer yang dipilih
          $('#customerName').text(item.FirstName);  // Mengisi nama
          $('#customerAddress').text(item.Address);  // Mengisi alamat
          
          // Tampilkan div customer details
          $('#customerDetails').show();
        });

        $('#suggestions').append(suggestionItem);
      });

      $('#suggestions').show();  // Tampilkan suggestion
    },
    error: function(xhr, status, error) {
      console.error("AJAX Error:", error);
      $('#suggestions').hide();
    }
  });
});
$('#phonenumber').on('input', function() {
  var phoneNumber = $(this).val().trim();

  // Jika panjang input < 2 karakter, sembunyikan suggestion
  if (phoneNumber.length < 2) {
    $('#suggestions').hide();
    return;
  }

  $.ajax({
    url: "<?= base_url('transaksi/searchCustomerPhone'); ?>",  // URL controller
    type: "GET",  // Metode GET untuk mengambil data
    data: { term: phoneNumber },  // Mengirimkan input user
    dataType: "json",
    success: function(data) {
      $('#suggestions').empty();  // Kosongkan daftar suggestion

      // Jika tidak ada data, sembunyikan suggestion
      if (data.length === 0) {
        $('#suggestions').hide();
        return;
      }

      // Tampilkan suggestion
      $.each(data, function(i, item) {
        var suggestionItem = $('<li class="list-group-item cursor-pointer">').html('<strong>' + item.PhoneNumber + '</strong> - ' + '<span class="text-success">' + item.FirstName + '</span>');
        
        suggestionItem.on('click', function() {
          $('#phonenumber').val(item.PhoneNumber);  // Isi input dengan nomor yang dipilih
          $('#suggestions').hide();  // Sembunyikan suggestion

          // Mengisi div dengan data customer yang dipilih
          var formatName = `${item.FirstName} ${item.LastName}`;
          $('#customerName').text(formatName);  // Mengisi nama
          $('#customerAddress').text(item.Alamat);  // Mengisi alamat
          
          // Tampilkan div customer details
          $('#customerDetails').show();
        });

        $('#suggestions').append(suggestionItem);
      });

      $('#suggestions').show();  // Tampilkan suggestion
    },
    error: function(xhr, status, error) {
      console.error("AJAX Error:", error);
      $('#suggestions').hide();
    }
      });
    });


    // Jika klik di luar suggestion, sembunyikan suggestion
    $(document).click(function(e) {
      if (!$(e.target).closest('#phonenumber').length) {
        $('#suggestions').hide();
      }
    });

    $(document).ready(function() {
      $('#alamatPilihan').change(function() {
        var pilihan = $(this).val();

        if (pilihan === 'custom') {
          $('#inputAlamatGroup').show();
        } else {
          $('#inputAlamatGroup').hide();
          $('#Alamat').val('');
        }
      }); 
    });

    $(document).on('change', '.categorySelect', function () {
    var categorySelect = $(this);
    var categoryId = categorySelect.val();
    var brandSelect = categorySelect.closest('.product-group').find('.brandSelect');

    $.ajax({
      url: "<?= base_url('transaksi/getBrandsByCategory') ?>",
      type: "POST",
      data: { idCategoryProduk: categoryId },
      dataType: "json",
      success: function (data) {
        brandSelect.empty();
        brandSelect.append('<option value="">-- Pilih Brand --</option>');

        $.each(data, function (i, brand) {
          brandSelect.append('<option value="' + brand.idBrand + '">' + brand.Brand + '</option>');
        });
      },
      error: function () {
        alert("Gagal mengambil data brand.");
      }
    });
  });
    $('#addProduct').on('click', function () {
      var newGroup = $('.product-group').first().clone();
      newGroup.find('select').val('');
      $('#product-container').append(newGroup);
    });
  });

  function calculateDiscount() {
    var $voucherSelect = $('#idvoucher');
    var totalDiscount = 0;

    // Get base price
    var basePrice = parseInt($('#totalPrice').val());

    // Enable/disable select based on base price
    if (!basePrice) {
      $voucherSelect.prop('disabled', true);
      $('#Discount').val(0);
      $('#AfterDisc').val(0);
      return;
    } else {
      $voucherSelect.prop('disabled', false);
    }

    // Calculate total discount from selected options
    $voucherSelect.find('option:selected').each(function () {
      var nominal = parseFloat($(this).data('nominal')) || 0;
      totalDiscount += nominal;
    });

    // Set discount and after-discount values
    $('#Discount').val(totalDiscount);
    var afterDisc = basePrice - totalDiscount;
    $('#AfterDisc').val(afterDisc);
  }

    // function onInputBasePrice() {
    //     $('#BasePrice').on('input', function() {
    //     var basePrice = $(this).val();
    //     $('#totalPrice').val(basePrice);
    //     calculateDiscount()

    //     var totalPrice = $('#totalPrice').val();
    //     console.log('Total Price', totalPrice);
    // })

  // }  
  $(document).ready(function () {
  // Saat input base price berubah
    $(document).on('input', '.base-price', function () {
      var total = 0;

      $('.base-price').each(function () {
        var val = parseFloat($(this).val().replace(/,/g, ''));
        if (!isNaN(val)) {
          total += val;
        }
      });

      $('#totalPrice').val(total);
      calculateDiscount(); 
    });
});
  
</script>








