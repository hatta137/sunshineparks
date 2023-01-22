<?php

require_once __DIR__.'/../models/person.php';

class Permission
{
    public static function checkForAction(string $actionName):bool{
        if(isset($_SESSION['person'])) {
            $person = new Person($_SESSION['person']);
            $modeID = $person->getPersonModeID();
        }else $modeID = 8;
        $permission = Person::getPermission($modeID,ucfirst($actionName));
        if($permission == 'Y') return true;
        else if(is_null($permission)) return true;
        else return false;
    }

    public static function checkForSite(string $actionName):bool{
        if(isset($_SESSION['person'])) {
            $person = new Person($_SESSION['person']);
            $personMode = $person->getPersonModeID();
        }else $personMode = 8;
            switch($actionName){
                case "admin":
                    if($personMode == 1) return true;
                    else return false;
                case "cleaning":
                    if($personMode == 2) return true;
                    else return false;
                case "maintenance":
                    if($personMode == 3) return true;
                    else return false;
                case "manager":
                    if($personMode == 4) return true;
                    else return false;
                case "rental":
                    if($personMode == 5 || $personMode == 1) return true;
                    else return false;
                case "booking":
                    if($personMode == 6) return true;
                    else return false;
                case "guest":
                    if($personMode == 7) return true;
                    else return false;
                default:
                    $permission = Person::getPermission($personMode,ucfirst($actionName));
                    if($permission == 'Y') return true;
                    else if(is_null($permission)) return true;
                    else return false;
            }
    }

    public static function checkForRegistration(int $newMode) :bool{
        if($newMode != 7){
            if(isset($_SESSION['person'])) {
                $person = new Person($_SESSION['person']);
                if ($person->getPersonModeID() != 1){
                    return false;
                }
            }else{
                return false;
            }
        }
        return true;
    }

    public static function checkForLogin(int $modeID, string $loginType) :bool{
        if ($modeID == 7 && $loginType != "guest") {
            return false;
        } else if (($modeID < 7 && $modeID > 0) && $loginType != "intern") {
            return false;
        }else return true;
    }

}