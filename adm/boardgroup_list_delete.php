<?php
$sub_menu = "300200";
include_once("./_common.php");

check_demo();

auth_check($auth[$sub_menu], "w");

check_token();

for ($i=0; $i<count($chk); $i++)
{
    // 실제 번호를 넘김
    $k = $chk[$i];

    // 소속된 게시판 숫자 구하기
    $sql = " select count(*) as cnt from $g4[board_table] where gr_id = '{$_POST[gr_id][$k]}' ";
    $row = sql_fetch($sql);

    if ($row[cnt])
    {
        alert("현재 그룹에 $row[cnt]개의 게시판이 소속되어 있어서 삭제가 불가능 합니다.");
    }
    else
    {
        $sql = " delete from $g4[group_member_table] where gr_id = '{$_POST[gr_id][$k]}' ";
        sql_query($sql);

        $sql = " delete from $g4[group_table] where gr_id = '{$_POST[gr_id][$k]}' ";
        sql_query($sql);
    }
}

goto_url("./boardgroup_list.php?$qstr");
?>
