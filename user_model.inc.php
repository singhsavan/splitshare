<?php
include "db_config.php";

class UserModel {
    
    public $username;
    public $usertype;
    public $register_events;
    public $id;
    public $events;
    public $events_id;
    public $student_attended;
    public $faculty_events;
    public $registered_students;
    public $attended_students;
    public $attended_events;
    public $link;
    
    function UserModel($username) {
        $this->username = $username;
    }
    
    function db_connect(){
		
		$this->link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if (!$this->link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
return $this->link;



// echo "Success: A proper connection to MySQL was made! The my_db database is great." . PHP_EOL;
// echo "Host information: " . mysqli_get_host_info($link) . PHP_EOL;

// mysqli_close($link);

        // $mysqli =  new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
        
            // /* check connection */
        // if ($mysqli->connect_errno) {
    // printf("Connect failed: %s\n", $mysqli->connect_error);
    // exit();
// } else return $mysqli;
    }
    
    function get_username() {
        return $this->username;
    }
    
    function get_registerevents() {
        //$query = "SELECT * FROM `events`, `eventregister` WHERE events.event_id=eventregister.event_id AND eventregister.student_id=(select user_id from users where username = 'aqib'";
        $sql = "SELECT * FROM `events`, `eventregister` WHERE events.event_id=eventregister.event_id AND eventregister.student_id=(select user_id from users where username='$this->username')";
        //$this->register_events = mysqli_query($this->db_connect(), $query);
        $this->register_events = mysqli_query($this->db_connect(), $sql);
        
        //$user_data = mysqli_fetch_array($result);
        return $this->register_events;
    }
    
    function get_attendedevents() {
        //$query = "SELECT * FROM `events`, `eventregister` WHERE events.event_id=eventregister.event_id AND eventregister.student_id=(select user_id from users where username = 'aqib'";
        $sql = "SELECT * FROM `events`, `eventattendance` WHERE events.event_id=eventattendance.event_id AND eventattendance.student_id=(select user_id from users where username='$this->username' AND attendance='1')";
        //$this->register_events = mysqli_query($this->db_connect(), $query);
        $this->attended_events = mysqli_query($this->db_connect(), $sql);
        
        //$user_data = mysqli_fetch_array($result);
        return $this->attended_events;
    }
    
    function get_events() {
        //$query = "SELECT * FROM `events`, `eventregister` WHERE events.event_id=eventregister.event_id AND eventregister.student_id=(select user_id from users where username = 'aqib'";
        $sql = "SELECT * FROM events";
        //$this->register_events = mysqli_query($this->db_connect(), $query);
        $this->events = mysqli_query($this->db_connect(), $sql);
        return $this->events;
    }
    
    function get_faculty_events($id) {
        //$query = "SELECT * FROM `events`, `eventregister` WHERE events.event_id=eventregister.event_id AND eventregister.student_id=(select user_id from users where username = 'aqib'";
        $sql = "SELECT * FROM events where event_instructor_id = '$id'";
        //$this->register_events = mysqli_query($this->db_connect(), $query);
        $this->faculty_events = mysqli_query($this->db_connect(), $sql);
        return $this->faculty_events;
    }
    
    function get_events_id($id) {
        //$query = "SELECT * FROM `events`, `eventregister` WHERE events.event_id=eventregister.event_id AND eventregister.student_id=(select user_id from users where username = 'aqib'";
        $sql = "SELECT * FROM events where event_id=$id";
        //$this->register_events = mysqli_query($this->db_connect(), $query);
        $this->events_id = mysqli_query($this->db_connect(), $sql);
        return $this->events_id;
    }
    
    function get_student_attendance($id) {
        $sql = "select * from events, eventattendance where events.event_id=eventattendance.event_id and student_id='$id';";
        //$this->register_events = mysqli_query($this->db_connect(), $query);
        $this->student_attended = mysqli_query($this->db_connect(), $sql);
        return $this->student_attended;
    }
    
    function get_registered_students($id) {
        $sql = "SELECT users.user_id, users.first_name, users.last_name, users.email_id FROM `events`, eventregister, users WHERE eventregister.student_id=users.user_id and events.event_id=eventregister.event_id AND events.event_id='$id';";
        //$this->register_events = mysqli_query($this->db_connect(), $query);
        $this->registered_students = mysqli_query($this->db_connect(), $sql);
        return $this->registered_students;
    }
    
    function get_attended_students($id) {
        //$sql = "SELECT users.user_id, users.first_name, users.last_name, users.email_id FROM `events`, eventattendance, users WHERE eventattendance.student_id=users.user_id and events.event_id=eventattendance.event_id AND events.event_id='$id';";
        //$this->register_events = mysqli_query($this->db_connect(), $query);
        $sql = "SELECT users.user_id, users.first_name, users.last_name, users.email_id FROM events, eventattendance, users WHERE eventattendance.student_id=users.user_id and events.event_id=eventattendance.event_id AND events.event_id='$id';";
        $this->attended_students = mysqli_query($this->db_connect(), $sql);
        return $this->attended_students;
    }
    
    function get_usertype() {
        $sql = "SELECT * from users WHERE username ='$this->username'";
        $result = mysqli_query($this->db_connect(), $sql);
        $user_data = mysqli_fetch_array($result);
        $this->usertype = $user_data['usertype'];
        return $this->usertype;
    }
    
    function get_id(){
        $sql = "SELECT * from users WHERE username ='$this->username'";
        $result = mysqli_query($this->db_connect(), $sql);
        $user_data = mysqli_fetch_array($result);
        $this->id = $user_data['user_id'];
        return $this->id;
    }
    function set_username(){
        $this->username = $username;
    }
}

?>