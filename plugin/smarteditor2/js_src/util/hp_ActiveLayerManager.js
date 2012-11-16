/*[
 * TOGGLE_ACTIVE_LAYER
 *
 * 액티브 레이어가 화면에 보이는 여부를 토글 한다.
 *
 * oLayer HTMLElement 레이어로 사용할 HTML Element
 * sOnOpenCmd string 화면에 보이는 경우 발생 할 메시지(옵션)
 * aOnOpenParam array sOnOpenCmd와 함께 넘겨줄 파라미터(옵션)
 * sOnCloseCmd string 해당 레이어가 화면에서 숨겨질 때 발생 할 메시지(옵션)
 * aOnCloseParam array sOnCloseCmd와 함께 넘겨줄 파라미터(옵션)
 *
---------------------------------------------------------------------------]*/
/*[
 * SHOW_ACTIVE_LAYER
 *
 * 액티브 레이어가 화면에 보이는 여부를 토글 한다.
 *
 * oLayer HTMLElement 레이어로 사용할 HTML Element
 * sOnCloseCmd string 해당 레이어가 화면에서 숨겨질 때 발생 할 메시지(옵션)
 * aOnCloseParam array sOnCloseCmd와 함께 넘겨줄 파라미터(옵션)
 *
---------------------------------------------------------------------------]*/
/*[
 * 	HIDE_ACTIVE_LAYER
 *
 * 현재 화면에 보이는 액티브 레이어를 화면에서 숨긴다.
 *
 * none
 *
---------------------------------------------------------------------------]*/
/**
 * @pluginDesc 한번에 한개만 화면에 보여야 하는 레이어를 관리하는 플러그인
 */
nhn.husky.ActiveLayerManager = jindo.$Class({
	name : "ActiveLayerManager",
	oCurrentLayer : null,
	
	$BEFORE_MSG_APP_READY : function() {
		this.oNavigator = jindo.$Agent().navigator();
	},
	
	$ON_TOGGLE_ACTIVE_LAYER : function(oLayer, sOnOpenCmd, aOnOpenParam, sOnCloseCmd, aOnCloseParam){
		if(oLayer == this.oCurrentLayer){
			this.oApp.exec("HIDE_ACTIVE_LAYER", []);
		}else{
			this.oApp.exec("SHOW_ACTIVE_LAYER", [oLayer, sOnCloseCmd, aOnCloseParam]);
			if(sOnOpenCmd){this.oApp.exec(sOnOpenCmd, aOnOpenParam);}
		}
	},
	
	$ON_SHOW_ACTIVE_LAYER : function(oLayer, sOnCloseCmd, aOnCloseParam){
		oLayer = jindo.$(oLayer);

		var oPrevLayer = this.oCurrentLayer;
		if(oLayer == oPrevLayer){return;}

		this.oApp.exec("HIDE_ACTIVE_LAYER", []);
		
		this.sOnCloseCmd = sOnCloseCmd;
		this.aOnCloseParam = aOnCloseParam;

		oLayer.style.display = "block";
		this.oCurrentLayer = oLayer;
		this.oApp.exec("ADD_APP_PROPERTY", ["oToolBarLayer", this.oCurrentLayer]);
	},

	$ON_HIDE_ACTIVE_LAYER : function(){
		var oLayer = this.oCurrentLayer;
		if(!oLayer){return;}
		oLayer.style.display = "none";
		this.oCurrentLayer = null;
		if(this.sOnCloseCmd){
			this.oApp.exec(this.sOnCloseCmd, this.aOnCloseParam);
		}

		if(!!this.oNavigator.msafari){
			this.oApp.getWYSIWYGWindow().focus();
		}
	},
	
	$ON_HIDE_ACTIVE_LAYER_IF_NOT_CHILD : function(el){
		var elTmp = el;
		while(elTmp){
			if(elTmp == this.oCurrentLayer){
				return;
			}
			elTmp = elTmp.parentNode;
		}
		this.oApp.exec("HIDE_ACTIVE_LAYER");
	},

	// for backward compatibility only.
	// use HIDE_ACTIVE_LAYER instead!
	$ON_HIDE_CURRENT_ACTIVE_LAYER : function(){
		this.oApp.exec("HIDE_ACTIVE_LAYER", []);
	}
});