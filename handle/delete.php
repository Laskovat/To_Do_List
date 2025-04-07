<?php
require_once '../inc/connection.php';
require_once '../App.php';

if ($request->checkget('id')){
    $id = $request->get("id");
    $runquery = $conn->prepare("select id from notes where id=:id");
    $runquery->bindParam(":id",$id,PDO::PARAM_INT);
    $runquery->execute();
    if ($runquery->rowCount()==1) {
    $runquery = $conn->prepare("delete from notes where id=:id");
    $runquery->bindParam(":id",$id,PDO::PARAM_INT);
    if ($runquery->execute()) {
        $session->set("success","note deleted successfuly");
        $request->redirect("../index.php");

       
    }else {
        $request->redirect("../index.php");
        $session->set("error",["error while delete"]);
    }
    }else {
        $request->redirect("../index.php");
        $session->set("error",["note 5 not found"]);
    }
}else {
$request->redirect("../index.php");
$session->set("error",["note 8 not found"]);
}
