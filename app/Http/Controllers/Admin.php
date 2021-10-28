<?php

namespace App\Http\Controllers;
require_once('../stripe-php-sdk/init.php');
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Redirect,Hash,Session,Mail,File,Exception;
use App\Common;
use Stripe\Error\Card;
use Cartalyst\Stripe\Stripe;

class Admin extends Controller
{
    public function __construct(){
        $this->middleware(function ($request, $next){
            $is_logged_in = Session::get('admin_looged_in');
            if(!isset($is_logged_in) || $is_logged_in != '1'){
                return Redirect::to('admin')->send();
            }
            else{
                return $next($request);
            }
        }); 
         $this->common_model = new Common();
    }
    //Display admin dashboard
    public function dashboard(){
        $common_model = new Common();
        $stats['total_service_users'] = $common_model->getcount('users',[['status','!=', 2]]);
        $stats['total_retail_users'] = $common_model->getcount('users',[['status','!=', 2],['type_of_business','=',2]]);
        $stats['total_listings'] = $common_model->getcount('listing',[['status','=', 1]]);
        $stats['total_bookings'] = $common_model->getcount('booking_requests');
        $stats['total_earnings'] = 0;
        $recent_service_users = $common_model->selectdata('users',array('status' => 1,'type_of_business'=>1),array('id' => 'desc'),'0','5');
        $recent_retail_users = $common_model->selectdata('users',array('status' => 1,'type_of_business'=>2),array('id' => 'desc'),'0','5');
        $all_listings = $common_model->getlistingdetails(['listing.status'=>1],5);
        $recent_listings = $all_listings;
        return view('admin.dashboard')->with('stats',$stats)->with('recent_users',$recent_service_users)->with('recent_retail_users',$recent_retail_users)->with('recent_listings',$recent_listings);
    }

    public function logout(){
        Session::pull('admin_looged_in');
        Session::pull('admin_id');
        return redirect('admin');
    }
    //Display users to admin
    public function users(){
        $common_model = new Common();
        $users = $common_model->selectdata('users',[['status','!=', 2]],array('id' => 'desc'));
        $all_users = [];
        if(count($users)>0){
            foreach ($users as $user) {
                $user->listings = $common_model->getcount('listing',[['status','!=', 2],['user_id','=', $user->id]]);
                $user->bookings = $common_model->getcount('booking_requests',[['request_from','=', $user->id]]);
                array_push($all_users, $user);
            }
        }
        $type = 'service';
       
        return view('admin.users')->with(compact('all_users', 'type'));
    }
    // Display resources tags
    public function resourcestags(){
        $common_model = new Common();
        $tags = $common_model->selectdata('resources_tags',[['status','!=', 2]],array('id' => 'desc'));
        return view('admin.tags')->with(compact('tags'));
    }
     // Display resources list
    public function resourceslist(){
        $common_model = new Common();
        $resources = $common_model->selectdata('resources',[['status','!=', 2]],array('id' => 'desc'));
        return view('admin.resources')->with(compact('resources'));
    }
    public function partial_space_categories_list(){
        $common_model = new Common();
        $resources = $common_model->selectdata('categories',[['status','!=', 2]],array('id' => 'desc'));
        return view('admin.partial_space_categories')->with(compact('resources'));
    }
    public function retail_categories_list(){
        $common_model = new Common();
        $resources = $common_model->selectdata('retail_category',[['status','!=', 2]],array('id' => 'desc'));
        return view('admin.retail_categories')->with(compact('resources'));
    }
    public function ideal_categories_list(){
        $common_model = new Common();
        $resources = $common_model->selectdata('ideal_uses',[['status','!=', 2]],array('id' => 'desc'));
        return view('admin.ideal_categories')->with(compact('resources'));
    }
    public function amenties_list(){
        $common_model = new Common();
        $resources = $common_model->selectdata('amenities',[['status','!=', 2]],array('id' => 'desc'));
        return view('admin.amenities')->with(compact('resources'));
    }
    public function space_categories_list(){
        $common_model = new Common();
        $resources = $common_model->selectdata('space_type',[['status','!=', 2]],array('id' => 'desc'));
        return view('admin.space_categories')->with(compact('resources'));
    }
    public function resource_comments($id = ""){
        $common_model = new Common();
        $data['comments'] = $common_model->selectdata('resource_comments',[['status','!=', 2],['resource_id','=',$id]],array('id' => 'desc'));
        $data['resource'] = $common_model->getfirst('resources',array('id' => $id));
        return view('admin.resource-comments',$data);
    }
    public function retail_users(){
        $common_model = new Common();
        $users = $common_model->selectdata('users',[['status','!=', 2],['type_of_business','=',2]],array('id' => 'desc'));
        $all_users = [];
        if(count($users)>0){
            foreach ($users as $user) {
              
                $user->bookings = $common_model->getcount('booking_requests',[['request_from','=', $user->id]]);
                array_push($all_users, $user);
            }
        }
        $type = 'retail';
        
        return view('admin.users')->with(compact('all_users', 'type'));
    }
    public function faq_categories(){
        $common_model = new Common();
        $faq_cats = $common_model->selectdata('faq_categories',[['status','!=', 2]]);
        return view('admin.faq_categories')->with(compact('faq_cats'));
    }
    public function faq($cat_id=""){
        $common_model = new Common();
        $faq_cats = $common_model->getfirst('faq_categories',[['id','=',$cat_id]]);
        $faq = $common_model->selectdata('faq',[['status','!=', 2],['cat_id','=',$cat_id]]);
        return view('admin.faq')->with(compact('faq_cats','faq'));
    }
    //Display all brick listings
    public function listings(){
        $common_model = new Common();
        $all_listings = $this->common_model->getlistingdetails([['listing.status','!=',2],['listing.type','=',2]]);
        $recent_listings = [];
        if(count($all_listings)>0){
            foreach ($all_listings as $listing) {
               
                $listing->total_bookings = $common_model->getcount('booking_requests',[['listing_id','=', $listing->id]]);
               
                array_push($recent_listings, $listing);
            }
        }
       
        $type = 'Bricks';
        return view('admin.listings')->with('all_listings',$recent_listings)->with('type',$type);
    }

public function brand_listings(){
        $common_model = new Common();
        $all_listings = $this->common_model->getlistingdetails([['listing.status','!=',2],['listing.type','=',1]]);
        $recent_listings = [];
        if(count($all_listings)>0){
            foreach ($all_listings as $listing) {
               
                $listing->total_bookings = $common_model->getcount('booking_requests',[['listing_id','=', $listing->id]]);
               
                array_push($recent_listings, $listing);
            }
        }
        
        $type = 'Brands';
        return view('admin.listings')->with('all_listings',$recent_listings)->with('type',$type);
    }
    public function full_space_listings(){
        $common_model = new Common();
        $all_listings = $this->common_model->getlistingdetails([['listing.status','!=',2],['listing.type','=',3]]);
        $recent_listings = [];
        if(count($all_listings)>0){
            foreach ($all_listings as $listing) {
               
                $listing->total_bookings = $common_model->getcount('booking_requests',[['listing_id','=', $listing->id]]);
                
                array_push($recent_listings, $listing);
            }
        }
       
        $type = 'Full Space';
        return view('admin.listings')->with('all_listings',$recent_listings)->with('type',$type);
    }
    public function partial_space_listings(){
        $common_model = new Common();
        $all_listings = $this->common_model->getlistingdetails([['listing.status','!=',2],['listing.type','=',4]]);
        $recent_listings = [];
        if(count($all_listings)>0){
            foreach ($all_listings as $listing) {
               
                $listing->total_bookings = $common_model->getcount('booking_requests',[['listing_id','=', $listing->id]]);
                
                array_push($recent_listings, $listing);
            }
        }
        
        $type = 'Partial Space';
        return view('admin.listings')->with('all_listings',$recent_listings)->with('type',$type);
    }
    public function popup_store_listings(){
        $common_model = new Common();
        $all_listings = $this->common_model->getlistingdetails([['listing.status','!=',2],['listing.type','=',5]]);
        $recent_listings = [];
        if(count($all_listings)>0){
            foreach ($all_listings as $listing) {
                
                $listing->total_bookings = $common_model->getcount('booking_requests',[['listing_id','=', $listing->id]]);
               
                array_push($recent_listings, $listing);
            }
        }
       
        $type = 'Popup Store';
        return view('admin.listings')->with('all_listings',$recent_listings)->with('type',$type);
    }
    public function event_fairs_listings(){
        $common_model = new Common();
        $all_listings = $this->common_model->getlistingdetails([['listing.status','!=',2],['listing.type','=',6]]);
        $recent_listings = [];
        if(count($all_listings)>0){
            foreach ($all_listings as $listing) {
                
                $listing->total_bookings = $common_model->getcount('booking_requests',[['listing_id','=', $listing->id]]);
                
                array_push($recent_listings, $listing);
            }
        }
       
        $type = 'Event Fairs';
        return view('admin.listings')->with('all_listings',$recent_listings)->with('type',$type);
    }
   //Display all booking requests
    public function bookings(){
        $bookings = [];
        $common_model = new Common();
        $bookings = $common_model->getbookingRequestsadmin();
        
        return view('admin.bookings')->with('all_bookings',$bookings);
    }

