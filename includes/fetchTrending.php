<?php
session_start();
include('../config/connect.php');
include ("num_k_m_count.php");
$getTriendsPagesSql = "SELECT * FROM signup ORDER BY followers DESC LIMIT 1";
$getTriendsPages = $conn->prepare($getTriendsPagesSql);
$getTriendsPages->execute();
?>
<div id="trPages">
<?php
while ($fetchPages = $getTriendsPages->fetch(PDO::FETCH_ASSOC)) {
if ($fetchPages['verify'] == '1') {
    $PageVerifyBadge = $verifyUser;
}else{
    $PageVerifyBadge = "";
}
 ?>
<a href="u/<?php echo $fetchPages['Username']; ?>" class="TriendingPages_link">
<table class='TriendingPages'>
   
        <a href="https://c.jumia.io/?a=159826&c=1341&p=r&E=kkYNyk2M4sk%3D&utm_campaign=159826&utm_term="><img src="https://affiliates.jumia.com/banners/Jumia Ghana/PHONESANDTABLETS/250X250-MA.jpg"/></a>
    
    
</table>
</a>

<?php
}
?>
</div>
<div id="trPosts" style="display: none;">
<?php
$emptypost = "";
$public = "0";
$getTriendsPostsSql = "SELECT * FROM wpost WHERE post_content!= :emptypost AND p_privacy = :public ORDER BY p_likes DESC LIMIT 6";
$getTriendsPosts = $conn->prepare($getTriendsPostsSql);
$getTriendsPosts->bindParam(':emptypost',$emptypost,PDO::PARAM_STR);
$getTriendsPosts->bindParam(':public',$public,PDO::PARAM_INT);
$getTriendsPosts->execute();
while ($fetch = $getTriendsPosts->fetch(PDO::FETCH_ASSOC)) {
$authorOfPost = $fetch['author_id'];
$PostContentTrending = $fetch['post_content'];
    $aop_trend_sql = "SELECT * FROM signup WHERE id=:authorOfPost";
    $aop_trend = $conn->prepare($aop_trend_sql);
    $aop_trend->bindParam(':authorOfPost', $authorOfPost, PDO::PARAM_INT);
    $aop_trend->execute();

    while ($fetchAuthor = $aop_trend->fetch(PDO::FETCH_ASSOC)) {
        $fetchAuthor_id = $fetchAuthor['id'];
        $fetchAuthor_username = $fetchAuthor['Username'];
        $fetchAuthor_fullname = $fetchAuthor['Fullname'];
    }
    if (strlen($PostContentTrending) > 70) {
        $PostContentTrending = substr($PostContentTrending, 0,70)."<b> ...</b>";
    }
echo "
<table class='TriendingPosts' style='width:100%;'>
<tr>
<td style='width: 40px;'><span style='color:#FFD700;' class='fa fa-star'></span></td>
<td><a href='posts/post?pid=".$fetch['post_id']."'><p>$PostContentTrending</p></a></td>
</tr>
<tr>
<td></td>
<td style='color: #CC0033;font-size:11px;font-weight: normal;padding-top:0;'>@".$fetchAuthor_username."</td>
</tr>
</table>
";
}
?>
</div>

