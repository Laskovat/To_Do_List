<?php
require_once '../inc/connection.php';
require_once '../App.php';
if ($request->checkPost('id') && $request->checkPost('demote')) {
    $id = $request->post("id");
    $runquery = $conn->prepare("select status from notes where id=:id");
    $runquery->bindParam(":id",$id,PDO::PARAM_INT);
    $check = $runquery->execute();
    if ($check && $runquery->rowCount()==1) {
        $note = $runquery->fetch(PDO::FETCH_ASSOC);
        // echo "<pre>";
        // var_dump($note);
        // die;
        $statu = $note['status'];
        if ($statu == "doing"){
    $runquery = $conn->prepare("update notes set `status`='todo' where id=:id");
    $runquery->bindParam(":id",$id,PDO::PARAM_INT);
    if ($runquery->execute()) {
        $session->set("success","note updated successfuly");
        $request->redirect("../index.php");
    }else {
        $request->redirect("../index.php");
        $session->set("error",["error while update"]);
    }
        } if ($statu == "done"){
            $runquery = $conn->prepare("update notes set `status`='doing' where id=:id");
            $runquery->bindParam(":id",$id,PDO::PARAM_INT);
            if ($runquery->execute()) {
                $session->set("success","note updated successfuly");
                $request->redirect("../index.php");
            }else {
                $request->redirect("../index.php");
                $session->set("error",["error while update"]);
            }
                }


    }else {
        $request->redirect("../index.php");
        $session->set("error",["note 5 not found"]);
    }
}else {
$request->redirect("../index.php");
$session->set("error",["note 77 not found"]);
}
