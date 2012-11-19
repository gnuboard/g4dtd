<?php
$sub_menu = "300100";
include_once("./_common.php");

auth_check($auth[$sub_menu], "w");

$token = get_token();

function b_draw($pos, $color='red') {
    return "border-{$pos}-width:1px; border-{$pos}-color:{$color}; border-{$pos}-style:solid; ";
}

$sql = " select count(*) as cnt from $g4[group_table] ";
$row = sql_fetch($sql);
if (!$row[cnt])
    alert("게시판그룹이 한개 이상 생성되어야 합니다.", "./boardgroup_form.php");

$html_title = "게시판";
if ($w == "") {
    $html_title .= " 생성";

    $required_bo_table = "required alnum_";
    $update_bo_table = "";

    $board[bo_count_delete] = '1';
    $board[bo_count_modify] = '1';
    $board[bo_read_point] = $config[cf_read_point];
    $board[bo_write_point] = $config[cf_write_point];
    $board[bo_comment_point] = $config[cf_comment_point];
    $board[bo_download_point] = $config[cf_download_point];

    $board[bo_gallery_cols] = '4';
    $board[bo_table_width] = '97';
    $board[bo_page_rows] = $config[cf_page_rows];
    $board[bo_subject_len] = '60';
    $board[bo_new] = '24';
    $board[bo_hot] = '100';
    $board[bo_image_width] = '600';
    $board[bo_upload_count] = '2';
    $board[bo_upload_size] = '1048576';
    $board[bo_reply_order] = '1';
    $board[bo_use_search] = '1';
    $board[bo_skin] = 'basic';
    $board[gr_id] = $gr_id;
    $board[bo_disable_tags] = "script|iframe";
    $board[bo_use_secret] = 0;
} else if ($w == "u") {
    $html_title .= " 수정";

    if (!$board[bo_table])
        alert("존재하지 않은 게시판 입니다.");

    if ($is_admin == "group") {
        if ($member[mb_id] != $group[gr_admin])
            alert("그룹이 틀립니다.");
    }

    $required_bo_table = "";
    $update_bo_table = "readonly='readonly' style='background-color:#dddddd'";
}

if ($is_admin != "super") {
    $group = get_group($board[gr_id]);
    $is_admin = is_admin($member[mb_id]);
}

$g4[title] = $html_title;
include_once ("./admin.head.php");

echo dhtml_editor_load();
?>

<?php echo subtitle("게시판 생성"); ?>
<form id='fboardform' method='post' action='#' onsubmit="return fboardform_submit(this)" enctype="multipart/form-data">
<table class='normal3'>
<col width="40" />
<col width="170" />
<col />
<tr>
    <td></td>
    <th>TABLE</th>
    <td>
        <input type='hidden' name='w'     value='<?php echo $w?>' />
        <input type='hidden' name='sfl'   value='<?php echo $sfl?>' />
        <input type='hidden' name='stx'   value='<?php echo $stx?>' />
        <input type='hidden' name='sst'   value='<?php echo $sst?>' />
        <input type='hidden' name='sod'   value='<?php echo $sod?>' />
        <input type='hidden' name='page'  value='<?php echo $page?>' />
        <input type='hidden' name='token' value='<?php echo $token?>' />

        <input type='text' name='bo_table' size='30' maxlength='20' class='text <?php echo $required_bo_table?>' <?php echo $update_bo_table?> title='TABLE' value='<?php echo $board[bo_table] ?>' />
        <?php
        if ($w == "")
            echo "영문자, 숫자, _ 만 가능 (공백없이 20자 이내)";
        else
            echo "<a href='$g4[bbs_path]/board.php?bo_table=$board[bo_table]'><img src='$g4[admin_path]/img/icon_view.gif' alt='' class='icon_btn' /></a>";
        ?>
    </td>
</tr>
<tr>
    <td></td>
    <th>그룹</th>
    <td>
        <?php echo get_group_select('gr_id', $board[gr_id], "class='required' title='그룹'");?>
        <?php if ($w=='u') { ?><a href="javascript:location.href='./board_list.php?sfl=a.gr_id&amp;stx='+document.getElementById('fboardform').gr_id.value;">동일그룹게시판목록</a><?php }?></td>
