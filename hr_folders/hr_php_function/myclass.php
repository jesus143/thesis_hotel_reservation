<?php
	/*
		Date Created: jan 20 2012. 
	*/
 
	/* 
		1.) php mailer: http://www.computersneaker.com/send-email-using-phpmailer/
		2.) 
	*/ 

	class myclass
	{   
		public function connect( $dbName , $user=null , $pass=null) { 
			date_default_timezone_set('America/Los_Angeles');  
			if ($_SERVER['HTTP_HOST'] == 'localhost') 
		 	{
		 		// echo "local connect ";
		 		// mysql_connect("localhost","root","replacement") or die(mysql_error()); Nnetbook
		 		$con = mysql_connect("localhost",$user,$pass) or die(mysql_error()); //laptop
		 	 	 
		 		if ( $con  ) 
		 		{
		 		 	// echo " connected to localhost <br>"; 
		 		}
		 		else 
		 		{ 
		 			// echo " not connected to localhost <br>";
		 		}
		 	}
		 	else
		 	{  
		 		// echo "online connect";
		 		$user = "ricopeco_jesus7";
		 		$pass = "Q?l-tpVNV)v+";
				$dbName = "ricopeco_smc_hotel_reservation"; 
		 	   mysql_connect("localhost" , $user , $pass ) or die(mysql_error());  
		 	}   

			$dbConn = mysql_select_db($dbName) or die("No Connection.. "); //fs 
		 	if ( $dbConn ) 
		 	{ 
		 		// echo "connected to $dbName <br> ";
		 	}
		 	else  
		 	{
		 		// echo "not connected to $dbName <br> ";
		 	} 
		}
		public function date_difference() {  
				   $date_time = '';   
		         $this->today = mktime(0,0,0,date("m"),date("d")-1,date("Y"));
			     $this->today = date("Y-m-d", $this->today);
			 $this->last_week = mktime(0,0,0,date("m"),date("d")-8,date("Y"));
			 $this->last_week = date("Y-m-d", $this->last_week);
			$this->last_month = mktime(0,0,0,date("m")-1,date("d"),date("Y"));
			$this->last_month = date("Y-m-d", $this->last_month);
			 $this->last_year = mktime(0,0,0,date("m"),date("d"),date("Y")-1);
			 $this->last_year = date("Y-m-d", $this->last_year);
			$this->date_time  = date("Y-m-d H:i:s"); 

			$this->date_dif = array(
			        'today' => $this->today, 
			        // 'today' => '2013-03-28', 
		        'last_week' => $this->last_week, 
			   'last_month' => $this->last_month, 
			    'last_year' => $this->last_year,
			    'date_time' => $date_time 
			);
			return $this->date_dif;
		}
		public function split_date($year=null,$month=null,$day=null,$date_time=null,$date=null) {
			

			if (!empty($date_time)) {
				// echo $date_time;	
				$year = substr($date_time,0,4);
				$month = substr($date_time,5,2);
				$day = substr($date_time,8,2);
				$hour = substr($date_time,11,2);
				$min = substr($date_time,14,2);
				$sec = substr($date_time,17,2);

				 $date_format = array(
				 	'year'=>$year,
				 	'month'=>strtoupper(get_month_name($month)),
				 	'day'=>$day,
				 	'hour'=>conver_time24_to12($hour),
				 	'min'=>$min,
				 	'sec'=>$sec,
				 	'stat'=>strtoupper(get_time_stat($hour))
				 );
				 return $date_format;
			}
		}


		public function posted_look_info( $plno ) {

			// echo "$plno";

			// $this->postedlooks = array();	
			// echo "plno here in class  = $plno ";			
			     $plook  = select('postedlooks',9,array('plno',$plno));

			     // $pltags  = select('fs_pltag',11,array('plno',$plno),);
			     $pltags=selectV1(
			     	'*',
				 	"fs_pltag", 
				 	array('plno'=>$plno),
			        'order by pltgno asc'
				);

			 //      $res = selectV1(
			 // 	'invited_genCode',
			 // 	'fs_invited',
			 // 	array('invited_email'=>$invited_email) 
			 // );
   




			    // $prates    = select('ratings',4,array('plno',$plno));
			    // $ploves    = select('pl_loves',3,array('plno',$plno));
			    // $pdrips    = select('pl_drips',3,array('plno',$plno));
			    // $pcomments = select('posted_looks_comments',5,array('plno',$plno));
			    $powner    = selectV1(
								'firstname,lastname,middlename',
								'fs_members',
								array('mno' =>intval($plook[0][1]))
							);
			   $lookOwnerName = $powner[0]['firstname'].' '.$powner[0]['lastname'].' '.$powner[0]['middlename'];

			  // print_r($pltags);
			   // print_r($powner);
			   // echo "full name = ". $lookOwnerName;

			 
			$this->postedlooks = array(
			   'lookOwnerName' =>  $lookOwnerName,
					    'plno' =>  $plook[0][0], 
				         'mno' =>  $plook[0][1], 
				       'date_' =>  $plook[0][2], 
				    'lookName' =>  $plook[0][3],   
				   'lookAbout' =>  $plook[0][4],
				    'occasion' =>  $plook[0][5], 
				    'season'   =>  $plook[0][6], 
				      'style'  =>  $plook[0][7],
				      'tlview' =>  $plook[0][8],
				      'pltags' =>  $pltags,
				  //    'tlrates' =>  $this->cout_array($prates),
				  // 'tlrpercent' =>  $this->calculate_rate($plno),
			   // 	     'tldrips' =>  $this->cout_array($pdrips),
				 	//   'tllove' =>  $this->cout_array($ploves),
			   //    'tlcomments' =>  count_lcomment_reply($plno),
			 );
			return $this->postedlooks;
		}
		public function user($mno) { 

						  $dates = $this->date_difference(); 
				  $this->mem_acc = select('fs_member_accounts',5,array('mno',$mno));
				$this->mem_pinfo = select('fs_members',32,array('mno',$mno));
				 $this->followme = select('friends',4,array('mno2',$mno));
				  $this->Ifollow = select('friends',4,array('mno1',$mno));
				   $this->tplook = select('postedlooks',7,array('mno',$mno));
				 $this->oarating = select('postedlooks',7,array('mno',$mno));
				 	  $date_attr = get_date_attr();
				 	   $cyr_mnth = "$date_attr[yr]-$date_attr[mnth]";
				 	  
			 	
				 	  if ($this->mem_pinfo[0][4]=='male') {
				 	  	$sub_gen='he';
				 	  }
				 	  if ($this->mem_pinfo[0][4]=='female') {
				 	  	$sub_gen='she';
				 	  }

						$this->mem_info = array(
								 'mano' => $this->mem_acc[0][0], 
								  'mno' => $this->mem_acc[0][1], 
								'email' => $this->mem_acc[0][2], 
						     'username' => $this->mem_acc[0][3], 
								 'pass' => $this->mem_acc[0][4],
						    'firstname' => $this->mem_pinfo[0][3],
						   'middlename' => $this->mem_pinfo[0][2],
							 'lastname' => $this->mem_pinfo[0][1],
							   'gender' => $this->mem_pinfo[0][4],
							   'sub_gen' => $sub_gen,
							  'website' => $this->mem_pinfo[0][5],
							    'bdate' => $this->mem_pinfo[0][6],
						   'occupation' => $this->mem_pinfo[0][7],
					  'preffered_style' => $this->mem_pinfo[0][8],
							  'country' => $this->mem_pinfo[0][9],
							   'state_' => $this->mem_pinfo[0][10],
								 'city' => $this->mem_pinfo[0][11],
								  'zip' => $this->mem_pinfo[0][12],
							  'blogdom' => $this->mem_pinfo[0][13],
							    'about' => $this->mem_pinfo[0][14],
							 'ispicset' => $this->mem_pinfo[0][15],
								 'fbid' => $this->mem_pinfo[0][16],
							   'tplook' => $this->cout_array($this->tplook), 
							'tfollowers'=> $this->cout_array($this->followme),
							'tfollowed' => $this->cout_array($this->Ifollow),
							   'tlogin' => 'unavailable',
							 'oarating' => $this->coarates($this->oarating),
							'tcomments' => 'unavailable',
								'tlike' => 'unavailable',
								'tlove' => '1',
								'tdrip' => '1',
						  'tlookviewed' => 'unavailable',
					 		'tcomments' => 'unavailable',
					    'oarating_week' => 'unavailable',
					   'oarating_month' => 'unavailable',
				   'oalratng_all_times' => 'unavailable',
				    'rated_look_cmonth' => get_rated_look($mno,$date_attr['mnth'],$date_attr['yr']),
			    'not_rated_look_cmonth' => get_not_rated_look($mno,$date_attr['mnth'],$date_attr['yr']),
					   'have_rated_look'=> get_rated_look($mno),
			          'all_look_cmonth' => all_look_upl_current_month(date($cyr_mnth)),
		 		'top_rated_look_cmonth' => top_rated_look($cyr_mnth),
					      'newest_look' => newest_look($cyr_mnth), 
					      'oldest_look' => oldest_look($cyr_mnth), 
				           'datemember' => $this->mem_pinfo[0][31]
				);
			return $this->mem_info;
		}
		public function top_member(){

			    $dates = $this->date_difference();
 			 	if (empty($_SESSION['show'])) {
 			 		$_SESSION['show']='today';
 			 	}
			    if($_SESSION['show']=='today'){ 
			  		$luptoday = select1_wop(
			  			'postedlooks',
			  			7,
			  			array('date_',$dates['today']),
			  			'>'
			  		);
			  	    $tmtoday = $this->calc_topmember($luptoday,'today');
			  	    $this->top_members = $tmtoday;
			    }
			    if($_SESSION['show']=='week'){ 
			  	 	$lupweek = select1_wop('postedlooks',7,array('date_',$dates['last_week']),'>');
			  		$tmweek = $this->calc_topmember($lupweek,'last_week');
			  		$this->top_members = $tmweek;
			    }
			    if($_SESSION['show']=='month'){ 
			  		$lupmonth = select1_wop('postedlooks',7,array('date_',$dates['last_month']),'>');
			  		$tmmonth = $this->calc_topmember($lupmonth,'last_month');
			  		$this->top_members = $tmmonth;
			    }
			    if($_SESSION['show']=='year'){ 	
			    	$lupyear = select1_wop('postedlooks',7,array('date_',$dates['last_year']),'>');
			  		$tmyear = $this->calc_topmember($lupyear,'last_year');
			  		$this->top_members = $tmyear;
			    }
			    if ($_SESSION['show']=='all') {
			    	$lupall = select('postedlooks',7);
			    	$tmall = $this->calc_topmember($lupall,'all');
			    	$this->top_members = $tmall;
			    }
		   	return $this->top_members;
		}
		public function getTmaxrating($luploaded,$date){ 
			$dates = $this->date_difference();
			$c=0;
			// echo "date is  $dates[today] and $date <br>";
			if (!empty($luploaded)) {
				for ($i=0; $i < count($luploaded) ; $i++) { 
				 	$user_lup[$i]=$luploaded[$i][1];
				}

				$mnos=remove_duplicate($user_lup);
				for ($i=0; $i < count($mnos); $i++) { 
					if ($date == 'all') {
						// echo "i	nside all ";
						$ovarating = select('postedlooks',7,array('mno',$mnos[$i]));
					}else{ 
						// echo "el	se  not all ";
						$ovarating=select2_wop(
							'postedlooks',
							7,
							array('mno',$mnos[$i],'date_',$dates[$date]),
							array('=','and','>')
						);
					}			
					if (!empty($ovarating)) {
						 $rate=$this->highest_rate($ovarating);
						 $c++;
						 $trate[$c] = $rate;
					 }else{ 
					 	// echo "no uploaded look..";
					 }
			    }
			  return max($trate);
			}
		}
		public function calc_topmember($luploaded,$date){
			$dates = $this->date_difference();
			$c=0;
			$tmaxrate=$this->getTmaxrating($luploaded,$date); # get overall max rate
			// echo "<br>max total  rate is <br>".$tmaxrate."<br>";
			if (!empty($luploaded)) {
				for ($i=0; $i < count($luploaded) ; $i++) { 
				 	$user_lup[$i]=$luploaded[$i][1];
				}
				$mnos=remove_duplicate($user_lup);
				for ($i=0; $i < count($mnos); $i++) { 

					if ($date == 'all') {
						$userLookUploaded = select('postedlooks',7,array('mno',$mnos[$i]));
					}else{ 
						$userLookUploaded=select2_wop(
							'postedlooks',
							7,
							array('mno',intval($mnos[$i]),'date_',$dates[$date]),
							array('=','and','>')
						);
					}			
					if (!empty($userLookUploaded)) {
						 // $rate=$this->highest_rate($userLookUploaded);
						 $c++;
						 $trate[$c] = $rate;
						 $tminfo[$i][0] = $mnos[$i]; 
 
						 $ovrates = $this->coarates_top($userLookUploaded,$tmaxrate);
						 for ($j=0; $j < count($ovrates); $j++) { 
						 	$tminfo[$i][$j+1] = $ovrates[$j];
						 	# mno , rpercent , tpoints , trating.
						 }
					 }else{ 
					 	#  no uploaded look.
					 }
			    }
			    $tmfinfo = $this->descending_order2($tminfo);
			    // echo "after descending <br>";
			    // print_r($tmfinfo);
			    return $tmfinfo;
		   	}

		}		
		public function test()
		{
			echo "test";
		}
		public function coarates_top($userLookUploaded,$hrate){
			if (!empty($userLookUploaded)) {
				$sum=0;
				$hrate*=5;
				$trate=0;
				// echo "highest rate in top is $hrate <br>";
				for ($i=0; $i <count($userLookUploaded) ; $i++) { 
					 $plratings=select('ratings',4,array('plno',$userLookUploaded[$i][0]));
					 for ($j=0; $j < count($plratings) ; $j++) { 
						$sum+=$plratings[$j][3];
						// echo "string";
						$trate++;
					 }	
				}
				if ($sum != 0 and $hrate != 0 ) {
					    $rating = ($sum / $hrate) * 100;
					$ovrates[0] = intval($rating); 
					$ovrates[1] = $sum; 
					$ovrates[2] = $trate; 
					return $ovrates;
				}else{ 
					$ovrates[0] = 0;
					$ovrates[1] = 0;
					$ovrates[2] = 0;
					return $ovrates; # no rating happen.
				}
			}else{
				return "0";
			}
		} 
		public function highest_rate($oarating){ 
			$c=0;
			for ($i=0; $i <count($oarating) ; $i++) { 
				$plratings=select('ratings',4,array('plno',$oarating[$i][0]));
				for ($j=0; $j < count($plratings) ; $j++) { 
					if (!empty($plratings[$j][3])) {
						$c++;
						$this->sum+=$plratings[$j][3];
					} 
				}	
			}
			// echo "<br> sum = $sum total =  $c <br>";
			return $c;
		}
		public function asceding_order1($int_array){ 
		}
		public function asceding_order2($int_array){ 
		}
		public function descending_order2($int_array){ 		
			for ($i=0; $i < count($int_array) ; $i++) { 
				for ($j=$i+1; $j < count($int_array) ; $j++) { 
					 if ($int_array[$i][1] < $int_array[$j][1] ) {
					 	for ($h=0; $h < count($int_array[0]); $h++) { 
					 	               $sub = $int_array[$i][$h];
					 	 $int_array[$i][$h] = $int_array[$j][$h];
					 	 $int_array[$j][$h] = $sub;
					 	}
					 }
				}
			}
			return $int_array;
		}
		public function decending_order1($int_array){ 
		}
		function delete(){ 
			if (!empty($this->del_rate)) {
				delete('ratings',array('plno',$this->del_rate));
			}else{ 
				// echo "can't delete plno $this->del_rate <br>";
			}
		}
		public function coarates($oarating){
			if (!empty($oarating)) {
				$c=0;
				$sum=0;
				for ($i=0; $i <count($oarating) ; $i++) { 
					 $this->plratings=select('ratings',4,array('plno',$oarating[$i][0]));
					 for ($j=0; $j < count($this->plratings) ; $j++) { 
						$c++;
						$sum+=$this->plratings[$j][3];
					 }	
				}
				$c*=5;
				$ovrates = ($sum / $c) * 100;
				return intval($ovrates);
			}else{
				return "0";
			}
		} 
		public function calculate_rate($plno){ 
			$prates=select('ratings',4,array('plno',$plno));
			if (!empty($prates)) {
				$trate=count($prates);
				for ($i=0; $i < count($prates) ; $i++) { 
				     	$r= $prates[$i][3];
				 	$tsum+= $r;
				} 
				$overall=$trate*5;
				$res = ($tsum / $overall) * 100;
				return intval($res);
			}
			else{ 
				return 0;
			}
		}
		public function cout_array($str_array){
			if (empty($str_array)) {
				return 0;
			}else{
				 return count($str_array);
			}
		}
		public function get_mno_by_mail($mail){
			 $this->mno = select('fs_member_accounts',5,array('email',$mail));
			$this->mno1 = $this->mno[0][1];
 			return  $this->mno1;
		} 
		public function go($link){ 

			echo "<script type='text/javascript'>document.location='$link'</script>";
		}
		public function url_redirect_to_no_www($actual_link){ 
			if(strpos($actual_link,'www')){ 
				#with www 
				$this->go(str_replace('www.','',$actual_link));	
			}else{ 
				# no www
			}
		}
		public function get_mnobyusername($username){
			$id=select('fs_member_accounts',5,array('username',$username));		
			return $id[0][1];
		}
		public function whobyid($mno){
			$minfo=select('fs_members',5,array('mno',$mno));
			$fullname=$minfo[0][1]." ".$minfo[0][3];
			if (!empty($minfo[0][1])) {
				return $fullname;
			}else{ 
				return 0;
			}
		}
		public function user_profile_percentage($mno){ 
			// $mno=$this->get_mnobyusername($username);
			$lupall = select('postedlooks',7);
			$mnoLup = select('postedlooks',7,array('mno',$mno));
			$max_rating=$this->getTmaxrating($lupall,'all');
			$ovarating=$this->coarates_top($mnoLup,$max_rating);
			return $ovarating[0];
		}
		public function whobyusername(){}
		public function whobyfirstname(){}
		public function whobylastname(){}
		public function whobyemail(){}

		public function get_all_user( $limit=null )
		{
			$mem = "";
			
			if ($limit==null) 
			{
				$limit = '*';
			}
			$mem=selectV1(
				'mno,firstname,lastname,middlename,occupation,country,city,aboutme,datejoined',
				'fs_members',
				'',
				' order by mno desc',
				"limit $limit"
			);
			return $mem;
		}



		public function get_all_postedarticle( $limit=null )
		{
			$res = "";
			 
			$res=selectV1(
				'*',
				'fs_postedarticles',
				'',
				' order by article_Id desc',
				"limit $limit"
			);
			return $res;
		}
		public function get_all_postedmedia( $limit=null )
		{
			$res = "";
			 
			$res=selectV1(
				'*',
				'fs_postedmedia',
				'',
				' order by media_id desc',
				"limit $limit"
			);
			return $res;
		}






		public function convert_date_format_profile ($date) 
		{ 
			// echo "$date";
 
			$date = explode('-',$date);
			return $date[1].'-'.$date[2].'-'.substr($date[0],2,2);
		}
		public function get_activity( $limit=null ) 
		{ 
			if ($limit == null) 
			{
				$limit = null;
			}

			$act=selectV1(
				'*',
				'activity',
				'',
				'order by ano desc',
				"limit $limit"

				 
			);
			return $act;
		}
		public function get_full_name_by_id($mno)
		{ 
			$mem=selectV1(
				'firstname,lastname,middlename',
				'fs_members',
				 array('mno'=>$mno)
			);
			return $mem[0]['firstname'].' '.$mem[0]['lastname'].' '.$mem[0]['middlename'];
		} 
		public function get_full_name_by_look_id($plno)
		{ 
			$mno=selectV1(
				'mno',
				'postedlooks',
				 array('plno'=>$plno)
			);
			// echo " mno= $mno ";
			return $this->get_full_name_by_id($mno[0]['mno']);
		} 

		public function get_all_latest_look( $limit=null )
		{
			if ($limit == null ) 
			{
				$limit='*';
			}
			
			$all_look=selectV1(
				'*',
				'postedlooks',
				'',
				' order by plno desc',
				'limit 100'

			);
			return $all_look;
		}
		public function get_user_info_by_id($mno)
		{ 
			if ( is_int($mno)) 
			{
				$mem=selectV1(
					'mno,firstname,lastname,middlename,occupation,country,city,aboutme,datejoined',
					'fs_members',
					array('mno'=>$mno),
					'',
					' order by mno desc'
				);
				return $mem; 
			}
			else 
			{  
				return "sorry , mno is not intiger $mno <br>";
			}
			
		}
		public function auto_detect_path() 
		{ 
			// if ($_SERVER['HTTP_HOST'] == 'localhost') 
			// {
				#path (display)
					$this->ppic_mem                = 'fs_folders/images/uploads/members';
					$this->look_folder             = 'fs_folders/images/uploads/posted looks/original looks uploaded';
					$this->look_folder_home        = 'fs_folders/images/uploads/posted looks/home';
					$this->look_folder_lookdetails = 'fs_folders/images/uploads/posted looks/lookdetails';
					$this->look_folder_thumbnail   = 'fs_folders/images/uploads/posted looks/thumbnail';
				
 



				#unlink (delete)
				 	$this->unlink_look             = "../../../../$this->look_folder";
				 	$this->unlink_look_home        = "../../../../$this->look_folder_home";
				 	$this->unlink_look_lookdetails = "../../../../$this->look_folder_lookdetails";
				 	$this->unlink_look_thumbnail   = "../../../../$this->look_folder_thumbnail";


			// }
			// else
			// {    

				// new fs betatestnew 
					/*
						#path (display)
							$this->ppic_mem                = '../betatest/images/members';
							$this->look_folder             = '../betatest/images/members/posted looks';
							$this->look_folder_home        = '../betatest/images/members/posted looks/home';
							$this->look_folder_lookdetails = '../betatest/images/members/posted looks/lookdetails';
							$this->look_folder_thumbnail   = '../betatest/images/members/posted looks/thumbnail';

						#unlink (delete)
						 	$this->unlink_look             = "../../../../$this->look_folder";
						 	$this->unlink_look_home        = "../../../../$this->look_folder_home";
						 	$this->unlink_look_lookdetails = "../../../../$this->look_folder_lookdetails";
						 	$this->unlink_look_thumbnail   = "../../../../$this->look_folder_thumbnail";
					*/
				// end fs betatestnew 


						 	/*
				// new swag aplhatest
					#path (display)
						 	
						$this->ppic_mem                = '../ss/images/members';
						$this->look_folder             = '../ss/images/members/posted looks';
						$this->look_folder_home        = '../ss/images/members/posted looks/home';
						$this->look_folder_lookdetails = '../ss/images/members/posted looks/lookdetails';
						$this->look_folder_thumbnail   = '../ss/images/members/posted looks/thumbnail';

					#unlink (delete)
					 	$this->unlink_look             = "../../../../$this->look_folder";
					 	$this->unlink_look_home        = "../../../../$this->look_folder_home";
					 	$this->unlink_look_lookdetails = "../../../../$this->look_folder_lookdetails";
					 	$this->unlink_look_thumbnail   = "../../../../$this->look_folder_thumbnail";
				// end fs betatestnew 					 	
				// end swag alphatest
					*/


				#path (display)
					// $this->ppic_mem                = 'fs_folders/images/uploads/members';
					// $this->look_folder             = 'fs_folders/images/uploads/posted looks/original looks uploaded';
					// $this->look_folder_home        = 'fs_folders/images/uploads/posted looks/home';
					// $this->look_folder_lookdetails = 'fs_folders/images/uploads/posted looks/lookdetails';
					// $this->look_folder_thumbnail   = 'fs_folders/images/uploads/posted looks/thumbnail';
				
 



				#unlink (delete)
				 	// $this->unlink_look             = "../../../../$this->look_folder";
				 	// $this->unlink_look_home        = "../../../../$this->look_folder_home";
				 	// $this->unlink_look_lookdetails = "../../../../$this->look_folder_lookdetails";
				 	// $this->unlink_look_thumbnail   = "../../../../$this->look_folder_thumbnail";


			// }
			$this->img_attr_source = 'fs_folders/fs_lookdetails/look_comment_items/img';
			$this->path_icons = 'fs_folders/images/icons';
			$this->genImgs = 'fs_folders/images/genImg/';
			$this->button = 'fs_folders/images/buttons';

		}

		public function next_prev_comments($res_len) 
		{ 
			$rl = $res_len;
			$i = 1;
			$loopEnd = true;
			echo "<span id='comment_prev'> < </span> ";
			echo "<span id='comment_number'>";
			while ($loopEnd) 
			{
				if ( $rl > 10 ) 
				{
					 $rl -= 10; 
					 $loopEnd = true;
					 echo " [$i] ";
				}
				else 
				{ 
					$loopEnd = false;
					 echo " [$i] ";
				} 
				$i++;
			} 
			echo "</span>";
			echo "<span id='comment_next' > next > </span>";
		}
		public function unflagged_design_auto_hide($infoArray) 
		{ 
			$mem=selectV1(
				'*',
				$infoArray['table'],
				array($infoArray['where']=>$infoArray['whereV'])
			);
			
 

			if (!empty($mem))  
			{ 
				#if na flagged na
				$this->flaggedStyle = 'display:block'; 
				$this->notflaggedStyle = 'display:none';  
			}
			else 
			{  
				#wala pa na flagged
				$this->flaggedStyle = 'display:none';  
				$this->notflaggedStyle = 'display:block'; 
			}

		}
	 

		public function get_multiple_reply( $plcr_no ) 
		{ 	

			echo "delete_multiple_reply( $plcr_no ) ";

			$delr_array[0] = $plcr_no;
			$this->deleting_comment_reply( $plcr_no );
			for ($i=1; $i < 10000000 ; $i++) 
			{ 

				if ( !empty($plcr_no)) 
				{
					// echo "<hr>  plcr_no = $plcr_no <br>";
					$res = $this->get_reply_replied( 'plcr_no' , 'fs_plcm_reply' , $plcr_no );


					print_r($res);
					for ($i=0; $i < count($res) ; $i++) 
					{ 
						$plcr_no = $res[$i]['plcr_no'];	 
						$this->deleting_comment_reply( $plcr_no );
					}
					echo "total solod =".count($res).'<br>';

					if (!empty($plcr_no))
					{
						$delr_array[$i] = $plcr_no;
					}
					else 
					{ 
						$i=10000000;
					}

				}
				else 
				{ 
					$i=10000000;
				}
				
			}
			return $delr_array;
		}


		public function get_reply_replied( $select , $tableName , $plcr_no ) 
		{ 
			 $res = selectV1(
			 	$select,
			 	$tableName,
			 	array('replied_no'=>$plcr_no) 
			 );

			 return $res;
		}
		public function deleting_comment_reply( $plcrno ) { 

			echo " deleting_comment_reply( $plcrno ) ";


			$rlike = delete('fs_plcm_rlike',array('plcrno',$plcrno));
			$rflag = delete('fs_plcm_rflag',array('plcrno',$plcrno));
			$reply = delete('fs_plcm_reply',array('plcr_no',$plcrno));
			$rdislike = delete('fs_plcm_rdislike',array('plcrno',$plcrno));

			if ($rlike) 
				echo "<br> 1. ) reply like successfully deleted <br> ";
			if ( $rflag ) 
			 	echo " 2. ) reply flagged successfully deleted <br> ";
			if ( $reply ) 
			 	echo " 3. ) replied comment successfully deleted  <br> ";
			if ( $rdislike )
			 	echo " 4. ) reply dislike successfully deleted  <br> ";
		 
		}
		public function get_total($select,$tableName,$w,$wV)
		{
			 $res = selectV1(
			 	$select,
			 	$tableName,
			 	array($w=>$wV) 
			 );

			 return count($res);
		}
		public function automatic_insert($tadd)
		{
			echo " total activty".count($this->get_activity());
			for ($i=0; $i < $tadd ; $i++)  
			{ 
				 
				// echo "lool";
				$all_user = $this->get_all_user();
				$action = array('Posted','Rated');
				$all_llok = $this->get_all_latest_look();
				// echo "Total activity = ".count($all_llok); 
				// print_r($all_llok);
				  insert(
				  		"activity", 
				  		array('mno','action','_table','_table_id','_date'), 
				  		array( $all_user[rand(0, count($all_user))]['mno'],$action[rand(0,1)],'postedlooks' , $all_llok[rand(0,count($all_llok))]['plno'],'2013-08-07 17:39:41'),
				  		'ano'
				  );
			}
		}
		public function insert_invited( $invited_fn , $invited_ln , $invited_email , $invited_wob , $invited_occu , $invited_style , $invited_offer )
		{
			$invited_genCode = $this->get_Generated_code();
			$this->date_difference();
			// echo "gENERATED CODE = $invited_genCode";
			  
			$email = selectV1(
			 	'invited_email',
			 	'fs_invited',
			 	array('invited_email'=>$invited_email) 
			 );

		    //      echo " $invited_fn , 
						// $invited_ln , 
						// $invited_email , 
						// $invited_wob , 
						// $invited_occu , 
						// $invited_style , 
						// $invited_offer , 
						// $invited_genCode , 
						// $_SERVER[REMOTE_ADDR] ,  
						// $this->date_time 

						// ";


			// print_r($email);
			// $checkEmailExist = $email[0]['invited_email'];



			// echo " email $checkEmailExist ";
			if (empty($email))
			{ 
				// echo " email not exist ";
				insert(
					"fs_invited", 
					array( 
						'invited_fn' , 
						'invited_ln' , 
						'invited_email' , 
						'invited_wob' , 
						'invited_occu' , 
						'invited_style', 
						'invited_offer' , 
						'invited_genCode' , 
						'invited_ip' , 
						'invited_date' 
					), 
					array( 
						$invited_fn , 
						$invited_ln , 
						$invited_email , 
						$invited_wob , 
						$invited_occu , 
						$invited_style , 
						$invited_offer , 
						$invited_genCode , 
						$_SERVER["REMOTE_ADDR"] ,  
						$this->date_time 
					),
					'invited_id'
				);
			}
			else 
			{ 
				// echo "email  exist";
			}
			
		}
		public function invite_popUp($response_text , $invited_fn)
		{



			if ($response_text) 
			{
				
				// $this->Tpeopl_in_front = count($mem);
				// $this->Tpeopl_in_front += 5034;
				// $this->people_behind_you = rand(50,100); 

					echo "
					<div id='invite_after_submit'>
						<center>
							<div id='as_mesge_contaner'> 	

									<center><img src='fs_folders/images/logo/large-blue-logo.png'></center>			 
									
									<p> 
										 Hi  <span>".ucfirst($invited_fn).",</span>   
									</p>  
									<p> 
										Thank you for signing up for an invite. 
									</p> 
									<p> 
										Please go and check your email for the welcome message I just sent you. If you don't see it in
										your inbox check your spam folder.
									</p>

									<p> 
										There are <span id='bold_red'> ".$this->Tpeopl_in_front." </span> people ahead of you and <span id='bold_red'> ".$this->people_behind_you." </span> people behind you. Once we start sending out 
										invitations to join, you will receive your invite in the order you signed up.
									</p> 
									<p> 
								       If you know of anyone who would love to get their place in line next to you, send them an invite 
								       now by clicking the share buttons below.
									</p> 
									<p>
										Thanks, 
									</p>  
									<p>
										<span>
											Maurico - Founder & Creative Director <br>
											\"Don't Just Dress. Dress Well.&#153;\"
										</span>
									</p>
									<div id='inviteFriendsC' > 
										<div id='invite_ur_friends' >  
											<span>
										 		INVITE YOUR FRIENDS
										 	</span>
										</div> 
										
										<hr id='hline' >
										<table border='0' cellspacing='0' cellspadding='0' > 
										 	<tr>";
										   echo"<td>"; $this->button_api_twitter(); echo"</td>";
										   echo"<td style='padding-right:3px;padding-top:5px;' >"; $this->button_api_google();  echo "</td> ";
										   echo"<td>"; $this->button_api_facebook(); echo"</td>
										</table> 
										<br><br> <br> 
										<input id='ok_submitted' type='button' value='OK' onClick='Go(\"home\")'   > 
									</div> 
							</div>

						</center>
					</div>
				";	
			}
		}
		public function get_Generated_code( )
		{
			 	
			$gendDate = date (time());
			$randNum1 = rand(100000,9000000);
			$randNum2 = rand(100000,9000000);
			$randNum3 = rand(100000,9000000);
			$randNum4 = rand(100000,9000000);
			$randNum5 = rand(100000,9000000);
			$randNum6 = rand(100000,9000000);


			$genCode = $gendDate.$randNum1.$randNum2.$randNum3.$randNum4.$randNum5.$randNum6;

			// echo " genCode = $genCode <br>";
			return $genCode;
		}
		public function send_email_to_admin( $invited_fn , $invited_ln , $invited_email , $invited_wob , $invited_occu , $invited_style , $invited_offer )
		{
			// $to = "info@fashionsponge.com";
			// $to = "mrjesuserwinsuarez@.gmail.com";
			$subject = "FashionSponge - Sign Up For Beta";
			$fullName = $invited_fn;
			$ipi = $_SERVER["REMOTE_ADDR"];
		

			$body = "\n\nFull Name: ".$fullName.
			"\nEmail: ".$invited_email.
			"\nWebsite: ".$invited_wob.
			"\nOccupation: ".$invited_occu.
			"\nStyle: ".$invited_style.
			"\nRequested Offer: ".$invited_offer.
			"\nIP Address: ".$ipi;

			$mauricio = mail('info@fashionsponge.com', $subject, $body, "From: $invited_email"); 
			$jesus  = mail('mrjesuserwinsuarez@gmail.com', $subject, $body, "From: $invited_email"); 
		}
		public function send_email_to_user( $invited_fn , $invited_ln , $invited_email , $invited_wob , $invited_occu , $invited_style , $invited_offer  )
		{

			$mem=selectV1(
					'invited_id',
					'fs_invited'
				);
			$tinvited = count($mem);
			
			if ( $tinvited > 1299 ) 
			{
				$this->Tpeopl_in_front = $tinvited + 1;			 
			}
			else 
			{ 	
				$this->Tpeopl_in_front = rand(500,1300) - $tinvited; 
			}
			$this->people_behind_you = rand(50,100); 
			$to = $invited_email;
			$subject = "FashionSponge - Sign Up For Beta";
			$senderMail = "info@fashionsponge.com";
			 
			// $name = $_REQUEST['name'] ;
			// $email = $_REQUEST['email'] ;
			// $website = $_REQUEST['website'] ;
			 $res = selectV1(
			 	'invited_genCode',
			 	'fs_invited',
			 	array('invited_email'=>$invited_email) 
			 ); 
			$genCode = $res[0]['invited_genCode']; 
		    $from = $senderMail;  
		     
    		$body ="
              <html> 
                <body style='background-color:#f4f3f2;padding:30px;'> 
                  <center> 
                      <div style=\"
                          text-align:center;
                          background-color: #fff; 
                          border-radius:3px; 
                          text-align:left;
                          line-height:140%;
                          font-family:'arial';
                          font-size:15px; 
                          width:602px;
                          border:2px solid #f4f3f2;
                          \">  
                            <center> 
                                <div> 
                                    <img style='cursor:pointer' src='http://fashionsponge.com/fs_folders/images/email/Header-image.png' />  
                                </div>
                            </center>
              
                          <center>  
                              <div style=\"color:#1a386a;   text-align:left; width:560px;padding-top:30px;\"  > 
                                  <center> <span style='font-size:30px;' > LETTER FROM THE <b> FOUNDER </b> </span> </center><br> 
                                  Hi ".ucfirst($invited_fn).",
                                  <div style='padding-top:15px'>  
                                      My name is Maurico, the Founder & Creative Director of Fashion Sponge. When it comes to  
                                      online fashion communities, I know you have a lot of choices, and I want to personally  
                                      thank you for visiting and signing up.  
                                  </div>
                                   <div style='padding-top:15px;font-weight:bold'> Fashion Sponge is the easiest and fastest way to: </div>   
                                  
                                   <div style=\"color:#c51d20; padding-top:15px;   \" >
	                                    <ul style='border:0;padding:0;margin:0;margin-left:-23px;'>
	                                       <li> Share your fashion and lifestyle photos and videos, outfit of the day and blog articles. </li>
	                                       <li>Discover fashionable people, new blogs and brands.  </li>
	                                       <li>Get beauty or grooming tips, style advice and fashion inspiration. </li>
	                                       <li>Become social media famous by being featured on our popular page and blog. </li>
	                                    </ul>
                                  </div>
                                  
                                  <div style=\"padding-top:15px;\"  > 
                                      We're days away from launching. Our designers and developers are working hard to get  
                                      you a board as soon as possible, ensuring that you have a great online experience.   
                                      Once again, their are <span  style=\"color:#c51d20;font-weight:bold\"  >  $this->Tpeopl_in_front  </span> people ahead of you and <span style=\"color:#c51d20;font-weight:bold\"  > $this->people_behind_you  </span>people behind you. Once we <br>
                                      start sending out invitations to join, you will receive your invite in the order you signed  
                                      up.  
                                  </div>  

                                  <div style=\"padding-top:15px;\" >  
                                      While waiting on your invite we suggest you: <br> 
                                      Follow us on  <a style=\"text-decoration:none;color:#c51d20;font-weight:bold\" target=\"_blank\" href=\"https://www.facebook.com/fashionsponge\">Facebook</a> , <a style=\"text-decoration:none;color:#c51d20;font-weight:bold\" target=\"_blank\" href=\"https://twitter.com/fashionsponge\">Twitter</a> and  <a style=\"text-decoration:none;color:#c51d20;font-weight:bold\" target=\"_blank\" href=\"http://instagram.com/fashionsponge\">Instagram</a>  to get the latest information on the sites  
                                      development and to see if we are sponsoring another give away or to see if you were featured. 
                                  </div>

                                  <div style=\"padding-top:15px;\" >  
                                      To learn more about Fashion Sponge visit our  <a style=\"text-decoration:none;color:#1a386a\" target=\"_blank\" href=\"http://www.fashionsponge.com/info\">info page.</a>   
                                  </div>    
                                   <div style=\"padding-top:10px;\" >  
                                      If you have any questions or suggestions please feel free to email me personally I'm always  
                                      happy to help and connect with people!  
                                  </div>  
                                  <div style=\"padding-top:20px;font-weight:bold\" >  
                                      Thank you again for your support! 
                                  </div>  
                                  <div style=\"padding-top:10px;padding-bottom:70px;text-decoration:none\"  > 
                                      Maurico | Founder & Creative Director<br>
                                      Maurico@fashionsponge.com<br>
                                     \"Don't Just Dress. Dress Well.\"™ 
                                     </div>  
                                  </div> 
                              </div>
                          </center>  
                      </div>
                  </center>  
                </body>
              </html>";    
  		 




			$headers  = "From: $from\r\n"; 
		    $headers .= "Content-type: text/html\r\n"; 
   			 mail($to, $subject, $body, $headers); 
			// mail( $to, $subject,  $body, $senderMail); 
			// $jesus  = mail($to, $subject, $body, "From: info@fashionsponge.com"); 
			// mail('mrjesuserwinsuarez@gmail.com', $subject, $body, "From: $invited_email");  
			// Use this code for registration : $genCode
		}

		public function insert_ads_to_posts($r)
		{
			print_r($r);
			 echo " insert_ads_to_posts() ";
		}
		public function button_api_google( )
        {?>
             <!-- Place this tag where you want the +1 button to render. -->
			<div class="g-plusone" data-size="tall" data-annotation="none"></div>

			<!-- Place this tag after the last +1 button tag. -->
			<script type="text/javascript">
			  (function() {
			    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
			    po.src = 'https://apis.google.com/js/plusone.js';
			    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
			  })();
			</script>


			<?php    
            } 
        public function button_api_facebook( )
        {


            ?>


            <!-- <div id="api_div_fb">  -->
            	
	            
	            <a href="#" 
	              onclick="
	                window.open(
	                  'https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent('http://fashionsponge.com/betatestnew/invite'), 
	                  'facebook-share-dialog', 
	                  'width=626,height=436',
	                  'name=facebookname',
					  'caption=caption'
	                  ); 
	                   return false;"
	                 >
	                <!-- <input id="api_fb_share_button" type="button" value="fb-shre" />	 -->
	                <img id="api_fb_share" src="fs_folders/images/api/shareButtons/fb-share.png">
            	</a>	
            <!-- </div> -->
            
            <!-- 
				fb share 
				Are u a blogger who wants more readers? Are you a reader who wants to discover more quality blogs? Do u seek fashion inspiration or u just love posting your outfit of the day? If yes, Click the link NOW to learn more about @fashionsponge.
			 -->

            
            <!-- <img id="fbshare" src="fs_folders/images/api/shareButtons/google+.png"> -->
            <?php 
        }
        public function button_api_twitter( )
        {
            ?>
            <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://fashionsponge.com/betatestnew/invite" data-text="FashionSponge is that one fashion community you always wanted to join. Visit NOW to learn more and request an invite." data-count="none">Tweet</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
			<?php
        } 

        public function set_Login( $myusername , $mypassword , $array_db )
        {	

        	$tableName  = $array_db['tableName']; 
        	$userRow  = $array_db['userRow']; 
        	$passRow  = $array_db['passRow']; 

        	$myusername = $this->secure_login_sql($myusername);
        	$mypassword = $this->secure_login_sql($mypassword);

        	

        	$logIn = selectV1(
			 	'*',
			 	$tableName ,
			 	array($userRow=>$myusername , 'operand1'=>'and' , $passRow => $mypassword ) 
			);

        	if (!empty($logIn) ) 
        	{
        		return true;
        	}
        	else 
        	{ 
        		return false;
        	}        	 
        }
        public function secure_login_sql($input)
        {
        	if ($_SERVER['HTTP_HOST'] == 'localhost') 
        	{ 
        		# code
			}
			else 
			{ 
				$input = stripslashes($input);
				$input = mysql_real_escape_string($input);
			}

			return $input;
        }
        public function clean_input( $string )
	 	{
	 		return $string;	 
	 	}	



	 	public function fs_delete_data( $data , $type )
	 	{
	 		

	 		if ( $type == "fs_look") 
	 		{
	 			$this->auto_detect_path();
			 	$plno = $data;
			 	$plcm=select( 'posted_looks_comments', 7, array('plno	',$plno) );

					$cids=convert_1d($plcm,0);

					if (!empty($cids)) 
					{
						for ($i=0; $i <count($cids) ; $i++) 
						{ 
							 delete('plc_replies',array('plcno',intval($cids[$i])));
							 delete('posted_looks_comments_like_dislike',array('plcno',intval($cids[$i])));
							 delete('fs_plcm_reply',array('plcno',intval($cids[$i])));
							 delete('fs_plcm_dislike',array('plcno',intval($cids[$i])));
						}
					}
				delete('activity',array('_table_id',intval($plno)));
				delete('fs_pltag',array('plno',intval($plno)));
				delete('postedlooks',array('plno',intval($plno)));
				delete('ratings',array('plno',intval($plno)));
				delete('pl_drips',array('plno',intval($plno)));
				delete('pl_loves',array('plno',intval($plno)));
				delete('posted_looks_comments',array('plno',intval($plno))); 


				//needs to be coded
		  
		 		// fs_plcm_rdislike = plcrno <br> 
		 		// fs_plcm_rflag = plcrno <br> 
		 		// fs_plcm_rlike = plcrno <br> 

		 		// echo "<img src='$this->look_folder./$plno.jpg'>";


			 	// echo "$this->unlink_look_lookdetails/$plno.jpg";


		 		// @unlink("$this->unlink_look./$plno.jpg");
				@unlink("$this->unlink_look_home./$plno.jpg");
				@unlink("$this->unlink_look_lookdetails./$plno.jpg");
				@unlink("$this->unlink_look_thumbnail./$plno.jpg");


				 


		 		// @unlink($this->unlink_look_home."/$plno.jpg");
		 		// unlink($this->unlink_look_lookdetails."/$plno.jpg");


	 		}
	 		if ( $type == "fs_member") { }
	 		if ( $type == "fs_article")  { }
	 		if ( $type == "fs_media")  { }
	 	}


				
		public function split_string_single($string , $long_text_tobe_plit , $cut_every )
		{ 
		    // echo strlen($string);

		    // $cut_every = 5;
		    // $long_text_tobe_plit = 20;

		    $strlen = strlen($string);

		    if ($strlen >= $long_text_tobe_plit) 
		    {
		        // echo "<br>split<br>";

		        for ($i=0; $i < $strlen; $i++) 
		        { 
		             if ($i%$cut_every==0) 
		             {
		                  // echo "$i split <br>";
		                  $string1 = substr($string,$i,$cut_every);

		                  $string1 = $string1;
		                  // echo "$i = $string1 <br>";
		                  $new_string .= $string1.' ';


		                  // $new_string = substr_replace($string,'-', $i);
		             }
		        }
		        // echo "new string is = $new_string <br>";
		        return $new_string;
		    }
		    else  
		    {
		        // echo 'don\'t split <br>';
		    	return $string.' '; 
		    }
		    
		}

	    function split_string_multiple($string , $long_text_tobe_plit , $cut_every)
	    { 
	    	$new_string = "";
	    	$new_string1 = "";
	        $stringA = explode(' ', $string);
	        // print_r($stringA);
	        $str_A_len = count($stringA);

	        for ($i=0; $i < $str_A_len ; $i++) 
	        { 
	        	// echo " $i =".$stringA[$i] .'<br>';
	            $new_string = $this->split_string_single($stringA[$i] , $long_text_tobe_plit , $cut_every);
	            // echo $new_string.'<br>';
	            $new_string1.=$new_string;
	        }
	        // $new_string1.=$new_string;


	         // echo "new string = $new_string1 <br>"; 
	         return $new_string1;
	    }
	    public function dialog( $type , $message  )
	    {
	    	if ( $type == "alert") 
	    	{
		    	echo " 
		    	<script> 
		    		alert('$message');
		    	</script> ";
	    	}
	    	else if ( $type == "confirm" ) 
	    	{ 
	    		 	echo " 
		    	<script> 
		    		confirm('$message');
		    	</script> ";
	    	}
	    	
	    }
	    public function plugins( $plugInName , $page=null )
	    {
	    	if ($plugInName == "google analytic") 
	    	{
	    		// $this->dialog( "alert" , "google analytic initialized"  );
	    		 // echo " this is plugin for the google analytic <br>";
	    		 include_once("fs_folders/google_analytics/analyticstracking.php");
	    	}
	    }

	    public function get_visitor_info( $ip=null , $page=null , $visited=null )
	    { 
	    	// echo "visitor detect ";
			  if ( empty( $ip )) 
			  {
			    $client  = @$_SERVER['HTTP_CLIENT_IP'];
			    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
			    $remote  = $_SERVER['REMOTE_ADDR'];

			    // echo " ip $client";
			    if(filter_var($client, FILTER_VALIDATE_IP))
			    {
			        $ip = $client;
			    }
			    elseif(filter_var($forward, FILTER_VALIDATE_IP))
			    {
			        $ip = $forward;
			    }
			    else
			    {
			        $ip = $remote;
			    }
			  }
			  // $ip = "216.115.69.144";
			  $content = file_get_contents("http://www.speedguide.net/ip/$ip");
			  
			  

			$cty_start_pos = strpos($content, "City: </td><td>");
			$cty_start_pos+=5;
			$init_city = substr($content,$cty_start_pos , 100);
			$city_end_pos = strpos($init_city, "</td></tr>");
			$city = substr($init_city,0,$city_end_pos);
			$city  = str_replace("</td><td>","", $city);


			$country_start_pos = strpos($content, "Country: </td><td>");
			$country_start_pos+=8;
			$init_country = substr($content,$country_start_pos , 100);
			$country_end_pos = strpos($init_country, "<img");
			$country = substr($init_country,0,$country_end_pos);
			$country  = str_replace("</td><td>","", $country);



			// echo "
			//     id = $ip <br>
			//     city = $city <br>
			//     country = $country <br> "; 

			$subject = " fs new visitor detected.";
			$to = "mrjesuserwinsuarez@gmail.com";
			$body = " new visitor info : \n
						visited page:  $page \n 
			   			ip: $ip \n 
			   			city: $city \n
			   			country : $country \n

			    		";

			  if ( $visited == "home") 
			  {
			  	// $this->dialog("alert","home");
			  	mail($to, $subject, $body, "From:$country $page@page.com"); 
			  }
			  else 
			  { 
			  	// $this->dialog("alert","not home");
			  	mail($to, $subject, $body, "From: $page@$country.com"); 
			 	// mail('brainoffashion@gmail.com', $subject, $body, "From: $page@$country.com");  
			  }
			 

			  // IP address:</td><td><b>
			  // hostname: </td><td>
			  
			  // Postal code: </td><td>
			// Country: </td><td> 
	    }
	    public function header_attribute( $page_title=null , $page_description=null , $keywords=null )
	    {  ?> 
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				<title>  <?php echo $page_title; ?>  </title>
				<meta name="description" content="<?php echo $page_description; ?>" />
				<meta name="keywords" content="<?php echo $keywords; ?>">
	 			
				<!-- <link rel="icon" href="fs_folders/images/fabicon/favicon.icon" type="image/jpg"   > -->
				<link rel="icon" href="fs_folders/images/fabicon/favicon-16x16.png" type="image/png" >
				

				<!-- new fonts -->
					<link rel="stylesheet" type="text/css" href="fs_folders/style/fonts/miso_bold_macroman/stylesheet.css">
				    <link rel="stylesheet" type="text/css" href="fs_folders/style/fonts/miso_light_macroman/stylesheet.css">
					<link rel="stylesheet" type="text/css" href="fs_folders/style/fonts/miso_regular_macroman/stylesheet.css">
				<!-- end fonts -->
				
				<!-- new plugin  -->
					<script type="text/javascript" src='fs_folders/js/jquery-1.7.1.min.js'> </script>
					<script type="text/javascript" src='fs_folders/js/function_js.js'></script>
				<!-- new plugin  -->
				
				<!-- new outside -->
					<!-- <link rel="stylesheet" type="text/css" href="fs_folders/page_footer/css/invite_footer.css" > -->
				<!-- end outside -->

				<!-- new header  -->
				<!-- end header  -->  
				<!-- jquery ui --> 
					<link rel="stylesheet" type="text/css" href="fs_folders/js/jquery-ui/css/ui-lightness/jquery-ui-1.10.3.custom.css"> 
					<script type="text/javascript" src="fs_folders/js/jquery-ui/js/jquery-ui-1.10.3.custom.js" ></script>   
						<script>
							$(function() {
								$( document ).tooltip({
									track: true,
									effect: "slideDown",
									delay: 250, 
									hide: {
										effect: "explode",
										delay: 1
									} 
								});
							});
						</script>  


	    <?php 	 
	    }




	    public function convert_textdateformat_to_dbdateformat( $textdate ) {
	    	// echo " convert now ! text date =  $textdate"; 
			// y-m-d db
			// m-d-y field 
	    	 $dbdate = explode("/", $textdate);
	    	 $m = $dbdate[0];
	    	 $d = $dbdate[1];
	    	 $y = $dbdate[2]; 
	    	 // echo " $y $m $d ";
	    	 return "$y-$m-$d";
	    } 

	} #end myclass   
	 
 	


