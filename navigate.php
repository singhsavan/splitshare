<?php
require_once 'user_controller.inc.php';
require_once 'user_model.inc.php';

@$op = $_REQUEST['op'];

$user_controller = new UserController();

switch ($op) {
    case 'login':
        $username = $_POST['user'];
        $password = $_POST['pass'];
        if ($user_controller->login($username, $password) == 'admin') {
            header("Location:dashboard.php");
        } 
//        elseif ($user_controller->login($username, $password) == 'faculty'){
//            header("Locatiosn:faculty.php");
//        } elseif ($user_controller->login($username, $password) == 'admin'){
//            header("Location:admin.php");
//        }
        else header("Location:index.php?err=1");
        break;
    
    case 'register':
        $usertype = $_POST['inputUsertype'];
        $name = $_POST['inputText'];
        $password = $_POST['inputPassword'];
        $email = $_POST['inputEmail'];
//        if ($user_controller->validate_empty($usertype, $id, $firstname, $lastname, $username, $password, $cpassword, $email) == false){
//            header("Location:registration.php?err=1");
//        } elseif ($user_controller->validate_password($password)== false) {
//            header("Location:registration.php?err=2");
//        } elseif ($user_controller->compare_password($password, $cpassword)== false) {
//            header("Location:registration.php?err=3");
//        } elseif ($user_controller->validate_valid($id)== false) {
//            header("Location:registration.php?err=4");
//        } elseif ($user_controller->Validate_email($email)== false) {
//            header("Location:registration.php?err=5");    
        if ($user_controller->create($usertype, $name, $password, $email)== false) {
            header("Location:registration.php?err=6");
        } 
            
        else header("Location:dashboard.php");
        
        break;
    
    case 'create group':
        $name=$_POST['inputgroup'];
        $group_member=$_POST['member1'];
        $email=$_POST['email1'];
        if ($user_controller->create_group($name, $group_member, $email)== false){
            header("Location:create_events.php?err=2");
        } else header("Location:main.php");
        break;
    
    case 'REGISTER':
        $studentid=$_POST['studentid'];
        $hearabout=$_POST['hearselect'];
        $eventid=$_POST['eventid'];
        $eventname=$_POST['eventname'];
        if ($user_controller->validate_empty_eventregister($studentid, $hearabout) == false){
            header("Location:eventregister.php?err=1&id=$eventid&name=$eventname");
        } elseif ($user_controller->validate_id_eventregister($studentid)== false) {
            header("Location:eventregister.php?err=2&id=$eventid&name=$eventname");
        } elseif ($user_controller->register_events($studentid, $hearabout, $eventid) == false) {
            header("Location:eventregister.php?err=3&id=$eventid&name=$eventname");
        }
        
        else header("Location:eventregister_success.php");
        break;
        
    case 'logout':
        $user_controller->logout();    
        header("Location:login.php");
        break;
    
    default:
        header("Location:login.php");
        break;
    
}