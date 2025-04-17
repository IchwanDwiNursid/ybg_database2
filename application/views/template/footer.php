<footer class="main-footer">
  <div class="float-right d-none d-sm-block">
    <b>Version</b> BETA
  </div>
  <strong>Copyright &copy; 2024 <a href="https://www.ybg.co.id/">YBG</a>.</strong> All rights reserved.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
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
<script>
  function calculateDiscount() {
    var voucherSelect = document.getElementById('idvoucher');
    var options = voucherSelect.options;
    var totalDiscount = 0;

    for (var i = 0; i < options.length; i++) {
      if (options[i].selected) {
        var nominal = parseFloat(options[i].getAttribute('data-nominal'));
        totalDiscount += nominal;
      }
    }

    document.getElementById('Discount').value = totalDiscount;

    var basePrice = parseInt(document.getElementById('BasePrice').value);
    var voucherSelect = document.getElementById('idvoucher');
    var discount = 0;

    if (basePrice === "") {
      voucherSelect.disabled = true;
    } else {
      voucherSelect.disabled = false;
    }

    if (basePrice && voucherSelect.selectedOptions.length > 0) {
      var selectedOptions = Array.from(voucherSelect.selectedOptions);
      selectedOptions.forEach(function(option) {
        discount += parseInt(option.getAttribute('data-nominal'));
      });

      document.getElementById('Discount').value = discount;
      var afterDisc = basePrice - discount;
      document.getElementById('AfterDisc').value = afterDisc;
    } else {
      document.getElementById('Discount').value = 0;
      document.getElementById('AfterDisc').value = basePrice;
    }
  }
</script>
</body>

</html>