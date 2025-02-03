<script src= "js/moment-2.2.1.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<!--Dynamic selector, Like PROVINCE, DISTRICT, SECTOR, CELL, VILLAGE,... -->
<script src="js/script.js" type="text/javascript"></script>
<script src="js/script_2.js" type="text/javascript"></script>
<!--Dynamic selector, of department and class,... -->
<script src="js/script_faculty.js" type="text/javascript"></script>

<script>
var blink = document.getElementById('blink');
setInterval(function() 
{
blink.style.opacity = (blink.style.opacity == 0 ? 1 : 0);
}, 1000); 
</script>

<script type="text/javascript">
$(document).ready(function()
{
$('.search-box input[type="text"]').on("keyup input", function(){
/* Get input value on change */
var inputVal = $(this).val();
var resultDropdown = $(this).siblings(".result");
if(inputVal.length){
$.get("search_student_now.php", {student: inputVal}).done(function(data){
// Display the returned data in browser
resultDropdown.html(data);
});
} else{
resultDropdown.empty();
}
});

// Set search input value on click of result item
$(document).on("click", ".result p", function(){
$(this).parents(".search-box").find('input[type="text"]').val($(this).text());
$(this).parent(".result").empty();
});
});
</script>