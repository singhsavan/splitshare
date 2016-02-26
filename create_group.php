<?php
require_once('user_model.inc.php');
session_start();
if(!isset($_SESSION['user'])) {
    header("Location:login.php");
} else {
    $user = $_SESSION['user'];
}
    
?>
<?php
	if(!empty($_POST["save"])) {
		$conn = mysql_connect("localhost","root","");
		mysql_select_db("splitnshare",$conn);
		$itemCount = count($_POST["member_name"]);
		$itemValues=0;
		$query = "INSERT INTO group_members (member_name,member_email) VALUES ";
		$queryValue = "";
		for($i=0;$i<$itemCount;$i++) {
			if(!empty($_POST["member_name"][$i]) || !empty($_POST["member_email"][$i])) {
				$itemValues++;
				if($queryValue!="") {
					$queryValue .= ",";
				}
				$queryValue .= "('" . $_POST["member_name"][$i] . "', '" . $_POST["member_email"][$i] . "')";
			}
		}
		$sql = $query.$queryValue;
		if($itemValues!=0) {
			$result = mysql_query($sql);
			if(!empty($result)) {
                            $message = "Added Successfully.";
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
                            for($i=0;$i<$itemCount;$i++) {
                                $mail->addAddress($_POST["member_email"][$i], $_POST["member_name"][$i]);     // Add a recipient
                            }
                            $mail->addReplyTo('', '');
                            $mail->addCC('');
                            $mail->addBCC('');

                            $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                            $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
                            $mail->isHTML(true);                                  // Set email format to HTML

                            $mail->Subject = 'Test to send email using phpmailer';
                            $mail->Body = 'This is the HTML message body <b>in bold!</b>';
                            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                            if (!$mail->send()) {
                                echo 'Message could not be sent.';
                                echo 'Mailer Error: ' . $mail->ErrorInfo;
                            } else {
                                $mailmessage = "Invitaion sent to the ggroup members";
                                header( "refresh:7;url=main.php");
                            }
                            
                        }
    }
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Dashboard</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/signin.css" rel="stylesheet">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <SCRIPT>
  function addMore() {
          $("<DIV>").load("input.php", function() {
                          $("#product").append($(this).html());
          });	
  }
  function deleteRow() {
          $('DIV.product-item').each(function(index, item){
                  jQuery(':checkbox', this).each(function () {
              if ($(this).is(':checked')) {
                                  $(item).remove();
              }
          });
          });
  }
    </SCRIPT>
    </head>

  <body>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Split N Share</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="index.html">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li role="separator" class="divider"></li>
                            <li class="dropdown-header">Nav header</li>
                            <li><a href="#">Separated link</a></li>
                            <li><a href="#">One more separated link</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php echo $user->get_username() ?><span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Your Account</a></li>
                            <li><a href="create_group.php">Create Group</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="navigate.php?op=logout">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!--/.nav-collapse -->

        </div>

    </nav>
    
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <hr></hr>
                    <div class="pull-right">
                        <img alt="Bootstrap Image Preview" src="http://lorempixel.com/140/140/" class="img-circle" />
                    </div>    
                </div>
                <div class="col-md-5">
                    <h3 class="text-info">
                        Start a new group<hr></hr>
                    </h3>
                    <form class="form-horizontal" role="form" method="post" action="navigate.php">
                        <div class="form-group">

                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="inputgroup" name="inputgroup" placeholder="Group Name" required autofocus />
                                <input type="hidden" class="form-control" id="createdby" name="createdby" value="<?php echo $user->get_username() ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-default" name="op" value="creategroup">    
                                    Create
                                </button>
                                <?php if (@$_GET['success'] == "yes") { ?>
                                    <div class="text-success">Group created successfully. Please add group members below.</div>
                                <?php } ?>
                            </div>
                        </div>
                    </form>
                    <?php if (@$_GET['success'] == "yes") { ?>
                        <FORM name="frmProduct" method="post" action="">
                            <DIV id="product">
                                <?php require_once("input.php") ?>
                            </DIV>
                            <DIV class="btn-action float-clear">
                                <input type="button" class="btn btn-primary" name="add_item" value="Add More" onClick="addMore();" />
                                <input type="button" class="btn btn-danger" name="del_item" value="Delete" onClick="deleteRow();" />
                                <span class="text-success"><?php
                                    if (isset($message)) {
                                        echo $message;
                                    }
                                    ?></span>
                                <span class="text-success"><?php
                                    if (isset($mailmessage)) {
                                        echo $mailmessage;
                                    }
                                    ?></span>
                            </DIV>
                            <hr></hr>
                            <DIV class="form-group">
                                <input type="submit" class="btn btn-success" name="save" value="Save" />
                            </DIV>
                        </FORM>
                        <?php } ?>    
                </div>
                <div class="col-md-5">
                </div>
            </div>
        </div>
        <hr></hr>
        <div class="container">           
            <footer>
                <p>&copy; 2015 Company, Inc.</p>
            </footer>
        </div> <!-- /container -->


        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
        <script src="js/bootstrap.min.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
