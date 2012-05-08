// 전역 변수
var errmsg = "";
var errfld;

/**
 * console.log() 대용(콘솔 사용불가시 자바스크립트 오류발생 방지)
 **/
function debugPrint(msg) {
    if (typeof console == 'object' && typeof console.log == 'function') {
        console.log(msg);
    }
}

/**
 * 필드 검사
 **/
function check_field(fld, msg) {
    if((fld.value = trim(fld.value)) == '') {
        error_field(fld, msg);
    } else {
        clear_field(fld);
    }

    return;
}

/**
 * 필드 오류 표시
 **/
function error_field(fld, msg) {
    if(msg != "") errmsg += msg + "\n";
    if(!errfld) errfld = fld;

    fld.style.background = "#BDDEF7";
}

/**
 * 필드를 깨끗하게
 **/
function clear_field(fld) {
    fld.style.background = "#FFFFFF";
}

/**
 * @TODO 함수 설명 필요
 **/
function trim(s) {
    var t = '';
    var from_pos = to_pos = 0;

    for(i = 0; i < s.length; i++) {
        if(s.charAt(i) == ' ') {
            continue;
        } else {
            from_pos = i;
            break;
        }
    }

    for(i = s.length; i >= 0; i--) {
        if(s.charAt(i - 1) == ' ') {
            continue;
        } else {
            to_pos = i;
            break;
        }
    }

    t = s.substring(from_pos, to_pos);

    return t;
}

/**
 * 자바스크립트로 PHP의 number_format 흉내를 냄
 * 숫자에 , 를 출력
 **/
function number_format(data) {
    var tmp = '';
    var number = '';
    var cutlen = 3;
    var comma = ',';
    var i;

    len = data.length;
    mod = (len % cutlen);
    k = cutlen - mod;

    for(i = 0; i < data.length; i++) {
        number = number + data.charAt(i);

        if(i < data.length - 1) {
            k++;
            if((k % cutlen) == 0) {
                number = number + comma;
                k = 0;
            }
        }
    }

    return number;
}

/**
 * 새 창
 **/
function popup_window(url, winname, opt) {
    window.open(url, winname, opt);
}

/**
 * a 태그에서 onclick 이벤트를 사용하지 않기 위해
 * @TODO 설명문구 수정
 **/
function win_open(url, name, option) {
    var popup = window.open(url, name, option);
    popup.focus();
}

/**
 * 폼메일 창
 **/
function popup_formmail(url) {
    opt = 'scrollbars=yes, width=417, height=385, top=10, left=20';
    popup_window(url, 'wformmail', opt);
}

/**
 * , 를 없앤다.
 * @TODO 문자열 치환하는데 왜 loop를 돌지?
 **/
function no_comma(data) {
    var tmp = '';
    var comma = ',';
    var i;

    for(i = 0; i < data.length; i++) {
        if(data.charAt(i) != comma) tmp += data.charAt(i);
    }

    return tmp;
}

/**
 * 삭제 검사 확인
 **/
function del(href) {
    if(confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n정말 삭제하시겠습니까?")) {
        document.location.href = href;
    }
}

/**
 * 쿠키 입력
 * @TODO 쿠키 플러그인으로 대체
 **/
function set_cookie(name, value, expirehours, domain) {
    var today = new Date();
    today.setTime(today.getTime() + (60 * 60 * 1000 * expirehours));
    document.cookie = name + '=' + escape( value ) + '; path=/; expires=' + today.toGMTString() + ';';

    if(domain) {
        document.cookie += 'domain=' + domain + ';';
    }
}

/**
 * 쿠키 얻음
 * @TODO 쿠키 플러그인으로 대체
 **/