</tr>
<tr>
    <td></td>
    <th>게시판 제목</th>
    <td>
        <input type='text' name='bo_subject' size='60' maxlength='120' class='text required' title='게시판 제목' value='<?php echo get_text($board[bo_subject])?>' />
    </td>
</tr>
<tr>
    <td></td>
    <th>상단 이미지</th>
    <td>
        <input type='file' name='bo_image_head' class='text' size='60' />
        <?php
        if ($board[bo_image_head])
            echo "<br /><a href='$g4[path]/data/file/{$board['bo_table']}/$board[bo_image_head]'>$board[bo_image_head]</a> <input type='checkbox' name='bo_image_head_del' value='$board[bo_image_head]' /> 삭제";
        ?>
    </td>
</tr>
<tr class="heavy">
    <td></td>
    <th>하단 이미지</th>
    <td>
        <input type='file' name='bo_image_tail' class='text' size='60' />
        <?php
        if ($board[bo_image_tail])
            echo "<br><a href='$g4[path]/data/file/{$board['bo_table']}/$board[bo_image_tail]' target='_blank'>$board[bo_image_tail]</a> <input type='checkbox' name='bo_image_tail_del' value='$board[bo_image_tail]' /> 삭제";
        ?>
    </td>
</tr>

<?php if ($w == "u") { ?>
<tr>
    <td></td>
    <th>카운트 조정</th>
    <td>
        <input type='checkbox' name='proc_count' value='1' /> 카운트를 조정합니다.
        (현재 원글수 : <?php echo number_format($board[bo_count_write])?> , 현재 코멘트수 : <?php echo number_format($board[bo_count_comment])?>)
        <?php echo help("게시판 목록에서 글의 번호가 맞지 않을 경우에 체크하십시오.")?>
    </td>
</tr>
<?php } ?>

<tr class="heavy">
    <td>
        <input type='checkbox' name='chk_admin' value='1' />
        <?php echo help("같은 그룹에 속한 게시판의 설정을 동일하게 변경할 경우에 체크합니다.");?>
    </td>
    <th>게시판 관리자</th>
    <td><input type='text' name='bo_admin' maxlength='20' class='text' value='<?php echo $board[bo_admin]?>' /></td>
</tr>

<tr>
    <td><input type='checkbox' name='chk_list_level' value='1' /></td>
    <th>목록보기 권한</th>
    <td>
        <?php echo get_member_level_select('bo_list_level', 1, 10, $board[bo_list_level]) ?>
        <?php echo help("권한 1은 비회원, 2 이상 회원입니다.\n권한은 10 이 가장 높습니다.", 50)?>
    </td>
</tr>
<tr>
    <td><input type='checkbox' name='chk_read_level' value='1' /></td>
    <th>글읽기 권한</th>
    <td><?php echo get_member_level_select('bo_read_level', 1, 10, $board[bo_read_level]) ?></td>
</tr>
<tr>
    <td><input type='checkbox' name='chk_write_level' value='1' /></td>
    <th>글쓰기 권한</th>
    <td><?php echo get_member_level_select('bo_write_level', 1, 10, $board[bo_write_level]) ?></td>
</tr>
<tr>
    <td><input type='checkbox' name='chk_reply_level' value='1' /></td>
    <th>글답변 권한</th>
    <td><?php echo get_member_level_select('bo_reply_level', 1, 10, $board[bo_reply_level]) ?></td>
</tr>
<tr>
    <td><input type='checkbox' name='chk_comment_level' value='1' /></td>
    <th>코멘트쓰기 권한</th>
    <td><?php echo get_member_level_select('bo_comment_level', 1, 10, $board[bo_comment_level]) ?></td>
</tr>
<tr>
    <td><input type='checkbox' name='chk_link_level' value='1' /></td>
    <th>링크 권한</th>
    <td><?php echo get_member_level_select('bo_link_level', 1, 10, $board[bo_link_level]) ?></td>
</tr>
<tr>
    <td><input type='checkbox' name='chk_upload_level' value='1' /></td>
    <th>업로드 권한</th>
    <td><?php echo get_member_level_select('bo_upload_level', 1, 10, $board[bo_upload_level]) ?></td>
