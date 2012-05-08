<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>

<!-- 게시글 보기 -->
<div id='board_view' style='width:<?php echo $bo_table_width?>;'>

    <?php
    ob_start();
    ?>

    <div class='btn_area'>
        <div class='fl'>
            <?php if ($write_href) {   ?><a href="<?php echo $write_href?>"><img src="<?php echo "$board_skin_path/img/btn_write.gif"?>" alt="글쓰기" /></a><?php } ?>
            <?php if ($update_href) {  ?><a href="<?php echo $update_href?>"><img src="<?php echo "$board_skin_path/img/btn_modify.gif"?>" alt="수정" /></a><?php } ?>
            <?php if ($delete_href) {  ?><a href="<?php echo $delete_href?>"><img src="<?php echo "$board_skin_path/img/btn_delete.gif"?>" alt="삭제" /></a><?php } ?>
            <?php if ($reply_href) {   ?><a href="<?php echo $reply_href?>"><img src="<?php echo "$board_skin_path/img/btn_reply.gif"?>" alt="답글" /></a><?php } ?>
            <?php if ($scrap_href) {   ?><a href="<?php echo $scrap_href?>" class="win_scrap"><img src='<?php echo "$board_skin_path/img/btn_scrap.gif"?>' alt="스크랩" /></a><?php } ?>
            <?/* if ($trackback_url){ ?><a href="<?php echo $trackback_url?>" class="trackback_scrap"><img src='<?php echo "$board_skin_path/img/btn_trackback.gif"?>' alt="트랙백" /></a><?php } */?>
            <?php if ($good_href) {?><a href="<?php echo $good_href?>" class="ajax_good"><img src='<?php echo "$board_skin_path/img/btn_good.gif"?>' alt="추천" /></a><?php } ?>
            <?php if ($nogood_href) {?><a href="<?php echo $nogood_href?>" class="ajax_good"><img src='<?php echo "$board_skin_path/img/btn_nogood.gif"?>' alt="비추천" /></a><?php } ?>

            <?php if ($copy_href) { ?><a href="<?php echo $copy_href?>"><img src="<?php echo "$board_skin_path/img/btn_copy.gif"?>" alt="복사하기" /></a><?php } ?>
            <?php if ($move_href) { ?><a href="<?php echo $move_href?>"><img src="<?php echo "$board_skin_path/img/btn_move.gif"?>" alt="이동하기" /></a><?php } ?>
        </div>
        <div class='fr'>
            <a href="<?php echo $list_href?>"><img src="<?php echo "$board_skin_path/img/btn_list.gif"?>" alt="목록" /></a>
            <?php if ($search_href) { ?><a href="<?php echo $search_href?>"><img src="<?php echo "$board_skin_path/img/btn_search_list.gif"?>" alt="검색목록" /></a><?php } ?>
        </div>
    </div>

    <?php
    $link_buttons = ob_get_contents();
    ob_end_flush();
    ?>

    <div class='title_area'>
        <h2 class='title'>
            <?php if ($is_category) { echo ($category_name ? "<span class='category'>[$view[ca_name]]</span> " : ""); } ?>
            <a href='<?php echo "./board.php?bo_table={$bo_table}&amp;wr_id={$wr_id}"?>'><?php echo cut_hangul_last(get_text($view[wr_subject]))?></a>
        </h2>
        <div class='sum'>
            <span class="hit tit">조회</span><span class='num'><?php echo number_format($view[wr_hit])?></span>
            <?php if ($is_good) { ?><span class='good tit'>추천</span><span class='num'><?php echo number_format($view[wr_good])?></span><?php } ?>
            <?php if ($is_nogood) { ?><span class='nogood tit'>비추천</span><span class='num'><?php echo number_format($view[wr_nogood])?></span><?php } ?>
            <span class='date'><?php echo date("Y.m.d H:i", strtotime($view[wr_datetime]))?></span>
        </div>
    </div>

    <div class='author_area'>
        <span class='author'><?php echo $view[name]?></span>
        <span class='ipaddress'><?php echo $is_ip_view?"($ip)":"";?></span>
    </div>

    <?php
    // 링크
    $cnt = 0;
    for ($i=1; $i<=$g4[link_count]; $i++) {
        if ($view[link][$i]) {
            $cnt++;
            $link = cut_str($view[link][$i], 70);
            echo "<dl class='attach'>\n";
            echo "<dt>링크 #{$cnt}</dt>\n";
            echo "<dd><a href='{$view[link_href][$i]}'>{$link} ({$view[link_hit][$i]})</a></dd>\n";
            echo "</dl>\n";
        }
    }

    // 가변 파일
    $cnt = 0;
    for ($i=0; $i<count($view[file]); $i++) {
        if ($view[file][$i][source] && !$view[file][$i][view]) {
            $cnt++;
            echo "<dl class='attach'>\n";
            echo "<dt>파일 #{$cnt}</dt>\n";
            echo "<dd><a href=\"javascript:file_download('{$view[file][$i][href]}', '".urlencode($view[file][$i][source])."');\">";
            echo "{$view[file][$i][source]} ({$view[file][$i][size]}) ({$view[file][$i][download]})\n";
            echo "<span class='date'>DATE : {$view[file][$i][datetime]}</span></a></dd>\n";
            echo "</dl>\n";
        }
    }
    ?>

    <?php
    // 파일 출력
    for ($i=0; $i<=count($view[file]); $i++) {
        if ($view_file = $view[file][$i][view]) {
            echo "<div class='view_file'>$view_file</div>";
        }
    }
    ?>

    <!-- 내용 출력 -->
    <div class='content'>
        <?php echo $view[content];?>
    </div><!-- .content -->

    <? /* ?>
    <div>
        <?php if ($scrap_href) { ?><span><a href="<?php echo $scrap_href?>" class="win_scrap">스크랩</a></span><?php } ?>
        <?php if ($trackback_url) { ?><span><a href="<?php echo $trackback_url?>" class="trackback">트랙백</a></span><?php } ?>
    </div>
    <? */ ?>

    <?php if ($is_signature) { // 서명 ?><div class='signature'><?php echo $signature?></div><?php } ?>

    <?php
    // 코멘트 입출력
    include_once("./view_comment.php");
    ?>

    <?php echo $link_buttons?>
    <div class='btn_area_bottom'></div>

</div><!-- #board_view -->

<script type='text/javascript'>
//<![CDATA[
function file_download(link, file) {
    <?php if ($board[bo_download_point] < 0) { ?>if (confirm("'"+decodeURIComponent(file)+"' 파일을 다운로드 하시면 포인트가 차감(<?php echo number_format($board[bo_download_point])?>점)됩니다.\n\n포인트는 게시물당 한번만 차감되며 다음에 다시 다운로드 하셔도 중복하여 차감하지 않습니다.\n\n그래도 다운로드 하시겠습니까?"))<?php }?>
    document.location.href=link;
}

$(function() {
    // 추천
    $('.ajax_good').bind('click', function() {
        $.ajax({
            async: false,
            cache: false,
            type: "GET",
            url: this.href,
            success: function(data, textStatus) {
                alert(data);
            }
        });

        return false;
    });

    // 트랙백 주소 만들기
    $('.trackback').bind('click', function() {
        var token = null;
        $.ajax({
            async: false,
            cache: false,
            type: 'POST',
            url: g4_bbs_path+'/tb_token.php',
            success: function(data, textStatus) {
                token = data;
            }
        });
        prompt('아래 주소를 복사하세요. 이 주소는 스팸을 막기 위하여 한번만 사용 가능합니다.', this.href+'/'+token);
        return false;
    });
});
//]]>
</script>
