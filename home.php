<?php
session_start();
include_once 'dbconnect.php';

if (!isset($_SESSION['userSession'])) {
 header("Location: index.php");
}

$query = $DBcon->query("SELECT * FROM z7_users WHERE user_id=".$_SESSION['userSession']);
$userRow=$query->fetch_array();

$user_file = $userRow['username'];

if (isset($_POST['send'])) {



}

// �cie�ka do plik�w w folderze u�ytkownika
$dir = $user_file;

// wylistowanie plik�w
$files = scandir($dir);

//ukrycie niepotrzebnych wynik�w
$hideName = array('.','..','.DS_Store'); 

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
     
        
<form action="odbierz.php" method="POST" ENCTYPE="multipart/form-data"> 
<input type="file" name="plik"/> 
<input type="submit" value="SEND"/><br> 
      </form>
<br>
<br>


<table id="table1" border="1" onclick="handleClick(event);"><tr><th>NAZWA PLIKU</th><th>POBIERANIE</th></tr>
<?php
foreach($files as $filename) {
    if(!in_array($filename, $hideName)){
       //nazwa pliku
       echo "<tr><td>$filename</td><td>
<a href='$user_file/$filename' download>Download</a>
				</td></tr>"; 
    }
} 
?>
</table>
<br>
<a href="logout.php?logout">Logout</a><br><br>


    </div>
    
</div>

</body>
</html>