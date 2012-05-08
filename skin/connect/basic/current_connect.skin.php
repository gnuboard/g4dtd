<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>

<table cellspacing="0" class="list_table">
<colgroup>
    <col width="50" />
    <col width="120" />
    <col width="*" />
</colgroup>
<thead>
    <tr>
        <th scope="col">번호</th>
        <th scope="col">이름</th>
        <th scope="col">현재 위치</th>
    </tr>
</thead>
<tbody>
<?php
for ($i=0; $i<count($list); $i++)
{
    echo "<tr>";
    echo "<td class='number'>{$list[$i]['num']}</td>";
    echo "<td>{$list[$i]['name']}</td>";

    $location = conv_content($list[$i][lo_location], 0);

    // 최고관리자에게만 허용
    // 이 조건문은 가능한 변경하지 마십시오.
    if ($list[$i][lo_url] && $is_admin == "super")
        //echo "<td colspan=2>&nbsp;<a href='{$list[$i][lo_url]}'>{$location}</a></td>";
        echo "<td class='tl'><a href='{$list[$i]['lo_url']}'>{$location}</a></td>";
    else
        //echo "<td colspan=2>&nbsp;{$location}</td>";
        echo "<td class='tl'>{$location}</td>";
    echo "</tr>";
}

if ($i == 0)
    echo "<tr><td colspan='3'>현재 접속자가 없습니다.</td></tr>";
?>
</tbody>
</table>
