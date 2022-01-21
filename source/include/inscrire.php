<?php include_once 'db.php';


$nom =  isset($_POST['nom']) ? $_POST['nom'] : NULL;
$mail = isset($_POST['mail']) ? $_POST['mail'] : NULL;
$mdp1 = isset($_POST['mdp1']) ? $_POST['mdp1'] : NULL;
$mdp2 = isset($_POST['mdp2']) ? $_POST['mdp2'] : NULL;


if(isset($_POST['inscrire']))
{
    $sql = "INSERT INTO  login(nom,mdp,email) values ('$nom','$mdp2','$mail') ;";
    mysqli_query($con,$sql);
    sleep(3);
    header('Location: ../log.php');


}
?>