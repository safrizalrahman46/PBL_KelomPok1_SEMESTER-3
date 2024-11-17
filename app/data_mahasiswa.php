<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">

        <!-- /.card -->

        <div class="card">
          <div class="card-header">
            <h3 class="card-title">DataTable with default features</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-lg">
              Tambah Data
            </button>
            <br></br>
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Name</th>
                  <th>Department</th>
                  <th>Email</th>
                  <th>NIM</th>
                  <th>Username</th>
                  <th>Password</th>
                  <th>Total Violation Points</th>
                  <th>Total Reward Points</th>
                  <th>Semester</th>
                  <th>Tingkat</th>
                  <th>Action</th>

                </tr>
              </thead>
              <tbody>
                <?php
                $no = 0;
                $query = mysqli_query($koneksi, "
                SELECT m.*, d.name AS department_name 
                FROM mahasiswa m 
                INNER JOIN department d 
                ON m.department_id = d.id
            ");
                
                // $query = mysqli_query($koneksi, "SELECT * FROM mahasiswa");
                while ($mhs = mysqli_fetch_array($query)) {
                  $no++;
                ?>
                  <tr>
                    <td width='5%'><?php echo $no; ?></td>
                    <td><?php echo $mhs['name']; ?></td>
                    <td><?php echo $mhs['department_name']; ?></td>
                    <td><?php echo $mhs['email']; ?></td>
                    <td><?php echo $mhs['NIM']; ?></td>
                    <td><?php echo $mhs['username']; ?></td>
                    <td><?php echo $mhs['password']; ?></td> <!-- Be cautious about displaying passwords! -->
                    <td><?php echo $mhs['total_violation_points']; ?></td>
                    <td><?php echo $mhs['total_reward_points']; ?></td>
                    <td><?php echo $mhs['semester']; ?></td>
                    <td><?php echo $mhs['tingkat']; ?></td>
                    <td><a onclick ="hapus_data()"  class="btn btn-sm btn-danger">Hapus</a></td>


                  </tr>

                <?php } ?>
              </tbody>
              <tfoot>
                <!-- <tr>
                    <th>Rendering engine</th>
                    <th>Browser</th>
                    <th>Platform(s)</th>
                    <th>Engine version</th>
                    <th>CSS grade</th>
                  </tr> -->
              </tfoot>
            </table>
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

<div class="modal fade" id="modal-lg">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Large Modal</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form method="get" action="add/tambah_data.php">

        <div class="modal-body">

          <div class="form-row">

            <div class="form-group col-md-6">
              <label for="inputId">No</label>
              <input type="text" class="form-control" id="inputId" name="id" placeholder="ID">
            </div>

            <div class="form-group col-md-6">
              <label for="inputName">Name</label>
              <input type="text" class="form-control" id="inputName" name="name" placeholder="Name">
            </div>
          </div>

          <div class="form-row">
            <!-- <div class="form-group col-md-6">
              <label for="inputDepartmentId">Department ID</label>
              <input type="text" class="form-control" id="inputDepartmentId" name="department_id" placeholder="Department ID">
            </div> -->

            <div class="form-group col-md-6">
            <label for="inputDepartmentId">Department</label>
            <select class="form-control" id="inputDepartmentId" name="department_id" required>
              <option value="" disabled selected>Pilih Department</option>
              <?php
              include("../../conf/config.php");
              $query = mysqli_query($koneksi, "SELECT * FROM department");
              while ($dept = mysqli_fetch_array($query)) {
                echo "<option value='{$dept['id']}'>{$dept['name']}</option>";
              }
              ?>
            </select>
          </div>



            <div class="form-group col-md-6">
              <label for="inputEmail">Email</label>
              <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email">
            </div>
          </div>

          
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputNIM">NIM</label>
              <input type="text" class="form-control" id="inputNIM" name="NIM" placeholder="NIM">
            </div>
            <div class="form-group col-md-6">
              <label for="inputUsername">Username</label>
              <input type="text" class="form-control" id="inputUsername" name="username" placeholder="Username">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputPassword">Password</label>
              <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password">
            </div>
            <div class="form-group col-md-6">
              <label for="inputTotalViolationPoints">Total Violation Points</label>
              <input type="number" class="form-control" id="inputTotalViolationPoints" name="total_violation_points" placeholder="Total Violation Points" value="0">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputTotalRewardPoints">Total Reward Points</label>
              <input type="number" class="form-control" id="inputTotalRewardPoints" name="total_reward_points" placeholder="Total Reward Points" value="0">
            </div>
            <div class="form-group col-md-3">
              <label for="inputSemester">Semester</label>
              <input type="number" class="form-control" id="inputSemester" name="semester" placeholder="Semester">
            </div>
            <div class="form-group col-md-3">
              <label for="inputTingkat">Tingkat</label>
              <input type="number" class="form-control" id="inputTingkat" name="tingkat" placeholder="Tingkat">
            </div>
          </div>



        </div>


        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </div>

    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<script>
  function hapus_data(){
    alert('ok');
  };
</script>