</tr>
<tr>
    <td><input type='checkbox' name='chk_download_level' value='1' /></td>
    <th>다운로드 권한</th>
    <td><?php echo get_member_level_select('bo_download_level', 1, 10, $board[bo_download_level]) ?></td>
</tr>
<tr>
    <td><input type='checkbox' name='chk_html_level' value='1' /></td>
    <th>HTML 쓰기 권한</th>
    <td><?php echo get_member_level_select('bo_html_level', 1, 10, $board[bo_html_level]) ?></td>
</tr>
<tr class="heavy">
    <td><input type='checkbox' name='chk_trackback_level' value='1' /></td>
    <th>트랙백쓰기 권한</th>
    <td>
        <?php echo get_member_level_select('bo_trackback_level', 1, 10, $board[bo_trackback_level]) ?>
        <?php echo help("트랙백이란? 쉽게 설명하여 '내가 작성하는 글을 다른사람에게 알리는 기능' 입니다.\n\n자세한 내용은 검색엔진에서 '트랙백'으로 검색을 해보시기 바랍니다.", 50, -70)?>
    </td>
</tr>

<tr>
    <td><input type='checkbox' name='chk_count_modify' value='1' /></td>
    <th>원글 수정 불가</th>
    <td>코멘트 <input type='text' name='bo_count_modify' size='3' class='text required numeric' title='원글 수정 불가 코멘트수' value='<?php echo $board[bo_count_modify]?>' />개 이상 달리면 수정불가</td>
</tr>
<tr class="heavy">
    <td><input type='checkbox' name='chk_count_delete' value='1' /></td>
    <th>원글 삭제 불가</th>
    <td>코멘트 <input type='text' name='bo_count_delete' size='3' class='text required numeric' title='원글 삭제 불가 코멘트수' value='<?php echo $board[bo_count_delete]?>' />개 이상 달리면 삭제불가</td>
</tr>
<tr>
    <td></td>
    <th>포인트 설정</th>
    <td><input type='checkbox' name='chk_point' onclick='set_point(this.form)' /> 환경설정에 입력된 포인트로 설정</td>
</tr>
<tr>
    <td><input type='checkbox' name='chk_read_point' value='1' /></td>
    <th>글읽기 포인트</th>
    <td><input type='text' name='bo_read_point' size='10' class='text required' title='글읽기 포인트' value='<?php echo $board[bo_read_point]?>' /></td>
</tr>
<tr>
    <td><input type='checkbox' name='chk_write_point' value='1' /></td>
    <th>글쓰기 포인트</th>
    <td><input type='text' name='bo_write_point' size='10' class='text required' title='글쓰기 포인트' value='<?php echo $board[bo_write_point]?>' /></td>
</tr>
<tr>
    <td><input type='checkbox' name='chk_comment_point' value='1' /></td>
    <th>코멘트쓰기 포인트</th>
    <td><input type='text' name='bo_comment_point' size='10' class='text required' title='답변, 코멘트쓰기 포인트' value='<?php echo $board[bo_comment_point]?>' /></td>
</tr>
<tr class="heavy">
    <td><input type='checkbox' name='chk_download_point' value='1' /></td>
    <th>다운로드 포인트</th>
    <td><input type='text' name='bo_download_point' size='10' class='text required' title='다운로드 포인트' value='<?php echo $board[bo_download_point]?>' /></td>
</tr>

<tr class="heavy">
    <td><input type='checkbox' name='chk_category_list' value='1' /></td>
    <th>분류</th>
    <td>
        <input type='text' name='bo_category_list' class='text' style='width:80%;' value='<?php echo get_text($board[bo_category_list])?>' />
        <input type='checkbox' name='bo_use_category' value='1' <?php echo $board[bo_use_category]?"checked='checked'":"";?> /><strong>사용</strong>
        <?php echo help("분류와 분류 사이는 | 로 구분하세요. (예: 질문|답변) 첫자로 #은 입력하지 마세요. (예: #질문|#답변 [X])", -120)?>
    </td>
</tr>

