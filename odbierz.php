<?php
session_start();
include_once 'dbconnect.php';

if (!isset($_SESSION['userSession'])) {
 header("Location: index.php");
}

$query = $DBcon->query("SELECT * FROM z7_users WHERE user_id=".$_SESSION['userSession']); //pobranie danych o u¿ytkowniku aktualnie zalogowanym
$userRow=$query->fetch_array();

$user_file = $userRow['username'];
$user_dir = $_SESSION['username'];


$max_rozmiar = 100000;  //maksymalny rozmiar pliku
if (is_uploaded_file($_FILES['plik']['tmp_name']))  //odbieranie wys³anego pliku
{
if ($_FILES['plik']['size'] > $max_rozmiar) {echo "Przekroczenie rozmiaru $max_rozmiar"; }
else
{
echo 'Odebrano plik: '.$_FILES['plik']['name'].'<br/>';

if (isset($_FILES['plik']['type'])) {echo 'Typ: '.$_FILES['plik']['type'].'<br/>'; }
move_uploaded_file($_FILES['plik']['tmp_name'], "/php/z7/".$user_file."/".$_FILES['plik']['name']); //scie¿ka do katalogu u¿ytkownika
}
} else {
  $msg = "<div class='alert alert-danger'>
     <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Unknown Error!
    </div>";

} 



$DBcon->close();

?>



<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>

<div class="signin-form">

 <div class="container">
     
        
        <?php
  if(isset($msg)){ //wiadomoœæ gdy pojawi siê error
   echo $msg;
  }
  ?>
       <form class="form-signin" method="post" id="select-form">

      <hr />
<br>
<a href="home.php">BACK</a><br><br> <!--cofniêcie do strony home-->
<br>
<a href="logout.php?logout">Logout</a><br><br> <!--wylogowanie - usuniêcie sesji-->
      </form>

    </div>
    
</div>

</body>
</html>