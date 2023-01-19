<?php
session_start();

require_once 'core/database.php';
require_once 'core/controller.php';
require_once 'core/view.php';
require_once 'core/model.php';

$controllerName = $_GET['page'] ?? 'home';
$actionName = $_GET['view'] ?? 'home';
$logicName = $_GET['logic'] ?? null;

if(!isset($_SESSION['loginType'])){
    $_SESSION['loginType']="logout";
}

if(!isset($_SESSION['person'])){
    $_SESSION['person'] = 88;
}


$controllerPath = __DIR__ . '/controllers/' . $controllerName . '-controller.php';

if (!file_exists($controllerPath)) {
    // If the requested controller doesn't exists
    //header('Location: index.php?page=pages&view=error&error=404');
    return;
}

require_once $controllerPath;

$controllerClassName = ucfirst($controllerName) . 'Controller';

if (!class_exists($controllerClassName)) {
    // If controller class doesn't exist
    //header('Location: index.php?page=pages&view=error&error=404');
    return;
}

// Create instance of controller
$controllerInstance = new $controllerClassName($actionName, $controllerName);

//checks if user have rights to open the page
if(!$controllerInstance->rightsCheck()){
    echo "Max hat n Anusriss"; //auf noAccess Error Seite verweisen oder login
    return;
}

if (!is_null($logicName)) {
    // If a logic function was requested

    $logicMethodName = 'logic' . ucfirst($logicName);

    if (!method_exists($controllerInstance, $logicMethodName)) {
        // If method doesn't exist
        //header('Location: index.php?page=pages&view=error&error=404');
        return;
    }

    // If method exists, execute function matching the name
    $controllerInstance->$logicMethodName();
} else {
    // If a view was requested

    $actionMethodName = 'action' . ucfirst($actionName);




    if (method_exists($controllerInstance, $actionMethodName)) {
        // If method doesn't exist
        //header('Location: index.php?page=pages&view=error&error=404');


        // If method exists, execute function matching the name
        $controllerInstance->$actionMethodName();

    }

    // Render corresponding view
    $controllerInstance->renderHTML();
}
