<!DOCTYPE html>
<html>
  <head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="index.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
  </head>
  <body id="LoginForm">
    <div class="container">
      <h1 class="form-heading" style="font-family: 'Raleway', sans-serif;">Kindred</h1>
      <div class="login-form">
        <div class="main-div">
          <div class="panel">
            <h2>Register</h2>
            <p>Welcome to Kindred! Please register below!</p>
          </div>
          <form method="post" id="Login">
            <div class="form-group">
              <input type="text" class="form-control" name="username" placeholder="Username">
            </div>
            <div class="form-group">
              <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
            <div class="form-group">
              <input type="email" class="form-control" name="email" placeholder="Email">
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="type" value="mentor">
              <label class="form-check-label" for="exampleRadios2">
                Mentor
              </label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="type" value="peer">
              <label class="form-check-label" for="exampleRadios2">
                Peer
              </label>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
          </form>
          <div class="forgot">
            <a href="../login">Have an account already? Login</a>
          </div>
          <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "kindred";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["email"]) && isset($_POST["type"])) {
              $sql = "INSERT INTO users (username, encryptedpw, email, type) VALUES ('" . $_POST["username"] . "', '" . $_POST["password"] . "', '" . $_POST["email"] . "', '" . $_POST["type"] . "')";
              if ($conn->query($sql) === TRUE) {
                echo "<h6 style='font-color:green;'>Register Success! Proceed to the login page!</h6>";
              } else {
                  echo "Error: " . $sql . "<br>" . $conn->error;
              }
            } else if (isset($_POST["username"])) {
              echo "Please fill out all details!";
            }
          ?>
        </div>
        </div>
      </div>
    </div>
  </body>
</html>
