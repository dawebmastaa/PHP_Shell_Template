<?php
//this is how we turn something.com/parameter/value/ into something.com?parameter=value.
if(isset($_SERVER['REQUEST_URI']) && strpos($_SERVER['REQUEST_URI'],'index'))
{
    $vardata = explode('/', strstr($_SERVER['REQUEST_URI'],'index'));
    $num_param = count($vardata);

    if($num_param % 2 == 0)
    {
        $vardata[] = ''; $num_param++;
    }

    for($i = 1; $i < $num_param; $i += 2)
    {
        if(!empty($vardata[$i]) AND !empty($vardata[$i+1]))
        {
			${$vardata[$i]} = addslashes($vardata[$i+1]);
        }
    }
}
elseif(isset($_SERVER['PATH_INFO']))
{
    $vardata = explode('/', $_SERVER['PATH_INFO']);
    $num_param = count($vardata);

    if($num_param % 2 == 0)
    {
        $vardata[] = ''; $num_param++;
    }

    for($i = 1; $i < $num_param; $i += 2)
    {
        if(!empty($vardata[$i]) AND !empty($vardata[$i+1]))
        {
			${$vardata[$i]} = addslashes($vardata[$i+1]);
        }
    }
}
?>
