<?php
if(!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once($g4['path'].'/head.sub.php');
include_once($g4['path'].'/lib/outlogin.lib.php');
include_once($g4['path'].'/lib/poll.lib.php');
include_once($g4['path'].'/lib/visit.lib.php');
include_once($g4['path'].'/lib/connect.lib.php');

//print_r2(get_defined_constants());

// 사용자 화면 상단과 좌측을 담당하는 페이지입니다.
// 상단, 좌측 화면을 꾸미려면 이 파일을 수정합니다.
?>

<div id="wrap">

    <div id="head">
        <!-- 로고 -->
        <h1 id="logo"><a href="<?php echo $g4['path']?>/"><img src="<?php echo $g4['path']?>/img/logo.gif" alt="그누보드4" /></a></h1>

        <!-- 검색폼 -->
        <!-- <form id="searchform" method="get" action="#">
		<h2>통합검색</h2>
        <div class="search_area">
            <input type="text" name="s" id="s" size="15" title="검색어입력" accesskey="S" />
            <input type="image" src="<?php echo $g4['path']?>/img/btn_search.gif" alt="검색" id="searchButton" />
        </div>
        </form> -->

        <!-- 상단 메뉴 -->
        <div id="head_menu">
            <ul class="etc">
                <li><a href="<?php echo $g4['bbs_path'].'/new.php'?>">최근게시물</a></li>
                <?php if(!$member['mb_id']) { ?>
                <li><a href="<?php echo $g4['bbs_path']?>/login.php?url=<?php echo $urlencode?>">로그인</a></li>
                <li class="last"><a href="<?php echo $g4['bbs_path']?>/register.php">회원가입</a></li>
                <?php } else { ?>
                <li><a href="<?php echo $g4['bbs_path']?>/logout.php">로그아웃</a></li>
                <li class="last"><a href="<?php echo $g4['bbs_path']?>/member_confirm.php?url=register_form.php">정보수정</a></li>
                <?php } ?>
            </ul>
        </div><!-- #head_menu -->
    </div><!-- #head -->

    <div id="side">
        <?php echo outlogin('basic'); // 외부 로그인 ?>

        <?php echo poll('basic'); // 설문조사 ?>

        <?php echo visit('basic'); // 방문자수 ?>

        <?php echo connect(); // 현재 접속자수 ?>
    </div><!-- #side -->

    <div id="main">
