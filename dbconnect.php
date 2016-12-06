<?php

  $DBhost = "http://serwer1699424.home.pl";
  $DBuser = "21754815_zad1";
  $DBpass = "xx";
  $DBname = "21754815_zad1";
  
  $DBcon = new MySQLi($DBhost,$DBuser,$DBpass,$DBname);
    
     if ($DBcon->connect_errno) {
         die("ERROR : -> ".$DBcon->connect_error);
     }