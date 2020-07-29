<?php

if(isset($_REQUEST['name'])){
    $name = $_REQUEST['name'];
    $data = $_REQUEST['image'];

    list($type, $data) = explode(';', $data);
    list(, $data)      = explode(',', $data);
    $data = base64_decode($data);
    $path = 'images/'.$name.'.png';
    file_put_contents($path, $data);
    $cmd = 'python3 yolo.py --image '.$path.' --yolo yolo-coco';
    $count = shell_exec($cmd);

    // Get the image and convert into string
    $img = file_get_contents($path);

    // Encode the image string data into base64
    $data = base64_encode($img);
    $json['count'] = $count;
    $json['image'] = $data;
    unlink($path);
    echo json_encode($json);
}else{

    $path = 'images/f2.jpg';
    $cmd = 'python3 yolo.py --image '.$path.' --yolo yolo-coco';
    $count = shell_exec($cmd);

    // Get the image and convert into string
    $img = file_get_contents($path);

    // Encode the image string data into base64
    $data = base64_encode($img);
    $json['count'] = $count;
    $json['image'] = $data;
    //unlink($path);
    echo json_encode($json);
}
