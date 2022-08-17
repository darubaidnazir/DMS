<?php
$check =  $this->conn->prepare("SELECT * FROM `batch` WHERE `batchid` = ?");
    $check->bindParam(1, $getBatchid);
    $check->execute();
    $countBatch = $check->rowCount();
    