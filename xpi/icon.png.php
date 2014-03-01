<?php

$width  = 48;
$height = 48;

$original = imagecreatefrompng($config['files']['icon']);
$resized = imagecreatetruecolor($width, $height);
imagealphablending($resized, false);
imagesavealpha($resized, true);
$color = imagecolorallocatealpha($resized, 0x00, 0x00, 0x00, 0xff);
imagefilledrectangle($resized, 0, 0, imagesx($resized), imagesy($resized), $color);
imagecopyresampled($resized, $original, 0, 0, 0, 0, imagesx($resized), imagesy($resized), imagesx($original), imagesy($original));
imagedestroy($original);

ob_start();
imagepng($resized, null, 0);
imagedestroy($resized);
return ob_get_clean();
