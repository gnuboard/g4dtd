<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>

<div id="pop_header">
    <h1><?php echo $g4[title]?></h1>
</div>

<div id="pop_content">
    <div class="view_area">

        <div class="profile_member"><span class="member"><?php echo $mb_nick?></span> 님의 회원정보</div>

        <table cellspacing="0" class="table_profile"  summary="회원정보">
        <caption>회원정보</caption>
        <colgroup>
            <col width="150" />
            <col width="*" />
        </colgroup>
            <tr>
                <th>회원권한 :</th>
                <td><?php echo $mb[mb_level]?></td>
            </tr>
            <tr>
                <th>포인트 :</th>
                <td><?php echo number_format($mb[mb_point])?> 점</td>
            </tr>
            <?php if ($mb_homepage) { ?>
            <tr>
                <th>홈페이지 :</th>
                <td><a href="<?php echo $mb_homepage?>" target="<?php echo $config[cf_link_target]?>"><?php echo $mb_homepage?></a></td>
            </tr>
            <?php } ?>
            <tr>
                <th>가입일 :</th>
                <td><?php echo ($member[mb_level] >= $mb[mb_level]) ?  substr($mb[mb_datetime],0,10) ." (".$mb_reg_after." 일)" : "알 수 없음"; ?></td>
            </tr>
            <tr>
                <th>최종접속일 :</th>
                <td><?php echo ($member[mb_level] >= $mb[mb_level]) ? $mb[mb_today_login] : "알 수 없음";?></td>
            </tr>
            <tr>
                <td colspan="2" class="introduce">
                    <p>자기소개</p>
                    <div class="memo">
                        <?php echo $mb_profile?>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>

<div id="pop_tailer">
    <p><a href="javascript:;" onclick="window.close();"><img src="<?php echo "$member_skin_path/img/btn_close.gif"?>" alt="창닫기" /></a></p>
</div>
