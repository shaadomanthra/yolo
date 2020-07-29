<?php

if(isset($_REQUEST['name'])){
    $name = $_REQUEST['name'];
    $data = $_REQUEST['image'];

    list($type, $data) = explode(';', $data);
    list(, $data)      = explode(',', $data);
    $data = base64_decode($data);
    $path = '/images/'.$name.'.png';
    file_put_contents($path, $data);
    $cmd = 'python3 yolo.py --image '.$path.' --yolo yolo-coco';
    $count = shell_exec($cmd);
    echo $count;
}
