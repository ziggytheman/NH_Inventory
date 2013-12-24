<?php

$tCIO_SQLselect = "Select * ";
$tCIO_SQLselect .= "FROM nhi_check_io ";
$tCIO_SQLselect .= "WHERE cio_dps_barcode = $barcode ";
$tCIO_SQLselect .= "AND cio_check_out_date > 0 ";
$tCIO_SQLselect .= "AND cio_check_in_date = 0 ";

$tCIO_SQLselect_Query = mysqli_query($dbSelected, $tCIO_SQLselect);

if ($row = mysqli_fetch_assoc($tCIO_SQLselect_Query)) {
   
    $location = $row["cio_name"];
    $location .=" ";
    $date = new DateTime($row["cio_check_out_date"]);
    $location .= date_format($date,'m/d/y');
    
}
?>