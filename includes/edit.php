<?php
include('includes/fn_insert_validations.php');
$barcode = $serialno = $location = $locationOther = "";
$assetType = $make = $model = $name = $os = $cpu = $hdsize = $serviceTag = "";
$ram = $pdate = $condition = $tlp = $notes = "";
$barcodeError = $serialnoError = $locationError = $locationOtherError = "";
$returnMsg = "Complete form to edit asset";
include('includes/dbaccess.php');
if ($dbSuccess) {
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $barcode = clean_input($_GET["barcode"]); {  //   SQL:    Select from Asset table
            $tAsset_SQLselect = "Select * ";
            $tAsset_SQLselect .= "FROM nhi_asset ";
            $tAsset_SQLselect .= "WHERE ass_dps_barcode = $barcode ";

            $tAsset_SQLselect_Query = mysqli_query($dbSelected, $tAsset_SQLselect);
        }

        if ($row = mysqli_fetch_assoc($tAsset_SQLselect_Query)) {
            foreach ($row as $idx => $r) {
                switch ($idx) {
                    case "ass_dps_barcode":
                        $barcode = str_pad($r, 10, "0", STR_PAD_LEFT);
                        break;
                    case "ass_type":
                        $assetType = $r;
                        break;
                    case "ass_make":
                        $make = $r;
                        break;
                    case "ass_service_tag":
                        $serviceTag = strtoupper($r);
                        break;
                    case "ass_model":
                        $model = $r;
                        break;
                    case "ass_name":
                        $name = $r;
                        break;
                    case "ass_serial_no":
                        $serialno = strtoupper($r);
                        break;
                    case "ass_os":
                        $os = $r;
                        break;
                    case "ass_cpu" :
                        $cpu = $r;
                        break;
                    case "ass_hd_size":
                        $hdsize = $r;
                        break;
                    case "ass_ram" :
                        $ram = $r;
                        break;
                    case "ass_purchase_date":
                        $pdate = $r;
                        break;
                    case "ass_condition" :
                        $condition = $r;
                        break;
                    case "ass_location" :
                        $location = $r;
                        break;
                    case "ass_location_other":
                        $locationOther = $r;
                        break;
                    case "ass_tlp":
                        $tlp = $r;
                        break;
                    case "ass_notes":
                        $notes = $r;
                        break;
                    case "ass_date_added":
                        $dateAdded = $r;
                        break;
                    case "ass_date_edited":
                        $dateEdited = $r;
                        break;
                }
            }
        } else {
            $errorMsg = "FAILED to select asset.<br />";
            $errorMsg .= mysqli_error($dbSelected) . "<br /><br />";
            $returnMsg = dataError($errorMsg);
        }
    }
}

