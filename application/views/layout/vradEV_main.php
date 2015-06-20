<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <?php
    echo css_url('bootstrap.min');
    echo css_url('bootstrap-theme.min');
    echo css_url('design');
    echo css_url('slick');
    echo css_url('slick-theme');
    echo css_url('toastr.min');
    ?>


    <title>VRAD-EV</title>

</head>
<body>
<?php if (is_connected()) {
    include("menu.php");
} ?>
<?php echo show_notification() ?>
<?php echo $contents; ?>
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
