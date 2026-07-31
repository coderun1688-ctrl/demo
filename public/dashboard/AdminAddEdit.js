var filter = /^[a-z0-9][a-z0-9-_\.]+@([a-z]|[a-z0-9]?[a-z0-9-]+[a-z0-9])\.[a-z0-9]{2,10}(?:\.[a-z]{2,10})?$/;

function checkPassword(password) {
    // 規則說明：
    // (?=.*[A-Z])   至少包含 1 個大寫英文字母
    // (?=.*[a-z])   至少包含 1 個小寫英文字母
    // (?=.*\d)      至少包含 1 個數字
    // (?=.*[@$!%*?&#]) 至少包含 1 個特殊符號（可依需求增減）
    // .{6,}         長度至少 6 碼以上
    //const regex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{6,}$/;
    const regex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)[A-Za-z\d@$!%*?&#]{6,}$/;
    return regex.test(password);
}

function SendEditClick(){

    var msg = 0;
    if($("[name='username']").val().length < 1){
        $("[name='username']").addClass("is-invalid");
        msg+=1;
    }

    if($("[name='email']").val().length < 1){
        $("[name='email']").addClass("is-invalid");
        msg+=1;
    }

    if (!filter.test($("[name='email']").val())) {
        $("[name='email']").addClass("is-invalid");
        msg+=1;
    }

    if($("[name='password']").val().length >0){

            if(!checkPassword($("[name='password']").val())){
                $("[name='password']").addClass("is-invalid");
                msg+=1;
            }
    }
    if(msg > 0){
        return false;
    }

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


        //console.log(formData);


    });

    $.ajax({
        type: "POST",
        url: '/dashboards/AdminList/UploadEditData',
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
                    content: "編輯完成",
                    typeAnimated: true,
                    autoClose: 'close|1000',
                    buttons: {
                        close: {
                            text: '關閉',
                            btnClass: 'btn-blue',
                            action: function () {
                                window.location = '/dashboards/AdminList/?page='+$("[name='page']").val();
                            }
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

function SendAddClick(){

    var msg = 0;
    if($("[name='username']").val().length < 1){
        $("[name='username']").addClass("is-invalid");
        msg+=1;
    }

    if($("[name='email']").val().length < 1){
        $("[name='email']").addClass("is-invalid");
        msg+=1;
    }

    if (!filter.test($("[name='email']").val())) {
        $("[name='email']").addClass("is-invalid");
        msg+=1;
    }


    if($("[name='password']").val().length < 1){
        $("[name='password']").addClass("is-invalid");
        msg+=1;
    }

    if(!checkPassword($("[name='password']").val())){
        $("[name='password']").addClass("is-invalid");
        msg+=1;
    }


    if(msg > 0){
        return false;
    }

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
        //console.log(formData);
    });

    $.ajax({
        type: "POST",
        url: '/dashboards/AdminList/UploadAddData',
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
                        content: "新增完成",
                        typeAnimated: true,
                        autoClose: 'close|1000',
                        buttons: {
                            close: {
                                text: '關閉',
                                btnClass: 'btn-blue',
                                action: function () {
                                    window.location = '/dashboards/AdminList';
                                }
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

    $("[name='username']").click( function () {
        $("[name='username']").removeClass("is-invalid");
    });

    $("[name='email']").click( function () {
        $("[name='email']").removeClass("is-invalid");
    });

    $("[name='password']").click( function () {
        $("[name='password']").removeClass("is-invalid");
    });


    //checkbox 變更單選
    $("input[name='groups']").click( function () {
            $("input[name='groups']").each(function(){
                $(this).prop("checked", false);
            });

            $(this).prop("checked", true);
    });

    if($("input[name='groups']:checked").length < 1){
        $("input[name='groups']").eq(0).prop("checked", true);
    }


});