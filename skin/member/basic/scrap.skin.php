<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>

<div id="pop_header">
    <h1><?php echo $g4[title]?></h1>
</div>
<div id="pop_content">

    <table cellspacing="0" class="list_table">
    <colgroup>
        <col width="7%" />
        <col width="18%" />
        <col width="*" />
        <col width="22%" />
        <col width="5%" />
    </colgroup>
    <thead>
        <tr>
            <th scope="col">번호</th>
            <th scope="col">게시판</th>
            <th scope="col">제목</th>
            <th scope="col">보관일시</th>
            <th scope="col">삭제</th>
        </tr>
    </thead>
    <tbody>
    <?php for ($i=0; $i<count($list); $i++) { ?>
        <tr>
            <td class="date"><?php echo $list[$i][num]?></td>
            <td><a href="<?php echo $list[$i][opener_href]?>" class="href_click" onclick="return false;"><?php echo $list[$i][bo_subject]?></a></td>
            <td style="text-align:left;"><a href="<?php echo $list[$i][opener_href_wr_id]?>" class="href_click" onclick="return false;"><?php echo $list[$i][subject]?></a></td>
            <td class="date"><?php echo $list[$i][ms_datetime]?></td>
            <td><a href="<?php echo $list[$i][del_href]?>" class="del_click" onclick="return false;"><img src="<?php echo "$member_skin_path/img/btn_scrap_del.gif"?>" alt="삭제" /></a></td>
        </tr>
    <?php } ?>
    <?php if ($i == 0) echo "<tr><td colspan='5' style='height:100px; text-align:center;'>자료가 없습니다.</td></tr>"; ?>
    </tbody>
    </table>


    <div class="page">
        <?php echo get_paging($config[cf_write_pages], $page, $total_page, "?$qstr&amp;page=");?>
    </div>
</div>

<div id="pop_tailer">
    <a href="javascript:;" onclick="window.close();"><img src="<?php echo "$member_skin_path/img/btn_close.gif"?>" alt="창닫기" /></a>
</div>

<script type="text/javascript">
//<![CDATA[
$(function() {
    $(".href_click").bind("click", function(e) {
        if (typeof(opener.document) != "unknown") {
            opener.document.location.href = this.href;
        }
    });

    $(".del_click").bind("click", function(e) {
        del(this.href);
    });
});
//]]>
</script>
