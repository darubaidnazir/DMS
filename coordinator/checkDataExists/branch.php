<?php
$check =  $this->conn->prepare("SELECT * FROM `branch` WHERE `branchid` = ?");
$check->bindParam(1, $getBranchid);
$check->execute();
$countBranch = $check->rowCount();