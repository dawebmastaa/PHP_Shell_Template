<?php
if(isset($LinkRecordCount) && $LinkRecordCount > 0)
{
	mysqli_data_seek($GetLinks,0);
	$PageList = '';
	
	while($Page = mysqli_fetch_object($GetLinks))
	{
		$PageList .= ' "'.$Page->Text.'",';
	}
	$PageList = trim(rtrim($PageList,','),' ');
?>

 <script type="text/javascript">
 <!--
  let Pages = [<?php echo($PageList); ?>];	
 -->
 </script> 
 <?php
 }?>