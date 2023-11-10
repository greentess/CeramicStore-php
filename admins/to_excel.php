<?header('Content-Type: application/xls');
header('Content-Disposition: attachment; filename=customers_1.xls');
include("connect.phtml");
    $output = '';
    if(isset($_POST["export"]))
    {
     $query = "SELECT * FROM customers";
     $result = mysqli_query($connection, $query);
     if(mysqli_num_rows($result) > 0)
     {
      $output .= '
       <table class="table" bordered="1">  
                        <tr>  
                        <th>ID</th>  
                        <th>Фамилия</th>  
                        <th>Имя</th>  
                        <th>Адрес</th>
                        <th>Телефон</th>
                        <th>Почта</th>
                        <th>Логин</th>
                        <th>Пароль</th>
                        <th>Подписка</th>
                        </tr>
      ';
      while($row = mysqli_fetch_array($result))
      {
       $output .= '
                <tr>  
                                <td>'.$row["id_customer"].'</td>  
                                <td>'.$row["fam"].'</td>  
                                <td>'.$row["im"].'</td>  
                                <td>'.$row["addr"].'</td>  
                                <td>'.$row["phone"].'</td>
                                <td>'.$row["mail"].'</td>  
                                <td>'.$row["login"].'</td>  
                                <td>'.$row["pass"].'</td>
                                <td>'.$row["subscribe"].'</td>
                        </tr>
       ';
      }
      $output .= '</table>';
      echo $output;
     }
    }
    ?>