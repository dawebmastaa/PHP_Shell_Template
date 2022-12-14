<?php
// this file does the paging of records from a database query for an ajax request.
if ($offset != 0)
{
    // bypass PREV link if offset is 0
    $prevoffset = $offset - $limit;
    print('<a href="#top" style="padding: 0px 0px 0px 0px; margin: 0px 4px 0px 0px;" onclick="ajaxLoader(\''.$root.'functions/ajaxcall.php?PageCall=searchresort&filter='.$filter.'&offset='.$prevoffset.'\',\'SearchResortDiv\'); return false;">Prev</a>'."\n");
}

// calculate number of pages needing links
$pages = intval($RecordCount/$limit);

// $pages now contains int of pages needed unless there is a remainder from division
if($RecordCount % $limit)
{
    // has remainder so add one page
    $pages++;
}

if ($pages > 1)
{
    for ($i = 1; $i <= $pages; $i++)
    {
        // loop thru
        $newoffset = $limit * ($i - 1);
        
        if ($offset == $newoffset)
        {
            //no link for the page we're showing
            print("      <span>[ $i ]</span>&nbsp; \n");
        }
        else
        {
            //other pages get links
            print('<a href="#top" style="padding: 0px 0px 0px 0px; margin: 0px 4px 0px 0px;" onclick="ajaxLoader(\''.$root.'functions/ajaxcall.php?PageCall=searchresort&filter='.$filter.'&offset='.$newoffset.'\',\'SearchResortDiv\'); return false;"> '.$i.' </a>'."\n");
            //print("      <a href=\"$DirectoryPath/index/content/$StripContent/offset/$newoffset$AddValues/\"> $i </a>&nbsp; \n");
        }
    }
}

// check to see if last page.
 if (!(($offset/$limit) == $pages) && $pages != 1 && $offset + $limit <= $RecordCount)
 {// not last page so give NEXT link
     $newoffset=$offset+$limit;
     print('<a href="#" onclick="ajaxLoader(\''.$root.'functions/ajaxcall.php?PageCall=searchresort&filter='.$filter.'&offset='.$newoffset.'\',\'SearchResortDiv\'); return false;">Next</a>'."\n");
 }
?>
