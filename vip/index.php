<?php
require_once("../func/func.short.php");

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
    <link href="../css/bootstrap.min.css" rel="stylesheet">

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
  	if(!empty($_SESSION["username"]) AND !empty($_SESSION{"password"})){

      if(@$_GET["page"] == "logout"){
        session_destroy();
        header("location: index.php");
      }
    ?>
    <div class="row">
      <div class="col-lg-3">
        <ul class="list-group">
          <li class="list-group-item"><a href="./">Home</a></li>
          <li class="list-group-item"><a href="./index.php?page=logout">Logout</a></li>
        </ul>
      </div>
      <?php
      if(@$_POST["short"]){
          $url = $_POST["url"];
          if(!empty($url) AND checkurl($url) == true){

              if(!empty($_POST["shortcode"])){
                $postshort = htmlentities(trim($_POST["shortcode"]));
                $checkshort = checkshort($con,$postshort);
                if($checkshort == 0){
                  $ekse = makeshort($con,$url,$postshort);
                  $stt = "<div class='alert alert-info'>Your short url : <b>".$_SERVER["SERVER_NAME"]."/".$ekse."</b></div>";
                }else{
                  $stt = "<div class='alert alert-info'>short already used</div>";
                }
              }else{
                $short = acak(rand(5,6));
                $ekse = makeshort($con,$url,$short);
                $stt = "<div class='alert alert-info'>Your short url : <b>".$_SERVER["SERVER_NAME"]."/".$ekse."</b></div>";
              }
              
          }else{
              $stt = "<div class='alert alert-info'>Form empty or link not valid</div>";
          }
      }
      ?>
      <div class="col-lg-9">
        <div class="row">
          <div class="col-lg-12">
            <div class="panel panel-default">
              <div class="panel-body">
              <?=@$stt?>
                <form method="post">

                  <div class="row">
                    <div class="col-lg-7">
                      <div class="form-group">
                        <input type="text" class="form-control" name="url" placeholder="url" />
                      </div>
                    </div>

                    <div class="col-lg-3">
                      <div class="form-group">
                        <input type="text" class="form-control" name="shortcode" placeholder="short (leave blank for auto)" />
                      </div>
                    </div>

                    <div class="col-lg-2">
                      <div class="form-group">
                        <input type="submit" value="short" name="short" class="btn btn-success btn-block">
                      </div>
                    </div>
                  </div>

                </form>
              </div>
            </div>
          </div>
        </div> 

        <div class="row">
          <div class="col-lg-12">
          <?php
            $pageshow = 5;

            if($_GET["page"] <= 1 or empty($_GET["page"])){
              $page = 0;
            }elseif(isset($_GET["page"])){
              $page = $_GET["page"] - 1;
            }

            $pageoffset = $page*$pageshow;

            if(@$_POST["delete"]){
              $shortid = $_POST["shortid"];
              $del = mysqli_prepare($con,"DELETE FROM short WHERE short = ?");
              mysqli_stmt_bind_param($del,"s",$shortid);
              mysqli_stmt_execute($del);
            }

            $listshort = mysqli_prepare($con,"SELECT * FROM short ORDER BY tanggal DESC LIMIT ?,?");
            mysqli_stmt_bind_param($listshort,"ss",$pageoffset,$pageshow);
            mysqli_stmt_execute($listshort);
            $listshort = mysqli_stmt_get_result($listshort);
          ?>
            <table class="table table-bordered">
              <tr>
                <th>URL</th> <th>SHORT</th> <th>ACTION</th>
              </tr>

              <?php
                foreach($listshort as $data){
                  echo "
                  <tr>
                    <td>".$data["url"]."</td>
                    <td>".$_SERVER["SERVER_NAME"]."/".$data["short"]."</td>
                    <td align='center'>
                      <form method='post'>
                        <input value='".$data["short"]."' type='hidden' name='shortid' />
                        <input type='submit' value='X' name='delete' class='btn btn-danger btn-xs' />
                      </form>
                    </td>
                  </tr>
                  ";
                }
              ?>
            </table>

            <ul class="pager">
            <?php
              $totaldata = mysqli_query($con,"SELECT * FROM short");
              $totaldata = mysqli_num_rows($totaldata);
              $totalpage = ceil($totaldata/$pageshow);

              if($totalpage > 1){

                //prev
                if(@$_GET["page"] <= 1 or empty($_GET["page"])){
                  echo "<li class='disabled'><a href='#'>Previous</a></li>";
                }elseif($_GET["page"] > 1){
                  $position = $_GET["page"]-1;
                  echo "<li class=''><a href='./index.php?page=".$position."'>Previous</a></li>";
                }

                //next
                if($totalpage <= 1 or $_GET["page"] >= $totalpage){
                  echo "<li class='disabled'><a href='#'>Next</a></li>";
                }else{
                  if($_GET["page"] <= 1 or empty($_GET["page"])){
                    $position = 1+1;
                    echo "<li class=''><a href='./index.php?page=".$position."'>Next</a></li>";
                  }else{
                    $position = $_GET["page"]+1;
                    echo "<li class=''><a href='./index.php?page=".$position."'>Next</a></li>";
                  }
                }


              }
            ?>
            </ul>
          </div>
        </div>
      </div>

    </div>
    <?php
    }else{

		if(@$_POST["login"]){
			if($_POST["user"] == USERNAME AND $_POST["pass"] == PASSWORDUSER){
				$_SESSION["username"] = $_POST["user"];
				$_SESSION["password"] = $_POST["pass"];
				header("location: index.php");
			}
		}
	?>
	<div class="row">
  		<div class="col-lg-4"></div>
  		<div class="col-lg-4">
  			<div class="panel panel-default">
  				<div class="panel-body">
  					<form method="post">
  						<div class="form-group">
  							<input type="text" class="form-control" name="user" placeholder="username">
  						</div>

  						<div class="form-group">
  							<input type="password" class="form-control" name="pass" placeholder="password">
  						</div>

  						<div class="form-group">
  							<input type="submit" class="btn btn-info btn-block" name="login" value="login" />
  						</div>
  					</form>
  				</div>
  			</div>
  		</div>
  		<div class="col-lg-4"></div>
  	</div>
	<?php
	}
  ?>
  	
  </div>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
  </body>
  </html>