<tr>
    <td><input type='checkbox' name='chk_use_sideview' value='1' /></td>
    <th>글쓴이 사이드뷰</th>
    <td><input type='checkbox' name='bo_use_sideview' value='1' <?php echo $board[bo_use_sideview]?"checked='checked'":"";?> />사용 (글쓴이 클릭시 나오는 레이어 메뉴)</td>
</tr>
<tr>
    <td><input type='checkbox' name='chk_use_secret' value='1' /></td>
    <th>비밀글 사용</th>
    <td>
        <select name='bo_use_secret' id='bo_use_secret'>
        <option value='0'>사용하지 않음</option>
        <option value='1'>체크박스</option>
        <option value='2'>무조건</option>
        </select>
        &nbsp;<?php echo help("'체크박스'는 글작성시 비밀글 체크가 가능합니다.\n\n'무조건'은 작성되는 모든글을 비밀글로 작성합니다. (관리자는 체크박스로 출력합니다.)\n\n스킨에 따라 적용되지 않을 수 있습니다.")?>
        <script type='text/javascript'>document.getElementById('bo_use_secret').value='<?php echo $board[bo_use_secret]?>';</script>
    </td>
</tr>
<tr>
    <td><input type='checkbox' name='chk_use_dhtml_editor' value='1' /></td>
    <th>DHTML 에디터 사용</th>
    <td>
        <input type='checkbox' name='bo_use_dhtml_editor' value='1' <?php echo $board[bo_use_dhtml_editor]?"checked='checked'":"";?> />사용
        &nbsp;<?php echo help("글작성시 내용을 DHTML 에디터 기능으로 사용할 것인지 설정합니다.\n\n스킨에 따라 적용되지 않을 수 있습니다.")?>
    </td>
</tr>
<tr>
    <td><input type='checkbox' name='chk_use_rss_view' value='1' /></td>
    <th>RSS 보이기 사용</th>
    <td>
        <input type='checkbox' name='bo_use_rss_view' value='1' <?php echo $board[bo_use_rss_view]?"checked='checked'":"";?> />사용
        &nbsp;<?php echo help("비회원 글읽기가 가능하고 RSS 보이기 사용에 체크가 되어야만 RSS 지원을 합니다.")?>
    </td>
</tr>
<tr>
    <td><input type='checkbox' name='chk_use_good' value='1' /></td>
    <th>추천 사용</th>
    <td><input type='checkbox' name='bo_use_good' value='1' <?php echo $board[bo_use_good]?"checked='checked'":"";?> />사용</td>
</tr>
<tr>
    <td><input type='checkbox' name='chk_use_nogood' value='1' /></td>
    <th>비추천 사용</th>
    <td><input type='checkbox' name='bo_use_nogood' value='1' <?php echo $board[bo_use_nogood]?"checked='checked'":"";?> />사용</td>
</tr>
<tr>
    <td><input type='checkbox' name='chk_use_name' value='1' /></td>
    <th>이름(실명) 사용</th>
    <td><input type='checkbox' name='bo_use_name' value='1' <?php echo $board[bo_use_name]?"checked='checked'":"";?> />사용</td>
</tr>
<tr>
    <td><input type='checkbox' name='chk_use_signature' value='1' /></td>
    <th>서명보이기 사용</th>
    <td><input type='checkbox' name='bo_use_signature' value='1' <?php echo $board[bo_use_signature]?"checked='checked'":"";?> />사용</td>
</tr>
<tr>
    <td><input type='checkbox' name='chk_use_ip_view' value='1' /></td>
    <th>IP 보이기 사용</th>
    <td><input type='checkbox' name='bo_use_ip_view' value='1' <?php echo $board[bo_use_ip_view]?"checked='checked'":"";?> />사용</td>
</tr>
<tr>
    <td><input type='checkbox' name='chk_use_trackback' value='1' /></td>
    <th>트랙백 사용</th>
    <td><input type='checkbox' name='bo_use_trackback' value='1' <?php echo $board[bo_use_trackback]?"checked='checked'":"";?> />사용 (트랙백쓰기 권한 보다 우선함)</td>
