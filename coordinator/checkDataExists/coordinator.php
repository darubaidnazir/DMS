<?php
$check =  $this->conn->prepare("SELECT * FROM `coordinator` WHERE `coordinatorid` = ?");
$check->bindParam(1, $getCoordinatorid);
$check->execute();
$countCoordinator = $check->rowCount();