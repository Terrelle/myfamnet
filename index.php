<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
if(isset($_SESSION['Username'])){
    header("location: home");
}
$getLang = trim(filter_var(htmlentities($_GET['lang']),FILTER_SANITIZE_STRING));
if (!empty($getLang)) {
$_SESSION['language'] = $getLang;
}
// ========================= config the languages ================================
error_reporting(E_NOTICE ^ E_ALL);
if (is_file('home.php')){
    $path = "";
}elseif (is_file('../home.php')){
    $path =  "../";
}elseif (is_file('../../home.php')){
    $path =  "../../";
}
include_once $path."langs/set_lang.php";
?>
<html dir="<? echo lang('html_dir'); ?>">
<head>
    <title><? echo lang('welcome'); ?> to Myfamnet</title>
    <meta charset="UTF-8">
    <meta name="description" content="Myfamnet is a platform to share your interests with the people you care about.">
    <meta name="keywords" content="homepage,main,login,social network,social media,Myfamnet,meet,free platform">
    <meta name="author" content="Terrelle Tettey">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "includes/head_imports_main.php";?>
</head>
    <body class="login_signup_body">
    <!--============[ Nav bar ]============-->
        <div class="login_signup_navbar">
                <a href="index" style="font-size:37px;padding: 19px 10px;color:#CC0033;font-family: Trebuchet MS,Lucida Grande,Lucida Sans Unicode,Lucida Sans,Tahoma,sans-serif;" class="login_signup_navbarLinks">myfamnet</a>
                
               <!-- <div style="float: <? echo lang('float2'); ?>;">
                    <a href="login" class="login_signup_btn1"><? echo lang('login'); ?></a>
                    <a href="signup" class="login_signup_btn2"><? echo lang('signup'); ?></a> 
                </div>-->
        </div>
        <!--============[ main contains ]============-->
        <div class="login_signup_box">
        <h3 align="center"><? echo lang('welcome_to'); ?> Myfamnet</h3>
        <p align="center" style="color: #999; margin-bottom: 25px;"><? echo lang('myfamnet_main_string'); ?></p>
            <div style="display: flex;">
                <div style="width: 100%;">
                    <br><h4 style="font-size: 20px;text-align: center;"><? echo lang('login_now'); ?></h4>
                    <p><input type="text" name="login_username" id="un" class="login_signup_textfield" placeholder="<? echo lang('email_or_username'); ?>"/></p>
                    <p><input type="password" name="login_password" id="pd" class="login_signup_textfield" placeholder="<? echo lang('password'); ?>"/></p>
                    <!--<p><a href="#" style="color: #a2a2a2; font-size: 11px; float: <? echo lang('float2'); ?>;"> <? echo lang('forgot_password'); ?></a></p>-->
                    <button type="submit" class="login_signup_btn1" id="loginFunCode"><? echo lang('login'); ?></button>
                    <p id="login_wait" style="margin: 0px;"></p>
                </div>
                <!--<div style="width: 100%;text-align: center;">
                    <img src="imgs/main_icons/pc_main.png" alt="Wallstant" style="width: 300px;" />-->
                </div>
            </div>
        </div>
        <div style="background: #fff; border-radius: 12px; max-width: 800px; padding: 15px; margin:auto;margin-top: 15px;color: #7b7b7b;" align="center">
            <? echo lang('dont_have_an_account'); ?> <a style="color: #CC0033;font-weight: bold;" href="signup"><? echo lang('signup'); ?></a> <? echo lang('for_free'); ?>.<hr style="margin: 8px;">
               <!-- <a href="?lang=english">English</a> &bull; <a href="?lang=العربية">العربية</a>-->

                <a href="terms" class="login_signup_navbarLinks"><? echo lang('terms'); ?></a>
                <a href="privacy_policy" class="login_signup_navbarLinks"><? echo lang('privacyPolicy'); ?></a>
                <br/>
                <br />
                <p style="font-size: 11px;color: #5d5d5d;top: 12px 0px; ">A Terrelle Tettey Production.</p>
        </div>

<script type="text/javascript">
function loginUser(){
var username = document.getElementById("un").value;
var password = document.getElementById("pd").value;
$.ajax({
type:'POST',
url:'includes/login_signup_codes.php',
data:{'req':'login_code','un':username,'pd':password},
beforeSend:function(){
$('.login_signup_btn1').hide();
$('#login_wait').html("<? echo lang('loading'); ?>...");
},
success:function(data){
$('#login_wait').html(data);
if (data == "Welcome...") {
    $('#login_wait').html("<p class='alertGreen'><? echo lang('welcome'); ?>..</p>");
    setTimeout(' window.location.href = "home"; ',2000);
}else{
    $('.login_signup_btn1').show();
}
},
error:function(err){
alert(err);
}
});
}
$('#loginFunCode').click(function(){
loginUser();
});
$(".login_signup_textfield").keypress( function (e) {
    if (e.keyCode == 13) {
        loginUser();
    }
});
</script>
</body>
</html>