    public function contactus(){
        $common_model = new Common();
        $all_contacts = $common_model->selectdata('contact_us',[['email','!=', '']],array('id' => 'desc'));
        return view('admin.contactus')->with('all_contacts',$all_contacts);
    }

    public function profile(){
        $common_model = new Common();
        $admin_id = Session::get('admin_id');
        $admin = $common_model->getfirst('admins',array('admin_id' => $admin_id));
        return view('admin.profile')->with('user',$admin);
    }

    public function edit_user($user_id = ""){
        $user = "";
        if(!empty($user_id)){
            $common_model = new Common();
            $user = $common_model->getfirst('users',array('id' => $user_id ));
            if(empty($user)){
                return abort(404);
            }
            if($user->type_of_business == 1){
                $type = 'service';
            }else{
                $type = 'retail';
            }
        }
        return view('admin.add_user')->with(compact('user_id', 'type'))->with('user',$user);
    }
    public function edit_faq_cat($cat_id = ""){
        $user = "";
        if(!empty($cat_id)){
            $common_model = new Common();
            $user = $common_model->getfirst('faq_categories',array('id' => $cat_id ));
            if(empty($user)){
                return abort(404);
            }
        }
        return view('admin.add_faq_cat')->with(compact('cat_id'))->with('category',$user);
    }
    public function edit_resource($cat_id = ""){
        $user = "";
        if(!empty($cat_id)){
            $common_model = new Common();
            $user = $common_model->getfirst('resources',array('id' => $cat_id ));
            $listing_images = $this->common_model->selectdata('listing_resouce_files',['resource_id'=>$cat_id]);
            $tags = explode(',',$user->tags);
            $res_tags = $common_model->selectdata('resources_tags',[['status','!=', 2]],array('name' => 'asc'));
            if(empty($user)){
                return abort(404);
            }
        }
        return view('admin.add_resource')->with(compact('cat_id','tags','res_tags'))->with('resource',$user)->with('listing_images',$listing_images);
    }
    
