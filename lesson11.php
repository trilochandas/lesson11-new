<script type="text/javascript" src="jquery.min.js"></script>
<!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script> -->
<?php
header('Content-Type: text/html; charset=utf-8');

ini_set('display_errors', '1');
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
// phpinfo();
$project_root = $_SERVER['DOCUMENT_ROOT'];
$project_dir = __DIR__;
# include dbsimple
require_once $project_root."/dbsimple/config.php";
require_once $project_root."/dbsimple/DbSimple/Generic.php";

# include smarty
require('Smarty/libs/Smarty.class.php');
$smarty = new Smarty();
$smarty->compile_check = true;
$smarty->debugging = false;

$smarty_dir = $project_dir . '/smarty/' ;

$smarty->template_dir = $smarty_dir . 'templates';
$smarty->compile_dir = $smarty_dir . 'templates_c';
$smarty->cache_dir = $smarty_dir . 'cache';
$smarty->config_dir = $smarty_dir . 'configs';

$smarty->assign('error', '');

// including all classes 
include_once($project_dir . '/classes.php');

// adding all selects to form
Advert::getSelects();

// if form was submit
if (isset($_POST['main_form_submit'])) {
    // update advert
    if (isset($_GET['id'])) {
        $id = (int) $_GET['id'];
        $adv = new Advert($_POST);
        $adv->reSave($id);
    // add advert
    } else {
        $adv = new Advert($_POST);
        $adv->save();
    }
}

// delete advert
if (isset($_GET['del'])) {
    Advert::deleteAdvert();
}

// insert advert to form
if ( isset($_GET['id']) ) {
    Advert::advertForForm();
} else {
    $title='';
    $price='';
    $seller_name='';
    $description='';
    $phone='';
    $email='';
    $allow_mails='';
    $private='';
    $city='';
    $metro='';
    $category_id='';

    $smarty->assign('private', $private);
    $smarty->assign('seller_name', $seller_name);
    $smarty->assign('email', $email);
    $smarty->assign('allow_mails', $allow_mails);
    $smarty->assign('phone', $phone);
    $smarty->assign('city', $city);
    $smarty->assign('metro', $metro);
    $smarty->assign('title', $title);
    $smarty->assign('description', $description);
    $smarty->assign('price', $price);
    $smarty->assign('category_id', $category_id);
}



// outputing all adverts
// geting all adverts from database
Advert::advert_output_table();

$smarty->display('lesson11.tpl');



?>