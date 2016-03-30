<?php

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Student Course Tracker</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="styles.css">
  </head>
  <body>
    <div class="contaner">
      <div class="row">
        <div class="col-sm-12">
          <h1>Student Course Tracker</h1>
        </div>
      </div>
      <!-- TODO remove required tags and replace this functionaly with bootstrap tooltips -->
      <!-- TODO provide better user feedback per feild -->
      <form class="form-horizontal" id="myForm" enctype="multipart/form-data" role="form" action="confirmation.php" method="post">
        <div class="row">
          <div class="col-sm-8 col-centered">
            <div class="panel panel-default col-new-background">
              <div class="panel-heading">
                <strong>Student Info</strong>
              </div>
              <div class="panel-body">
                <div class="form-group">
                  <label for="fname" class="control-label col-sm-2">First Name:</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="fname" placeholder="First Name" name="fname" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="lname" class="control-label col-sm-2">Last Name:</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="lname" placeholder="Last Name" name="lname" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="email" class="control-label col-sm-2">Email:</label>
                  <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" placeholder="me@email.com" name="email" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="dob" class="control-label col-sm-2">Date of Birth:</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" id="dob" name="dob" required>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-8 col-centered">
            <div class="panel panel-default col-new-background">
              <div class="panel-heading">
                <strong>Course Selection</strong>
              </div>
              <div class="panel-body">
                <div class="form-group">
                  <label for="1course" class="control-label col-sm-2">First Course:</label>
                  <div class="col-sm-10">
                    <select name="1course" id="1course" class="form-control" required>
                      <!-- TODO #2 need to add a fix or check for placholder left selected -->
                      <option disabled selected>Select a Course</option>
                      <option value="Accounting 11">Accounting 11</option>
                      <option value="Biology 11">Biology 11</option>
                      <option value="Communications 12">Communications 12</option>
                      <option value="Digitalarts 11">Digital Arts 11</option>
                      <option value="English 12">English 12</option>
                      <option value="French 12">French 11</option>
                      <option value="History 12">History 12</option>
                      <option value="Law 12">Law 12</option>
                      <option value="Physical Education 10">Physical Education 10</option>
                      <option value="Robotics 11">Robotics 11</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="2course" class="control-label col-sm-2">Second Course:</label>
                  <div class="col-sm-10">
                    <select name="2course" id="2course" class="form-control" required>

                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="3course" class="control-label col-sm-2">Third Course:</label>
                  <div class="col-sm-10">
                    <select name="3course" id="3course" class="form-control" required>

                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="dob" class="control-label col-sm-2">Forth Coruse:</label>
                  <div class="col-sm-10">
                    <select name="4course" id="4course" class="form-control" required>

                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-8 col-centered">
            <div class="panel panel-default col-new-background">
              <div class="panel-heading">
                <strong>Student Photo</strong>
              </div>

                <div class="panel-body">
                  <div class="input-group">
                    <span class="input-group-btn">
                      <span class="btn btn-default btn-file">
                        Upload Photo <input type="file" name="photo" required>
                      </span>
                    </span>
                    <input type="text" class="form-control" readonly="">


                  </div>
                </div>

            </div>
          </div>
        </div>
        <div class="row">
          <input type="submit" class="btn btn-default" >
        </div>
      </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="scripts/custom.js"></script>
  </body>
</html>
