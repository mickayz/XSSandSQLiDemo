<html>
<head>
	<link rel="stylesheet" type="text/css" href="winner.css">
</head>
<body>
<?php

$mysqlcon = mysql_connect("localhost", "demo" ,"demo") or die(mysql_error());
mysql_select_db("demo") or die(mysql_error());


if(isset($_COOKIE["token"])){
  $querycookie = mysql_query("SELECT * from auth;");
  while( $row = mysql_fetch_array($querycookie)){
    $savedcookie = $row["cookie"];
    $curuser = $row["user"];
    $lang = "en";
    if(isset($_REQUEST["language"])){$lang=$_REQUEST["language"];}
    if($_COOKIE["token"] == $savedcookie){
      ?>
      <img src="win.jpg" alt="win" />
	<h1>WELCOME <?=$curuser?> </h1>
      <input type="hidden" name="language" value="<?=$lang?>" />
      <a href=demo1.php>Email</a> <br />
      <a href=demo1.php>Government Documents</a><br />
      <a href=demo1.php>Classified Information</a><br />
      <a href=demo1.php>AT&amp;T Customer Database</a>
      <?php
      die("</body></html>");
    }
  }
  header("Location: demo1.php");
}
else{
  header("Location: demo1.php");
}
?>
</body>
</html>
