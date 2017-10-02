<html>
  <head>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="css/login.css" type="text/css">
  </head>
  <body>
    <script language="javascript" type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script language="javascript" type="text/javascript" src="js/login.js"></script>
    <div id="Student" class="w3-display-container">
      <span onclick="this.parentElement.style.display=''none" class="w3-button w3-display-topright"></span>
      <div class="login-page">
        <div class="form">
          <!--
          <form class="register-form">
            <input type="text" placeholder="name"/>
            <input type="password" placeholder="password"/>
            <input type="text" placeholder="email address"/>
            <button>create</button>
            <p class="message">Already registered? <a href="#">Sign In</a></p>
          </form> 
          -->
          <form class="login-form"
          action = "validateLogin.php"
          method = "post">
            <input type="text" placeholder="username" name="username"/>
            <input type="password" placeholder="password" name="password"/>
            <button>login</button>
            <p class="message">Not registered? <a href="#">Create an account</a></p>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
