<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles/loginStyles.css" />
    <title>Login Page</title>
  </head>
  <body>
    <div id="container">
      <div id="login-box">
        <h1>Login</h1>
        <?php
        session_start();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $enteredUsername = $_POST["username"] ?? '';
          $enteredPassword = $_POST["password"] ?? '';

          if (empty($enteredUsername) || empty($enteredPassword)) {
            echo "<h1 style = 'color:red;'>Please enter both username and password.</h1>";
          } else {
            $users = json_decode(file_get_contents("pages/users.json"), true) ?? [];
            foreach ($users as $user) {
              if ($user["username"] === $enteredUsername && $user["password"] === $enteredPassword) {
                $_SESSION['user'] = $user;
                header("Location: pages/gallery.php");
                exit();
              }
            }
            echo "<h1 style = 'color: red;'>Invalid username or password.</h1>";
          }
        }
        ?>
        <form action="#" method="post">
          <div id="inputs">
            <input type="text" placeholder="Username" name="username" />
            <input type="password" placeholder="Password" name="password" />
          </div>
          <div id="space"></div>
          <button type="submit">Login</button>
        </form>
        <div id="member">
          Don't have an Account? <a href="pages/signUp.php">Sign-Up Here</a>
        </div>
      </div>
    </div>
  </body>
</html>
