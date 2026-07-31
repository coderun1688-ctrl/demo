

function DeleteList(id){

    var a = $.confirm({
        closeIcon: false,
        draggable: false,
        dragWindowBorder: false,
        title: '提醒',
        content: '您確定要刪除嗎？',
        type: 'orange',
        buttons: {
            Okay: {
                text: '確定',
                btnClass: 'btn-blue',
                action: function(){
                    this.buttons.Okay.disable();
                    this.buttons.cancel.disable();
                    a.close();

                    var formData = new FormData();
                    formData.append("id",id);

                    $.ajax({
                        type: "POST",
                        url: '/dashboards/SuperAdmin/DeleteData',
                        data: formData,
                        contentType: false,
                        processData: false,
                        dataType: "json",
                        success: function (response, textStatus, jqXHR) {

                            if (response.status) {

                                    $("#tr"+id).remove();
                                    
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





function Sendclick(){

    if($.trim($("[name='adminusername']").val()).length < 1){

        $.alert({
            //boxWidth: '20%',
            closeIcon: false,
            title: '訊息',
            //useBootstrap:false,
            type: 'red', //blue, green, red, orange, purple & dark'
            draggable: false,
            dragWindowBorder: false,
            content: "未輸入管理員帳號？",
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

    $("[name='Sendclick']").prop("disabled", true).html('<span class="spinner-border spinner-border-sm" aria-hidden="true"></span> <span role="status">驗證中...</span>');

    var formData = new FormData();
    formData.append('adminusername', $.trim($("[name='adminusername']").val()));

    $.ajax({
        type: "POST",
        url: '/dashboards/SuperAdmin/AddData',
        data: formData,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (response, textStatus, jqXHR) {

            if (response.status) {

                $("[name='Sendclick']").prop("disabled", false).html('新增');

                window.location.reload();

            } else {

                $("[name='Sendclick']").prop("disabled", false).html('新增');

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

            }

        }, error: function (jqXHR, textStatus, errorThrown) {
            $("[name='Sendclick']").prop("disabled", false).html('新增');
            console.error('Status Code:', jqXHR.status);
            console.error('Status Text:', jqXHR.statusText);
            console.error('Error Type: ', textStatus);
            console.error('Exception:  ', errorThrown);
        }
    });
}