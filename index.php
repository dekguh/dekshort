<?php
require_once("func/func.short.php");

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?=TITLEWEB?></title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container">
    <?php
    if(@$_POST["short"]){
        $url = $_POST["url"];
        if(!empty($url) AND checkurl($url) == true){
            $short = acak(rand(5,6));
            $ekse = makeshort($con,$url,$short);
            $stt = "<div class='alert alert-info'>Your short url : <b>".$_SERVER["SERVER_NAME"]."/".$ekse."</b></div>";
        }else{
            $stt = "<div class='alert alert-info'>Form empty or link not valid</div>";
        }
    }
    ?>
    	<div class="row">
    		<div class="col-lg-2"></div>
    		<div class="col-lg-8">
            <?=@$stt?>
    			<div class="panel panel-default">
    				<div class="panel-body">

    					<form method="post">

    						<div class="row">
    							<div class="col-lg-10">
    								<div class="form-group">
    									<input type="text" class="form-control" name="url" placeholder="https://dekguh.info">
    								</div>
    							</div>

    							<div class="col-lg-2">
    								<input type="submit" class="btn btn-success btn-block" value="Short" name="short">
    							</div>
    						</div>

    					</form>

    				</div>
    			</div>
    		</div>
    		<div class="col-lg-2"></div>
    	</div>

    	<div class="row">
    		<div class="col-lg-2"></div>
    		<div class="col-lg-8">
    			<div class="panel panel-default">
    				<div class="panel-heading">Latest Short</div>
    				<div class="panel-body">
    					<table class="table">
                        <?php
                        $list = mysqli_query($con,"SELECT * FROM short ORDER BY tanggal DESC LIMIT 0,5");
                        $i=1;
                        foreach($list as $data){
                            echo "
                                <tr>
                                    <td>".date("d-m-Y h:i a",$data["tanggal"])."</td> <td><a href='".$_SERVER["SERVER_NAME"]."/".$data["short"]."'>".$_SERVER["SERVER_NAME"]."/".$data["short"]."</a></td> <td>".$data["url"]."</td>
                                </tr>
                            ";
                            $i++;
                        }
                        ?>
    					</table>
    				</div>
    			</div>
    		</div>
    		<div class="col-lg-2"></div>
    	</div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

  </body>
</html>