<?php
    require_once (__DIR__ . '/../vendor/autoload.php');
    $getPost = filter_input(INPUT_GET, "post", FILTER_VALIDATE_BOOLEAN);

    $path =__DIR__ . '/../uploads';

    try{
        $upload = new  \Source\BBUploader\BBUploader($path);
        echo $upload->doUpload($getPost);


    }catch(\Exception $e){
        echo $e->getMessage(), "\n";
    }








