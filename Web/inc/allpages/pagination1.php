<?php
echo $information, '<br />';
$numberPerPage = 5;
$totalPages = ceil($numberTotal/$numberPerPage);

if(isset($id) AND !empty($id) AND $id > 0 AND $id <= $totalPages)
{
  $id = intval($id);
  $pageNow = $id;    
}
else
{
  $pageNow = 1;
}

$started = ($pageNow-1)*$numberPerPage;
?>