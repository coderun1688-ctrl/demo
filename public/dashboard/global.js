var navbarreloadurl = "";
var tabs = [
];



function  MenuOnclick(id){



    $("#myTab li a").removeClass("active");
    $("#myTab li").removeClass("active");
    $("#"+id).addClass("active");

    $('Iframe').hide();
    $("[name='iframe"+id+"']").show();

    navbarreloadurl = $('iframe:visible').attr('src');

}


function activate() {

    $('.tabs-inside-here').scrollingTabs({
        tabs: tabs, // required,
        propPaneId: 'paneId', // optional - pass in default value for demo purposes
        propTitle: 'title', // optional - pass in default value for demo purposes
        propActive: 'active', // optional - pass in default value for demo purposes
        propDisabled: 'disabled', // optional - pass in default value for demo purposes
        propContent: 'content',
        scrollToTabEdge: true, // optional - pass in default value for demo purposes
        disableScrollArrowsOnFullyScrolled: false, // optional- pass in default value for demo purposes
        enableRtlSupport: true,
        enableSwiping: true,

        leftArrowContent: [
            '<div class="scrtabs-tab-scroll-arrow scrtabs-tab-scroll-arrow-left">',
            '  <span>',
            '    <i class="fa-utility fa-semibold fa-angle-left" style="color: rgb(128, 128, 128);"></i>',
            '  </span>',
            '</div>'
        ].join(''),
        rightArrowContent: [
            '<div class="scrtabs-tab-scroll-arrow scrtabs-tab-scroll-arrow-right" >',
            '  <span>',
            '  <i class="fa-utility fa-semibold fa-angle-right" style="color: rgb(128, 128, 128);"></i>',
            '  </span>',
            '</div>'
        ].join('')
    });

}


function removeTab(id) {


    $.each(tabs,function(index, element) {
        if (element.paneId == id) {
            tabs.splice(index, 1);
        }
    });

    console.log(id);

    $("#myTab #"+id).remove();

    $("#myTab li a").removeClass("active");

    $("[name='iframe"+id+"']").remove();


    $("#"+tabs[tabs.length-1].paneId).addClass("active");

    $('Iframe').hide();

    $("[name='iframe"+tabs[tabs.length-1].paneId+"']").show();


    //console.log("remove tab ", tabs[tabs.length-1].paneId);

    //$('.tabs-inside-here').scrollingTabs('refresh');
}



function addTab(id,name) {

    if($("#"+id).length < 1){


                var newTab = {
                        paneId: id,
                        title: name,
                        active: true,
                };

                tabs.some(function (tab) {
                    if (tab.active) {
                        tab.active = false;
                        return true; // exit loop
                    }
                });
                tabs.push(newTab);





                $(".margintop").append('<iframe width="100%" scrolling="auto"  frameborder="0" name="iframe'+id+'" src="/dashboards/'+id+'" noresize="false"></iframe>');

                $('Iframe').css('height',      $(window).height() - 85 + 'px');

                $('Iframe').hide();

                $("[name='iframe"+id+"']").show();

                $(".tabs-inside-here").html('');

                activate();

                $("#aMain").remove();


                $(".nav-item").removeClass("submenu");
                /*
                $('.tabs-inside-here').scrollingTabs('refresh', {
                    forceActiveTab: true ,
                });*/
    }  else {

                MenuOnclick(id);
        $(".nav-item").removeClass("submenu");
    }




    //console.log($("[name='iframe"+id+"']").length);
}





function Logout(){

        var a = $.confirm({
            closeIcon: false,
            title: '訊息',
            content: "您確定要登出？",
            typeAnimated: true,
            draggable: false,
            dragWindowBorder: false,
            type: 'orange', //blue, green, red, orange, purple & dark'
            columnClass: 'small',
            buttons: {
                Okay:{
                    text: '確定',
                    btnClass: 'btn-blue',
                    action: function(){

                        this.buttons.Okay.disable();
                        this.buttons.cancel.disable();
                        //this.buttons.Okay.enable();
                        //this.buttons.Okay.setText('');

                        $.dialog({
                            closeIcon: false,
                            title: '訊息',
                            columnClass: 'small',
                            content: '<span class="spinner-border spinner-border-sm" aria-hidden="true"></span> <span role="status">登出中...</span>',
                        });

                        var formData = new FormData();
                        formData.append("Checksum","89f37066d4c35e04431160d607fb2b46");

                        window.setTimeout(function () {

                                $.ajax({
                                    type: "POST",
                                    url: '/dashboards/logout',
                                    data: formData,
                                    contentType: false,
                                    processData: false,
                                    dataType: "json",
                                    success: function (response, textStatus, jqXHR) {

                                        if (response.status) {
                                                    window.location = '/dashboards/login';
                                        } else {
                                                    $.alert({
                                                        //boxWidth: '20%',
                                                        closeIcon: false,
                                                        title: '訊息',
                                                        useBootstrap:false,
                                                        type: 'red', //blue, green, red, orange, purple & dark'
                                                        draggable: false,
                                                        dragWindowBorder: false,
                                                        content: response,
                                                        typeAnimated: true,
                                                        buttons: {
                                                            close: {
                                                                text: '關閉',
                                                                btnClass: 'btn-red',
                                                            },

                                                        }
                                                    });
                                        }
                                        //console.log("成功：", response.message);
                                    }, error: function (jqXHR, textStatus, errorThrown) {
                                        console.error('Status Code:', jqXHR.status);
                                        console.error('Status Text:', jqXHR.statusText);
                                        console.error('Error Type: ', textStatus);
                                        console.error('Exception:  ', errorThrown);
                                    }
                                });

                        }, 1000);

                    }
                }, cancel: {
                    text: '關閉',
                    btnClass: 'btn-red',
                    action: function(){
                        a.close();
                    }
                }
            }
        });

}


function navbarreload(){

    //console.log( $('iframe:visible').attr('name'));
    //console.log(navbarreloadurl );
    $("[name='"+ $('iframe:visible').attr('name') +"']").attr('src', navbarreloadurl);
}



$(document).ready(function () {

    $(window).resize(function() {
        $('Iframe').css('height',      $(window).height() - 85 + 'px');
    });
    $('Iframe').css('height',      $(window).height() - 85 + 'px');


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    addTab('Main','後端首頁');
    //addTab('/dashboards/adminmanag', '管理員');


    window.setTimeout(function (){
            $("#aMain").remove();
    },100);
});