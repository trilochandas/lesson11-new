<?php 

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
        if (file_exists('test.txt')) {
            $loginConfig = unserialize( file_get_contents('test.txt') );
        } else {
            header('Location: install.php');
        }
        $this->connection = DbSimple_Generic::connect( "mysql://{$loginConfig['username']}:{$loginConfig['password']}@{$loginConfig['host']}/{$loginConfig['db']}" );
        $this->connection->setErrorHandler('mysqlErrorHandler');
        function mysqlErrorHandler($message, $info) {
            // Если использовалась @, ничего не делать.
            if (!error_reporting()) return;
            // Выводим подробную информацию об ошибке.
            echo "SQL Error: $message<br><pre>"; 
            print_r($info);
            echo "</pre>";
            exit();
        }
        $this->connection->query( "SET NAMES 'utf8'" );
    }
}

class Advert {
    public $private;
    public $seller_name;
    public $email;
    public $allow_mails;
    public $phone;
    public $city;
    public $metro;
    public $category_id;
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
        $this->city = $post['city'];
        $this->metro = $post['metro'];
        $this->category_id = $post['category_id'];
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
        // header("Refresh: 0; {$_SERVER['PHP_SELF']}");
        header("Location: {$_SERVER['PHP_SELF']}");
    }

    public static function getSelects() {
        global $smarty;
        $db = MysqlWorker::getInstance()->connection;
        $selects = $db->query("SELECT * FROM select_meta");
        $citys = json_decode($selects[0]['options'], true);
        $smarty->assign('citys', $citys);
        $metro = json_decode($selects[1]['options'], true);
        $smarty->assign('metro1', $metro);
        $categ = json_decode($selects[2]['options'], true);
        $smarty->assign('categorys', $categ);
    }

    public static function deleteAdvert() {
        $db = MysqlWorker::getInstance()->connection;
        $id = (int) $_GET['del'];
        $db->query('DELETE FROM adverts WHERE id=?', $id);
    }

    public static function advert_output_table() {
        global $smarty;
        $db = MysqlWorker::getInstance()->connection;
        $advert_output_table = $db->query('SELECT * FROM adverts');
        $smarty->assign('advert_output_table', $advert_output_table);
    }

    public static function advertForForm() {
        global $smarty;
        $db = MysqlWorker::getInstance()->connection;
        $id = (int) $_GET['id'];
        $advertForForm = $db->query('SELECT * FROM adverts WHERE id=?', $id);
        // var_dump($advertForForm[0]);
        foreach ($advertForForm[0] as $key => $value) 
            $$key = $value;
        $allow_mails = ( $allow_mails == 1 ) ? 'checked' : '';

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
}