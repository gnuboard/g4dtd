<?
include_once("_common.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="ko">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7">
<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta http-equiv="Content-Style-Type" content="text/css">
<title>네이버 :: Smart Editor 2 &#8482;</title>
<link href="./css/smart_editor2.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="./js/jindo.min.js" charset="utf-8"></script>
<script type="text/javascript" src="./js/jindo_component.js" charset="utf-8"></script>
<script type="text/javascript" src="./js/SE2B_Configuration.js" charset="utf-8"></script>
<script type="text/javascript" src="./js/SE2BasicCreator.js" charset="utf-8"></script>

<script src='js/loader-min.js' charset='utf-8'></script>
<style type="text/css">
body{margin:0; padding:0;}
</style>

<body>

<!-- SE2 Markup Start -->
<div id="smart_editor2">
	<div id="smart_editor2_content"><a href="#se2_iframe" class="blind">글쓰기영역으로 가기</a>
		<div class="se2_tool">
			<!-- 텍스트 툴바 -->
			<div class="se2_text_tool">
				<ul class="se2_font_type">
				<li class="husky_seditor_ui_fontName"><button type="button" title="글꼴" class="se2_font_family"><span class="husky_se2m_current_fontName">글꼴</span></button> 
					<!-- 글꼴 레이어 -->
					<div class="se2_layer husky_se_fontName_layer">
						<div class="se2_in_layer">
							<ul class="se2_l_font_fam" style="display:">
							<li style="display:none"><button type="button"><span>@DisplayName@<span>(</span><em style="font-family:FontFamily;">@SampleText@</em><span>)</span></span></button></li>
							<li class="se2_division husky_seditor_font_separator"></li>
							<li class="husky_seditor_font_nanumgothic"><button type="button"><span>나눔고딕<span>(</span><em style="font-family:'나눔고딕',NanumGothic,Sans-serif;">가나다라</em><span>)</span></span></button></li>
							<li class="husky_seditor_font_nanummyeongjo"><button type="button"><span>나눔명조<span>(</span><em style="font-family:'나눔명조',NanumMyeongjo,serif;">가나다라</em><span>)</span></span></button></li>
							</ul>
						</div>
					</div>
					<!-- //글꼴 레이어 -->
				</li>
				<li class="husky_seditor_ui_fontSize"><button type="button" title="글자크기" class="se2_font_size"><span class="husky_se2m_current_fontSize">크기</span></button>
					<!-- 폰트 사이즈 레이어 -->
					<div class="se2_layer husky_se_fontSize_layer">
						<div class="se2_in_layer">
							<ul class="se2_l_font_size">
							<li><button type="button" style="height:19px;"><span style="margin-top:4px; margin-bottom:3px; margin-left:5px; font-size:7pt;">가나다라마바사<span style=" font-size:7pt;">(7pt)</span></span></button></li>
							<li><button type="button" style="height:20px;"><span style="margin-bottom:2px; font-size:8pt;">가나다라마바사<span style="font-size:8pt;">(8pt)</span></span></button></li>
							<li><button type="button" style="height:20px;"><span style="margin-bottom:1px; font-size:9pt;">가나다라마바사<span style="font-size:9pt;">(9pt)</span></span></button></li>
							<li><button type="button" style="height:21px;"><span style="margin-bottom:1px; font-size:10pt;">가나다라마바사<span style="font-size:10pt;">(10pt)</span></span></button></li>
							<li><button type="button" style="height:23px;"><span style="margin-bottom:2px; font-size:11pt;">가나다라마바사<span style="font-size:11pt;">(11pt)</span></span></button></li>
							<li><button type="button" style="height:25px;"><span style="margin-bottom:1px; font-size:12pt;">가나다라마바사<span style="font-size:12pt;">(12pt)</span></span></button></li>
							<li><button type="button" style="height:27px;"><span style="margin-bottom:2px; font-size:14pt;">가나다라마바사<span style="margin-left:6px;font-size:14pt;">(14pt)</span></span></button></li>
							<li><button type="button" style="height:33px;"><span style="margin-bottom:1px; font-size:18pt;">가나다라마바사<span style="margin-left:8px;font-size:18pt;">(18pt)</span></span></button></li>
							<li><button type="button" style="height:39px;"><span style="margin-left:3px; font-size:24pt;">가나다라마<span style="margin-left:11px;font-size:24pt;">(24pt)</span></span></button></li>
							<li><button type="button" style="height:53px;"><span style="margin-top:-1px; margin-left:3px; font-size:36pt;">가나다<span style="font-size:36pt;">(36pt)</span></span></button></li>
							</ul>
						</div>
					</div>
					<!-- //폰트 사이즈 레이어 -->
				</li>
				</ul>
				<ul class="se2_font_style">
				<li class="husky_seditor_ui_bold"><button type="button" title="굵게[Ctrl+B]" class="se2_bold"><span>굵게[Ctrl+B]</span></button></li>
				<li class="husky_seditor_ui_underline"><button type="button" title="밑줄[Ctrl+U]" class="se2_underline"><span>밑줄[Ctrl+U]</span></button></li>
				<li class="husky_seditor_ui_italic"><button type="button" title="기울임꼴[Ctrl+I]" class="se2_italic"><span>기울임꼴[Ctrl+I]</span></button></li>
				<li class="husky_seditor_ui_lineThrough"><button type="button" title="취소선[Ctrl+D]" class="se2_tdel"><span>취소선[Ctrl+D]</span></button></li>
				<li class="se2_pair husky_seditor_ui_fontColor"><span class="husky_seditor_ui_fontColorA"><button type="button" title="글자색" class="se2_fcolor husky_se2m_fontColor_lastUsed" style="background-color:#4477f9;"><span>글자색</span></button></span><span class="husky_seditor_ui_fontColorB"><button type="button" title="더보기" class="se2_fcolor_more"><span>더보기</span></button></span>
					<!-- 글자색 -->
					<div class="se2_layer husky_se2m_fontcolor_layer" style="display:none">
						<div class="se2_in_layer husky_se2m_fontcolor_paletteHolder">
							<div class="se2_palette husky_se2m_color_palette">
								<ul class="se2_pick_color">
								<li><button type="button" title="#ff0000" style="background:#ff0000"><span><span>#ff0000</span></span></button></li>
								<li><button type="button" title="#ff6c00" style="background:#ff6c00"><span><span>#ff6c00</span></span></button></li>
								<li><button type="button" title="#ffaa00" style="background:#ffaa00"><span><span>#ffaa00</span></span></button></li>
								<li><button type="button" title="#ffef00" style="background:#ffef00"><span><span>#ffef00</span></span></button></li>
								<li><button type="button" title="#a6cf00" style="background:#a6cf00"><span><span>#a6cf00</span></span></button></li>
								<li><button type="button" title="#009e25" style="background:#009e25"><span><span>#009e25</span></span></button></li>
								<li><button type="button" title="#00b0a2" style="background:#00b0a2"><span><span>#00b0a2</span></span></button></li>
								<li><button type="button" title="#0075c8" style="background:#0075c8"><span><span>#0075c8</span></span></button></li>
								<li><button type="button" title="#3a32c3" style="background:#3a32c3"><span><span>#3a32c3</span></span></button></li>
								<li><button type="button" title="#7820b9" style="background:#7820b9"><span><span>#7820b9</span></span></button></li>
								<li><button type="button" title="#ef007c" style="background:#ef007c"><span><span>#ef007c</span></span></button></li>
								<li><button type="button" title="#000000" style="background:#000000"><span><span>#000000</span></span></button></li>
								<li><button type="button" title="#252525" style="background:#252525"><span><span>#252525</span></span></button></li>
								<li><button type="button" title="#464646" style="background:#464646"><span><span>#464646</span></span></button></li>
								<li><button type="button" title="#636363" style="background:#636363"><span><span>#636363</span></span></button></li>
								<li><button type="button" title="#7d7d7d" style="background:#7d7d7d"><span><span>#7d7d7d</span></span></button></li>
								<li><button type="button" title="#9a9a9a" style="background:#9a9a9a"><span><span>#9a9a9a</span></span></button></li>
								<li><button type="button" title="#ffe8e8" style="background:#ffe8e8"><span><span>#9a9a9a</span></span></button></li>
								<li><button type="button" title="#f7e2d2" style="background:#f7e2d2"><span><span>#f7e2d2</span></span></button></li>
								<li><button type="button" title="#f5eddc" style="background:#f5eddc"><span><span>#f5eddc</span></span></button></li>
								<li><button type="button" title="#f5f4e0" style="background:#f5f4e0"><span><span>#f5f4e0</span></span></button></li>
								<li><button type="button" title="#edf2c2" style="background:#edf2c2"><span><span>#edf2c2</span></span></button></li>
								<li><button type="button" title="#def7e5" style="background:#def7e5"><span><span>#def7e5</span></span></button></li>
								<li><button type="button" title="#d9eeec" style="background:#d9eeec"><span><span>#d9eeec</span></span></button></li>
								<li><button type="button" title="#c9e0f0" style="background:#c9e0f0"><span><span>#c9e0f0</span></span></button></li>
								<li><button type="button" title="#d6d4eb" style="background:#d6d4eb"><span><span>#d6d4eb</span></span></button></li>
								<li><button type="button" title="#e7dbed" style="background:#e7dbed"><span><span>#e7dbed</span></span></button></li>
								<li><button type="button" title="#f1e2ea" style="background:#f1e2ea"><span><span>#f1e2ea</span></span></button></li>
								<li><button type="button" title="#acacac" style="background:#acacac"><span><span>#acacac</span></span></button></li>
								<li><button type="button" title="#c2c2c2" style="background:#c2c2c2"><span><span>#c2c2c2</span></span></button></li>
								<li><button type="button" title="#cccccc" style="background:#cccccc"><span><span>#cccccc</span></span></button></li>
								<li><button type="button" title="#e1e1e1" style="background:#e1e1e1"><span><span>#e1e1e1</span></span></button></li>
								<li><button type="button" title="#ebebeb" style="background:#ebebeb"><span><span>#ebebeb</span></span></button></li>
								<li><button type="button" title="#ffffff" style="background:#ffffff"><span><span>#ffffff</span></span></button></li>
								</ul>
								<ul class="se2_pick_color" style="width:156px;">
								<li><button type="button" title="#e97d81" style="background:#e97d81"><span><span>#e97d81</span></span></button></li>
								<li><button type="button" title="#e19b73" style="background:#e19b73"><span><span>#e19b73</span></span></button></li>
								<li><button type="button" title="#d1b274" style="background:#d1b274"><span><span>#d1b274</span></span></button></li>
								<li><button type="button" title="#cfcca2" style="background:#cfcca2"><span><span>#cfcca2</span></span></button></li>
								<li><button type="button" title="#cfcca2" style="background:#cfcca2"><span><span>#cfcca2</span></span></button></li>
								<li><button type="button" title="#61b977" style="background:#61b977"><span><span>#61b977</span></span></button></li>
								<li><button type="button" title="#53aea8" style="background:#53aea8"><span><span>#53aea8</span></span></button></li>
								<li><button type="button" title="#518fbb" style="background:#518fbb"><span><span>#518fbb</span></span></button></li>
								<li><button type="button" title="#6a65bb" style="background:#6a65bb"><span><span>#6a65bb</span></span></button></li>
								<li><button type="button" title="#9a54ce" style="background:#9a54ce"><span><span>#9a54ce</span></span></button></li>
								<li><button type="button" title="#e573ae" style="background:#e573ae"><span><span>#e573ae</span></span></button></li>
								<li><button type="button" title="#5a504b" style="background:#5a504b"><span><span>#5a504b</span></span></button></li>
								<li><button type="button" title="#767b86" style="background:#767b86"><span><span>#767b86</span></span></button></li>
								<li><button type="button" title="#951015" style="background:#951015"><span><span>#951015</span></span></button></li>
								<li><button type="button" title="#6e391a" style="background:#6e391a"><span><span>#6e391a</span></span></button></li>
								<li><button type="button" title="#785c25" style="background:#785c25"><span><span>#785c25</span></span></button></li>
								<li><button type="button" title="#5f5b25" style="background:#5f5b25"><span><span>#5f5b25</span></span></button></li>
								<li><button type="button" title="#4c511f" style="background:#4c511f"><span><span>#4c511f</span></span></button></li>
								<li><button type="button" title="#1c4827" style="background:#1c4827"><span><span>#1c4827</span></span></button></li>
								<li><button type="button" title="#0d514c" style="background:#0d514c"><span><span>#0d514c</span></span></button></li>
								<li><button type="button" title="#1b496a" style="background:#1b496a"><span><span>#1b496a</span></span></button></li>
								<li><button type="button" title="#2b285f" style="background:#2b285f"><span><span>#2b285f</span></span></button></li>
								<li><button type="button" title="#45245b" style="background:#45245b"><span><span>#45245b</span></span></button></li>
								<li><button type="button" title="#721947" style="background:#721947"><span><span>#721947</span></span></button></li>
								<li><button type="button" title="#352e2c" style="background:#352e2c"><span><span>#352e2c</span></span></button></li>
								<li><button type="button" title="#3c3f45" style="background:#3c3f45"><span><span>#3c3f45</span></span></button></li>
								</ul>
								<button type="button" class="se2_view_more husky_se2m_color_palette_more_btn"><span>더보기</span></button>
								<div class="se2_palette2 husky_se2m_color_palette_colorpicker">
									<div class="se2_color_set">
										<span class="se2_selected_color"><span class="husky_se2m_cp_preview" style="background:#e97d81"></span></span><input type="text" name="" class="input_ty1 husky_se2m_cp_colorcode" value="#e97d81"><button type="button"  class="se2_btn_insert husky_se2m_color_palette_ok_btn"><span>입력</span></button>
									</div>
									<div class="se2_gradation1 husky_se2m_cp_colpanel"></div>
									<div class="se2_gradation2 husky_se2m_cp_huepanel"></div>
								</div>
							</div>
	                    </div>
					</div>
	                <!-- //글자색 -->
				</li>
				<li class="se2_pair husky_seditor_ui_BGColor"><span class="husky_seditor_ui_BGColorA"><button type="button" title="배경색" class="se2_bgcolor husky_se2m_BGColor_lastUsed" style="background-color:#4477f9;"><span>배경색</span></button></span><span class="husky_seditor_ui_BGColorB"><button type="button" title="더보기" class="se2_bgcolor_more"><span>더보기</span></button></span>
					<!-- 배경색 -->
					<div class="se2_layer se2_layer husky_se2m_BGColor_layer" style="display:none">
						<div class="se2_in_layer">
							<div class="se2_palette_bgcolor">
								<ul class="se2_background husky_se2m_bgcolor_list">
								<li><button type="button" title="#ff0000" style="background:#ff0000; color:#ffffff"><span><span>가나다</span></span></button></li>								
								<li><button type="button" title="#6d30cf" style="background:#6d30cf; color:#ffffff"><span><span>가나다</span></span></button></li>
								<li><button type="button" title="#000000" style="background:#000000; color:#ffffff"><span><span>가나다</span></span></button></li>
								<li><button type="button" title="#ff6600" style="background:#ff6600; color:#ffffff"><span><span>가나다</span></span></button></li>
								<li><button type="button" title="#3333cc" style="background:#3333cc; color:#ffffff"><span><span>가나다</span></span></button></li>
								<li><button type="button" title="#333333" style="background:#333333; color:#ffff00"><span><span>가나다</span></span></button></li>
								<li><button type="button" title="#ffa700" style="background:#ffa700; color:#ffffff"><span><span>가나다</span></span></button></li>
								<li><button type="button" title="#009999" style="background:#009999; color:#ffffff"><span><span>가나다</span></span></button></li>
								<li><button type="button" title="#8e8e8e" style="background:#8e8e8e; color:#ffffff"><span><span>가나다</span></span></button></li>								
								<li><button type="button" title="#cc9900" style="background:#cc9900; color:#ffffff"><span><span>가나다</span></span></button></li>
								<li><button type="button" title="#77b02b" style="background:#77b02b; color:#ffffff"><span><span>가나다</span></span></button></li>
								<li><button type="button" title="#ffffff" style="background:#ffffff; color:#000000"><span><span>가나다</span></span></button></li>
								</ul>
							</div>
							<div class="husky_se2m_BGColor_paletteHolder"></div>
	                    </div>
					</div>
	                <!-- //배경색 -->
				</li>
				<li class="husky_seditor_ui_superscript"><button type="button" title="윗첨자" class="se2_sup"><span>윗첨자</span></button></li>
				<li class="husky_seditor_ui_subscript"><button type="button" title="아래첨자" class="se2_sub"><span>아래첨자</span></button></li>
				</ul>
				<ul class="se2_paragraph">
					<li class="husky_seditor_ui_justifyleft"><button type="button" title="왼쪽정렬" class="se2_left"><span>왼쪽정렬</span></button></li>
					<li class="husky_seditor_ui_justifycenter"><button type="button" title="가운데정렬" class="se2_center"><span>가운데정렬</span></button></li>
					<li class="husky_seditor_ui_justifyright"><button type="button" title="오른쪽정렬" class="se2_right"><span>오른쪽정렬</span></button></li>
					<li class="husky_seditor_ui_justifyfull"><button type="button" title="양쪽정렬" class="se2_justify"><span>양쪽정렬</span></button></li>
					<li class="husky_seditor_ui_lineHeight"><button type="button" title="줄간격" class="se2_lineheight" ><span>줄간격</span></button>
						<!-- 줄간격 레이어 -->
						<div class="se2_layer husky_se2m_lineHeight_layer">
							<div class="se2_in_layer">
								<ul class="se2_l_line_height">
								<li><button type="button"><span>50%</span></button></li>
								<li><button type="button"><span>80%</span></button></li>
								<li><button type="button"><span>100%</span></button></li>
								<li><button type="button"><span>120%</span></button></li>
								<li><button type="button"><span>150%</span></button></li>
								<li><button type="button"><span>180%</span></button></li>
								<li><button type="button"><span>200%</span></button></li>
								</ul>
								<div class="se2_l_line_height_user husky_se2m_lineHeight_direct_input">
									<h3>직접 입력</h3>
									<span class="bx_input">
									<input type="text" class="input_ty1" maxlength="3" style="width:75px">
									<button type="button" title="1% 더하기" class="btn_up"><span>1% 더하기</span></button>
									<button type="button" title="1% 빼기" class="btn_down"><span>1% 빼기</span></button>
									</span>		
									<div class="btn_area">
										<button type="button" class="se2_btn_apply3"><span>적용</span></button><button type="button" class="se2_btn_cancel3"><span>취소</span></button>
									</div>
	
								</div>
							</div>
						</div>
						<!-- //줄간격 레이어 -->
					</li>
				</ul>
				<ul class="se2_etc">
                    <li class="husky_seditor_ui_orderedlist"><button type="button" title="번호매기기" class="se2_ol"><span>번호매기기</span></button></li>
                    <li class="husky_seditor_ui_unorderedlist"><button type="button" title="글머리기호" class="se2_ul"><span>글머리기호</span></button></li>
                    <li class="husky_seditor_ui_outdent"><button type="button" title="내어쓰기" class="se2_indent"><span>내어쓰기[Tab]</span></button></li>
                    <li class="husky_seditor_ui_indent"><button type="button" title="들여쓰기" class="se2_outdent"><span>들여쓰기[Shift+Tab]</span></button></li>
				</ul>
				<ul class="se2_etc">				
				<li class="husky_seditor_ui_quote"><button type="button" title="인용구" class="se2_blockquote"><span>인용구</span></button>
					<!-- 인용구 -->
					<div class="se2_layer husky_seditor_blockquote_layer" style="margin-left:-407px; display:none;">
						<div class="se2_in_layer">
							<div class="se2_quote">
								<ul>
								<li class="q1"><button type="button" class="se2_quote1"><span><span>인용구 스타일1</span></span></button></li>
								<li class="q2"><button type="button" class="se2_quote2"><span><span>인용구 스타일2</span></span></button></li>
								<li class="q3"><button type="button" class="se2_quote3"><span><span>인용구 스타일3</span></span></button></li>
								<li class="q4"><button type="button" class="se2_quote4"><span><span>인용구 스타일4</span></span></button></li>
								<li class="q5"><button type="button" class="se2_quote5"><span><span>인용구 스타일5</span></span></button></li>
								<li class="q6"><button type="button" class="se2_quote6"><span><span>인용구 스타일6</span></span></button></li>
								<li class="q7"><button type="button" class="se2_quote7"><span><span>인용구 스타일7</span></span></button></li>
								<li class="q8"><button type="button" class="se2_quote8"><span><span>인용구 스타일8</span></span></button></li>
								<li class="q9"><button type="button" class="se2_quote9"><span><span>인용구 스타일9</span></span></button></li>
								<li class="q10"><button type="button" class="se2_quote10"><span><span>인용구 스타일10</span></span></button></li>
								</ul>
								<button type="button" class="se2_cancel2"><span>적용취소</span></button>
							</div>
						</div>
					</div>
					<!-- //인용구 -->
				</li>
				</ul>
				<ul class="se2_etc">
				<li class="husky_seditor_ui_hyperlink"><button type="button" title="링크" class="se2_url"><span>링크</span></button>
					<!-- 링크 -->
					<div class="se2_layer" style="margin-left:-285px">
						<div class="se2_in_layer">
							<div class="se2_url2">
								<input type="text" class="input_ty1" value="http://">
								<button type="button" class="se2_apply"><span>적용</span></button><button type="button" class="se2_cancel"><span>취소</span></button>
							</div>
						</div>
					</div>
					<!-- //링크 -->
				</li>
				<li class="husky_seditor_ui_sCharacter"><button type="button" title="특수기호" class="se2_character"><span>특수기호</span></button>
					<!-- 특수기호 -->
					<div class="se2_layer husky_seditor_sCharacter_layer" style="margin-left:-448px;">
						<div class="se2_in_layer">
							<div class="se2_bx_character">
								<ul class="se2_char_tab">
								<li class="active"><button type="button" class="se2_char1"><span>일반기호</span></button>
									<div class="se2_s_character">
										<ul class="husky_se2m_sCharacter_list"><li></li></ul>
									</div>
								</li>
								<li class=""><button type="button" class="se2_char2"><span>숫자와 단위</span></button>
	
									<div class="se2_s_character">
										<ul class="husky_se2m_sCharacter_list"><li></li></ul>
									</div>
								</li>
								<li class=""><button type="button" class="se2_char3"><span>원,괄호</span></button>
									<div class="se2_s_character">
										<ul class="husky_se2m_sCharacter_list"><li></li></ul>
									</div>
	
								</li>
								<li class=""><button type="button" class="se2_char4"><span>한글</span></button>
									<div class="se2_s_character">
										<ul class="husky_se2m_sCharacter_list"><li></li></ul>
									</div>
								</li>
								<li class=""><button type="button" class="se2_char5"><span>그리스,라틴어</span></button>
									<div class="se2_s_character">
	
										<ul class="husky_se2m_sCharacter_list"><li></li></ul>
									</div>
								</li>
								<li class=""><button type="button" class="se2_char6"><span>일본어</span></button>
									<div class="se2_s_character">
										<ul class="husky_se2m_sCharacter_list"><li></li></ul>
									</div>
								</li>
								</ul>
								<p class="se2_apply_character">
									<label for="char_preview">선택한 기호</label> <input type="text" name="char_preview" id="char_preview" value="®º⊆●○" class="input_ty1"><button type="button" class="se2_confirm"><span>적용</span></button><button type="button" class="se2_cancel husky_se2m_sCharacter_close"><span>취소</span></button>
								</p>
							</div>
						</div>
					</div>
					<!-- //특수기호 -->
				</li>
				<li class="husky_seditor_ui_table"><button type="button" title="표" class="se2_table"><span>표</span></button>
					<!-- 표 -->
					<div class="se2_layer husky_se2m_table_layer" style="margin-left:-171px">
						<div class="se2_in_layer">
							<div class="se2_table_set">
								<fieldset>
								<legend>칸수 지정</legend>
									<dl class="se2_cell_num">
									<dt><label for="row">행</label></dt>
									<dd><input id="row" name="" type="text" maxlength="2" value="4" class="input_ty2">
										<button type="button" title="1행추가" class="se2_add"><span>1행추가</span></button>
										<button type="button" title="1행삭제" class="se2_del"><span>1행삭제</span></button>
									</dd>
									<dt><label for="col">열</label></dt>
									<dd><input id="col" name="" type="text" maxlength="2" value="4" class="input_ty2">
										<button type="button" title="1열추가" class="se2_add"><span>1열추가</span></button>
										<button type="button" title="1열삭제" class="se2_del"><span>1열삭제</span></button>
									</dd>
									</dl>
									<table border="0" cellspacing="1" class="se2_pre_table husky_se2m_table_preview">
									<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									</tr>
									<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									</tr>
									<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									</tr>
									</table>
								</fieldset>
								<fieldset>
									<legend>속성직접입력</legend>
									<dl class="se2_t_proper1">
									<dt><input type="radio" id="se2_tbp1" name="se2_tbp" checked><label for="se2_tbp1">속성 직접입력</label></dt>
									<dd>
										<dl class="se2_t_proper1_1">
										<dt><label>테두리스타일</label></dt>
										<dd><div class="se2_select_ty1"><span class="se2_b_style3 husky_se2m_table_border_style_preview"></span><button type="button" title="더보기" class="se2_view_more"><span>더보기</span></button></div>
											<!-- 레이어 : 테두리스타일 -->
											<div class="se2_layer_b_style husky_se2m_table_border_style_layer" style="display:none">
												<ul>
												<li><button type="button" class="se2_b_style1"><span class="se2m_no_border">테두리 없음</span></button></li>
												<li><button type="button" class="se2_b_style2"><span><span>테두리스타일2</span></span></button></li>
												<li><button type="button" class="se2_b_style3"><span><span>테두리스타일3</span></span></button></li>
												<li><button type="button" class="se2_b_style4"><span><span>테두리스타일4</span></span></button></li>
												<li><button type="button" class="se2_b_style5"><span><span>테두리스타일5</span></span></button></li>
												<li><button type="button" class="se2_b_style6"><span><span>테두리스타일6</span></span></button></li>
												<li><button type="button" class="se2_b_style7"><span><span>테두리스타일7</span></span></button></li>
												</ul>
											</div>
											<!-- //레이어 : 테두리스타일 -->
										</dd>
										</dl>
										<dl class="se2_t_proper1_1 se2_t_proper1_2">
										<dt><label for="se2_b_width">테두리두께</label></dt>
										<dd><input id="se2_b_width" name="" type="text" maxlength="2" value="1" class="input_ty1">
											<button type="button" title="1px 더하기" class="se2_add se2m_incBorder"><span>1px 더하기</span></button>
											<button type="button" title="1px 빼기" class="se2_del se2m_decBorder"><span>1px 빼기</span></button>
										</dd>
										</dl>
										<dl class="se2_t_proper1_1 se2_t_proper1_3">
										<dt><label for="se2_b_color">테두리색</label></dt>
										<dd><input id="se2_b_color" name="" type="text" maxlength="7" value="#cccccc" class="input_ty3"><span class="se2_pre_color"><button type="button" style="background:#cccccc;"><span>색찾기</span></button></span>	
										<!-- 레이어 : 테두리색 -->
											<div class="se2_layer se2_b_t_b1" style="clear:both;display:none;position:absolute;top:20px;left:-147px;">
												<div class="se2_in_layer husky_se2m_table_border_color_pallet">
												</div>
											</div>
										<!-- //레이어 : 테두리색-->
										</dd>
										</dl>
										<div class="se2_t_dim0"></div><!-- 테두리 없음일때 딤드레이어 -->
										<dl class="se2_t_proper1_1 se2_t_proper1_4">
										<dt><label for="se2_cellbg">셀 배경색</label></dt>
										<dd><input id="se2_cellbg" name="" type="text" maxlength="7" value="#ffffff" class="input_ty3"><span class="se2_pre_color"><button type="button" style="background:#ffffff;"><span>색찾기</span></button></span>		<!-- 레이어 : 셀배경색 -->
										<div class="se2_layer se2_b_t_b1" style="clear:both;display:none;position:absolute;top:20px;left:-147px;">
											<div class="se2_in_layer husky_se2m_table_bgcolor_pallet">
											</div>
										</div>
										<!-- //레이어 : 셀배경색-->
										</dd>
										</dl>
									</dd>
									</dl>
								</fieldset>
								<fieldset>
									<legend>표스타일</legend>
									<dl class="se2_t_proper2">
									<dt><input type="radio" id="se2_tbp2" name="se2_tbp"><label for="se2_tbp2">스타일 선택</label></dt>
									<dd><div class="se2_select_ty2"><span class="se2_t_style1 husky_se2m_table_style_preview"></span><button type="button" title="더보기" class="se2_view_more"><span>더보기</span></button></div>
										<!-- 레이어 : 표템플릿선택 -->
										<div class="se2_layer_t_style husky_se2m_table_style_layer" style="display:none">
											<ul class="se2_scroll">
											<li><button type="button" class="se2_t_style1"><span>표스타일1</span></button></li>
											<li><button type="button" class="se2_t_style2"><span>표스타일2</span></button></li>
											<li><button type="button" class="se2_t_style3"><span>표스타일3</span></button></li>
											<li><button type="button" class="se2_t_style4"><span>표스타일4</span></button></li>
											<li><button type="button" class="se2_t_style5"><span>표스타일5</span></button></li>
											<li><button type="button" class="se2_t_style6"><span>표스타일6</span></button></li>
											<li><button type="button" class="se2_t_style7"><span>표스타일7</span></button></li>
											<li><button type="button" class="se2_t_style8"><span>표스타일8</span></button></li>
											<li><button type="button" class="se2_t_style9"><span>표스타일9</span></button></li>
											<li><button type="button" class="se2_t_style10"><span>표스타일10</span></button></li>
											<li><button type="button" class="se2_t_style11"><span>표스타일11</span></button></li>
											<li><button type="button" class="se2_t_style12"><span>표스타일12</span></button></li>
											<li><button type="button" class="se2_t_style13"><span>표스타일13</span></button></li>
											<li><button type="button" class="se2_t_style14"><span>표스타일14</span></button></li>
											<li><button type="button" class="se2_t_style15"><span>표스타일15</span></button></li>
											<li><button type="button" class="se2_t_style16"><span>표스타일16</span></button></li>
											</ul>
										</div>
										<!-- //레이어 : 표템플릿선택 -->
									</dd>
									</dl>
								</fieldset>
								<p class="se2_btn_area">
									<button type="button" class="se2_apply"><span>적용</span></button><button type="button" class="se2_cancel"><span>취소</span></button>
								</p>
								<!-- 딤드레이어 -->
								<div class="se2_t_dim3"></div>
								<!-- //딤드레이어 -->
							</div>
						</div>
	
					</div>
					<!-- //표 -->
				</li>
				<li class="husky_seditor_ui_findAndReplace"><button type="button" title="찾기/바꾸기" class="se2_find"><span>찾기/바꾸기</span></button>
					<!-- 찾기/바꾸기 -->
					<div class="se2_layer husky_se2m_findAndReplace_layer" style="margin-left:-238px;">
						<div class="se2_in_layer">
							<div class="se2_bx_find_revise">
								<button type="button" title="닫기" class="se2_close husky_se2m_cancel"><span>닫기</span></button>
								<h3>찾기/바꾸기</h3>
								<ul>
								<li class="active"><button type="button" class="se2_tabfind"><span>찾기</span></button></li>
								<li><button type="button" class="se2_tabrevise"><span>바꾸기</span></button></li>
								</ul>
								<div class="se2_in_bx_find husky_se2m_find_ui" style="display:block">
									<dl>
									<dt><label for="find_word">찾을단어</label></dt><dd><input type="text" id="find_word" value="스마트에디터" class="input_ty1"></dd>
									</dl>
									<p class="se2_find_btns">
										<button type="button" class="se2_find_next husky_se2m_find_next"><span>다음찾기</span></button><button type="button" class="se2_cancel husky_se2m_cancel"><span>취소</span></button>
									</p>
								</div>
								<div class="se2_in_bx_revise husky_se2m_replace_ui" style="display:none">
									<dl>
									<dt><label for="find_word2">찾을단어</label></dt><dd><input type="text" id="find_word2" value="스마트에디터" class="input_ty1"></dd>
									<dt><label for="revise_word">바꿀단어</label></dt><dd><input type="text" id="revise_word" value="스마트 에디터" class="input_ty1"></dd>
									</dl>
									<p class="se2_find_btns">
										<button type="button" class="se2_find_next2 husky_se2m_replace_find_next"><span>다음찾기</span></button><button type="button" class="se2_revise1 husky_se2m_replace"><span>바꾸기</span></button><button type="button" class="se2_revise2 husky_se2m_replace_all"><span>모두바꾸기</span></button><button type="button" class="se2_cancel husky_se2m_cancel"><span>취소</span></button>
									</p>
								</div>
								<button type="button" title="닫기" class="se2_close husky_se2m_cancel"><span>닫기</span></button>
							</div>
						</div>
					</div>
					<!-- //찾기/바꾸기 -->
				</li>
				</ul>
			</div>
			<!-- icon toolbar -->
			<div class="se2_icon_tool" style="display:block;">
				<ul class="se2_itool1">
					<li class="se2_mn husky_seditor_ui_photo_attach"><button type="button" class="se2_photo se2_wty2_ic se2_mfirst"><span class="se2_icon"></span><span class="se2_mntxt">사진</span></button></li>
				</ul>
			</div>
			<!-- //704이상 -->
		</div>		
		<hr>
		<!-- 입력 -->
		<div class="se2_input_area husky_seditor_editing_area_container">
			<iframe src="about:blank" id="se2_iframe" name="se2_iframe" class="se2_input_wysiwyg" width="400" height="377" frameborder="0" scrolling="yes" title="글쓰기 영역 : 글쓰기 영역에서 빠져 나오시려면 Shift+ESC키를 누르세요" style="display:block;" ></iframe>
			<textarea name="" rows="10" cols="100" title="HTML 편집 모드" class="se2_input_syntax se2_input_htmlsrc" style="display:none;outline-style:none;resize:none;">&lt;p&gt;&lt;/p&gt;</textarea>
			<textarea name="" rows="10" cols="100" title="TEXT 편집 모드" class="se2_input_syntax se2_input_text" style="display:none;outline-style:none;resize:none;"> </textarea>
			<!-- 표/리뷰쓰기퀵에디터 -->
			<div class="quick_wrap">
				<div class="q_table_wrap"> 
				<button type="button" title="최대화" class="_fold se2_qmax q_open_table_full" style="position:absolute; display:none;top:340px;left:210px;z-index:10;"><span>퀵에디터최대화</span></button>
				<div class="_full se2_qeditor se2_table_set" style="position:absolute;display:none;top:135px;left:661px;z-index:10;">
					<div class="se2_qbar q_dragable"><span class="se2_qmini"><button class="q_open_table_fold" title="최소화"><span>퀵에디터최소화</span></button></span></div>
					<div class="se2_qbody0">
						<div class="se2_qbody">
							<dl class="se2_qe1">
							<dt>삽입</dt><dd><button type="button" title="행삽입" class="se2_addrow"><span>행삽입</span></button><button type="button" title="열삽입" class="se2_addcol"><span>열삽입</span></button></dd>
							<dt>분할</dt><dd><button type="button" title="행분할" class="se2_seprow"><span>행분할</span></button><button type="button" title="열분할" class="se2_sepcol"><span>열분할</span></button></dd>
							<dt>삭제</dt><dd><button type="button" title="행삭제" class="se2_delrow"><span>행삭제</span></button><button type="button" title="열삭제" class="se2_delcol"><span>열삭제</span></button></dd>
							<dt>병합</dt><dd><button type="button" title="행병합" class="se2_merrow"><span>행병합</span></button></dd>
							</dl>
							<div class="se2_qe2 se2_qe2_3">
								<!-- 샐배경색 -->
								<dl class="se2_qe2_1">
								<dt><input type="radio" class="husky_se2m_radio_bgc" id="se2_cellbg2" name="se2_tbp3" checked><label for="se2_cellbg2">셀 배경색</label></dt>
								<dd><span class="se2_pre_color"><button class="husky_se2m_table_qe_bgcolor_btn" type="button" style="background:#000000;"><span>색찾기</span></button></span>		
									<!-- layer:셀배경색 -->
									<div class="se2_layer se2_b_t_b1" style="display:none;position:absolute;top:20px;left:0px;">
										<div class="se2_in_layer husky_se2m_tbl_qe_bg_paletteHolder">
										</div>
									</div>
									<!-- //layer:셀배경색-->
								</dd>
								</dl>
								<!-- //샐배경색 -->
								<!-- 배경이미지선택 -->
								<dl class="se2_qe2_2 husky_se2m_tbl_qe_review_bg" style="display:block">
								<dt><input type="radio" class="husky_se2m_radio_bgimg" id="se2_cellbg3" name="se2_tbp3"><label for="se2_cellbg3">이미지</label></dt>
								<dd><span class="se2_pre_bgimg"><button type="button" class="se2_cellimg1 husky_se2m_table_qe_bgimage_btn"><span>배경이미지선택</span></button></span>		
									<!-- layer:배경이미지선택 -->
									<div class="se2_layer se2_b_t_b1" style="display:none;position:absolute;top:20px;left:-155px;">
										<div class="se2_in_layer husky_se2m_tbl_qe_bg_img_paletteHolder">
											<ul class="se2_cellimg_set">
											<li><button type="button" class="se2_cellimg0"><span>배경없음</span></button></li>
											<li><button type="button" class="se2_cellimg1"><span>배경1</span></button></li>
											<li><button type="button" class="se2_cellimg2"><span>배경2</span></button></li>
											<li><button type="button" class="se2_cellimg3"><span>배경3</span></button></li>
											<li><button type="button" class="se2_cellimg4"><span>배경4</span></button></li>
											<li><button type="button" class="se2_cellimg5"><span>배경5</span></button></li>
											<li><button type="button" class="se2_cellimg6"><span>배경6</span></button></li>
											<li><button type="button" class="se2_cellimg7"><span>배경7</span></button></li>
											<li><button type="button" class="se2_cellimg8"><span>배경8</span></button></li>
											<li><button type="button" class="se2_cellimg9"><span>배경9</span></button></li>
											<li><button type="button" class="se2_cellimg10"><span>배경10</span></button></li>
											<li><button type="button" class="se2_cellimg11"><span>배경11</span></button></li>
											<li><button type="button" class="se2_cellimg12"><span>배경12</span></button></li>
											<li><button type="button" class="se2_cellimg13"><span>배경13</span></button></li>
											<li><button type="button" class="se2_cellimg14"><span>배경14</span></button></li>
											<li><button type="button" class="se2_cellimg15"><span>배경15</span></button></li>
											<li><button type="button" class="se2_cellimg16"><span>배경16</span></button></li>
											<li><button type="button" class="se2_cellimg17"><span>배경17</span></button></li>
											<li><button type="button" class="se2_cellimg18"><span>배경18</span></button></li>
											<li><button type="button" class="se2_cellimg19"><span>배경19</span></button></li>
											<li><button type="button" class="se2_cellimg20"><span>배경20</span></button></li>
											<li><button type="button" class="se2_cellimg21"><span>배경21</span></button></li>
											<li><button type="button" class="se2_cellimg22"><span>배경22</span></button></li>
											<li><button type="button" class="se2_cellimg23"><span>배경23</span></button></li>
											<li><button type="button" class="se2_cellimg24"><span>배경24</span></button></li>
											<li><button type="button" class="se2_cellimg25"><span>배경25</span></button></li>
											<li><button type="button" class="se2_cellimg26"><span>배경26</span></button></li>
											<li><button type="button" class="se2_cellimg27"><span>배경27</span></button></li>
											<li><button type="button" class="se2_cellimg28"><span>배경28</span></button></li>
											<li><button type="button" class="se2_cellimg29"><span>배경29</span></button></li>
											<li><button type="button" class="se2_cellimg30"><span>배경30</span></button></li>
											<li><button type="button" class="se2_cellimg31"><span>배경31</span></button></li>
											</ul>
										</div>
									</div>
									<!-- //layer:배경이미지선택-->
								</dd>
								</dl>
								<!-- //배경이미지선택 -->
							</div>
							<dl class="se2_qe3 se2_t_proper2" style="display:none">
							<dt><input type="radio" class="husky_se2m_radio_template" id="se2_tbp4" name="se2_tbp3"><label for="se2_tbp4">표 스타일</label></dt>
							<dd>
								<div class="se2_qe3_table">
								<div class="se2_select_ty2"><span class="se2_t_style1"></span><button type="button" title="더보기" class="se2_view_more husky_se2m_template_more"><span>더보기</span></button></div>
								<!-- layer:표스타일 -->
								<div class="se2_layer_t_style" style="display:none;top:33px;left:0;margin:0;">
									<ul>
									<li><button type="button" class="se2_t_style1"><span>표스타일1</span></button></li>
									<li><button type="button" class="se2_t_style2"><span>표스타일2</span></button></li>
									<li><button type="button" class="se2_t_style3"><span>표스타일3</span></button></li>
									<li><button type="button" class="se2_t_style4"><span>표스타일4</span></button></li>
									<li><button type="button" class="se2_t_style5"><span>표스타일5</span></button></li>
									<li><button type="button" class="se2_t_style6"><span>표스타일6</span></button></li>
									<li><button type="button" class="se2_t_style7"><span>표스타일7</span></button></li>
									<li><button type="button" class="se2_t_style8"><span>표스타일8</span></button></li>
									<li><button type="button" class="se2_t_style9"><span>표스타일9</span></button></li>
									<li><button type="button" class="se2_t_style10"><span>표스타일10</span></button></li>
									<li><button type="button" class="se2_t_style11"><span>표스타일11</span></button></li>
									<li><button type="button" class="se2_t_style12"><span>표스타일12</span></button></li>
									<li><button type="button" class="se2_t_style13"><span>표스타일13</span></button></li>
									<li><button type="button" class="se2_t_style14"><span>표스타일14</span></button></li>
									<li><button type="button" class="se2_t_style15"><span>표스타일15</span></button></li>
									<li><button type="button" class="se2_t_style16"><span>표스타일16</span></button></li>
									</ul>
								</div>
								<!-- //layer:표스타일 -->
								</div>
							</dd>
							</dl>
							<div class="se2_btn_area" style="display:none">
								<button type="button" class="se2_btn_save"><span>My 리뷰저장</span></button>
							</div>
							<div class="se2_qdim0 husky_se2m_tbl_qe_dim1"></div>
							<div class="se2_qdim3 husky_se2m_tbl_qe_dim2"></div>
							<div class="se2_qdim6c husky_se2m_tbl_qe_dim_del_col"></div>
							<div class="se2_qdim6r husky_se2m_tbl_qe_dim_del_row"></div>
						</div>
					</div>
				</div>
				</div>
				<!-- //표/리뷰쓰기퀵에디터 -->
			</div>
		</div>
		<!-- //입력 -->
		<!-- 입력창조절/ 모드전환 -->
		<div class="se2_conversion_mode">
			<button type="button" class="se2_inputarea_controller husky_seditor_editingArea_verticalResizer" title="입력창 크기 조절"><span>입력창 크기 조절</span></button>
			<ul class="se2_converter">
			<li class="active"><button type="button" class="se2_to_editor"><span>Editor</span></button></li>	
			<li class=""><button type="button" class="se2_to_html"><span>HTML</span></button></li>		
			<li class=""><button type="button" class="se2_to_text" title="HTML"><span>TEXT</span></button></li>		
			</ul>
		</div>
		<!-- //입력창조절/ 모드전환 -->
		<hr>
	</div>
</div>
</body>
</html>