<?php

class UserController {
    public $db;
    public $usertype;
    public $id;
    //public $username="";
    function UserController(){
        $this->db = new UserModel("");
        $this->db = $this->db->db_connect();

    }
    function validate_empty($usertype, $id, $firstname, $lastname, $username, $passwrd, $cpasswrd, $email) {
         if (empty($usertype) || empty($id) || empty($firstname) || empty($lastname) || empty($username) || empty($passwrd) || empty($cpasswrd) || empty($email)) {
             return false;   
         } else return true;
    }
    
    function validate_empty_eventregister($studentid, $hearabout) {
         if (empty($studentid)){
             return false;   
         } elseif($hearabout == "none") {
             return false;
    }  else return true;
    }
    
    function validate_empty_createevents($eventid, $eventname, $eventdesc, $eventloc, $instructor, $startdate, $enddate) {
         if (empty($eventid) || empty($eventname) || empty($eventdesc) || empty($eventloc) || empty($instructor) || empty($startdate) || empty($enddate)) {
             return false;   
         } else return true;
    }
    
    function validate_password($passwrd) {
        if(strlen($passwrd)<6) {
            return false;
        } else return true;
    
    }
    
    function validate_valid($id) {
        if(strlen($id)!=9) {
            return false;
        } elseif (is_numeric(trim($id)) == false){
            return false;
        } else return true;
    }
    
