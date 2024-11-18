<?php
$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE id='$id'");
$view = mysqli_fetch_array($query);
?>

<section class="content">
<div class="container-fluid">
   <!-- general form elements disabled -->
   <div class="card card-warning">
   <div class="card-header">
                <h3 class="card-title">Edit Data Mahaiswa</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <form method="get" action="update/update_data.php">
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Nomor</label>
                        <input type="text" name="id" class="form-control" placeholder="Enter ID" value="<?php echo $view['id'];?>">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter Name" value="<?php echo $view['name'];?>">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <!-- select -->
                      <div class="form-group">
                        <label>Department</label>
                        <select name="department_id" class="form-control" >
                          <?php foreach ($departments as $department): ?>
                            <!-- value="<?php echo $view['department_id'];?>" -->
                            <option value="<?php echo $department['id']; ?>"><?php echo $department['name'];?> </option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter Email" value="<?php echo $view['email'];?>">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>NIM</label>
                        <input type="text" name="NIM" class="form-control" placeholder="Enter NIM"  value="<?php echo $view['NIM'];?>">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Enter Username"  value="<?php echo $view['username'];?>">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->

                      <div class="form-group">
                            <label>Password</label>
                            <div style="display: flex; align-items: center;">
                                <input 
                                    type="password" 
                                    id="password" 
                                    name="password" 
                                    class="form-control" 
                                    placeholder="Enter Password" 
                                    value="<?php echo $view['password']; ?>">
                                <button 
                                    type="button" 
                                    id="togglePassword" 
                                    class="btn btn-outline-secondary" 
                                    style="margin-left: 5px;">
                                    Show
                                </button>
                            </div>
                        </div>
                      <!-- <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter Password"  value="<?php echo $view['password'];?>">
                      </div> -->
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Total Violation Points</label>
                        <input type="number" name="total_violation_points" class="form-control" value="0" value="<?php echo $view['total_violation_points'];?>">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Total Reward Points</label>
                        <input type="number" name="total_reward_points" class="form-control" value="<?php echo $view['total_reward_points'];?>">
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Semester</label>
                        <input type="number" name="semester" class="form-control" placeholder="Enter Semester" value="<?php echo $view['semester'];?>" >
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Tingkat</label>
                        <input type="number" name="tingkat" class="form-control" placeholder="Enter Tingkat" value="<?php echo $view['tingkat'];?>">
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


            <script>
                const togglePassword = document.querySelector("#togglePassword");
                const passwordField = document.querySelector("#password");

                togglePassword.addEventListener("click", function () {
                    // Ubah tipe input antara "password" dan "text"
                    const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
                    passwordField.setAttribute("type", type);

                    // Ganti teks tombol antara "Show" dan "Hide"
                    this.textContent = type === "password" ? "Show" : "Hide";
                });
            </script>