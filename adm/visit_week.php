<?php
$sub_menu = "200800";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

$g4[title] = "요일별 접속자현황";
include_once("./admin.head.php");

echo subtitle("요일별 접속자현황");

include_once("./visit.sub.php");

$colspan = 4;
?>

<table class='list_table'>
<col width='100' />
<col width='100' />
<col width='100' />
<col width='*' />
<thead>
<tr>
    <th>요일</th>
    <th>방문자수</th>
    <th>비율(%)</th>
    <th>그래프</th>
</tr>
</thead>
<tbody>
<?php
$weekday = array ('월', '화', '수', '목', '금', '토', '일');

$sum_count = 0;
$sql = " select WEEKDAY(vs_date) as weekday_date, SUM(vs_count) as cnt
           from $g4[visit_sum_table]
          where vs_date between '$fr_date' and '$to_date'
          group by weekday_date
          order by weekday_date ";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $arr[$row[weekday_date]] = $row[cnt];

    $sum_count += $row[cnt];
}

$k = 0;
if ($i) {
    for ($i=0; $i<7; $i++) {
        $count = (int)$arr[$i];

        $rate = ($count / $sum_count * 100);
        $s_rate = number_format($rate, 1);
        $graph = "<img src='{$g4[admin_path]}/img/graph.gif' width='$rate%' height='18' alt='' />";

        $list = ($k++%2);
        echo "
        <tr class='list$list'>
            <td>$weekday[$i]</td>
            <td>$count</td>
            <td>$s_rate</td>
            <td class='tfl'>{$graph}</td>
        </tr>";
    }

    echo "
    <tr>
        <td>합계</td>
        <td>$sum_count</td>
        <td colspan='2'>&nbsp;</td>
    </tr>";
} else {
    echo "<tr><td colspan='$colspan' class='nodata'>자료가 없습니다.</td></tr>";
}
?>
</tbody>
</table>

<?php
include_once("./admin.tail.php");
?>
