<?php
if($LinkRecordCount > 0 && $SectionRecordCount > 0)
{
	reset($rows);
	reset($rows2);
	$PageList = '';
	$SectionList = '';
	
	foreach($rows2 AS $Page)
	{
		$PageList .= ' "'.$Page['Text'].'",';
	}
	$PageList = trim(rtrim($PageList,','),' ');
	
	foreach($rows AS $Section)
	{
		$SectionList .= ' "'.$Section['Section'].'",';
	}
	$SectionList = trim(rtrim($SectionList,','),' ');
	//echo ('Page List: ' . $PageList);
	//echo ("\n".'SectionList: ' . $SectionList);
?>

 <script type="JavaScript">
 <!--
  let Pages = [<?php echo($PageList); ?>];
  let Sections = [<?php echo($SectionList); ?>];	
 -->
 </script> 
 <?php
 }?>