if ($dbSuccess) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Collect screen Data with $_POST
        $barcode = clean_input($_POST["barcode"]);
        $serialno = clean_input($_POST["serialno"]);
        $location = clean_input($_POST["location"]);
        if ($location === "Other") {
            $locationOther = clean_input($_POST["locationOther"]);
        } else {
            $locationOther = "";
            $$locationOtherError = "";
        }
        $assetType = clean_input($_POST["assetType"]);
        $make = clean_input($_POST["make"]);
        $serviceTag = clean_input($_POST["serviceTag"]);
        $model = clean_input($_POST["model"]);
        $name = clean_input($_POST["name"]);
        $os = clean_input($_POST["os"]);
        $cpu = clean_input($_POST["cpu"]);
        $hdsize = clean_input($_POST["hdsize"]);
        $ram = clean_input($_POST["ram"]);
        $pdate = clean_input($_POST["pdate"]);
        $condition = clean_input($_POST["condition"]);
        $tlp = clean_input($_POST["tlp"]);
        $notes = clean_input($_POST["notes"]);

        $assetInserted = clean_input($_POST["assetInserted"]);

        $hasError = FALSE;
        $returnMsg = "";
        if (empty($barcode)) {
            $barcodeError = "A 10 digit Bar code is required";
            $hasError = TRUE;
        } elseif (!is_numeric($barcode)) {
            $barcodeError = "Bar code must be numeric";
            $hasError = TRUE;
        }

        if (strlen($barcodeError) > 0) {
            $returnMsg .= $barcodeError . "; ";
        }
    }


    if (isset($assetInserted) && $assetInserted == '1' && !$hasError) {
//   $addAsset = assetInsert($dbSelected,$barcode,$serialno,$location,$locationOther,
//      $assetType,$make,$serviceTag,$model,$name,$os,$cpu,$hdsize,$ram,$pdate,$condtion,
//      $tlp, $notes);
        {  //   SQL:     $tnhi_Asset_SQLupdate
            $date = date("Y-m-d H:i:s");
            $tAsset_SQLupdate = "UPDATE nhi_asset SET ";
            $tAsset_SQLupdate .= "ass_type = " . "'" . $assetType . "', ";
            $tAsset_SQLupdate .= "ass_make = " . "'" . $make . "', ";
            $tAsset_SQLupdate .= "ass_service_tag = " . "'" . strtoupper($serviceTag) . "', ";
            $tAsset_SQLupdate .= "ass_model = " . "'" . $model . "', ";
            $tAsset_SQLupdate .= "ass_name = " . "'" . $name . "', ";
            $tAsset_SQLupdate .= "ass_serial_no = " . "'" . strtoupper($serialno) . "', ";
            $tAsset_SQLupdate .= "ass_os = " . "'" . $os . "', ";
            $tAsset_SQLupdate .= "ass_cpu = " . "'" . $cpu . "', ";
            $tAsset_SQLupdate .= "ass_hd_size = " . "'" . $hdsize . "', ";
            $tAsset_SQLupdate .= "ass_ram = " . "'" . $ram . "', ";
            $tAsset_SQLupdate .= "ass_purchase_date = " . "'" . $pdate . "', ";
            $tAsset_SQLupdate .= "ass_condition = " . "'" . $condition . "', ";
            $tAsset_SQLupdate .= "ass_location = " . "'" . $location . "', ";
            $tAsset_SQLupdate .= "ass_location_other = " . "'" . $locationOther . "', ";
            $tAsset_SQLupdate .= "ass_tlp = " . "'" . $tlp . "', ";
            $tAsset_SQLupdate .= "ass_notes = " . "'" . $notes . "', ";
            $tAsset_SQLupdate .= "ass_date_edited = " . "'" . $date . "' ";
            $tAsset_SQLupdate .= "WHERE ass_dps_barcode = $barcode ";
        }

        if (mysqli_query($dbSelected, $tAsset_SQLupdate)) {
            $returnMsg = "Asset <strong>" . $barcode . "</strong>";
            $returnMsg .= " was successfully updated.";
        } else {
            $errorMsg = "FAILED to add update asset.<br />";
            $errorMsg .= mysqli_error($dbSelected) . "<br /><br />";
            $returnMsg = dataError($errorMsg);
        }

        unset($assetInserted);
    }
    include('includes/conditionDropDown.php');
    include('includes/typeDropDown.php');
}
?>

<form method="post" action="index.php?next=edit.php" >
    <div class="fieldSet">
        <fieldset>
            <legend>Edit - Required Fields
                <span class="links"><a href="index.php?next=maininsert.php&barcode=<?php echo $barcode; ?>">Maintenance</a></span>
                <span class="links"><a href="index.php?next=check-inprocess.php&barcode=<?php echo $barcode; ?>">Check-In</a></span>
                <span class="links"><a href="index.php?next=check-outprocess.php&barcode=<?php echo $barcode; ?>">Check-Out</a></span>	

            </legend>
            <input type="hidden" name="assetInserted" value="1"/>
 <p><label class="field" for="barcode">DPS Barcode</label>
                <input type="text" name="barcode" id="barcode" class="textbox-300" autofocus value="<?php echo $barcode; ?>"/>
                <span class="error"><?php echo $barcodeError ?></span></p>
            <p><label class="field" for="serialno">Serial Number</label>
                <input type="text" name="serialno" id="serialno" class="textbox-300" value="<?php echo $serialno; ?>"/>
                <span class="error"><?php echo $serialnoError; ?></span></p>
        
            <p><label class="field" for="location">Location</label>
                <input type="text" name="location" id="location" class="textbox-300"  value="<?php echo $location; ?>"/>
                <span class="error"><?php echo $locationError; ?></span></p>

            <div id="otherLocation">
                <p><label class="field" for="locationOther">Other </label>
                    <input type="text" name="locationOther" id="locationother" class="textbox-300" value="<?php echo $locationOther; ?>"/>
                    <span class="error"><?php echo $locationOtherError; ?></span></p>
            </div>
        </fieldset>
    </div>

    <div class="fieldSet">
        <fieldset>
            <legend>Edit - Optional Fields</legend>
            <p><label class="field" for="assetType">Type</label>
