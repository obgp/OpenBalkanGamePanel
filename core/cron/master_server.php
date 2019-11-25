<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/core/inc/config.php');
$mdb = masterserver();
$SQLSEC = $mdb->prepare("SELECT * FROM `t2`");
$SQLSEC->Execute();
$br = 0;
while($row = $SQLSEC->fetch(PDO::FETCH_ASSOC)) {
$vremeboosta = $row['vreme'];
$vrmbst = new DateTime($vremeboosta);
$danas = new DateTime('now');
$danasformatirano = $danas->format('Y-m-d H:i:s');
$istice = $vrmbst->modify('+2 day')->format('Y-m-d H:i:s');
if(strtotime($istice)<strtotime($danasformatirano))
{
  $SQLSEC = $mdb->prepare("DELETE FROM `t2` WHERE `ipport`= ?");
	if($SQLSEC->Execute(array($row["ipport"])) === TRUE)
	{
	$br++;			
	}
}
	
}
echo "Uspešno obrisano sa master servera ". $br. " servera";
?>
