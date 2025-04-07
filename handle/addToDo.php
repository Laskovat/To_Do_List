<?php
require_once '../inc/connection.php';
require_once '../App.php';
// check of submit 
if ($request->checkPost('submit')){
    // fetch data
    $title = $request->post("title"); 
    // validation 
    $validation->notempty($title,"note is required");
    $validation->less($title,"note is less than 3 chars");
    if(empty($validation->errors)){
        // insert in db
        // $runquery = $conn->query("insert into notes (`title`) values('$title')");
    $runquery = $conn->prepare("insert into notes (`title`) values(:title)");
    $runquery->bindParam(":title",$title,PDO::PARAM_STR);
    if($runquery->execute()){
        $request->redirect("../index.php");
        $session->set("success","inserted successfuly");
    }else{    
        $request->redirect("../index.php");
        $session->set("error",["error while inserting"]);}

    }else{
        $request->redirect("../index.php");
        $session->set("error",$validation->errors);
    }
}else{
    $request->redirect("../index.php");
    $session->set("error",["it's not allowed"]);
}

