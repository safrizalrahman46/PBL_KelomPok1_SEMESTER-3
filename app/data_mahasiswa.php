
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
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  <th>No</th>
                  <th>Name</th>
                  <th>Department ID</th>
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
                $query = mysqli_query($koneksi,"SELECT * FROM mahasiswa");
                while ($mhs = mysqli_fetch_array($query)) {
                  $no++;
                ?>
                   <tr>
                    <td width='5%'><?php echo $no;?></td>
                    <td><?php echo $mhs['name'];?></td>
                    <td><?php echo $mhs['department_id']; ?></td>
                    <td><?php echo $mhs['email']; ?></td>
                    <td><?php echo $mhs['NIM']; ?></td>
                    <td><?php echo $mhs['username']; ?></td>
                    <td><?php echo $mhs['password']; ?></td> <!-- Be cautious about displaying passwords! -->
                    <td><?php echo $mhs['total_violation_points']; ?></td>
                    <td><?php echo $mhs['total_reward_points']; ?></td>
                    <td><?php echo $mhs['semester']; ?></td>
                    <td><?php echo $mhs['tingkat']; ?></td>
                    <td>X</td> 
                    
                  </tr>
                  
                  <?php }?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Rendering engine</th>
                    <th>Browser</th>
                    <th>Platform(s)</th>
                    <th>Engine version</th>
                    <th>CSS grade</th>
                  </tr>
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

  