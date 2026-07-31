

</div>
@error('item')
<script type="text/javascript">
    $.alert({
        //boxWidth: '20%',
        closeIcon: false,
        title: '訊息',
        //useBootstrap:false,
        type: 'red', //blue, green, red, orange, purple & dark'
        draggable: false,
        dragWindowBorder: false,
        content: '{{ $message }}',
        typeAnimated: true,
        autoClose: 'close|1000',
        buttons: {
            close: {
                text: '關閉',
                btnClass: 'btn-red',
            },

        }
    });
</script>
@enderror
<script type="text/javascript" src="/dashboard/globalpage.js?v=@php echo time();@endphp"></script>
</body>
</html>