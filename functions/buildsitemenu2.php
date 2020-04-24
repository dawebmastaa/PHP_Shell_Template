<?php
//this builds the navigation drop down menus as unordered lists.
if(isset($LinkRecordCount) && $LinkRecordCount > 0)
{
	$SectionCounter = 0;
	$CloseTag = 'N';

	mysqli_data_seek($GetLinks,0);

	while($row2 = mysqli_fetch_object($GetLinks))
	{
		if($row->SectionID === $row2->SectionID)
		{
			if($SectionCounter != $row2->SectionID && $CloseTag == 'Y')
			{
				echo("\n".'  </ul>'."\n");
				$CloseTag = 'N';
			}

			if($SectionCounter != $row2->SectionID)
			{
				echo('   <ul');
                if(isset($MenuCall) && $MenuCall == 'main'){echo(' class="SubNav">');}else{echo('>');}
				$CloseTag = 'Y';
				$SectionCounter = $row2->SectionID;
			}
			else
			{
				$CloseTag = 'Y';
			}
			echo("\n".'      <li><a href="'.$row2->URL.'" title="'.$row2->Message.'">'.$row2->Text.'</a></li>');
		}
	}
	echo("\n".'    </ul>'."\n ");
}
?>