<?php
session_start();
if(isset($_COOKIE["Usuario"]) && isset($_COOKIE["Password"]) && isset($_COOKIE["Email"])){
    echo "Usuario logado: <br> <ul><li>Name: ".$_COOKIE["Usuario"]. "</li>";
    echo "<li>Mail: ".$_COOKIE["Email"]. "</li>";
    echo "<li>Pass: ".$_COOKIE["Password"]."</li></ul>";
}else if(isset($_SESSION["Usuario"]) && isset($_SESSION["Password"]) && isset($_SESSION["Email"])){
    echo "Usuario logado: <br> <ul><li>Name: ".$_SESSION["Usuario"]. "</li>";
    echo "<li>Mail: ".$_SESSION["Email"]. "</li>";
    echo "<li>Pass: ".$_SESSION["Password"]."</li></ul>";
}else{
    header("Location:index.php");
}


