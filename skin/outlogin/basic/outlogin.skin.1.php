<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

if ($g4['https_url']) {
    $outlogin_url = $_GET['url'];
    if ($outlogin_url) {
        if (preg_match("/^\.\.\//", $outlogin_url)) {
            $outlogin_url = urlencode($g4[url]."/".preg_replace("/^\.\.\//", "", $outlogin_url));
        }
        else {
            $purl = parse_url($g4[url]);
            if ($purl[path]) {
                $path = urlencode($purl[path]);
                $urlencode = preg_replace("/".$path."/", "", $urlencode);
            }
            $outlogin_url = $g4[url].$urlencode;
        }
    }
    else {
        $outlogin_url = $g4[url];
    }
}
else {
    $outlogin_url = $urlencode;
}
?>

<!-- 로그인 이전 -->
<div id="login_area">
	<h2 class="skip">로그인</h2>
    <form id="foutlogin" method="post" action="<?php echo $g4['https_url'] ? "{$g4['https_url']}/{$g4['bbs']}" : $g4['bbs_path']; ?>/login_check.php">
    <div>
        <input type="hidden" name="url" value="<?php echo $outlogin_url?>" />
    </div>

    <div class="log01">
        <label for="outlogin_mb_id">아이디</label>
        <input type="text" id="outlogin_mb_id" name="mb_id" maxlength="20" class="box_input_id required alnum_" alt="아이디" value="<?php echo get_cookie("ck_mb_id");?>" />
    </div>

    <div class="log01">
        <label for="outlogin_mb_password">열쇠글</label>
        <input type="password" id="outlogin_mb_password" name="mb_password" class="box_input_pw required" maxlength="20" alt="열쇠글" />
    </div>

    <div class="log02">
        <input type="image" src="<?php echo $outlogin_skin_path?>/img/btn_login.gif" id="submit_img" alt="로그인" class="btn_log" />
    </div>

    <div class="log03">
        <input type="checkbox" name="auto_login" id="outlogin_auto_login" class="checkbox" value="1" />
        <label for="outlogin_auto_login">자동로그인</label>
        <?php if ($g4[https_url]) { ?><!-- <span class="bar">｜</span><input type="checkbox" name="ssl_login" id="outlogin_ssl_login" class="checkbox" checked="checked" /> <label for="ssl_login">보안로그인</label> --><?php }?>
    </div>
    <div>
        <span class="login_before"><a href="<?php echo "$g4[bbs_path]/password_lost.php"?>" class="win_password_lost" onclick="return false;">아이디 · 비밀번호찾기</a></span>
        <span class="bar">｜</span>
        <span><a href="<?php echo "$g4[bbs_path]/register.php"?>" class="member_join">회원가입</a></span>
    </div>
    </form>
</div>

<script type="text/javascript">
//<![CDATA[
// 아웃로그인 아이디, 비밀번호에 포커스가 가면 배경이미지가 사라지고 포커스를 벗어날때 값이 없으면 배경이미지를 다시 넣어줌.
$(function() {
    $("#foutlogin")
    .attr("autocomplete", "off")
    .submit(function() {
        if (!$("#outlogin_mb_id").val()) {
            alert("회원 아이디를 입력하세요!");
            $("#outlogin_mb_id").focus();
            return false;
        }
        if (!$("#outlogin_mb_password").val()) {
            alert("회원 열쇠글을 입력하세요!");
            $("#outlogin_mb_password"),focus();
            return false;
        }
/*
         if (g4_https_url) {
            if($("#outlogin_ssl_login").is(":checked")) {
                $(this).attr("action", g4_https_url + "/" + g4_bbs + "/login_check.php");
            } else {
                $(this).attr("action", g4_bbs_path + "/login_check.php);
            }
        } else {
                $(this).attr("action", g4_bbs_path + "/login_check.php);
        }
*/
    });
    $("#outlogin_mb_id").css("ime-mode", "disabled");
    $("#outlogin_auto_login").bind("click", function() {
        if (confirm("자동로그인을 사용하시면 다음부터 회원아이디와 비밀번호를 입력하실 필요가 없습니다.\n\n\공공장소에서는 개인정보가 유출될 수 있으니 사용을 자제하여 주십시오.\n\n자동로그인을 사용하시겠습니까?")) {
            this.checked = "checked";
        } else {
            this.checked = "";
        }
    });
});
//]]>
</script><!-- 로그인 이전 -->