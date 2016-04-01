<?php
$vaild = true;
$errorMsg = "";
if (($_POST['fname'] === '') ||
    ($_POST['lname'] === '') ||
    ($_POST['email'] === '') ||
    ($_POST['dob'] === '') ||
    ($_POST['1course'] === '') ||
    ($_POST['2course'] === '') ||
    ($_POST['3course'] === '') ||
    ($_POST['4course'] === '') ||
    ($_FILES['photo']['error'] != 0)) {
    $errorMsg = "Missing data. Please make sure all feilds are filled in.";
    $vaild = false;
} else {
    // check for missing file
    if ($_FILES['photo'] != "") {
        // check file size is less then 2 mb
		// BUGFIX: Size is in bytes so convert to mb
        if ($_FILES["photo"]["size"] < (2*1024*1024)) {
            // check for exsiting file
            $fname = "";
            if (file_exists("./uploads/" . $_FILES['photo']['name'])){

                // split up file name data
                $int = 0;
                $info = pathinfo($_FILES["photo"]["name"]);
                $name = $info['filename'];
                $format = $info['extension'];

                // create windows style dup name
                do {
                    $int++;
                    $fname = "$name($int).$format";
                } while (file_exists("./uploads/$fname"));
            } else {
                // no file of the same name found
                // use original file name
                $fname = $_FILES["photo"]["name"];
            }

            // save file to server
            if (@copy($_FILES['photo']['tmp_name'], "./uploads/" . $fname)) {
				// BUGFIX: Corrected path to uploads directory
                $imgpath = "uploads/" . $fname;
                $imgname = $fname;
                $errorMsg = "";

                // store the users course selections
                $course = array($_POST['1course'], $_POST['2course'], $_POST['3course'], $_POST['4course']);

                // save data in file
                addNewStudent($course);
            } else {
                $errorMsg .= 'There was a problem saving your photo.';
                $vaild = false;
            }
        } else {
            $errorMsg .= "Your photo was to large to be saved.";
            $vaild = false;
        }
    } else {
        $errorMsg .= "I'm sorry. Like pens and socks, your photo has managed to disaper. Please try again.";
        $vaild = false;
    }
}

function addNewStudent($courses) {

    // convert users name to mach the following format
    // First L
    $name = ucwords($_POST["fname"] . " " . substr($_POST['lname'], 1, 1));
    foreach ($courses as $val) {

        // add the users name to each corresponding course file
        $coursefile = "./courses/" . strtolower(str_replace(" ", "",$val));
        file_put_contents($coursefile, $name . "\n", FILE_APPEND);
    }
    //sendConfirmation();
}

function sendConfirmation() {
    // setup email content
    $mailHeaders  = 'MIME-Version: 1.0' . "\r\n";
    $mailHeaders .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $mailHeaders .= "From: My Web Site <contact@chrisdwyerperkins.com>\n";
    $mailHeaders .= "Reply-To:$_POST[email]\n";

    $body = "<table><thead><tr><th>Information</th><th>Supplied Info</th> </tr></thead>";
    $body .= "<tbody><tr><td>First Name:</td><td>" . $_POST['fname'] . "</td></tr>";
    $body .= "<tr><td>Last Name:</td><td>" . $_POST['lname']. "</td></tr>";
    $body .= "<tr><td>Confirmation Email:</td><td>" . $_POST['email'] . "</td></tr>";
    $body .= "<tr><td>Date of Birth:</td><td>" . $_POST['dob'] . "</td></tr></tbody></table>";

    $body .= "<table><thead><tr><th>Preference </th><th>Course Name</th></tr></thead>";
    $body .= "<tbody><tr><td>First:</td><td>" . $_POST['1course'] . "</td></tr>";
    $body .= "<tr><td>Second:</td><td>" . $_POST['2course'] . "</td></tr>";
    $body .= "<tr><td>Third:</td><td>" . $_POST['3course'] . "</td></tr>";
    $body .= "<tr><td>Fourth:</td><td>" . $_POST['4course'] . "</td></tr></tbody></table>";

    $to = "$_POST[email]";

    $subject = "Enrollment for $_POST[fname] $_POST[lname]";

    mail($to, $subject, $body, $mailHeaders);
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Student Course Confirmation</title>
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
                    <h1>Student Course Confirmation</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-8 col-centered">
                    <div class="panel panel-default col-new-background">
                        <div class="panel-heading">
                           <strong>Student Information</strong>
                        </div>
                        <div class="panel-body">
                            <?php if($vaild):  ?>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Information </th>
                                        <th>Supplied Info</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>First Name:</td>
                                        <td><?php echo $_POST["fname"]; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Last Name:</td>
                                        <td><?php echo $_POST["lname"]; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Confirmation Email:</td>
                                        <td><?php echo $_POST["email"]; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Date of Birth:</td>
                                        <td><?php echo $_POST["dob"]; ?></td>
                                    </tr>
                                </tbody>
                            </table>

                            <img src="<?php echo $imgpath; ?>" alt="<?php echo $imgname; ?>" class="img-thumbnail" width="304" height="236" style="margin-bottom: 20px" /><br>

                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Preference </th>
                                        <th>Course Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>First:</td>
                                        <td><?php echo $_POST["1course"]; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Second:</td>
                                        <td><?php echo $_POST["2course"]; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Third:</td>
                                        <td><?php echo $_POST["3course"]; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Fourth:</td>
                                        <td><?php echo $_POST["4course"]; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <?php endif; ?>
                            <?php if(!$vaild): ?>
                                <strong>There was a error processing your request:</strong> <br>
                                <?php echo $errorMsg ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="scripts/custom.js"></script>
    </body>
</html>
