

	 <h1>Interested in RENTING your timeshare?</h1>	 
	 <form action="<?php echo $ApplicationNonSecureRoot.'main/index/content/formprocessor/';?>" method="post" name="SellForm" id="SellForm" style="padding-left: 0px;" onsubmit="returnValidate('SellForm'); return false;" onkeypress="if(event.keyCode == '13')alert('Please click the \'Rent It Now!\' button, and not press the Enter key.'); return event.keyCode!=13;">
	   <span class="AlertText">*</span> = Required Fields<br /><br />

	 
	   <label for="fistname"><span class="AlertText">*</span> First Name:</label><br />
	   <input type="text" name="firstname" id="SellFirstName" /><br />
	 
	   <label for="lastname"><span class="AlertText">*</span> Last Name:</label><br />
	   <input type="text" name="lastname" id="SellLastName" /><br />
	 
	   <label for="email"><span class="AlertText">*</span> Email:<br /></label>
	   <input type="text" name="email" id="SellEmail" /><br />
       
	   <label for="altemail">Alt Email:<br /></label>
	   <input type="text" name="altemail" id="SellAltEmail" /><br />
       	 
	   <label for="home_phone"><span class="AlertText">*</span> Home Phone:</label><br />
	   <input type="text" name="home_phone" id="SellHomePhone" /><br />
	 
	   <label for="alt_phone">Alternate Phone:</label><br />
	   <input type="text" name="alt_phone" id="SellAltPhone" /><br />

	   <label for="street">Street Address:</label><br />
	   <input type="text" name="street" id="SellStreet" /><br />

	   <label for="city">City:</label><br />
	   <input type="text" name="city" id="SellCity" /><br />
       
	   <label for="state">State:</label><br />
	   <select name="state" id="SellState">
       	<?php 
    	require_once($ApplicationPath.'/functions/dataconnect2.php');
		require_once($ApplicationPath.'/functions/getstates.php'); 
		echo ShowStatesList(); ?>
       </select>
       <br />
       
	   <label for="zip_code">Zip:</label><br />
	   <input type="text" name="zip_code" id="SellZip" /><br />
       
	   <label for="country">Country:</label><br />
	   <select name="country" id="SellCountry">
       	<?php 
		require_once($ApplicationPath.'/functions/getcountries.php');
		echo ShowCountriesList(); ?>
       </select>
       <br />
       <br />


       <span class="AlertText">*</span> <a class="AlertText" style="font-size: 11px; font-weight: bold;" href="#" onclick="ajaxLoader('<?echo($root)?>functions/ajaxcall.php/PageCall/showresort/','ShowResortDiv'); changeStyle('ShowResortDiv','display','block'); return false">Click Here To Select Your Resort</a>:<br /><br />

	   <div id="ShowResortDiv" style="display: none; padding-top: 4px; padding-bottom: 0px;">loading ...</div><br />
	 
	   <label for="SellComments">Additional Comments<br /></label>
	 
	   <textarea name="SellComments" id="SellComments" rows="5" cols="50"></textarea><br />

	   
	   <input name="Operation" class="SmallWhiteButton" type="submit" id="Operation" value="Rent It Now!" />
	  </form>
	  

