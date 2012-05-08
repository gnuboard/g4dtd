<?php
$sub_menu = "200300";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

$sql_common = " from $g4[mail_table] ";

// 테이블의 전체 레코드수만 얻음
$sql = " select COUNT(*) as cnt " . $sql_common;
$row = sql_fetch($sql);
$total_count = $row[cnt];

$page = 1;

$sql = "select * $sql_common order by ma_id desc ";
$result = sql_query($sql);

$g4[title] = "회원메일발송";
include_once("./admin.head.php");

$colspan = 6;
?>
<div id="adm_mail">
<?php echo subtitle("회원메일발송")?>
<div class='list_status'>
    <div class='fl'></div>
    <div class='fr'>
        건수 : <? echo $total_count ?>
    </div>
</div>

<table class='list_table'>
<col width='40' />
<col width='*' />
<col width='120' />
<col width='50' />
<col width='50' />
<col width='80' />
<thead>
	<tr>
		<th>ID</th>
		<th>제목</th>
		<th>작성일시</th>
		<th>테스트</th>
		<th>보내기</th>
		<th><a href='./mail_form.php'><img src='<?php echo $g4[admin_path]?>/img/icon_insert.gif' alt='' /></a></th>
	</tr>
</thead>
<tbody>
<?php
for ($i=0; $row=mysql_fetch_array($result); $i++)
{
    $s_mod = icon("수정", "./mail_form.php?w=u&amp;ma_id=$row[ma_id]");
    $s_del = "<a href=\"javascript:post_delete('mail_update.php', '$row[ma_id]');\"><img src='img/icon_delete.gif' alt='' title='삭제' class='icon_btn' /></a>";
    $s_vie = icon("보기", "./mail_preview.php?ma_id=$row[ma_id]", "_blank");

    $num = number_format($total_count - ($page - 1) * $config[cf_page_rows] - $i);

    $list = $i%2;
    echo "
    <tr class='list$list'>
        <td>$num</td>
        <td align='left'>$row[ma_subject]</td>
        <td>$row[ma_time]</td>
        <td><a href='./mail_test.php?ma_id=$row[ma_id]'>테스트</a></td>
        <td><a href='./mail_select_form.php?ma_id=$row[ma_id]'>보내기</a></td>
        <td>$s_mod $s_del $s_vie</td>
    </tr>";
}

if (!$i)
    echo "<tr><td colspan='$colspan' class='nodata'>자료가 없습니다.</td></tr>";
?>
</table>

<script type='text/javascript'>
// POST 방식으로 삭제
function post_delete(action_url, val)
{
	var f = document.getElementById('fpost');

	if(confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n정말 삭제하시겠습니까?")) {
        f.ma_id.value = val;
		f.action      = action_url;
		f.submit();
	}
}
</script>

<form id='fpost' method='post' action='#'>
<div>
<input type='hidden' name='sst'  value='<?php echo $sst?>' />
<input type='hidden' name='sod'  value='<?php echo $sod?>' />
<input type='hidden' name='sfl'  value='<?php echo $sfl?>' />
<input type='hidden' name='stx'  value='<?php echo $stx?>' />
<input type='hidden' name='page' value='<?php echo $page?>' />
<input type='hidden' name='w'    value='d' />
<input type='hidden' name='ma_id' />
</div>
</form>
</div>
<?php
include_once ("./admin.tail.php");
?>