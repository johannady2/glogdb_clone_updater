<?php
setcookie(
  'UsedcountDownValue',
  $_POST['usedcountdownseconds'],
  time() + 199999999
);

echo $_POST['usedcountdownseconds'];
?>