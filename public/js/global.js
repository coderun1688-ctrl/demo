
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
                            url: '/logout',
                            data: formData,
                            contentType: false,
                            processData: false,
                            dataType: "json",
                            success: function (response, textStatus, jqXHR) {

                                if (response.status) {
                                    window.location = '/';
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



$(document).ready(function () {
    

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

});