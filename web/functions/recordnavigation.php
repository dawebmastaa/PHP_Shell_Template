<?php
// this file does the paging of records from a database query. It is included in the display page.
if($offset != 0 && is_numeric($offset))
{
    // bypass PREV link if offset is 0
    $prevoffset = $offset - $limit;
    print("\n     <a href=\"$DirectoryPath/index/content/$StripContent/offset/$prevoffset/".$AddValues."\" rel=\"nofollow\"><b>Prev</b></a>&nbsp; \n");
}

// calculate number of pages needing links
$pages = intval($RecordCount/$limit);

// $pages now contains int of pages needed unless there is a remainder from division
if($RecordCount%$limit)
{
    // has remainder so add one page
    $pages++;
}

if ($pages > 1)
{
    $ThisPage = $offset/$limit + 1;
        
    for ($i = 1;$i <= $pages; $i++)
    {
        // loop thru
        $newoffset=$limit*($i - 1);
            
        if ($offset == $newoffset)
        {
            //no link for the page we're showing
            print("      <span>[ $i ]</span>&nbsp; \n");
        }
        elseif(($i >= $ThisPage - 5) && ($i <= $ThisPage + 10))
        {
            //other pages get links
            print("      <a href=\"$DirectoryPath/index/content/$StripContent/offset/$newoffset/".$AddValues."\" rel=\"nofollow\"><b> $i </b></a>&nbsp; \n");
        }
     }
}

// check to see if last page.
if (!(($offset/$limit) == $pages) && $pages != 1 && $offset + $limit <= $RecordCount)
{
    // not last page so give NEXT link
    $newoffset = $offset+$limit;
    print("      <a href=\"$DirectoryPath/index/content/$StripContent/offset/$newoffset/".$AddValues."\" rel=\"nofollow\"><b>Next</b></a>\n");
 }
?>
