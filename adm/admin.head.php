<?php
if (!defined("_GNUBOARD_")) exit;

define('_G4_ADMIN_', true);

$begin_time = get_microtime();

include_once("{$g4['path']}/head.sub.php");
?>

<script type='text/javascript' src="<?php echo $g4['path']?>/js/sideview.js"></script>
<script type='text/javascript'>
//<![CDATA[
if (!g4_is_ie) document.captureEvents(Event.MOUSEMOVE)
document.onmousemove = getMouseXY;
var tempX = 0;
var tempY = 0;
var prevdiv = null;
var timerID = null;

function getMouseXY(e)
{
    if (g4_is_ie) { // grab the x-y pos.s if browser is IE
        tempX = event.clientX + document.body.scrollLeft;
        tempY = event.clientY + document.body.scrollTop;
    } else {  // grab the x-y pos.s if browser is NS
        tempX = e.pageX;
        tempY = e.pageY;
    }

    if (tempX < 0) {tempX = 0;}
    if (tempY < 0) {tempY = 0;}

    return true;
}

function imageview(id, w, h)
{

    menu(id);

    var el_id = document.getElementById(id);

    //submenu = eval(name+".style");
    submenu = el_id.style;
    submenu.left = tempX - ( w + 11 );
    submenu.top  = tempY - ( h / 2 );

    selectBoxVisible();

    if (el_id.style.display != 'none')
        selectBoxHidden(id);
}

function help(id, left, top)
{
    menu(id);

    var el_id = document.getElementById(id);

    //submenu = eval(name+".style");
    submenu = el_id.style;
    submenu.left = tempX - 50 + left;
    submenu.top  = tempY + 15 + top;

    selectBoxVisible();

    if (el_id.style.display != 'none')
        selectBoxHidden(id);
}

// TEXTAREA 사이즈 변경
function textarea_size(fld, size)
{
	var rows = parseInt(fld.rows);

	rows += parseInt(size);
	if (rows > 0) {
		fld.rows = rows;
	}
}

var over_menu = false;
var save_menu = null;
$(function() {
    $('.id_menu').bind('mouseover', function() {
        var menu = this.alt;
        if (save_menu != menu) {
            $('#sub_menu'+save_menu).slideUp(100);
        }

        var pos = $(this).offset();
        var height = $(this).height();
        $('#sub_menu'+menu)
            .css( {'left':pos.left, 'top':(pos.top + height + 3) } )
            .slideDown(200);
        save_menu = menu;
    }).css('cursor', 'pointer');

    $('.menu_out').bind('mouseover', function() {
        if (save_menu != null) {
            $('#sub_menu'+save_menu).slideUp(100);
        }
    });
});
//]]>
</script>
<div id="adm_container">
	<div id="adm_header">
		<h1><a href='<?php echo $g4['admin_path']?>/'><img src='<?php echo $g4['admin_path']?>/img/logo.gif' alt='관리자화면' /></a></h1>
		<div class="mainmenu">	
			<h2 class="skip">관리자 메인메뉴</h2>
			<ul>
				<?php
				foreach($amenu as $key=>$value) {
					$mnu = $menu["menu".$key];

					$href1 = $href2 = "";
					if ($mnu[0][2]) {
						$href1 = "<a href='{$mnu[0][2]}'>";
						$href2 = "</a>";
					}

					echo "{$href1}<li><img src='{$g4['admin_path']}/img/menu{$key}.gif' id='id_menu{$key}' class='id_menu' alt='{$key}' />{$href2}";

					$li = "";
					for ($i=1; $i<count($mnu); $i++) {
						$m = $mnu[$i];
						if ($m[0] == "-")
							$li .= "<li class='line'></li>\n";
						else
							$li .= "<li><a href='{$m[2]}'>{$m[1]}</a></li>\n";
					}
					if ($li)
						echo "<ul style='display:none;' id='sub_menu{$key}' class='sub_menu'>$li</ul></li>";
				}
				?>
			</ul>
		</div>
	</div>
	<div id="adm_content">
		<div id="aside">
			<ul class="top_menu">
				<li><a href="<?php echo $g4['path']?>/"><img src="<?php echo $g4['admin_path']?>/img/home.gif" alt="HOME" /></a></li>
				<li><a href="<?php echo $g4['bbs_path']?>/logout.php"><img src="<?php echo $g4['admin_path']?>/img/logout.gif" alt="LOGOUT" /></a></li>
			</ul>
			<?php
			$tmp_menu = "";
				if (isset($sub_menu))
					$tmp_menu = substr($sub_menu, 0, 3);
			?>
			<h2><img src="<?php echo "{$g4['admin_path']}/img/title_menu{$tmp_menu}.gif"?>" alt="<?php echo $g4['title']?>" /></h2>
			<?php
			$mnu = $menu["menu".$tmp_menu];
			$li = "";
			for ($i=1; $i<count($mnu); $i++) {
				$m = $mnu[$i];
				if ($m[0] == "-")
					$li .= "<li class='line'></li>\n";
				else
					$li .= "<li><img src='{$g4['admin_path']}/img/icon.gif' alt='' /> <a href='{$m[2]}'>{$m[1]}</a></li>\n";
			}
			if ($li)
				echo "<ul id='side_menu{$key}' class='side_menu'>$li</ul>";
			?>
		</div>
		<div id="article">
			<p class="loc">
				<a href="<?php echo $g4['admin_path']?>/" style="padding:0 0 0 10px; background:url(<?php echo $g4['admin_path']?>/img/navi_icon.gif) no-repeat 0 center;">Admin</a> &gt;
				<?php				
				if (isset($menu["menu{$tmp_menu}"][0][1])) {
					if ($menu["menu{$tmp_menu}"][0][2]) {
						echo "<a href='".$menu["menu{$tmp_menu}"][0][2]."'&gt;";
						echo $menu["menu{$tmp_menu}"][0][1];
						echo "</a> > ";
					}
					else {
						echo $menu["menu{$tmp_menu}"][0][1]." &gt; ";
					}
				}
				?>
				<?php echo $g4['title']?> <span class='small'>: <?php echo $member['mb_id']?>님</span>
			</p>
			<div id="contentArea">
				<h2 class="skip">본문내용</h2>