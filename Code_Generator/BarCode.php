<?php
function CreateBarCode($text)
{
	$code = 'code128';
	$t = '100';
	$r = '1';
	$f = '1';
	$a1 = 'A';
	$o = '1';

	if(isset($text))
	{
		require_once('class/index.php');
		require_once('class/FColor.php');
		require_once('class/BarCode.php');
		require_once('class/FDrawing.php');
		
		if(include_once('class/code128_barcode.php'))
		{
			$color_black = new FColor(0,0,0);
			$color_white = new FColor(255,255,255);

			$code_generated = new $code(
				$t,
				$color_black,
				$color_white,
				$r,
				$text,
				$f,
				$a1);

			$drawing = new FDrawing(2000,2000,'',$color_white);
			$drawing->init();
			$drawing->add_barcode($code_generated);
			$drawing->draw_all();
			$im = $drawing->get_im();

			$im2 = imagecreate(
				$code_generated->lastX,
				$code_generated->lastY);

			imagecopyresized($im2, 
				$im, 
				0, 0, 0, 0, 
				$code_generated->lastX, 
				$code_generated->lastY, 
				$code_generated->lastX, 
				$code_generated->lastY);

			if(imagejpeg($im2, 'IMG/BC.jpg')) 
			{
				imagedestroy($im2);
				return TRUE;
			}
			else 
			{
				imagedestroy($im2);
				return FALSE;
			}
		}
		else
			return FALSE;
	}
	else
		return FALSE;
}
?>