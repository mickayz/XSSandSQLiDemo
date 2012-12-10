<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<h1> GOVERNMENT LOGIN - PORTAL 1 </h1>

<?php

$mysqlcon = mysql_connect("localhost", "demo" ,"demo") or die(mysql_error());
mysql_select_db("demo") or die(mysql_error());

    $user = $_REQUEST['user'];
    $escaped_user = mysql_real_escape_string($_REQUEST['user']);
    $pass = $_REQUEST['password'];
    $query ="SELECT * FROM auth WHERE user = '".$escaped_user."' and pass = '".$pass."';";
    $auth = mysql_query($query);
    if (mysql_num_rows($auth)>0){
      $newtoken = base64_encode(rand());
      setcookie("token", $newtoken, time()+600);
      mysql_query("UPDATE auth SET cookie='$newtoken' WHERE user = '$escaped_user';");
      header("Location: secure.php");
    } else {
    ?>
    <form action="demo1.php" method="post">
      <input type="text" name="user" value="<?=htmlspecialchars($user) ?>"> USER </input><br />
      <input type="password" name="password" value="<?=$pass?>"> PASSWORD </input> <br />
      <input class="button" type="submit" value="Submit" />
    </form>
    <?php
      if ($user!=""){
        echo("INCORRECT CREDENTIALS FOR <strong>".$user."</strong>");
      }
    }

  ?>
</body>
</html>
