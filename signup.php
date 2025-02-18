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
    <form action="user_signup.php" method="post" onsubmit="return validateForm()">
      <div class="user-details">
        <div class="input-box">
          <label class="details">First Name</label>
          <input type="text" placeholder="Enter your firstname" name="firstname" id="firstname" required />
          <span id="fnameError" style="color: red;"></span>
        </div>
        <div class="input-box">
          <label class="details">Last Name</label>
          <input type="text" placeholder="Enter your lastname" name="lastname" id="lastname" required />
          <span id="lnameError" style="color: red;"></span>
        </div>
        <div class="input-box">
          <label class="details">Email</label>
          <input type="email" placeholder="Enter your email" name="email" id="email" required />
          <span id="emailError" style="color: red;"></span>
        </div>
        <div class="input-box">
          <label class="details">Password</label>
          <input type="password" placeholder="Enter your password" name="password" id="password" required />
          <span id="pwdError" style="color: red;"></span>
        </div>
        <div class="input-box">
          <label class="details">Address</label>
          <input type="text" placeholder="Enter your address" name="address" id="address" required />
          <span id="addressError" style="color: red;"></span>
        </div>
        <div class="input-box">
          <label class="details">City</label>
          <input type="text" placeholder="Enter your city name" name="city" id="city" required />
          <span id="cityError" style="color: red;"></span>
        </div>
        <div class="input-box">
          <label class="details">Zip code</label>
          <input type="number" placeholder="Your city zipcode" name="zipcode" id="zipcode" required />
          <span id="zipcodeError" style="color: red;"></span>
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

<script>
  function validateForm() {
    let isValid = true;

    let firstname = document.getElementById("firstname").value.trim();
    let lastname = document.getElementById("lastname").value.trim();
    let email = document.getElementById("email").value.trim();
    let password = document.getElementById("password").value.trim();
    let address = document.getElementById("address").value.trim();
    let city = document.getElementById("city").value.trim();
    let zipcode = document.getElementById("zipcode").value.trim();

    let fnameError = document.getElementById("fnameError");
    let lnameError = document.getElementById("lnameError");
    let emailError = document.getElementById("emailError");
    let pwdError = document.getElementById("pwdError");
    let addressError = document.getElementById("addressError");
    let cityError = document.getElementById("cityError");
    let zipcodeError = document.getElementById("zipcodeError");

    fnameError.innerText = "";
    lnameError.innerText = "";
    emailError.innerText = "";
    pwdError.innerText = "";
    zipcodeError.innerText = "";



    console.log(firstname, lastname, email, password.length, address, city, zipcode);

    if (!/^[a-zA-Z]+$/.test(firstname)) {
      fnameError.innerText = "Only letters are allowed";
      isValid = false;
    }

    if (!/^[a-zA-Z]+$/.test(lastname)) {
      lnameError.innerText = "Only letters are allowed";
      isValid = false;
    }
    if (!/^\S+@\S+\.\S+$/.test(email)) {
      emailError.innerText = "Invalid email format";
      isValid = false;
    }
    if (password.length < 8) {
      pwdError.innerText = "Password must be at least 8 characters";
      isValid = false;
    }
    if (zipcode.length !== 5) {
      zipcodeError.innerText = "Zipcode must be 5 digits";
      isValid = false;
    }

    return isValid;
  }
</script>