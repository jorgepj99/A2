<?php
session_start();
try{

    $datos=(array)json_decode(file_get_contents('Users.json'));

    if(isset($_POST['contra']) && isset($_POST['email']))
         {
        $email=htmlspecialchars($_POST['email']);
        $contra=htmlspecialchars($_POST['contra']);
            foreach ($datos as $dato)
                {
                if($dato->email ==$email && $dato->contra ==$contra)                                            
                    {
                        if(isset($_POST['check'])){
                            $_SESSION["Usuario"]=$dato->name;
                            $_SESSION["Password"]=$dato->contra;
                            $_SESSION["Email"]=$dato->email;
                        }else{
                            setcookie("Usuario", $dato->name,time()+3600,"/","jpablo.cesnuria.com");
                            setcookie("Password",$dato->contra,time()+3600,"/","jpablo.cesnuria.com");
                            setcookie("Email",$dato->email,time()+3600,"/","jpablo.cesnuria.com");
                        }
                        header('Location:indexlogegat.php'); 
                    }
                }
          }
       
}catch(Exception $e){
  echo 'Type Error:'.$e;
}
try{
$cmail=htmlspecialchars($_COOKIE["Email"]);
$cpass=htmlspecialchars($_COOKIE["Password"]);
$cdatos=(array)json_decode(file_get_contents('Users.json'));
foreach ($cdatos as $cdato)
    {
    if($cdato->email ==$cmail && $cdato->contra ==$cpass)                                            
        {
          header('Location:indexlogegat.php');         
        }
    }
}catch(Exception $e){
  echo 'Type Error:'.$e;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>login</title>
    </head>
    <body>
       
        <h1>Login</h1></br>
 <form action="<?= $SERVER['PHP_SELF'];?>" method="post">
       
       <p>Email: <input type="text" name="email"></p>
       <p>Password: <input type="password" name="contra"></p>
      <input type="checkbox" name="check" /> Recordar Contraseña<br>
      <br> <input type="submit" name="enviar" value="enviar">
     </form>
    </body>
</html>

