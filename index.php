<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="css/index.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>
    <div class="wrapper">
        <div class="title-text">
          <div class="title login">Login Form
          <center style="color:red;">
						<?php
                            if (isset($_GET["msg"]) && $_GET["msg"] == 'failed') {
                                echo "Wrong Username / Password";
                                }
                        ?></center>
          </div>
          <div class="title signup">Signup Form</div>
        </div>
        <div class="form-container">
          <div class="slide-controls">
            <input type="radio" name="slide" id="login" checked>
            <input type="radio" name="slide" id="signup">
            <label for="login" class="slide login">Login</label>
            <label for="signup" class="slide signup">Signup</label>
            <div class="slider-tab"></div>
          </div>
          <div class="form-inner">
            <form action="controllers/UserController.php" method="POST" class="login">
              <div class="field">
                <input name="email" type="text" placeholder="Email Address" required>
              </div>
              <div class="field">
                <input name="password" type="password" placeholder="Password" id="myInput" required>
                <!-- i class="far fa-eye" onclick="myFunction()" style="cursor: pointer;"></i -->
              </div>
              
              <div class="field btn">
                <div class="btn-layer"></div>
                <input name="login" type="submit" value="Login">
              </div>
              <div class="signup-link">Not a member? <a href="">Signup now</a></div>
            </form>
            <form action="controllers/UserController.php" method="POST" class="signup">
              <div class="field">
                <input name="email" type="text" placeholder="Email Address" required>
              </div>
              <div class="field">
                <input name="firstname" type="text" placeholder="First Name" required>
              </div>
              <div class="field">
                <input name="lastname" type="text" placeholder="Last Name" required>
              </div>
              <div class="field">
                <select name="gender" type="text" placeholder="Last Name" required>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                </select>
              </div>
              <div class="field">
                <input name="contact" type="number" placeholder="09123456789" max="9999999999" required>
              </div>
              <div class="field">
                <input name="department" type="text" placeholder="Department/Subject" required>
              </div>
              <div class="field">
                <input name="birthday" type="date" placeholder="Birthday" required>
              </div>
              <div class="field">
                <input name="password" type="password" placeholder="Password" required>
              </div>
              <center><div class="pass-link"><input type="checkbox" required>&#160; &#160;<a href="terms_condition.php">Terms & Condition</a></div></center>
              <div class="field btn">
                <div class="btn-layer"></div>
                <input name="register" type="submit" value="Signup">
              </div>
            </form>
          </div>
        </div>
      </div>
  <script>
     const loginText = document.querySelector(".title-text .login");
      const loginForm = document.querySelector("form.login");
      const loginBtn = document.querySelector("label.login");
      const signupBtn = document.querySelector("label.signup");
      const signupLink = document.querySelector("form .signup-link a");
      signupBtn.onclick = (()=>{
        loginForm.style.marginLeft = "-50%";
        loginText.style.marginLeft = "-50%";
      });
      loginBtn.onclick = (()=>{
        loginForm.style.marginLeft = "0%";
        loginText.style.marginLeft = "0%";
      });
      signupLink.onclick = (()=>{
        signupBtn.click();
        return false;
      });


  function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}



      
      
  </script>
</body>
</html>