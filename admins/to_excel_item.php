<?header('Content-Type: application/xls');
header('Content-Disposition: attachment; filename=items_1.xls');
include("connect.phtml");
    $output = '';
    if(isset($_POST["export"]))
    {
     $result = mysqli_query($connection,"SELECT * from items,categories,themes WHERE items.id_cat=categories.id_cat and themes.id_theme=items.id_theme") or die("Упс1!");

     if(mysqli_num_rows($result) > 0)
     {
      $output .= '
       <table class="table" bordered="1">  
       <tr>  
       <th>ID</th>  
       <th>Название</th>  
       <th>Тема</th>  
       <th>Категория</th>
       <th>Цена</th>
       <th>Описание</th>
       <th>Вес</th>
       <th>Размер</th>
       <th>Изображение</th>
</tr>
      ';
      while($row = mysqli_fetch_array($result))
      {
       $output .= '
                <tr>  
                                <td>'.$row["id_item"].'</td>  
                                <td>'.$row["name_item"].'</td>  
                                <td>'.$row["name_theme"].'</td>  
                                <td>'.$row["name_cat"].'</td>  
                                <td>'.$row["price"].'</td>
                                <td>'.$row["description"].'</td>  
                                <td>'.$row["weight"].'</td>  
                                <td>'.$row["size"].'</td>
                                <td>'.$row["image"].'</td>
                        </tr>
       ';
      }
      $output .= '</table>';
      echo $output;
     }
    }
    ?>