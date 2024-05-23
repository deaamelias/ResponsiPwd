<?php
session_start();
$random_alpha = md5(rand());
$captcha_code = substr($random_alpha, 0, 6);
$_SESSION["captcha_code"] = $captcha_code;
$target_layer = imagecreatetruecolor(150, 50);

// Background color
$captcha_background = imagecolorallocate($target_layer, 255, 160, 119);
imagefill($target_layer, 0, 0, $captcha_background);

// Lines across the captcha
for ($i = 0; $i < 5; $i++) {
    $line_color = imagecolorallocate($target_layer, rand(0, 255), rand(0, 255), rand(0, 255));
    imageline($target_layer, rand(0, 150), rand(0, 50), rand(0, 150), rand(0, 50), $line_color);
}

// Draw circles
for ($i = 0; $i < 5; $i++) {
    $ellipse_color = imagecolorallocate($target_layer, rand(0, 255), rand(0, 255), rand(0, 255));
    imagefilledellipse($target_layer, rand(0, 150), rand(0, 50), 20, 20, $ellipse_color);
}

$captcha_text_color = imagecolorallocate($target_layer, 0, 0, 0);
imagestring($target_layer, 5, 40, 15, $captcha_code, $captcha_text_color);

header("Content-type: image/jpeg");
imagejpeg($target_layer);
?>
