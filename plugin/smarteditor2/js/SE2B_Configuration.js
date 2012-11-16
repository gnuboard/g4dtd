/*
 * Smart Editor 2 Configuration
 */
if(typeof window.nhn=='undefined'){window.nhn = {};}
if (!nhn.husky){nhn.husky = {};}
nhn.husky.SE2M_Configuration = {};

nhn.husky.SE2M_Configuration.Editor = {
	sJsBaseURL : './js_src',
	sImageBaseURL : './img'
};

nhn.husky.SE2M_Configuration.LinkageDomain = {
	sCommonAPI : 'http://api.se2.naver.com',
	sCommonStatic : 'http://static.se2.naver.com',
	sCommonImage : 'http://images.se2.naver.com'
};

nhn.husky.SE2M_Configuration.SE_EditingAreaManager = {
	sBlankPageURL : "smart_editor2_inputarea.html",
	sBlankPageURL_EmulateIE7 : "smart_editor2_inputarea_ie8.html",
	aAddtionalEmulateIE7 : [9, 10] // IE8 default 사용, IE9 ~ 선택적 사용
};

nhn.husky.SE2M_Configuration.LazyLoad = {
	sJsBaseURI : "js_lazyload"
};

nhn.husky.SE2M_Configuration.SE2B_CSSLoader = {
	sCSSBaseURI : "./css"
};

nhn.husky.SE2M_Configuration.Quote = {
	sImageBaseURL : 'http://static.se2.naver.com/static/img'
};

nhn.husky.SE2M_Configuration.CustomObject = {
	sVersion			: 1,
	sClassName 			: '__se_object',
	sValueName 			: 'jsonvalue',
	sTagIdPrefix		: 'se_object_',
	sTailComment		: '<!--__se_object_end -->',
	sBlankTemplateURL 	: nhn.husky.SE2M_Configuration.LinkageDomain.sCommonStatic + '/static/db_attach/iframe_template_for_se1_obj.html',
	sAttributeOfEmpty	: 's_isempty="true"',
	sAttributeOfOldDB	: 's_olddb="true"',
	sBlock	 			: '<div class="_block" style="position:absolute;z-index:10000;background-color:#fff;"></div>',
	sBlokTemplate	  	: '<div[\\s\\S]*?class=[\'"]?_block[\'"]?[\\s\\S]*?</div>',
	sHighlight 			: '<div class="_highlight" style="position:absolute;width:58px;height:16px;line-height:0;z-index:9999"><img src="' + nhn.husky.SE2M_Configuration.LinkageDomain.sCommonStatic + '/static/img/pencil2.png" alt="" width="58" height="16" style="vertical-align:top"></div>',
	sHighlightTemplate  : '<div[\\s\\S]*?class=[\'"]?_highlight[\'"]?[\\s\\S]*?</div>',
	sHtmlTemplateStartTag : '<!-- se_object_template_start -->',
	sHtmlTemplateEndTag : '<!-- se_object_template_end -->',
	sHtmlFilterTag 		: '{=sType}_{=sSubType}_{=nSeq}',
	sTplHtmlFilterTag 	: '<!--{=sType}_{=sSubType}_(\\d+)-->',
	sImgComServerPath	: nhn.husky.SE2M_Configuration.LinkageDomain.sCommonStatic + '/static/img/reviewitem',
	nMaxWidth			: 548
};

nhn.husky.SE2M_Configuration.SE2M_ReEditAction = {
	bUsed : true,
	nSecDisplayDulationReEditMsg : 3,
	aReEditGuideMsg : [
	    '이미지 파일은 1회 클릭 시 크기 조절, 더블클릭 시 재편집이 가능합니다.',
	    '첨부한 파일을 더블클릭 시 재편집이 가능합니다.',
	    '첨부한 글양식 테이블을 드래그시 테이블 재편집이 가능합니다.',
	    '첨부한 표를 드래그 시 표 재편집이 가능합니다.'
	]
};

nhn.husky.SE2M_Configuration.SE2M_ColorPalette = {
	bUseRecentColor : false
};

nhn.husky.SE2M_Configuration.QuickEditor = {
	common : {
		bUseConfig : false
	}
};