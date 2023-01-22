<?php
require_once __DIR__.'/../models/person.php';

class AuthenticationController extends Controller {


    /**
     * Author: Dario Dassler
     * This method log the person In
     * @param int $modeID
     * @param int $PersonID
     * @return void
     */
    public static function logIn(int $PersonID, int $modeID){
        $_SESSION['person'] = $PersonID;
        if($modeID == null){
            header('location: index.php?page=error&view=noMode');
        }else AuthenticationController::loggedIn($modeID);
    }
    /**
     * Author: Dario Dassler
     * This method forwards to the respective account page depending on the person's ModeID
     * @param $personMode
     * @return void
     */
    private static function loggedIn($personMode) {
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

    /**
     * Author Dario Dassler
     * These methods check whether the user is already logged in based on the session.
     * @return void
     */
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

    /**
     * Author: Dario Dassler
     * This method logs the user. It checks the transferred data: email and password.
     * If all data is correct then it saves the PersonID in the session and opens the respective account page
     * @return void
     */

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
        //$_SESSION['special'] = $person->getChildClass(); per personId in View gönnen

        $this->logIn($person->PersonID, $modeID);


    }







}