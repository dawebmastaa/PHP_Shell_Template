<?php
if(isset($LinkRecordCount) && $LinkRecordCount > 0) {
	echo('  <ul class="LeftMenu">' . "\n\n   " . '<li><a href="">Home</a></li>' . "\n ");
	reset($GetSiteSections);
	//this builds the 'main navigation'

	while ($row = $GetSiteSections->fetch(PDO::FETCH_ASSOC)) {
		echo('  <li><a href="' . $row['Directory'].'/" title="' . $row['SectionTitle'].'"><img src="img/arrow.gif" alt="' . ucfirst($row['Directory']) . 'List" />' . $row['Section'].'</a>' . "\n ");
		$MenuCall = 'left';
		require("$ApplicationPath/functions/buildsitemenu.php");
		echo('  </li>' . "\n\n");
	}
	echo('   </ul>' . "\n");
}
require_once("$ApplicationPath/functions/displaysubnavigation.php");
?>
