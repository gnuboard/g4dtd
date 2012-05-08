<?php
$sub_menu = "200800";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

$g4[title] = "브라우저별 접속자현황";
include_once("./admin.head.php");

echo subtitle("브라우저별 접속자현황");

include_once("./visit.sub.php");

$colspan = 5;
?>

<table class='list_table'>
<col width='100' />
<col width='200' />
<col width='100' />
<col width='100' />
<col width='' />
<thead>
<tr>
    <th>순위</th>
    <th>브라우저</th>
    <th>방문자수</th>
    <th>비율(%)</th>
    <th>그래프</th>
</tr>
</thead>
<tbody>
<?php
$max = 0;
$sum_count = 0;
$sql = " select * from $g4[visit_table]
          where vi_date between '$fr_date' and '$to_date' ";
$result = sql_query($sql);
while ($row=sql_fetch_array($result)) {
    $s = get_brow($row[vi_agent]);

    $arr[$s]++;

    if ($arr[$s] > $max) $max = $arr[$s];

    $sum_count++;
}

$i = 0;
$k = 0;
$save_count = -1;
$tot_count = 0;
if (count($arr)) {
    arsort($arr);
    foreach ($arr as $key=>$value) {
        $count = $arr[$key];
        if ($save_count != $count) {
            $i++;
            $no = $i;
            $save_count = $count;
        } else {
            $no = "";
        }

        $rate = ($count / $sum_count * 100);
        $s_rate = number_format($rate, 1);

        $bar = (int)($count / $max * 100);
        $graph = "<img src='{$g4[admin_path]}/img/graph.gif' width='$bar%' height='18' alt='' />";

        $list = ($k++%2);
        echo "
        <tr class='list$list'>
            <td>$no</td>
            <td>$key</td>
            <td>$count</td>
            <td>$s_rate</td>
            <td class='tfl'>$graph</td>
        </tr>";
    }

    echo "
    <tr>
        <td colspan='2'>합계</td>
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
