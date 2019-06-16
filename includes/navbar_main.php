<?php
if (is_dir("imgs/")) {
    $dircheckPath = "";
}elseif (is_dir("../imgs/")) {
    $dircheckPath = "../";
}elseif (is_dir("<?php echo $dircheckPath; ?>imgs/")) {
    $dircheckPath = "<?php echo $dircheckPath; ?>";
}
// ================================ check user exist ===================================
session_start();
$mys = $_SESSION['Username'];
$uCheckSession_sql = "SELECT Username FROM signup WHERE Username=:mys";
$uCheckSession = $conn->prepare($uCheckSession_sql);
$uCheckSession->bindParam(':mys',$mys,PDO::PARAM_STR);
$uCheckSession->execute();
$uCheckSessionCount = $uCheckSession->rowCount();
if ($uCheckSessionCount == 0) {
    session_unset();
    session_destroy();
}
?>
<style type="text/css">
    .navbar-nav>li{
        float: <?php echo lang('float'); ?>;
    }
</style>
<nav style="position:fixed;background-color:#fff;top:0;right:0;left:0;z-index: 2;">
    <div class="container-fluid" style="width: 1040px;">
        <div class="navbar-header" style="float: <?php echo lang('float'); ?>;">
            
            <a style="font-size:27px;padding: 19px 10px;color:#CC0033;font-family: Trebuchet MS,Lucida Grande,Lucida Sans Unicode,Lucida Sans,Tahoma,sans-serif;" class="navbar-brand" href="<?php echo $dircheckPath; ?>home">myfamnet</a>
        </div>
        <div  id="myNavbar">
            <ul class="<?php echo lang('ul_navbar_nav1'); ?>">
                <?php
                if (is_file("home.php")) {
                    $homePath = "home";
                }elseif (is_file("../home.php")) {
                    $homePath = "../home";
                }elseif (is_file("../../home.php")) {
                    $homePath = "../../home";
                }
                ?>
                <li><a href="<?php echo $homePath; ?>" style="padding: 14px 10px;"><span  style="font-size: 27px;color: black;" class="fa fa-home"></span> </a></li>
                <li><a href="<?php echo $dircheckPath; ?>messages/" style="padding: 16px 10px;"><span style="color: black;font-size: 27px;" class="fa fa-paper-plane"></span>  <span style="color: black;" id="messagesCount"></span></a>
                </li>
                
                <li><a href="javascript:void(0);" style="padding: 16px 10px;" id="nav_Noti_Btn"><span style="color: black;font-size: 27px;" class="fa fa-bell"></span>  <span style="color: black;" id="notificationsCount"></span></a>
                <div class="navbar_fetchBox" id="notifications_box">
                <div style="position:relative;padding: 5px 10px;border-bottom: 1px solid #ccc;text-align: <?php echo lang('textAlign'); ?>"><?php echo lang('notifications'); ?>
                    <span class="toTopArrow" span class='toTopArrow' style="position: absolute; top: -10px;<?php echo lang('float'); ?>:8px;"></span>
                </div>
                <div id="notifications_rP" class="scrollbar" style="max-height: 450px; overflow-y: scroll;">
                    <div id="notifications_r" data-load="0">
                        <div id="notifications_data"></div>
                        <p style='width: 100%;border:none;display: none' id="notifications_loading" align='center'><img src='<?php echo $dircheckPath; ?>imgs/loading_video.gif' style='width:20px;box-shadow: none;height: 20px;'></p>
                        <p id="notifications_noMore" style='display:none;color:#9a9a9a;font-size:14px;text-align:center;'><?php echo lang('no_notifications'); ?></p>
                        <input type="hidden" id="notifications_load" value="0"> 
                    </div>
                </div>
                <div id='sqresultItem' align='center' style='background: #efefef; border: 1px solid #e0e0e0;'>
                <a href='<?php echo $dircheckPath; ?>notifications'>
               
                </a>
                </div>
                </div>
                <div id="nav_newNotify" data-show='0'></div>
                </li>
                   <li>
                <input id="searchq" dir="auto" class="navbar_search" type="search" name="navbar_search" placeholder="<?php echo lang('navbar_serchBox_ph'); ?>" style="text-align: <?php echo lang('textAlign'); ?>;" />
                </li>
                 <div class="navbar_fetchBox" id="search_r">
                 <div  id="getSearchResult" class="scrollbar" style="overflow: auto;max-height: 450px;"></div>
                 <p  id="LoadingSearchResult" style="background: url(imgs/loading_video.gif) center center no-repeat;width: 100%;height: 80px;margin: 0px;display: none;"></p>
                </div>
            </ul>

            
                       
              
           
        </div>
    </div>
</nav>
<div style="" id='nSound'></div>
<?php include ($dircheckPath."js/navbar_nottifi_js.php"); ?>