    public function check_tag_name(Request $request){
        $common_model = new Common();
        if($request->id){
             $check_mail=$common_model->getfirst('resources_tags',[['name','=',$request->name],['status','!=',2],['id','!=',$request->id]]);
        }else{
             $check_mail=$common_model->getfirst('resources_tags',[['name','=',$request->name],['status','!=',2]]);
        }
       
           if(empty($check_mail))
           {
            echo 'true';
           }
           else{
            echo 'false';
        }  
    }
    public function check_partial_cat_name(Request $request){
        $common_model = new Common();
        if($request->id){
             $check_mail=$common_model->getfirst('categories',[['name','=',$request->name],['status','!=',2],['id','!=',$request->id]]);
        }else{
             $check_mail=$common_model->getfirst('categories',[['name','=',$request->name],['status','!=',2]]);
        }
       
           if(empty($check_mail))
           {
            echo 'true';
           }
           else{
            echo 'false';
        }  
    }
    public function check_retail_cat_name(Request $request){
        $common_model = new Common();
        if($request->id){
             $check_mail=$common_model->getfirst('retail_category',[['name','=',$request->name],['status','!=',2],['id','!=',$request->id]]);
        }else{
             $check_mail=$common_model->getfirst('retail_category',[['name','=',$request->name],['status','!=',2]]);
        }
       
           if(empty($check_mail))
           {
            echo 'true';
           }
           else{
            echo 'false';
        }  
    }
    public function check_ideal_cat_name(Request $request){
        $common_model = new Common();
        if($request->id){
             $check_mail=$common_model->getfirst('ideal_uses',[['name','=',$request->name],['status','!=',2],['id','!=',$request->id]]);
        }else{
             $check_mail=$common_model->getfirst('ideal_uses',[['name','=',$request->name],['status','!=',2]]);
        }
       
           if(empty($check_mail))
           {
            echo 'true';
           }
           else{
            echo 'false';
        }  
    }
    public function check_space_cat_name(Request $request){
        $common_model = new Common();
        if($request->id){
             $check_mail=$common_model->getfirst('space_type',[['name','=',$request->name],['status','!=',2],['id','!=',$request->id]]);
        }else{
             $check_mail=$common_model->getfirst('space_type',[['name','=',$request->name],['status','!=',2]]);
        }
       
           if(empty($check_mail))
           {
            echo 'true';
           }
           else{
            echo 'false';
        }  
    }
    public function edit_tag($cat_id = ""){
        $user = "";
        if(!empty($cat_id)){
            $common_model = new Common();
            $user = $common_model->getfirst('resources_tags',array('id' => $cat_id ));
            if(empty($user)){
                return abort(404);
            }
        }
        return view('admin.add_tag')->with(compact('cat_id'))->with('tag',$user);
    }
    public function edit_partial_space_cat($cat_id = ""){
        $user = "";
        if(!empty($cat_id)){
            $common_model = new Common();
            $user = $common_model->getfirst('categories',array('id' => $cat_id ));
            if(empty($user)){
                return abort(404);
            }
        }
        return view('admin.add_partial_space_category')->with(compact('cat_id'))->with('tag',$user);
    }
    public function edit_retail_cat($cat_id = ""){
        $user = "";
        if(!empty($cat_id)){
            $common_model = new Common();
            $user = $common_model->getfirst('retail_category',array('id' => $cat_id ));
            if(empty($user)){
                return abort(404);
            }
        }
        return view('admin.add_retail_category')->with(compact('cat_id'))->with('tag',$user);
    }
    public function edit_ideal_cat($cat_id = ""){
        $user = "";
        if(!empty($cat_id)){
            $common_model = new Common();
            $user = $common_model->getfirst('ideal_uses',array('id' => $cat_id ));
            if(empty($user)){
                return abort(404);
            }
        }
        return view('admin.add_ideal_category')->with(compact('cat_id'))->with('tag',$user);
    }
    public function edit_amenities($cat_id = ""){
        $user = "";
        if(!empty($cat_id)){
            $common_model = new Common();
            $user = $common_model->getfirst('amenities',array('id' => $cat_id ));
            if(empty($user)){
                return abort(404);
            }
        }
        return view('admin.add_amenities_category')->with(compact('cat_id'))->with('tag',$user);
    }
    public function edit_space_cat($cat_id = ""){
        $user = "";
        if(!empty($cat_id)){
            $common_model = new Common();
            $user = $common_model->getfirst('space_type',array('id' => $cat_id ));
            if(empty($user)){
                return abort(404);
            }
        }
        return view('admin.add_space_category')->with(compact('cat_id'))->with('tag',$user);
    }
    public function add_resourcestag(){
        $user = "";
        $cat_id = 0;
        return view('admin.add_tag')->with(compact('cat_id'))->with('tag',$user);
    }
    public function add_resource(){
        $user = "";
        $common_model = new Common();
        $cat_id = 0;
        $tags = [];
         $listing_images = $this->common_model->selectdata('listing_resouce_files',['resource_id'=>$cat_id]);
        $res_tags = $common_model->selectdata('resources_tags',[['status','!=', 2]],array('name' => 'asc'));
        
        return view('admin.add_resource')->with(compact('cat_id','tags','res_tags'))->with('resource',$user)->with('listing_images',$listing_images);
    }
    public function add_partial_space_category(){
        $user = "";
        $cat_id = 0;
        return view('admin.add_partial_space_category')->with(compact('cat_id'))->with('tag',$user);
    }
    public function add_retail_category(){
        $user = "";
        $cat_id = 0;
        return view('admin.add_retail_category')->with(compact('cat_id'))->with('tag',$user);
    }
    public function add_ideal_category(){
        $user = "";
        $cat_id = 0;
        return view('admin.add_ideal_category')->with(compact('cat_id'))->with('tag',$user);
    }
    public function add_amenities_category(){
        $user = "";
        $cat_id = 0;
        return view('admin.add_amenities_category')->with(compact('cat_id'))->with('tag',$user);
    }
    public function add_space_category(){
        $user = "";
        $cat_id = 0;
        return view('admin.add_space_category')->with(compact('cat_id'))->with('tag',$user);
    }
    public function add_faq_question($cat_id = ""){
        $user = "";
        $id = "";
        return view('admin.add_faq')->with(compact('id','cat_id'))->with('faq',$user);
    }
    public function edit_question($id = ""){
        $user = "";
        $cat_id = "";
        if(!empty($id)){
            $common_model = new Common();
            $user = $common_model->getfirst('faq',array('id' => $id ));
            if(empty($user)){
                return abort(404);
            }
            $cat_id = $user->cat_id;
        }
        return view('admin.add_faq')->with(compact('id','cat_id'))->with('faq',$user);
    }
    public function add_faq_category(){
        $user = "";
        $cat_id = "";
        $category = [];
        return view('admin.add_faq_cat')->with(compact('cat_id'))->with('category',$user);
    }
    public function add_user(){
        $user = "";
        $user_id = '';
        $type = 'service';
        $type_of_business = 1;

        return view('admin.add_user')->with(compact('user_id', 'type','type_of_business'))->with('user',$user);
    }
    public function add_retail_user(){
        $user = "";
        $user_id = '';
        $type = 'retail';
        $type_of_business = 2;

        return view('admin.add_user')->with(compact('user_id', 'type','type_of_business'))->with('user',$user);
    }

