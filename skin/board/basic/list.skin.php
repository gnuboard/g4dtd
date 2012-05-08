<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 5;

if ($is_checkbox) $colspan++;
if ($is_good) $colspan++;
if ($is_nogood) $colspan++;
?>

<!-- 게시판 목록 -->
<div id='board_list' style='width:<?php echo $bo_table_width?>;'>

    <div class='board_status'>
        <?php if ($is_category) { ?>
        <div class='fl'>
            <form id='fcategory' method='get' action='#'>
            <fieldset>
            <select name='sca' id='board_sca'>
                <option value="">전체</option>
                <?php echo $category_option?>
            </select>
            <noscript><input type='submit' value='이동' /></noscript>
            </fieldset>
            </form>
        </div>
        <?php } ?>
        <div class='fr'>
            <span class='write_count'>Total <?php echo number_format($total_count)?></span>
            <?php if ($rss_href) { ?><a href="<?php echo $rss_href?>"><img src='<?php echo $board_skin_path?>/img/icon_rss.gif' alt='RSS' /></a><?php } ?>
            <?php if ($admin_href) { ?><a href="<?php echo $admin_href?>"><span class="admin"><img src='<?php echo $board_skin_path?>/img/btn_admin.gif' alt='Admin' /></span></a><?php } ?>
        </div>
    </div><!-- .board_status -->

    <form id='fboardlist' method='post' action='<?php echo $g4['bbs_path']; ?>/list_update.php'>
    <div>
    <input type='hidden' name='bo_table' value='<?php echo $bo_table?>' />
    <input type='hidden' name='sfl'  value='<?php echo $sfl?>' />
    <input type='hidden' name='stx'  value='<?php echo $stx?>' />
    <input type='hidden' name='spt'  value='<?php echo $spt?>' />
    <input type='hidden' name='page' value='<?php echo $page?>' />
    </div>
    <table cellspacing='0' class='list_table'>
    <thead>
        <tr>
            <?php if ($is_checkbox) { ?><th><input type="checkbox" id="all_chk" /></th><?php }?>
            <th>번호
                </th>
            <th class='title'>제목</th>
            <th>이름</th>
            <th><?php echo subject_sort_link('wr_datetime', $qstr2, 1)?>날짜</a></th>
            <th><?php echo subject_sort_link('wr_hit', $qstr2, 1)?>조회</a></th>
            <?php if ($is_good) { ?><th><?php echo subject_sort_link('wr_good', $qstr2, 1)?>추천</a></th><?php }?>
            <?php if ($is_nogood) { ?><th><?php echo subject_sort_link('wr_nogood', $qstr2, 1)?>비추천</a></th><?php }?>
        </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $i<count($list); $i++) {
        if ($list[$i][is_notice]) { // 공지사항
            $tr_class = " class='notice'";
            $td_class = "notice";
            $num = "공지";
        } else {
            $tr_class = " class='num'";
            if ($wr_id == $list[$i][wr_id]) {// 현재위치
                $td_class = "current";
                $num = ">>>";
            } else {
                $td_class = "num";
                $num = $list[$i][num];
            }
        }
    ?>
        <tr<?php echo $tr_class?>>
            <?php if ($is_checkbox) { ?><td><input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id']?>" /></td><?php } ?>
            <td class='<?php echo $td_class?>'><?php echo $num?></td>
            <td class='title'>
                <?php
                echo $list[$i]['reply'];
                echo $list[$i]['icon_reply'];
                if ($is_category && $list[$i]['ca_name']) {
                    echo "<span class=\"cate\"><a href='{$list[$i]['ca_name_href']}'>[{$list[$i][ca_name]}]</a></span> ";
                }
                echo "<a href=\"{$list[$i]['href']}\">{$list[$i]['subject']}</a>";
                if ($list[$i]['comment_cnt'])
                    echo " <a href=\"{$list[$i]['comment_href']}\" class=\"comment\">{$list[$i]['comment_cnt']}</a>";

                echo $list[$i]['icon_new']    ? " ".$list[$i]['icon_new']    : "";
                echo $list[$i]['icon_file']   ? " ".$list[$i]['icon_file']   : "";
                echo $list[$i]['icon_link']   ? " ".$list[$i]['icon_link']   : "";
                echo $list[$i]['icon_hot']    ? " ".$list[$i]['icon_hot']    : "";
                echo $list[$i]['icon_secret'] ? " ".$list[$i]['icon_secret'] : "";

                $date = date("y.m.d", strtotime($list[$i]['wr_datetime']));
                ?>
            </td>
            <td class='author'><?php echo $list[$i]['name']?></td>
            <td class='date'><?php echo $date?></td>
            <td class='num'><?php echo $list[$i]['wr_hit']?></td>
            <?php if ($is_good) { ?><td class='num'><?php echo $list[$i]['wr_good']?></td><?php }?>
            <?php if ($is_nogood) { ?><td class='num'><?php echo $list[$i]['wr_nogood']?></td><?php }?>
        </tr>
    <?php } // for()?>
    <?php if (count($list) == 0) { ?>
    <tr><td colspan='<?php echo $colspan?>' class='nodata'>게시물이 없습니다.</td></tr>
    <?php } ?>
    </tbody>
    </table>

    <?php if($is_checkbox) { ?>
    <div class="board_sw">
        <span>선택한 글들을</span>
        <select name="sw">
            <option value="delete">삭제</option>
            <option value="copy">복사</option>
            <option value="move">이동</option>
        </select>
        <span>합니다.</span>
        <noscript><input type="submit" value="확인" /></noscript>
    </div>
    <?php } ?>

    </form>

    <div class='btn_area'>
        <div class='fl'>
            <a href="<?php echo $write_href?>"><img src="<?php echo $board_skin_path?>/img/btn_write.gif" alt="글쓰기" /></a>
            <?php if ($is_checkbox) { ?>
            <a href="javascript:select_sw('delete');"><img src="<?php echo $board_skin_path?>/img/btn_select_delete.gif" alt="선택삭제" /></a>
            <a href="javascript:select_sw('copy');"><img src="<?php echo $board_skin_path?>/img/btn_select_copy.gif" alt="선택복사" /></a>
            <a href="javascript:select_sw('move');"><img src="<?php echo $board_skin_path?>/img/btn_select_move.gif" alt="선택이동" /></a>
            <?php } ?>
        </div>
        <div class='fr'>
            <?php if ($list_href) { ?><p><a href="<?php echo $list_href?>"><img src="<?php echo $board_skin_path?>/img/btn_list.gif" alt='' /></a></p><?php }?>
        </div>
    </div>

    <div class='page_area'>
        <?php if ($prev_part_href) { echo "<a href='$prev_part_href'><img src='$board_skin_path/img/page_search_prev.gif' alt='' title='이전검색' /></a>"; } ?>
        <?php echo $write_pages;?>
        <?php if ($next_part_href) { echo "<a href='$next_part_href'><img src='$board_skin_path/img/page_search_next.gif' alt='' title='다음검색' /></a>"; } ?>
    </div>

    <div class='search_area'>
        <form id='fsearch' method='get' action='<?php echo $_SERVER[PHP_SELF]?>'>
        <div>
            <input type='hidden' name='bo_table' value='<?php echo $bo_table?>' />
            <input type='hidden' name='sca'      value='<?php echo $sca?>' />
            <input type='hidden' name='sop'      value='<?php echo $sop?>' />
            <select name='sfl' class='sel_search'>
                <option value='wr_subject||wr_content'>제목+내용</option>
                <option value='wr_subject'>제목</option>
                <option value='wr_content'>내용</option>
                <option value='mb_id,1'>회원아이디</option>
                <option value='mb_id,0'>회원아이디(코)</option>
                <option value='wr_name,1'>글쓴이</option>
                <option value='wr_name,0'>글쓴이(코)</option>
            </select>
            <input type='text' name='stx' id='stx' size='20' maxlength='20' class='text' value='<?php echo stripslashes($stx)?>' />
            <select name='sop' class='sel_search'>
                <option value='and'>and</option>
                <option value='or'>or</option>
            </select>
            <input type='image' src='<?php echo $board_skin_path?>/img/btn_search.gif' class='btn_search' />
            <!-- <label title='두개이상의 단어를 모두 포함하는 게시물을 검색'><input type='radio' name='sop' value='and' id='sop_and' /> and</label>
            <label title='하나의 단어라도 포함하는 게시물을 검색'><input type='radio' name='sop' value='or' id='sop_or' /> or</label> -->
        </div>
        </form>
    </div><!-- .board_search -->
</div><!-- .board_list -->

<script type="text/javascript">
//<![CDATA[
function select_sw(sw) {
    var frm =$("#fboardlist");
    var opt = frm.find("select[name='sw'] > option[value='" + sw + "']");
    var str = opt.text();
    if(!frm.find("input[name='chk_wr_id[]']:checked").length) {
        alert(str + "할 게시물을 하나 이상 선택하세요.");
        return false;
    }
    switch (sw) {
        case "copy" :
        case "move" :
            var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");
            frm.attr("target", "move");
            // frm.attr("action", "./move.php");
            break;
        case "delete" :
            if (!confirm("선택한 게시물을 정말 " + str + " 하시겠습니까?\n\n한번 " + str + "한 자료는 복구할 수 없습니다"))
                return;
            // frm.attr("action", "./delete_all.php?" + Math.random());
            break;
        default :
            alert("지정되지 않은 작업입니다!");
            return false;
            break;
    }
    opt.attr("selected", "true");
    frm.submit();
}

$(function() {
    $("#board_sca").bind("change", function() {
        document.location.href = "./board.php?bo_table=" + g4_bo_table + "&sca=" + encodeURIComponent(this.value);
    }).val(g4_sca);

	 // 배경색상 변경 
    $("#board_list tbody tr") 
    .each(function(i) { 
        if (i%2==0) 
            $(this).css("background-color", "#ffffff"); 
        else 
            $(this).css("background-color", "#fcfcfc");                   
    }) 
    .bind("mouseover", function() { 
        $(this).attr("rel", $(this).css("background-color")); 
        $(this).css("background-color", "#f1f1f1"); 
    }) 
    .bind("mouseout", function() { 
        $(this).css("background-color", $(this).attr("rel")); 
    }) 
	

    // 체크박스 모두 선택
    $("#all_chk").bind("click", function() {
        var chk = this.checked;
        $("#fboardlist input[name='chk_wr_id[]']").each(function() {
            this.checked = chk;
        });
    });

    $("#fsearch")
    .attr("autocomplete", "off")
    .load(function() {
        if ($(this).find("input[name='stx']").val()) {
            var val_sfl = $.trim($("#fboardlist input[name='sfl']").val());
            var val_sop = $.trim($(this).find("input[type='hidden'][name='sop']").val());
            if (val_sfl)
                $(this).find("select[name=sfl] > option[value='" + val_sfl + "']").attr("selected", "true");
            if (val_sop) {
                $(this).find("input[type='radio'][name='sop'][value='" + val_sop + "']").attr("checked", "checked");
                $(this).find("select[name='sop'] > option[value='" + val_sop + "']").attr("selected", "true");
            }
        }
    })
    .submit(function() {
        var fld_stx= $(this).find("input[name='stx']");
        if (fld_stx.val().length < 2) {
            alert("검색어는 2글자 이상 입력하십시오.");
            fld_stx.select().focus();
            return false;
        }
    })
    .trigger("load");
});
//]]>
</script><!-- 게시판 목록 -->
