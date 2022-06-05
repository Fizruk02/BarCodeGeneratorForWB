<?
function set_dpi($jpg, $temp)
{
    $fr = fopen($jpg, 'rb');
    $fw = fopen($temp.".temp", 'wb');
    stream_set_write_buffer($fw, 0);
    fwrite($fw, fread($fr, 13) . chr(1) . chr(0) . chr(132) . chr(0) . chr(135));
    fseek($fr, 18);
    stream_copy_to_stream($fr, $fw);
    fclose($fr);
    fclose($fw);
    unlink($jpg);
    rename($temp.".temp", $jpg);
}

function CreateСheque($file, $temp)
{
	$size = getimagesize('IMG/BC.jpg');
	$new = imagecreatefromjpeg('IMG/BC.jpg');
	$trueColor = imagecreatetruecolor(200, 150);
	imagecopyresampled($trueColor, $new, 0, 0, 0, 0, 200, 150, $size[0], $size[1]);
	imagejpeg($trueColor, 'IMG/BC.jpg', 100);
	imagedestroy($new);

	$dest = imagecreatefromjpeg('IMG/main.jpg');
	$src = imagecreatefromjpeg('IMG/BC.jpg');

	$size1 = getimagesize('IMG/BC.jpg');
	$w1 = $size1[0];
	$h1 = $size1[1];

	$size2 = getimagesize('IMG/main.jpg');
	$w2 = $size2[0];

	$w = ($w2 - $w1) / 2;

	imagecopy($dest, $src, $w, 120, 0, 0, $w1, $h1);

	if(imagejpeg($dest, "IMG/".$file) == TRUE)
	{
		imagedestroy($dest);
		imagedestroy($src);
		set_dpi("IMG/".$file, "IMG/".$temp);
		return true;		
	}
	else
	{
		imagedestroy($dest);
		imagedestroy($src);	
		return false;			
	}
}
