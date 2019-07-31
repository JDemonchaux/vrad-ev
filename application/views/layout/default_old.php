<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <!-- INSERT CSS HERE -->
    <?php 
    echo css_url('bootstrap.min');
    echo css_url('bootstrap-theme.min'); 
    echo css_url('design');
    echo css_url('slick');
    echo css_url('slick.theme');
    echo css_url('toastr.min');
    ?>


    <title><?php echo $metadata->getTitle(); ?></title>

</head>
<body>
    <?php echo show_notification() ?>

    <header class="navbar navbar-static-top bs-docs-nav navbar-default navbar-inverse"  id="top" role="banner">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">
            <img alt="Brand" src="...">
        </a>
        <a class="navbar-brand" href="#">Entreprise NOM</a>
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
    <li><a href="#">Link</a></li>
    <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
      <ul class="dropdown-menu" role="menu">
        <li><a href="#">Action</a></li>
        <li><a href="#">Another action</a></li>
        <li><a href="#">Something else here</a></li>
        <li class="divider"></li>
        <li><a href="#">Separated link</a></li>
    </ul>
</li>
</ul>
</nav><!-- /.navbar-collapse -->
</div><!-- /.container-fluid -->
</header>
<div id="main">
    <div class="row">
      <ol class="breadcrumb">
          <li><a href="#">Home</a></li>
          <li><a href="#">Library</a></li>
          <li class="active">Data</li>
          <!-- TODO à revoir !! 
          <ul class="list-unstyled navbar-nav navbar-right">
            <li><a href="#" >lien autre 1</a></li>
            <li><a href="#" >lien autre 2</a></li>
        </ul>
    -->
    </ol>
</div>


<div class="row">
  <div class="col-md-2">
    <nav id="menu-Module" class="list-group">
<ul class="nav nav-pills nav-stacked">
  <li role="presentation"><a class="list-group-item" href="#">Action 1</a></li>
 <li role="presentation"><a  class="list-group-item active" href="#">Action 2</a></li>
  <li role="presentation"><a class="list-group-item" href="#">Action 3</a></li>
  <li role="presentation"><a class="list-group-item" href="#">Action 4</a></li>
</ul>
    </nav>
</div>


<div class="col-md-10">
    <section id="layout-content">
        <div class="row">
          <div class="col-md-9">
           <!-- VIEW LOADER HERE : -->
           <?php echo $contents; ?>
       </div>
       <div class="col-md-3">
        <aside>
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


</section>
</div>
</div>


<footer >
<!-- TODO -->
          <ul class="list-unstyled navbar-nav">
            <li><a href="#">Copyright &copy; 2015</a></li>
            <li><a href="#">footer 1</a></li>
            <li><a href="#">footer 2</a></li>
            <li><a href="#">footer 3</a></li>
            <li><a href="#">footer 4</a></li>
            <li><a href="#">footer 5</a></li>
        </ul>

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
