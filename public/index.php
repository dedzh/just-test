<?php
declare(strict_types=1);
spl_autoload_register(function(string $class):void
{
    $paths =[
        __DIR__ . '/../src/' . $class . '.php',
        __DIR__ . '/../src/Model/' . $class . '.php',
        __DIR__ . '/../src/Controller/' . $class . '.php',
    ];
    foreach ($paths as $file) {
        if (is_file($file)){
            require $file;
            return;
        }
            
    }

});


$pdo = Database::getConnection();
$controller = new ProductController($pdo);

$action = $_GET['action']??'index';
$id = isset($_GET['id']) ? (int) $_GET['id'] :0;

switch($action){
case 'create':
       $controller ->create(); 
    break;
case 'edit':
    if($id<= 0){http_response_code(400); echo "Unvaliable id";break;}
    $controller ->edit($id);
    break;

case 'delete':
    if($id<= 0){http_response_code(400); echo "Unvaliable id";break;}
    $controller ->delete($id);
    break;

default:
    $controller ->index();
}
