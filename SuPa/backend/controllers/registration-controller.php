<?php
require_once __DIR__.'/../models/person.php';
class RegistrationController extends Controller{

    public function actionRegistration(){

    }

    public function logicRegistration(){
        Person::newPerson("Dario","Daßler","15.10.2001","1234","dario-dassler@gmx.de","A",password_hash("test", PASSWORD_DEFAULT),"street","25",07545,"Leipzig","TH","1");
    }
}