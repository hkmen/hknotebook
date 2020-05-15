<?php
require_once ('NoteController.php');

$debug = true;
$error = "访问异常";

// 测试数据
//$_POST['category'] = 'User';
//$_POST['method'] = 'Register';
//$_POST['data'] = json_encode(array('username'=>'hk', 'password'=>'admin'));
//
//$_POST['category'] = 'Note';
//$_POST['method'] = 'GetNoteList';
//$_POST['data'] = json_encode(array('noteid'=>1));

if(!empty($_POST['category']) && !empty($_POST['method']))
{
    $category = $_POST['category'].'Controller';
    $method = $_POST['method'];
    $params = empty($_POST['data'])?'':json_decode($_POST['data'],true);

    $reflectionClass = new ReflectionClass($category);
    if($reflectionClass->isInstantiable()) {
        $controller = new $category();
        echo $controller->$method($params);
    } else {
        if($debug){
            $error= "类 $category 不可以实例化";
        }
        $data = array('flag'=>'fail', 'data'=> $error);
        echo json_encode($data);
    }
}
else
{
    if($debug){
        $error = "category or method is empty";
    }
    $data = array('flag'=>'fail', 'data'=> $error);
    echo json_encode($data);
}
