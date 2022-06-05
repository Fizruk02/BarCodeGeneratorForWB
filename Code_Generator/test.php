<pre>
<?

include("ExcelReader/simplexlsx.class.php");


$xlsx = new SimpleXLSX(__DIR__ . '/test.xlsx');
$sheet = $xlsx->rows(1);
 
foreach ($sheet as $row) 
{
   $row = $row[0];
   echo $row."<br>";
}

?>