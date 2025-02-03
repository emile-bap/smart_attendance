$('document').ready(function() {
    $('#trade_id').change(function(){
        var trade_id = $(this).val();
        $("#district > option").remove();
        $.ajax({
            type: "POST",
            url: "fetch_trade_class.php",
            data: "trade_id=" + trade_id,
            success:function(opt){
                $('#class_id').html(opt);
            }
        });
    });
});