    public function edit_location($location_id){
        $common_model = new Common();
        $location = $common_model->getfirst('user_locations',array('id' => $location_id ));
        if(empty($location)){
            return abort(404);
        }
        return view('admin.edit_location')->with('location',$location);
    }

    public function settings(){
        $common_model = new Common();
        $setting = $common_model->getfirst('settings',array('id' => '1' ));
        return view('admin.settings')->with('setting',$setting);
    }
    public function manageterms(){
        $common_model = new Common();
        $page = $common_model->selectdata('cms');
        return view('admin.manageterms')->with('page',$page);
    }

    public function manageprivacy(){
        $common_model = new Common();
        $page = $common_model->selectdata('cms');
        return view('admin.manageprivacy')->with('page',$page);
    }
    public function manageaboutus(){
        $common_model = new Common();
        $page = $common_model->selectdata('cms');
        return view('admin.manageaboutus')->with('page',$page);
    }
    public function managehome(){
        $common_model = new Common();
        $page = $common_model->selectdata('cms');
        return view('admin.managehome')->with('page',$page);
    }

    public function edit_brick($brick_id){
     
        $data['brick_details'] = $this->common_model->getfirst('listing',['id'=>$brick_id]);
        if(!empty($data['brick_details'])){
            $data['title'] = 'Edit Brick';
            $data['brands'] = $this->common_model->getdata('name,id','listing',['type'=>1,'user_id'=>$data['brick_details']->user_id],['name'=>'asc']);
            $members = $this->common_model->getdata('user_id','members',['listing_id'=>$brick_id]);
            $data['invited_members'] = [];
            if(count($members)>0){
                foreach ($members as $key) {
                    $data['invited_members'][] = $key->user_id;
                }
            }
            $data['retail_categories'] = $this->common_model->selectdata('retail_category',['status'=>1],['name'=>'asc']);
            $data['space_type'] = $this->common_model->selectdata('space_type',['brick_status'=>1],['name'=>'asc']);
            $data['users'] = $this->common_model->selectdata('users',[['status','=',1],['id','!=',$data['brick_details']->user_id]],['name'=>'asc']);
            $data['all_listings'] = $this->common_model->selectdata('listing',[['status','=',1],['type','!=',1],['type','!=',2]],['name'=>'asc']);
            $data['listing_images'] = $this->common_model->selectdata('listing_files',['listing_id'=>$brick_id,'type'=>1]);
            $data['collaboration_types'] = $this->common_model->selectdata('collaboration_type',['status'=>1]);
            $data['collaboration_types_arr'] = explode(',',$data['brick_details']->collaboration_type);
            $data['listing_files'] = $this->common_model->selectdata('listing_files',['listing_id'=>$brick_id,'type'=>2]);   
            $data['is_admin'] = 1;   
                 
            return view('user.add-brick',$data);
            
        }else{
            return abort(404);
        }
    }
    public function edit_brand($brand_id){
       $data['brand_details'] = $this->common_model->getfirst('listing',['id'=>$brand_id]);
        if(!empty($data['brand_details'])){
            $data['title'] = 'Edit Brand';
            $data['collaboration_types'] = $this->common_model->selectdata('collaboration_type',['status'=>1]);
            $data['collaboration_types_arr'] = explode(',',$data['brand_details']->collaboration_type);
            $data['retail_categories'] = $this->common_model->selectdata('retail_category',['status'=>1],['name'=>'asc']);
            $data['listing_images'] = $this->common_model->selectdata('listing_files',['listing_id'=>$brand_id,'type'=>1]);
            $data['listing_files'] = $this->common_model->selectdata('listing_files',['listing_id'=>$brand_id,'type'=>2]);          
            $data['is_admin'] = 1;         
            return view('user.add-brand',$data);
           
        }else{
            return abort(404);
        }
    }
    public function edit_full_space($fullspace_id){
        $data['fullspace_details'] = $this->common_model->getfirst('listing',['id'=>$fullspace_id]);
     
        if(!empty($data['fullspace_details'])){
            $data['title'] = 'Edit Full Space Listing';
            $data['space_type'] = $this->common_model->selectdata('space_type',['full_space_status'=>1],['name'=>'asc']); 
            $data['ideal_uses'] = $this->common_model->selectdata('ideal_uses',['status'=>1]);
            $data['ideal_uses_arr'] = explode(',', $data['fullspace_details']->ideal_uses);
            $data['amenities'] = $this->common_model->selectdata('amenities',['status'=>1]);
            $data['bricks'] = $this->common_model->selectdata('listing',['type'=>2,'user_id'=>$data['fullspace_details']->user_id],['name'=>'asc']);
            $data['avail_date'] = showDateFormatreturn($data['fullspace_details']->availability_date);
            $data['amenities_arr'] =  explode(',', $data['fullspace_details']->amenities);
            $data['listing_images'] = $this->common_model->selectdata('listing_files',['listing_id'=>$fullspace_id,'type'=>1]);
            $data['listing_files'] = $this->common_model->selectdata('listing_files',['listing_id'=>$fullspace_id,'type'=>2]);
            $data['is_admin'] = 1;   
            return view('user.add-full-space-landlord',$data);
           
        }else{
            return abort(404);
        }
        
    }
    public function edit_partial_space($partialspace_id){
        $data['partialspace_details'] = $this->common_model->getfirst('listing',['id'=>$partialspace_id]);
        if(!empty($data['partialspace_details'])){
            $data['title'] = 'Edit Partial Space Listing';
            $data['amenities'] = $this->common_model->selectdata('amenities',['status'=>1]);
            $data['avail_date'] = showDateFormatreturn($data['partialspace_details']->availability_date);
            $data['amenities_arr'] =  explode(',', $data['partialspace_details']->amenities);
            $data['categories'] = $this->common_model->selectdata('categories',['status'=>1],['name'=>'asc']);
            $data['listing_images'] = $this->common_model->selectdata('listing_files',['listing_id'=>$partialspace_id,'type'=>1]);
            $data['listing_files'] = $this->common_model->selectdata('listing_files',['listing_id'=>$partialspace_id,'type'=>2]);
            $data['bricks'] = $this->common_model->selectdata('listing',['type'=>2,'user_id'=>$data['partialspace_details']->user_id],['name'=>'asc']);
            $data['is_admin'] = 1;
            return view('user.add-partial-space-landlord',$data);
            
        }else{
            return abort(404);
        }
        
    }
    public function edit_popup_store($popup_id){
        $data['popuplandlord_details'] = $this->common_model->getfirst('listing',['id'=>$popup_id]);
        if(!empty($data['popuplandlord_details'])){
            $data['title'] = 'Edit Pop-Up Landlord';
            $data['amenities'] = $this->common_model->selectdata('amenities',['status'=>1]);
            $data['amenities_arr'] =  explode(',', $data['popuplandlord_details']->amenities);
            $data['space_type'] = $this->common_model->selectdata('space_type',['popup_status'=>1],['name'=>'asc']);
            $data['ideal_uses'] = $this->common_model->selectdata('ideal_uses',['status'=>1]);
            $data['ideal_uses_arr'] =  explode(',', $data['popuplandlord_details']->ideal_uses);
            $data['listing_images'] = $this->common_model->selectdata('listing_files',['listing_id'=>$popup_id,'type'=>1]);
            $data['listing_files'] = $this->common_model->selectdata('listing_files',['listing_id'=>$popup_id,'type'=>2]);
            $data['bricks'] = $this->common_model->selectdata('listing',['type'=>2,'user_id'=>$data['popuplandlord_details']->user_id],['name'=>'asc']);
            $data['is_admin'] = 1;
            return view('user.add-popup-landlord',$data);
          
        }else{
            return abort(404);
        }
    }
    public function edit_event_fairs($eventfairs_id){
        $data['eventsfairs_details'] = $this->common_model->getfirst('listing',['id'=>$eventfairs_id]);
        if(!empty($data['eventsfairs_details'])){
            $data['title'] = 'Edit Events Fairs Markets';
            $data['amenities'] = $this->common_model->selectdata('amenities',['status'=>1]);
            $data['bricks'] = $this->common_model->selectdata('listing',['type'=>2,'user_id'=>$data['eventsfairs_details']->user_id],['name'=>'asc']);
            $data['retail_categories'] = $this->common_model->selectdata('retail_category',['status'=>1],['name'=>'asc']);
            $data['amenities_arr'] =  explode(',', $data['eventsfairs_details']->amenities);
            $data['retail_categories_arr'] =  explode(',', $data['eventsfairs_details']->retail_category);
            $data['listing_images'] = $this->common_model->selectdata('listing_files',['listing_id'=>$eventfairs_id,'type'=>1]);
            $data['listing_files'] = $this->common_model->selectdata('listing_files',['listing_id'=>$eventfairs_id,'type'=>2]);
            $data['start_avail_date'] = showDateFormat($data['eventsfairs_details']->start_date_time);
            $data['end_avail_date'] =showDateFormat($data['eventsfairs_details']->end_date_time);
            $data['is_admin'] = 1;
            return view('user.add-events-fairs-markets',$data);           
        }else{
            return abort(404);
        }
    }

