<?php
include_once("./_common.php");

if (!$member[mb_id])
    alert_close("회원만 조회하실 수 있습니다.");

$g4[title] = $member[mb_nick] . "님의 포인트 내역";
$member_skin_path = "$g4[path]/skin/member/$config[cf_member_skin]";
include_once("$g4[path]/head.sub.php");

$list = array();

$sql_common = " from $g4[point_table] where mb_id = '".mysql_escape_string($member[mb_id])."' ";
$sql_order = " order by po_id desc ";

$sql = " select count(*) as cnt $sql_common ";
$row = sql_fetch($sql);
$total_count = $row[cnt];

$rows = $config[cf_page_rows];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if (!$page) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함
?>

<div id="pop_header">
    <h1><?php echo $g4[title]?></h1>
</div>
<div id="pop_content">

    <div class="total"><?php echo $member[mb_nick]?>님의 총 보유 포인트 : <span><?php echo number_format($member[mb_point])?></span> 점</div>

    <table cellspacing="0" class="list_table">
    <colgroup>
        <col width="24%" />
        <col width="*" />
        <col width="13%" />
        <col width="13%" />
    </colgroup>
    <thead>
        <tr>
            <th scope="col">일시</th>
            <th scope="col">내용</th>
            <th scope="col">지급포인트</th>
            <th scope="col">사용포인트</th>
        </tr>
    </thead>
    <tbody>
<?php
$sum_point1 = $sum_point2 = 0;

$sql = " select *
          $sql_common
          $sql_order
          limit $from_record, $rows ";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $point1 = $point2 = 0;
    if ($row[po_point] > 0) {
        $point1 = "+" . number_format($row[po_point]);
        $sum_point1 += $row[po_point];
    } else {
        $point2 = number_format($row[po_point]);
        $sum_point2 += $row[po_point];
    }

    echo <<<HEREDOC
        <tr>
            <td class="date">$row[po_datetime]</td>
            <td style="text-align:left;">$row[po_content]</td>
            <td class="date right">{$point1}</td>
            <td class="date right">{$point2}</td>
        </tr>
HEREDOC;
}

if ($i == 0) {
    echo "<tr><td colspan='4' style='height:100px; text-align:center;'>자료가 없습니다.</td></tr>";
} else {
    if ($sum_point1 > 0)
        $sum_point1 = "+" . number_format($sum_point1);
    $sum_point2 = number_format($sum_point2);
    echo <<<HEREDOC
        <tr class="subtotal">
            <td colspan="2"><strong>소 계</strong></td>
            <td class="date right">{$sum_point1}</td>
            <td class="date right">{$sum_point2}</td>
        </tr>
HEREDOC;
}
?>
    </tbody>
    </table>

    <div class="page">
        <?php echo get_paging($config[cf_write_pages], $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&page=");?>
    </div>
</div>

<div id="pop_tailer">
    <p><a href="javascript:;" onclick="window.close();"><img src="<?php echo $member_skin_path?>/img/btn_close.gif" alt="창닫기" /></a></p>
</div>

<?php
include_once("$g4[path]/tail.sub.php");
?>