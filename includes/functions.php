<?php
function showMsg($msg, $msgtype){
    echo "<div class='alert alert-{$msgtype}'>{$msg}</div>";
}

function showMsgDis($msg, $msgtype){
    echo "<div class='alert alert-{$msgtype} alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>{$msg}</div>";
}

?>