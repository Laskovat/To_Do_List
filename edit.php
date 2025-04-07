<?php
require_once 'inc/header.php';
if ($request->checkget('id') && $request->checkget('submit')) {
    $id = $request->get("id");
} else {

    $request->redirect("../index.php");
    $session->set("error", ["note 8 not found"]);
}


?>

<body class="container w-50 mt-5">
    <form action="handle/edit.php" method="post">
        <textarea type="text" class="form-control" name="title" id="" placeholder=#><?php 
                $runquery =  $conn->query("select title from notes where id = $id");
                $check = $runquery->execute();
                if ($check && $runquery->rowcount() > 0) {
                    $title = $runquery->fetch();
                    echo trim($title['title']);
                }
            ?></textarea>
        <div class="text-center">
        

            <input type="hidden" name="id" value="<?php echo $id ?>">
            <button type="submit" name="submit" class="form-control text-white bg-info mt-3 ">Update</button>
        </div>
    </form>
</body>

</html>