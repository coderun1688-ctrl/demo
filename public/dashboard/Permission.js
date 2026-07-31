
function SendAddclick(){

    id++;
    $(".ResponsiveTable tbody").append('\
            <tr id="tr'+id+'">\
                <td data-label="序號" style="vertical-align: middle;">'+id+'</td>\
                <td data-label="名稱" style="vertical-align: middle;">\
                        <input type="text" class="form-control" name="setting['+id+'][levelname]" value="" placeholder="請輸入名稱">\
                </td>\
                <td data-label="權限" style="vertical-align: middle;">\
                    ---\
                </td>\
                <td data-label="操作" style="vertical-align: middle;">\
                    <button type="button" class="btn btn-danger" onclick="DeleteHtmlClick(\''  + id + '\')">刪除</button>\
                </td>\
        </tr>\
    ');



}

function DeleteHtmlClick(i){

    $("#tr"+i).remove();

}

function DeleteClick(id){
    var a = $.confirm({
        closeIcon: false,
        title: '訊息',
        content: "您確定要刪除嗎？",
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

                    var formData = new FormData();
                    formData.append('id',id);


                    $.ajax({
                        type: "POST",
                        url: '/dashboards/Permission/DeleteData',
                        data: formData,
                        contentType: false,
                        processData: false,
                        dataType: "json",
                        success: function (response, textStatus, jqXHR) {

                            if (response.status) {

                                $.alert({
                                    //boxWidth: '20%',
                                    closeIcon: false,
                                    title: '訊息',
                                    //useBootstrap:false,
                                    type: 'green', //blue, green, red, orange, purple & dark'
                                    draggable: false,
                                    dragWindowBorder: false,
                                    content: "刪除完成",
                                    typeAnimated: true,
                                    autoClose: 'close|1000',
                                    buttons: {
                                        close: {
                                            text: '關閉',
                                            btnClass: 'btn-blue',
                                        },

                                    }
                                });
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
        url: '/dashboards/Permission/UploadData',
        data: formData,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (response, textStatus, jqXHR) {

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
                                window.location.reload();
                            }
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


