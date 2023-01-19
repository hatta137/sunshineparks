<?php


// basic controller class
// mostly necessary functions and member-variables to execute a function and render a view
class Controller
{
    protected string $_actionName = "";
    private string $_controllerName = "";

    protected array $_params = [];

    public function __construct(string $actionName, string $controllerName)
    {
        $this->_actionName = $actionName;
        $this->_controllerName = $controllerName;
    }


    public function rightsCheck() :bool{
        return true;
    }


    public function renderHTML()
    {

        $viewPath = $this->viewPath($this->_actionName, $this->_controllerName);
        // Render Header
        View::render(__DIR__."/../views/general/header.php", $this->_params);


        if (file_exists($viewPath)) {
            View::render($viewPath, $this->_params);

        } else {
            //echo $viewPath;
            //echo "file not found";
            header('Location: index.php?page=error&view=404');
        }

        // Render Footer
        View::render(__DIR__."/../views/general/footer.php", $this->_params);
    }

    protected function viewPath(string $actionName, string $controllerName) : string
    {
        return __DIR__ . '/../views/' . $controllerName . "/" . $actionName . '.php';
        //return __DIR__ . '/../views/' . implode("/", array($controllerName, $actionName)) . '.php';
    }
}