function get_cookie(name) {
    var find_sw = false;
    var start, end;
    var i = 0;

    for(i = 0; i <= document.cookie.length; i++) {
        start = i;
        end = start + name.length;

        if(document.cookie.substring(start, end) == name) {
            find_sw = true;
            break;
        }
    }

    if(find_sw == true) {
        start = end + 1;
        end = document.cookie.indexOf(';', start);

        if(end < start) end = document.cookie.length;

        return document.cookie.substring(start, end);
    }
    return '';
}

/**
 * 쿠키 지움
 * @TODO 쿠키 플러그인으로 대체
 **/
function delete_cookie(name) {
    var today = new Date();

    today.setTime(today.getTime() - 1);
    var value = get_cookie(name);
    if(value != '') {
        document.cookie = name + '=' + value + '; path=/; expires=' + today.toGMTString();
    }
}



var last_id = null;

/**
 * @TODO 함수설명 필요
 **/
function menu(id) {
    if(id != last_id) {
        if(last_id != null) {
            jQuery('#' + last_id).hide();
        }
        jQuery('#' + id).show();
        last_id = id;
    } else {
        jQuery('#' + id).hide();
        last_id = null;
    }
}

/**
 * @TODO 함수설명 필요
 **/
function textarea_decrease(id, row) {
    if(document.getElementById(id).rows - row > 0) {
        document.getElementById(id).rows -= row;
    }
}

/**
 * @TODO 함수설명 필요
 **/
function textarea_original(id, row) {
    document.getElementById(id).rows = row;
}

/**
 * @TODO 함수설명 필요
 **/
function textarea_increase(id, row) {
    document.getElementById(id).rows += row;
}

/**
 * 글숫자 검사
 * @TODO 함수설명 보완
 **/
function check_byte(content, target) {
    var i = 0;
    var cnt = 0;
    var ch = '';
    var cont = document.getElementById(content).value;

    for(i = 0; i < cont.length; i++) {
        ch = cont.charAt(i);

        if(escape(ch).length > 4) {
            cnt += 2;
        } else {
            cnt += 1;
        }
    }

    // 숫자를 출력
    document.getElementById(target).innerHTML = cnt;

    return cnt;
}

/**
 * 브라우저에서 오브젝트의 왼쪽 좌표
 * @TODO jQuery 함수로 대체
 **/
function get_left_pos(obj) {
    var parentObj = null;
    var clientObj = obj;
    var left = obj.offsetLeft;

    while((parentObj = clientObj.offsetParent) != null) {
        left = left + parentObj.offsetLeft;
        clientObj = parentObj;
    }

    return left;
}

/**
 * 브라우저에서 오브젝트의 상단 좌표
 * @TODO jQuery 함수로 대체
 **/
function get_top_pos(obj) {
    var parentObj = null;
    var clientObj = obj;
    var top = obj.offsetTop;

    while((parentObj=clientObj.offsetParent) != null) {
        top = top + parentObj.offsetTop;
        clientObj = parentObj;
    }

    return top;
}

/**
 * @TODO 함수설명 필요
 **/
function flash_movie(src, ids, width, height, wmode) {
    var wh = '';
    if(parseInt(width) && parseInt(height)) {
        wh = " width='"+width+"' height='"+height+"' ";
    }

    return "<object classid='clsid:d27cdb6e-ae6d-11cf-96b8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0' "+wh+" id="+ids+"><param name=wmode value="+wmode+"><param name=movie value="+src+"><param name=quality value=high><embed src="+src+" quality=high wmode="+wmode+" type='application/x-shockwave-flash' pluginspage='http://www.macromedia.com/shockwave/download/index.cgi?p1_prod_version=shockwaveflash' "+wh+"></embed></object>";
}

/**
 * @TODO 함수설명 필요
 **/
function obj_movie(src, ids, width, height, autostart) {
    var wh = "";
    if (parseInt(width) && parseInt(height))
        wh = " width='"+width+"' height='"+height+"' ";
    if (!autostart) autostart = false;
    return "<embed src='"+src+"' "+wh+" autostart='"+autostart+"'></embed>";
}

/**
 * @TODO 함수설명 필요
 **/
