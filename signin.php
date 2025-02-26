<?php
$title = "User SignIn";
require_once "./template/header.php";
?>

<style>
  <?php include './CSS/signin.css'; ?>
</style>


<?php
if (isset($_GET['signin']) && $_GET['signin'] === 'invalid') {
  echo "<div style='background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; text-align: center;'>
            Invalid username or password. Please try again.
          </div>";
  echo "<script>
          setTimeout(function() {
              window.history.replaceState(null, '', window.location.pathname);
          }, 3000);
        </script>";
}

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
      <input type="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email" name="username"
        required>
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Password</label>
      <input type="password" class="form-control" placeholder="Password" name="password" required>
    </div>
    <button type="submit" class="signin-btn">Submit</button>
  </form>
</div>