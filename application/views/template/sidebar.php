<body class="hold-transition sidebar-mini layout-fixed">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <!-- <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li> -->


        <!-- Notifications Dropdown Menu -->
  
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('login/logout'); ?>">
            <i class="nav-icon fas fa-sign-out-alt"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <!-- <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li> -->
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="https://www.ybg.co.id/" class="brand-link">
        <img src="<?= base_url('LTE') ?>/images/YBG-logo.jpg" alt="YBG Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">YBG Sisters</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <ul class="nav nav-pills nav-sidebar flex-column mt-3" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="<?= base_url('Dashboard') ?>" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
        </ul>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

            <li class="nav-item">
              <a href=" <?= base_url('transaksi') ?>" class="nav-link">
                <i class="nav-icon fas fa-shopping-cart"></i>
                <p>
                  Detail Order
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href=" <?= base_url('tx') ?>" class="nav-link">
                <i class="nav-icon fas fa-file-invoice-dollar"></i>
                <p>
                  Transaction Details
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('customer') ?>" class="nav-link">
                <i class="nav-icon fas fa-address-card"></i>
                <p>
                  Customer
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('voucher') ?>" class="nav-link">
                <i class="nav-icon fas fa-percent"></i>
                <p>
                  Voucher
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('categoryCust') ?>" class="nav-link">
                <i class="nav-icon fas fa-layer-group"></i>
                <p>
                  Category Customer
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('categoryProduk') ?>" class="nav-link">
                <i class="nav-icon fas fa-suitcase"></i>
                <p>
                  Category Produk
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('/cicilan') ?>" class="nav-link">
                <i class="nav-icon fas fa-hand-holding-usd"></i>
                <p>
                  Cicilan
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('/payment') ?>" class="nav-link">
                <i class="nav-icon fas fa-money-bill"></i>
                <p>
                  Payment Methode
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('/user') ?>" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Users
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('/nurturing') ?>" class="nav-link">
                <i class="nav-icon fas fa-heart"></i>
                <p>
                  Nurturing
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('/brand') ?>" class="nav-link">
                <i class="nav-icon fas fa-tags"></i>
                <p>
                  Brand
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('login/logout'); ?>" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>
                  Logout
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1><?= $judul ?></h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?= base_url('Dashboard') ?>">YBG</a></li>
                <li class="breadcrumb-item active"><?= $judul ?></li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">

        <div class="container-fluid">


        </div>
      </section>
      <!-- /.content -->