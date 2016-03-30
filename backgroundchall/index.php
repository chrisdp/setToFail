<?php
// Cookie names and settings
$cookie_color_name = 'background';
$cookie_nag_name = 'nag';
$expire = time() + (60 * 5);

$bcolor = "#FFF"; // default bacground color

// check for page load without POST
if (!empty($_POST['color'])) {

    // check if user has attempted before
    if (!isset($_COOKIE[$cookie_nag_name])) {
        $attempts = 1; // var to hold current number of attempts
    } else {
        $attempts = $_COOKIE[$cookie_nag_name] + 1;
    }

    // create nag count cookie
    setcookie($cookie_nag_name, $attempts, $expire);

    // valid HEX?
    if (preg_match("/#([a-f0-9]{3}){1,2}\b/i", $_POST['color'])) {
        // save the valid HEX
        $bcolor = $_POST['color'];
        setcookie($cookie_color_name, $_POST['color'], $expire);
    } else {
        // load defaults and give feedback
        defaults();
        echo "$_POST[color] is not a valid HEX code<br>";
    }
} else {
    // load defaults on no POST data
    defaults();
}

// check for three or more attempts
if ($attempts > 2) {
    echo "<br>look how much time you've wasted.... <br>You've used this silly app $attempts times in the past 5 minutes!";
}

function defaults() {
    // blahhhhh inform this function that the following are global
    global $cookie_color_name, $expire, $bcolor;

    // load user HEX if one is set
    if (isset($_COOKIE[$cookie_color_name])) {
        $bcolor = $_COOKIE[$cookie_color_name];
    }

    // save cookie to update the expire time
    setcookie($cookie_color_name, $bcolor, $expire, "/");
}
?>
<!DOCTYPE html>
<html>
    <head>
	<title>Set Background Color</title>
    </head>
    <body style="background: <?php echo $bcolor; // update page color ?>">
        <form method="post">
            <p>Enter new color as HEX:</p>
            <input type="text" name="color" placeholder="#FFF000" >
            <input type="submit" value="Set new color" >
        </form>
    </body>
</html>
