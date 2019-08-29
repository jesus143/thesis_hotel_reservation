<?php 
		/**
		*  thursday dec 26 , 2013 12 am 
		*/ 
		class indexbody extends indexbodyextend {  
			public function retrieve_available_rooms_by_popup_search( $from , $to ) { 
				$dateservedroom = array();

				$time = $this->time( 'yesterday' );
				echo " yesterday is $time <br>";
			 	$reservations = $this->get_uptodate_reservations( $time );
 				




			 	echo " from $from - to $to <br><br>";








 

				// print_r($reservations);
			 	$room_not_available = array();
			 	$c=0;
				for ($i=0; $i < count($reservations) ; $i++) { 
					$c++;
					echo "$c .)";
					echo "check in date ".$reservations[$i]['Check_in_date'].'<br>';
					echo "check out date ".$reservations[$i]['Check_out_date'].'<br>';
				
					$Room_id = $reservations[$i]['Room_id'];
					$Check_in_date  = $reservations[$i]['Check_in_date'];
					$Check_out_date =  $reservations[$i]['Check_out_date']; 

					if ( ($Check_in_date >=  $from and  $Check_in_date <=   $to ) or 
						(  $Check_out_date >= $from and $Check_out_date <=  $to   ) ) {
					 

					 	echo " room number $Room_id already reserved ";
					 	$room_not_available[$i] = $Room_id; 
					}  else{
						echo " searched check in not reserved <br> ";
					} 
					echo "<hr>"; 
				} 


				if ( !empty($room_not_available)) {
					echo "room not available <br>";
					print_r($room_not_available);
				}else{
					echo " all room is available <br>";
				}
				


				/*

				if ($from >= "2014-01-15" and $from <= "2014-01-16" ) {
					echo " room already reserved <br>";
				}else{
					echo " room is not already reserved <br>";
				}
				*/
				






				// $reservations_len = count($reservations);
				// $c=0;
				// for ($i=0; $i < $reservations_len ; $i++) { 
				// 	$c++;
				// 	$dateservedroom[$i] = $reservations[$i]["Room_id"];
				// }  
				return $room_not_available;

			}
			public function retrieve_all_rooms( $type=null) {
				$r = array();
				$room = selectV1(
					'*',
					"room"  
				);  
				if ( !empty($type) ) {
					$room_len = count($room); 
				    for ($i=0; $i < $room_len ; $i++) { 
				    	$r[$i] = $room[$i][$type];
				    }  
					return $r;	
				}else{ 
					return $room;
				} 
			}
			public function retrieve_single_room( $Room_id ) {
				$r = array();
				$room = selectV1(
					'*',
					"room",
					array( "Room_id"=>$Room_id ) 
				);  
				return $room;
			}
			public function change_index_to_counting_numbers( $ra ) {
				$i=0;
			    foreach ($ra as $key => $value ) { 
			    	// echo "$key => $value <br>"; 
			    	$ra1[$i] = $value;
			    	$i++;

			    }
			    return $ra1;
			} 
		} 
		class  indexbodyextend {  
			public function time( $get ) {
				if ( $get=='yesterday' ) {
					 $time = date("Y-m-d", time() - 86400);
				}else if( $get=='today' ){
					$time = date("Y-m-d");
				}else if( $get=='tomorrow' ) {
					$time = date("Y-m-d", time() + 86400);
				}
				return $time;
			}
			public function get_uptodate_reservations( $time ) {  
				$tablename = 'reservation_line';
				$rowname = 'Check_in_date'; 
				// $Q = "SELECT * FROM reservation_line WHERE  Check_in_date > '$time' "; 
				$Q = "SELECT * FROM $tablename WHERE  $rowname > '$time' "; 
				$q = mysql_query($Q);   
				$c=0;
				while ( $r = mysql_fetch_array($q) ) { 
					foreach ($r as $key => $value) {
						 // echo "$key => $value <br>";
						 $uptodateReservation[$c][$key] = $value;
					}
					$c++;
				} 
				return $uptodateReservation;
			} 
		}  







		$ib = new indexbody();  
		if ( !empty($_GET['search'] ) ) {
			#field search
			$indexhome_action = "field search";
			$search = $_GET['search'];
			$room = selectV1(
				'*',
				"room",
				null,
				null,
				null,
				array(
					"rowName"=>"Room_type",
					"keySearch"=>$search
				)
			);  
			$troom = count($room);  
			echo "via seach ";
		}else if ( isset($_GET['popup-search']) ){ 
			#popup seach
			$indexhome_action = "popup search";
			

			$troom = 0;  
			$from  = $_GET['from'];
			$to    = $_GET['to'];   
			$from  = $mc->convert_textdateformat_to_dbdateformat ( $from ); 
	 		$to    = $mc->convert_textdateformat_to_dbdateformat ( $to );   
		 	$rr    = $ib->retrieve_available_rooms_by_popup_search( $from , $to ); 
		    $room  = $ib->retrieve_all_rooms( "Room_id" );   

		    $rooms_available = array_diff($room, $rr); // remove existing reserved rooms in the current covered search date.
		    

		    $ra = $ib->change_index_to_counting_numbers( $rooms_available ); 

		    $troom = count($ra); 


		    /*
			    echo "all rooms <br> ";
			    print_r($room);
			    echo "<br> all not available rooms <br> ";
			    print_r($rr);
			    echo "<br> all available rooms <br> ";
			    print_r($ra);
			*/





			// echo " via popup search $from - $to <br> ";   
		}else{
			#home initialized
			$indexhome_action = "home initialize";
			// echo " initialize"; 
			$search=null; 
			$room = $ib->retrieve_all_rooms( null ); 
			$troom = count($room);
		}   

?>   
<table id='hr_body_content-table' border="0" cellpadding="0" cellspacing="0" >  
	<?php  
		$rnum = 0;  
		for ($i=0; $i < $troom  ; $i++) {   
			if ( $indexhome_action == "popup search" ) {
				// echo " popup search ";
			 	$Room_id = $ra[$i];
			 	// echo " room idssss = $Room_id <br><br><br><br> ";
			 	$room    =  $ib->retrieve_single_room( $Room_id );  
			 	$rnum = $room[0]['Room_id'];
				$room_desc = $room[0]['room_desc'];
				$Room_type = $room[0]['Room_type']; 
				$room_title = " This is the delux room !  ";   
			}else{ 
				$rnum = $room[$i]['Room_id'];
				$room_desc = $room[$i]['room_desc'];
				$Room_type = $room[$i]['Room_type']; 
				$room_title = " This is the delux room !  ";    
			}  
			?>
			<tr>  
				<td>  
					<div id="line_separator">  </div>
					<ul> 
						<li id='body-room'>    
							<div id="room_img"> 
								<a href="reservation.php?rnum=<?php echo "$rnum"; ?>&#header-logo-nav">
									<img   src="hr_folders/hr_images/<?php echo "$rnum"; ?>.jpg">
								</a>
							</div>  
						</li>
						<li id='body-desc' > 
							<span id="room_title" > <?php echo $Room_type ; ?>  </span>
							<br><br>
							<span id="room_desc" > <?php echo $room_desc ; ?> </span> 
							<div> 
							 	<a href="reservation.php?rnum=<?php echo "$rnum"; ?>&#header-logo-nav">
							 		<input type="button" value="View Room" /> 
							 	</a>  				
							</div> 
						</li>  
					</ul>  
				</td>
			<tr><?php  
		} 
	?> 
</table>