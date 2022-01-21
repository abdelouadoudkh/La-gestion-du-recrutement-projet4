<?php  include_once 'include/db.php';

/*$deleteID =  $_POST['deleteID'];
$query_update= "UPDATE inscription SET favorite='1' WHERE id_candidat=$deleteID";
mysqli_query($con,$query_update);
*/

$id=$_POST['id'];
$id_fav=$_POST['id_fav'];

$check=mysqli_query($con,"SELECT * FROM inscription where id_candidat=".$id);
$check1=mysqli_query($con,"SELECT * FROM inscription where id_candidat=".$id_fav);


$total = mysqli_num_rows($check);
$total1 = mysqli_num_rows($check1);

if($total>0){
    $query="UPDATE  inscription set favori=1 WHERE id_candidat=".$id;
    mysqli_query($con,$query);
}

if($total1>0){
    $query1="UPDATE  inscription set favori=0 WHERE id_candidat=".$id_fav;
    mysqli_query($con,$query1);
}







?>