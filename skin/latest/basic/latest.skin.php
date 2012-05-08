<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>

<!-- 최근게시물 : <?php echo $board[bo_subject]?> -->
<div class='latest_area'>
    <div class='title'>
        <h2><a href="<?php echo $g4[bbs_path]?>/board.php?bo_table=<?php echo $bo_table?>" class="m-tcol-t" title="<?php echo $board[bo_subject]?>"><?php echo $board[bo_subject]?></a></h2>
        <span><a href="<?php echo $g4[bbs_path]?>/board.php?bo_table=<?php echo $bo_table?>">more</a></span>
    </div>

    <ul class='list'>
    <?php
    for ($i=0; $i<count($list); $i++) {
        $li = $list[$i];

        echo "    ";
        echo "<li";
        if ($li[icon_reply]) echo " class='reply'";
        if ($li[is_notice]) echo " class='notice'";
        echo ">";
        if ($li[icon_reply]) echo $li[icon_reply]." ";
        if ($li[ca_name]) echo "<span class='cate'>[<a href='$li[href]'>$li[ca_name]</a>]</span> ";
        echo "<a href='$li[href]'>$li[subject]";
        if ($li[wr_comment]) echo " <span class='comment'>($li[wr_comment])</span>";
        echo "</a>";
        echo $li[icon_new]    ? " ".$li[icon_new]    : "";
        echo $li[icon_file]   ? " ".$li[icon_file]   : "";
        echo $li[icon_link]   ? " ".$li[icon_link]   : "";
        echo $li[icon_hot]    ? " ".$li[icon_hot]    : "";
        echo $li[icon_secret] ? " ".$li[icon_secret] : "";
        echo "</li>\n";
    }

    if ($i==0) { echo "<li>게시물이 없습니다.</li>"; }
    ?>
    </ul>
</div><!-- 최근게시물 : <?php echo $board[bo_subject]?> -->
