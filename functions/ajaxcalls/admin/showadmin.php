<?php
switch (PageView){
	case "StartDiv":
	
	echo('something');
	
	break;
	
	case "Recache":
	
	break;
	
	case "AddPage":
	
	break;
	
	case "AddNewPage":
	
	break;
	
	case "AddNewSubPage":
	
	break;
	
	case "EditSiteSection":
	
	case "NewSectionDiv":
	
	break;
	
	case "EditSiteSections":
	
	break;
	
	case "EditSitePages":
	
	break;
	
	case "SectionOrdering":
	
	break;
	
	case "EditPage":
	
	break;
	
	case "EditSection":
	
	break;
	
	case "AddSiteSectionForm":
	
	break;
	
	case "EditSubPagesBlurb":
	
	break;
	
	case "EditSubPages":
	
	break;
	
	case "EditSubPage":
	
	break;
	
	case "AddSubPages":
	
	break;
	
	case "AddSubPageLinks":
	
	break;
	
	default :
}
require_once("$ApplicationPath/$PageView/view/view$PageView.php")
?>