<?php
  session_start();

  $page_title = "Registration Form";
  include('includes/header.php'); 
  include('includes/navbar.php'); 
?>

<div class="py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
          <div class="alert-success">

          <?php
          if(isset($_SESSION['status'])) {
              ?>
              <div class="alert alert-success">
                  <h5><?= $_SESSION['status']; ?></h5>
              </div>
              <?php
              unset($_SESSION['status']);
          }
          ?>
              
          </div>
          <div class="card shadow">
              <div class="card-header">
                  <h5>Registration Form with Email Verification</h5>
              </div>
              <div class="card-body">

                  <form action="code.php" method="POST">
                      <div class="form-group mb-3">
                          <label>Username</label>
                          <input type="text" name="name" class="form-control" placeholder="Enter Username">
                      </div>
                      <div class="form-group mb-3">
                          <label>Email Address</label>
                          <input type="text" name="email" class="form-control" placeholder="Enter Email Address">
                      </div>
                      <div class="form-group mb-3">
                          <label>Phone Number</label>
                          <input type="text" name="phone" class="form-control" placeholder="Enter Phone Number">
                      </div>
                      <div class="form-group mb-3">
                          <label>Password</label>
                          <input type="password" name="password" class="form-control" id="myInput" placeholder="Enter Password">
                          <i class="bi bi-eye-slash" id="hide" onclick="myFunctionToggle()"></i>
                          <i class="bi bi-eye-fill" id="show" onclick="myFunctionToggle()"></i>
                      </div>

                        <script type="text/javascript">
                            function myFunctionToggle() {
                                let pass = document.getElementById("myInput");
                                if (pass.type === "password") {
                                    pass.type = "text";
                                    document.getElementById("hide").style.display = "inline-block";
                                    document.getElementById("show").style.display = "none";
                                } else {
                                    pass.type = "password";
                                    document.getElementById("hide").style.display = "none";
                                    document.getElementById("show").style.display = "inline-block";
                                }
                            }
                        </script>

                      <!-- <div class="form-group mb-3">
                          <label>Confirm Password</label>
                          <input type="text" name="confirm_password" class="form-control">
                      </div> -->
                      <div class="form-group ">
                          <button type="submit" name="register_btn" class="btn btn-success">
                              Register Now
                          </button>
                      </div>
                  </form>

              </div>
          </div>
      </div>
    </div>
  </div>
</div>

<?php include('includes/footer.php'); ?>