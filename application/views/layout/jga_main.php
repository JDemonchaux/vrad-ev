<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>JGA</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<!-- Le styles -->
		<link href="<?php echo base_url(); ?>assets/css/otherBST/bootstrap.css" rel="stylesheet">

		<link href="<?php echo base_url(); ?>assets/css/otherBST/bootstrap-responsive.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>assets/css/otherBST/template.css" rel="stylesheet">
		<!--<link rel="stylesheet" href="http://localhost/JGA_last/jga/assets/css/Global.css" type="text/css">-->

		<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		  <script src="<?php echo base_url(); ?>assets/js/html5shiv.js"></script>
		<![endif]-->

		<!-- Fav and touch icons -->
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url(); ?>assets/ico/apple-touch-icon-144-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url(); ?>assets/ico/apple-touch-icon-114-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url(); ?>assets/ico/apple-touch-icon-72-precomposed.png">
		<link rel="apple-touch-icon-precomposed" href="<?php echo base_url(); ?>assets/ico/apple-touch-icon-57-precomposed.png">
		<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/ico/favicon.png">
		<style type="text/css"></style>
	</head>

	<body>

    <div class="navbar navbar navbar-fixed-top">
      <div class="navbar-inner">
          <a class="brand" href="#">
			<img class="logo" src="<?php echo base_url(); ?>assets/img/logo_jga.png" height="40px";/> 
		  </a>
            <p class="navbar-text pull-right">
              <a href="#" class="navbar-link"><img class="disconnect" src="<?php echo base_url(); ?>assets/img/disconnect.png" width="40px";/> </a>
            </p>
			<ul class="nav pull-right">
			  <li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				  <img src="<?php echo base_url(); ?>assets/img/user.png" width="40px";/>  
				</a>
				<ul class="dropdown-menu">
					<li>
						UserName
					</li>
					<li>
						UserName
					</li>
					<li>
						UserName
					</li>
				</ul>
			  </li>
			</ul>
            <ul class="nav">
              <!--<li class="active"><a href="#">Home</a></li>
              <li><a href="#about">About</a></li>
              <li><a href="#contact">Contact</a></li>-->
            </ul>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span2">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">Sidebar</li>
              <li class="active"><a href="#">Link</a></li>
              <li><a href="#">Link</a></li>
              <li><a href="#">Link</a></li>
              <li><a href="#">Link</a></li>
              <li class="nav-header">Sidebar</li>
              <li><a href="#">Link</a></li>
              <li><a href="#">Link</a></li>
              <li><a href="#">Link</a></li>
              <li><a href="#">Link</a></li>
              <li><a href="#">Link</a></li>
              <li><a href="#">Link</a></li>
              <li class="nav-header">Sidebar</li>
              <li><a href="#">Link</a></li>
              <li><a href="#">Link</a></li>
              <li><a href="#">Link</a></li>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span10">
			<ul class="breadcrumb">
			  <li><a href="#">Home</a> <span class="divider">/</span></li>
			  <li><a href="#">Library</a> <span class="divider">/</span></li>
			  <li class="active">Data</li>
			</ul>
			<div class="bs-docs-example">
			  <div class="alert alert-block alert-error fade in">
				<button type="button" class="close" >×</button>
				X Alerte(s) ont été trouvée(s) !
			  </div>
			  <div class="test" style="display:none;   border-color: #eed3d7; margin-top:-20px;">
				blabla
			  </div>
			</div>
			<div class="page-header">
			  <h1>Liste des Aeronefs <small>texte(exemple immat en cours)</small></h1>
			</div>
			<div id="divBlocModule">
				Recherche :
				<form class="form-inline">
				  <input type="text" class="input-small" placeholder="Email">
				  <input type="password" class="input-small" placeholder="Password">
				  <label class="checkbox">
					<input type="checkbox"> Remember me
				  </label>
				  <button type="submit" class="btn">Sign in</button>
				</form>			
			</div>
        </div><!--/span-->
      </div><!--/row-->
      <hr>

      <footer>
        <p>© Company 2013</p>
      </footer>

    </div><!--/.fluid-container-->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

	<script src="<?php echo base_url(); ?>assets/js/jquery-2.1.3.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
	<script>
		$( ".close" ).click(function() {
		  if($(".test").css("display") == "none")
		  {
		      $(".test").css({
				  "display": "block",
				});
		  }
		  else
		  {
			$(".test").css({
				  "display": "none",
				});
		  }
		});
	</script>


  

	</body>
</html>