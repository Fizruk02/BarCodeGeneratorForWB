<form method="post" enctype="multipart/form-data">
	<input type="file" name="filename">
	<input type="submit" name="send">
</form>
<?	
function CreateBC($code1, $code2)
{
	if(CreateBarCode($code1.$code2))
	{
		if(CreateFormNumber($code1, $code2))
		{
			if(CreateСheque("cheques/".$code1.$code2.".jpg", "cheques/".$code1.$code2))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	else
	{
		return false;
	}
}

if ($_FILES && $_FILES["filename"]["error"] == UPLOAD_ERR_OK)
{
    $name = "upload/" . $_FILES["filename"]["name"];
    if(move_uploaded_file($_FILES["filename"]["tmp_name"], $name))
    	echo "Файл загружен<br>";
}

if(isset($name) and $name!=NULL)
{
	$name = __DIR__."/".$name;
	require_once("BarCode.php");
	require_once("Number.php");
	require_once("Copy.php");
	include_once("ExcelReader/simplexlsx.class.php");

	$xlsx = new SimpleXLSX($name);
	$sheet = $xlsx->rows(1);

	$zip = new ZipArchive();

	ini_set("date.timezone","Europe/Moscow");		
	$date = date("Y-m-d_H-i-s");
	$Archive = $date.".zip";

	if ($zip->open($Archive, ZipArchive::CREATE) !== true)
		die("Ошибка в создании архива!");


	foreach ($sheet as $row) 
	{
	    $row = $row[0];
	    $code1 = substr($row, 0, 7);
	    $code2 = substr($row, 7, 11);
	 
	    if(CreateBC($code1, $code2))
	    {
	    	$file = __DIR__."/IMG/cheques/".$code1.$code2.".jpg";	
	   		$zip->addFile($file);
	    }

	}
	$zip->close();
	?>
		<a href="<?=$Archive?>" download>Скачать</a>
	<?
}