    public function change_user_status(Request $request){
        if(!empty($request->user_id)){
            $common_model = new Common();
            $update = $common_model->updatedata('users',array('status' => $request->user_status ),array('id' => $request->user_id));
            if($update){
                $message = $request->user_status == '2' ? 'User deleted successfully.' : 'User updated successfully.';
                Session::flash('message', $message);
                $data['status'] = 1;
            }
            else{
              $data['status'] = 0;  
            }
        }
        else{
            $data['status'] = 0;
        }
        return json_encode($data);
    }

    public function change_cat_status(Request $request){
        if(!empty($request->cat_id)){
            $common_model = new Common();
            $update = $common_model->updatedata('faq_categories',array('status' => $request->cat_status ),array('id' => $request->cat_id));
            if($update){
                $message = $request->cat_status == '2' ? 'Category deleted successfully.' : 'Category updated successfully.';
                Session::flash('message', $message);
                $data['status'] = 1;
            }
            else{
              $data['status'] = 0;  
            }
        }
        else{
            $data['status'] = 0;
        }
        return json_encode($data);
    }
    public function change_tag_status(Request $request){
        if(!empty($request->cat_id)){
            $common_model = new Common();
            $update = $common_model->updatedata('resources_tags',array('status' => $request->cat_status ),array('id' => $request->cat_id));
            if($update){
                $message = $request->cat_status == '2' ? 'Tag deleted successfully.' : 'Tag updated successfully.';
                Session::flash('message', $message);
                $data['status'] = 1;
            }
            else{
              $data['status'] = 0;  
            }
        }
        else{
            $data['status'] = 0;
        }
        return json_encode($data);
    }
    public function change_resource_status(Request $request){
        if(!empty($request->cat_id)){
            $common_model = new Common();
            $update = $common_model->updatedata('resources',array('status' => $request->cat_status ),array('id' => $request->cat_id));
            if($update){
                $message = $request->cat_status == '2' ? 'Resource deleted successfully.' : 'Resource updated successfully.';
                Session::flash('message', $message);
                $data['status'] = 1;
            }
            else{
              $data['status'] = 0;  
            }
        }
        else{
            $data['status'] = 0;
        }
        return json_encode($data);
    }
    public function change_partial_space_cat_status(Request $request){
        if(!empty($request->cat_id)){
            $common_model = new Common();
            $update = $common_model->updatedata('categories',array('status' => $request->cat_status ),array('id' => $request->cat_id));
            if($update){
                $message = $request->cat_status == '2' ? 'Category deleted successfully.' : 'Category updated successfully.';
                Session::flash('message', $message);
                $data['status'] = 1;
            }
            else{
              $data['status'] = 0;  
            }
        }
        else{
            $data['status'] = 0;
        }
        return json_encode($data);
    }
    public function change_retail_cat_status(Request $request){
        if(!empty($request->cat_id)){
            $common_model = new Common();
            $update = $common_model->updatedata('retail_category',array('status' => $request->cat_status ),array('id' => $request->cat_id));
            if($update){
                $message = $request->cat_status == '2' ? 'Category deleted successfully.' : 'Category updated successfully.';
                Session::flash('message', $message);
                $data['status'] = 1;
            }
            else{
              $data['status'] = 0;  
            }
        }
        else{
            $data['status'] = 0;
        }
        return json_encode($data);
    }
    public function change_ideal_cat_status(Request $request){
        if(!empty($request->cat_id)){
            $common_model = new Common();
            $update = $common_model->updatedata('ideal_uses',array('status' => $request->cat_status ),array('id' => $request->cat_id));
            if($update){
                $message = $request->cat_status == '2' ? 'Category deleted successfully.' : 'Category updated successfully.';
                Session::flash('message', $message);
                $data['status'] = 1;
            }
            else{
              $data['status'] = 0;  
            }
        }
        else{
            $data['status'] = 0;
        }
        return json_encode($data);
    }
    public function change_amenities_cat_status(Request $request){
        if(!empty($request->cat_id)){
            $common_model = new Common();
            $update = $common_model->updatedata('amenities',array('status' => $request->cat_status ),array('id' => $request->cat_id));
            if($update){
                $message = $request->cat_status == '2' ? 'Category deleted successfully.' : 'Category updated successfully.';
                Session::flash('message', $message);
                $data['status'] = 1;
            }
            else{
              $data['status'] = 0;  
            }
        }
        else{
            $data['status'] = 0;
        }
        return json_encode($data);
    }
    public function change_space_cat_status(Request $request){
        if(!empty($request->cat_id)){
            $common_model = new Common();
            if($request->field == 'Brick'){
                $update = $common_model->updatedata('space_type',array('brick_status' => $request->cat_status ),array('id' => $request->cat_id));
            }elseif($request->field == 'Full Space'){
                $update = $common_model->updatedata('space_type',array('full_space_status' => $request->cat_status ),array('id' => $request->cat_id));
            }elseif($request->field == 'Popup Store'){
                $update = $common_model->updatedata('space_type',array('popup_status' => $request->cat_status ),array('id' => $request->cat_id));
            }else{
                $update = $common_model->updatedata('space_type',array('status' => $request->cat_status ),array('id' => $request->cat_id));
            }
            
            if($update){
                $message = $request->cat_status == '2' ? 'Category deleted successfully.' : 'Category updated successfully.';
                Session::flash('message', $message);
                $data['status'] = 1;
            }
            else{
              $data['status'] = 0;  
            }
        }
        else{
            $data['status'] = 0;
        }
        return json_encode($data);
    }
    public function change_comment_status(Request $request){
        if(!empty($request->cat_id)){
            $common_model = new Common();
            $update = $common_model->updatedata('resource_comments',array('status' => $request->cat_status ),array('id' => $request->cat_id));
            if($update){
                $message = $request->cat_status == '2' ? 'Comment deleted successfully.' : 'Comment updated successfully.';
                Session::flash('message', $message);
                $data['status'] = 1;
            }
            else{
              $data['status'] = 0;  
            }
        }
        else{
            $data['status'] = 0;
        }
        return json_encode($data);
    }
    public function change_ques_status(Request $request){
        if(!empty($request->ques_id)){
            $common_model = new Common();
            $update = $common_model->updatedata('faq',array('status' => $request->ques_status ),array('id' => $request->ques_id));
            if($update){
                $message = $request->ques_status == '2' ? 'Question deleted successfully.' : 'Question updated successfully.';
                Session::flash('message', $message);
                $data['status'] = 1;
            }
            else{
              $data['status'] = 0;  
            }
        }
        else{
            $data['status'] = 0;
        }
        return json_encode($data);
    }

