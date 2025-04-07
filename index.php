<?php
require_once 'inc/header.php';
?>

<body>

    <div class="container my-3 ">
        <div class="row d-flex justify-content-center">

            <div class="container mb-5 d-flex justify-content-center">
                <div class="col-md-4">
                    <form action="handle/addToDo.php" method="post">
                        <textarea type="text" class="form-control" rows="3" name="title" id="" placeholder="enter your note here"></textarea>
                        <div class="text-center">
                            <button type="submit" name="submit" class="form-control text-white bg-info mt-3 ">Add To Do</button>
                        </div>
                    </form>
                </div>
            </div>


        </div>
        <?php
        if ($session->check("error")) {
            foreach ($session->get("error") as $error) { ?>
                <div class="alert alert-danger"><?php echo $error ?></div><?php

                                                                        }
                                                                        $session->unnset("error");
                                                                    } elseif ($session->check("success")) { ?>
            <div class="alert alert-success"><?php echo $session->get("success"); ?></div>
        <?php
                                                                        $session->unnset("success");
                                                                    }
        ?>
        <div class="row d-flex justify-content-between">

            <!-- all -->
            <div class="col-md-3 ">
                <h4 class="text-white">All Notes</h4>

                    
                <div class="m-2  py-3">
                    <div class="show-to-do">
                        <?php $runquery =  $conn->query("select * from notes where status = 'todo' order by created_at desc");
                        $check = $runquery->execute();
                        if ($check && $runquery->rowcount() > 0) {
                            $notestodo = $runquery->fetchAll();
                            foreach ($notestodo as $notetodo) {
                        ?>
                                <div class="alert alert-info p-2">
                                    <h4><?php echo $notetodo['title'] ?></h4>
                                    <h5><?php echo $notetodo['created_at'] ?></h5>
                                    <div style="display: flex; justify-content: space-between">
                                        <form action="edit.php?id=<?php echo $notetodo['id'] ?>" method="get">
                                            <input type="hidden" hidden name="id" value="<?php echo $notetodo['id'] ?>"></input>
                                            <button type="submit" class="btn btn-success p-1 text-white" name="submit">edit</button>
                                        </form>
                                        <form action="handle/goto.php" method="post">
                                            <input type="hidden" hidden name="id" value="<?php echo $notetodo['id'] ?>"></input>
                                            <button type="submit" class="btn btn-secondary p-1 text-white" name="promote">
                                                doing
                                            </button>
                                        </form>
                                    </div>
                                 
                                </div>

                            <?php }
                        } else { ?>

                            <div class="item">
                                <div class="alert alert-primary p-2">
                                        <h4> There ia no to do note yet </h4>
                                </div>
                            </div>
                        <?php } ?>

                    </div>
                </div>

            </div>

            <!-- doing -->
            <div class="col-md-3 ">

                <h4 class="text-white">Doing</h4>


                <div class="m-2 py-3">
                    <div class="show-to-do">
                        <?php $runquery =  $conn->query("select * from notes where status = 'doing'  order by created_at desc");
                        $check = $runquery->execute();
                        if ($check && $runquery->rowcount() > 0) {
                            $notesdoing = $runquery->fetchAll();
                            foreach ($notesdoing as $notedoing) {
                        ?>



                                <div class="alert alert-success p-2">
                                    <h4><?php echo $notedoing['title'] ?></h4>
                                    <h5><?php echo $notedoing['created_at'] ?></h5>
                                    <div class="d-flex justify-content-between ">

                                        
                                        <form action="handle/goback.php" method="post">
                                            <input type="hidden" hidden name="id" value="<?php echo $notedoing['id'] ?>"></input>
                                            <button type="submit" class="btn btn-success p-1 text-white " name="demote">back</button>
                                        </form>
                                        <form action="handle/goto.php" method="post">
                                            <input type="hidden" hidden name="id" value="<?php echo $notedoing['id'] ?>"></input>
                                            <button type="submit" class="btn btn-secondary p-1 text-white" name="promote">
                                                doing
                                            </button>
                                        </form>
                                    </div>

                                </div>
                            <?php }
                        } else { ?>
                            <div class="item">
                                
                                <div class="alert alert-primary p-2">
                                    <h4> There ia no doing note </h4>
                                </div>
                            </div>
                        <?php } ?>

                    </div>
                </div>

            </div>

            <!-- done -->
            <div class="col-md-3">
                <h4 class="text-white">Done</h4>

                <div class="m-2 py-3">
                    <div class="show-to-do">
                        <?php $runquery =  $conn->query("select * from notes where status = 'done'  order by created_at desc");
                        $check = $runquery->execute();
                        if ($check && $runquery->rowcount() > 0) {
                            $notesdone = $runquery->fetchAll();
                            foreach ($notesdone as $notedone) {
                        ?>

                                <div class="alert alert-warning p-2">
                                    <h4><?php echo $notedone['title'] ?></h4>
                                    <h5><?php echo $notedone['created_at'] ?></h5>

                                    <div style="display: flex; justify-content: space-between">
                                        <form action="handle/goback.php" method="post">
                                            <input type="hidden" hidden name="id" value="<?php echo $notedone['id'] ?>"></input>
                                            <button type="submit" class="btn btn-success p-1 text-white" name="demote">back</button>
                                        </form>
                                        <form action="handle/delete.php?id=<?php echo $notedone['id'] ?>" method="post">
                                            <button type="submit" class="btn btn-danger p-1 text-white" onclick="return confirm('هل أنت متأكد؟')">
                                                DELETE
                                            </button>
                                        </form>
                                    </div>



                                </div>
                            <?php }
                        } else { ?>
                            <div class="item">
                                <div class="alert alert-primary p-2">
                                    <h4> There ia no done note yet </h4>
                                </div>
                            </div>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>