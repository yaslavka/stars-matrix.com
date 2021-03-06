<?php
//include("init.php");		
//if ($gloginstat==false) { header("Location: ../"); } else {
//if ($gstep<4) { header("Location: index.php"); } else {


function img_resize($src, $maxsize) {
	$dest=$src;
	$rgb=0xFFFFFF;
	$quality=100;
	
  if (!file_exists($src)) return false;
  
	list($width, $height, $type, $attr) = getimagesize($src);
	if ($width > $height) { $dif = $width / $maxsize; $width = $maxsize; $height = $height / $dif; } 
	 else { $dif = $height / $maxsize; $height = $maxsize; $width = $width / $dif;}	
  
  $size = getimagesize($src);
  if ($size === false) return false;
  // Определяем исходный формат по MIME-информации, предоставленной
  // функцией getimagesize, и выбираем соответствующую формату
  // imagecreatefrom-функцию.
  $format = strtolower(substr($size['mime'], strpos($size['mime'], '/')+1));
  $icfunc = "imagecreatefrom" . $format;
  if (!function_exists($icfunc)) return false;
  $x_ratio = $width / $size[0];
  $y_ratio = $height / $size[1];
  $ratio       = min($x_ratio, $y_ratio);
  $use_x_ratio = ($x_ratio == $ratio);
  $new_width   = $use_x_ratio  ? $width  : floor($size[0] * $ratio);
  $new_height  = !$use_x_ratio ? $height : floor($size[1] * $ratio);
  $new_left    = $use_x_ratio  ? 0 : floor(($width - $new_width) / 2);
  $new_top     = !$use_x_ratio ? 0 : floor(($height - $new_height) / 2);
  $isrc = $icfunc($src);
  $idest = imagecreatetruecolor($width, $height);
  imagefill($idest, 0, 0, $rgb);
  imagecopyresampled($idest, $isrc, $new_left, $new_top, 0, 0, 
    $new_width, $new_height, $size[0], $size[1]);
  imagejpeg($idest, $dest, $quality);
  imagedestroy($isrc);
  imagedestroy($idest);
  return true;
}



//}
//}
?>