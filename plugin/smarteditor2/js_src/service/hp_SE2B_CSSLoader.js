//{
/**
 * @fileOverview This file contains Husky plugin that takes care of loading css files dynamically
 * @name hp_SE2B_CSSLoader.js
 */
nhn.husky.SE2B_CSSLoader = jindo.$Class({
	name : "SE2B_CSSLoader",
	bCssLoaded : false,
	
	// load & continue with the message right away.
	aInstantLoadTrigger : ["OPEN_QE_LAYER", "SHOW_ACTIVE_LAYER", "SHOW_DIALOG_LAYER"],
	// if a rendering bug occurs in IE, give some delay before continue processing the message.
	aDelayedLoadTrigger : ["MSG_SE_OBJECT_EDIT_REQUESTED", "OBJECT_MODIFY", "MSG_SE_DUMMY_OBJECT_EDIT_REQUESTED", "TOGGLE_TOOLBAR_ACTIVE_LAYER", "SHOW_TOOLBAR_ACTIVE_LAYER"],

	$init : function(){
		this.htOptions = nhn.husky.SE2M_Configuration.SE2B_CSSLoader;
			
		// only IE's slow
		if(!jindo.$Agent().navigator().ie){
			this.loadSE2CSS();
		}else{
			for(var i=0, nLen = this.aInstantLoadTrigger.length; i<nLen; i++){
				this["$BEFORE_"+this.aInstantLoadTrigger[i]] = jindo.$Fn(function(){
					this.loadSE2CSS();
				}, this).bind();
			}
			
			for(var i=0, nLen = this.aDelayedLoadTrigger.length; i<nLen; i++){
				var sMsg = this.aDelayedLoadTrigger[i];

				this["$BEFORE_"+this.aDelayedLoadTrigger[i]] = jindo.$Fn(function(sMsg){
					var aArgs = jindo.$A(arguments).$value();
					aArgs = aArgs.splice(1, aArgs.length-1);
					return this.loadSE2CSS(sMsg, aArgs);
				}, this).bind(sMsg);
			}
		}
	},
	
	/*
	$BEFORE_REEDIT_ITEM_ACTION : function(){
		return this.loadSE2CSS("REEDIT_ITEM_ACTION", arguments);
	},
	$BEFORE_OBJECT_MODIFY : function(){
		return this.loadSE2CSS("OBJECT_MODIFY", arguments);
	},
	$BEFORE_MSG_SE_DUMMY_OBJECT_EDIT_REQUESTED : function(){
		return this.loadSE2CSS("MSG_SE_DUMMY_OBJECT_EDIT_REQUESTED", arguments);
	},	
	$BEFORE_TOGGLE_DBATTACHMENT_LAYER : function(){
		return this.loadSE2CSS("TOGGLE_DBATTACHMENT_LAYER", arguments);
	},
	$BEFORE_SHOW_WRITE_REVIEW_DESIGN_SELECT_LAYER : function(){
		this.loadSE2CSS();
	},
	$BEFORE_OPEN_QE_LAYER : function(){
		this.loadSE2CSS();
	},
	$BEFORE_TOGGLE_TOOLBAR_ACTIVE_LAYER : function(){
		return this.loadSE2CSS("TOGGLE_TOOLBAR_ACTIVE_LAYER", arguments);
	},
	$BEFORE_SHOW_TOOLBAR_ACTIVE_LAYER : function(){
		return this.loadSE2CSS("SHOW_TOOLBAR_ACTIVE_LAYER", arguments);
	},
	$BEFORE_SHOW_ACTIVE_LAYER : function(){
		this.loadSE2CSS();
	},
	$BEFORE_SHOW_DIALOG_LAYER : function(){
		this.loadSE2CSS();
	},
	$BEFORE_TOGGLE_ITEM_LAYER : function(){
		return this.loadSE2CSS("TOGGLE_ITEM_LAYER", arguments);
	},
	*/

	// if a rendering bug occurs in IE, pass sMsg and oArgs to give some delay before the message is processed.
	loadSE2CSS : function(sMsg, oArgs){
		if(this.bCssLoaded){return true;}
		this.bCssLoaded = true;

		var fnCallback = null;
		if(sMsg){
			fnCallback = jindo.$Fn(this.oApp.exec, this.oApp).bind(sMsg, oArgs);
		}
		
		//nhn.husky.SE2M_Utils.loadCSS("css/smart_editor2.css");
		nhn.husky.SE2M_Utils.loadCSS(this.htOptions.sCSSBaseURI+"/smart_editor2_items.css", fnCallback);

		return false;
	}
});
//}