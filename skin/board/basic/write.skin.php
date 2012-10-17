<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

if ($is_file) {
    $flen_limit = (int)$board['bo_upload_count'];
    if ($flen_limit == 0)
        $flen_each = 2; // 무한일 때 반복수
    else // 제한 있을 때
        $flen_each = $flen_limit;
}
?>

<script type="text/javascript">
// 글자수 제한
// 이 코드는 board.skin.js 위에 선언이 되어야 합니다.
//<![CDATA[
var char_min = parseInt(<?php echo $write_min?>); // 최소
var char_max = parseInt(<?php echo $write_max?>); // 최대
var flen = 0; // 첨부파일 카운터
var flen_limit = <?php echo $flen_limit?>;
var flen_each = <?php echo $flen_each?>;
var ca_name = "<?php echo $write['ca_name']?>";
//]]>
</script>

<div id='board_write' style='width: <?php echo $bo_table_width?>;'>

    <form id="fwrite" method="post" action="<?php echo $g4['https_url'] ? "{$g4['https_url']}/{$g4['bbs']}" : $g4['bbs_path']; ?>/write_update.php" enctype="multipart/form-data">
    <input type="hidden" name="w"        value="<?php echo $w?>" />
    <input type="hidden" name="bo_table" value="<?php echo $bo_table?>" />
    <input type="hidden" name="wr_id"    value="<?php echo $wr_id?>" />
    <input type="hidden" name="sca"      value="<?php echo $sca?>" />
    <input type="hidden" name="sfl"      value="<?php echo $sfl?>" />
    <input type="hidden" name="stx"      value="<?php echo $stx?>" />
    <input type="hidden" name="spt"      value="<?php echo $spt?>" />
    <input type="hidden" name="sst"      value="<?php echo $sst?>" />
    <input type="hidden" name="sod"      value="<?php echo $sod?>" />
    <input type="hidden" name="page"     value="<?php echo $page?>" />
    <?php echo $option_hidden?>

    <div class='title_msg'><?php echo $title_msg?></div>

    <table cellspacing='0' class='write_table'>
    <?php if ($is_name) { ?>
    <tr>
        <th>이름</th>
        <td><input type="text" id="wr_name" name="wr_name" maxlength="20" class="text required hangulalpha" title="이름" value="<?php echo $name?>" /></td>
    </tr>
    <?php } ?>
    <?php if ($is_password) { ?>
    <tr>
        <th>비밀번호</th>
        <td><input type="password" id="wr_password" name="wr_password" maxlength="20" class="text <?php echo ($w==""?'required':'');?>" title="비밀번호" /></td>
    </tr>
    <?php } ?>
    <?php if ($is_email) { ?>
    <tr>
        <th>이메일</th>
        <td><input type="text" id="wr_email" name="wr_email" size="50" maxlength="100" class="text email" value="<?php echo $email?>" title="이메일" /></td>
    </tr>
    <?php } ?>
    <?php if ($is_homepage) { ?>
    <tr>
        <th>홈페이지</th>
        <td><input type="text" id="wr_homepage" name="wr_homepage" size="50" class="text" value="<?php echo $homepage?>" /></td>
    </tr>
    <?php } ?>
    <?php if ($option) { ?>
    <tr>
        <th>옵션</th>
        <td><?php echo $option?></td>
    </tr>
    <?php } ?>
    <?php if ($is_category) { ?>
    <tr>
        <th>분류</th>
        <td>
            <select id="ca_name" name="ca_name" class="required" title="분류">
                <option value="">선택하세요</option>
                <?php echo $category_option?>
            </select>
        </td>
    </tr>
    <?php } ?>
    <tr>
        <th>제목</th>
        <td><input type="text" id="wr_subject" name="wr_subject" maxlength="255" class="text title required" title="제목" value="<?php echo $subject?>" /></td>
    </tr>
    <tr>
        <td colspan="2">
            <?php if(!$is_dhtml_editor){?>
            <div class="textarea_control">
                <div class="float">
                    <span class="button" onclick="javascript:textarea_decrease('wr_content', 10);"><img src="<?php echo $board_skin_path?>/img/btn_txt_up.gif" alt="줄이기" /></span>
                    <span class="button" onclick="javascript:textarea_original('wr_content', 10);"><img src="<?php echo $board_skin_path?>/img/btn_txt_default.gif" alt="기본" /></span>
                    <span class="button" onclick="javascript:textarea_increase('wr_content', 10);"><img src="<?php echo $board_skin_path?>/img/btn_txt_down.gif" alt="늘이기" /></span>
                </div>
                <div class="right"><?php if ($write_min || $write_max) { ?><span id="char_count"></span>글자<?php } ?></div>
            </div>
            <?php } ?>
            <textarea id="wr_content" name="wr_content" class="textarea required <?php if ($is_dhtml_editor) echo 'geditor'; ?>" rows="10" cols="1" title="내용"><?php echo $content?></textarea>
        </td>
    </tr>

    <?php if ($is_trackback) { ?>
    <tr>
        <th>트랙백</th>
        <td>
            <input type="text" size="60" id="wr_trackback" name="wr_trackback" class="text" value="<?php echo $trackback?>" />
    <?php if ($w == "u") { ?>
            <label><input type="checkbox" name="re_trackback" name="id_trackback" value="1" />핑 보냄</label>
    <?php } // if ($w) ?>
        </td>
    </tr>
    <?php }  ?>

    <?php if ($is_link)
        for ($i=1; $i<=$g4['link_count']; $i++) { ?>
    <tr>
        <th>링크 #<?php echo $i?></th>
        <td><input type="text" size="60" id="wr_link<?php echo $i?>" name="wr_link<?php echo $i?>" class="text" value="<?php echo $write["wr_link{$i}"]?>" /></td>
    </tr>
    <?php } // for, if ?>
    <?php if ($is_file) { ?>
    <tr>
        <th>파일첨부
            <a href="javascript:;" id="add_file"><img src="<?php echo "$board_skin_path/img/icon_file_plus.gif"?>" alt="파일추가" /></a>
            <a href="javascript:;" id="del_file"><img src="<?php echo "$board_skin_path/img/icon_file_minus.gif"?>" alt="파일추가삭제" /></a>
        </th>
        <td>
            <ul id="variableFiles">
            <?php for ($i = 0; $i < $flen_each; $i++) {
                $wu = "";
                if ($w == "u" && $file[$i])
                    $wu = "wu";
            ?>
            <li class="<?php if ($wu) echo $wu; ?>">
                <span class="basicForm">
                    <input type="file" class="ed file" name="bf_file[]" title="파일 용량 <?php echo $upload_max_filesize?> 이하만 업로드 가능" />
                    <?php if($is_file_content) { ?><input type="text" class="ed" size="50" name="bf_content[]" title="업로드 이미지 파일에 해당 되는 내용을 입력하세요." value="<?php if ($wu) echo $file[$i]['content']; ?>" /><?php } ?>
                </span>
                <?php if ($wu) { ?>
                <input type="checkbox" name="bf_file_del[<?php echo $i?>]" id="bf_file_del<?php echo $i?>" value="1" />
                <a href="<?php echo $file[$i]['href']?>"><?php echo $file[$i]['source']?>(<?php echo $file[$i]['size']?>)</a>
                <label for="bf_file_del<?php echo $i?>">파일삭제</label>
                <?php } ?>
            </li>
            <?php } ?>
            </ul>
        </td>
    </tr>
    <?php } ?>
    <?php if ($is_guest) { ?>
    <tr>
        <th><img id='kcaptcha_image' src='#' alt='캡챠이미지' /></th>
        <td>
            <p><input type='text' name='wr_key' size='10' class='captcha_key text required' title='자동등록방지 코드' />
            왼쪽의 자동등록방지용 코드를 순서대로 입력하세요.</p>
        </td>
    </tr>
    <?php } ?>
    </table>

    <div class='btn_area'>
        <div class='fl'><input type='image' src='<?php echo $board_skin_path?>/img/btn_write_confirm.gif' alt='글쓰기' /></div>
        <div class='fr'><a href='./board.php?bo_table=<?php echo $bo_table?>'><img src='<?php echo $board_skin_path?>/img/btn_list.gif' alt='목록' /></a></div>
    </div>
    </form>

