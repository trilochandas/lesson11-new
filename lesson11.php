<script type="text/javascript" src="jquery.min.js"></script>
<!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script> -->
<?php
header('Content-Type: text/html; charset=utf-8');

ini_set('display_errors', '1');
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
// phpinfo();
$project_root = $_SERVER['DOCUMENT_ROOT'];
# include dbsimple
require_once $project_root."/dbsimple/config.php";
require_once $project_root."/dbsimple/DbSimple/Generic.php";

# include smarty
require('Smarty/libs/Smarty.class.php');
$smarty = new Smarty();
$smarty->compile_check = true;
$smarty->debugging = false;

$smarty_dir = $project_root . '/smarty/' ;

$smarty->template_dir = $smarty_dir . 'templates';
$smarty->compile_dir = $smarty_dir . 'templates_c';
$smarty->cache_dir = $smarty_dir . 'cache';
$smarty->config_dir = $smarty_dir . 'configs';

$smarty->assign('error', '');


// // Подключаемся к БД.
// $db = DbSimple_Generic::connect('mysql://root:123@localhost/xaver');

// // Устанавливаем обработчик ошибок.
// $db->setErrorHandler('databaseErrorHandler');

// // Код обработчика ошибок SQL.
// function databaseErrorHandler($message, $info)
// {
//     // Если использовалась @, ничего не делать.
//     if (!error_reporting()) return;
//     // Выводим подробную информацию об ошибке.
//     echo "SQL Error: $message<br><pre>"; 
//     print_r($info);
//     echo "</pre>";
//     exit();
// }

class MysqlWorker
{
    protected static $instance = NULL;
    public $connection = NULL;

    public function getInstance()
    {
        if( self::$instance == NULL )
        {
          self::$instance = new MysqlWorker();
        }
        return self::$instance;
    }

    private function __construct()
    {
        $this->connection = DbSimple_Generic::connect( 'mysql://root:123@localhost/xaver' );
        $this->connection->setErrorHandler( array($this,'mysqlErrorHandler') );
        $this->connection->query( "SET NAMES 'utf8'" );
    }
}

class Advert {
    public $private;
    public $seller_name;
    public $email;
    public $allow_mails;
    public $phone;
    // public $city;
    // public $metro;
    // public $category_id;
    public $title;
    public $description;
    public $price;

    public $vars;

    function __construct($post){
        $this->private = $post['private'];
        $this->seller_name = $post['seller_name'];
        $this->email = $post['email'];
        if ( !isset($post['allow_mails']) ) {
            $this->allow_mails = 0;
        } else {
            $this->allow_mails = $post['allow_mails'];
        }
        // $this->allow_mails = (!isset($post['allow_mails']) ? 0 : 1;
        
        $this->phone = $post['phone'];
        // $this->city = $post['city'];
        // $this->metro = $post['metro'];
        // $this->category_id = $post['category_id'];
        $this->title = $post['title'];
        $this->description = $post['description'];
        $this->price = $post['price'];

    }

    private function getVars() {
        $this->vars = get_object_vars($this);
        array_pop($this->vars);
    }

    public function save() {
        self::getVars();
        $db = MysqlWorker::getInstance()->connection;
        $db->query('INSERT INTO adverts SET ?a', $this->vars); // here i have problem. need $this->vars

    }

    public function reSave($id) {
        self::getVars();
        $db = MysqlWorker::getInstance()->connection;
        $db->query("UPDATE adverts SET ?a WHERE id=?", $this->vars, $id);
    }
}

$conn1 = MysqlWorker::getInstance()->connection;


// if form was submit
if ($_POST['main_form_submit']) {
    // update advert
    if (isset($_GET['id'])) {
        $id = (int) $_GET['id'];
        array_pop($_POST);
        $adv = new Advert($_POST);
        $adv->reSave($id);
    // add advert
    } else {
        array_pop($_POST);
        $adv = new Advert($_POST);
        $adv->save();
    }
}

// delete advert
if ($_GET['del']) {
    $id = (int) $_GET['del'];
    $conn1->query('DELETE FROM adverts WHERE id=?', $id);
}

// insert advert to form
if ( isset($_GET['id']) ) {
    $id = (int) $_GET['id'];
    $advertForForm = $conn1->query('SELECT * FROM adverts WHERE id=?', $id);
    foreach ($advertForForm[0] as $key => $value) 
        $$key = $value;
    $allow_mails = ( $allow_mails == 1 ) ? 'checked' : '';
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
}

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

// outputing all adverts
// geting all adverts from database
$advert_output_table = $conn1->query('SELECT * FROM adverts');
$smarty->assign('advert_output_table', $advert_output_table);

$smarty->display('lesson11.tpl');



?>