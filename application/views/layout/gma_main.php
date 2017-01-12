<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <!-- INSERT CSS HERE -->
    <?php 
    echo css_url('bootstrap.min');
    echo css_url('bootstrap-theme.min'); 
    echo css_url('design');
    echo css_url('design2');
    echo css_url('slick');
    echo css_url('slick.theme');
    echo css_url('toastr.min');
    echo css_url('custom');
    ?>


    <title><?php echo $metadata->getTitle(); ?></title>

</head>
<body>
    <?php echo show_notification() ?>
    <header class="navbar navbar-static-top bs-docs-nav navbar-default"  id="top" role="banner">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand logo" href="#">
                    <?php echo img_url("logo_jga.png","Logo","logo"); ?>
                </a>
                <a class="navbar-brand" href="#">JG Aviation</a>
        </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <nav class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Module 1<span class="sr-only">(current)</span></a></li>
                    <li><a href="#">Module 2</a></li>
                    <li><a href="#">Module 3</a></li>
                    <li><a href="#">Module 4</a></li>
                    <li><a href="#">Module 5</a></li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li class="divider"></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>
            </ul>
            <form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Search">
              </div>
              <button type="submit" class="btn btn-default">Submit</button>
            </form>
            <ul class="nav navbar-nav navbar-right">

                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><img src="<?php echo base_url(); ?>assets/img/user.png" width="20px";/></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                </ul>
            </li>
            <li><a href="#" class="navbar-link"><img class="disconnect" src="<?php echo base_url(); ?>assets/img/disconnect.png" width="20px";/> </a></li>
            </ul>
            </nav><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </header>



<div class="container-fluid">
 <div class="row-fluid">
    <div class="col-md-2">
      <nav class="well sidebar-nav">
            <!--<ul class="nav nav-list">
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
          </ul>-->
          <ul class="nav nav-pills nav-stacked">
              <li class="nav-header">Sidebar</li>
              <li role="presentation" class="active"><a href="#">Home</a></li>
              <li role="presentation" class="active"><a href="#">Profile</a></li>
              <li role="presentation"><a href="#">Messages</a></li>       
              <li class="nav-header">Sidebar</li>
              <li role="presentation"><a href="#">Home</a></li>
              <li role="presentation"><a href="#">Profile</a></li>
              <li role="presentation"><a href="#">Messages</a></li>       
              <li class="nav-header">Sidebar</li>
              <li role="presentation"><a href="#">Home</a></li>
              <li role="presentation"><a href="#">Profile</a></li>
              <li role="presentation"><a href="#">Messages</a></li>
          </ul>

      </nav><!--/.well -->
  </div>


  <div class="col-md-10">
    <div id="main">
      <ol class="breadcrumb">
          <li><a href="#">Home</a></li>
          <li><a href="#">Library</a></li>
          <li class="active">Data</li>
      </ol>
  </div>
  <div id="layout-content">
    <div class="row">
        <section class="col-md-9">
            <!-- VIEW LOADER HERE : -->
            <?php echo $contents; ?>
        </section>
        <aside class="col-md-3">
            <div class="list-group">
              <a href="#" class="list-group-item ">
                <h4 class="list-group-item-heading">Alerte n°1</h4>
                <p class="list-group-item-text">
                    Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                </a>
                <a href="#" class="list-group-item ">
                    <h4 class="list-group-item-heading">Alerte n°2</h4>
                    <p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                </a>
            </div>
        </aside>
    </div>
</div>
</div>
</div>
</div>


<footer >
    <div class="container-fluid">
     <div class="row-fluid">
        <div class="col-md-12">
            Copyright &copy; 2015
        </div>
    </div>
</div>
</footer>


</body>

<!-- INSERT JS HERE -->
<?php 
echo js_url('jquery');
echo js_url('bootstrap.min');
echo js_url('validator');
echo js_url('slick');
echo js_url('toastr.min');
echo js_url('script');
?>
</html>