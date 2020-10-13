<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
<style>
 body.login{ background:#f4f4f4; font-family:Arial, Helvetica, sans-serif;}
 body.login .main-login {
    margin-bottom: 50px;
    margin-top: 10%;
}
body.login .logo {
	padding: 20px;
	text-align: center;
}
body.login .box-login, body.login .box-forgot, body.login .box-register {
margin-bottom: 20px;
    background-color: #ffffff;
    border: 1px solid transparent;
    -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
    border-color: #dddddd;
    border-radius: 0px;
    width: 274px;
    margin: auto;
    margin-top: 15%;
    padding: 33px 36px 21px;
    margin-bottom: 19px;
}
body.login .box-login img {       margin: 0 auto 18px;
    display: block;}
body.login .box-login input[type="text"], body.login .box-login input[type="password"] {
    display: block;
    width: 100%;
    padding: 8px 0;
    text-indent: 15px;
    font-size: 14px;
    line-height: 1.428571429;
    color: #555555;
    vertical-align: middle;
    margin-top: 13px;
    background-color: #ffffff;
    border: 1px solid #cccccc;
    box-sizing: border-box;
}
body.login .box-login input[type="text"]:focus, body.login .box-login input[type="password"]:focus {
    border-color: rgba(175, 45, 45, 0.5) !important;
    box-shadow: 0 0 6px 0 rgba(175, 45, 45, 0.3);
    outline: 0 none;
}

body.login .box-login .login-button{
border-color: #b20000;
    background-color: #b20000;
    color: #ffffff;
    width: 100%;
    padding: 12px 0px;
    border: 1px solid #b20000;
    display: block;
    margin-top: 19px;
    margin-bottom: 10px;
	cursor:pointer;
}
.help-block {font-size: 12px;
    color: #e00606;
    margin: 5px 0px; }
</style>
</head>

<body class="login">

        <div class="box-login">
           <img src="<?= $this->theme->baseUrl; ?>/images/login-logo.png" />
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
            <?= $form->field($model, 'username')->textInput(['autofocus' => true,'placeholder' => 'Username'])->label(false); ?>
            <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Password'])->label(false); ?>
            <?= Html::submitButton('Login', ['class' => 'btn login-button', 'name' => 'login-button']) ?>
        
           <?php ActiveForm::end(); ?>
        </div>
        <p style="text-align:center; color:#333333; font-size:12px; ">© <?php echo date('Y');?>  ePaper. All Rights Reserved.<br />Powered by 92newhd</p>

</body>
</html>
