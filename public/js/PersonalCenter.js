var filter = /^[a-z0-9][a-z0-9-_\.]+@([a-z]|[a-z0-9]?[a-z0-9-]+[a-z0-9])\.[a-z0-9]{2,10}(?:\.[a-z]{2,10})?$/;
var pattern = /^[^<>!@#$%^&*()+=\[\]{};:'"\\|,.<>\/?]+$/;
function usernameonClick(){
    $("[name='username']").removeClass("form-control-plaintext").addClass("form-control").data('username', $("[name='username']").val());
    $("[name='usernameonSuccess']").removeClass("d-none");
    $("[name='usernameonClick']").html("取消").attr('onclick', 'usernameonCloseClick()');
}


function usernameonCloseClick(){
    $("[name='username']").removeClass("form-control").addClass("form-control-plaintext").val($("[name='username']").data('username'));
    $("[name='usernameonSuccess']").addClass("d-none");
    $("[name='usernameonClick']").html("修改").attr('onclick', 'usernameonClick()');
}


function usernameSendonClick(){

    if($.trim($("[name='username']").val()).replace(/<[^>]+>/g, '').length < 1){

        $.alert({
            //boxWidth: '20%',
            closeIcon: false,
            title: '訊息',
            //useBootstrap:false,
            type: 'red', //blue, green, red, orange, purple & dark'
            draggable: false,
            dragWindowBorder: false,
            content: "未輸入您要修改匿名名稱？",
            typeAnimated: true,
            buttons: {
                close: {
                    text: '關閉',
                    btnClass: 'btn-red',
                },

            }
        });

        return false;
    }


    if (!pattern.test($.trim($("[name='username']").val()).replace(/<[^>]+>/g, ''))) {
        $.alert({
            //boxWidth: '20%',
            closeIcon: false,
            title: '訊息',
            //useBootstrap:false,
            type: 'red', //blue, green, red, orange, purple & dark'
            draggable: false,
            dragWindowBorder: false,
            content: "修改匿名名稱不能包含非法字元？",
            typeAnimated: true,
            buttons: {
                close: {
                    text: '關閉',
                    btnClass: 'btn-red',
                },

            }
        });

        return false;
    }

    $("[name='usernameonSuccess']").prop("disabled", true);
    $("[name='usernameonClick']").prop("disabled", true);

    var formData = new FormData();
    formData.append('username', $.trim($("[name='username']").val()).replace(/<[^>]+>/g, ''));


    $.ajax({
        type: "POST",
        url: '/PersonalCenter/UpdateName',
        data: formData,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (response, textStatus, jqXHR) {

            $("[name='usernameonSuccess']").prop("disabled", false);
            $("[name='usernameonClick']").prop("disabled", false);

            if (response.status) {

                $.alert({
                    //boxWidth: '20%',
                    closeIcon: false,
                    title: '訊息',
                    //useBootstrap:false,
                    type: 'green', //blue, green, red, orange, purple & dark'
                    draggable: false,
                    dragWindowBorder: false,
                    content: "匿名名稱修改完成",
                    typeAnimated: true,
                    buttons: {
                        close: {
                            text: '關閉',
                            btnClass: 'btn-red',
                        },

                    }
                });

                $("[name='username']").removeClass("form-control").addClass("form-control-plaintext").data('username', $.trim($("[name='username']").val()).replace(/<[^>]+>/g, ''));
                $("[name='usernameonSuccess']").addClass("d-none");
                $("[name='usernameonClick']").html("修改").attr('onclick', 'usernameonClick()');

            } else {


                $.alert({
                    //boxWidth: '20%',
                    closeIcon: false,
                    title: '訊息',
                    //useBootstrap:false,
                    type: 'red', //blue, green, red, orange, purple & dark'
                    draggable: false,
                    dragWindowBorder: false,
                    content: response.message,
                    typeAnimated: true,
                    buttons: {
                        close: {
                            text: '關閉',
                            btnClass: 'btn-red',
                        },

                    }
                });


                $("[name='username']").removeClass("form-control").addClass("form-control-plaintext").val($("[name='username']").data('username'));
                $("[name='usernameonSuccess']").addClass("d-none");
                $("[name='usernameonClick']").html("修改").attr('onclick', 'usernameonClick()');
            }
            //console.log("成功：", response.message);
        }, error: function (jqXHR, textStatus, errorThrown) {

            console.error('Status Code:', jqXHR.status);
            console.error('Status Text:', jqXHR.statusText);
            console.error('Error Type: ', textStatus);
            console.error('Exception:  ', errorThrown);
        }
    });

}


function emailonClick(){
    $("[name='email']").removeClass("form-control-plaintext").addClass("form-control").data('email', $("[name='email']").val());
    $("[name='emailonSuccess']").removeClass("d-none");
    $("[name='emailonClick']").html("取消").attr('onclick', 'emailonCloseClick()');
}


function emailonCloseClick(){
    $("[name='email']").removeClass("form-control").addClass("form-control-plaintext").val($("[name='email']").data('email'));
    $("[name='emailonSuccess']").addClass("d-none");
    $("[name='emailonClick']").html("修改").attr('onclick', 'emailonClick()');
}


function emailSendonClick(){

    if($.trim($("[name='email']").val()).replace(/<[^>]+>/g, '').length < 1){

        $.alert({
            //boxWidth: '20%',
            closeIcon: false,
            title: '訊息',
            //useBootstrap:false,
            type: 'red', //blue, green, red, orange, purple & dark'
            draggable: false,
            dragWindowBorder: false,
            content: "未輸入您要修改E-mail？",
            typeAnimated: true,
            buttons: {
                close: {
                    text: '關閉',
                    btnClass: 'btn-red',
                },

            }
        });

        return false;
    }

    if (!filter.test($.trim($("[name='email']").val()).replace(/<[^>]+>/g, ''))) {
        $.alert({
            //boxWidth: '20%',
            closeIcon: false,
            title: '訊息',
            //useBootstrap:false,
            type: 'red', //blue, green, red, orange, purple & dark'
            draggable: false,
            dragWindowBorder: false,
            content: "修改E-mail不府合標準格式？",
            typeAnimated: true,
            buttons: {
                close: {
                    text: '關閉',
                    btnClass: 'btn-red',
                },

            }
        });

        return false;
    }

    $("[name='emailonSuccess']").prop("disabled", true);
    $("[name='emailonClick']").prop("disabled", true);

    var formData = new FormData();
    formData.append('email', $.trim($("[name='email']").val()).replace(/<[^>]+>/g, ''));


    $.ajax({
        type: "POST",
        url: '/PersonalCenter/Updateemail',
        data: formData,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (response, textStatus, jqXHR) {

            $("[name='emailonSuccess']").prop("disabled", false);
            $("[name='emailonClick']").prop("disabled", false);

            if (response.status) {

                        $.alert({
                            //boxWidth: '20%',
                            closeIcon: false,
                            title: '訊息',
                            //useBootstrap:false,
                            type: 'green', //blue, green, red, orange, purple & dark'
                            draggable: false,
                            dragWindowBorder: false,
                            content: "驗證信已經發信到您 E-mail 信箱",
                            typeAnimated: true,
                            buttons: {
                                close: {
                                    text: '關閉',
                                    btnClass: 'btn-red',
                                },

                            }
                        });





                        $("[name='email']").removeClass("form-control").addClass("form-control-plaintext").data($.trim($("[name='email']").val()).replace(/<[^>]+>/g, ''));
                        $("[name='emailonSuccess']").addClass("d-none");
                        $("[name='emailonClick']").html("修改").attr('onclick', 'emailonClick()');


            } else {


                $.alert({
                    //boxWidth: '20%',
                    closeIcon: false,
                    title: '訊息',
                    //useBootstrap:false,
                    type: 'red', //blue, green, red, orange, purple & dark'
                    draggable: false,
                    dragWindowBorder: false,
                    content: response.message,
                    typeAnimated: true,
                    buttons: {
                        close: {
                            text: '關閉',
                            btnClass: 'btn-red',
                        },

                    }
                });


                $("[name='email']").removeClass("form-control").addClass("form-control-plaintext").val($("[name='email']").data('email'));
                $("[name='emailonSuccess']").addClass("d-none");
                $("[name='emailonClick']").html("修改").attr('onclick', 'emailonClick()');

            }
            //console.log("成功：", response.message);
        }, error: function (jqXHR, textStatus, errorThrown) {

            console.error('Status Code:', jqXHR.status);
            console.error('Status Text:', jqXHR.statusText);
            console.error('Error Type: ', textStatus);
            console.error('Exception:  ', errorThrown);
        }
    });

}