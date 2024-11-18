<section class="content">
<div class="container-fluid">
   <!-- general form elements disabled -->
   <div class="card card-warning">
   <div class="card-header">
                <h3 class="card-title">General Elements</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="submit_form.php" method="post">
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>ID</label>
                        <input type="text" name="id" class="form-control" placeholder="Enter ID">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter Name">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <!-- select -->
                      <div class="form-group">
                        <label>Department</label>
                        <select name="department_id" class="form-control">
                          <?php foreach ($departments as $department): ?>
                            <option value="<?php echo $department['id']; ?>"><?php echo $department['name']; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter Email">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>NIM</label>
                        <input type="text" name="NIM" class="form-control" placeholder="Enter NIM">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Enter Username">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter Password">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Total Violation Points</label>
                        <input type="number" name="total_violation_points" class="form-control" value="0">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Total Reward Points</label>
                        <input type="number" name="total_reward_points" class="form-control" value="0">
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Semester</label>
                        <input type="number" name="semester" class="form-control" placeholder="Enter Semester">
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Tingkat</label>
                        <input type="number" name="tingkat" class="form-control" placeholder="Enter Tingkat">
                      </div>
                    </div>
                  </div>
                  
                  <!-- <but:ton class="btn btn-sm btn-info">Simpan3/buttonE -->
                  <button type="submit" class="btn btn-sm btn-info">Simpan</button>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            </div>

            </section>