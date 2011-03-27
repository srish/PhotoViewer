<?php
require '../libs/Smarty.class.php';
$smarty = new Smarty();
define("FILE_PER_PAGE",10);
$offset=$_REQUEST['file_id'];
$page=$_REQUEST['page'];
$offset = (int) $offset;
$page = (int) $page;
$start_offset = $page*FILE_PER_PAGE;
$fp = opendir("bday");
while(false != ($file = readdir($fp)))
{
    if ($file != "." && $file != "..")
    {
        $files[] = $file;
    }
}
$total_pages = ceil(count($files)/FILE_PER_PAGE);
for ($i=0; $i<$total_pages; $i++)
$pages[] = $i+1;
for ($i=$start_offset; $i<$start_offset+FILE_PER_PAGE; $i++)
{
    $temp_offset = $i-$start_offset;
    $temp_linked_files[] = "<a
href='gallery.php?file_id={$temp_offset}&page={$page}'><img
src='/Smarty1/demo/bday/{$files[$i]}' height=75 width=100></a>";
    $temp_files[] = $files[$i];
}
$current_file = $temp_files[$offset];
$smarty->assign("pages", $pages);
$smarty->assign("current_file", $current_file);
$smarty->assign("files", $temp_files);
$smarty->assign("linked_files", $temp_linked_files);
$smarty->display("gallery.tpl");
?>


