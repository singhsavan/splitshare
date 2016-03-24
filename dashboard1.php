<?php
require_once('user_model.inc.php');
session_start();
if(!isset($_SESSION['user'])) {
    header("Location:login.php");
} else {
    $user = $_SESSION['user'];
}
    
?>


<html><head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head
        content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico">
        <title>Split N Share</title>
        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
        <!--[if lt IE 9]>
            <script src="../../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->
        <script src="../../assets/js/ie-emulation-modes-warning.js"></script>
    </head><body>
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

    </nav>        <!-- Main jumbotron for a primary marketing message or call to action
        -->
        <div class="jumbotron" style="background-color: white">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3" style="border: 1px solid #e3e3e3; background-color: white; padding: 0; height: 100vh; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                            <br>
                            <div class="col-md-6"></div>
                            <div id="dashboard" class="col-md-6 h4" style="padding-right: 0"><a href="dashboard1.php"><span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span> Dashboard</a></div> 
                            <br><br><br>
                            <div class="col-md-6"></div>
                            <div class="col-md-6" style="padding-right: 0">
                                <?php
                                $result = $user->get_groups();

                                if ($result->num_rows > 0) {
                                    ?>
                                    <table class="table table-condensed small table-hover">
                                        <thead>
                                            <tr>
                                                <th class="h5">Group Name</th>
                                            </tr>
                                        </thead>
                                        <tbody class="h5">
                                            <?php
                                            while ($row = $result->fetch_object()) {
                                                //echo $row->event_name, ' ' , $row->event_description, '<br>';
                                                //echo '<pre>', print_r($row[0]), '</pre>';
                                                print "<tr> <td>";
                                                ?> <a href="main.php?group=<?php echo $row->member_group; ?>"> <span class="glyphicon glyphicon-tag" aria-hidden="true"></span> <?php echo $row->member_group; ?></a>
                                                <?php
//                                    print "</td> </tr>";
                                                $result1 = $user->get_group_members($row->member_group);
                                                if ($result1->num_rows > 0) {
                                                    ?>
                                                <table class="table table-condensed small table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th class="h5">Member Name</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="h6">
                                                        <?php
                                                        while ($row = $result1->fetch_object()) {
                                                            print "<tr> <td>";
                                                            ?> <a href="main.php?group_member=<?php echo $row->member_name; ?>&group=<?php echo $row->member_group; ?>"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php echo $row->member_name; ?></a>
                                                            <?php
//                                                print "</td> </tr>";
                                                        }
                                                        ?>    
                                                    </tbody>
                                                </table>    
                                                <?php
                                            }

//                                    print "</td> <td>";
//                                    echo $row->first_name;
//                                    print "</td> <td>";
//                                    echo $row->last_name;
//                                    print "</td> <td>";
//                                    echo $row->email_id;
//                                    print "</td> </tr>";
                                        }
                                    } else {
                                        echo "<tr>";
                                        echo "<th width=150>No students attended. </th></tr>";
                                    }
                                    ?>
                                    </tbody>    
                                </table>
                            </div>    
                    </div>
                    <div id="mainblock" class="col-md-6" style="border: 1px solid #e3e3e3; background-color: white; height: 100vh; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                        <div class="row">
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Add a bill</h4>
                                        </div>
                                        <form role="form" data-toggle="validator" class="form-signin" method="post" action="navigate.php">
                                            <div class="modal-body">

                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Amount</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">$</div>
                                                        <input type="text" class="form-control" name="exampleInputAmount" id="exampleInputAmount" placeholder="Amount" required autofocus>
                                                        <div class="input-group-addon">.00</div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Description</label>
                                                    <input type="text" class="form-control" id="exampleInputdesc" name="exampleInputdesc" placeholder="Description" required>
                                                    <input type="hidden" class="form-control" name="exampleInputusername" value="<?php echo $user->get_username() ?>"></input>    
                                                    <input type="hidden" class="form-control" name="exampleInputgroupname" value="<?php echo $_GET['group'] ?>"></input>    
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputFile">File input</label>
                                                    <input type="file" id="exampleInputFile">
                                                    <p class="help-block">Example block-level help text here.</p>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <input type="submit" name="op" class="btn btn-primary" value="Submit"></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12" id="groupexpense" style="padding-top: 2%; padding-bottom: 2%; background-color: #e3e3e3;border-bottom: solid 1px #ccc;">
                                <div class="col-md-8 text-success h4">Dashboard</div>
                                <div class="col-md-2"><button type="button" id="addbill_button" class="btn btn-danger" data-toggle="modal" data-target="#myModal"  disabled="disabled" title="Click on group to add bill"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Add a bill</button></div>
                                <div class="col-md-2"><button type="button" id="settleup_button" class="btn btn-success"  disabled="disabled" title="Click on group to settle up"><span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span> Settle Up</button></div>
                                <!--                                <div class="btn-group pull-right">
                                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Add a bill</button>
                                                                    <button type="button" class="btn btn-success"><span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span> Settle Up</button>
                                                                </div>    -->
                            </div>
                            <div class="col-md-12" style="background-color: #e3e3e3; border-bottom: solid 1px #ccc">
                            
                            <?php
                            $user_name = $user->get_username();
                        $balance = $user->get_memberbalance($user_name);
                        if ($balance->num_rows > 0) {
                            while ($row = $balance->fetch_object()) {
                                ?>
                                <div class="col-md-4 text-center" ><div class="row">Total balance</div>
                                <div class="row text-success h4">$ <?php echo $row->total_balance;
                                ?></div></div>
                                <?php
                                if ($row->balance_value < 0) { ?>
                                <div class="col-md-4 text-center" style="border-left: solid 1px #ccc"><div class="row">You owe</div>
                                <div class="row text-success h4">$ <?php echo "0";
                                ?></div></div>
                                <div class="col-md-4 text-center" style="border-left: solid 1px #ccc"><div class="row">You are owed</div>
                                <div class="row text-success h4">$ <?php echo $row->balance_value;
                                ?></div></div>
                                <?php
                                } else if ($row->balance_value > 0) { ?>
                                <div class="col-md-4 text-center" style="border-left: solid 1px #ccc"><div class="row">You owe</div>
                                <div class="row text-success h4">$ <?php echo $row->balance_value;
                                ?></div></div>
                                <div class="col-md-4 text-center" style="border-left: solid 1px #ccc"><div class="row">You are owed</div>
                                <div class="row text-success h4">$ <?php echo "0";
                                ?></div></div> 
                                <?php }

                            }
                        }
                        ?>
                            </div>
                        </div>  
                    </div>
                    <div class="col-md-3" style="border: 1px solid #e3e3e3; background-color: white; padding: 0; height:100vh; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                        <br></br><br></br>
                        
                    </div>
                </div>
            </div>
            <div class="container">           
                <footer>
                    <p>&copy; 2015 Company, Inc.</p>
                </footer>
            </div>
        </div>
            
        
        
        <!-- /container -->
        <!-- Bootstrap core JavaScript==================================================-
        ->
    <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script>
            window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')
        </script>
        <script src="js/bootstrap.min.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
       <script>
           
       $("#dashboard")
       .on( "click", function() {
    var styles = {
      backgroundColor : "#ddd",
      fontWeight: ""
    };
    $( this ).css( styles );
  });
       </script>
    
</body></html>