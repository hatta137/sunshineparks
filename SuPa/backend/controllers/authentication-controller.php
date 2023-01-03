<?php
require_once __DIR__.'/../models/person.php';
class AuthenticationController extends Controller {



    public function actionAuthenticationGuest(){

    }

    public function actionAuthenticationIntern(){

    }

//logiiiiiiiiic

    public function logicLogin(){
        $mail = $_POST['mail'];
        $person = Person::findByMail($mail);

        if (is_null($person)) {
            header('Location: index.php?page=error&view=unknownUser');
            return;
        }
        if(!password_verify($_POST['pwd'], $person->PasswordHash)){
            header('Location: index.php?page=error&view=wrongPwd');
            return;
        }
        $personType = $person->AccountType;
        $loginType = $_POST['authType'];
        if($personType == "guest" && $loginType != "guest"){
            header('Location: index.php?page=error&view=noAccess');
            return;
        }else if(($personType == "employee" || $personType == "admin") && $loginType != "intern"){
            header('Location: index.php?page=error&view=noAccess');
            return;
        }
        $this->_params['person'] = $person;
        $this->_params['special'] = $person->getChildClass();
        if($personType === "guest"){
            header('Location: index.php?page=account&view=guest');
        }else if($personType === "employee"){
            header('Location: index.php?page=account&view=employee');

        }else if($personType === "admin"){
            header('Location: index.php?page=account&view=admin');

        }

    }


}