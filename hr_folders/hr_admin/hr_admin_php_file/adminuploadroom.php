<div id="admin-uploadamenities-container-div" > 
	<table border="0" cellpadding="0" cellspacing="0" > 
		<tr>  	
			<td id="uploadamenities-container-header" > 
					smc reservation 
				<br> 
					 add room
			</td>
		<tr>  
			<td id="uploadamenities-container-body" >   
				<table border="0" cellpadding="0" cellspacing="0"  > 
					<tr> 
						<td id="header" > 
								
						</td>
					<tr>
						<td id="body" >  
								<ul> 
									<li style="width:35%;height:250px;background-color:#fff" > 
										<center>
											<img src="hr_folders/hr_images/room/4.jpg"   />
										</center>
									</li>
									<li style="width:63%; height:250px;background-color:#fff; border-left: 10px solid #000;" > 
										<table  border="0" cellpadding="0" cellspacing="0"  > 
											<tr>  
												<td> 
													<input type="text" placeholder='ROOM NUMBER..' />
												</td>
											<tr>   
												<td> 
													<input type="text" placeholder='ROOM TYPE..' />
												</td>
											<tr>  
												<td> 
													<textarea placeholder="ROOM DESCRIPTION.." ></textarea>
												</td>
										</table> 
									</li> 
									<li style="width:35%;background-color:#415e9b; "  > 
										<center>
											<input type="submit" value="UPLOAD ( room )" onclick="alert('upload amenities')" />
										</center>
									</li>
									<li style="width:63%;background-color:#415e9b; border-left: 10px solid #000; height:40px; "  > 
						  				<!-- <input type="submit" value="CANCEL" style="float:right;margin-right:10px;" onclick="alert('cancel amenities')" />   -->
						  				<!-- <input type="submit" value="SAVE" style="float:right; margin-right:10px;"  onclick="alert('save amenities')" />   -->
									</li>
								</ul>  
								<table  border="0" cellpadding="0" cellspacing="0" style="padding-top:10px;  margin-top:10px; width:99% "  > 
									<tr> 
										<td style="background-color:#415e9b; padding:20px; color:#fff;" > 
											SELECT ROOM AMENITIES
										</td>
									<tr>
										<td style="background-color:#fff; padding:20px;" > 
										 
												<ul style="margin-left:22px;"> 
													<?php $c=0; for ($i=0; $i < 4 ; $i++) { $c++ ?>
														<li>
															<center>
															 	<img src="hr_folders/hr_images/amnities/<?php echo $c; ?>.jpg" /> 	
															</center>
															 <table  border="0" cellpadding="0" cellspacing="0" > 
															 	<tr> 
															 		<td width="20" > <input type="checkbox" >     </td> <td> <b> cup of tea </b> </td>
															 	<tr> 
															 		<td>  </td> <td> this cup is from china you can use this daily. </td>
															</table>
														</li>
													<?php } ?> 
												</ul>
										 
										</td>
									<tr>
										<td style="background-color:#415e9b; padding:20px;" > 
											<input id="submit" type="submit" value="CANCEL" style="float:right;margin-right:10px;" onclick="alert('cancel room')" />  
						  					<input id="submit"  type="submit" value="SAVE" style="float:right; margin-right:10px;"  onclick="alert('save room')" />  	 
										</td>
								</table>
						</td>
				</table> 


			</td>
		<tr>  
			<td id="uploadamenities-container-footer" >  </td>
	</table> 





</div>