<?php include "header.php";
session_start();

if(isset($_POST['submit'])){
  include "config.php";



  $user = mysqli_real_escape_string($conn,$_POST['username']);
  $pass = mysqli_real_escape_string($conn,md5($_POST['pass']));
  $conpass = mysqli_real_escape_string($conn,md5($_POST['conpass']));
  if($pass!=$conpass){
    echo "Password are not matched";

  }
  else {
    $sql1 = "UPDATE user SET username = '{$user}', password='{$pass}' WHERE username = '{$user}'";

      if(mysqli_query($conn,$sql1)){
        $_SESSION['status']='<div class="alert alert-danger">Password update sucessfully...!.</div>';
       header("Location: {$hostname}/index.php");
      }
  }

}
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Update Password</h1>
              </div>
              <div class="col-md-offset-4 col-md-4">
                <?php
                include "config.php";

                  $user_id = $_GET['id'];

                $sql = "SELECT username FROM user WHERE username = '{$user_id }'";
                $result = mysqli_query($conn, $sql) or die("Query is Failed.");
                if(mysqli_num_rows($result) > 0){
                  while($row = mysqli_fetch_assoc($result)){
                ?>
                  <!-- Form Start -->
                  <form  action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST">

                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="username" class="form-control" value="<?php echo $row['username'];  ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>password</label>
                          <input type="password" name="pass" class="form-control" value="" required>
                      </div>  <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" name="conpass" class="form-control" value="" required>
                        </div>

                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                        <label>  <a href="index.php" style="margin-left:50px;">Back</a></label>
                  </form>
                  <!-- /Form -->
                  <?php
                }
              }
                   ?>
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
