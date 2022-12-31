<?php
if(isset($LinkRecordCount) && $LinkRecordCount > 0)
{
	reset($GetLinks);
	$PageList = '';
	
	foreach($GetLinks AS $Page)
	{
		$PageList .= ' "'.$Page['Text'].'",';
	}
	$PageList = trim(rtrim($PageList,','),' ');
	//echo ('Page List: ' . $PageList);
?>

 <script>
 <!--
  let Pages = [<?php echo($PageList); ?>];	
 -->
 </script> 
 <?php
 }?>