<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

include_once("$g4[bbs_path]/kcaptcha_config.php");
?>

<script type="text/javascript">
//<![CDATA[
// 글자수 제한
var char_min = parseInt(<?php echo $comment_min?>); // 최소
var char_max = parseInt(<?php echo $comment_max?>); // 최대
//]]>
</script>

<!-- 코멘트 리스트 -->
<div id='board_comment'>
    <?php
    for ($i=0; $i<count($list); $i++) {
        $comment_id = $list[$i][wr_id];

        $reply_len = strlen($list[$i][wr_comment_reply]);
        $reply_begin = $reply_end = "";
        if ($reply_len) {
            $reply_begin = "<div class='reply' style='margin-left:".($reply_len * 15)."px;'>";
            $reply_end = "</div><!-- .reply -->";
        }
    ?>
    <div class='comment_area'>
        <a name='c_<?php echo $comment_id?>'></a>
        <?php echo $reply_begin?>
        <div class='comment_list'>
            <div class='author_area'>
                <span class='author'><?php echo $list[$i][name]?></span>
                <span class='date'><?php echo str_replace("-", ".", $list[$i][wr_datetime])?></span>
                <?php if ($is_ip_view) echo "<span class='ipaddress'>({$list[$i][ip]})</span>"; ?>
            </div>
            <div class='option_area'>
                <?php if ($list[$i][is_reply]) { ?><span><a href='javascript:;' class='cmnt_reply' rel='<?php echo $comment_id?>'>답변</a></span><?php } ?>
                <?php if ($list[$i][is_edit]) { ?><span><a href='javascript:;' class='cmnt_update' rel='<?php echo $comment_id?>'>수정</a></span><?php } ?>
                <?php if ($list[$i][is_del]) { ?><span><a href='<?php echo $list[$i][del_link]?>' class='cmnt_delete' onclick='return false;'>삭제</a></span><?php } ?>
            </div>
            <div class='content'>
                <?php
                if (strstr($list[$i][wr_option], "secret")) echo "<img src='$board_skin_path/img/icon_secret.gif' class='icon_secret' alt='비밀글' /> ";
                $str = $list[$i][content];
                if (strstr($list[$i][wr_option], "secret"))
                    $str = "<span class='secret'>$str</span>";

                $str = preg_replace("/\[\<a\s.*href\=\"(http|https|ftp|mms)\:\/\/([^[:space:]]+)\.(mp3|wma|wmv|asf|asx|mpg|mpeg)\".*\<\/a\>\]/i", "<script>doc_write(obj_movie('$1://$2.$3'));</script>", $str);
                //$str = preg_replace("/\[\<a\s.*href\=\"(http|https|ftp)\:\/\/([^[:space:]]+)\.(swf)\".*\<\/a\>\]/i", "<script>doc_write(flash_movie('$1://$2.$3'));</script>", $str);
                //$str = preg_replace("/\[\<a\s*href\=\"(http|https|ftp)\:\/\/([^[:space:]]+)\.(gif|png|jpg|jpeg|bmp)\"\s*[^\>]*\>[^\s]*\<\/a\>\]/i", "<img src='$1://$2.$3' id='target_resize_image[]' onclick='image_window(this);' border='0'>", $str);
                echo $str;
                ?>

            </div>
        </div><!-- .comment_list -->
        <?php echo $reply_end?>
    </div><!-- .comment_area -->
    <?php } ?>

    <?php if ($is_comment_write) { ?>
    <!-- 코멘트 쓰기 -->
    <div id='comment_write'>
        <form id='fcomment' method='post' action='#' onsubmit='return fcomment_submit(this);'>
        <fieldset>
        <input type='hidden' name='w'           id='w' value='c' />
        <input type='hidden' name='bo_table'    value='<?php echo $bo_table?>' />
        <input type='hidden' name='wr_id'       value='<?php echo $wr_id?>' />
        <input type='hidden' name='comment_id'  id='comment_id' value='' />
        <input type='hidden' name='sca'         value='<?php echo $sca?>'  />
        <input type='hidden' name='sfl'         value='<?php echo $sfl?>'  />
        <input type='hidden' name='stx'         value='<?php echo $stx?>' />
        <input type='hidden' name='spt'         value='<?php echo $spt?>' />
        <input type='hidden' name='page'        value='<?php echo $page?>' />
        <input type='hidden' name='is_good'     value='' />

        <div class='author_area'>
            <div class='author'>
            <?php if ($is_guest) { ?>
                <span>이름 <input type='text' id='wr_name' name='wr_name' maxlength='20' size='10' class='text required hangulalpha' title='이름' /></span>
                <span>비밀번호 <input type='password' name='wr_password' id='wr_password' maxlength='20' size='10' class='text required' title='비밀번호' /></span>
                <span><img id='kcaptcha_image' src='#' alt='' /> <input type='text' name='wr_key' id='wr_key' size='7' class='text required' title='자동등록방지 코드' /></span>
            <?php } ?>
                <span><label><input type='checkbox' name='wr_secret' id='wr_secret' value='secret' /> 비밀글</label></span>
            <?php if ($comment_min || $comment_max) { ?>
                <span>(코멘트 <span id='char_count'>0</span> 글자)</span>
            <?php } ?>
            </div>
        </div>
        <div class='content_area'>
            <div class='content'>
                <div class='text'>
                    <textarea id='wr_content' name='wr_content' rows='1' cols='1' class='textarea required' title='코멘트'></textarea>
                </div>
            </div>
            <div class='button'><input type='image' src='<?php echo $board_skin_path?>/img/btn_cmt_write.gif' alt='' /></div>
        </div>
        </fieldset>
        </form>
    </div><!-- 코멘트 쓰기 -->
    <?php } ?>

