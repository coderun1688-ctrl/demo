var SizeLimit = 1;  //上傳上限MB單位
var filetype= ['image/jpeg','image/png','image/gif','image/webp'];

function SendClick(){
    $("[name='Send']").prop("disabled", true).html('<span class="spinner-border spinner-border-sm" aria-hidden="true"></span> <span role="status">送出中...</span>');

    var formData = new FormData();

    $("#myForm input, #myForm select,#myForm textarea").each(function () {
        if (this.type == 'checkbox' && !this.checked) {
            return;
        } else if (this.type == 'radio' && !this.checked) {
            return;
        } else if(this.type == "file" && this.value.length>0){
            formData.append($(this).attr('name'), $(this)[0].files[0]);
        } else {
            formData.append($(this).attr('name'), $(this).val());
        }

    });


    //return false;

    $.ajax({
        type: "POST",
        url: '/dashboards/SystemSteeing/UploadData',
        data: formData,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (response, textStatus, jqXHR) {

            $("[name='Send']").prop("disabled", false).html('送出');

            if (response.status) {

                $.alert({
                    //boxWidth: '20%',
                    closeIcon: false,
                    title: '訊息',
                    //useBootstrap:false,
                    type: 'green', //blue, green, red, orange, purple & dark'
                    draggable: false,
                    dragWindowBorder: false,
                    content: "更改完成",
                    typeAnimated: true,
                    autoClose: 'close|1000',
                    buttons: {
                        close: {
                            text: '關閉',
                            btnClass: 'btn-blue',
                        },

                    }
                });



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
            }
            //console.log("成功：", response.message);
        }, error: function (jqXHR, textStatus, errorThrown) {
            $("[name='Send']").prop("disabled", false).html('送出');
            console.error('Status Code:', jqXHR.status);
            console.error('Status Text:', jqXHR.statusText);
            console.error('Error Type: ', textStatus);
            console.error('Exception:  ', errorThrown);
        }
    });



}





$(document).ready(function () {



    //checkbox 變更單選
    $("input[name='Steeing[CheckDefault]']").click( function () {
        $("input[name='Steeing[CheckDefault]']").each(function(){
            $(this).prop("checked", false);
        });

        $(this).prop("checked", true);
    });

    if($("input[name='Steeing[CheckDefault]']:checked").length < 1){
        $("input[name='Steeing[CheckDefault]']").eq(0).prop("checked", true);
    }

    $("input[name='WebLogoFile']").filestyle({
        'text' : '瀏覽選擇...',
        'input' :false,
        'htmlIcon' : '',
        'badge' :false,
        'btnClass' : 'btn-primary',
    });


    $("input[name='WebLogoFile']").change(function() {
        var file = this.files[0];
        // name = file.name; //name=檔案名稱
        // size = file.size; //size=檔案大小
        // type = file.type; //type=檔案型態

        //console.log($.inArray(file.type, filetype));

        if($.inArray(file.type, filetype) == -1){
            $.alert({
                //boxWidth: '20%',
                closeIcon: false,
                title: '訊息',
                //useBootstrap:false,
                type: 'red', //blue, green, red, orange, purple & dark'
                draggable: false,
                dragWindowBorder: false,
                content: "上傳格式不府和 jpg jpeg  png webp gif 格式",
                typeAnimated: true,
                autoClose: 'close|1000',
                buttons: {
                    close: {
                        text: '關閉',
                        btnClass: 'btn-red',
                    },

                }
            });
            $(this).replaceWith($(this).val('').clone(true));
            $(":file").filestyle('clear');
            return false;
        } else if (file.size > (SizeLimit * 1024 * 1024)) {
            $.alert({
                //boxWidth: '20%',
                closeIcon: false,
                title: '訊息',
                //useBootstrap:false,
                type: 'red', //blue, green, red, orange, purple & dark'
                draggable: false,
                dragWindowBorder: false,
                content: "單檔已超過上傳上限 "+(SizeLimit * 1024 * 1024) + " MB大小\n不允許上傳！",
                typeAnimated: true,
                autoClose: 'close|1000',
                buttons: {
                    close: {
                        text: '關閉',
                        btnClass: 'btn-red',
                    },

                }
            });
            $(this).replaceWith($(this).val('').clone(true));
            $(":file").filestyle('clear');
            return false;
        } else {

            var reader = new FileReader();
            // 當檔案讀取完成時觸發
            reader.onload = function(e) {
                $('#imagePreview').attr('src', e.target.result);
                $(this).replaceWith($(this).val('').clone(true));
                $(":file").filestyle('clear');
            }

            // 讀取檔案內容
            reader.readAsDataURL(file);
        }



    });

});







