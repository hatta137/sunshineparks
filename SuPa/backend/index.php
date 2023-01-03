<?php

require_once 'core/controller.php';
require_once 'core/view.php';
require_once 'core/model.php';


$controllerName = $_GET['page']  ?? 'home';
$actionName     = $_GET['view']  ?? 'home';
$logicName      = $_GET['logic'] ?? 'home';

$controllerPath = __DIR__ . '/controllers/' . $controllerName . '-controller.php';


if (file_exists($controllerPath)) {
    require_once $controllerPath;

    $controllerClassName = ucfirst($controllerName) . 'Controller';

    // if the controller exists
    if (class_exists($controllerClassName)) {
        // create instance of controller
        $controllerInstance = new $controllerClassName($actionName, $controllerName);

        $actionMethodName = 'action' . ucfirst($actionName);

        // if method exists
        if (method_exists($controllerInstance, $actionMethodName)) {
            // execute function matching the name
            $controllerInstance->$actionMethodName();

            // render corresponding view
            $controllerInstance->renderHTML();
        } else {
          //  header('Location: index.php?page=pages&view=error&error=404');
        }
    } else {
       // header('Location: index.php?page=pages&view=error&error=405');
    }
} else {
   // header('Location: index.php?page=pages&view=error&error=406');
}
