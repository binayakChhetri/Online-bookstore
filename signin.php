<?php
$title = "User SignIn";
require_once "./template/header.php";
?>

<style>
  <?php include './CSS/signin.css'; ?>
</style>


<?php
if (isset($_GET['signup']) && $_GET['signup'] === 'success') {
  echo "<div style='background-color: #; color: #155724; padding: 10px; border-radius: 5px; text-align: center;'>
            Signup successful! You can now log in.
          </div>";


  echo "<script>
          setTimeout(function() {
              window.history.replaceState(null, '', window.location.pathname);
          }, 3000);
        </script>";
}

?>
<div class="form-container">
  <form class="signin-form" method="post" action="user_verify.php">
    <div class="form-group">
      <label for="exampleInputEmail1">Email</label>
      <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter username" name="username"
        required>
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Password</label>
      <input type="password" class="form-control" placeholder="Password" name="password" required>
    </div>

    <button type="submit" class="signin-btn">Submit</button>

  </form>

</div>

<div style="position:fixed; bottom:400px">
  <?php
  $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  if (strpos($fullurl, "signin=empty") == true) {
    echo '<P style="color:red">You did not fill in all the fields.</P>';
    exit();
  }
  if (strpos($fullurl, "signin=invalidusername") == true) {
    echo '<P style="color:red">Username Does not exist.</P>';
    exit();
  }
  if (strpos($fullurl, "signin=invalidpassword") == true) {
    echo '<P style="color:red">Password is not correct.</P>';
    exit();
  }
  ?>
</div>