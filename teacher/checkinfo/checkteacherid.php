<?php
$check = $this->conn->prepare("SELECT * FROM `teacher` WHERE `teacherid` = ?");
$check->bindParam(1, $getteacherid);
$check->execute();
$checkcountteacher = $check->rowCount();