</div><!-- #board_comment -->


<!-- 코멘트 js -->
<script type="text/javascript" src="<?php echo $g4[path]?>/js/md5.js"></script>
<script type="text/javascript" src="<?php echo $g4[path]?>/js/jquery.kcaptcha.js"></script>
<script type="text/javascript">
//<![CDATA[
// 코멘트쓰기 전송전 검사
function fcomment_submit(f)
{
    if (typeof(f.wr_password) != "undefined") {
        if (f.wr_password.value == "") {
            alert("비밀번호를 입력하십시오.");
            f.wr_password.focus();
            return false;
        }
    }

    if (!check_kcaptcha(f.wr_key)) {
        return false;
    }

    var comment = document.getElementById("wr_content");

    var s;
    if (s = word_filter_check(comment.value)) {
        alert("코멘트에 금지단어('"+s+"')가 포함되어있습니다");
        comment.focus();
        return false;
    }

    if (char_min > 0 || char_max > 0) {
        check_byte("wr_content", "char_count");
        var cnt = parseInt(document.getElementById("char_count").innerHTML);
        if (char_min > 0 && char_min > cnt) {
            alert("코멘트는 "+char_min+"글자 이상 쓰셔야 합니다.");
            comment.focus();
            return false;
        } else if (char_max > 0 && char_max < cnt) {
            alert("코멘트는 "+char_max+"글자 이하로 쓰셔야 합니다.");
            comment.focus();
            return false;
        }
    }

    f.action = "./write_comment_update.php";

    return true;
}

$(function() {
    // 코멘트 답변의 배경이미지 설정 (css 에서는 별도로 설정되지 않음)
    $("#board_comment .comment_area .reply")
        .css("background", "url(<?php echo $board_skin_path?>/img/icon_cmt_reply.gif) no-repeat left 11px")
        .css("padding-left", "15px");

    // 코멘트 글자수
    $("#wr_content").bind("keyup", function() {
        if ($("#char_count")[0])
            check_byte("wr_content", "char_count");
    });

    // 코멘트 답변
    $(".cmnt_reply").bind("click", function() {
        var f = $("#fcomment").get(0);
        f.w.value = "c";
        f.comment_id.value = this.rel;
        f.wr_content.value = "";
        //alert($(this).parents().find(".comment_area").html());
        $(this).parents(".comment_area").append( $("#comment_write").css("margin-top", "10px") );
    });

    // 코멘트 수정
    $(".cmnt_update").bind("click", function() {
        var f = $("#fcomment").get(0);
        f.w.value = "cu";
        f.comment_id.value = this.rel;
        $(this).parents(".comment_area").append( $("#comment_write").css("margin-top", "10px") );

        $.ajax({
            async: false,
            cache: false,
            type: "GET",
            dataType: "json",
            url: g4_bbs_path+"/get_comment.php",
            data: {
                "bo_table": f.bo_table.value,
                "comment_id": f.comment_id.value
            },
            success: function(data, textStatus) {
                if (data.secret == "secret")
                    f.wr_secret.checked = "checked";
                else
                    f.wr_secret.checked = "";
                f.wr_content.value = data.wr_content;
            }
        });
    });

    var textarea_autoresize = function(obj) {
        if(obj.clientHeight < obj.scrollHeight) {
            obj.style.height = obj.scrollHeight+20;
        }
    }

    function comment_delete(url)
    {
        if (confirm("이 코멘트를 삭제하시겠습니까?")) location.href = url;
    }

    // 코멘트 수정
    $(".cmnt_delete").bind("click", function() {
        if (confirm("이 코멘트를 삭제하시겠습니까?"))
            location.href = this.href;
    });

    $("#fcomment").attr("autocomplete", "off");
});
//]]>
</script>