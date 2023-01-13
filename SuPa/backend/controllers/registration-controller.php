<?php
require_once __DIR__.'/../models/person.php';
class RegistrationController extends Controller{

    public function actionRegistration(){

    }

    public function logicRegistration(){
        //Person::newPerson("Max","Schelenz","27-09-2001","1234","max.schelenz@fh-erfurt.de","G",password_hash("test", PASSWORD_DEFAULT),"street","25",07545,"Leipzig","TH","7");
    }
}