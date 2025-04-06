<?php
  session_start();

  $page_title = "Password Change Form";
  include('includes/header.php'); 
  include('includes/navbar.php'); 
?>

<div class="py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
   
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

          <div class="card shadow">
              <div class="card-header">
                  <h5>Change Password</h5>
              </div>
              <div class="card-body p-4">

              <form action="password-reset-code.php" method="POST"> 
                  <input type="hidden" name="password_token" value="<?php if(isset($_GET['token'])){echo $_GET['token'];} ?>"> 

                      <div class="form-group mb-3">
                          <label>Email Address</label>
                          <input type="text" name="email" value="<?php if(isset($_GET['email'])){echo $_GET['email'];} ?>" class="form-control" placeholder="Enter Email Address">
                      </div>
                      <div class="form-group mb-3">
                          <label>New Password</label>
                          <input type="password" name="new_password" class="form-control"
                          id="myInput_pass" placeholder="Enter New Password">
                          <i class="bi bi-eye-slash" id="hide" onclick="myFunctionTogglePass()"></i>
                          <i class="bi bi-eye-fill" id="show" onclick="myFunctionTogglePass()"></i>
                      </div>
                      <div class="form-group mb-3">
                          <label>Confirm Password</label>
                          <input type="password" name="confirm_password" class="form-control"
                          id="myInput_confpass" placeholder="Enter Confirm Password">
                          <i class="bi bi-eye-slash" id="hidez" onclick="myFunctionToggleConfpass()"></i>
                          <i class="bi bi-eye-fill" id="showz" onclick="myFunctionToggleConfpass()"></i>
                      </div>

                      <script type="text/javascript">
                            function myFunctionTogglePass() {
                                let pass = document.getElementById("myInput_pass");
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

                     <script type="text/javascript">
                            function myFunctionToggleConfpass() {
                                let pass = document.getElementById("myInput_confpass");
                                if (pass.type === "password") {
                                    pass.type = "text";
                                    document.getElementById("hidez").style.display = "inline-block";
                                    document.getElementById("showz").style.display = "none";
                                } else {
                                    pass.type = "password";
                                    document.getElementById("hidez").style.display = "none";
                                    document.getElementById("showz").style.display = "inline-block";
                                }
                            }
                        </script>

                      <div class="form-group mb-3 ">
                          <button type="submit" name="password_update" class="btn btn-success">
                              Update Password
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