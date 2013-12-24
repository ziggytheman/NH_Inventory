<?php 
/* This common include creates a HTML table that contains the values from a view
 * The barcode is a hyper-link to the edit function. 
 * 
 * The table that is created uses the jQuery plug in Datatable to create the 
 * tables
 */
{
    $list_SQLselect_Query = mysqli_query($dbSelected, $list_SQLselect);
    echo "\n<table class=\"dataTable\" id=\"list\">\n";


    $indx = TRUE;
    $rowCount = 0;
    while ($row = mysqli_fetch_assoc($list_SQLselect_Query)) {
        if ($indx) {
            //printer header row
            echo "  <thead>\n   <tr>\n";
            foreach ($row as $idx => $r) {
                echo "      <th>$idx</th>\n";
            }
            echo "  </tr>\n</thead>\n<tbody>\n";
            $indx = FALSE;
        }


        if ($rowCount % 2 === 0) {
            $line = "even";
        } else {
            $line = "odd";
        }
        echo "  <tr class=\"" . $line . "\">\n";
        foreach ($row as $idx => $r) {
            if ($idx == "Barcode") {
                $r = str_pad($r, 10, "0", STR_PAD_LEFT);
                echo "      <td><a href=\"index.php?next=edit.php&barcode=$r\">$r</a></td>\n";
            } else
                echo "      <td>$r</td>\n";
        }
        echo "  </tr>\n";
        $rowCount++;
    }
    echo " </tbody>\n</table>\n";
    mysqli_free_result($list_SQLselect_Query);
}
?>
