<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class Common extends Authenticatable
{
    public static function insertdata($table,$data){
		DB::table($table)->insert($data);
		return DB::getPdo()->lastInsertId();
	}
    public function get_events_list($id=''){
		$query = DB::table('calender_events')->select('*');		    
	 	$query->where(function($newquery) use ($id){
             $newquery->where('calender_events.created_by', '=', $id);
             $newquery->orWhereRaw('FIND_IN_SET('.$id.',calender_events.invited_to)');
         });
        return $query->get();
	}
	public static function updatedata($table,$data,$where){
		return DB::table($table)->where($where)->update($data);
	}

	public static function selectdata($table,$where="",$order="",$offset="",$limit="",$wherein="",$whereraw=""){
		if($where!="" && $order=="")
		$result = DB::table($table)->select('*')->where($where);
		else if(!empty($order) && $where!=""){
			if(!empty($order)){
				if (is_array($order)) {
				    foreach ($order as $key => $value) {
				        $order = $order[$key]; // or $v
				        break;
				    }
				}
				}
		$result = DB::table($table)->select('*')->where($where)->orderby($key,$value);
		}
		else
		$result = DB::table($table)->select('*');
	    if($wherein!=""){
	    	$result->whereIn('id', $wherein);
	    }
	    if($whereraw!=""){
	    	$result->WhereRaw($whereraw);
	    }
		if(is_numeric($offset)){
			$offset = $offset * $limit;
			$result = $result->skip($offset)->take($limit);
		}
		return $result->get();
	}
 public static function getdata($select="",$table,$where="",$order="",$offset="",$limit=""){

		if($where!="" && $order=="")
		$result = DB::table($table)->select(DB::raw($select))->where($where);
		else if(!empty($order) && $where!=""){
			if(!empty($order)){
				if (is_array($order)) {
				    foreach ($order as $key => $value) {
				        $order = $order[$key]; // or $v
				        break;
				    }
				}
				}
		$result = DB::table($table)->select(DB::raw($select))->where($where)->orderby($key,$value);
		}
		else
		$result = DB::table($table)->select(DB::raw($select));

		if(is_numeric($offset)){
			$offset = $offset * $limit;
			$result = $result->skip($offset)->take($limit);
		}
		return $result->get();
	}
	public function get_members_list($post='',$id=''){
		$query = DB::table('users')->select('*');


		    if($post['data']){
		    	$query->whereNotIn('users.id', explode(',',$post['data']));
		    }
		    if($post['keyword']){
			 	$query->where(function($newquery) use ($post){
	                 $newquery->where('users.name', 'like', '%' . $post['keyword'] . '%');
	                 $newquery->orWhere('users.last_name', 'like', '%' . $post['keyword'] . '%');
	             });
			 }else{
			 	$query->where('id',0);
			 }
			 if($id!=''){
			 	$query->where('id','!=',$id);
			 }

            return $query->get();
	}
	public function listing_chat($sender='',$receiver='',$listing_id='',$start='')
    {
    		$query = DB::table('chat')->select('chat.*','sent_byuser.name as sendername','sent_byuser.id as senderid','sent_byuser.image as senderimage','sent_touser.name as receivername','sent_touser.id as receiverid','sent_touser.image as receiverimage');


		    if($listing_id != ''){
		    	$query->where('listing_id',$listing_id);
		    }
		    $query->leftJoin('users as sent_byuser','sent_byuser.id','=','chat.sent_by')
            ->leftJoin('users as sent_touser','sent_touser.id','=','chat.sent_to');
            if($sender !='' && $receiver!=''){
            	$query->whereRaw('(chat.sent_to='.$sender.' or chat.sent_to = '.$receiver.' and chat.sent_by ='.$sender.' or chat.sent_by='.$receiver.')')->orderBy('chat.id', 'ASC');
            }else{
            	$query->orderBy('chat.id', 'ASC');
            }

		   	if($start){
		   		$query->skip($start)->take(50000);
		   	}

            return $query->get();
    }
    public function getresource_comments($id='')
    {
    		$query = DB::table('resource_comments')->select('resource_comments.*','users.image');
		    if($id != ''){
		    	$query->where('resource_comments.resource_id',$id);
		    }
		    $query->where('resource_comments.status',1);
		    $query->Join('users','users.id','=','resource_comments.user_id');
            return $query->get();
    }
	public static function deletedata($table,$data){
		return DB::table($table)->where($data)->delete();
	}
	public static function getlistingdetails($where,$limit='',$start='',$from_limit=''){
		// echo getUrl();
		// exit;
		$query = DB::table('listing')
			 ->select('listing.*','listing_files.name as image','users.name as fname','users.last_name as lname','listing_files.extension','users.image as userimage')
             ->where($where)
             ->where('listing_files.type',1);
        	if(getUrl() == 'retail'){
			 	$query->where('listing.plateform', 1);
			 }elseif(getUrl() == 'office'){
			 	$query->where('listing.plateform', 2);
			 }elseif(getUrl() == 'residential'){
			 	$query->where('listing.plateform', 3);
			 }
             $query->join('listing_files','listing_files.listing_id','=','listing.id')
             ->join('users','users.id','=','listing.user_id')
             ->orderby('listing.id' , 'desc')
             ->groupBy('listing.id');
             if($limit !=''){
             	$query->limit($limit);
             }
             if($start!=''){
		   		$query->skip($start)->take($from_limit);
		   	 }

        return $query->get();
	}
	public static function getlistingdetails_count($where){
		$query = DB::table('listing')
			 ->select('listing.*','listing_files.name as image','users.name as fname','users.last_name as lname','listing_files.extension')
             ->where($where)
             ->where('listing_files.type',1)
             ->join('listing_files','listing_files.listing_id','=','listing.id')
             ->join('users','users.id','=','listing.user_id');
             if(getUrl() == 'retail'){
			 	$query->where('listing.plateform', 1);
			 }elseif(getUrl() == 'office'){
			 	$query->where('listing.plateform', 2);
			 }elseif(getUrl() == 'residential'){
			 	$query->where('listing.plateform', 3);
			 }
             $query->orderby('listing.id' , 'desc')
             ->groupBy('listing.id');
        return $query->get()->count();
	}
	public function listingSearch($post,$limit='',$start='',$from_limit=''){
		// echo "<pre>";
		// print_r($post);
		// exit;
			$query = DB::table('listing')
			 ->select('listing.*','listing_files.name as image','categories.name as current_use_name','space_type.name as space_category','retail_category.name as category_name','users.name as fname','users.last_name as lname','listing_files.extension')
			 ->leftJoin('retail_category','retail_category.id','=','listing.retail_category')
             ->leftJoin('space_type','space_type.id','=','listing.space_type')
             ->leftJoin('categories','categories.id','=','listing.current_use');
			 if($post['keyword']){
			 	$query->where(function($newquery) use ($post){
	                 $newquery->where('listing.name', 'like', '%' . $post['keyword'] . '%');
	                 $newquery->orWhere('listing.description', 'like', '%' . $post['keyword'] . '%');
	             });
			 }
			  if(isset($post['location']) && $post['location']){
			  	$query->where(function($newquery) use ($post){
	                 $newquery->where('listing.location_city', 'like', '%' . $post['location'] . '%');
	                 $newquery->orWhere('listing.street', 'like', '%' . $post['location'] . '%');
	                 $newquery->orWhere('listing.street_no', 'like', '%' . $post['location'] . '%');
	                 $newquery->orWhere('listing.city', 'like', '%' . $post['location'] . '%');
	                 $newquery->orWhere('listing.zip', 'like', '%' . $post['location'] . '%');
	                 $newquery->orWhere('listing.country', 'like', '%' . $post['location'] . '%');
	                 $newquery->orWhere('listing.state', 'like', '%' . $post['location'] . '%');
	             });
	            //$query->where('listing.location_city', 'like', '%' . $post['location'] . '%');
			 }
			 if(isset($post['looking_for']) && $post['looking_for']){
			 	$query->where('listing.looking_for', $post['looking_for']);
			 }
			 if(isset($post['space_type']) && $post['space_type']){
			 	$query->where('listing.space_type', $post['space_type']);
			 }
			 if(isset($post['is_featured']) && $post['is_featured']){
			 	$query->where('listing.is_featured', $post['is_featured']);
			 	$query->where('listing.type','!=',1);
			 	$query->where('listing.type','!=',2);
			 }
			 if(isset($post['floors']) && $post['floors']){
			 	$query->where('listing.floors', $post['floors']);
			 }
			 if(isset($post['lease_type']) && $post['lease_type']){
			 	$query->where('listing.lease_type', $post['lease_type']);
			 }
			 if(isset($post['user_id']) && $post['user_id']){
			 	$query->where('listing.user_id', $post['user_id']);
			 }
			 if(getUrl() == 'retail'){
			 	$query->where('listing.plateform', 1);
			 	// $query->where('listing.type','!=', 6);
			 }elseif(getUrl() == 'office'){
			 	$query->where('listing.plateform', 2);
			 }elseif(getUrl() == 'residential'){
			 	$query->where('listing.plateform', 3);
			 }
			 if(isset($post['rental_type']) && !empty($post['rental_type'])){
			 	$query->whereIn('listing.partial_spacetype', $post['rental_type']);
			 }
			 if(isset($post['type']) && $post['type']){
			 	$query->where('listing.type', $post['type']);
			 }
			 if(isset($post['start_datetime']) && $post['start_datetime']){
			 	$query->where('listing.start_date_time', date('Y-m-d H:i:s',strtotime($post['start_datetime'])));
			 }
			 if(isset($post['end_datetime']) && $post['end_datetime']){
			 	$query->where('listing.end_date_time',date('Y-m-d H:i:s',strtotime($post['end_datetime'])));
			 }
			 if(isset($post['from_range']) && $post['from_range']){
			 	$query->where('listing.price_from','>=', $post['from_range']);
			 }
			 if(isset($post['size_from_range']) && $post['size_from_range']){
			 	$query->where('listing.size','>=', $post['size_from_range']);
			 }
			 if(isset($post['price_unit_popup']) && $post['price_unit_popup']){
			 	if($post['price_unit_popup'] == '/day'){
			 		$query->where('listing.daily_rate','!=', 0);
			 		$query->where('listing.daily_rate','>=', $post['from_range_popup']);
			 		//if($post['to_range_popup']!=500){
				 		$query->where('listing.daily_rate','<=', $post['to_range_popup']);
				 	//}
			 	}elseif($post['price_unit_popup'] == '/week'){
			 		$query->where('listing.weekly_rate','!=', 0);
			 		$query->where('listing.weekly_rate','>=', $post['from_range_popup']);
			 		//if($post['to_range_popup']!=500){
				 		$query->where('listing.weekly_rate','<=', $post['to_range_popup']);
				 	//}
			 	}elseif($post['price_unit_popup'] == '/month'){
			 		$query->where('listing.monthly_rate','!=', 0);
			 		$query->where('listing.monthly_rate','>=', $post['from_range_popup']);
			 		//if($post['to_range_popup']!=500){
				 		$query->where('listing.monthly_rate','<=', $post['to_range_popup']);
				 	//}
			 	}

			 }
			 if(isset($post['to_range']) && $post['to_range']){
			 	$query->where('listing.price_to','<=', $post['to_range']);
			 }
			 if(isset($post['to_rangefrom']) && $post['to_rangefrom']){
			 	//if($post['to_rangefrom']!=1000){
			 		$query->where('listing.price_from','<=', $post['to_rangefrom']);
			 	//}
			 }
			 if(isset($post['size_to_rangefrom']) && $post['size_to_rangefrom']){
			 	//if($post['size_to_rangefrom']!=1000){
			 		$query->where('listing.size','<=', $post['size_to_rangefrom']);
			 	//}
			 }
			 if(isset($post['price_unit']) && $post['price_unit']){
			 	$query->where('listing.price_unit', $post['price_unit']);
			 }
			 if(isset($post['size_unit']) && $post['size_unit']){
			 	$query->where('listing.size_unit', $post['size_unit']);
			 }


			 if(isset($post['sort_bysize']) && $post['sort_bysize']){
			 	if($post['sort_bysize']=='min_max_sqf'){
			 		$query->where(function($newquery) use ($post){
			 			 $newquery->where('listing.size_unit','sq feet');
			 			 $newquery->orWhere('listing.size_unit','/Sq F');
		            });

			 	}
			 	if($post['sort_bysize']=='min_max_sqm'){
			 		$query->where(function($newquery) use ($post){
			 			 $newquery->where('listing.size_unit','sq meters');
			 			 $newquery->orWhere('listing.size_unit','/Sq M');
		            });

			 	}
			 	$query->orderby('listing.size' , 'ASC');
			 }
			 if(isset($post['retail_category']) && !empty($post['retail_category'])){
			 	$query = $query->where(function($querynew) use ($post){
					foreach ($post['retail_category'] as $id) {
					   $querynew->orWhereRaw('FIND_IN_SET('.$id.',listing.retail_category)');
		            }
	            });
			 }
			 if(isset($post['collaboration_type']) && !empty($post['collaboration_type'])){
			 	$query = $query->where(function($querynew) use ($post){
					foreach ($post['collaboration_type'] as $id) {
					   $querynew->orWhereRaw('FIND_IN_SET('.$id.',listing.collaboration_type)');
		            }
	            });
			 }
			 if(isset($post['ideal_uses']) && !empty($post['ideal_uses'])){
			 	$query = $query->where(function($querynew) use ($post){
					foreach ($post['ideal_uses'] as $id) {
					   $querynew->orWhereRaw('FIND_IN_SET('.$id.',listing.ideal_uses)');
		            }
	            });
			 }
			 if(isset($post['amenities']) && !empty($post['amenities'])){
			 	$query = $query->where(function($querynew) use ($post){
					foreach ($post['amenities'] as $id) {
					   $querynew->orWhereRaw('FIND_IN_SET('.$id.',listing.amenities)');
		            }
	            });
			 }
            $query->where('listing_files.type',1)->where('listing.status',1)
             ->join('listing_files','listing_files.listing_id','=','listing.id')
             ->join('users','users.id','=','listing.user_id');
             if(isset($post['Sort_by']) && $post['Sort_by']){
             	if($post['Sort_by'] == 'newest'){
             		$query->orderby('listing.id' , 'DESC');
             	}elseif($post['Sort_by'] == 'oldest'){
             		$query->orderby('listing.id' , 'ASC');
             	}elseif($post['Sort_by'] == 'space_type'){
             		$query->orderby('listing.space_type' , 'ASC');
             	}elseif($post['Sort_by'] == 'price_lowtohigh'){
             		$query->orderby('listing.price_from' , 'ASC');
             		if(isset($post['price_unit_popup']) && $post['price_unit_popup']){
					 	if($post['price_unit_popup'] == '/day'){
					 		$query->orderby('listing.daily_rate' , 'ASC');
					 	}elseif($post['price_unit_popup'] == '/week'){
					 		$query->orderby('listing.weekly_rate' , 'ASC');
					 	}elseif($post['price_unit_popup'] == '/month'){
					 		$query->orderby('listing.monthly_rate' , 'ASC');
					 	}

					}
             	}elseif($post['Sort_by'] == 'price_hightolow'){
             		$query->orderby('listing.price_from' , 'DESC');
             		if(isset($post['price_unit_popup']) && $post['price_unit_popup']){
					 	if($post['price_unit_popup'] == '/day'){
					 		$query->orderby('listing.daily_rate' , 'DESC');
					 	}elseif($post['price_unit_popup'] == '/week'){
					 		$query->orderby('listing.weekly_rate' , 'DESC');
					 	}elseif($post['price_unit_popup'] == '/month'){
					 		$query->orderby('listing.monthly_rate' , 'DESC');
					 	}

					}
             	}
             }else{
             	$query->orderby('listing.id' , 'DESC');
             }
             if($limit !=''){
             	$query->limit($limit);
             }
             if($start!=''){
		   		$query->skip($start)->take($from_limit);
		   	 }
             // ->orderby('listing.id' , 'desc')
            return $query->groupBy('listing.id')
             ->get();

	}
	public function listingSearchcount($post){

			$query = DB::table('listing')
			 ->select('listing.*','listing_files.name as image','categories.name as current_use_name','space_type.name as space_category','retail_category.name as category_name','users.name as fname','users.last_name as lname','listing_files.extension')
			 ->leftJoin('retail_category','retail_category.id','=','listing.retail_category')
             ->leftJoin('space_type','space_type.id','=','listing.space_type')
             ->leftJoin('categories','categories.id','=','listing.current_use');
			 if($post['keyword']){
			 	$query->where(function($newquery) use ($post){
	                 $newquery->where('listing.name', 'like', '%' . $post['keyword'] . '%');
	                 $newquery->orWhere('listing.description', 'like', '%' . $post['keyword'] . '%');
	             });
			 }
			  if(isset($post['location']) && $post['location']){
			  	$query->where(function($newquery) use ($post){
	                 $newquery->where('listing.location_city', 'like', '%' . $post['location'] . '%');
	                 $newquery->orWhere('listing.street', 'like', '%' . $post['location'] . '%');
	                 $newquery->orWhere('listing.street_no', 'like', '%' . $post['location'] . '%');
	                 $newquery->orWhere('listing.city', 'like', '%' . $post['location'] . '%');
	                 $newquery->orWhere('listing.zip', 'like', '%' . $post['location'] . '%');
	                 $newquery->orWhere('listing.country', 'like', '%' . $post['location'] . '%');
	                 $newquery->orWhere('listing.state', 'like', '%' . $post['location'] . '%');
	             });
	           // $query->where('listing.location_city', 'like', '%' . $post['location'] . '%');
			 }
			 if(isset($post['looking_for']) && $post['looking_for']){
			 	$query->where('listing.looking_for', $post['looking_for']);
			 }
			 if(isset($post['space_type']) && $post['space_type']){
			 	$query->where('listing.space_type', $post['space_type']);
			 }
			 if(isset($post['is_featured']) && $post['is_featured']){
			 	$query->where('listing.is_featured', $post['is_featured']);
			 	$query->where('listing.type','!=',1);
			 	$query->where('listing.type','!=',2);
			 }
			 if(isset($post['floors']) && $post['floors']){
			 	$query->where('listing.floors', $post['floors']);
			 }
			 if(isset($post['lease_type']) && $post['lease_type']){
			 	$query->where('listing.lease_type', $post['lease_type']);
			 }
			 if(isset($post['user_id']) && $post['user_id']){
			 	$query->where('listing.user_id', $post['user_id']);
			 }
			  if(isset($post['rental_type']) && !empty($post['rental_type'])){
			 	$query->whereIn('listing.partial_spacetype', $post['rental_type']);
			 }
			 if(isset($post['type']) && $post['type']){
			 	$query->where('listing.type', $post['type']);
			 }
			 if(getUrl() == 'retail'){
			 	$query->where('listing.plateform', 1);
			 }elseif(getUrl() == 'office'){
			 	$query->where('listing.plateform', 2);
			 }elseif(getUrl() == 'residential'){
			 	$query->where('listing.plateform', 3);
			 }
			 if(isset($post['start_datetime']) && $post['start_datetime']){
			 	$query->where('listing.start_date_time', date('Y-m-d H:i:s',strtotime($post['start_datetime'])));
			 }
			 if(isset($post['end_datetime']) && $post['end_datetime']){
			 	$query->where('listing.end_date_time',date('Y-m-d H:i:s',strtotime($post['end_datetime'])));
			 }
			 if(isset($post['from_range']) && $post['from_range']){
			 	$query->where('listing.price_from','>=', $post['from_range']);
			 }
			 if(isset($post['size_from_range']) && $post['size_from_range']){
			 	$query->where('listing.size','>=', $post['size_from_range']);
			 }
			 if(isset($post['price_unit_popup']) && $post['price_unit_popup']){
			 	if($post['price_unit_popup'] == '/day'){
			 		$query->where('listing.daily_rate','!=', 0);
			 		$query->where('listing.daily_rate','>=', $post['from_range_popup']);
			 		//if($post['to_range_popup']!=500){
				 		$query->where('listing.daily_rate','<=', $post['to_range_popup']);
				 	//}
			 	}elseif($post['price_unit_popup'] == '/week'){
			 		$query->where('listing.weekly_rate','!=', 0);
			 		$query->where('listing.weekly_rate','>=', $post['from_range_popup']);
			 		//if($post['to_range_popup']!=500){
				 		$query->where('listing.weekly_rate','<=', $post['to_range_popup']);
				 	//}
			 	}elseif($post['price_unit_popup'] == '/month'){
			 		$query->where('listing.monthly_rate','!=', 0);
			 		$query->where('listing.monthly_rate','>=', $post['from_range_popup']);
			 		//if($post['to_range_popup']!=500){
				 		$query->where('listing.monthly_rate','<=', $post['to_range_popup']);
				 	//}
			 	}

			 }
			 if(isset($post['to_range']) && $post['to_range']){
			 	$query->where('listing.price_to','<=', $post['to_range']);
			 }
			 if(isset($post['to_rangefrom']) && $post['to_rangefrom']){
			 //	if($post['to_rangefrom']!=1000){
			 		$query->where('listing.price_from','<=', $post['to_rangefrom']);
			 //	}
			 }
			 if(isset($post['size_to_rangefrom']) && $post['size_to_rangefrom']){
			 	//if($post['size_to_rangefrom']!=1000){
			 		$query->where('listing.size','<=', $post['size_to_rangefrom']);
			 	//}
			 }
			 if(isset($post['price_unit']) && $post['price_unit']){
			 	$query->where('listing.price_unit', $post['price_unit']);
			 }
			 if(isset($post['size_unit']) && $post['size_unit']){
			 	$query->where('listing.size_unit', $post['size_unit']);
			 }


			 if(isset($post['sort_bysize']) && $post['sort_bysize']){
			 	if($post['sort_bysize']=='min_max_sqf'){
			 		$query->where(function($newquery) use ($post){
			 			 $newquery->where('listing.size_unit','sq feet');
			 			 $newquery->orWhere('listing.size_unit','/Sq F');
		            });

			 	}
			 	if($post['sort_bysize']=='min_max_sqm'){
			 		$query->where(function($newquery) use ($post){
			 			 $newquery->where('listing.size_unit','sq meters');
			 			 $newquery->orWhere('listing.size_unit','/Sq M');
		            });

			 	}
			 	$query->orderby('listing.size' , 'ASC');
			 }
			 if(isset($post['retail_category']) && !empty($post['retail_category'])){
			 	$query = $query->where(function($querynew) use ($post){
					foreach ($post['retail_category'] as $id) {
					   $querynew->orWhereRaw('FIND_IN_SET('.$id.',listing.retail_category)');
		            }
	            });
			 }
			 if(isset($post['collaboration_type']) && !empty($post['collaboration_type'])){
			 	$query = $query->where(function($querynew) use ($post){
					foreach ($post['collaboration_type'] as $id) {
					   $querynew->orWhereRaw('FIND_IN_SET('.$id.',listing.collaboration_type)');
		            }
	            });
			 }
			 if(isset($post['ideal_uses']) && !empty($post['ideal_uses'])){
			 	$query = $query->where(function($querynew) use ($post){
					foreach ($post['ideal_uses'] as $id) {
					   $querynew->orWhereRaw('FIND_IN_SET('.$id.',listing.ideal_uses)');
		            }
	            });
			 }
			 if(isset($post['amenities']) && !empty($post['amenities'])){
			 	$query = $query->where(function($querynew) use ($post){
					foreach ($post['amenities'] as $id) {
					   $querynew->orWhereRaw('FIND_IN_SET('.$id.',listing.amenities)');
		            }
	            });
			 }
            $query->where('listing_files.type',1)->where('listing.status',1)
             ->join('listing_files','listing_files.listing_id','=','listing.id')
             ->join('users','users.id','=','listing.user_id');
             if(isset($post['Sort_by']) && $post['Sort_by']){
             	if($post['Sort_by'] == 'newest'){
             		$query->orderby('listing.id' , 'DESC');
             	}elseif($post['Sort_by'] == 'oldest'){
             		$query->orderby('listing.id' , 'ASC');
             	}elseif($post['Sort_by'] == 'space_type'){
             		$query->orderby('listing.space_type' , 'ASC');
             	}elseif($post['Sort_by'] == 'price_lowtohigh'){
             		$query->orderby('listing.price_from' , 'ASC');
             		if(isset($post['price_unit_popup']) && $post['price_unit_popup']){
					 	if($post['price_unit_popup'] == '/day'){
					 		$query->orderby('listing.daily_rate' , 'ASC');
					 	}elseif($post['price_unit_popup'] == '/week'){
					 		$query->orderby('listing.weekly_rate' , 'ASC');
					 	}elseif($post['price_unit_popup'] == '/month'){
					 		$query->orderby('listing.monthly_rate' , 'ASC');
					 	}

					}
             	}elseif($post['Sort_by'] == 'price_hightolow'){
             		$query->orderby('listing.price_from' , 'DESC');
             		if(isset($post['price_unit_popup']) && $post['price_unit_popup']){
					 	if($post['price_unit_popup'] == '/day'){
					 		$query->orderby('listing.daily_rate' , 'DESC');
					 	}elseif($post['price_unit_popup'] == '/week'){
					 		$query->orderby('listing.weekly_rate' , 'DESC');
					 	}elseif($post['price_unit_popup'] == '/month'){
					 		$query->orderby('listing.monthly_rate' , 'DESC');
					 	}

					}
             	}
             }else{
             	$query->orderby('listing.id' , 'DESC');
             }
             // ->orderby('listing.id' , 'desc')
             return $query->groupBy('listing.id')->get()->count();
	}
	public static function getunreadcountinbox($where){
	    
	    
	    $result = DB::table('booking_requests')->select('*')->where('request_to',$where)->get();
		    	$count=0;
	            foreach($result as $res)
	            {
	                
                            $c=DB::table('chat')
                            ->select('chat.*')
                            ->where('sent_to',$where)
                            ->where('read',0)
                            ->where('listing_id',$res->listing_id)
                             ->where('sent_by',$res->request_from)
                            ->count(); 
                           
                            $count=$count+$c;
	            }
	    if($count >0)
	    {
	     return '('.$count.')';   
	    }else
	    {
	    return '';
	    }
	}
	
		public static function getunreadcountsent($where){
		    	$result = DB::table('booking_requests')->select('*')->where('request_from',$where)->get();
		    	$count=0;
	            foreach($result as $res)
	            {
	                
                            $c=DB::table('chat')
                            ->select('chat.*')
                            ->where('sent_to',$where)
                            ->where('read',0)
                            ->where('listing_id',$res->listing_id)
                           // ->where('sent_by',$res->request_from)
                            ->count(); 
                            
                            $count=$count+$c;
	            }
	    
	    if($count >0)
	    {
	     return '('.$count.')';     
	    }else
	    {
	    return '';
	    }

	}
	public static function chat_unread_count($where){
	    return DB::table('chat')
			 ->select('chat.*')
             ->where($where)
            
             ->count();
	    
	}
	public static function getbookingRequests($where){
		return DB::table('booking_requests')
			 ->select('listing.*','users.name as fname','booking_requests.subject','booking_requests.created_at as booking_created','users.last_name as lname','booking_requests.id as booking_id','booking_requests.status as booking_status','booking_requests.listing_id','booking_requests.request_from')
             ->where($where)
             ->join('listing','listing.id','=','booking_requests.listing_id')
             ->join('users','users.id','=','booking_requests.request_from')
             ->orderby('booking_requests.id' , 'desc')
             ->get();
	}
	public static function getsentbookingRequests($where){
		return DB::table('booking_requests')
			 ->select('listing.*','users.name as fname','booking_requests.created_at as booking_created','users.last_name as lname','booking_requests.id as booking_id','booking_requests.status as booking_status','booking_requests.subject','booking_requests.listing_id','booking_requests.request_to as request_from')
             ->where($where)
             ->join('listing','listing.id','=','booking_requests.listing_id')
             ->join('users','users.id','=','booking_requests.request_to')
             ->orderby('booking_requests.id' , 'desc')
             ->get();
	}
	public static function getbookingRequestsadmin(){
		return DB::table('booking_requests')
			 ->select('booking_requests.*','listing.name','listing.id as listing_id','listing.type as listing_type')
             ->join('listing','listing.id','=','booking_requests.listing_id')
             ->orderby('booking_requests.id' , 'desc')
             ->get();
	}
	public static function getmembers_list($where){
		return DB::table('members')
			 ->select('members.*','users.name as fname','users.last_name as lname','users.company_address','users.image as image')
             ->where($where)
             ->join('users','users.id','=','members.user_id')
             ->get();
	}
	public static function getlistingdetailscategory($where,$limit='',$start='',$from_limit=''){
		$query = DB::table('listing')
			 ->select('listing.*','categories.name as current_use_name','space_type.name as space_category','retail_category.name as category_name','listing_files.name as image','listing_files.extension')
             ->where($where)
             ->where('listing_files.type',1)
             ->join('listing_files','listing_files.listing_id','=','listing.id')
             ->leftJoin('retail_category','retail_category.id','=','listing.retail_category')
             ->leftJoin('space_type','space_type.id','=','listing.space_type')
             ->leftJoin('categories','categories.id','=','listing.current_use');
             if(getUrl() == 'retail'){
			 	$query->where('listing.plateform', 1);
			 }elseif(getUrl() == 'office'){
			 	$query->where('listing.plateform', 2);
			 }elseif(getUrl() == 'residential'){
			 	$query->where('listing.plateform', 3);
			 }
             $query->orderby('listing.id' , 'desc')
             ->groupBy('listing.id');
             if($limit !=''){
             	$query->limit($limit);
             }
             if($start!=''){
		   		$query->skip($start)->take($from_limit);
		   	 }
            return $query->get();
	}
	public static function getlistingdetailscategorycount($where){
		$query = DB::table('listing')
			 ->select('listing.*','categories.name as current_use_name','space_type.name as space_category','retail_category.name as category_name','listing_files.name as image','listing_files.extension')
             ->where($where)
             ->where('listing_files.type',1)
             ->join('listing_files','listing_files.listing_id','=','listing.id')
             ->leftJoin('retail_category','retail_category.id','=','listing.retail_category')
             ->leftJoin('space_type','space_type.id','=','listing.space_type')
             ->leftJoin('categories','categories.id','=','listing.current_use');
             if(getUrl() == 'retail'){
			 	$query->where('listing.plateform', 1);
			 }elseif(getUrl() == 'office'){
			 	$query->where('listing.plateform', 2);
			 }elseif(getUrl() == 'residential'){
			 	$query->where('listing.plateform', 3);
			 }
             $query->orderby('listing.id' , 'desc')
             ->groupBy('listing.id');
            return $query->get()->count();
	}

	public static function getfirst($table,$where=""){
		if($where!="")
		return DB::table($table)->select('*')->where($where)->first();
		else
		return DB::table($table)->select('*')->first();
	}

	public static function getcount($table,$where=""){
		if($where!="")
		return DB::table($table)->select('*')->where($where)->count();
		else
		return DB::table($table)->select('*')->count();
	}
	public static function get_chat_users($user_id){
		return DB::table('user_messages')
             ->orWhere(function($query) use ($user_id){
                 $query->orwhere('from_id', $user_id);
                 $query->orwhere('to_id', $user_id);
             })
             ->whereRaw('!FIND_IN_SET('.$user_id.',deleted_by)')
             ->orderby('created_at' , 'desc')
             ->get();
	}

	public static function get_chat($to_id,$from_id){
		return DB::table('user_messages')
             ->orWhere(function($query) use ($to_id,$from_id){
                 $query->where('from_id', $from_id);
                 $query->where('to_id', $to_id);
                 $query->where('is_start', '0');
                 $query->whereRaw('!FIND_IN_SET('.$to_id.',deleted_by)');
             })
             ->orWhere(function($query) use ($to_id,$from_id){
                 $query->where('to_id', $from_id);
                 $query->where('from_id', $to_id);
                 $query->where('is_start', '0');
                 $query->whereRaw('!FIND_IN_SET('.$to_id.',deleted_by)');
             })
             ->orderby('created_at' , 'asc')
             ->get();
	}

	public function getAdminGroups($adminId){
		return DB::table('groups')->where('group_admin', $adminId)->orderBy('id','ASC')->get();
	}
	public function getGroupBygroupId($groupId){
		return DB::table('groups')->where('id', $groupId)->first();
	}

	public function getUsers($group_id){		
		return DB::table('users')
		->leftJoin('group_user_mapping','users.id','=','group_user_mapping.user_id')
		->where('group_user_mapping.group_id',$group_id)->orderby('name','asc')->get();   
	}

	public function getAllUsers($userId){
		return DB::table('users')->where('id','!=', $userId)->get();
	}

	public function checkUserExist($group_id, $userId){		
		return DB::table('group_user_mapping')->where('user_id',$userId)->where('group_id',$group_id)->first();
	}

	// public function getGroupMsg($groupId){
	// 	return DB::table('group_msgs')->select('group_msgs.*','users.name','last_name','group_documents.name AS doc_name','content_type','group_documents.type','extension')
	// 				->leftJoin('group_documents','group_msgs.id','=','group_documents.msg_id')
	// 				->join('users','group_msgs.sent_by','=','users.id')
	// 				->where('group_msgs.group_id',$groupId)->orderBy('created_at', 'asc')->get();
	// }
	public function getGroupMsg($groupId){
		return DB::table('group_msgs')->select('group_msgs.*','users.name','last_name','group_documents.name AS doc_name','content_type','group_documents.extension','group_documents.type','extension','visibility')
					->leftJoin('group_documents','group_msgs.id','=','group_documents.msg_id')
					->join('groups','group_msgs.group_id','=','groups.id')
					->join('users','group_msgs.sent_by','=','users.id')
					->where('groups.listing_id',$groupId)->orderBy('created_at', 'asc')->get();
	}

	public function getOtherGroups($user_id){
		return DB::table("groups")->select("groups.*")
		->join('group_user_mapping','groups.id','=','group_user_mapping.group_id')
		->where('group_user_mapping.user_id',$user_id)
    	->get();
	}
	public function checkGroupAdmin($adminId,$group_id){
		return DB::table('groups')

		->where('group_admin', $adminId)
		->where('id', $group_id)->first();
	}

	public function getUnseenMsg($user_id){
		return DB::table('group_msgs')
		->join('groups','group_msgs.group_id','=','groups.id')
		->where('group_msgs.seen',0)
		->groupBy('groups.id')
		->pluck('groups.id')->toArray();;
	}

	public function getUnseenMsgs($user_id){
		return DB::select("SELECT DISTINCT group_id  FROM group_msgs WHERE sent_by != $user_id AND NOT FIND_IN_SET($user_id, seen) ORDER BY id DESC");
	}
	public function deleteMember($table, $group_id, $user_id){
		return DB::table($table)->where('group_id',$group_id)->where('user_id',$user_id)->delete();
	}

	public function update_msg_status($group_id, $user_id, $ids){
		return DB::table('group_msgs')->where('group_id',$group_id)
		->where('sent_by','!=',$user_id)
		->whereIn('id', $ids)
		->update(['seen' => DB::raw("CONCAT(seen,',$user_id')")]);
	}

	public function checkMsgSeenOrNot($group_id,$user_id){
		return DB::select("SELECT  id  FROM group_msgs WHERE sent_by != $user_id AND NOT FIND_IN_SET($user_id, seen)");
		
	}

	public function getGroupFiles($listingId,$fileType){
		return DB::table('group_documents')
		->select("group_documents.name","extension")
		->where('group_documents.type',$fileType)
		->where('group_documents.visibility','private')
		->where('group_documents.listing_id',$listingId)
		->get();
	}
	public static function getBrickmembers($id,$userID){
		return DB::table('members')
			 ->select('members.*','users.name','users.last_name','users.email','users.id AS userId')
			 ->join('users','users.id','=','members.user_id')	
			 ->where('members.listing_id',$id)
			 ->where('users.id','!=',$userID)
			 ->where('members.status',1)
			 ->where('users.status',1)         
             ->get();
	}
	public function getBrickOwner($id){
		return DB::table('users')
		->select('users.*')
		->leftJoin('listing','listing.user_id','=','users.id')
		->where('listing.id',$id)
		->first();
	}
	public static function get_calenter_event($id=''){
		$query = DB::table('calender_events')->select('*');		    
	 	$query->where(function($newquery) use ($id){
             $newquery->where('calender_events.created_by', '=', $id);
             $newquery->orWhereRaw('FIND_IN_SET('.$id.',calender_events.invited_to)');
         });
        return $query->get();
	}
	//Get users who intersted in listing 
	public function getRespondedUser($id,$user_id){
		return DB::table('chat')
		->select('users.*')
		->leftJoin('users','chat.sent_by','=','users.id')
		->where('chat.listing_id',$id)
		->where('status',1)
		->where('users.id','!=',$user_id)
		->orderby('users.name','asc')
		->groupBy('users.id')
		->get();
	}

	public static function check_task_members($taskId,$userId){
		return DB::table('member_tasks')->where('id',$taskId)
			->where(function ($q) use ($userId) {
            $q->where('assigned_to',$userId)
			->orWhere('assigned_by',$userId);
        	})->count();
			}

		public function getMemberBricks($userid){
			return DB::table('listing')
			 ->select('listing.*','listing_files.name as image','users.name as fname','users.last_name as lname','listing_files.extension','users.image as userimage')
			 ->join('listing_files','listing_files.listing_id','=','listing.id')
             ->join('users','users.id','=','listing.user_id')
			 ->join('members','listing.id','=','members.listing_id')	

			 ->where('listing.status',1)
			 ->where('listing.type',2)
			 ->where('members.user_id',$userid)
			 ->where('members.status',1)     
			 ->groupBy('listing.id')    
             ->get();
		}
}