<?php echo $assetTypeDropDown; ?>
            </p>
            <p><label class="field" for="make">Make</label>
                <input type="text" name="make" id="make" class="textbox-300" value="<?php echo $make; ?>" /></p>

            <p><label class="field" for="serviceTag">Service Tag</label>
                <input type="text" name="serviceTag" id="serviceTag" class="textbox-300" value="<?php echo $serviceTag; ?>" /></p>


            <p><label class="field" for="model">Model</label>
                <input type="text" name="model" id="type" class="textbox-300" value="<?php echo $model; ?>"/></p>

            <p><label class="field" for="name">Name</label>
                <input type="text" name="name" id="name" class="textbox-300" value="<?php echo $name; ?>"/></p>

            <p><label class="field" for="os">Operating System</label>
                <input type="text" name="os" id="os" class="textbox-300" value="<?php echo $os; ?>"/></p>

            <p><label class="field" for="cpu">CPU</label>
                <input type="text" name="cpu" id="cpu" class="textbox-300" value="<?php echo $cpu; ?>"/></p>

            <p><label class="field" for="hdsize">HD Size</label>
                <input type="text" name="hdsize" id="hdsize" class="textbox-300" value="<?php echo $hdsize; ?>"/></p>

            <p><label class="field" for="ram">Ram</label>
                <input type="text" name="ram" id="ram" class="textbox-300" value="<?php echo $ram; ?>"/></p>

            <p><label class="field" for="pdate">Date of Purchase</label>
                <input type="date" name="pdate" id="pdate" class="textbox-300" value="<?php echo $pdate; ?>"/></p>

            <p><label class="field" for="condition">Condition</label> 
<?php echo $conditionDropDown; ?>
            </p>

            <p><label class="field" for="tlp">TLP</label>

                <select name="tlp" id="tlp" class="option-300"/>
                <?php
                echo
                $selectedTrue = "";
                $selectedFalse = "";
                $selectedBlank = "";
                if ($tlp === "") {
                    $selectedBlank = "";
                } elseif ($tlp == "true") {
                    $selectedTrue = "selected";
                } elseif ($tlp == "false") {
                    $selectedFalse = "selected";
                }
                ?>
            <option <?php echo $selectedBlank; ?> value=""> </option>
            <option <?php echo $selectedTrue; ?> value="true">True</option>
            <option <?php echo $selectedFalse; ?> value="false">False</option>
            </select></p>
            <p><label class="field" for="notes">Notes</label>
                <textarea name="notes" id="notes" class="textarea" rows="5" cols="50"><?php echo $notes; ?></textarea></p>
        </fieldset>
        <input type="submit" value="Update">
    </div>
</form>


