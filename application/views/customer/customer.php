<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <div class="row">

              <div class="col-2">
                <a class="btn btn-primary mb-2" href="<?= base_url('customer/tambah') ?>"><i class="fas fa-plus"></i>Tambah</a>
              </div>

              <div class="col-4">
                <form action="<?= base_url('customer/sortByBulanLahir') ?>" method="get">
                  <div class="input-group">
                    <select class="custom-select" id="bulan" name="bulan" aria-label="Contoh select dengan addon tombol">
                      <option value="">Birthdate</option>
                      <option value="1">Januari</option>
                      <option value="2">Februari</option>
                      <option value="3">Maret</option>
                      <option value="4">April</option>
                      <option value="5">Mei</option>
                      <option value="6">Juni</option>
                      <option value="7">Juli</option>
                      <option value="8">Agustus</option>
                      <option value="9">September</option>
                      <option value="10">Oktober</option>
                      <option value="11">November</option>
                      <option value="12">Desember</option>
                    </select>
                    <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                  </div>
                </form>
              </div>

              <div class="col-6">
                <form method="post" action="<?php echo base_url('customer/search'); ?>">
                  <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari Customer...">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </form>
              </div>
            </div>



          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <?php if ($this->session->flashdata('flash')) : ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                Customer <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Tutup">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <?php endif; ?>
            <table id="example2" class="table table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Depan</th>
                  <th>Nama Belakang</th>
                  <th>Ulang Tahun</th>
                  <th>Telp</th>
                  <th>Instagram</th>
                  <th>Alamat</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no=1; foreach ($customer as $customer) : ?>
                  <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $customer['FirstName'] ?></td>
                    <td><?= $customer['LastName'] ?></td>
                    <td><?= date('d-m-Y', strtotime($customer['Birthdate']))?></td>
                    <td><?= $customer['PhoneNumber'] ?></td>
                    <td><?= $customer['instagram'] ?></td>
                    <td><?= $customer['Alamat'] ?></td>
                    <td>
                      <a class="btn btn-success" href="<?= base_url() ?>customer/detail/<?= $customer['idCustomer'] ?>">Detail</a>
                      <a class="btn btn-warning" href="<?= base_url() ?>customer/edit/<?= $customer['idCustomer'] ?>">Edit</a>
                      <a class="btn btn-danger" onclick="return confirm('Yakin Hapus?')" href="<?= base_url() ?>customer/hapus/<?= $customer['idCustomer'] ?>">Hapus</a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
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