    function validate_id_eventregister($id) {
        if(strlen($id)!=9) {
            return false;
        } elseif (is_numeric(trim($id)) == false){
            return false;
        } else return true;
    }
    function compare_password($passwrd, $cpasswrd) {
        if ($passwrd == $cpasswrd) {
            return true;
        } else return false;
    
    }
    function Validate_email($email) {
        if (!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email)) {
            return false    ;
        } else return true;
    
    }
    
    function create($usertype, $name, $passwrd, $email) {
        $password = md5($passwrd);
	$sql="SELECT * FROM users WHERE username='$name' or email_address='$email';";
        $sql1="SELECT * FROM group_members WHERE member_name='$name' or member_email='$email';";

	//checking if the username or email is available in db
	$check =  $this->db->query($sql);
	$count_row = $check->num_rows;
        $check1 =  $this->db->query($sql1);
	$count_row1 = $check1->num_rows;
	//if the username is not in db then insert to the table
	if ($count_row == 0 && $count_row1 == 0){
	$sql1="INSERT INTO `users` (`user_id`, `username`, `email_address`, `password`) VALUES (NULL, '$name', '$email', '$password')";
        $result = mysqli_query($this->db,$sql1) or die(mysqli_connect_errno()."Data cannot inserted");
        session_start();
            $user = new UserModel($name);
            $this->usertype = $user->get_usertype();
            $this->id = $user->get_id();
            $_SESSION['user'] = $user;
            $_SESSION['usertype'] = $user->get_usertype();
        return $result;
	} else if ($count_row == 0 && $count_row1 == 1) {
	$sql1="INSERT INTO `users` (`user_id`, `username`, `email_address`, `password`, `usertype`, `group_created`, `member_active`) VALUES (NULL, '$name', '$email', '$password', 'user', '0', '1')";
        $result = mysqli_query($this->db,$sql1) or die(mysqli_connect_errno()."Data cannot inserted");
        session_start();
            $user = new UserModel($name);
            $this->usertype = $user->get_usertype();
            $this->id = $user->get_id();
            $_SESSION['user'] = $user;
            $_SESSION['usertype'] = $user->get_usertype();
        return $result;
	}
	else { return false;}
}
    
    function create_group($name, $createdby, $email_id) {
	$sql="SELECT * FROM groups WHERE group_name='$name'";
	//checking if the username or email is available in db
	$check =  $this->db->query($sql);
	$count_row = $check->num_rows;
        
	//if the username is not in db then insert to the table
	if ($count_row == 0){
	$sql1="INSERT INTO `groups` (`group_id`, `group_name`, `created_by`) VALUES (NULL, '$name', '$createdby')";
        $result = mysqli_query($this->db,$sql1) or die(mysqli_connect_errno()."Data cannot inserted");
        $sql2="UPDATE users SET usertype = 'admin', group_created = '1', member_active = '1' WHERE username = '$createdby'";
        $result1 = mysqli_query($this->db,$sql2) or die(mysqli_connect_errno()."Data cannot inserted");
            if(!empty($result)) {
                $sql3="INSERT INTO `group_members` (`member_id`, `member_name`, `member_email`, `member_group`) VALUES (NULL, '$createdby','$email_id', '$name')";
                $result3 = mysqli_query($this->db,$sql3) or die(mysqli_connect_errno()."Data cannot inserted");
            }
        return $result;    
        }    
	else { return false;}
    }
    
    function add_expense($amount, $desc, $name, $groupname) {
	$sql="INSERT INTO `expense` (`expense_id`, `expense_desc`, `expense_amount`, `expense_by`, `group_name`) VALUES (NULL, '$desc', '$amount', '$name', '$groupname')";
        $result = mysqli_query($this->db,$sql) or die(mysqli_connect_errno()."Data cannot inserted");
        if(!empty($result)){
            $sql1="select sum(expense_amount) as sum from expense where group_name = '$groupname'";
            $result1 = mysqli_query($this->db, $sql1);
            $user_data1 = mysqli_fetch_array($result1);
            $sql2="select count(*) as count from group_members where member_group = '$groupname'";
            $result2 = mysqli_query($this->db, $sql2);
            $user_data2 = mysqli_fetch_array($result2);
//            if (($user_data1['sum']) == 0 && ($user_data2['count']==0)) {
//                $share = 0;
//            }
            $share = ($user_data1['sum'])/($user_data2['count']);
            $sql3 = "update balance set share = '$share' where group_name = '$groupname'";
            $result3 = mysqli_query($this->db, $sql3);
            $sql4 = "select sum(expense_amount) as membersum, expense_by from expense where group_name = '$groupname' group by expense_by";
            $result4 = mysqli_query($this->db, $sql4);
            if ($result4->num_rows > 0) {
                            while ($row = $result4->fetch_object()) {
                                $memberbalance = $row->membersum;
                                $rembalance = $share - $memberbalance;
                                $sql5 = "update balance set balance_value = '$rembalance' where group_name = '$groupname' and balance_name = '$row->expense_by'";
                                $result5 = mysqli_query($this->db, $sql5);
                                }
                            }
            //$sql6 = "select balance_value, balance_name from balance where group_name = '$groupname'"; 
            $sql6 = "SELECT member_name FROM `group_members` where member_name NOT IN (select expense_by from expense)";                 
            $result6 = mysqli_query($this->db, $sql6);
            if ($result6->num_rows > 0) {
                            while ($row = $result6->fetch_object()) {
                                $rembalance = $share;
                                $sql7 = "update balance set balance_value = '$rembalance' where group_name = '$groupname' and balance_name = '$row->member_name'";
                                $result7 = mysqli_query($this->db, $sql7);
                            }
            }
            return true;
        } else return false;
        }    
   
    function register_events($studentid, $hearabout, $eventid) {
            $sql="SELECT * FROM eventregister WHERE event_id='$eventid' and student_id='$studentid'";

	//checking if the username or email is available in db
	$check =  $this->db->query($sql);
	$count_row = $check->num_rows;
        
	//if the username is not in db then insert to the table
	if ($count_row == 0){
	$sql1="INSERT INTO `attendance_system`.`eventregister` (`event_id`, `student_id`, `hear_about`, `register_datetime`) VALUES ('$eventid', '$studentid', '$hearabout', CURRENT_TIMESTAMP);";
	$sql2="UPDATE `eventregister` SET `barcode_id`= (SELECT barcode from barcode_mapping where student_id='$studentid') WHERE student_id='$studentid' and event_id='$eventid';";
        
        $result = mysqli_query($this->db,$sql1) or die(mysqli_connect_errno()."Data cannot inserted");
        $result1 = mysqli_query($this->db,$sql2);
        return $result;
	}
	else return false;
}
    function login($username, $password){
        if($this->authenticate($username, $password)){
            session_start();
            $user = new UserModel($username);
            $this->usertype = $user->get_usertype();
            $this->id = $user->get_id();
            $_SESSION['user'] = $user;
            $_SESSION['usertype'] = $user->get_usertype();
            $sql = "INSERT INTO `login` (`id`, `username`, `password`, `usertype`) VALUES ('$this->id', '$username', MD5('$password'), '$this->usertype');";
            $result = mysqli_query($this->db, $sql);
            return true;
        } 
    }
    
    
    public function authenticate($u, $p){
        $authentic = false;
        $password = md5($p);
	$sql = "SELECT * from users WHERE username ='$u' and password ='$password'";
        $result = mysqli_query($this->db, $sql);
        $user_data = mysqli_fetch_array($result);
        $count_row = $result->num_rows;
        if ($count_row == 1){
        $authentic = true;
        } else {
        $authentic = false;    
        }
        return $authentic;
    }
    
    function logout(){
        session_start();
        session_destroy();
    }
            
}

?>
