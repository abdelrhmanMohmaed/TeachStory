<?php include('inc/header.php') ?>
<?php

use TechStory\Classes\Models\Cat;
use TechStory\Classes\Models\Product;

if ($request->getHas('id')) {
    $id = $request->get('id');
} else {
    $id = 1;
}
$c = new Cat;
$cats = $c->selectAll("id,name");


$pr = new Product;
$prod = $pr->selectId($id, 'products.name AS prodName , cats.name AS catName, cat_id, img,
pieces_on, price,`desc`');

?>
<div class="container py-5">
    <div class="row">

        <div class="col-md-6 offset-md-3">
            <h3 class="mb-3">Edit Product : <?= $prod['prodName'] ?></h3>
            <div class="card">
                <div class="card-body p-5">
                    <?php include("inc/errors.php") ?>
                    <?php include("inc/success.php") ?>
                    <form method="POST" action="<?= AURL . "handlers/edit-product.php"  ?>" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $id ?>">

                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" value="<?= $prod['prodName'] ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            <select class="form-control" name="cat_id">
                                <?php foreach ($cats as $cat) : ?>
                                    <option value="<?= $cat["id"] ?>" <?php if ($cat['id'] == $prod['cat_id']) {
                                                                            echo "selected";
                                                                         } ?>><?= $cat["name"] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>


                        <div class="form-group">
                            <label>Price</label>
                            <input type="number" name="price" value="<?= $prod['price'] ?>" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Pieces</label>
                            <input type="number" name="pieces_no" value="<?= $prod['pieces_on']; ?>" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="desc" rows="3"><?= $prod['desc'] ?></textarea>
                        </div>
                        <div class="d-flex justify-content-center">
                            <img src="<?= URL . "uploads/" . $prod['img'] ?>" alt="" srcset="" height="75px" class="m-3">
                        </div>
                        <div class="custom-file">
                            <input type="file" name="img" class="custom-file-input" id="customFile">
                            <label class="custom-file-label" for="customFile">Choose Image</label>
                        </div>

                        <div class="text-center mt-5">
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                            <a class="btn btn-dark" href="<?= AURL . "products.php" ?>">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
<?php include('inc/footer.php') ?>