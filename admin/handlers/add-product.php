<?php

use TechStory\Classes\File;
use TechStory\Classes\Models\Product;
use TechStory\Classes\Validation\Validator;

require_once("../../app.php");


if ($request->postHas('submit')) {
    $name = $request->post('name');
    $cat_id = $request->post('cat_id');
    $price = $request->post('price');
    $pieces_no = $request->post('pieces_no');
    $desc = $request->post('desc');
    $img = $request->file('img');

    $validator = new Validator;
    $validator->validate('name', $name, ['required', 'str', 'max']);
    $validator->validate('cat_id', $cat_id, ['required', 'numeric']);
    $validator->validate('price', $price, ['required', 'numeric']);
    $validator->validate('pieces number', $pieces_no, ['required', 'numeric']);
    $validator->validate('description', $desc, ['required', 'str']);
    $validator->validate('image', $img, ['requiredfile', 'image']);


    if ($validator->hasErrors()) {
        $session->set('errors', $validator->getErrors());
        $request->aredirect('add-product.php');
    } else {
        $file = new File($img);
        $imgUploadName =  $file->rename()->upload();

        $pr = new Product;
        $pr->insert(
            "name,`desc`,price,pieces_on,img,cat_id",
            "'$name', '$desc', '$price', '$pieces_no', '$imgUploadName', '$cat_id' "
        );

        $session->set('success', 'product added successfully');
        $request->aredirect("products.php");
    }
} else {
    $request->aredirect("add-product.php");
};
