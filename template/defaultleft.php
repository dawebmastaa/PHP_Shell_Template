  <div class="LeftMenu">
<?php
if(isset($LinkRecordCount) && $LinkRecordCount > 0)
{
	echo('  <ul>'."\n\n   ".'<li><a href="">Home</a></li>'."\n ");
	@mysqli_data_seek($GetSiteSections,0);
	//this builds the 'main navigation'
	
	while($row = mysqli_fetch_object($GetSiteSections))
	{
		echo('   <li><a href="'.$row->Directory.'/" title="'.$row->SectionTitle.'"><img src="images/arrow.gif" id="'.ucfirst($row->Directory).'List" alt="'.ucfirst($row->Directory).'List" />'.$row->Section.'</a>'."\n ");
		require("$ApplicationPath/functions/buildsitemenu.php");
		echo('  </li>'."\n\n");
	}echo('   </ul>'."\n");
}
?>
  </div>
