<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>

<div class="list_status">
    <form id="fnew" method="get" action="#">
    <div>
        <?php echo $group_select; ?>
        <select name="view" id="view" onchange="select_change()">
            <option value="">전체게시물</option>
            <option value="w">원글만</option>
            <option value="c">코멘트만</option>
        </select>

        <label for="mb_id">회원아이디</label>
        <input type="text" id="mb_id" name="mb_id" size="15" class="text" accesskey="S" value="<?php echo $mb_id?>" />
        <input type="image" src="<?php echo $new_skin_path; ?>/img/btn_search.gif" class="btn_new" alt="검색" />
    </div>
    </form>
</div>

<table cellspacing="0" class="list_table">
<colgroup>
    <col width="100" />
    <col width="100" />
    <col width="*" />
    <col width="110" />
    <col width="70" />
</colgroup>
<thead>
    <tr>
        <th scope="col">그룹</th>
        <th scope="col">게시판</th>
        <th scope="col">제목</th>
        <th scope="col">이름</th>
        <th scope="col">날짜</th>
    </tr>
</thead>
<tbody>
<?php
if(count($list)) {
	for ($i=0; $i<count($list); $i++) {
			$gr_subject = cut_str($list[$i]['gr_subject'], 15);
			$bo_subject = cut_str($list[$i]['bo_subject'], 15);
			$wr_subject = get_text(cut_str($list[$i]['wr_subject'], 60));

			$date = date("y.m.d", strtotime($list[$i]['bn_datetime']));

			echo"
			<tr>
					<td class='number'><a href='./new.php?gr_id={$list[$i]['gr_id']}'>{$gr_subject}</a></td>
					<td class='number'><a href='./board.php?bo_table={$list[$i]['bo_table']}'>{$bo_subject}</a></td>
					<td class='tl'><a href='{$list[$i]['href']}'>{$list[$i]['comment']}{$wr_subject}</a></td>
					<td>{$list[$i]['name']}</td>
					<td class='number'>{$list[$i]['datetime']}</td>
			</tr>
			";
	}
} else {
	echo "<tr><td colspan='5' style='text-align:center; height:100px;'>게시물이 없습니다.</td></tr>";
}
?>
</tbody>
</table>

<div class="page">
    <?php echo $write_pages?>
</div>

<script type="text/javascript">
//<![CDATA[
function select_change()
{
    document.getElementById("fnew").submit();
}
document.getElementById("gr_id").value = "<?php echo $gr_id?>";
document.getElementById("view").value = "<?php echo $view?>";

$(function() {
    /*
    $(".board_list tbody tr")
    .each(function(i) {
        if (i%2==0)
            $(this).addClass("list_even");
        else
            $(this).addClass("list_odd");
    })
    .hover(
        function() {
            $(this).toggleClass("mouse_over");
        },
        function() {
            $(this).toggleClass("mouse_over");
        }
    );
    */
    /*
    $(".board_list tbody tr")
    .each(function(i) {
        if (i%2==0)
            $(this).css("background", "#ffffff");
        else
            $(this).css("background", "#fcfcfc");
    })
    .bind("mouseover", function() {
        $(this).attr("rel", $(this).css("background"));
        $(this).css("background", "#f1f1f1");
    })
    .bind("mouseout", function() {
        $(this).css("background", $(this).attr("rel"));
    })
    */
});
//]]>
</script>