</tr>
<tr>
    <td><input type='checkbox' name='chk_use_list_content' value='1' /></td>
    <th>목록에서 내용 사용</th>
    <td><input type='checkbox' name='bo_use_list_content' value='1' <?php echo $board[bo_use_list_content]?"checked='checked'":"";?> />사용 (사용시 속도 느려짐)</td>
</tr>
<tr>
    <td><input type='checkbox' name='chk_use_list_view' value='1' /></td>
    <th>전체목록보이기 사용</th>
    <td><input type='checkbox' name='bo_use_list_view' value='1' <?php echo $board[bo_use_list_view]?"checked='checked'":"";?> />사용</td>
</tr>
<tr class="heavy">
    <td><input type='checkbox' name='chk_use_email' value='1' /></td>
    <th>메일발송 사용</th>
    <td><input type='checkbox' name='bo_use_email' value='1' <?php echo $board[bo_use_email]?"checked='checked'":"";?> />사용</td>
</tr>

<tr>
    <td><input type='checkbox' name='chk_skin' value='1' /></td>
    <th>스킨 디렉토리</th>
    <td><select name='bo_skin' class='required' title='스킨 디렉토리'>
        <?php
        $arr = get_skin_dir("board");
        for ($i=0; $i<count($arr); $i++) {
            echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
        }
        ?></select>
        <script type='text/javascript'>document.getElementById('fboardform').bo_skin.value="<?php echo $board[bo_skin]?>";</script>
    </td>
</tr>
<tr>
    <td><input type='checkbox' name='chk_gallery_cols' value='1' /></td>
    <th>가로 이미지수</th>
    <td><input type='text' name='bo_gallery_cols' size='10' class='text required' title='가로 이미지수' value='<?php echo $board[bo_gallery_cols]?>' />
        <?php echo help("갤러리 형식의 게시판 목록에서 이미지를 한줄에 몇장씩 보여줄것인지를 설정하는 값")?></td>
</tr>
<tr>
    <td><input type='checkbox' name='chk_table_width' value='1' /></td>
    <th>게시판 테이블 폭</th>
    <td><input type='text' name='bo_table_width' size='10' class='text required' title='게시판 테이블 폭' value='<?php echo $board[bo_table_width]?>' /> 100 이하는 %</td>
</tr>
<tr>
    <td><input type='checkbox' name='chk_page_rows' value='1' /></td>
    <th>페이지당 목록 수</th>
    <td><input type='text' name='bo_page_rows' size='10' class='text required' title='페이지당 목록 수' value='<?php echo $board[bo_page_rows]?>' /></td>
</tr>
<tr>
    <td><input type='checkbox' name='chk_subject_len' value='1' /></td>
    <th>제목 길이</th>
    <td><input type='text' name='bo_subject_len' size='10' class='text required' title='제목 길이' value='<?php echo $board[bo_subject_len]?>' /> 목록에서의 제목 글자수. 잘리는 글은 … 로 표시</td>
</tr>
<tr>
    <td><input type='checkbox' name='chk_new' value='1' /></td>
    <th>new 이미지</th>
    <td><input type='text' name='bo_new' size='10' class='text required' title='new 이미지' value='<?php echo $board[bo_new]?>' /> 글 입력후 new 이미지를 출력하는 시간</td>
</tr>
<tr>
    <td><input type='checkbox' name='chk_hot' value='1' /></td>
    <th>hot 이미지</th>
    <td><input type='text' name='bo_hot' size='10' class='text required' title='hot 이미지' value='<?php echo $board[bo_hot]?>' /> 조회수가 설정값 이상이면 hot 이미지 출력</td>
</tr>
<tr>
    <td><input type='checkbox' name='chk_image_width' value='1' /></td>
    <th>이미지 폭 크기</th>
    <td><input type='text' name='bo_image_width' size='10' class='text required' title='이미지 폭 크기' value='<?php echo $board[bo_image_width]?>' /> 픽셀 (게시판에서 출력되는 이미지의 폭 크기)</td>