    public function update_page_info(Request $request){
        $post = $request->all();
        $file = $request->file('about_right_first_img');
        if(!empty($file)){
            $destinationPath = 'public/img';    
            $original_name = $file->getClientOriginalName();
            $file_name = str_replace(' ','_',time().$file->getClientOriginalName());
            if($file->move($destinationPath,$file_name)){
                $post['about_right_first_img'] = $file_name;
                $oldimg = $this->common_model->getfirst('cms',array('name'=>'about_right_first_img'));
                if(!empty($oldimg)){
                    File::delete($destinationPath.'/'.$oldimg->value);
                }
            }
        }
        $file = $request->file('about_right_second_img');
        if(!empty($file)){
            $destinationPath = 'public/img';    
            $original_name = $file->getClientOriginalName();
            $file_name = str_replace(' ','_',time().$file->getClientOriginalName());
            if($file->move($destinationPath,$file_name)){
                $post['about_right_second_img'] = $file_name;
                $oldimg = $this->common_model->getfirst('cms',array('name'=>'about_right_second_img'));
                if(!empty($oldimg)){
                    File::delete($destinationPath.'/'.$oldimg->value);
                }
            }
        }
        unset($post['_token']);
        if(!empty($post)){
            foreach($post as $key=>$value)
            {
                if(!$this->common_model->getfirst('cms',array('name'=>$key)))
                {
                    $this->common_model->InsertData('cms',array('name'=>$key));
                    $this->common_model->UpdateData('cms',array('value'=>$value),array('name'=>$key));
                }
                else
                {
                    $this->common_model->UpdateData('cms',array('value'=>$value),array('name'=>$key));
                }
            }
        }
        $message = 'Content updated successfully.';
        Session::flash('message', $message);
        $data['status'] = 1;
        return json_encode($data);
    }