function doc_write(cont) {
    document.write(cont);
}

String.prototype.trim = function() {
    return this.replace(/^\s+|\s+$/g, '');
}
String.prototype.ltrim = function() {
    return this.replace(/^\s+/, '');
}
String.prototype.rtrim = function() {
    return this.replace(/\s+$/, '');
}



/**
 * 한글, 영문, 숫자 검사
 **/
function chk_hanalnum(s) {
    var pattern = /([^가-힣ㄱ-ㅎㅏ-ㅣ^a-z^0-9])/i;

    return !pattern.test(s);
}


/**
 * 이메일주소 검사
 **/
function chk_email(s) {
    var pattern = /([0-9a-zA-Z_-]+)@([0-9a-zA-Z_-]+)\.([0-9a-zA-Z_-]+)/;

    return pattern.test(s);
}



/**
 * 포인트 창
 **/
var win_point = function(href) {
    var new_win = window.open(href, 'win_point', 'left=100,top=100,width=600, height=600, scrollbars=1');
    new_win.focus();
}

/**
 * 쪽지 창
 **/
var win_memo = function(href) {
    var new_win = window.open(href, 'win_memo', 'left=100,top=100,width=620,height=500,scrollbars=1');
    new_win.focus();
}

/**
 * 메일 창
 **/
var win_email = function(href) {
    var new_win = window.open(href, 'win_email', 'left=100,top=100,width=600,height=580,scrollbars=0');
    new_win.focus();
}

/**
 * 자기소개 창
 **/
var win_profile = function(href) {
    var new_win = window.open(href, 'win_profile', 'left=100,top=100,width=620,height=510,scrollbars=1');
    new_win.focus();
}

/**
 * 스크랩 창
 **/
var win_scrap = function(href) {
    var new_win = window.open(href, 'win_scrap', 'left=100,top=100,width=600,height=600,scrollbars=1');
    new_win.focus();
}

/**
 * 홈페이지 창
 **/
var win_homepage = function(href) {
    var new_win = window.open(href, 'win_homepage', '');
    new_win.focus();
}

/**
 * 우편번호 창
 **/
var win_zip = function(href) {
    var new_win = window.open(href, 'win_zip', 'width=616, height=460, scrollbars=1');
    new_win.focus();
}

/**
 * 새로운 패스워드 분실 창 : 101123
 **/
win_password_lost = function(href)
{
    var new_win = window.open(href, 'win_password_lost', 'width=617, height=330, scrollbars=1');
    new_win.focus();
}

/**
 * 설문조사 결과
 **/
var win_poll = function(href) {
    var new_win = window.open(href, 'win_poll', 'width=616, height=500, scrollbars=1');
    //new_win.focus();
}

