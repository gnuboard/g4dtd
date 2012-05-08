<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>

<div id="pop_header">
    <h1>우편번호 검색</h1>
</div>

<form id="fzip" method="get" action="#" onsubmit="return fzip_submit(this);">
<div id="pop_content">
    <input type='hidden' name='frm_name'  value='<?php echo $frm_name?>' />
    <input type='hidden' name='frm_zip1'  value='<?php echo $frm_zip1?>' />
    <input type='hidden' name='frm_zip2'  value='<?php echo $frm_zip2?>' />
    <input type='hidden' name='frm_addr1' value='<?php echo $frm_addr1?>' />
    <input type='hidden' name='frm_addr2' value='<?php echo $frm_addr2?>' />

    <p>찾고자 하시는 주소의 동(읍/면/리)을 입력하세요.</p>
    <p><span class="zip">예) 수유, 두리, 무지 (두글자 이상 입력하세요.)</span></p>

    <!-- 검색폼 -->
    <div class="search_area_zip">
        <label>동(/읍/면/리)
        <input type="text" name="addr1" class="text required minlength=2" title="동(읍/면/리)" value="<?php echo $addr1?>" /></label>
        <input type="image" src="<?php echo $member_skin_path?>/img/btn_search.gif" alt="검색" class="btn_search" />
    </div>
    <!-- 검색폼 -->

    <?php if ($search_count > 0) { ?>
    <div class="search_zip_result">
        <h2>우편번호 검색결과</h2>
        <h3>총 <?php echo $search_count?>건 가나다순</h3>
        <ul>
            <?php
            for ($i=0; $i<count($list); $i++)
                echo "<li><a href='javascript:;' onclick=\"find_zip('{$list[$i][zip1]}', '{$list[$i][zip2]}', '{$list[$i][addr]}');\">{$list[$i][zip1]}-{$list[$i][zip2]} : {$list[$i][addr]} {$list[$i][bunji]}</a></li>\n";
            ?>
            <li class="end">[ 검색목록 끝 ]</li>
        </ul>
    </div>
    <?php } ?>
</div>
</form>

<div id="pop_tailer">
    <a href="javascript:;" onclick="window.close();"><img src="<?php echo $member_skin_path?>/img/btn_close.gif" alt="창닫기" /></a>
</div>

<script type="text/javascript">
//<![CDATA[
function fzip_submit(f)
{
    f.action = "./zip.php";
    return true;
}

<?php if ($search_count > 0) { ?>
function find_zip(zip1, zip2, addr1)
{
    var of = opener.document.getElementById('<?php echo $frm_name?>');

    of.<?php echo $frm_zip1?>.value  = zip1;
    of.<?php echo $frm_zip2?>.value  = zip2;

    of.<?php echo $frm_addr1?>.value = addr1;

    of.<?php echo $frm_addr2?>.focus();
    window.close();
    return false;
}
<?php } ?>
//]]>
</script>
