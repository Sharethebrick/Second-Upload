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
	
	public static function updatedata($table,$data,$where){
		return DB::table($table)->where($where)->update($data);
	}	

	public static function selectdata($table,$where="",$order="",$offset="",$limit=""){
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
	
		if(is_numeric($offset)){
			$offset = $offset * $limit; 
			$result = $result->skip($offset)->take($limit);
		}
		return $result->get();
	}

	public static function deletedata($table,$data){
		return DB::table($table)->where($data)->delete();
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

	public static function get_my_listings($user_id){
		return DB::table('user_listings')
		->select('user_listings.id','user_listings.user_id','user_listings.space_length','user_listings.space_width_type','user_listings.space_width','user_listings.multiple_units','user_listings.base_price','user_listings.status','user_listings.created_at','features.name as storage_feature','user_locations.city','user_locations.postcode')
		->join('features', 'features.id', '=', 'user_listings.type_of_storage','left')
		->join('user_locations', 'user_locations.id', '=', 'user_listings.location_id','left')
		->where('user_listings.user_id' , $user_id)
		->orderby('user_listings.created_at' , 'desc')
		->get();
	}

	public static function get_reviews($listing_id,$offset="",$limit=""){
		$result = DB::table('user_ratings')
		->select('user_ratings.*','users.first_name','users.surname','users.image')
		->join('users', 'users.id', '=', 'user_ratings.user_id','left')
		->where('user_ratings.listing_id' , $listing_id)
		->orderby('user_ratings.created_at' , 'desc');
		if(is_numeric($offset)){
			$offset = $offset * $limit; 
			$result = $result->skip($offset)->take($limit);
		}
		return $result->get();
	}

	public static function get_listing_details($listing_id){
		return DB::table('user_listings')
		->select('user_listings.id','user_listings.user_id','user_listings.space_length','user_listings.space_width_type','user_listings.space_width','user_listings.multiple_units','user_listings.base_price','user_listings.space_description','user_listings.status','user_listings.created_at','user_listings.objects_to_store','user_listings.security','user_listings.amenities','user_listings.storage_accessibility','features.name as storage_feature','features.icon as storage_feature_icon','user_locations.city','user_locations.postcode','user_locations.address','users.first_name','users.surname','users.image','users.email','users.phone_number')
		->join('users', 'users.id', '=', 'user_listings.user_id','left')
		->join('features', 'features.id', '=', 'user_listings.type_of_storage','left')
		->join('user_locations', 'user_locations.id', '=', 'user_listings.location_id','left')
		->where('user_listings.id' , $listing_id)
		->first();
	}

	public static function get_features($type,$ids){
		return DB::table('features')
		->select('*')
		->where('type',$type)
		->whereIn('id',explode(",", $ids))
		->get();
	}

	public static function get_average_rating($listing_id){
		$res['rating']  = DB::table('user_ratings')
		->where('listing_id',$listing_id)
        ->avg('rating');

        $res['total']  = DB::table('user_ratings')
		->where('listing_id',$listing_id)
        ->count();

        return $res;
	}

	public static function get_chat_users($user_id){
		return DB::table('user_messages')
             ->orWhere(function($query) use ($user_id){
                 $query->orwhere('from_id', $user_id);
                 $query->orwhere('to_id', $user_id);
             })
             ->orderby('created_at' , 'desc')
             ->get();
	}

	public static function get_chat($to_id,$from_id){
		return DB::table('user_messages')
             ->orWhere(function($query) use ($to_id,$from_id){
                 $query->where('from_id', $from_id);
                 $query->where('to_id', $to_id);
             })
             ->orWhere(function($query) use ($to_id,$from_id){
                 $query->where('to_id', $from_id);
                 $query->where('from_id', $to_id);
             })
             ->orderby('created_at' , 'asc')
             ->get();
	}
}
