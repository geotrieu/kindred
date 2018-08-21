<!DOCTYPE html>
<html>
  <head>
    <title>Kindred - Your Profile</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="setup.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
  </head>
  <body>
    <div class='container'>
      <div class="page-header">
        <h1><img src="../logo.png" alt="Kindred Logo" style="width:40px;height:40px;vertical-align:middle;" />  Kindred</h1>
      </div>
      <h2>Profile Registration</h2>
      <br>
      <?php
        if (isset($_POST["submit"])) {
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

          //FILE
          $target_dir = "../avatars/";
          $target_file = $target_dir . $_SESSION["username"] . ".png";
          $uploadOk = 1;
          $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
          // Check if image file is a actual image or fake image
          if(isset($_POST["submit"])) {
              $check = getimagesize($_FILES["file"]["tmp_name"]);
              if($check !== false) {
                  echo "File is an image - " . $check["mime"] . ".";
                  $uploadOk = 1;
              } else {
                  echo "File is not an image.";
                  $uploadOk = 0;
              }
          }
          if ($uploadOk == 0) {
              echo "Sorry, your file was not uploaded.";
          // if everything is ok, try to upload file
          } else {
              if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                  echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
              } else {
                  echo "Sorry, there was an error uploading your file.";
              }
          }

          $sql = "INSERT INTO memberprofile (username, fullname, age, gender, canadiancity, countryorigin, occupation, yearsincanada, personality, social, hobbies, habits, interaction, family) VALUES ('" . $_SESSION["username"] . "', '" . $_POST["fullname"] . "', '" . $_POST["age"] . "', '" . $_POST["gender"] . "', '" . $_POST["city"] . "', '" . $_POST["country"] . "', '" . $_POST["occupation"] . "', '" . $_POST["years"] . "', '" . $_POST["personality"] . "', '" . $_POST["social"] . "', '" . $_POST["hobby"] . "', '" . $_POST["habit"] . "', '" . $_POST["interaction"] . "', '" . $_POST["family"] . "')";
          if ($conn->query($sql) === TRUE) {
            echo "<h3 style='color:green;'>Profile Registration Success! Redirecting to find your matches...</h6>";
            echo "<script>window.setTimeout(function(){window.location.href='../home';}, 1000);</script>";
          } else {
              echo "Error: " . $sql . "<br>" . $conn->error;
          }
        }
      ?>
      <form method="post" enctype="multipart/form-data">
      	<div class="form-group"> <!-- Full Name -->
      		<label for="full_name_id" class="control-label">Full Name</label>
      		<input type="text" class="form-control" id="full_name_id" name="fullname" placeholder="John Doe">
      	</div>

      	<div class="form-group"> <!-- Age -->
      		<label for="age" class="control-label">Age</label>
      		<input type="number" class="form-control" id="age" name="age" placeholder="Numeric Format">
      	</div>

        <div class="form-group"> <!-- Gender -->
      		<label for="gender" class="control-label">Gender</label>
      		<select class="form-control" name="gender" id="gender">
      			<option value="male">Male</option>
      			<option value="female">Female</option>
            <option value="other">Other</option>
      		</select>
      	</div>

      	<div class="form-group"> <!-- City-->
      		<label for="city_id" class="control-label">City settled in Canada</label>
      		<input type="text" class="form-control" id="city_id" name="city" placeholder="Smallville">
      	</div>

        <div class="form-group"> <!-- Country-->
      		<label for="country_id" class="control-label">Country of Origin</label>
      		<input type="text" class="form-control" id="country_id" name="country" placeholder="Timberland">
      	</div>

        <div class="form-group"> <!-- Occupation-->
      		<label for="occupation_id" class="control-label">Occupation</label>
      		<input type="text" class="form-control" id="occupation_id" name="occupation" placeholder="What do you do?">
      	</div>

        <div class="form-group"> <!-- Yrs in Canada-->
      		<label for="years_id" class="control-label">Years in Canada (Type 0 for less than 1 year)</label>
      		<input type="number" class="form-control" id="years_id" name="years" placeholder="How long approximately in years are you in Canada?">
      	</div>

      	<div class="form-group"> <!-- Personality -->
      		<label for="personality-id" class="control-label">Personality</label>
      		<select class="form-control" name="personality" id="personality_id">
      			<option value="extrovert">Extrovert</option>
      			<option value="introvert">Introvert</option>
      			<option value="ambivert">Ambivert</option>
      		</select>
      	</div>

        <div class="form-group"> <!-- Social Activities -->
      		<label for="social-id" class="control-label">Social Activities</label>
      		<select class="form-control" name="social" id="social_id">
      			<option value="outdoors">Outdoors</option>
      			<option value="indoors">Indoors</option>
      		</select>
      	</div>

        <div class="form-group"> <!-- Your favourite hobby-->
      		<label for="hobby_id" class="control-label">Your favourite hobby</label>
      		<input type="text" class="form-control" id="hobby_id" name="hobby" placeholder="Only put one hobby here.">
      	</div>

        <div class="form-group"> <!-- Habit -->
      		<label for="habit-id" class="control-label">Habit</label>
      		<select class="form-control" name="habit" id="habit_id">
      			<option value="work">Work</option>
      			<option value="play">Play</option>
      		</select>
      	</div>

        <div class="form-group"> <!-- Preferred Interaction -->
      		<label for="interaction-id" class="control-label">Preferred Interaction</label>
      		<select class="form-control" name="interaction" id="interaction_id">
      			<option value="online">Online</option>
      			<option value="person">In person</option>
      		</select>
      	</div>

        <div class="form-group"> <!-- Family Involvement -->
      		<label for="involvement-id" class="control-label">Are you involved with your family?</label>
      		<select class="form-control" name="family" id="involvement_id">
      			<option value="yes">Yes</option>
      			<option value="no">No</option>
      		</select>
      	</div>

        <div class="form-group"> <!-- Image -->
          <label for="file-id" class="control-label">Upload an image</label>
          <input type="file" name="file" id="file-id">
        </div>

      	<div class="form-group"> <!-- Submit Button -->
      		<button type="submit" name="submit" class="btn btn-success btn-lg">Submit!</button>
      	</div>
      </form>
    </div>
  </body>
</html>
