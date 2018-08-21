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
            <h2>Login</h2>
            <p>Please enter your login credentials</p>
          </div>
          <form method="post" id="Login">
            <div class="form-group">
              <input type="text" class="form-control" name="username" placeholder="Username">
            </div>
            <div class="form-group">
              <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
              <div class="forgot">
                <a href="reset.html">Forgot password?</a>
              </div>
            <button type="submit" class="btn btn-primary">Login</button>
          </form>
          <div class="forgot">
            <a href="../register">Don't have an account? Register</a>
          </div>
          <?php
            // Start the session
            session_start();
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "kindred";

            // Create connection
            if (isset($_POST["username"]) && isset($_POST["password"])) {
              $conn = new mysqli($servername, $username, $password, $dbname);

              // Check connection
              if ($conn->connect_error) {
                  die("Connection failed: " . $conn->connect_error);
              }

              $sql = "SELECT * FROM users WHERE username='" . $_POST["username"] . "' AND encryptedpw='" . $_POST["password"] . "'";
              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                  // output data of each row
                  while($row = $result->fetch_assoc()) {
                    $_SESSION["username"] = $_POST["username"];
                    $_SESSION["type"] = $row["type"];
                    $sql = "SELECT * FROM memberprofile WHERE username='" . $_POST["username"] . "'";
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();
                    $_SESSION["fullname"] = $row["fullname"];
                    $_SESSION["age"] = $row["age"];
                    $_SESSION["gender"] = $row["gender"];
                    $_SESSION["city"] = $row["canadiancity"];
                    $_SESSION["country"] = $row["countryorigin"];
                    $_SESSION["occupation"] = $row["occupation"];
                    $_SESSION["years"] = $row["yearsincanada"];
                    $_SESSION["personality"] = $row["personality"];
                    $_SESSION["social"] = $row["social"];
                    $_SESSION["hobby"] = $row["hobbies"];
                    $_SESSION["habit"] = $row["habits"];
                    $_SESSION["interaction"] = $row["interaction"];
                    $_SESSION["family"] = $row["family"];
                  }
                  echo "<h6 style='color:green;'>Login Success! Redirecting you to Kindred in 3 seconds...</h6>";
                  echo "<script>window.setTimeout(function(){window.location.href='../home';}, 3000);</script>";
              } else {
                  echo "<h6 style='color:red;'>Invalid Details! Check your login details again!</h6>";
              }
              $conn->close();
            }
          ?>
        </div>
        </div>
      </div>
    </div>
  </body>
</html>
