<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Kindred - Home</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Custom CSS -->
    <link href="peer.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Kindred</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Your matches
                    <small>found on Kindred.</small>
                </h1>
            </div>
        </div>
        <!-- /.row -->
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

            $sql = "SELECT * FROM memberprofile";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                $counter = 0;
                while($row = $result->fetch_assoc()) {
                  if ($row["username"] == $_SESSION["username"]) {
                    continue;
                  }
                  if ($counter == 0) {
                    echo "<div class='row'>";
                  }
                  echo "
                  <div class='col-md-3 portfolio-item'>
                      <a href='test'>
                          <img class='img-responsive' style='width:750px;height:175px;' src='../avatars/" . $row["username"] . ".png' alt='" . $row["username"] . "'s Profile Picture''>
                      </a>
                      <br>
                      <h1>" . $row["fullname"] . "</h1>
                  ";
                  if ($_SESSION["city"] == $row["canadiancity"]) {
                    echo "<h6>+ You both are in " . $row["canadiancity"] . "</h6>";
                  }
                  if ($_SESSION["country"] == $row["countryorigin"]) {
                    echo "<h6>+ You both are from " . $row["countryorigin"] . "</h6>";
                  }
                  if ($_SESSION["occupation"] == $row["occupation"]) {
                    echo "<h6>+ You both are " . $row["occupation"] . "s</h6>";
                  }
                  if ($_SESSION["personality"] == $row["personality"]) {
                    echo "<h6>+ You both are " . $row["personality"] . "s</h6>";
                  }
                  if ($_SESSION["social"] == $row["social"]) {
                    echo "<h6>+ You both like being " . $row["social"] . "</h6>";
                  }
                  if ($_SESSION["hobby"] == $row["hobbies"]) {
                    echo "<h6>+ You both like " . $row["hobbies"] . "</h6>";
                  }
                  if ($_SESSION["interaction"] == $row["interaction"]) {
                    echo "<h6>+ You both like interacting " . $row["interaction"] . "</h6>";
                  }
                  echo "
                  </div>
                  ";
                  if ($counter == 3) {
                    $counter = 0;
                    echo "</div>";
                  }
                  $counter++;
                }
                if ($counter != 0) {
                  echo "</div>";
                }
            } else {
                echo "<h6 style='color:red;'>No results!</h6>";
            }
            $conn->close();
         ?>
        <!-- /.row -->

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Kindred 2018</p>
                </div>
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->
</body>

</html>
