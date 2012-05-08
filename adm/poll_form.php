<?php
$sub_menu = "200900";
include_once("./_common.php");

auth_check($auth[$sub_menu], "w");

$token = get_token();

$html_title = "투표";
if ($w == "")
    $html_title .= " 생성";
else if ($w == "u")  {
    $html_title .= " 수정";
    $sql = " select * from $g4[poll_table] where po_id = '$po_id' ";
    $po = sql_fetch($sql);
} else
    alert("w 값이 제대로 넘어오지 않았습니다.");

$g4[title] = $html_title;
include_once("./admin.head.php");
?>

<?php echo subtitle("투표생성"); ?>
<form id='fpoll' method='post' action='#' onsubmit="return fpoll_check(this);">
<table class='normal2'>
<col class='col1' />
<col class='col2' />
<col class='col3' />
<col class='col4' />
<tr>
    <th>투표 제목</th>
    <td colspan='3'>
        <input type='hidden' name='po_id' value='<?php echo $po_id?>' />
        <input type='hidden' name='w' value='<?php echo $w?>' />
        <input type='hidden' name='sfl' value='<?php echo $sfl?>' />
        <input type='hidden' name='stx' value='<?php echo $stx?>' />
        <input type='hidden' name='sst' value='<?php echo $sst?>' />
        <input type='hidden' name='sod' value='<?php echo $sod?>' />
        <input type='hidden' name='page' value='<?php echo $page?>' />
        <input type='hidden' name='token' value='<?php echo $token?>' />

        <input type='text' name='po_subject' class='text w99 required' title='투표 제목' value='<?php echo $po[po_subject]?>' maxlength="125" /></td>
</tr>

<?php
for ($i=1; $i<=9; $i++) {
    $required = "";
    $itemname = "";
    if ($i==1 || $i==2) {
        $required = "required";
        $itemname = "title='항목$i'";
    }

    $po_poll = get_text($po["po_poll".$i]);

    echo <<<HEREDOC
    <tr>
        <th width='15%'>항목{$i}</th>
        <td width='35%'><input type='text' name="po_poll{$i}" class='text w99 {$required}' {$itemname} value="{$po_poll}" maxlength="125" /></td>
        <th width='15%'>투표수</th>
        <td><input type='text' name="po_cnt{$i}" size='5' class='text' value="{$po["po_cnt".$i]}" /></td>

    </tr>
HEREDOC;
}
?>

<tr>
    <th>기타의견</th>
    <td colspan='3'><input type='text' name='po_etc' class='text w99' value='<?php echo get_text($po[po_etc])?>' maxlength="125" /></td>
</tr>

<tr>
    <th>투표권한</th>
    <td colspan='3'><?php echo get_member_level_select("po_level", 1, 10, $po[po_level])?>이상 투표할 수 있음</td>
</tr>

<tr>
    <th>포인트</th>
    <td colspan='3'><input type='text' name='po_point' size='10' class='text' value='<?php echo $po[po_point]?>' /> 점 (투표한 회원에게 부여함)</td>
</tr>


<?php if ($w == "u") { ?>
<tr>
    <th>투표시작일</th>
    <td colspan='3'><input type="text" name="po_date" size='10' maxlength='10' class='text' value="<?php echo $po[po_date]?>" /></td>
</tr>

<tr>
    <th>투표참가 IP</th>
    <td colspan='3'><textarea name="po_ips" rows='10' cols='1' class='textarea w99' readonly='readonly'><?php echo preg_replace("/\n/", " / ", $po[po_ips])?></textarea></td>
</tr>

<tr>
    <th>투표참가 회원</th>
    <td colspan='3'><textarea name="mb_ids" rows='10' cols='1' class='textarea w99' readonly='readonly'><?php echo preg_replace("/\n/", " / ", $po[mb_ids])?></textarea></td>
</tr>

<?php } ?>
</table>

<p class='center'>
    <input type='submit' class='btn1' accesskey='s' value='  확  인  ' />
    <input type='button' class='btn1' value='  목  록  ' onclick="document.location.href='./poll_list.php?<?php echo $qstr?>';" />
</p>
</form>

<script type='text/javascript'>
$(function() {
    // 첫번째 입력 필드에 포커스 맞추기
    $("#fpoll").attr("autocomplete", "off").find(":input:visible:enabled:first").focus();
});

function fpoll_check(f)
{
    f.action = './poll_form_update.php';
    return true;
}
</script>

<?php
include_once("./admin.tail.php");
?>
