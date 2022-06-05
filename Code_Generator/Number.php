<?php
function CreateFormNumber($Num1, $Num2)
{
	$text1 = $Num1; 
	$text2 = $Num2;
	$im = imagecreatetruecolor(300, 320);
	$CENTER = 150;
	$FONT = 'TTF/arial.ttf';

	$white = imagecolorallocate($im, 255, 255, 255);
	$black = imagecolorallocate($im, 0, 0, 0);

	imagefill($im, 1, 1, $white);

	imagefilledrectangle($im, 0, 0, 300, 320, $black);
	imagefilledrectangle($im, 2, 2, 297, 317, $white);

	$head = "Коробка/Палета";
	$box = imagettfbbox(11, 0, $FONT, $head);
	$left = $CENTER-round( ( $box[2] - $box[0] ) / 2 );
	$x1 = $left-42;
	imagettftext($im, 20, 0, $x1, 40, $black, $FONT, $head);
	imageline($im, $x1, 45, $x1+202, 45, $black);
	imageline($im, $x1, 46, $x1+202, 46, $black);
	if(strlen($text1) == 7)
	{
		imagefilledrectangle($im, 158, 55, 251, 103, $black);
		imagefilledrectangle($im, 160, 57, 249, 101, $white);

		imagettftext($im, 18, 0, 50, 87, $black, $FONT, $text1);
		imagettftext($im, 25, 0, 171, 90, $black, $FONT, $text2);		
	}
	elseif(strlen($text1) > 7)
	{
		imagefilledrectangle($im, 161, 55, 254, 103, $black);
		imagefilledrectangle($im, 163, 57, 252, 101, $white);

		imagettftext($im, 18, 0, 46, 87, $black, $FONT, $text1);
		imagettftext($im, 25, 0, 172, 90, $black, $FONT, $text2);	
	}


	if(imagejpeg($im, 'IMG/main.jpg') == TRUE)
	{
		imagedestroy($im);
		return true;			
	}
	else
	{
		imagedestroy($im);
		return false;
	}
}

?>
