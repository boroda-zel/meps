<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class DBconnect
{
    public static function connect()
    {
    $link = pg_connect("hostaddr=127.0.0.1 port=5432 dbname=work user=postgres ");
    $encoding = pg_client_encoding($link);
    pg_set_client_encoding($link, "Utf8");
    if (!$link)
    {
     echo"DB error";
     exit();
    }}
}