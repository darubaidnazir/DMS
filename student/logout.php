<?php
session_start();
session_destroy();
$conn = null;
header("Location:../student/studentlogin.html");