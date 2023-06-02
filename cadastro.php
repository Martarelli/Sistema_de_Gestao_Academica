<?php

require_once('connection.php');
$login = $_POST['login'];
$password = MD5($_POST['password']);

$db = mysql_select_db('faculdade');
$mysql_query = "SELECT login FROM usuario WHERE login = '$login'";
$select = $conn->query($mysql_query);
$data = mysql_fetch_array($select);

mysqli_close($conn);


if($login == "" || $login == null)
{
  echo"<script language='javascript' type='text/javascript'>
  alert('O campo login deve ser preenchido');</script>";

  header("Location: index.php");
}else{
  if($data['login'] == $login && password_verify($password, $data['password'])){
      session_start();
      $_SESSION['loggedin'] = true;
      $_SESSION['id'] = $data['id'];
      $_SESSION['username'] = $username;
      header("Location: dashboard.php");
  }
}
 
?>