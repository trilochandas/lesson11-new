<?php /* Smarty version 2.6.28, created on 2015-07-27 16:49:31
         compiled from lesson11.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'lesson11.tpl', 55, false),)), $this); ?>
<?php echo '
<style>
table{
    border: 1px;
    border-collapse: collapse;
    text-align: center;
}
td{
    border: 1px solid;
    padding: 10px;
}
form{width: 500px; float: left; margin-right: 3em;}
input:not([type="radio"]), select, textarea {
    float: right;
}
input{
    margin: 3px 0;
}
input[type=\'text\'], select, textarea{
    width: 175px;
}
.form-row {
    margin: 10px 0;
    clear: both;
}

</style>
'; ?>

<!-- action="formFunctions.php?action=addAdverts" -->
<a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>
">self</a>

<div class="cont"></div>
<p style="color:red;"><?php echo $this->_tpl_vars['error']; ?>
</p>
<form  method="POST" >
    <div class="form-row-indented"> 
        <label><input type="radio" <?php if ($this->_tpl_vars['private'] == 1): ?> <?php echo 'checked'; ?>
 <?php endif; ?>  value="1" name="private">Частное лицо</label> 
        <label><input type="radio" <?php if ($this->_tpl_vars['private'] == 0): ?> <?php echo 'checked'; ?>
 <?php endif; ?> value="0" name="private">Компания</label> 
    </div>
    <div class="form-row"> 
        <label for="fld_email">Электронная почта</label>
        <input type="text" class="form-input-text" value="<?php echo $this->_tpl_vars['email']; ?>
" name="email" id="fld_email">
    </div>
    <br>
    <div class="form-row-indented"> 
        <label  for="allow_mails">
        <input type="checkbox" <?php echo $this->_tpl_vars['allow_mails']; ?>
 value="1" name="allow_mails" id="allow_mails" ><span>Я не хочу получать вопросы по объявлению по e-mail</span>
        </label> 
    </div>
    <div class="form-row"> 
        <label for="fld_phone" class="form-label">Номер телефона</label>
        <input type="text"  value="<?php echo $this->_tpl_vars['phone']; ?>
" name="phone" id="fld_phone">
    </div>
    <div id="f_location_id" class="form-row "> 
    <label for="region" class="form-label">Город</label> 
        <?php echo smarty_function_html_options(array('name' => 'city','options' => $this->_tpl_vars['citys'],'selected' => $this->_tpl_vars['city']), $this);?>

    </div>
    <div id="f_metro_id" class="form-row "> 
        <label for="metro_id" class="form-label">Метро</label>
        <?php echo smarty_function_html_options(array('name' => 'metro','options' => $this->_tpl_vars['metro1'],'selected' => $this->_tpl_vars['metro']), $this);?>

    </div>
    <div class="form-row "> 
        <label for="category_id" >Категория</label>
        <?php echo smarty_function_html_options(array('name' => 'category_id','options' => $this->_tpl_vars['categorys'],'selected' => $this->_tpl_vars['category_id']), $this);?>

    </div> 
    <div class="form-row"> 
        <label for="fld_seller_name"><b> Ваше имя</b></label>
        <input type="text" maxlength="40" value="<?php echo $this->_tpl_vars['seller_name']; ?>
" name="seller_name" id="fld_seller_name">
    </div>
    <div id="f_title" class="form-row f_title"> 
        <label for="fld_title" >Название объявления</label> 
        <input maxlength="50" value="<?php echo $this->_tpl_vars['title']; ?>
" name="title" id="fld_title" type="text"> 
    </div>
    <div class="form-row"> 
        <label for="fld_description">Описание объявления</label> 
        <textarea maxlength="3000" name="description" id="fld_description" ><?php echo $this->_tpl_vars['description']; ?>
</textarea> 
    </div>
    <div id="price_rw" class="form-row rl"> 
        <label for="fld_price" >Цена</label> 
        <input maxlength="9" value="<?php echo $this->_tpl_vars['price']; ?>
" placeholder="0" name="price" id="fld_price" type="text">&nbsp;<span>руб.</span>
    </div>
    <div>
        <input type="submit" value="Отправить" name="main_form_submit" >
        <!-- <button type="submit" name="main_form_submit" >SUBMIT!</button> -->
    </div>
    <br>
    <br>
    </form>   
    <h2>Все объявления</h2>
    <table>
        <tr>
            <td>Название объявления</td>
            <td>Цена</td>
            <td>Имя продавца</td>
            <td>Удалить</td>
        </tr>

    <?php $_from = $this->_tpl_vars['advert_output_table']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
        <tr>
            <td><a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>
?id=<?php echo $this->_tpl_vars['v']['id']; ?>
"><?php echo $this->_tpl_vars['v']['title']; ?>
</a></td>
            <td><?php echo $this->_tpl_vars['v']['price']; ?>
</td> 
            <td><?php echo $this->_tpl_vars['v']['seller_name']; ?>
</td> 
            <td><a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>
?del=<?php echo $this->_tpl_vars['v']['id']; ?>
" class="delete" data-del="<?php echo $this->_tpl_vars['v']['id']; ?>
">Удалить</a></td> 
       </tr>
    <?php endforeach; endif; unset($_from); ?>
    </table>