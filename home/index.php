<?php
  // Start the session
  session_start();
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

  $sql = "SELECT * FROM memberprofile WHERE username='" . $_SESSION["username"] . "'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        if ($_SESSION["type"] == "peer") {
          include("peer.php");
        } else {
          include("mentor.php");
        }
      }
  } else {
      //Go to setup
      include("setup.php");
  }
?>
