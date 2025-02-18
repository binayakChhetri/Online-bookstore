<?php
$title = "User SignUp";
require_once "./template/header.php";
?>

<style>
  <?php include './CSS/signup.css'; ?>
</style>

<div class="signup-container">
  <h2 class="title">Registration</h2>
  <div class="content">
    <form action="user_signup.php" method="post">
      <div class="user-details">
        <div class="input-box">
          <label class="details">First Name</label>
          <input type="text" placeholder="Enter your firstname" required />
        </div>
        <div class="input-box">
          <label class="details">Last Name</label>
          <input type="text" placeholder="Enter your lastname" required />
        </div>
        <div class="input-box">
          <label class="details">Email</label>
          <input type="email" placeholder="Enter your email" required />
        </div>
        <div class="input-box">
          <label class="details">Password</label>
          <input type="password" placeholder="Enter your password" required />
        </div>
        <div class="input-box">
          <label class="details">Address</label>
          <input type="text" placeholder="Enter your address" required />
        </div>
        <div class="input-box">
          <label class="details">City</label>
          <input type="text" placeholder="Enter your city name" required />
        </div>
        <div class="input-box">
          <label class="details">Zip code</label>
          <input type="number" placeholder="" required />
        </div>
      </div>
      <div class="button">
        <input type="submit" value="Register" />
      </div>
    </form>
  </div>
</div>



<?php
$fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
if (strpos($fullurl, "signup=empty") == true) {
  echo '<P style="color:red">You did not fill in all the fields.</P>';
  exit();
}
if (strpos($fullurl, "signup=invalidemail") == true) {
  echo '<P style="color:red">You did not enter a valid email address.</P>';
  exit();
}
?>
</div>
<?php
require_once "./template/footer.php";
?>