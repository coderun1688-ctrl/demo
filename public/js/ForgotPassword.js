


function SendClick() {


    $("[name='Send']").prop("disabled", true).html('<span class="spinner-border spinner-border-sm" aria-hidden="true"></span> <span role="status">認證中...</span>');


    var formData = new FormData();
    formData.append('action', 'Login');
    $("#myForm input, #myForm select,#myForm textarea").each(function () {
        if (this.type == 'checkbox' && !this.checked) {
            return;
        } else if (this.type == 'radio' && !this.checked) {
            return;
        } else {
            formData.append($(this).attr('name'), $(this).val());
        }
        //console.log(formData);
    });



    $.ajax({
        type: "POST",
        url: '/ForgotPassword/Update',
        data: formData,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (response, textStatus, jqXHR) {
            $("[name='Send']").prop("disabled", false).html('登入');
            if (response.status) {

                $.alert({
                    //boxWidth: '20%',
                    closeIcon: false,
                    title: '訊息',
                    //useBootstrap:false,
                    type: 'green', //blue, green, red, orange, purple & dark'
                    draggable: false,
                    dragWindowBorder: false,
                    content: "您的 E-mail 已寄送",
                    typeAnimated: true,
                    buttons: {
                        close: {
                            text: '關閉',
                            btnClass: 'btn-red',
                        },

                    }
                });

            } else {


                $.alert({
                    //boxWidth: '20%',
                    closeIcon: false,
                    title: '訊息',
                    useBootstrap:false,
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
            //console.log("成功：", response.message);
        }, error: function (jqXHR, textStatus, errorThrown) {
            $("[name='Send']").prop("disabled", false).html('登入');
            console.error('Status Code:', jqXHR.status);
            console.error('Status Text:', jqXHR.statusText);
            console.error('Error Type: ', textStatus);
            console.error('Exception:  ', errorThrown);
        }
    });

}
