<?php
include('includes/dbaccess.php');
$returnMsg = "Enter bar code or select barcode";

if ($dbSuccess) {
    $list_SQLselect = "SELECT  ";
    $list_SQLselect .= "* ";
    $list_SQLselect .= "FROM ";
    $list_SQLselect .= "vCheckhist ";  //	<< table name

    include('includes/common_createTable.php');
}
?>
<script>
    $("#pageTitle").text("Check-In/Out History");
</script>
