<?php
require_once __DIR__.'/../models/person.php';
// TODO Comments
class AuthenticationController extends Controller {

    private function loggedIn($personMode) {
        switch ($personMode){
            case 1:
                header('Location: index.php?page=account&view=admin');
                break;
            case 2:
                header('Location: index.php?page=account&view=cleaning');
                break;
            case 3:
                header('Location: index.php?page=account&view=maintenance');
                break;
            case 4:
                header('Location: index.php?page=account&view=manager');
                break;
            case 5:
                header('Location: index.php?page=account&view=rental');
                break;
            case 6:
                header('Location: index.php?page=account&view=booking');
                break;
            case 7:
                header('Location: index.php?page=account&view=guest');
                break;
            default:
                break;
        }
    }

    public function actionAuthenticationGuest(){
        if(isset($_SESSION['person'])){
            $person = new Person($_SESSION['person']);
            $modeID = $person->getPersonModeID();
            $this->loggedIn($modeID);
        }
    }

    public function actionAuthenticationIntern(){
        $this->actionAuthenticationGuest();
    }

    // TODO Comments
//logiiiiiiiiic

    public function logicLogin()
    {
        $mail = $_POST['mail'];
        $person = Person::findByMail($mail);

        if (is_null($person)) {
            header('Location: index.php?page=error&view=unknownUser');
            return;
        }
        if (!password_verify($_POST['pwd'], $person->PasswordHash)) {
            header('Location: index.php?page=error&view=wrongPwd');
            return;
        }
        $modeID = $person->getPersonModeID();
        $loginType = $_POST['authType'];
        if(!Permission::checkForLogin($modeID, $loginType)){
            header('Location: index.php?page=error&view=noAccess');
            return;
        }

        $_SESSION['person'] = $person->PersonID;
        //$_SESSION['special'] = $person->getChildClass(); per personId in View gönnen

        if($modeID == null){
            header('location: index.php?page=error&view=noMode');
        }else $this->loggedIn($modeID);

    }







}