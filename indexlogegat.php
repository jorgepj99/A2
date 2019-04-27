<?php
session_start();
try{
    if(isset($_COOKIE["Usuario"]) && isset($_COOKIE["Password"]) && isset($_COOKIE["Email"])){
        if(isset($_POST["botones"])){
            if($_POST["botones"]=="Entrar"){
                header("Location:home.php");
            }
            if($_POST["botones"]=="Volver"){
                setcookie("Usuario",null,time()-60,"/","jpablo.cesnuria.com");
                setcookie("Password",null,time()-60,"/","jpablo.cesnuria.com");
                setcookie("Email",null,time()-60,"/","jpablo.cesnuria.com");
                session_destroy();
                header("Location:index.php");
            }
        }
    }else if(isset($_SESSION["Usuario"]) && isset($_SESSION["Password"]) && isset($_SESSION["Email"])){
        if(isset($_COOKIE[$_SESSION["Usuario"].'_Ultimo_Acceso'])){
            $user=$_COOKIE[$_SESSION["Usuario"].'_Ultimo_Acceso'];
            echo 'Ultimo acceso: '.date('H:i:s',$user).' del '.date('d-m-Y',$user);
        }else{
            echo 'Este es el primer acceso del usuario';
        }
        
        if(isset($_POST["botones"])){
            if($_POST["botones"]=="Entrar"){
                header("Location:home.php");
            }
            if($_POST["botones"]=="Volver"){
                setcookie("Usuario",null,time()-60,"/","jpablo.cesnuria.com");
                setcookie("Password",null,time()-60,"/","jpablo.cesnuria.com");
                setcookie("Email",null,time()-60,"/","jpablo.cesnuria.com");
                setcookie($_SESSION["Usuario"]."_Ultimo_Acceso",time(),time()+3600,"/","jpablo.cesnuria.com");
                session_destroy();
                $_SESSION['last_access']=time();
                header("Location:index.php");
            }
        }
    }else{
        echo "Error en el inicio de sesion";
        setcookie("Usuario",null,time()-60,"/","jpablo.cesnuria.com");
        setcookie("Password",null,time()-60,"/","jpablo.cesnuria.com");
        setcookie("Email",null,time()-60,"/","jpablo.cesnuria.com");
        header("Location:index.php");
    }
}catch(Exception $e){
    echo 'Type Error:'.$e;
}
?>
<html>
    <head>
        <title>Logeado</title> 
    </head>
    <body>
        <?php 
            if(isset($_COOKIE['Usuario'])) echo "<h1>Bienvenido, ".$_COOKIE['Usuario']."</h1>";
            if(isset($_SESSION['Usuario'])) echo "<h1>Bienvenido, ".$_SESSION['Usuario']."</h1>";
        ?>
      <form action="<?= $SERVER['PHP_SELF'];?>" method="post">
          <input type="radio" value="Entrar" name="botones" />Entrar<br>
          <input type="radio" name="botones" value="Volver" />Volver<br>
          <input type="submit" value="Cargar" />
       </form>
    </body>
</html>

