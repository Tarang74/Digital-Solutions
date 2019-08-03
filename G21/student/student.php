<?php
session_start();
echo 'hello student';

echo '<a> All userID ='.$_SESSION['userID'].'name is '.$_SESSION['firstname'].' last name is '.$_SESSION['lastname'].'</a>';