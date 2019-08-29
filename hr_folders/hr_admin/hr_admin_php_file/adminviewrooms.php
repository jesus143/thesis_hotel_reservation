<div id="admin-uploadamenities-container-div" > 




	<table border="0" cellpadding="0" cellspacing="0" > 
		<tr>  	
			<td id="uploadamenities-container-header" > 
					smc reservation 
				<br> 
					 add amenities 
			</td>
		<tr>  
			<td id="uploadamenities-container-body" >   
				<?php for ($i=0; $i <  10 ; $i++) {  ?>
					<table border="0" cellpadding="0" cellspacing="0"  > 
						<tr> 
							<td id="header" > 
									 
							</td>
						<tr>
							<td id="body" >  
								<ul> 
									<li style="width:35%;height:240px;background-color:#fff; " > 
										<center> 
											<img src="hr_folders/hr_images/room/<?php echo rand(1,5); ?>.jpg"   />
										</center>
									</li>
									<li style="width:63%; height:240px;background-color:#fff; border-left: 10px solid #000;" >  
											<div id="room-view-desc" >
											<u> ROOM TYPE: </u> <br> 
											<desc>  FUNCTION HALL </desc><br><br>
											<u> ROOM DESCRIPTION: </u> <br> 
											<desc> THIS ROOM IS FOR THOSE PEOPLE LOVE IN CHEIF THINGS SPECIALLY WHEN THEY ARE TOGETHER IN THEIR LOVE ONCE. </desc><br><br>
											<u> ROOM NUMBER: </u> <br> 
											<desc> 209 </desc><br><br>
											<u> ROOM TOTAL AVAILABLE: </u> <br> 
											<desc> 1 </desc><br><br>
											<u> TOTAL AMENITIES: </u> <br> 
											<desc> 5 </desc><br><br>
										</div> 
									</li> 
									<li style="width:35%;background-color:#415e9b; "  > 
										<center>
											<input style="visibility:hidden" type="submit" value="UPLOAD ( amenities )" onclick="alert('upload amenities')" />
										</center>
									</li>
									<li style="width:63%;background-color:#415e9b; border-left: 10px solid #000; "  > 
						  				<input type="submit" value="UPDATE" style="float:right;margin-right:10px;" onclick="alert('update room')" />  
						  				<input type="submit" value="DELETE" style="float:right; margin-right:10px;"  onclick="alert('delete room')" />  
									</li>
								</ul> 
							</td>
					</table> 
					<br><br>
				<?php } ?>
			</td>
		<tr>  
			<td id="uploadamenities-container-footer" > 3 </td>
	</table> 





</div>