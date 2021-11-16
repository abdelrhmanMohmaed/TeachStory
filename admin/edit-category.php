<?php

use TechStory\Classes\Models\Cat;

include('inc/header.php') ?>
<?php
if ($request->getHas('id')) {
    $id = $request->get('id');
} else {
    $id = 1;
}
$c = new Cat;
$cats = $c->selectId($id, "name");

?>

<div class="container py-5">
    <div class="row">

        <div class="col-md-6 offset-md-3">
            <h3 class="mb-3">Edit Category : <?= $cats['name']; ?></h3>
            <div class="card">
                <div class="card-body p-5">

                    <?php include(APATH . "inc/errors.php") ?>
                    <?php include(APATH . "inc/success.php"); ?>
                    <form method="POST" action="<?= AURL . "handlers/edit-category.php?id=" . $id ?>">
                        <input type="hidden" name="id" value="<?= $id ?>">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value=" <?= $cats['name']; ?>">
                        </div>
                        <div class="text-center mt-5">
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                            <a class="btn btn-dark" href="<?= AURL . "categories.php" ?>">Back</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>
</div>
<?php include('inc/footer.php') ?>