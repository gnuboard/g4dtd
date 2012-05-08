<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

if ($g4['https_url']) {
    $login_url = $_GET['url'];
    if ($login_url) {
        if (preg_match("/^\.\.\//", $url)) {
            $login_url = urlencode($g4[url]."/".preg_replace("/^\.\.\//", "", $login_url));
        }
        else {
            $purl = parse_url($g4[url]);
            if ($purl[path]) {
                $path = urlencode($purl[path]);
                $urlencode = preg_replace("/".$path."/", "", $urlencode);
            }
            $login_url = $g4[url].$urlencode;
        }
    }
    else {
        $login_url = $g4[url];
    }
}
else {
    $login_url = $urlencode;
}
?>

<div id="login">
    <!-- <h2><img src="<?php echo $member_skin_path?>/img/title_member_login.gif" alt="회원로그인" /></h2> -->
    <div class="login_img"><img src="<?php echo $member_skin_path?>/img/title_member_login.gif" alt="회원로그인" /></div>

    <form id="flogin" method="post" action="#" onsubmit="return flogin_submit(this);">
    <div class="login_form">
        <input type="hidden" name="url" value="<?php echo $login_url?>" />

        <div class="logform_01">
            <label><img src="<?php echo $member_skin_path?>/img/img_member_login_id.gif" alt="회원아이디" /><input type="text" name="mb_id" id="login_mb_id" size="15" maxlength="20" class="login_text required alnum_" title="회원아이디" value="<?php echo get_cookie("ck_mb_id");?>" /></label>
        </div>

        <div class="logform_01">
            <label><img src="<?php echo $member_skin_path?>/img/img_member_login_pw.gif" alt="비밀번호" /><input type="password" name="mb_password" id="login_mb_password" size="15" maxlength="20" class="login_text required" title="비밀번호" /></label>
        </div>

        <div class="logform_02">
            <input type="image" src="<?php echo $member_skin_path?>/img/btn_member_login.gif" alt="로그인" />
        </div>

        <div class="logform_03">
            <label><input type="checkbox" name="auto_login" id="login_auto_login" class="checkbox auto_login" value="1" /> 자동로그인</label>
            <?php if ($g4[https_url]) { ?><label><input type="checkbox" name="ssl_login" id="login_ssl_login" class="checkbox" /> 보안로그인</label><?php } ?>
        </div>

        <div class="register">
            <ul>
                <li><img src="<?php echo $member_skin_path?>/img/img_member_login_join.gif" alt="" /><span><a href="<?php echo "$g4[bbs_path]/register.php"?>"><img src="<?php echo $member_skin_path?>/img/btn_member_join.gif" alt="회원가입" /></a></span></li>
                <li><img src="<?php echo $member_skin_path?>/img/img_member_login_forget.gif" alt="" /><span><a href="<?php echo "$g4[bbs_path]/password_lost.php"?>" class="login_password_lost" onclick="return false"><img src="<?php echo $member_skin_path?>/img/btn_member_find.gif" alt="아이디/비밀번호찾기" /></a></span></li>
            </ul>
        </div>
    </div>
    </form>
</div>

<script type="text/javascript">
//<![CDATA[
$(function() {
    $("#login").css("background", "url(<?php echo $g4[path]?>/img/bg_member_login.gif) no-repeat left top");
    $("#flogin").attr("autocomplete", "off").find(":input[type=text]:visible:enabled:first").focus();
    $("#login_mb_id").css("ime-mode", "disabled");

    // 아이디 · 비밀번호찾기 새창
    $(".login_password_lost").bind("click", function(e) {
        window.open(this.href, "win_passwordlost", "width=580, height=370, scrollbars=0");
    });

    $("#login_auto_login").bind("click", function() {
        if (confirm("자동로그인을 사용하시면 다음부터 회원아이디와 비밀번호를 입력하실 필요가 없습니다.\n\n\공공장소에서는 개인정보가 유출될 수 있으니 사용을 자제하여 주십시오.\n\n자동로그인을 사용하시겠습니까?")) {
            this.checked = "checked";
        } else {
            this.checked = "";
        }
    });
});


function flogin_submit(f)
{
    if (!f.mb_id.value.trim()) {
        alert("회원아이디를 입력하십시오.");
        f.mb_id.focus();
        return false;
    }

    if (!f.mb_password.value.trim()) {
        alert("비밀번호를 입력하십시오.");
        f.mb_password.focus();
        return false;
    }

    if (g4_https_url) {
        if(f.ssl_login.checked == true) {
            f.action = g4_https_url+"/"+g4_bbs+"/login_check.php";
        } else {
            f.action = g4_bbs_path + "/login_check.php";
        }
    } else {
        f.action = g4_bbs_path + "/login_check.php";
    }

    return true;
}
//]]>
</script>
