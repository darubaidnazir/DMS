<?php
$check = $this->conn->prepare("SELECT * FROM `semester` WHERE semesterid = ?");
$check->bindParam(1, $getsemesterid);
$check->execute();
$checkcountsemester = $check->rowCount();