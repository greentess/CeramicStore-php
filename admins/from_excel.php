<? include("admin_header.phtml"); ?>

<head>
 <link href="css/new_item.css" rel="stylesheet">
 <link href="css/del_item1.css" rel="stylesheet">
</head>
<?
include("connect.phtml");
$tab = $_GET["tab"];

if ($tab == 5) {
 $rash = end(explode(".", $_FILES["excel"]["name"]));
 $excel_rash = array("xls", "xlsx");
 if (in_array($rash, $excel_rash)) {
  $file = $_FILES["excel"]["tmp_name"];
  include("PHPExcel/Classes/PHPExcel/IOFactory.php");
  $ob = PHPExcel_IOFactory::load($file);

  foreach ($ob->getWorksheetIterator() as $worksheet) {
   $highestRow = $worksheet->getHighestRow();
   for ($row = 2; $row <= $highestRow; $row++) {
    mysqli_set_charset($connection, 'utf8');
    $id_customer = mysqli_real_escape_string($connection, $worksheet->getCellByColumnAndRow(0, $row)->getValue());
    $fam = mysqli_real_escape_string($connection, $worksheet->getCellByColumnAndRow(1, $row)->getValue());
    $im = mysqli_real_escape_string($connection, $worksheet->getCellByColumnAndRow(2, $row)->getValue());
    $addr = mysqli_real_escape_string($connection, $worksheet->getCellByColumnAndRow(3, $row)->getValue());
    $phone = mysqli_real_escape_string($connection, $worksheet->getCellByColumnAndRow(4, $row)->getValue());
    $mail = mysqli_real_escape_string($connection, $worksheet->getCellByColumnAndRow(5, $row)->getValue());
    $login = mysqli_real_escape_string($connection, $worksheet->getCellByColumnAndRow(6, $row)->getValue());
    $pass = mysqli_real_escape_string($connection, $worksheet->getCellByColumnAndRow(7, $row)->getValue());
    $subscribe = mysqli_real_escape_string($connection, $worksheet->getCellByColumnAndRow(8, $row)->getValue());
    $query = "INSERT INTO customers(fam, im,addr,phone,mail,login,pass,subscribe) VALUES ('" . $fam . "', '" . $im . "', '" . $addr . "', '" . $phone . "', '" . $mail . "', '" . $login . "', '" . $pass . "', '" . $subscribe . "')";
    mysqli_query($connection, $query);
   }
  }
 } else {
  $output = '<label class="text-danger">Файл не выбран</label>'; //if non excel file then
 }
 //}
?>
 <div style='width:100%;height:76.2%; background-color:white;'>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <div class='subdiv'>
   <div class='aftermes'>
    <center>Данные из файла были успешно загружены в базу!</center><br>
    <a href='admin_index.phtml?type=7' style="margin-left:34%;">Вернуться к списку покупателей</a>
   </div>
  </div>
 </div>
<? }

if ($tab == 2) {
 $rash = end(explode(".", $_FILES["excel"]["name"]));
 $excel_rash = array("xls", "xlsx");
 if (in_array($rash, $excel_rash)) {
  $file = $_FILES["excel"]["tmp_name"];
  include("PHPExcel/Classes/PHPExcel/IOFactory.php");
  $ob = PHPExcel_IOFactory::load($file);
  foreach ($ob->getWorksheetIterator() as $worksheet) {
   $highestRow = $worksheet->getHighestRow();
   for ($row = 2; $row <= $highestRow; $row++) {
    mysqli_set_charset($connection, 'utf8');
    $id_item = mysqli_real_escape_string($connection, $worksheet->getCellByColumnAndRow(0, $row)->getValue());
    $name_item = mysqli_real_escape_string($connection, $worksheet->getCellByColumnAndRow(1, $row)->getValue());
    $id_theme = mysqli_real_escape_string($connection, $worksheet->getCellByColumnAndRow(2, $row)->getValue());
    $id_cat = mysqli_real_escape_string($connection, $worksheet->getCellByColumnAndRow(3, $row)->getValue());
    $price = mysqli_real_escape_string($connection, $worksheet->getCellByColumnAndRow(4, $row)->getValue());
    $description = mysqli_real_escape_string($connection, $worksheet->getCellByColumnAndRow(5, $row)->getValue());
    $weight = mysqli_real_escape_string($connection, $worksheet->getCellByColumnAndRow(6, $row)->getValue());
    $size = mysqli_real_escape_string($connection, $worksheet->getCellByColumnAndRow(7, $row)->getValue());
    $image = mysqli_real_escape_string($connection, $worksheet->getCellByColumnAndRow(8, $row)->getValue());
    $query = "INSERT INTO items(image, name_item,id_theme,id_cat,price,description,weight,size) VALUES ('" . $image . "', '" . $name_item . "', '" . $id_theme . "', '" . $id_cat . "', '" . $price . "', '" . $description . "', '" . $weight . "', '" . $size . "')";
    mysqli_query($connection, $query);
   }
  }
 } else {
  $output = '<label class="text-danger">Файл не выбран</label>';
 }
 //}
?>
 <div style='width:100%;height:76.2%; background-color:white;'>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <div class='subdiv'>
   <div class='aftermes'>
    <center>Данные из файла были успешно загружены в базу!</center><br>
    <a href='admin_index.phtml?type=3' style="margin-left:34%;">Вернуться к списку товаров</a>
   </div>
  </div>
 </div>
<? }


?>
<? include("admin_footer.phtml"); ?>