    public function add_new_user(Request $request){
        if(!empty($request->email)){
            $common_model = new Common();
            if(empty($request->user_id)){
                $conditions = [['email','=', $request->email], ['status','!=', 2]];
            }
            else{
                $conditions = [['email','=', $request->email], ['status','!=', 2], ['id','!=', $request->user_id]];
            }
            $check = $common_model->getcount('users',$conditions);
            if($check == 0){
                $user_data = array(
                    'name' => $request->name, 
                    'last_name' => $request->last_name, 
                    'email' => $request->email, 
                    'password' => Hash::make($request->password), 
                    'company_name' => $request->company_name,
                    'business_number' => $request->business_number,
                    'is_verified' => 1,
                    'type_of_busines' => $request->type_of_busines
                );
                if(empty($request->user_id)){
                    $insert = $common_model->insertdata('users',$user_data);
                    $message = 'User added successfully.';
                    Session::flash('message', $message);
                    $data['status'] = 1;
                }
                else{
                    unset($user_data['password']);
                    $insert = $common_model->updatedata('users',$user_data,array('id' => $request->user_id));
                    $message = 'User updated successfully.';
                    Session::flash('message', $message);
                    $data['status'] = 1;
                }                
            }
            else{
                $data['status'] = 2;
            }
        }
        else{
            $data['status'] = 0;
        }
        return json_encode($data);
    }
    public function add_faq_cat(Request $request){
            if(!empty($request->name)){
                $common_model = new Common();
                if(empty($request->cat_id)){
                    $insert = $common_model->insertdata('faq_categories',['name'=>$request->name]);
                    $message = 'Category added successfully.';
                    Session::flash('message', $message);
                    $data['status'] = 1;
                }else{
                    $insert = $common_model->updatedata('faq_categories',['name'=>$request->name],array('id' => $request->cat_id));
                    $message = 'Category updated successfully.';
                    Session::flash('message', $message);
                    $data['status'] = 1;
                }
                
                return json_encode($data);
        }
    }
    public function add_resource_submit(Request $request){
           $post = $request->all();
         
          $all_uploaded_files = json_decode($post['all_uploaded_res_files']);
             
        
            if(!empty($request->title)){
                $data1['title'] = $request->title;
                $data1['description'] = $request->description;
                $data1['created_at'] = date('Y-m-d H:i:s');
                $data1['tags'] = implode(',',$request->tags);
                $file = $request->file('file');
                if(!empty($file)){
                    //Move Uploaded File
                    $destinationPath = 'uploads/files';
                    $original_name = $file->getClientOriginalName();
                    $file_name = str_replace(' ','_',time().$file->getClientOriginalName());
                    if($file->move($destinationPath,$file_name)){
                        $data1['file'] = $file_name;                  
                    }
                }
                
                 
                    
                $common_model = new Common();
                if(empty($request->resource_id)){
                    $insert = $common_model->insertdata('resources',$data1);
                        
                    
                    $message = 'Resource added successfully.';
                    Session::flash('message', $message);
                    $data['status'] = 1;
                }else{
                    
                    $insert = $common_model->updatedata('resources',$data1,array('id' => $request->resource_id));
                    $this->common_model->deletedata('listing_resouce_files',['resource_id'=>$request->resource_id]);
                    $insert=$request->resource_id;
                    $message = 'Resource updated successfully.';
                    Session::flash('message', $message);
                    $data['status'] = 1;
                }
                   
                
                if(!empty($all_uploaded_files)){
                        foreach ($all_uploaded_files as $key) {
                        if($key != '0'){
                        $ext = pathinfo(storage_path().'/uploads/files/'.$key.'', PATHINFO_EXTENSION);
                        $allowedMimeTypes = ['image/jpeg','image/jpg','image/gif','image/png'];
                        $contentType = mime_content_type('uploads/files/'.$key.'');
                        if(! in_array($contentType, $allowedMimeTypes) ){
                        $image = 2;
                        }else{
                        $image = 1;
                        }
                   $this->common_model->insertdata('listing_resouce_files',['name'=>$key,'type'=>'1','extension'=>$ext,'resource_id'=>$insert,'created_at'=>date('Y-m-d H:i:s')]);
             }
         }
       }
                
                return json_encode($data);
        }
    }
    public function add_tag(Request $request){
            if(!empty($request->name)){
                $common_model = new Common();
                if(empty($request->tag_id)){
                    $insert = $common_model->insertdata('resources_tags',['name'=>$request->name]);
                    $message = 'Tag added successfully.';
                    Session::flash('message', $message);
                    $data['status'] = 1;
                }else{
                    $insert = $common_model->updatedata('resources_tags',['name'=>$request->name],array('id' => $request->tag_id));
                    $message = 'Tag updated successfully.';
                    Session::flash('message', $message);
                    $data['status'] = 1;
                }
                
                return json_encode($data);
        }
    }
    public function add_partial_cat(Request $request){
            if(!empty($request->name)){
                $common_model = new Common();
                if(empty($request->tag_id)){
                    $insert = $common_model->insertdata('categories',['name'=>$request->name]);
                    $message = 'Category added successfully.';
                    Session::flash('message', $message);
                    $data['status'] = 1;
                }else{
                    $insert = $common_model->updatedata('categories',['name'=>$request->name],array('id' => $request->tag_id));
                    $message = 'Category updated successfully.';
                    Session::flash('message', $message);
                    $data['status'] = 1;
                }
                
                return json_encode($data);
        }
    }
    public function add_retail_cat(Request $request){
            if(!empty($request->name)){
                $common_model = new Common();
                if(empty($request->tag_id)){
                    $insert = $common_model->insertdata('retail_category',['name'=>$request->name]);
                    $message = 'Category added successfully.';
                    Session::flash('message', $message);
                    $data['status'] = 1;
                }else{
                    $insert = $common_model->updatedata('retail_category',['name'=>$request->name],array('id' => $request->tag_id));
                    $message = 'Category updated successfully.';
                    Session::flash('message', $message);
                    $data['status'] = 1;
                }
                
                return json_encode($data);
        }
    }
    public function add_ideal_cat(Request $request){
            if(!empty($request->name)){
                $common_model = new Common();
                if(empty($request->tag_id)){
                    $insert = $common_model->insertdata('ideal_uses',['name'=>$request->name]);
                    $message = 'Category added successfully.';
                    Session::flash('message', $message);
                    $data['status'] = 1;
                }else{
                    $insert = $common_model->updatedata('ideal_uses',['name'=>$request->name],array('id' => $request->tag_id));
                    $message = 'Category updated successfully.';
                    Session::flash('message', $message);
                    $data['status'] = 1;
                }
                
                return json_encode($data);
        }
    }
    public function add_amenities_cat(Request $request){
            if(!empty($request->name)){
                $common_model = new Common();
                if(empty($request->tag_id)){
                    $insert = $common_model->insertdata('amenities',['name'=>$request->name]);
                    $message = 'Category added successfully.';
                    Session::flash('message', $message);
                    $data['status'] = 1;
                }else{
                    $insert = $common_model->updatedata('amenities',['name'=>$request->name],array('id' => $request->tag_id));
                    $message = 'Category updated successfully.';
                    Session::flash('message', $message);
                    $data['status'] = 1;
                }
                
                return json_encode($data);
        }
    }
    public function add_space_cat(Request $request){
            if(!empty($request->name)){
                $common_model = new Common();
                if(empty($request->tag_id)){
                    $insert = $common_model->insertdata('space_type',['name'=>$request->name]);
                    $message = 'Category added successfully.';
                    Session::flash('message', $message);
                    $data['status'] = 1;
                }else{
                    $insert = $common_model->updatedata('space_type',['name'=>$request->name],array('id' => $request->tag_id));
                    $message = 'Category updated successfully.';
                    Session::flash('message', $message);
                    $data['status'] = 1;
                }
                
                return json_encode($data);
        }
    }
    public function add_edit_faq(Request $request){
            if(!empty($request->question)){
                $common_model = new Common();
                if(empty($request->id)){
                    $insert = $common_model->insertdata('faq',['question'=>$request->question,'answer'=>$request->answer,'cat_id'=>$request->cat_id]);
                    $message = 'Question added successfully.';
                    Session::flash('message', $message);
                    $data['status'] = 1;
                }else{
                    $insert = $common_model->updatedata('faq',['question'=>$request->question,'answer'=>$request->answer],array('id' => $request->id));
                    $message = 'Question updated successfully.';
                    Session::flash('message', $message);
                    $data['status'] = 1;
                }
                
                return json_encode($data);
        }
    }

