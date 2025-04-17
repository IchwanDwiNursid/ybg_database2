<!-- Main content -->
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-6">
          <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Form <?= $judul ?></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <div class="card-body">
                     <?= validation_errors(); ?>
              <form action="" method="post">
                  <div class="form-group">
                    <label for="category">Category Cust</label>
                    <input type="text" class="form-control" id="category" name="category" placeholder="">
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
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