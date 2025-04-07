<?php
require_once '../inc/connection.php';
require_once '../App.php';
// check of submit 
if ($request->checkPost('submit') && $request->checkPost('id')){
    
    // fetch data
    $id = $request->post("id");
    $title = $request->post("title");
    // validation 
    $validation->less($title,"note is less than 3 chars");
    if(empty($validation->errors)){
        // update in db
        // $runquery = $conn->query("update notes set (`title`) values('$title')");
        // $runquery = $conn->query("update notes set `title` = '$title' where `id`='$id'");
        $runquery = $conn->prepare("update notes set `title` =:title where `id`=:id");
        $runquery->bindParam(":title",$title,PDO::PARAM_STR);
        $runquery->bindParam(":id",$id,PDO::PARAM_INT);
        $check = $runquery->execute();
        if($runquery){
            $request->redirect("../index.php");
            $session->set("success","updated successfuly");
        }else{    
            $request->redirect("../index.php");
            $session->set("error",["error while updating"]);}
            
        }else{
            $request->redirect("../index.php");
            $session->set("error",$validation->errors);
        }
    }else{
    $request->redirect("../index.php");
    $session->set("error",["it's not allowed"]);
}