    public function change_listing_status(Request $request){
        if(!empty($request->listing_id)){
            $common_model = new Common();
            $update = $common_model->updatedata('listing',array('status' => $request->listing_status),array('id' => $request->listing_id));
            if($update){
                Session::flash('message', "Listing updated successfully.");
                $data['status'] = 1;
            }
            else{
              $data['status'] = 0;  
            }
        }
        else{
            $data['status'] = 0;
        }
        return json_encode($data);
    }

    public function set_featured_listing(Request $request){
        if(!empty($request->listing_id)){
            $common_model = new Common();
            $update = $common_model->updatedata('listing',array('is_featured' => $request->listing_status),array('id' => $request->listing_id));
            if($update){
                Session::flash('message', "Listing updated successfully.");
                $data['status'] = 1;
            }
            else{
              $data['status'] = 0;  
            }
        }
        else{
            $data['status'] = 0;
        }
        return json_encode($data);
    }

    public function edit_profile(Request $request){
        if(!empty($request->email)){
            $admin_id = Session::get('admin_id');
            $common_model = new Common();
            $update = $common_model->updatedata('admins',array('name' => $request->name, 'email' => $request->email, 'phone' => $request->phone_number ),array('admin_id' => $admin_id));
            
            Session::put('admin_name',$request->name);
            Session::flash('message', "Profile updated successfully.");
            $data['status'] = 1;
            
           
        }
        else{
            $data['status'] = 0;
        }
        return json_encode($data);
    }

    public function update_location(Request $request){
        if(!empty($request->location_id)){
            $common_model = new Common();
            $loc_data = array( 
                'flat_number' => $request->flat_number, 
                'address' => $request->address, 
                'address2' => $request->address2, 
                'city' => $request->city, 
                'postcode' => $request->postcode
            );
            $update = $common_model->updatedata('user_locations',$loc_data,array('id' => $request->location_id));
            if($update){
                Session::flash('message', "Location updated successfully.");
                $data['status'] = 1;
            }
            else{
              $data['status'] = 0;  
            }
        }
        else{
            $data['status'] = 0;
        }
        return json_encode($data);
    }

    public function delete_location(Request $request){
        if(!empty($request->location_id)){
            $common_model = new Common();
            $update = $common_model->updatedata('user_locations',array('is_deleted' => '1'), array('id' => $request->location_id));
            if($update){
                Session::flash('message', "Location deleted successfully.");
                $data['status'] = 1;
            }
            else{
              $data['status'] = 0;  
            }
        }
        else{
            $data['status'] = 0;
        }
        return json_encode($data);
    }

    public function update_settings(Request $request){
        if(!empty($request->id)){
            $common_model = new Common();
            $update = $common_model->updatedata('settings',array('email' => $request->email,'phone' => $request->phone,'location' => $request->location,'insta_link' => $request->insta_link,'linkedin_link' => $request->linkedin_link,'pinterest_link' => $request->pinterest_link,'fb_link' => $request->fb_link,'lat' => $request->lat,'lng' => $request->lng,'twitter_link' => $request->twitter_link), array('id' => $request->id));
            Session::flash('message', "Settings updated successfully.");
            $data['status'] = 1;           
        }
        else{
            $data['status'] = 0;
        }
        return json_encode($data);
    }

    public function update_password(Request $request){
        if(!empty($request->old_password)){
            $common_model = new Common();
            $admin_id = Session::get('admin_id');
            $user = $common_model->getfirst('admins',array('admin_id' => $admin_id));
            $old_password = $request->old_password;
            $new_password = $request->new_password;
            
            if (Hash::check($old_password, $user->password)) {
                $update = $common_model->updatedata('admins',array('password' => Hash::make($new_password) ),array('admin_id' => $admin_id));
               
                    Session::flash('message', "Password updated successfully.");
                    $data['status'] = 1;
               
            }
            else{
                $data['status'] = 2;
            }
            
        }
        else{
            $data['status'] = 0;
        }
        return json_encode($data);
    }

    public function remove_listing(Request $request){
        if(!empty($request->listing_id)){
            $common_model = new Common();
            $update = $common_model->deletedata('user_listings',array('id' => $request->listing_id));
            if($update){
                Session::flash('message', "Listing deleted successfully.");
                $data['status'] = 1;
            }
            else{
              $data['status'] = 0;  
            }
        }
        else{
            $data['status'] = 0;
        }
        return json_encode($data);
    }
    public function viewenquiry($id=""){
        $common_model = new Common();
        $all_contacts =$common_model->getfirst('contact_us',array('id' => $id ));
        return view('admin.viewenquiry')->with('contact',$all_contacts);
    }
    public function delete_enquiry(Request $request){
        if(!empty($request->enq_id)){
            $common_model = new Common();
            $update = $common_model->deletedata('contact_us',array('id' => $request->enq_id));
            if($update){
                Session::flash('message', "Enquiry deleted successfully.");
                $data['status'] = 1;
            }
            else{
              $data['status'] = 0;  
            }
        }
        else{
            $data['status'] = 0;
        }
        return json_encode($data);
    }

}