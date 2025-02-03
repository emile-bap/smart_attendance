<style media=print> 
.Noprint{display:none; border-radius:10px; border-style:none;}   
</style>
<style>
.now-left{ left:0; bottom:0; margin-bottom:2%; position:fixed; float:left;}
.now-right{ right:0; bottom:0; margin-bottom:2%; position:fixed; float:right;}
.now-bck{ right:0; top:0; margin:2% 2% 2% 2%; position:fixed; float:right; background-color:#006699; color:#fff; padding:1% 3% 1% 3%; border-radius:100px;}
</style>

<button onclick="goBack()" style="float:left; border:none; color:#fff; background-color:#005292; padding:1%; border-radius:5px;" class='Noprint now-left'>Go Back</button>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>

<i class='Noprint now-right'  type='button' onclick='window.print()'>
<img src='images/images/printer.gif' width="auto" height="80px" title="<?= date('l d/m/Y h:i:s A')?>">
</i>

<!-- <i class='Noprint now-bck'  type='button' onclick='goBack()'>Back</i> -->
