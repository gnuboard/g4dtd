<?
if (!defined('_GNUBOARD_')) exit;

function smarteditor_load()
{
    global $g4;
    return "<script type=\"text/javascript\" src=\"{$g4['se_path']}/js/HuskyEZCreator.js\"></script>\n"
         . "<script type=\"text/javascript\"> var oEditors = []; </script>\n";
}

/*
id 는 textarea 의 id element 를 말한다.
content 는 textarea 의 내용(값)을 말한다. 수정시에 저장된 값을 노출할때 사용된다.
폭은 거의 100%로 사용하므로 앞에 height 를 놓았다.
*/
function smarteditor_run($id, $content, $height='200', $width='100%')
{
    global $g4;
    $height = (int)$height;
    return "<textarea name=\"$id\" id=\"$id\" rows=\"1\" cols=\"1\" style=\"width:$width; height:{$height}px; display:none;\"></textarea>
    <script type=\"text/javascript\">
    nhn.husky.EZCreator.createInIFrame({
        oAppRef: oEditors,
        elPlaceHolder: \"$id\",
        sSkinURI: \"{$g4['se_path']}/SmartEditor2Skin.php\",
        htParams : {
            bUseToolbar : true,
            fOnBeforeUnload : function(){
                //alert(\"아싸!\");
            }
        }, //boolean
        fOnAppLoad : function(){
            oEditors.getById[\"$id\"].exec(\"PASTE_HTML\", [\"".addslashes(preg_replace("/\r|\n/","",$content))."\"]);
        },
        fCreator: \"createSEditor2\"
    });
    </script>\n";
}

function smarteditor_update($id)
{
    return "oEditors.getById[\"$id\"].exec(\"UPDATE_CONTENTS_FIELD\", []);\n";
}
?>