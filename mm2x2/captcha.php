<?php
$width = 130;
$height = 60;
$font_size = 16;
$let_amount = 5;
$fon_let_amount = 30;
$font = "include/captcha.ttf";
$letters = array("a","b","c","d","e","f","g","h","k","m","p","s","t","v","x","y","z","1","2","3","4","5","6","7","8","9");     
$colors = array("0","50","100"); 
$src = imagecreatetruecolor($width,$height);             
$fon = imagecolorallocate($src,255,255,255);
imagefill($src,0,0,$fon);
for($i=0;$i < $fon_let_amount;$i++)
{
    $color = imagecolorallocatealpha($src,rand(0,255),rand(0,255),rand(0,255),100);
    $letter = $letters[rand(0,sizeof($letters)-1)];                         
    $size = rand($font_size-2,$font_size+2);                                           
    imagettftext($src,$size,rand(0,45),
        rand($width*0.1,$width-$width*0.1),
        rand($height*0.2,$height),$color,$font,$letter);
}
for($i=0;$i < $let_amount;$i++)
{
   $color = imagecolorallocatealpha($src,$colors[rand(0,sizeof($colors)-1)],
        $colors[rand(0,sizeof($colors)-1)],
        $colors[rand(0,sizeof($colors)-1)],rand(20,40));
   $letter = $letters[rand(0,sizeof($letters)-1)];
   $size = rand($font_size*2-2,$font_size*2+2);
   $x = ($i+1)*$font_size + rand(1,5);
   $y = (($height*2)/3) + rand(0,5);                           
   $code[] = $letter;
   imagettftext($src,$size,rand(0,15),$x,$y,$color,$font,$letter);
}
$code = implode("",$code);
 session_start();
 $_SESSION['security_code'] = $code;
header ("Content-type: image/gif");
imagegif($src);
?>