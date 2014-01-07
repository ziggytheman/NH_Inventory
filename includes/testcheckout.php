<?php
include('includes/dbaccess.php');
$assetType = $make = $model = $name = $serialNo = $location = "";
$coDate = $coName = $coTelephone = $coEmail = $coRoom = $coNotes = $coTime = "";
$ciDate = $ciNotes = "";
$hasError = FALSE;
$returnMsg = "Enter check-out data";
$coDateError = $coNameError = $coTelephoneError = $coEmailError = $coRoomError = "";
//$ciDateError = "";
$insert = "n";
$readonly = "";
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<form method="post" action="index.php?content=assetCheckOut" >
    <div class="fieldSet">
        <fieldset>
            <legend>Asset Check-Out Information</legend>
            <div class="column1">
                <p>
                    <label class="field" for="coDate">Check-out Date</label>
                    <input type="date" name="coDate" id="coDate" class="textbox-150" value="" />

                </p>
                <p>
                    <label class="field" for="coName">Name</label>
                    <input type="text" name="coName" id="coName" class="textbox-150" value=""/>

                </p>
                <p>
                    <label class="field" for="coTelephone">Telephone</label>
                    <input type="tel" name="coTelephone" id="coTelephone" class="textbox-150" value=""/>

                </p>
            </div>
            <div class="column2">
                <p>
                    <label class="field" for="coEmail">e-Mail</label>
                    <input type="email" name="coEmail" id="coEmail" class="textbox-150" value=""/>

                </p>
                <p>
                    <label class="field" for="coRoom">Room</label>
                    <input type="text" name="coRoom" id="coRoom" class="textbox-150" value=""/>

                </p>
                <p>
                    <label class="field" for="coNotes">Notes</label>
                    <textarea  name="coNotes" id="coNotes" class="textbox-150"></textarea>
                </p>
            </div>
        </fieldset>
        <div class="fieldSet">
            <fieldset>
                <legend>Asset Check-Out Details</legend>
                <table id="checkDetails">
                    <thead>
                        <tr>
                            <th class="input-100">Barcode</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="checkDetailBarcode">
                                <input type="text" name="barcode[]" id="barcode" class="input-100" value=""/>
                            </td>
                            <td>STUFF</td>

                        </tr>
                        <tr>
                            <td class="checkDetailBarcode">
                                <input type="text" name="barcode[]" id="barcode" class="input-100" value=""/>
                            </td>
                            <td>STUFF</td>

                        </tr>
                        <tr>
                            <td class="checkDetailBarcode">
                                <input type="text" name="barcode[]" id="barcode" class="input-100" value=""/>
                            </td>
                            <td>STUFF</td>

                        </tr>


                    </tbody>
                </table>


            </fieldset>
        </div>
    </div>
    <input type="submit" value="Check Out">
</form>
<script>
    $("#pageTitle").text("Check-Out test");
</script>