</tr>
<tr>
    <td><input type='checkbox' name='chk_reply_order' value='1' /></td>
    <th>답변 달기</th>
    <td>
        <select name='bo_reply_order'>
        <option value='1'>나중에 쓴 답변 아래로 달기 (기본)</option>
        <option value='0'>나중에 쓴 답변 위로 달기</option>
        </select>
        <script type='text/javascript'> document.getElementById('fboardform').bo_reply_order.value = '<?php echo $board[bo_reply_order]?>'; </script>
    </td>
</tr>

<?/*?>
<tr>
    <td><input type='checkbox' name='chk_disable_tags' value='1' /></td>
    <td>사용금지 태그</td>
    <td><input type='text' name='bo_disable_tags' class='text' style='width:80%;' value='<?php echo get_text($board[bo_disable_tags])?>' />
        <?php echo help("태그와 태그 사이는 | 로 구분하세요. (예: <b>script</b>|<b>iframe</b>)\n\nHTML 사용시 금지할 태그를 입력하는곳 입니다.", -50)?></td>
</tr>
<?*/?>

<tr class="heavy">
    <td><input type='checkbox' name='chk_sort_field' value='1' /></td>
    <th>리스트 정렬 필드</th>
    <td>
        <select name='bo_sort_field'>
        <option value=''>wr_num, wr_reply : 기본</option>
        <option value='wr_datetime asc'>wr_datetime asc : 날짜 이전것 부터</option>
        <option value='wr_datetime desc'>wr_datetime desc : 날짜 최근것 부터</option>
        <option value='wr_hit asc, wr_num, wr_reply'>wr_hit asc : 조회수 낮은것 부터</option>
        <option value='wr_hit desc, wr_num, wr_reply'>wr_hit desc : 조회수 높은것 부터</option>
        <option value='wr_last asc'>wr_last asc : 최근글 이전것 부터</option>
        <option value='wr_last desc'>wr_last desc : 최근글 최근것 부터</option>
        <option value='wr_comment asc, wr_num, wr_reply'>wr_comment asc : 코멘트수 낮은것 부터</option>
        <option value='wr_comment desc, wr_num, wr_reply'>wr_comment asc : 코멘트수 높은것 부터</option>
        <option value='wr_good asc, wr_num, wr_reply'>wr_good asc : 추천수 낮은것 부터</option>
        <option value='wr_good desc, wr_num, wr_reply'>wr_good asc : 추천수 높은것 부터</option>
        <option value='wr_nogood asc, wr_num, wr_reply'>wr_nogood asc : 비추천수 낮은것 부터</option>
        <option value='wr_nogood desc, wr_num, wr_reply'>wr_nogood asc : 비추천수 높은것 부터</option>
        <option value='wr_subject asc, wr_num, wr_reply'>wr_subject : 제목 내림차순</option>
        <option value='wr_subject desc, wr_num, wr_reply'>wr_subject : 제목 오름차순</option>
        <option value='wr_name asc, wr_num, wr_reply'>wr_name : 글쓴이 내림차순</option>
        <option value='wr_name desc, wr_num, wr_reply'>wr_name : 글쓴이 오름차순</option>
        <option value='ca_name asc, wr_num, wr_reply'>ca_name : 분류명 내림차순</option>
        <option value='ca_name desc, wr_num, wr_reply'>ca_name : 분류명 오름차순</option>
        </select>
        <script type='text/javascript'> document.getElementById('fboardform').bo_sort_field.value = '<?php echo $board[bo_sort_field]?>'; </script>
        <?php echo help("리스트에서 기본으로 정렬에 사용할 필드를 선택합니다.\n\n'기본'으로 사용하지 않으시는 경우 속도가 느려질 수 있습니다.", -50)?>
    </td>
</tr>

<tr>
    <td><input type='checkbox' name='chk_write_min' value='1' /></td>
    <th>최소 글수 제한</th>
    <td><input type='text' name='bo_write_min' size='5' class='text numeric' value='<?php echo $board[bo_write_min]?>' />
        (글 입력시 최소 글자수를 설정. 0을 입력하면 검사하지 않음)</td>
</tr>
<tr>
    <td><input type='checkbox' name='chk_write_max' value='1' /></td>
    <th>최대 글수 제한</th>
    <td><input type='text' name='bo_write_max' size='5' class='text numeric' value='<?php echo $board[bo_write_max]?>' />
        (글 입력시 최대 글자수를 설정. 0을 입력하면 검사하지 않음)</td>
