<?php


interface IObserver
{
     //an observer has to implement a function, that will be called when the observable changes
     //the function receive data (in this case the user name) and also the observable object (since the observer could be observing more than on system)
     function onUserAdded( $observable, $data );
     function mail_admin ($admin_mail, $usertype, $data);
}

class NewUserMailer implements IObserver
{
    public function  onUserAdded( $observable, $data ) 
    {
        
        $this->mail_admin("admin12@yopmail.com", "new user", $data);
        
    }
    
    public function mail_admin($admin_mail, $usertype, $data) {
            
        require 'PHPMailer-master/PHPMailerAutoload.php';

        $mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'askuofr@gmail.com';                 // SMTP username
        $mail->Password = 'savanmanoj';                           // SMTP password
        $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465;                                    // TCP port to connect to

        $mail->setFrom('from@example.com', 'Mailer');
        $mail->addAddress('admin123@yopmail.com', 'tofiq');
        $mail->addAddress('');               // Name is optional
        $mail->addReplyTo('', '');
        $mail->addCC('');
        $mail->addBCC('');

        $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = $data;
        $mail->Body = 'This is the HTML message body <b>in bold!</b>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        if (!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message has been sent';
        }
}
}

interface IObservable
{
    //we can attach observers to the observable
    function attach( $observer );
}

class LoginSystem implements IObservable
{
    private $observers = array();

    private function notify( $userName )
    {
        foreach( $this->observers as $o )
            $o->onUserAdded( $this, $userName );
    }

    public function attach( $observer )
    {
        $this->observers []= $observer;
    }

    public function createUser( $userName )
    {

        //al your logic to add it to the databse or whatevere, andt then:

        $this->notify($userName);


    }

}