</div><!-- #board_write -->

<script type="text/javascript" src="<?php echo $g4[path]?>/js/md5.js"></script>
<script type="text/javascript" src="<?php echo $g4[path]?>/js/jquery.kcaptcha.js"></script>
<script type="text/javascript">
//<![CDATA[
$(function() {
    if ($('#ca_name').length) {
        if (typeof(g4_admin) != 'undefined') {
            var option = new Option('공지', '공지');
            if ($.browser.msie) {
                $('#ca_name')[0].add(option);
            } else {
                $('#ca_name')[0].add(option, null);
            }
        }

        $('#ca_name').val(ca_name);
    }

    // 파일 첨부
    // $('#variable').append("<table id='variable_files' cellspacing='0'><tbody></tbody></table>").css({'margin':'0px','padding':'0px'});

    $("#variableFiles li").each(function() {
        if(!$(this).hasClass("wu")) {
            $(this).css("display", "none");
        } else {
            flen++;
        }
    });

    <?php
    //무조건 첨부필드를 1개 추가하는것을 방지. 수정시 첨부파일이 최대첨부 개수와 같으면 alert 창이 뜬다.
    if ($flen_limit > $file['count'] - 1) {
        $trigger = ".trigger(\"click\");";
    } else {
        $trigger = ";";
    } ?>
     $("#add_file").click(function() {
        if (flen_limit && flen >= flen_limit) {
            alert("이 게시판은 " + flen_limit + "개 까지만 파일 업로드가 가능합니다.");
            return false;
        } else if ( $("#variableFiles li").length < flen_each || (flen_limit == 0 && flen >= flen_each) ) {
            $("#variableFiles").append("<li>" + $("#variableFiles li:eq(0) > span.basicForm").html() + "</li>");
        } else {
            $("#variableFiles li").eq(flen).css("display", "");
        }
        flen++;
    })<?php echo $trigger?>

    $("#del_file").click(function() {
        if (flen <= 1) {
            alert("더이상 삭제할 수 없습니다!");
            return false;
        } else {
            $("#variableFiles li").eq(flen - 1).remove();
        }
        flen--;
    });

    $("#wr_content")
    .load(function() {
        if($(this).hasClass("geditor")) {
            $(this).attr("geditor", "geditor");
        }
    })
    .keyup(function() {
        if(char_min || char_max) {
            check_byte('wr_content', 'char_count');
        }
    })
    .trigger("load")
    .trigger("keyup");

    // 포커스
    $("#fwrite")
    .attr("autocomplete", "off")
    .submit(function() {
        if($("#char_count") && (char_min > 0 || char_max > 0)) {
            var cnt = parseInt($("#char_count").html());
            if (char_min > 0 && char_min > cnt) {
                 alert("내용은 " + char_min + "글자 이상 쓰셔야 합니다.");
                 return false;
            }
            else if (char_max > 0 && char_max < cnt) {
                alert("내용은 " + char_max + "글자 이하로 쓰셔야 합니다.");
                return false;
            }
        }

        var subject = "";
        var content = "";
        $.ajax({
            url: g4_bbs_path + "/ajax.filter.php",
            type: "POST",
            data: {
                "subject": $("#wr_subject").val(),
                "content": $("#wr_content").val()
            },
            dataType: "json",
            async: false,
            cache: false,
            success: function(data, textStatus) {
                subject = data.subject;
                content = data.content;
            }
        });

        if (subject) {
            alert("제목에 금지단어('"+subject+"')가 포함되어있습니다");
            $("wr_subject").focus();
            return false;
        }

        if (content) {
            alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
            if (typeof(ed_wr_content) != "undefined")
                ed_wr_content.returnFalse();
            else
                $("wr_content").focus();
            return false;

        }
        if (!check_kcaptcha($("wr_key").val())) {
            return false;
        }
    })
    .find(":input[type=text]:visible:enabled:first").focus();
});
//]]>
</script>

<?php if ($is_dhtml_editor) { ?><script type='text/javascript' src='<?php echo $g4['geditor_path']?>/geditor.js'></script><?php } ?>