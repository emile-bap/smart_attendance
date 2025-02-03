$('document').ready(function() {
    $('#province_id').change(function(){
        var province_id = $(this).val();
        $("#district > option").remove();
        $.ajax({
            type: "POST",
            url: "address_data.php",
            data: "province_id=" + province_id,
            success:function(opt){
                $('#district_id').html(opt);
                $('#sector_id').html('<option value="0">Select sector</option>');
            }
        });
    });
	

    $('#district_id').change(function(){
        var district_id = $(this).val();
        $("#sector_id > option").remove();
        $.ajax({
            type: "POST",
            url: "address_data.php",
            data: "district_id=" + district_id,
            success:function(opt){
                $('#sector_id').html(opt);
            }
        });
    });
	
	

    $('#sector_id').change(function(){
        var sector_id = $(this).val();
        $("#cell_id > option").remove();
        $.ajax({
            type: "POST",
            url: "address_data.php",
            data: "sector_id=" + sector_id,
            success:function(opt){
                $('#cell_id').html(opt);
            }
        });
    });
	

	
	
	
});