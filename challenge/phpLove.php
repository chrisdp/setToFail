<?php


    if (isset($_POST['redirect'])){
        $result = "PHP eh? Noice!!!";
    } else if (isset($_POST['redirect2'])) {
        $result = "JSP eh? DEEEEECENT!";
    } else if (isset($_POST['redirect3'])) {
        $result = "ASP.Net? Awesome Possum!!!";
    }

    $browser = $_SERVER['HTTP_USER_AGENT'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Query Strings Brah!!!!</title>
</head>
<body>
  <p>Boom! I got your result: <?php echo $result; ?></p>
  <p>Boom! from this browser: <?php echo $browser; ?></p>
</body>
</html>
