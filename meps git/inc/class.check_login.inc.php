<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class check_login
{
    public static function check($LEVEL){
        
    if (isset($_COOKIE["nickmeps"])) 
{
    $tr = $_COOKIE["nickmeps"];
    //  echo "TR --> [".$tr."]<br>";
    $link = pg_connect("hostaddr=127.0.0.1 port=5432 dbname=work user=postgres ");
    $encoding = pg_client_encoding($link);
    pg_set_client_encoding($link, "Utf8");
    if (!$link) {
        echo"DB error";
        exit();
    }
    $abc = pg_query("SELECT nick,name,lvl FROM produce.users WHERE nick='$tr'");
    //    echo"Nick --> [".$abc."]<br>";
    if (!$abc) 
    {
        header("Location: https://meps.ph/custom-php"); // ник есть в броузере, но отсутствует в базе, возврат на ввод пароля
    }
} 
else 
{
    header("Location: https://meps.ph/custom-php"); // ник не установлен в браузере, возврат на ввод пароля
    //echo"ISSET EMPTY --> [".$iss."]<br>";
}
    $nick_ar=  pg_fetch_array($abc);
    $lvl=$nick_ar['lvl'];
    if ($lvl>$LEVEL) {
        //echo "Wrong LVL!!!"; 
        header("Location: https://meps.ph/custom-php");
        exit;}
       
    $user=$nick_ar['name'];
    $nick_name=$nick_ar['nick'];
    echo("USERNAME: [".$user."]; Person Security Level: [".$lvl."]; ");
    echo("Application Security Level: [".$LEVEL."]<br>");

}}
?>