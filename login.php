<html>
  <head>
    <link rel="stylesheet" href="css/login.css" type="text/css">
    <script language="javascript" type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script language="javascript" type="text/javascript" src="js/login.js"></script>
  </head>
  <body>

    <div id="header">
      <div id="header-wrapper">
        <div id="header">
          <div id="logo">
        <h1><a href="#">Exami-Nation</a></h1>
        <p>[Logo goes here]</p>
      </div>
    </div>
  </div>
    </div>


      <div class="login-page">
        <div class="form" id="form">
          <form class="register-form">
            <input type="text" placeholder="name"/>
            <input type="password" placeholder="password"/>
            <input type="text" placeholder="email address"/>
            <button>create</button>
            <p class="message">Already registered? <a href="#">Sign In</a></p>
          </form>

          <form class="login-form"
            action = "validateLogin.php"
            method = "post">
            <input type="text" placeholder="username" name="username" size="20" maxlength="20"/>
            <input type="password" placeholder="password" name="password"  size="20" maxlength="20"/>
            <button id="login">login</button>
            <p class="message">Not registered? <a href="#">Create an account</a></p>
          </form>
        </div>
      </div>
    
  </body>
</html>
