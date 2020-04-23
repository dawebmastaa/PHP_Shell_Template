<?php
//writes out the alphabet with links to filter records.
for($a=65; $a<91; $a++)
{
    print("<a class=\"SmallLink\" href=\"$root"."$DirectoryPath/index/content/$StripContent/filter/".chr($a)."$AddValues\">".chr($a)."</a>&nbsp;");
}
if (!empty($filter))
{
    print(" <a class=\"SmallLink\" href=\"$root"."$DirectoryPath/index/content/$StripContent\">"."View All</a>");
}
?>
