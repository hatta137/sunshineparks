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

    public function deinemutter() :bool {
        if($this->_controllerName == "account"){
            if(isset($_SESSION['person'])){
                $person = new Person($_SESSION['person']);
                $personMode = $person->getPersonModeID();
                switch($this->_actionName){
                    case "admin":
                        if($personMode == 1) return true;
                        else return false;
                        break;
                    case "cleaning":
                        if($personMode == 2) return true;
                        else return false;
                        break;
                    case "maintenance":
                        if($personMode == 3) return true;
                        else return false;
                        break;
                    case "manager":
                        if($personMode == 4) return true;
                        else return false;
                        break;
                    case "rental":
                        if($personMode == 5) return true;
                        else return false;
                        break;
                    case "booking":
                        if($personMode == 6) return true;
                        else return false;
                        break;
                    case "guest":
                        if($personMode == 7) return true;
                        else return false;
                        break;
                    default:
                        header('Location: index.php?page=error&view=noMode');
                        break;
                }
            }else{
                //auf errorseite verweisen
                header('Location: index.php?page=authentication&view=authenticationGuest');
                return false;
            }
        }elseif ($this->_controllerName == "admin"){
            if(isset($_SESSION['person'])) {
                $person = new Person($_SESSION['person']);
                $personMode = $person->getPersonModeID();
                switch ($this->_actionName){
                    case "edit";
                }
            }

        }elseif ($this->_controllerName == "rental"){

        }
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
            //header('Location: index.php?page=pages&view=error&error=404');
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

