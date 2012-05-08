<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>

<div id="pop_header">
    <h1><?php echo $g4[title]?></h1>
</div>
<div id="pop_content">

    <div class="memo_menu">
        <ul>
            <li><a href="./memo.php?kind=recv" class="<?php echo (($kind=='recv' || $kind=='')?'selected':'')?>"><span>받은쪽지함</span></a></li>
            <li><a href="./memo.php?kind=send" class="<?php echo (($kind=='send')?'selected':'')?>"><span>보낸쪽지함</span></a></li>
            <li><a href="./memo_form.php"><span>쪽지보내기</span></a></li>
        </ul>
    </div>

    <div class="total">전체 <?php echo $kind_title?> 쪽지 : <span><?php echo $total_count?></span>통</div>
    <div class="msg">* 쪽지 보관일수는 최장 <?php echo $config[cf_memo_del]?>일 입니다.</div>

    <table cellspacing="0" class="table_list" summary="메모 목록">
    <caption>메모리스트</caption>
    <colgroup>
        <col width="20%" />
        <col width="30%" />
        <col width="30%" />
        <col width="20%" />
    </colgroup>
    <thead>
        <tr>
            <th scope="col"><?php echo  ($kind == "recv") ? "보낸사람" : "받는사람"; ?></th>
            <th scope="col">보낸시간</th>
            <th scope="col">읽은시간</th>
            <th scope="col">삭제</th>
        </tr>
    </thead>
    <tbody>

    <?php for ($i=0; $i<count($list); $i++) { ?>
        <tr>
            <td><?php echo $list[$i][name]?></td>
            <td class="date"><a href="<?php echo $list[$i][view_href]?>"><?php echo $list[$i][send_datetime]?></a></td>
            <td class="date"><a href="<?php echo $list[$i][view_href]?>"><?php echo $list[$i][read_datetime]?></a></td>
            <td><a href="<?php echo $list[$i][del_href]?>" class="del_click" onclick="return false;"><img src="<?php echo "$member_skin_path/img/btn_memo_del.gif"?>" alt="삭제" /></a></td>
        </tr>
    <?php } ?>
    <?php if ($i==0) { echo "<tr><td colspan='4' style='height:100px; text-align:center;'>자료가 없습니다.</td></tr>"; } ?>
    </tbody>
    </table>

    <div id="page">
        <?php echo get_paging($config[cf_write_pages], $page, $total_page, "?$qstr&amp;page=");?>
    </div>
</div>

<div id="pop_tailer">
    <p><a href="javascript:;" onclick="window.close();"><img src="<?php echo "$member_skin_path/img/btn_close.gif"?>" alt="창닫기" /></a></p>
</div>

<script type="text/javascript">
//<![CDATA[
$(function() {
    $(".del_click").bind("click", function(e) {
        del(this.href);
    });
});
//]]>
</script>