</tr>
<tr>
    <td><input type='checkbox' name='chk_comment_min' value='1' /></td>
    <th>최소 코멘트수 제한</th>
    <td><input type='text' name='bo_comment_min' size='5' class='text numeric' value='<?php echo $board[bo_comment_min]?>' />
        (코멘트 입력시 최소 글자수, 최대 글자수를 설정. 0을 입력하면 검사하지 않음)</td>
</tr>
<tr class="heavy">
    <td><input type='checkbox' name='chk_comment_max' value='1' /></td>
    <th>최대 코멘트수 제한</th>
    <td><input type='text' name='bo_comment_max' size='5' class='text numeric' value='<?php echo $board[bo_comment_max]?>' />
        (코멘트 입력시 최소 글자수, 최대 글자수를 설정. 0을 입력하면 검사하지 않음)</td>
</tr>

<tr>
    <td><input type='checkbox' name='chk_upload_count' value='1' /></td>
    <th>파일 업로드 갯수</th>
    <td><input type='text' name='bo_upload_count' size='10' class='text required' title='파일 업로드 갯수' value='<?php echo $board[bo_upload_count]?>' /> 게시물 한건당 업로드 할 수 있는 파일의 최대 개수 (0 이면 제한 없음)</td>
</tr>
<?php
$upload_max_filesize = ini_get("upload_max_filesize");
if (!preg_match("/([m|M])$/", $upload_max_filesize)) {
    $upload_max_filesize = (int)($upload_max_filesize / 1048576);
}
?>
<tr class="heavy">
    <td><input type='checkbox' name='chk_upload_size' value='1' /></td>
    <th>파일 업로드 용량</th>
    <td>업로드 파일 한개당 <input type='text' name='bo_upload_size' size='10' class='text required' title='파일 업로드 용량' value='<?php echo $board[bo_upload_size]?>' /> bytes 이하 (최대 <?php echo ini_get("upload_max_filesize")?> 이하) <?php echo help("1 MB = 1,024,768 bytes")?></td>
</tr>

<tr>
    <td><input type='checkbox' name='chk_include_head' value='1' /></td>
    <th>상단 파일 경로</th>
    <td><input type='text' name='bo_include_head' class='text' style='width:80%;' value='<?php echo $board[bo_include_head]?>' /></td>
</tr>
<tr class="heavy">
    <td><input type='checkbox' name='chk_include_tail' value='1' /></td>
    <th>하단 파일 경로</th>
    <td><input type='text' name='bo_include_tail' class='text' style='width:80%;' value='<?php echo $board[bo_include_tail]?>' /></td>
</tr>

<tr>
    <td><input type='checkbox' name='chk_content_head' value='1' /></td>
    <th>상단 내용</th>
    <td><textarea id='bo_content_head' name='bo_content_head' class='textarea' rows='10' cols="90" geditor><?php echo $board[bo_content_head] ?></textarea></td>
</tr>
<tr class="heavy">
    <td><input type='checkbox' name='chk_content_tail' value='1' /></td>
    <th>하단 내용</th>
    <td><textarea id='bo_content_tail' name='bo_content_tail' class='textarea' rows='10' cols="90" geditor><?php echo $board[bo_content_tail] ?></textarea></td>
</tr>

<tr class="heavy">
    <td><input type='checkbox' name='chk_insert_content' value='1' /></td>
    <th>글쓰기 기본 내용</th>
    <td><textarea name='bo_insert_content' rows='10' cols='90' class='textarea'><?php echo $board[bo_insert_content] ?></textarea></td>
</tr>

<tr>
    <td><input type='checkbox' name='chk_use_search' value='1' /></td>
    <th>전체 검색 사용</th>
    <td><input type='checkbox' name='bo_use_search' value='1' <?php echo $board[bo_use_search]?"checked='checked'":"";?> />사용</td>
</tr>
<tr class="heavy">
    <td><input type='checkbox' name='chk_order_search' value='1' /></td>
    <th>전체 검색 순서</th>
    <td><input type='text' name='bo_order_search' size='5' class='text' value='<?php echo $board[bo_order_search]?>' /> 숫자가 낮은 게시판 부터 검색</td>
