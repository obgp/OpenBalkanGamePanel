<?php
//AdBlock Detector
$table = $prefix . 'adblocker-settings';
$query = mysqli_query($connect, "SELECT * FROM `$table`");
$row   = mysqli_fetch_assoc($query);

if ($row['detection'] == "Yes") {
    
    echo '
<script type="text/javascript">
document.onreadystatechange = function(){
     if(document.readyState === "complete"){
        
		var adBlockEnabled = false;
var testAd = document.createElement("div");
testAd.innerHTML = "&nbsp;";
testAd.className = "adsbox";
document.body.appendChild(testAd);
window.setTimeout(function() {
  if (testAd.offsetHeight === 0) {
    adBlockEnabled = true;
	window.location = "' . $row['redirect'] . '";
  }
  testAd.remove();
});
		
     }
}

</script>';
    
}
?>