// 게시물 이름 클릭하면 나오는 레이어
var div_sidebox = null;
jQuery(function($) {
    $('.win_point').click(function() {
        win_point(this.href);
        return false;
    });

    $('.win_memo').click(function() {
        win_memo(this.href);
        return false;
    });

    $('.win_email').click(function() {
        win_email(this.ref);
        return false;
    });

    $('.win_scrap').click(function() {
        win_scrap(this.href);
        return false;
    });

    $('.win_profile').click(function() {
        win_profile(this.ref);
        return false;
    });

    $('.win_homepage').click(function() {
        win_homepage(this.ref);
        return false;
    });

    $('.win_zip_find').click(function() {
        win_zip(this.href);
        return false;
    });

    $('.win_password_lost').click(function() {
        win_password_lost(this.href);
        return false;
    });

    $('.win_poll').click(function() {
        win_poll(this.href);
        return false;
    });

    //==========================================================================
    // 게시물 이름 레이어
    //--------------------------------------------------------------------------
    div_sidebox = document.createElement('DIV');
    div_sidebox.id = 'sidebox';
    div_sidebox.style.display = 'none';
    div_sidebox.style.position = 'absolute';
    document.body.appendChild(div_sidebox);

    var click_document_area = false;
    document.onclick = function() {
        if(!click_document_area) {
            div_sidebox.style.display = 'none';
        } else {
            click_document_area = false;
        }
    }

    $('.sidebox').bind('click', function() {
        var $this = $(this);
        click_document_area = true;

        var top    = $this.offset().top;
        var left   = $this.offset().left;
        var width  = $this.width();
        var height = $this.height();
        $('#sidebox').css({'top' : top + height / 3, 'left' : left + width - 5});

        var aflds = this.rel.split('&');
        var fld;
        for(var i = 0; i < aflds.length; i++) {
            fld = aflds[i].split('=');
            eval('var ' + fld[0] + ' = "' + fld[1] + '";');
        }

        var html = '';
        var first = ' class="first-child"';

        // 쪽지보내기
        if(mb_id) {
            html += "<li"+first+"><a href=\"javascript:win_memo('"+g4_bbs_path+"/memo_form.php?me_recv_mb_id="+mb_id+"');\" class='win_memo'>쪽지보내기</a></li>";
            first = '';
        }

        // 메일보내기
        if(email) {
            html += "<li"+first+"><a href=\"javascript:win_email('"+g4_bbs_path+"/formmail.php?email="+email+"');\" class='win_email'>메일보내기</a></li>";
            first = '';
        }

        // 홈페이지
        if(homepage) {
            html += "<li"+first+"><a href=\"javascript:win_homepage('"+homepage+"');\" class='win_homepage'>홈페이지</a></li>";
            first = '';
        }

        // 자기소개
        if(mb_id) {
            html += "<li"+first+"><a href=\"javascript:win_profile('"+g4_bbs_path+"/profile.php?mb_id="+mb_id+"');\" class='win_profile'>자기소개</a></li>";
            first = '';
        }

        // 아이디로 검색, 이름으로 검색
        if(g4_bo_table) {
            if(mb_id) {
                html += "<li"+first+"><a href=\""+g4_bbs_path+"/board.php?bo_table="+g4_bo_table+"&sca="+g4_sca+"&sfl=mb_id,1&stx="+mb_id+"\">아이디로 검색</a></li>";
            }

            html += "<li"+first+"><a href=\""+g4_bbs_path+"/board.php?bo_table="+g4_bo_table+"&sca="+g4_sca+"&sfl=wr_name,1&stx="+encodeURIComponent(name)+"\">이름으로 검색</a></li>";
            first = '';
        }

        // 전체게시물
        if(mb_id) {
            html += "<li"+first+"><a href=\""+g4_bbs_path+"/new.php?mb_id="+mb_id+"\">전체게시물</a></li>";
            first = '';
        }

        // 최고관리자일 경우
        if(g4_is_admin == 'super') {

            if(mb_id) {
                // 회원정보변경
                html += "<li"+first+"><a href=\""+g4_path+"/" + g4_admin + "/member_form.php?w=u&mb_id="+mb_id+"\">회원정보변경</a></li>";
                // 포인트내역
                html += "<li"+first+"><a href=\""+g4_path+"/" + g4_admin + "/point_list.php?sfl=mb_id&stx="+mb_id+"\">포인트내역</a></li>";
                first = "";
            }
        }

        if(html) {
            html = '<div class="sideview"><ul>' + html + '</ul></div>';
            $('#sidebox').html(html).show('fast');
        }
    });

    // 배경색상 변경
    $('.board_list tbody tr:odd,  .table_list tbody tr:odd' ).addClass('list_odd');
    $('.board_list tbody tr:even, .table_list tbody tr:even').addClass('list_even');
    $('.board_list tbody tr, .table_list tbody tr').toggleClass('mouse_over');
    //==========================================================================

    // @FIXME 자동완성 기능을 왜 죄다 꺼버리는가?
    $('form').each(function(i) {
        $(this).attr('autocomplete', 'off');
    });
});