</tr>

<?php for ($i=1; $i<=10; $i++) { ?>
<tr>
    <td><input type='checkbox' name='chk_<?php echo $i?>' value='1' /></td>
    <td><input type='text' name='bo_<?php echo $i?>_subj' class='text' value='<?php echo get_text($board["bo_{$i}_subj"])?>' title='여분필드 <?php echo $i?> 제목' style='text-align:right;font-weight:bold;' /></td>
    <td><input type='text' name='bo_<?php echo $i?>' class='text' style='width:80%;' value='<?php echo get_text($board["bo_$i"])?>' title='여분필드 <?php echo $i?> 설정값' /></td>
</tr>
<?php } ?>

<tr class="heavy">
    <td colspan=3 align=left><?php echo subtitle("XSS / CSRF 방지")?></td>
</tr>
<tr class="heavy">
    <td></td>
    <th>관리자 패스워드</th>
    <td>
        <input class='ed text required' type='password' name='admin_password' title="관리자 패스워드" >
        <?php echo help("관리자 권한을 빼앗길 것에 대비하여 로그인한 관리자의 패스워드를 한번 더 묻는것 입니다.");?>
    </td>
</tr>
</table>

<p class='center'>
    <input type='submit' class='btn1' accesskey='s' value='  확  인  ' />&nbsp;
    <input type='button' class='btn1' value='  목  록  ' onclick="document.location.href='./board_list.php?<?php echo $qstr?>';" />&nbsp;
    <?php if ($w == 'u') { ?><input type='button' class='btn1' value='  복  사  ' onclick="board_copy('<?php echo $bo_table?>');" /><?php }?>
</p>
</form>

<script type='text/javascript'>
//<![CDATA[
$(function() {
    $("#fboardform :input[type=text]:visible:enabled:first").focus();
});

function board_copy(bo_table) {
    window.open("./board_copy.php?bo_table="+bo_table, "BoardCopy", "left=10,top=10,width=500,height=200");
}

function set_point(f) {
    if (f.chk_point.checked) {
        f.bo_read_point.value     = "<?php echo $config[cf_read_point]?>";
        f.bo_write_point.value    = "<?php echo $config[cf_write_point]?>";
        f.bo_comment_point.value  = "<?php echo $config[cf_comment_point]?>";
        f.bo_download_point.value = "<?php echo $config[cf_download_point]?>";
    } else {
        f.bo_read_point.value     = f.bo_read_point.defaultValue;
        f.bo_write_point.value    = f.bo_write_point.defaultValue;
        f.bo_comment_point.value  = f.bo_comment_point.defaultValue;
        f.bo_download_point.value = f.bo_download_point.defaultValue;
    }
}

function fboardform_submit(f) {
    var tmp_title;
    var tmp_image;

    tmp_title = "상단";
    tmp_image = f.bo_image_head;
    if (tmp_image.value) {
        if (!tmp_image.value.toLowerCase().match(/.(gif|jpg|png)$/i)) {
            alert(tmp_title + "이미지가 gif, jpg, png 파일이 아닙니다.");
            return false;
        }
    }

    tmp_title = "하단";
    tmp_image = f.bo_image_tail;
    if (tmp_image.value) {
        if (!tmp_image.value.toLowerCase().match(/.(gif|jpg|png)$/i)) {
            alert(tmp_title + "이미지가 gif, jpg, png 파일이 아닙니다.");
            return false;
        }
    }

    if (parseInt(f.bo_count_modify.value) < 1) {
        alert("원글 수정 불가 코멘트수는 1 이상 입력하셔야 합니다.");
        f.bo_count_modify.focus();
        return false;
    }

    if (parseInt(f.bo_count_delete.value) < 1) {
        alert("원글 삭제 불가 코멘트수는 1 이상 입력하셔야 합니다.");
        f.bo_count_delete.focus();
        return false;
    }

    f.action = "./board_form_update.php";
    return true;
}
//]]>
</script>

<?php
include_once ("./admin.tail.php");
?>
