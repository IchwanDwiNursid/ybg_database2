<!-- Main content -->
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
              <a class="btn btn-primary" href="<?= base_url('payment/tambah') ?>"><i class="fas fa-plus mr-2"></i>Tambah</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <?php if ( $this->session->flashdata('flash') ) : ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                 payment Methode <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <?php endif; ?>

                <table id="example2" class="table table-bordered table-striped table-hover">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Payment Method</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; foreach($payment as $payment) : ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $payment['Methode'] ?></td>
                    <td>
                      <a class="btn btn-warning" href="<?= base_url() ?>payment/edit/<?= $payment['idMethode'] ?>">edit</a>
                      <a class="btn btn-danger" onclick="return confirm('Yakin Hapus?')" href="<?= base_url() ?>payment/hapus/<?= $payment['idMethode'] ?>">delete</a>
                    </td>
                  </tr> 
                  <?php endforeach; ?>
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