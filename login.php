<?php // login.php
  require_once 'header.php'; //include header
  $error = $user = $pass = ""; // Set error if inputs fields are empty

  // Sanitize to prevent hacking attempts
  if (isset($_POST['user']))
  {
    $user = mysql_fix_string($connection, $_POST['user']);
    $pass = mysql_fix_string($connection, $_POST['pass']);
    
    if ($user == "" || $pass == "")
      $error = 'Not all fields were entered';
    else
    {
      $result = queryMySQL("SELECT user,pass FROM admin
        WHERE user='$user' AND pass='$pass'");

      if ($result->num_rows == 0)
      {
        $error = "Invalid login attempt";
      }
      else
      {
        $_SESSION['user'] = $user;
        $_SESSION['pass'] = $pass;
        echo "<script type='text/javascript'> document.location = 'publish.php'; </script>"; //Redirect to patient form
      }
    }
  }

  //login form
  echo <<<_END
  <div class="header">
  <h2>Welcom to K & T News</h2>
  <h4>Admin Login</h4>
  </div>
  <form method='post' action='login.php'>
  <div class="input-group">
      <label></label>
      <span class='error'>$error</span>
    </div>
    
    <div class="input-group">
      <label>Username</label>
      <input type='text' maxlength='16' name='user' value='$user' placeholder='Username'>
    </div>
    <div class="input-group">
      <label>Password</label>
      <input type='password' maxlength='16' name='pass' value='$pass' placeholder='Password'>
    </div>
    <div class="input-group">
      
    <button type="submit" style="float: left;" name="login" class="btn">Login</button>
    </div>
    <div class="input-group" align='center'>
  <label></label>
      <a href="signup.php" >singup</a>
    </div>
  </form>
</div>
</body>
</html>
_END;
?>