/*
	split_string_multiple( )
	split_string_single( )
	secure_login_sql($input)
	fs_delete_data( $data , $type )
	clean_input()
	set_Login()
	auto_detect_path() 
	insert_ads_to_posts()
	get_user_info_by_id($mno) one user info only
	get_all_user()
	get_activity() 

	get_full_name_by_id($mno)
    get_full_name_by_look_id($plno)
	next_prev_comments()
	get_total()



	# reservation
		convert_textdateformat_to_dbdateformat


*/
   ?>





<?php 
 	
 	/**
 	*  article
 	*  date : october 10 , 2013 
 	*/

 	class postarticle  
 	{
 		#rigion test.php
 		public function get_image_article( $url , $ri , $limit )
 		{	
 			$fcontent = file($url);
 			$fcontent_len = count($fcontent);
 			$article = array( );
 			$c = 0;
 			for ($i=0; $i < $fcontent_len ; $i++) 
 			{ 
 				$img = $fcontent[$i];

 				if (  strpos($img, '.jpg') > 0 /*  and  strpos($img, 'src=')  > 0 */  ) 
 				{ 	
 				 	if ( $this->is_not_ads( $img ) ) 
 				 	{ 
 				 		if ( strpos($img, 'src=')  > 0  ) 
 				 		{
 				 			# with source
 				 			$img_source = $this->get_image_source( $img );
						}
						else 
	 					{ 
	 						# no source only href 
	 						// echo " <br> $img <br>";

	 						$img_source = $this->get_image_link( $img );
	 					}

	 					$img_source = $this->add_img_url_if_dont_have( $img_source , $url ); 
	 					$img_source = $this->get_only_correct_size( $img_source , $ri , 100 , 150 );
	 					if ( !empty( $img_source) ) 
						{
							if ( $c <  $limit ) 
							{
								$article[$c]['img_source'] = $img_source;
							}
							else 
							{
								$i = $fcontent_len;
							}
							$c++;
						}
 				 	}
 				} 
 			}
 			return $article;
 		}
 		public function get_article_local_title_desc( $fcontent , $i ) #not in used
 		{
 			$c2=0;
 			$td = array( );
			for ($j=1; $j <20 ; $j++) 
			{
				$title_description = $fcontent[$i+$j];
				if (!empty($title_description)) 
				{
					if ( $c2==0) 
					{	
						$td[$this->c1]['title'] = $title_description;
					}
					else  
					{
						$td[$this->c1]['desc'] = $title_description;
						$j=20;
						$this->c1++;
					}
				}
				$this->c1++;
			}
			return $td;
		}
		public function get_image_source( $img )
		{
		 
		 	$img = str_replace('<div>','',$img);
			$img = str_replace('</div>','',$img);
			
			$img = str_replace('<li>','',$img);
			$img = str_replace('</li>','',$img);

		    $html = $img;
			$doc = new DOMDocument();
			$doc->loadHTML($html);
			$xpath = new DOMXPath($doc);
			$image_source = $xpath->evaluate("string(//img/@src)"); # "/images/image.jpg"
			return $image_source;
		}
		public function get_image_link(  $img )
		{
		 

		 echo " <hr> $img  <hr> ";
		}

 		public function get_title_in_a_website( $url )
 		{
			$html = $this->file_get_contents_curl( $url );
			$doc = new DOMDocument();
			@$doc->loadHTML($html);
			$nodes = $doc->getElementsByTagName('title');
			$title = $nodes->item(0)->nodeValue;
			$title = strip_tags($title);
			return $title ;
 		}
 		public function file_get_contents_curl($url) # used by get title
		{
		    $ch = curl_init();
		    curl_setopt($ch, CURLOPT_HEADER, 0);
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		    curl_setopt($ch, CURLOPT_URL, $url);
		    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		    $data = curl_exec($ch);
		    curl_close($ch);
		    return $data;
		}
 		public function get_meta_data($url, $searchkey='') 
		{
			$str = '';   
		    $data = get_meta_tags($url);    // get the meta data in an array
		    foreach($data as $key => $value)
		    {
		        if(mb_detect_encoding($value, 'UTF-8, ISO-8859-1', true) != 'ISO-8859-1') {    // check whether the content is UTF-8 or ISO-8859-1
		            $value = utf8_decode($value);    // if UTF-8 decode it
		        }
		        $value = strtr($value, get_html_translation_table(HTML_ENTITIES));    // mask the content
		        if($searchkey != '') {    // if only one meta tag is in demand e.g. 'description'
		            if($key == $searchkey) {
		                $str = $value;    // just return the value
		            }
		        } else {    // all meta tags
		            $pattern = '/ |,/i';    // ' ' or ','
		            $array = preg_split($pattern, $value, -1, PREG_SPLIT_NO_EMPTY);    // split it in an array, so we have the count of words           
		            $str .= '<p><span style="display:block;color:#000000;font-weight:bold;">' . $key . ' <span style="font-weight:normal;">(' . count($array) . ' words | ' . strlen($value) . ' chars)</span></span>' . $value . '</p>';    // format data with count of words and chars
		        }
		    }
		    $str = strip_tags($str);
		    return $str;
		}
		public function retrieve_images_from_url( $content , $mc , $pa , $ri ) # not in used
		{
			$limitBlog = 20;
			$c = 0; 
			$n = 0; 
			$imagesArray = array();
			$content = str_replace('</','la',$content);
			$content = str_replace('<','l',$content);
			for ($i=0; $i < strlen($content) ; $i++) 
			{ 
				if ( $content[$i] == 'l' and $content[$i+1] == 'i' and $content[$i+2] == 'm' and  $content[$i+3] == 'g'  and  $content[$i+4] == ' '  ) 
				{
					$c++;
					if ($c <= $limitBlog ) 
					{

						$glc = 0; #get line counter
				 		$code_line = substr($content,$i+1,1000); # get the line as the image belongs
						$code_line = substr($content,$i+1,strpos($code_line,'/>')+2); #cut until image only
						$jpg_post = strpos($code_line, '.jpg');
					}	
					else 
					{ 
						$i = strlen($content);
					}

					if ($jpg_post) # IF image is jpg 
					{ 
						$c2=0;
						for ($l=$jpg_post; $l > 0 ; $l-- )  #get main source of image <img src =img /> 
						{ 
						 	if ( $code_line[$l] == 's' and $code_line[$l+1] == 'r' and $code_line[$l+2] == 'c' and  $code_line[$l+3] == '=' ) 
						 	{			 		
						 		$image_souce = substr($code_line,$l+5,$c2-1); # get image source
						 		$l = 0;
							}
							$c2++;

						}
 						// echo "$image_souce <br>";
						if ( $this->with_http($image_souce))  # if image found .
				 		{  
					 		$ri->load($image_souce); 
					 		if ($ri->getWidth() > 50 ) # width is greater than 250
							{
						 		$imagesArray[$n]['source'] = $image_souce;
						 		$n++;	 	
							}	
						}	
						else 
						{ 
							#image not exist
						}
					}
				}						
			}	
			// print_r($imagesArray);
			return $imagesArray;
		}
		public function get_article_desciription_and_tite( $url , $img , $img_name ) #not in used 
	 	{
			$content = file_get_contents( $url );
			$content = str_replace('<','-ldn-',$content);
			$imgpos = strpos( $content , $img_name );
			$desc = substr($content,$imgpos,1000);
			$descStopPos = strpos( $desc , '-ldn-/p>' );
			$descStartPos = strpos( $desc , '-ldn-p' );
			 $c=0;
			 for ($i=0; $i < $descStartPos; $i++) 
			 { 
			 	$c++;
			  	if ( $desc[$i] == '-' and $desc[$i+1] ==  'l' and $desc[$i+2] == 'd' and $desc[$i+3] =='n'  ) 
			  	{
			  		$i=$descStartPos;	 
			  	}	
			 }
			 $desc = substr($desc, $descStartPos , $c+26);
		}
		public function url_exists($url) 
		{
		    $mylinks=$url;
			$handlerr = curl_init($mylinks);
			curl_setopt($handlerr,  CURLOPT_RETURNTRANSFER, TRUE);
			$resp = curl_exec($handlerr);
			$ht = curl_getinfo($handlerr, CURLINFO_HTTP_CODE);
			if ($ht == '404' or empty($ht) )
			{ 
				return false;
			}
			else 
			{ 
				return true;
			}
		}
		public function  with_http ( $link ) 
		{ 
			$link =  'assadasd'.$link;
			if ( strpos($link, 'ttp') >  0 ) 
			{
				return true; 
			}
			else 
			{ 
				return false;
			}
		}
		public function get_only_correct_size( $img_source , $ri , $require_width , $require_height )
		{

			// $ri->load($img_source);
			// $width = $ri->getWidth();
			// $height = $ri->getHeight(); 


			list($width, $height, $type, $attr) = getimagesize($img_source);

			// echo "Image width " .$width;
			// echo "<BR>";
			// echo "Image height " .$height;
			// echo "<BR>";
			// echo "Image type " .$type;
			// echo "<BR>";
			// echo "Attribute " .$attr;

			if ( $width > $require_width and $height > $require_height   ) 
			{


				return $img_source; 
			}
			else 
			{ 
				return false;
			}
			return $article2; 
		}
		public function add_img_url_if_dont_have( $img_source , $url )
		{
			echo "$img_source <br>";
	   		$www_pos = strpos($img_source, 'ttp');
		   	if ( $www_pos > 0 or !empty($www_pos) ) 
		   	{
				return $img_source;
		   	}
		   	else 
		   	{
		   		$url = $this->get_url_only( $url );
		   		/*
			   		$url = rtrim($url, "/");
			   		$url = dirname($url);
				*/
		   		$img_source = ltrim($img_source, "/");
		   		$curl = $url.'/'.$img_source;
		   		return $curl;
		   	}
		}
		public function get_descriptions( $url )
		{
 	

 			$desc_array = array( );
			// echo " <h3> all paragraph as desc  </h3> ";
			$fcontent = file_get_contents( $url );

			$doc = new DOMDocument();
			$doc->loadHTML($fcontent);


			$tags = $doc->getElementsByTagName('p');


			$i=0;
			foreach ($tags as $tag) 
			{

				if (  !empty($tag->nodeValue) ) 
				{

					
				       // echo $tag->getAttribute('href').' | '.$tag->nodeValue."<br>";
					// echo "$i .)   $tag->nodeValue<hr>";
					$desc_array[$i] = $tag->nodeValue;
					$i++;
				}
				
	
			}
			// echo " <hr>";
			return $desc_array; 
		}
		public function change_description_if_lessthan50( $desc , $desc_content , $start , $end ) 
		{
		 	
		 	// echo " get descriptin";

			// if ( empty($desc) ) 
			// {
		  
				$total_cdesc = count($desc_content);
				count($total_cdesc);
				for ($i=0; $i < $total_cdesc ; $i++) 
		 		{
		 			$dc = $desc_content[$i];
		 			$dc_len = strlen($dc);
 
		 			// echo " $dc <hr>";

		 			if ( $dc_len  >  $start and  $dc_len  < $end  ) 
		 			{
		 				$desc = $dc;
		 				// echo "len is acceptable $dc_len <br>";
		 				$i = $total_cdesc;
		 			} 
		 			else 
		 			{
		 				 // echo " not acceptable $dc_len <br>";
		 			}
		 		} 

			// }
			// else if (  strlen($desc) < 50 )  
		 // 	{
		 // 		for ($i=0; $i < count($desc_content) ; $i++) 
		 // 		{
		 // 			$dc = $desc_content[$i];
		 // 			$dc_len = strlen($dc);




		 // 			// echo " content desc $dc <br>";

		 // 			if ( $dc_len > $start and $dc_len  < $end  ) 
		 // 			{
		 // 				$desc = $dc;
		 // 				// echo "len is acceptable $dc_len <br>";
		 // 				$i = $dc_len;
		 // 			} 
		 // 			else 
		 // 			{
		 // 				 // echo " not acceptable $dc_len <br>";
		 // 			}
		 // 		} 
		 // 	}

		 	return $desc;
		}
		public function test_get_images_from_url( $url ) // for testing only and not working 
		{
 	
 			
			$doc = new DOMDocument();
		    $doc->loadHTML($url);
		    $imagepaths=array();
		    $imageTags = $doc->getElementsByTagName('img');
		    // $folder=file_directory_path();
		    // foreach($imageTags as $tag) {

		    //     $imagepaths[]=$tag->getAttribute('src');

		    // }
		    $i=0;
		    foreach($imageTags as $tag) {
			   	$i++;
			    $imagepaths[$i]=urldecode($tag->getAttribute('src'));
			}

		    // if(!empty($imagepaths)){
		    	echo "images  ";
		      	print_r($imagepaths);
		      	// return urldecode($imagepaths);
		    // }else{

		    //     echo "walay image ";
		    // }
		}
		public function is_not_ads( $img )
		{

			$banner = strpos($img,'banner');
			$header = strpos($img,'header');
			// $ads = strpos($img,'ads');
			// $profile = strpos($img,'profile');
			// $button = strpos($img,'button');

			
		 

			
			// echo " header pos is $b <br>";


			if (   $banner > 0 || $header >  0 ) 	 
			{
				
				// echo "image is a header , ads  or profile  <br> ";
				// return $img; 
				return false; 
			}
			else 
			{ 

				// echo "image is a good image <br>";
				return $img;
			}
		}
		public function get_video_embeded_code( $url )
		{

			if ( strpos($url,"youtube") ) 
			{
				$v = stristr($url,'v=');
				$v = substr($v,2,strlen($v));
				$this->vedio_type = "youtube";
			}
			else 
			{ 
				$this->vedio_type = "vimeo";
				$v = "30574825";
			}
			

			return $v;




		}
		public function video( $url )
		{
			$video_array = array( );

			echo "url $url <br><br><br><br>";
			$v = stristr($url,'v=');
			$v = substr($v,2,strlen($v));
			echo "vid = $v <br>";
	
			echo '<iframe width="560" height="315" src="//www.youtube.com/embed/'.$v.'" frameborder="0" allowfullscreen></iframe>';
		
			$vidID=$v;
			//http://www.youtube.com/watch?v=voNEBqRZmBc
			$url = "http://gdata.youtube.com/feeds/api/videos/". $vidID;
			$doc = new DOMDocument;
			$doc->load($url);
			$title = $doc->getElementsByTagName("title")->item(0)->nodeValue;
			$description = $doc->getElementsByTagName("description")->item(0)->nodeValue;
			$duration = $doc->getElementsByTagName('duration')->item(0)->getAttribute('seconds');

			

			print "<b>TITLE:</b> ".$title."<hr>";
			print "<b>Duration: </b>".$duration ."<hr>";
			print "<b>description</b>: ".$description ."<hr>";



			$video_array[0]['vid'] = $v;
			$video_array[0]['vtitle'] = $title; 
			$video_array[0]['vdescription'] = $description; 
	 

			return $video_array;


			# kulang ang pag kuha sa tanang video nga available.
		}
		public function get_url_only( $url )
		{
			$com_pos = strpos($url,'.com');
			return substr($url,0,$com_pos+4);
		}
		public function remove_duplicate( $article , $url ) 
		{ 
			if ( strpos($url,'lookbook') > 0 )
			{
				$new_article = array();
	 			$artlen = count($article); 
	 			$c = 0; 
				for ($i=0; $i < $artlen ; $i++) 
				{ 
					$duplicate = false; 
					$article1 = $this->remove_from_questionmark( basename($article[$i]['img_source']) );
					for ($j=$i+1; $j < $artlen ; $j++) 
					{ 
						$article2 = $this->remove_from_questionmark( basename($article[$j]['img_source']) );
					 	if ( $article1 == $article2 ) 
					 	{
					 		$duplicate = true; 	
					 	}
					}
					if ($duplicate == true) 
					{
						// echo "false base name ".$article1.' == '.$article2.'<br>';
						// echo " true ";
						$duplicate == false;
					}
					else 
					{ 
						// echo "false base name ".$article1.' == '.$article2.'<br>';
						 $new_article[$c]['img_source'] = $article[$i]['img_source'];
						 $c++;
					}
				}
				// echo "new article is <br> ";
				// print_r( $new_article );
				return $new_article;
			}
			else 
			{
				return  $article;
			}
		}
		public function remove_from_questionmark( $article1 )
		{
			$art1pos = strpos($article1,'?');
			$article1 = substr($article1,0,$art1pos);
			return $article1;
		}
		#rigion postarticle.php
		public function post_article( $mc )
 		{	
			if ( isset($_POST["submit"]) ) 
			{	
				if ( !empty(  $_SESSION["article"] )) 
				{  
					$article = $_SESSION["article"];
					$num = $_POST["img_source_num"];
					$img_source = $article[$num]['img_source'];
				}

				if ( !empty( $img_source )) 
				{
					 
					echo " <h1> article succesfully posted </h1> ";
					$mc->date_difference();

					
				 	$article_title = str_replace("'","quattasd",$_POST["article_title"]);
				 	$article_description = str_replace("'","quattasd",$_POST["article_description"]);

				 	 

				 	$article_tags = $_POST["article_tags"];
					$article_category = $_POST["article_category"];
					
					
					$url = $_POST["articleLink"];
					
					$res = insert(
						"fs_postedarticles",
						array(
							"mno",
							"article_title",
							"article_description",
							"article_tags",
							"article_topic",
							"article_source_url",
							"article_source_item",
							"article_dateuploaded"
						),
						array(
					 		686,
					 		$article_title,
					 		$article_description, 
					 		$article_tags, 
					 		$article_category, 
					 		$url,
					 		$img_source,
					 		$mc->date_time
						),
						"article_Id"
					); 

					$last_inserted_id = $_SESSION["last_inserted_id"];
		 			$this->download_image_from_other_site( $last_inserted_id , $img_source , null );


					echo "
						<br> 
						submitted num = $num <br> 
						article_tags = $article_tags <br> 
						article_category = $article_category <br> 
						article_title = $article_title <br> 
						article_description = $article_description <br> 
						image to be posted  = <img src='$img_source' />   <br>
						url = $url<br>
						last id = $last_inserted_id <br>
						 ";
	  

					$mc->go("home?fs_home_tab=fs_articles_tabs");
				}
				else
				{
				  	$mc->dialog( "alert" , " failed to post , please add link and select article from the results .. "); 
				}
			}
			else
			{ 
				// $mc->dialog(" posting article failed!.. "); 
			}
 		}
 		public function download_image_from_other_site( $imgNewName , $imgSource , $distyination )
		{
			 
			$ch = curl_init($imgSource);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
			$rawdata=curl_exec($ch);
			curl_close ($ch);

			$fp = fopen("fs_folders/images/posted articles/$imgNewName.jpg",'w');
			fwrite($fp, $rawdata); 
			fclose($fp);
		}
		public function access_other_website_post( $ch , $nvp )
		{

			$ch = curl_init($ch);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $nvp);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, $nvp);
			curl_exec($ch);
		}
 	}	
