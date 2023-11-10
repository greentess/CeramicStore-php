<?
$id_basket=$_COOKIE['id_basket'];  
$id_item=$_GET['id_item'];
$type=$_GET['type'];

$link = mysqli_connect("localhost","root","");
mysqli_set_charset($link, 'mb4');
mysqli_select_db($link,"ceramic");

function debug_to_console($data) {
 $output = $data;
 if (is_array($output))
     $output = implode(',', $output);

 echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}
debug_to_console("$id_basket");

debug_to_console("$id_item");
if($type==1) // �������� ����� � �������
	{
		$strSQL = "SELECT * FROM basket_items WHERE id_item=".$id_item." AND id_basket='".$id_basket."'";
		$result=mysqli_query($link,$strSQL) or die("Что-то не так1!");
		if ($row=mysqli_fetch_array($result))
		{
			$strSQL="UPDATE basket_items SET kolvo=kolvo+1 WHERE id_item=".$id_item." AND id_basket='".$id_basket."'";
		}
		else
		{
			$strSQL="INSERT INTO basket_items(id_basket, id_item, kolvo) VALUES ('".$id_basket."',".$id_item.",1)";
		}
		mysqli_query($link,$strSQL);
	}
//else 
if($type==2) // ��������� ����������
	{
		$strSQL="SELECT * FROM basket_items WHERE id_item=".$id_item." AND id_basket='".$id_basket."'";
		$result=mysqli_query($link,$strSQL) or die("�� ���� ��������� ������2!"); 
		if ($row=mysqli_fetch_array($result))
			{
				if ($row["kolvo"]>1)
					{
						$strSQL="UPDATE basket_items SET kolvo=kolvo-1 WHERE id_item=".$id_item." AND id_basket='".$id_basket."'";
					}
				else
					{
						$strSQL="DELETE FROM basket_items WHERE id_item=".$id_item." AND id_basket='".$id_basket."'";
					}
            }
	mysqli_query($link,$strSQL);
	}
//else
if($type==3) // ������� �� �������
	{
		$strSQL="DELETE FROM basket_items WHERE id_item=".$id_item." AND id_basket='".$id_basket."'";
		mysqli_query($link,$strSQL);
	}
//else
if($type==4) // �������� �������
	{
		$strSQL="DELETE FROM basket_items WHERE id_basket='".$id_basket."'";
		mysqli_query($link,$strSQL);
	}
include("basket.phtml");
?>
