<?php
require_once 'user_controller.inc.php';
require_once 'user_model.inc.php';

@$op = $_REQUEST['op'];

$user_controller = new UserController();

switch ($op) {
    case 'login':
        $username = $_POST['user'];
        $password = $_POST['pass'];
        if ($user_controller->login($username, $password) == 'true') {
            header("Location:create_group.php");
        } 
        else header("Location:login.php?err=1");
        break;
    
    case 'register':
        $usertype = $_POST['inputUsertype'];
        $name = $_POST['inputText'];
        $password = $_POST['inputPassword'];
        $email = $_POST['inputEmail'];    
        if ($user_controller->create($usertype, $name, $password, $email)== false) {
            header("Location:register.php?err=1");
        } 
            
        else header("Location:dashboard.php");
        
        break;
    
    case 'creategroup':
        $name=$_POST['inputgroup'];
//        $group_member=$_POST['member1'];
//        $email=$_POST['email1'];
        $createdby=$_POST['createdby'];
        if ($user_controller->create_group($name, $createdby)== false){
            header("Location:create_events.php?err=2");
        } else header("Location:create_group.php?success=yes");
        break;
    
    case 'Save':
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