?>








<?php 
	
	/**
	* admin 
	*/



	class admin extends admincodes
	{
		
		public function initialize_when_reload()
		{
			$_SESSION['admin_start_view_look'] = 0;
		}
		public function look_views($limit)
		{

			#if refresh let be start is 0.
			// if (empty($this->start)) 
			// {
				
				
			// }
			// if (   ) {
			// 	# code...
			// }
			$this->start = $_SESSION['admin_start_view_look'];
			$this->stop = $this->start+$limit;
			$_SESSION['admin_start_view_look'] = $this->stop;
			

			
			
		}
	}
 
	class admincodes
	{ 
		#
	}


 
	

?>
 






















<?php

/*
* File: SimpleImage.php
* Author: Simon Jarvis
* Copyright: 2006 Simon Jarvis
* Date: 08/11/06
* Link: http://www.white-hat-web-design.co.uk/articles/php-image-resizing.php
*
* This program is free software; you can redistribute it and/or
* modify it under the terms of the GNU General Public License
* as published by the Free Software Foundation; either version 2
* of the License, or (at your option) any later version.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details:
* http://www.gnu.org/licenses/gpl.html
*
*
/*	
* $resizeImage->set_all_for_location( 
*    "images/members/posted looks/$plno.jpg" ,  // source image 
*    "images/members/posted looks/home/$plno.jpg",  // save distination 
*    258,  //width
*    '',  //height
*    $ri // class object 
* );
*/

	class resizeImage 
	{

		var $image;
		var $image_type;

		function load($filename) 
		{	
			// if ("../../fs/fs/images/members/posted looks/108.jpg" == $filename ) 
			// {
			//  	echo "image is equal";
			// }
			// else 
			// { 
			// 	echo "image is not equal";
			// }
			// echo " this is image <img src='$filename' /> ";
			// echo "<br>$filename";
			$image_info = getimagesize($filename);
			$this->image_type = $image_info[2];

			if( $this->image_type == IMAGETYPE_JPEG ) 
			{
				$this->image = imagecreatefromjpeg($filename);
			} 
			elseif( $this->image_type == IMAGETYPE_GIF ) 
			{
				$this->image = imagecreatefromgif($filename);
			} 
			elseif( $this->image_type == IMAGETYPE_PNG ) 
			{
				$this->image = imagecreatefrompng($filename);
			}
		}
		function save($filename, $image_type=IMAGETYPE_JPEG, $compression=75, $permissions=null) 
		{
			if( $image_type == IMAGETYPE_JPEG ) 
			{
				imagejpeg($this->image,$filename,$compression);
			} 
			elseif( $image_type == IMAGETYPE_GIF ) 
			{
				imagegif($this->image,$filename);
			} 
			elseif( $image_type == IMAGETYPE_PNG ) 
			{
				imagepng($this->image,$filename);
			}
			if( $permissions != null) 
			{
				chmod($filename,$permissions);
			}
		}
		function output($image_type=IMAGETYPE_JPEG) 
		{
			if( $image_type == IMAGETYPE_JPEG ) 
			{
				imagejpeg($this->image);
			} 
			elseif( $image_type == IMAGETYPE_GIF ) 
			{
				imagegif($this->image);
			} 
			elseif( $image_type == IMAGETYPE_PNG ) 
			{
				imagepng($this->image);
			}
		}
		function getWidth() 
		{
			return imagesx($this->image);
		}
		function getHeight() 
		{
			return imagesy($this->image);
		}
		function resizeToHeight($height) 
		{
			$ratio = $height / $this->getHeight();
			$width = $this->getWidth() * $ratio;
			$this->resize($width,$height);
			// $this->resize($this->getWidth(),$height);
		}
		function resizeToWidth($width) 
		{
			$ratio = $width / $this->getWidth();
			$height = $this->getheight() * $ratio;
			$this->resize($width,$height);
			// $this->resize($width,$this->getheight());
		}
		function scale($scale) 
		{
			$width = $this->getWidth() * $scale/100;
			$height = $this->getheight() * $scale/100;
			$this->resize($width,$height);
		}
		function resize($width,$height) 
		{
			$new_image = imagecreatetruecolor($width, $height);
			imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
			$this->image = $new_image;
		}      
		function set_all_for_location( $loadImg , $saveImg , $width = null , $height = null , $classObject ) 
		{  
			$classObject->load($loadImg);
	 		
	 		// echo " $loadImg <br>";
	 		if ( !empty($width) ) 
			{
				$classObject->resizeToWidth($width);
			}
			if ( !empty($height) ) 
			{
				$classObject->resizeToHeight($height);
			}
			$classObject->save($saveImg);
		}
	}

?>


