<?php
if (!defined("_GNUBOARD_")) exit;

include_once("$g4[path]/lib/visit.lib.php");

if (empty($fr_date)) $fr_date = $g4[time_ymd];
if (empty($to_date)) $to_date = $g4[time_ymd];

$qstr = "fr_date=$fr_date&amp;to_date=$to_date";
?>

<form id='fvisit' method='get' action='#'>
<div class='list_status'>
    기간 :
    <input type='text' name='fr_date' size='11' maxlength='10' value='<?php echo $fr_date?>' class='text' />
    -
    <input type='text' name='to_date' size='11' maxlength='10' value='<?php echo $to_date?>' class='text' />
    &nbsp;
    <input type='button' class='btn1' value=' 접속자 ' onclick="fvisit_submit('visit_list.php');" />
    <input type='button' class='btn1' value=' 도메인 ' onclick="fvisit_submit('visit_domain.php');" />
    <input type='button' class='btn1' value=' 브라우저 ' onclick="fvisit_submit('visit_browser.php');" />
    <input type='button' class='btn1' value=' OS ' onclick="fvisit_submit('visit_os.php');" />
    <input type='button' class='btn1' value=' 시간 ' onclick="fvisit_submit('visit_hour.php');" />
    <input type='button' class='btn1' value=' 요일 ' onclick="fvisit_submit('visit_week.php');" />
    <input type='button' class='btn1' value=' 일 ' onclick="fvisit_submit('visit_date.php');" />
    <input type='button' class='btn1' value=' 월 ' onclick="fvisit_submit('visit_month.php');" />
    <input type='button' class='btn1' value=' 년 ' onclick="fvisit_submit('visit_year.php');" />
</div>
</form>

<script type='text/javascript'>
function fvisit_submit(act)
{
    var f = document.getElementById('fvisit');
    f.action = act;
    f.submit();
}
</script>
