<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../styles/signUpStyles.css" />
    <title>Sign Up Page</title>
  </head>
  <body>
    <div id="container">
      <div id="signUp">
        <h1>Sign Up</h1>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $username = $_POST["username"] ?? '';
          $firstName = $_POST["firstName"] ?? '';
          $lastName = $_POST["lastName"] ?? '';
          $password = $_POST["password"] ?? '';
          $dateOfBirth = $_POST["dateOfBirth"] ?? '';
          $sex = $_POST["sex"] ?? 'male';

          if (empty($username) || empty($firstName) || empty($lastName) || empty($password) || empty($dateOfBirth) || empty($sex)) {
            echo "<h1 style='color: red;'>Please fill in all fields!</h1>";
          } else {
            $userdata = [
              "username" => $username,
              "first_name" => $firstName,
              "last_name" => $lastName,
              "password" => $password,
              "dateOfBirth" => $dateOfBirth,
              "sex" => $sex,
            ];

            $users = json_decode(file_get_contents("users.json"), true) ?? [];
            foreach ($users as $user) {
              if ($user["username"] === $username) {
                echo "<h1 style='color: red;'>Username already exists!</h1>";
                break;
              }
            }

            if (!isset($user) || $user["username"] !== $username) {
              $users[] = $userdata;
              file_put_contents("users.json", json_encode($users));

              header("Location: ../index.html");
              exit();
            }
          }
        }
        ?>
        <form action="#" method="post">
          <div id="inputs">
            <input type="text" placeholder="Username" name="username"/>
            <br />
            <input type="text" placeholder="First Name" name="firstName"/>
            <br />
            <input type="text" placeholder="Last Name" name="lastName"/>
            <br />
            <input type="text" placeholder="Password" name="password"/>
            <br />
            <input type="date" id="birthday" name="dateOfBirth"/>
          </div>
          <div class="sex">
            <input type="radio" name="sex" value="male" /> Male
          </div>
          <div class="sex">
            <input type="radio" name="sex" value="female" /> Female
          </div>
          <br />
          <div id="space"></div>
          <button onclick="submitForm()">Sign Up</button>
        </form>
        <div id="member">
          Already Signed Up? <a href="../index.php">Login Here</a>
        </div>
      </div>
    </div>
  </body>
</html>
