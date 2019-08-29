
<?php 
	$rnum = $_GET["rnum"];
  
?>
<!-- <div id="rcv" >  --> 
	<!-- <div id="rimg_attr">
	 		attr
	</div>
	
 	<div id="rimg"  > 
 		<center>
 			<img src="hr_folders/hr_images/<?php echo "$rnum"; ?>.jpg">
 		</center> 	
 	</div>	 
 -->

<center>
	<div id="reservation-body-container" >
		 
		<table id="reservation-body-table" border="0" cellpadding="0" cellspacing="0"   >
			<tr>
				<td  id="reservation-body-table-contentheader" > 
					<!-- <hr> -->
					<table border="0" cellpadding="0" cellspacing="0" style="width:100%; " >
						<td width="466" style="padding-left:19px;  "  > <b> DELUX </b> </td>
						<td style="padding-left:24px;" > <b> FILL UP BELLOW </b> </td>
					</table>
				</td>
			<tr>
				<td style="reservation-top-content" > 
			 		<ul id="hr_body_content-ul" > 
				 		<li id="reservation-body-left" >   
				 				<img id="room-img" src="hr_folders/hr_images/<?php echo "$rnum"; ?>.jpg">   
				 		</li> 
				 		<li id="reservation-body-right" >  
				 		 
				 		 	<form action="guestinfo#header-logo-nav" method="POST"  >
					 			<table border="0" cellpadding="0" cellspacing="0" width="100%"> 
					 				<tr>  
					 					<td> 
					 						<input type="text" placeholder="Room number 200"          id="reservation-room-number"        name="reservation_room_number"    />
					 					</td>
					 				<tr>  
					 					<td> 
					 						<input type="text" placeholder="check in date: 12/12/2014" id="reservation-room-checkindate"  name="reservation_room_checkindate"   /> 
					 					</td>
					 				<tr>  
					 					<td> 
					 						<input type="text" placeholder="check out date: 12/12/2014" id="reservation-room-checkoutdate" name="reservation_room_checkoutdate"   /> 
					 					</td>
					 				<tr>  
					 					<td> 
					 						<!-- <input type="text" placeholder="estimated time of arrival" />   -->
					 					 		 						
						 					<select  id="reservation-room-eta" name="estenated_time_arrival"  >
												<option value="5:00 AM">5:00 AM</option>
												<option value="5:15 AM">5:15 AM</option>
												<option value="5:30 AM">5:30 AM</option>
												<option value="5:45 AM">5:45 AM</option>
											 
												<option value="6:00 AM">6:00 AM</option>
												<option value="6:15 AM">6:15 AM</option>
												<option value="6:30 AM">6:30 AM</option>
												<option value="6:45 AM">6:45 AM</option>
											 
												<option value="7:00 AM">7:00 AM</option>
												<option value="7:15 AM">7:15 AM</option>
												<option value="7:30 AM">7:30 AM</option>
												<option value="7:45 AM">7:45 AM</option>
											 
												<option value="8:00 AM">8:00 AM</option>
												<option value="8:15 AM">8:15 AM</option>
												<option value="8:30 AM">8:30 AM</option>
												<option value="8:45 AM">8:45 AM</option>
											 
												<option value="9:00 AM">9:00 AM</option>
												<option value="9:15 AM">9:15 AM</option>
												<option value="9:30 AM">9:30 AM</option>
												<option value="9:45 AM">9:45 AM</option>
											 
												<option value="10:00 AM">10:00 AM</option>
												<option value="10:15 AM">10:15 AM</option>
												<option value="10:30 AM">10:30 AM</option>
												<option value="10:45 AM">10:45 AM</option>
											 
												<option value="11:00 AM">11:00 AM</option>
												<option value="11:15 AM">11:15 AM</option>
												<option value="11:30 AM">11:30 AM</option>
												<option value="11:45 AM">11:45 AM</option>
											 
												<option value="12:00 PM">12:00 PM</option>
												<option value="12:15 PM">12:15 PM</option>
												<option value="12:30 PM">12:30 PM</option>
												<option value="12:45 PM">12:45 PM</option>
											 
												<option value="1:00 PM">1:00 PM</option>
												<option value="1:15 PM">1:15 PM</option>
												<option value="1:30 PM">1:30 PM</option>
												<option value="1:45 PM">1:45 PM</option>
											 
												<option value="2:00 PM">2:00 PM</option>
												<option value="2:15 PM">2:15 PM</option>
												<option value="2:30 PM">2:30 PM</option>
												<option value="2:45 PM">2:45 PM</option>
											 
												<option value="3:00 PM">3:00 PM</option>
												<option value="3:15 PM">3:15 PM</option>
												<option value="3:30 PM">3:30 PM</option>
												<option value="3:45 PM">3:45 PM</option>
											 
												<option value="4:00 PM">4:00 PM</option>
												<option value="4:15 PM">4:15 PM</option>
												<option value="4:30 PM">4:30 PM</option>
												<option value="4:45 PM">4:45 PM</option>
											 
												<option value="5:00 PM">5:00 PM</option>
												<option value="5:15 PM">5:15 PM</option>
												<option value="5:30 PM">5:30 PM</option>
												<option value="5:45 PM">5:45 PM</option>
											 
												<option value="6:00 PM">6:00 PM</option>
												<option value="6:15 PM">6:15 PM</option>
												<option value="6:30 PM">6:30 PM</option>
												<option value="6:45 PM">6:45 PM</option>
											 
												<option value="7:00 PM">7:00 PM</option>
												<option value="7:15 PM">7:15 PM</option>
												<option value="7:30 PM">7:30 PM</option>
												<option value="7:45 PM">7:45 PM</option>
											 
												<option value="8:00 PM">8:00 PM</option>
												<option value="8:15 PM">8:15 PM</option>
												<option value="8:30 PM">8:30 PM</option>
												<option value="8:45 PM">8:45 PM</option>
											 
												<option value="9:00 PM">9:00 PM</option>
												<option value="9:15 PM">9:15 PM</option>
												<option value="9:30 PM">9:30 PM</option>
												<option value="9:45 PM">9:45 PM</option>
											 
												<option value="10:00 PM">10:00 PM</option>
												<option value="10:15 PM">10:15 PM</option>
												<option value="10:30 PM">10:30 PM</option>
												<option value="10:45 PM">10:45 PM</option>
											 
												<option value="11:00 PM">11:00 PM</option>
												<option value="11:15 PM">11:15 PM</option>
												<option value="11:30 PM">11:30 PM</option>
												<option value="11:45 PM">11:45 PM</option>
											</select> 
					 					</td>
					 				<tr>  
					 					<td   > 
					 						<input id="reservation-submit" type="submit" value="submit" /> 
					 					</td> 
					 			</table> 
					 		</form>
				 		</li> 	
				 	</ul>
			 	</td>
		 	<tr> 
		 		<td  id="reservation-body-table-footerheader" >  
					<table border="0" cellpadding="0" cellspacing="0" style="width:100%; " >
						<td width="466" style="padding-left:19px;"  > <b> ROOM VIEWS </b> </td>
						<td style="padding-left:24px;" > <b> AMINITIES </b> </td>
					</table>
				</td> 
		 	<tr>
		 		<td style="reservation-bottom-content" > 
				 	<ul id="hr_body_content-ul" > 
				 		<li id="reservation-body-left-footer" > 
				 		 
				 			<table> 
				 			 	<tr> 
				 			 		<?php 
				 			 			$c=0;
				 			 			for ($i=0; $i < 10 ; $i++) {  
				 			 				$c++;
						 			 		echo "  
							 			 		<td> 
							 			 			<img src='hr_folders/hr_images/$rnum.jpg'> 
							 			 		</td>  
						 			 		";
						 			 		if ( $c==5 ) {
						 			 			echo "<tr>";
						 			 		}
					 			 		}
				 			 		?> 
				 			</table> 
				 		</li>
				 		<li id="reservation-body-right-footer">  
				 			<table> 
				 			 	<tr> 
				 			 		<?php 
				 			 			$c=0;
				 			 			for ($i=0; $i < 10 ; $i++) {  
				 			 				$c++;
						 			 		echo "  
							 			 		<td> 
							 			 			<img src='hr_folders/hr_images/$rnum.jpg'> 
							 			 		</td>  
						 			 		";
						 			 		if ( $c==5 ) {
						 			 			echo "<tr>";
						 			 		}
					 			 		}
				 			 		?> 
				 			</table> 
						</li>
					</ul>
				</td>
		</table>
	</div>
</center>


<!-- </div> -->

<!-- <br><br>  -->
