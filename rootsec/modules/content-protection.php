<?php
//Content Protection
$table = $prefix . 'content-protection';
$query = mysqli_query($connect, "SELECT * FROM `$table`");

if ($srow['jquery_include'] == "Yes") {
    echo '<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>';
}

while ($row = mysqli_fetch_assoc($query)) {
    
    //Disable View Source Code
    if ($row['function'] == 'view_source' && $row['enabled'] == 'Yes') {
        echo '
<!--


















                                                                   The source code of this webpage cannot be viewed or copied, because it is not allowed. 






























































































































































































































































-->
';
    }
    
    //Disable Right Click (Context Menu)
    if ($row['function'] == 'rightclick' && $row['enabled'] == 'Yes') {
        echo '
<script language="javascript">
$(document).ready(function(){
      $(document).bind("contextmenu",function(e) {
		  ';
        if ($row['alert'] == 'Yes')
            echo 'alert(\'' . $row['message'] . '\');';
        echo '
          e.preventDefault();
      });
});
</script>
';
    }
    
    //Disable Right Click on Images
    if ($row['function'] == 'rightclick_images' && $row['enabled'] == 'Yes') {
        echo '
<script language="javascript">
$(function(){
$(\'img\').bind(\'contextmenu\', function(e){
';
        if ($row['alert'] == 'Yes')
            echo 'alert(\'' . $row['message'] . '\');';
        echo '
return false;
}); 
});
</script>
';
    }
    
    //Disable Cut
    if ($row['function'] == 'cut' && $row['enabled'] == 'Yes') {
        echo '
<script language="javascript">
$(document).ready(function(){
      $(document).bind("cut",function(e) {
		  ';
        if ($row['alert'] == 'Yes')
            echo 'alert(\'' . $row['message'] . '\');';
        echo '
          e.preventDefault();
      });
});
</script>
';
    }
    
    //Disable Copy
    if ($row['function'] == 'copy' && $row['enabled'] == 'Yes') {
        echo '
<script language="javascript">
$(document).ready(function(){
      $(document).bind("copy",function(e) {
		  ';
        if ($row['alert'] == 'Yes')
            echo 'alert(\'' . $row['message'] . '\');';
        echo '
          e.preventDefault();
      });
});
</script>
';
    }
    
    //Disable Paste
    if ($row['function'] == 'paste' && $row['enabled'] == 'Yes') {
        echo '
<script language="javascript">
$(document).ready(function(){
      $(document).bind("paste",function(e) {
		  ';
        if ($row['alert'] == 'Yes')
            echo 'alert(\'' . $row['message'] . '\');';
        echo '
          e.preventDefault();
      });
});
</script>
';
    }
    
    //Disable Drag
    if ($row['function'] == 'drag' && $row['enabled'] == 'Yes') {
        echo '
<script language="javascript">
$(document).ready(function(){
      $(document).bind("drag",function(e) {
          e.preventDefault();
      });
});
</script>
';
    }
    
    //Disable Drop
    if ($row['function'] == 'drop' && $row['enabled'] == 'Yes') {
        echo '
<script language="javascript">
$(document).ready(function(){
      $(document).bind("drop",function(e) {
          e.preventDefault();
      });
});
</script>
';
    }
    
    //Disable PrintScreen
    if ($row['function'] == 'printscreen' && $row['enabled'] == 'Yes') {
        echo '
<script language="javascript">
$(document).keyup(function (e) {
    if(!e) e = window.event;
    var keyCode = e.which || e.keyCode
    if (keyCode  == 44) {
        ';
        if ($row['alert'] == 'Yes')
            echo 'alert(\'' . $row['message'] . '\');';
        echo '
        ccd();
    }
});
</script>
';
    }
    
    //Disable Printing
    if ($row['function'] == 'print' && $row['enabled'] == 'Yes') {
        echo '
<style type="text/css" media="print">
    /* Disable Printing */
    * { display: none; }
</style>
<script language="javascript">
jQuery(document).bind("keyup keydown", function(e){
    if(e.ctrlKey && e.keyCode == 80){
        ';
        if ($row['alert'] == 'Yes')
            echo 'alert(\'' . $row['message'] . '\');';
        echo '
        return false;
    }
});
</script>
';
    }
    
    //Disable View Source Code
    if ($row['function'] == 'view_source' && $row['enabled'] == 'Yes') {
        echo '
<script language="javascript">
document.onkeydown = function(e) {
        if (e.ctrlKey && (e.keyCode === 85)) {
            ';
        if ($row['alert'] == 'Yes')
            echo 'alert(\'' . $row['message'] . '\');';
        echo '
            return false;
        } else {
            return true;
        }
};
</script>
';
    }
    
    //Disable Offline Use and Saving Page for Offline Use (CTRL + S)
    if ($row['function'] == 'offline_mode' && $row['enabled'] == 'Yes') {
        echo '
<script language="javascript">
if(window!=window.top) {
	window.location="https://www.google.com/#newwindow=1&q=You+are+not+allowed+to+use+the+site+in+offline+mode";
}
</script>
<script language="javascript">
jQuery(document).bind("keyup keydown", function(e){
    if(e.ctrlKey && e.keyCode == 83){
        ';
        if ($row['alert'] == 'Yes')
            echo 'alert(\'' . $row['message'] . '\');';
        echo '
        return false;
    }
});
</script>
';
    }
    
    //Keep the website out of frames
    if ($row['function'] == 'iframe_out' && $row['enabled'] == 'Yes') {
        echo '
<script language="javascript">
if(top.location!=self.location) top.location=self.location;
</script>
';
    }
    
    //Confirmation on Exit
    if ($row['function'] == 'exit_confirmation' && $row['enabled'] == 'Yes') {
        echo '
<script language="javascript">
window.onbeforeunload = function (e) {
  var message = "';
        echo $row['message'];
        echo '",
  e = e || window.event;
  // For IE and Firefox
  if (e) {
    e.returnValue = message;
  }
  // For Safari
  return message;

  navigator.vibrate(1000);
};
</script>
';
    }
    
    //Disable Selecting
    if ($row['function'] == 'selecting' && $row['enabled'] == 'Yes') {
        echo '
<style>
/*  */
body{
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}
</style>
';
    }
    
}
?>