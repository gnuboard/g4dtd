<?php
$sub_menu = "200800";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

$g4[title] = "접속자현황";
include_once("./admin.head.php");

echo subtitle("접속자현황");

include_once("./visit.sub.php");

$colspan = 5;
?>
<table class='list_table'>
<col width='100' />
<col width='350' />
<col width='100' />
<col width='100' />
<col width='*' />
<thead>
<tr>
    <th>IP</th>
    <th>접속 경로</th>
    <th>브라우저</th>
    <th>OS</th>
    <th>일시</th>
</tr>
</thead>
<tbody>
<?php
//unset($br); // 브라우저
//unset($os); // OS

$sql_common = " from $g4[visit_table] ";
$sql_search = " where vi_date between '$fr_date' and '$to_date' ";
if ($domain) {
    $sql_search .= " and vi_referer like '%$domain%' ";
}

$sql = " select count(*) as cnt
         $sql_common
         $sql_search ";
$row = sql_fetch($sql);
$total_count = $row[cnt];

$rows = $config[cf_page_rows];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page == "") $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select *
          $sql_common
          $sql_search
          order by vi_id desc
          limit $from_record, $rows ";
$result = sql_query($sql);

for ($i=0; $row=sql_fetch_array($result); $i++) {
    $brow = get_brow($row[vi_agent]);
    $os   = get_os($row[vi_agent]);

    $link1 = "";
    $link2 = "";
    $referer = "";
    $title = "";
    if ($row[vi_referer]) {
        $referer = get_text(cut_str($row[vi_referer], 255, ""));
        $title = str_replace(array("<", ">"), array("&lt;", "&gt;"), urldecode($row[vi_referer]));
        $link1 = "<a href='$row[vi_referer]' title='$title '>";
        $link2 = "</a>";
    }

    if ($is_admin == 'super')
        $ip = $row[vi_ip];
    else
        $ip = preg_replace("/([0-9]+).([0-9]+).([0-9]+).([0-9]+)/", "\\1.♡.\\3.\\4", $row[vi_ip]);

    if ($brow == '기타') { $brow = "<span title='$row[vi_agent]'>$brow</span>"; }
    if ($os == '기타') { $os = "<span title='$row[vi_agent]'>$os</span>"; }

    $list = ($i%2);
    echo "
    <tr>
        <td>$ip</td>
        <td align='left'>$link1$title$link2</td>
        <td>$brow</td>
        <td>$os</td>
        <td>$row[vi_date] $row[vi_time]</td>
    </tr>";
}

if ($i == 0)
    echo "<tr><td colspan='$colspan' class='nodata'>자료가 없습니다.</td></tr>";

echo "</tbody>";
echo "</table>";

$page = get_paging($config[cf_write_pages], $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&amp;domain=$domain&amp;page=");
if ($page) {
    echo "<table width='100%' cellpadding='3' cellspacing='1'><tr><td align='right'>$page</td></tr></table>";
}

include_once("./admin.tail.php");
?>
