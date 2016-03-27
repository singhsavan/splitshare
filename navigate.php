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
            header("Location:dashboard1.php");
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
        $email_id=$_POST['email_id'];
        if ($user_controller->create_group($name, $createdby, $email_id)== false){
            header("Location:create_events.php?err=2");
        } else header("Location:create_group.php?group=$name&success=yes");
        break;
    
    case 'Save':
        $name=$_POST['inputgroup'];
        $group_member=$_POST['member1'];
        $email=$_POST['email1'];
        if ($user_controller->create_group($name, $group_member, $email)== false){
            header("Location:create_events.php?err=2");
        } else header("Location:main.php");
        break;
    
    case 'Submit':
        $amount=$_POST['exampleInputAmount'];
        $desc=$_POST['exampleInputdesc'];
        $username=$_POST['exampleInputusername'];
        $groupname=$_POST['exampleInputgroupname'];
        if ($user_controller->add_expense($amount, $desc, $username, $groupname)== false){
            header("Location:create_events.php?err=2");
        } else header("Location:main.php?group=$groupname");
        break;    
        
    case 'Settle Up':
        $paid_by = $_POST['user'];
        $amount=$_POST['exampleInputAmount'];
        $paid_to=$_POST['exampleInputusername'];
        $groupname=$_POST['exampleInputgroupname'];
        if ($user_controller->settle_up($paid_by, $amount, $paid_to, $groupname)== false){
            header("Location:create_events.php?err=2");

                    
        } else header("Location:main.php?group=$groupname");
        break;
        
    case 'Edit bill':
        $amount=$_POST['exampleInputAmount'];
        $desc=$_POST['exampleInputdesc'];
        $username=$_POST['exampleInputusername'];
        $groupname=$_POST['exampleInputgroupname'];
        $expenseid=$_POST['expense_id'];
        if ($user_controller->edit_bill($amount, $desc, $username, $groupname, $expenseid)== false){
            header("Location:create_events.php?err=2");
        } else header("Location:main.php?group_member=$username&group=$groupname");
        break; 
        
    case 'Delete bill':
        $username=$_POST['exampleInputusername'];
        $groupname=$_POST['exampleInputgroupname'];
        $expenseid=$_POST['delete_expenseid'];
        if ($user_controller->delete_bill($username, $groupname, $expenseid)== false){
            header("Location:create_events.php?err=2");
        } else header("Location:main.php?group_member=$username&group=$groupname");
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