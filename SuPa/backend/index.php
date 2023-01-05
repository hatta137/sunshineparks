<?php
session_start();

require_once 'core/controller.php';
require_once 'core/view.php';
require_once 'core/model.php';

$controllerName = $_GET['page'] ?? 'home';
$actionName = $_GET['view'] ?? 'home';
$logicName = $_GET['logic'] ?? null;

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

    if (!method_exists($controllerInstance, $actionMethodName)) {
        // If method doesn't exist
        //header('Location: index.php?page=pages&view=error&error=404');
        return;
    }

    // If method exists, execute function matching the name
    $controllerInstance->$actionMethodName();

    // Render corresponding view
    $controllerInstance->renderHTML();
}