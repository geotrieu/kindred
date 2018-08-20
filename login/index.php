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
                      echo "id: " . $row["username"]. " - Name: " . $row["encryptedpw"]. " " . $row["type"]. "<br>";
                  }
              } else {
                  echo "0 results";
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
