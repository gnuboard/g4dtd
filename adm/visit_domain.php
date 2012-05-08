<?php
$sub_menu = "200800";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

$g4[title] = "도메인별 접속자현황";
include_once("./admin.head.php");

echo subtitle("도메인별 접속자현황");

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
<tr class='bgcol1 bold col1 ht center'>
    <th>순위</th>
    <th>접속 도메인</th>
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
    $str = $row[vi_referer];
    preg_match("/^http[s]*:\/\/([\.\-\_0-9a-zA-Z]*)\//", $str, $match);
    $s = $match[1];
    $s = preg_replace("/^(www\.|search\.|dirsearch\.|dir\.search\.|dir\.|kr\.search\.|myhome\.)(.*)/", "\\2", $s);
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

        if (!$key) {
            $link1 = "";
            $link2 = "";
            $key = "직접";
        } else {
            $link1 = "<a href='./visit_list.php?$qstr&amp;domain=$key' title='상세보기'>";
            $link2 = "</a>";
        }

        $rate = ($count / $sum_count * 100);
        $s_rate = number_format($rate, 1);

        $bar = (int)($count / $max * 100);
        $graph = "<img src='{$g4[admin_path]}/img/graph.gif' width='$bar%' height='18' alt='' />";

        $list = ($k++%2);
        echo "
        <tr class='list$list ht center'>
            <td>$no</td>
            <td align='left'>$link1$key$link2</td>
            <td>$count</td>
            <td>$s_rate</td>
            <td class='tfl'>$graph</td>
        </tr>";
    }

    echo "
    <tr><td colspan='$colspan' class='line2'></td></tr>
    <tr class='bgcol2 bold col1 ht center'>
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