<!--
    $fld_assetInserted  = '<input type="hidden" name="assetInserted" value="1"/>';
    $fld_barcode  = '<p><label class="field" for="barcode">DPS Barcode</label>';
    $fld_barcode .= '<input type="text" name="barcode" id="barcode" class="textboxr-300" readonly ';
    $fld_barcode .= 'value="'.$barcode.'" />';
    $fld_barcode .= '<span class="error">'.$barcodeError.'</span></p>';
    
    $fld_serialno  = '<p><label class="field" for="serialno">Serial Number</label>';
    $fld_serialno .= '<input type="text" name="serialno" id="serialno" class="textbox-300" '
            . 'value="'.$serialno.'" autofocus/>';
    $fld_serialno .= '<span class="error">'.$serialnoError.'</span></p>';
    $fld_links = '<span class="links"><a href="index.php?next=maininsert.php&barcode='.$barcode.'">Maintenance</a></span>';       
    $fld_links .= '<span class="links"><a href="index.php?next=check-inprocess.php&barcode='.$barcode.'">Check-In</a></span>';       
    $fld_links .= '<span class="links"><a href="index.php?next=check-outprocess.php&barcode='.$barcode.'">Check-Out</a></span>';
          
    echo "<form method=\"post\" action=\"index.php?next=edit.php\" >\n";
    echo "<div class=\"fieldSet\">\n";
    echo "<fieldset>\n";
    echo "<legend>Edit - Required Fields";
        echo $fld_links;
        echo "</legend>\n";
    echo "      <input type=\"hidden\" name=\"assetInserted\" value=\"1\"/>";
    
    echo $fld_barcode;
        echo $fld_serialno;

    echo "     <p><label class=\"field\" for=\"location\">Location</label>\n";
    echo "         <input type=\"text\" name=\"location\" id=\"location\" class=\"textbox-300\"  value=\"$location\"/>"
                        . "<span class=\"error\">$locationError</span></p>\n";

    echo "      <div id=\"otherLocation\">";
    echo "         <p><label class=\"field\" for=\"locationOther\">Other </label>\n";
    echo "         <input type=\"text\" name=\"locationOther\" id=\"locationother\" class=\"textbox-300\" value=\"$locationOther\"/>"
                            . "<span class=\"error\">$locationOtherError</span></p>\n";
    echo "       </div>";
    echo "</fieldset>\n";
    echo "</div>\n";

    echo "<div class=\"fieldSet\">\n";
    echo "<fieldset>\n";
    echo "<legend>Edit - Optional Fields</legend>\n";
    echo "     <p><label class=\"field\" for=\"assetType\">Type</label>\n";
    echo $assetTypeDropDown;
    echo "</p>";
    echo "     <p><label class=\"field\" for=\"make\">Make</label>\n";
    echo "         <input type=\"text\" name=\"make\" id=\"make\" class=\"textbox-300\" value=\"$make\" /></p>\n";

        echo "     <p><label class=\"field\" for=\"serviceTag\">Service Tag</label>\n";
    echo "         <input type=\"text\" name=\"serviceTag\" id=\"serviceTag\" class=\"textbox-300\" value=\"$serviceTag\" /></p>\n";

        
    echo "     <p><label class=\"field\" for=\"model\">Model</label>\n";
    echo "         <input type=\"text\" name=\"model\" id=\"type\" class=\"textbox-300\" value=\"$model\"/></p>\n";

    echo "     <p><label class=\"field\" for=\"name\">Name</label>\n";
    echo "         <input type=\"text\" name=\"name\" id=\"name\" class=\"textbox-300\" value=\"$name\"/></p>\n";

    echo "     <p><label class=\"field\" for=\"os\">Operating System</label>\n";
    echo "         <input type=\"text\" name=\"os\" id=\"os\" class=\"textbox-300\" value=\"$os\"/></p>\n";

    echo "     <p><label class=\"field\" for=\"cpu\">CPU</label>\n";
    echo "         <input type=\"text\" name=\"cpu\" id=\"cpu\" class=\"textbox-300\" value=\"$cpu\"/></p>\n";

    echo "     <p><label class=\"field\" for=\"hdsize\">HD Size</label>\n";
    echo "         <input type=\"text\" name=\"hdsize\" id=\"hdsize\" class=\"textbox-300\" value=\"$hdsize\"/></p>\n";

    echo "     <p><label class=\"field\" for=\"ram\">Ram</label>\n";
    echo "         <input type=\"text\" name=\"ram\" id=\"ram\" class=\"textbox-300\" value=\"$ram\"/></p>\n";

    echo "     <p><label class=\"field\" for=\"pdate\">Date of Purchase</label>\n";
    echo "         <input type=\"date\" name=\"pdate\" id=\"pdate\" class=\"textbox-300\" value=\"$pdate\"/></p>\n";

    echo "     <p><label class=\"field\" for=\"condition\">Condition</label> \n";
    echo $conditionDropDown;
    echo "</p>\n";

    echo "     <p><label class=\"field\" for=\"tlp\">TLP</label>\n";

    echo "<select name=\"tlp\" id=\"tlp\" class=\"option-300\"/>\n";

            $selectedTrue="";
            $selectedFalse="";
            $selectedBlank="";
            if($tlp === ""){
              $selectedBlank="";  
            }elseif($tlp == "true"){
               $selectedTrue="selected";
            } elseif($tlp == "false"){
                $selectedFalse="selected";
            }
    echo " <option $selectedBlank value=\"\"> </option>\n";
    echo " <option $selectedTrue value=\"true\">True</option>\n";
    echo " <option $selectedFalse value=\"false\">False</option>\n";
    echo "</select></p>\n";
    echo "     <p><label class=\"field\" for=\"notes\">Notes</label>\n";
    echo "         <textarea name=\"notes\" id=\"notes\" class=\"textarea\" rows=\"5\" cols=\"50\">$notes</textarea></p>\n";
    echo "</fieldset>\n";
    echo "<input type=\"submit\" value=\"Update\">";
    echo "</div>\n";
    echo "</form>\n";

}
?> -->
<script>
    $("#pageTitle").text("Edit");
</script>