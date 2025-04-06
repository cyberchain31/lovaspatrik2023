<?php
  session_start();

  if(isset($_SESSION['authenticated'])) {

    $_SESSION['status'] = "You are already Logged IN.";
    header("Location: dashboard.php");
    exit(0);
} 

  $page_title = "Login Form";
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
                  <h5>Login Form</h5>
              </div>
              <div class="card-body">

                  <form action="logincode.php" method="POST">    

                      <div class="form-group mb-3">
                          <label>Email Address</label>
                          <input type="text" name="email" class="form-control" placeholder="Enter Email Address">
                      </div>
                      <div class="form-group mb-3">
                          <label>Password</label>
                          <input type="password" name="password" class="form-control"
                          id="myInput" placeholder="Enter Password">
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

                      <div class="form-group ">
                          <button type="submit" name="login_now_btn" class="btn btn-success">
                              Login Now
                          </button>
                          <a href="password-reset.php" class="float-end">Forgot Your Password?</a>
                      </div>
                  </form>

                  <hr>
                  <h5>Did not receive your Verification Email?
                      <a href="resend-email-verification.php">Resend.</a>
                  </h5>

              </div>
          </div>
      </div>
    </div>
  </div>
</div>

<?php include('includes/footer.php'); ?>