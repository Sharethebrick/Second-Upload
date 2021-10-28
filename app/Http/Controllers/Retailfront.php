<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Redirect,Hash,Session,Mail,File;
use App\Common;
use App\User;
use App\MemberTask as TaskModel;
use App\TaskChat;

class Retailfront extends Controller
{
    public function __construct(){
        $this->common_model = new Common();
        $this->folder = 'retail.';
    }

    //Display meeting calender
    public function calender(){
        if(!Auth::check()){
            return redirect()->route('login');
          }
       $data['users'] = $this->common_model->selectdata('users',[['status','=',1],['id','!=',Auth::User()->id]],['name'=>'asc']);
       $data['events'] = $this->common_model->get_events_list(Auth::User()->id);
       return view('retail.calender',$data);
    }
    // Admin section start here
    public function admin_login(){
        $is_logged_in = Session::get('admin_looged_in');
        if(isset($is_logged_in) && $is_logged_in == '1'){
            return redirect('admin/dashboard');
        }
        return view('admin.login');
    }
    public function admin_do_login(Request $request){
        if(!empty($request->email) && !empty($request->password)){
            $common_model = new Common();
            $check_login = $common_model->getfirst('admins',array('status' => 1, 'email' => $request->email));
            if(!empty($check_login)){
                if (Hash::check($request->password, $check_login->password)) {
                    Session::put('admin_looged_in', '1');
                    Session::put('admin_id', $check_login->admin_id);
                    Session::put('admin_name', $check_login->name);
                    Auth::logout();
                    $data['status'] = 1;
                }
                else{
                    $data['status'] = 0;
                }
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

   // Admin section end here

    public function index(){
        $data['featured_listing'] = $this->common_model->getlistingdetails([['listing.status','=',1],['listing.plateform','=',1],['listing.is_featured','=',1],['listing.type','!=',1],['listing.type','!=',6],['listing.type','!=',2]],3);
        $data['featured_bricks'] = $this->common_model->getlistingdetails([['listing.status','=',1],['listing.plateform','=',1],['listing.is_featured','=',1],['listing.type','=',2]],3);
        $data['featured_listing_count'] = $this->common_model->getlistingdetails_count([['listing.status','=',1],['listing.plateform','=',1],['listing.is_featured','=',1],['listing.type','!=',1],['listing.type','!=',2]]);
        $data['page'] = $this->common_model->selectdata('cms');
        return view($this->folder.'index',$data);
    }
    public function featured_listing(){
        $data['listing'] = $this->common_model->getlistingdetails([['listing.status','=',1],['listing.type','!=',6],['listing.is_featured','=',1],['listing.plateform','=',1],['listing.type','!=',1],['listing.type','!=',2]],items_count());
        $data['total_count'] = $this->common_model->getlistingdetails_count([['listing.status','=',1],['listing.type','!=',6],['listing.plateform','=',1],['listing.is_featured','=',1],['listing.type','!=',1],['listing.type','!=',2]]);
        $data['is_featured'] = 1;
        return view($this->folder.'listing',$data);
    }
    public function aboutus(){
        $data['page'] = $this->common_model->selectdata('cms');
    	return view($this->folder.'about',$data);
    }
    public function listings(){
    	$data['title'] = 'Listings';
    	$data['link']  = url('/fullspacedetails');
        $data['listing'] = $this->common_model->getlistingdetails(['listing.status'=>1]);
    	return view($this->folder.'listing',$data);
    }

    public function bricks_listing(){
    	$data['title'] = 'Bricks Listings';
        $data['retail_categories'] = $this->common_model->selectdata('retail_category',['status'=>1],['name'=>'asc']);
        $data['space_type'] = $this->common_model->selectdata('space_type',['brick_status'=>1],['name'=>'asc']);
        $data['bricks'] = $this->common_model->getlistingdetails(['listing.status'=>1,'listing.type'=>2],items_count());
        // dd($data['bricks']);
        $data['bricks_count'] = $this->common_model->getlistingdetails_count(['listing.status'=>1,'listing.type'=>2]);
    	// dd($data['bricks_count']);
        $data['link']  = url('/brickdetails');
    	return view($this->folder.'bricks-listing',$data);
    }
    public function brick_details($id){
    	$data['title'] = 'Brick Details';
        $data['list_details'] = $this->common_model->getfirst('listing',['id'=>$id]);
        $data['listing_owner'] = $this->common_model->getfirst('users',['id'=>$data['list_details']->user_id]);
        $data['space_type'] = $this->common_model->getdata('name,id','space_type',['id'=>$data['list_details']->space_type]);
        $collaboration = explode(',',$data['list_details']->collaboration_type);
        $collaboration_data = array();
        $catdata =  explode(',', $data['list_details']->collaboration_type);
        foreach ($catdata as $cat) {
           $collaboration_data[] = $cat;
        }
        $data['collaboration_cat'] =  $this->common_model->selectdata('collaboration_type','','','','',$collaboration_data);
        $data['retail_cat'] = $this->common_model->getfirst('retail_category',['id'=>$data['list_details']->retail_category]);
        $data['listing_images'] = $this->common_model->selectdata('listing_files',['listing_id'=>$id,'type'=>1]);
        $data['listing_files'] = $this->common_model->selectdata('listing_files',['listing_id'=>$id,'type'=>2]);
        $data['brand_details'] = $this->common_model->getlistingdetails(['listing.status'=>1,'listing.id'=>$data['list_details']->brand]);
        $data['members'] = $this->common_model->getmembers_list(['members.status'=>1,'members.listing_id'=>$data['list_details']->id]);
        
        if(Auth::check()){
            $data['isapplied'] = $this->common_model->getfirst('booking_requests',['request_from'=>Auth::User()->id,'listing_id'=>$id]);
            $data['member_invited'] = $this->common_model->getfirst('members',['listing_id'=>$data['list_details']->id,'user_id'=>Auth::User()->id]);
        }else{
            $data['isapplied'] = [];
            $data['member_invited'] = [];
        }

        if(empty($data['list_details'])){
           return abort(404);
        }
         $data['external_title'] = $data['list_details']->link_title;
         $data['description'] = $data['list_details']->link_desc;
         $external_link =  $data['list_details']->link_image;
         if (@getimagesize($external_link)) {
            $data['external_link'] = $external_link;
          } else {
            $data['external_link'] = url("/").'/uploads/files/dummy_listing.jpg';
          }
       
        $data['list_associated'] = $this->common_model->getlistingdetails(['listing.status'=>1,'listing.id'=>$data['list_details']->associated_listing]);

        //   Group Files 

        $data['group_images'] = $this->common_model->getGroupFiles($id,1);
        $data['group_files'] = $this->common_model->getGroupFiles($id,2);
        if(Auth::check()){
            // $data['events'] = $this->common_model->get_events_list(Auth::User()->id);
            $data['other_members'] = $this->common_model->getBrickmembers($id,Auth::User()->id);
            $data['brickOwner'] = $this->common_model->getBrickOwner($id);
        }    
    	return view($this->folder.'listdetails-brick',$data);
    }

    function getCalendar(){
        // $data['events'] = $this->common_model->get_events_list(Auth::User()->id);
        return view($this->folder.'get-calendar');
    }


    function getTasks(Request $request){
        
        $data = [];
        // $task = TaskModel::where( 'assigned_by' , Auth::id() )->where('brick_id',$request->brick_id)->get();
        // $task1 = TaskModel::where( 'assigned_to' , Auth::id() )->where('brick_id',$request->brick_id)->get();
        $task1 = TaskModel::where('brick_id',$request->brick_id)->get();
        // $data['member_tasks'] = $task->merge($task1);
        
        $data['member_tasks'] = $task1;
		
        return view('retail.get-tasks',$data);
    }
    function updateNote(Request $request){
        $validator = Validator::make($request->all() , [
            'note' => 'required',
        ]);
        if ($validator->fails() && $request->ajax())
        {
            $data = [
                'status'    =>  0,
                'message'   =>  $validator->getMessageBag()->first()
            ];
            return json_encode($data); 
        }
        
        if($request->taskId !="" && $request->note !=""){
           
            $taskId = TaskModel::where('id',$request->taskId)->update(['note' => $request->note]);
            // if($taskId){
                $data['status'] = 1;
            // }
            // else{
            //     dd("dsssssg");
            //     $data = [
			// 		'status'    =>  0,
			// 		'message'   =>  'Something went wrong'
			// 	];
            // }
        }else{
            dd("dag");
            $data = [
                'status'    =>  0,
                'message'   =>  'Something went wrong'
            ];
        }
        return json_encode($data);
    }

    // Get task chat view with data
    function getTaskNote(Request $request){
        $data['taskMsg'] = TaskChat::where('task_id',$request->task_id)->get(); 
        $data['task_id'] = $request->task_id;
        return view('retail.user.get-task-chat',$data);
    }
    

    
    public function brands_listing(){
    	$data['title'] = 'Brands Listings';
        $data['retail_categories'] = $this->common_model->selectdata('retail_category',['status'=>1],['name'=>'asc']);
        $data['collaboration_types'] = $this->common_model->selectdata('collaboration_type',['status'=>1]);
        $data['brands'] = $this->common_model->getlistingdetails(['listing.status'=>1,'listing.type'=>1],items_count());
        $data['brands_count'] = $this->common_model->getlistingdetails_count(['listing.status'=>1,'listing.type'=>1]);
    	$data['link']  = url('/branddetails');
    	return view($this->folder.'brands-listing',$data);
    }
    public function brands_details($id){
    	$data['title'] = 'Brand Details';
        $data['list_details'] = $this->common_model->getfirst('listing',['id'=>$id]);
        $data['listing_images'] = $this->common_model->selectdata('listing_files',['listing_id'=>$id,'type'=>1]);
        $data['listing_files'] = $this->common_model->selectdata('listing_files',['listing_id'=>$id,'type'=>2]);
        $data['bricks_details'] = $this->common_model->getlistingdetails(['listing.status'=>1,'listing.type'=>2,'listing.brand'=>$id]);
        $data['listing_owner'] = $this->common_model->getfirst('users',['id'=>$data['list_details']->user_id]);
        $data['retail_cat'] = $this->common_model->getfirst('retail_category',['id'=>$data['list_details']->retail_category]);
        $collaboration_data = array();
        $catdata =  explode(',', $data['list_details']->collaboration_type);
        foreach ($catdata as $cat) {
           $collaboration_data[] = $cat;
        }
        $data['collaboration_cat'] =  $this->common_model->selectdata('collaboration_type','','','','',$collaboration_data);
        if(empty($data['list_details'])){
           return abort(404);
        }
        if(Auth::check()){
            $data['isapplied'] = $this->common_model->getfirst('booking_requests',['request_from'=>Auth::User()->id,'listing_id'=>$id]);
        }else{
            $data['isapplied'] = [];
        }
    	return view($this->folder.'listdetails',$data);
    }
    public function full_space_listing(){
        $data['title'] = 'Full Space Listings';
        $data['link']  = url('/fullspacedetails');
        $data['ideal_uses'] = $this->common_model->selectdata('ideal_uses',['status'=>1]);
        $data['amenities'] = $this->common_model->selectdata('amenities',['status'=>1]);
        $data['fullspacelisting'] = $this->common_model->getlistingdetails(['listing.status'=>1,'listing.type'=>3],items_count());
        $data['fullspacelisting_count'] = $this->common_model->getlistingdetails_count(['listing.status'=>1,'listing.type'=>3]);
        // dd($data['fullspacelisting_count']);
        return view($this->folder.'full-spacelisting',$data);
    }
    public function view_profile($id){
    	$data['user'] = $this->common_model->getfirst('users',['id'=>$id]);
    	return view($this->folder.'user-profile',$data);
    }
    public function fullspace_details($id){
    	$data['title'] = 'Full Space Details';
        $data['list_details'] = $this->common_model->getfirst('listing',['id'=>$id]);
        $data['propert_type'] = $this->common_model->getfirst('space_type',['id'=>$data['list_details']->space_type]);
        $data['listing_images'] = $this->common_model->selectdata('listing_files',['listing_id'=>$id,'type'=>1]);
        $data['listing_files'] = $this->common_model->selectdata('listing_files',['listing_id'=>$id,'type'=>2]);
        $data['bricks_details'] = $this->common_model->getlistingdetails(['listing.status'=>1,'listing.type'=>2,'listing.id'=>$data['list_details']->brand]);
        $data['listing_owner'] = $this->common_model->getfirst('users',['id'=>$data['list_details']->user_id]);
        $amenities_data = array();
        $catdata =  explode(',', $data['list_details']->amenities);
        foreach ($catdata as $cat) {
           $amenities_data[] = $cat;
        }
        $data['amenities_data_cat'] =  $this->common_model->selectdata('amenities','','','','',$amenities_data);
        $idealuses_arr = array();
        $catdata =  explode(',', $data['list_details']->ideal_uses);
        foreach ($catdata as $cat) {
           $idealuses_arr[] = $cat;
        }
        $data['ideal_uses_cat'] =  $this->common_model->selectdata('ideal_uses','','','','',$idealuses_arr);
        if(empty($data['list_details'])){
           return abort(404);
        }
        if(Auth::check()){
            $data['isapplied'] = $this->common_model->getfirst('booking_requests',['request_from'=>Auth::User()->id,'listing_id'=>$id]);
        }else{
            $data['isapplied'] = [];
        }
    	return view($this->folder.'listdetails',$data);
    }
    public function partial_space_listing(){
    	$data['link']  = url('/partialspacedetails');
    	$data['title'] = 'Partial Space Listings';
        $data['ideal_uses'] = $this->common_model->selectdata('ideal_uses',['status'=>1]);
        $data['amenities'] = $this->common_model->selectdata('amenities',['status'=>1]);
        $data['partialspacelisting'] = $this->common_model->getlistingdetails(['listing.status'=>1,'listing.type'=>4],items_count());
        $data['partialspacelisting_count'] = $this->common_model->getlistingdetails_count(['listing.status'=>1,'listing.type'=>4]);
    	return view($this->folder.'partial-spacelisting',$data);
    }
    public function partialspace_details($id){
    	$data['title'] = 'Partial Space Details';
        $data['list_details'] = $this->common_model->getfirst('listing',['id'=>$id]);
        $data['listing_images'] = $this->common_model->selectdata('listing_files',['listing_id'=>$id,'type'=>1]);
        $data['listing_files'] = $this->common_model->selectdata('listing_files',['listing_id'=>$id,'type'=>2]);
        $amenities_data = array();
        $data['listing_owner'] = $this->common_model->getfirst('users',['id'=>$data['list_details']->user_id]);
        $catdata =  explode(',', $data['list_details']->amenities);
        foreach ($catdata as $cat) {
           $amenities_data[] = $cat;
        }
        $data['amenities_data_cat'] =  $this->common_model->selectdata('amenities','','','','',$amenities_data);
        $data['bricks_details'] = $this->common_model->getlistingdetails(['listing.status'=>1,'listing.type'=>2,'listing.associated_listing'=>$data['list_details']->id]);
        $data['category_data'] =  $this->common_model->getfirst('categories',['id'=>$data['list_details']->current_use]);
        if(empty($data['list_details'])){
           return abort(404);
        }
        if(Auth::check()){
            $data['isapplied'] = $this->common_model->getfirst('booking_requests',['request_from'=>Auth::User()->id,'listing_id'=>$id]);
        }else{
            $data['isapplied'] = [];
        }
    	return view($this->folder.'listdetails',$data);
    }
    public function popup_store_listing(){
    	$data['title'] = 'Popup Store Listings';
    	$data['link']  = url('/popupstoredetails');
        $data['amenities'] = $this->common_model->selectdata('amenities',['status'=>1]);
        $data['space_type'] = $this->common_model->selectdata('space_type',['popup_status'=>1],['name'=>'asc']);
        $data['ideal_uses'] = $this->common_model->selectdata('ideal_uses',['status'=>1]);
        $data['popupstorelisting'] = $this->common_model->getlistingdetails(['listing.status'=>1,'listing.type'=>5],items_count());
        $data['popupstorelisting_count'] = $this->common_model->getlistingdetails_count(['listing.status'=>1,'listing.type'=>5]);
    	return view($this->folder.'popup-storelisting',$data);
    }
    public function popupstore_details($id){
    	$data['title'] = 'Popup Store Details';
        $data['list_details'] = $this->common_model->getfirst('listing',['id'=>$id]);
        $data['listing_images'] = $this->common_model->selectdata('listing_files',['listing_id'=>$id,'type'=>1]);
        $data['listing_files'] = $this->common_model->selectdata('listing_files',['listing_id'=>$id,'type'=>2]);
        $amenities_data = array();
        $data['listing_owner'] = $this->common_model->getfirst('users',['id'=>$data['list_details']->user_id]);
        $catdata =  explode(',', $data['list_details']->amenities);
        foreach ($catdata as $cat) {
           $amenities_data[] = $cat;
        }
        $data['amenities_data_cat'] =  $this->common_model->selectdata('amenities','','','','',$amenities_data);
        $idealuses_arr = array();
        $catdata =  explode(',', $data['list_details']->ideal_uses);
        foreach ($catdata as $cat) {
           $idealuses_arr[] = $cat;
        }
        $data['ideal_uses_cat'] =  $this->common_model->selectdata('ideal_uses','','','','',$idealuses_arr);
        $data['bricks_details'] = $this->common_model->getlistingdetails(['listing.status'=>1,'listing.type'=>2,'listing.associated_listing'=>$data['list_details']->id]);
        if(empty($data['list_details'])){
           return abort(404);
        }
        if(Auth::check()){
            $data['isapplied'] = $this->common_model->getfirst('booking_requests',['request_from'=>Auth::User()->id,'listing_id'=>$id]);
        }else{
            $data['isapplied'] = [];
        }
    	return view($this->folder.'listdetails',$data);
    }
    public function event_fair_listing(){
    	$data['title'] = 'Event Fairs Listings';
    	$data['link']  = url('/eventdetails');
        $data['retail_categories'] = $this->common_model->selectdata('retail_category',['status'=>1],['name'=>'asc']);
        $data['amenities'] = $this->common_model->selectdata('amenities',['status'=>1]);
        $data['event_fair_listing'] = $this->common_model->getlistingdetails(['listing.status'=>1,'listing.type'=>6],items_count());
        $data['event_fair_listing_count'] = $this->common_model->getlistingdetails_count(['listing.status'=>1,'listing.type'=>6]);
        // dd($data['event_fair_listing'], $data['event_fair_listing_count']);
    	return view($this->folder.'event-fairlisting',$data);
    }
    public function event_details($id){
    	$data['title'] = 'Event Details';
        $data['list_details'] = $this->common_model->getfirst('listing',['id'=>$id]);
        $data['listing_images'] = $this->common_model->selectdata('listing_files',['listing_id'=>$id,'type'=>1]);
        $data['listing_files'] = $this->common_model->selectdata('listing_files',['listing_id'=>$id,'type'=>2]);
        $amenities_data = array();
        $data['listing_owner'] = $this->common_model->getfirst('users',['id'=>$data['list_details']->user_id]);
        $catdata =  explode(',', $data['list_details']->amenities);
        foreach ($catdata as $cat) {
           $amenities_data[] = $cat;
        }
        $data['amenities_data_cat'] =  $this->common_model->selectdata('amenities','','','','',$amenities_data);
        $data['bricks_details'] = $this->common_model->getlistingdetails(['listing.status'=>1,'listing.type'=>2,'listing.associated_listing'=>$data['list_details']->id]);
        if(empty($data['list_details'])){
           return abort(404);
        }
        if(Auth::check()){
            $data['isapplied'] = $this->common_model->getfirst('booking_requests',['request_from'=>Auth::User()->id,'listing_id'=>$id]);
        }else{
            $data['isapplied'] = [];
        }
    	return view($this->folder.'listdetails',$data);
    }
    public function categories(){
    	return view($this->folder.'categories');
    }
    public function resources(){
        $data['tag_searched'] = '';
        $data['keyword'] = '';
        if(isset($_GET['tag']) && $_GET['tag']){
            if(isset($_GET['keyword']) && $_GET['keyword']){
                $condition = 'FIND_IN_SET('.$_GET['tag'].',tags) AND (title like "%'.$_GET['keyword'].'%" OR description like "%'.$_GET['keyword'].'%")';
                $data['keyword'] = $_GET['keyword'];
            }else{
                $condition = 'FIND_IN_SET('.$_GET['tag'].',tags)';
            }
            $resources = $this->common_model->selectdata('resources',['status'=>1],'','','','',$condition);
            $data['tag_searched'] = $_GET['tag'];
        }else{
            $resources = $this->common_model->selectdata('resources',['status'=>1]);
        }
        $data['allresources'] = [];
        if(count($resources)>0){
            foreach ($resources as $key) {
                $key->tags_used = $this->common_model->selectdata('resources_tags',['status'=>1],'','','',explode(',',$key->tags));
                $data['allresources'][] = $key;
            }
        }
        $data['popular'] = $this->common_model->selectdata('resources',['status'=>1],['id'=>'desc'],0,4);
        $data['tags'] = $this->common_model->selectdata('resources_tags',[['status','=', 1]],array('name' => 'asc'));
        return view($this->folder.'resources',$data);
    }
    public function search_resources(Request $request){
        $post = $request->all();
        $data['tag_searched'] = '';
        $data['keyword'] = '';
        if($post['keyword']){
            if($post['tag']){
                $where = 'FIND_IN_SET('.$post['tag'].',tags) AND (title like "%'.$post['keyword'].'%" OR description like "%'.$post['keyword'].'%")';
                $data['tag_searched'] = $post['tag'];
            }else{
                $where = '(title like "%'.$post['keyword'].'%" OR description like "%'.$post['keyword'].'%")';
            }
            $data['keyword'] = $post['keyword'];
            $resources = $this->common_model->selectdata('resources',['status'=>1],'','','','',$where);
        }else{
            if($post['tag']){
                $where = 'FIND_IN_SET('.$post['tag'].',tags)';
                $data['tag_searched'] = $post['tag'];
            }else{
                $where = '';
            }
            $resources = $this->common_model->selectdata('resources',['status'=>1],'','','','',$where);
        }
        $data['allresources'] = [];
        if(count($resources)>0){
            foreach ($resources as $key) {
                $key->tags_used = $this->common_model->selectdata('resources_tags',['status'=>1],'','','',explode(',',$key->tags));
                $data['allresources'][] = $key;
            }
        }
        $data['popular'] = $this->common_model->selectdata('resources',['status'=>1],['id'=>'desc'],0,4);
        $data['tags'] = $this->common_model->selectdata('resources_tags',[['status','=', 1]],array('name' => 'asc'));
    	return view($this->folder.'resources',$data);
    }
    public function resource_details($id=''){
        $data['resource_details'] = $this->common_model->getfirst('resources',['id'=>$id]);
        $data['popular'] = $this->common_model->selectdata('resources',['status'=>1],['id'=>'desc'],0,4);
        $data['tags'] = $this->common_model->selectdata('resources_tags',[['status','=', 1]],array('name' => 'asc'));
        $data['id'] = $id;
        $data['comments'] = $this->common_model->getresource_comments($id);
    	return view($this->folder.'resource-details',$data);
    }
    public function contact(){
        $data['settings'] = getSettings();
    	return view($this->folder.'contact',$data);
    }
    public function help(){
        $data['faq_cat'] = $this->common_model->selectdata('faq_categories',['status'=>1]);
        $i = 0;
        if(count($data['faq_cat'])>0){
            foreach ($data['faq_cat'] as $key) {
                $key->faq = $this->common_model->selectdata('faq',['status'=>1,'cat_id'=>$key->id]);
                if(count($key->faq)>0 && $i == 0){
                    $key->active = 1;
                    $i = 1;
                }else{
                   $key->active = 0;
                }
            }
        }
    	return view($this->folder.'help',$data);
    }
    public function fetchData($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
    public function login(){
        Session::put('previous_url', url()->previous());
        if(Auth::check()){
            return redirect('/');
        }
        if(isset($_GET['resource_id'])){
            $data['resource_id'] = $_GET['resource_id'];
        }else{
            $data['resource_id'] = '';
        }
        return view($this->folder.'login',$data);
    }
    public function signup(Request $request){
        $data['type'] = '';
        if ($request->has('type')) {
               $data['type'] = $request->input('type');
        }
        if(Auth::check()){
            return redirect('/');
        }
        return view($this->folder.'signup',$data);

    }
    public function forgotpassword(){
        return view($this->folder.'forgot-password');
    }
    public function privacypolicy(){
        $data['page'] = $this->common_model->selectdata('cms');
        return view($this->folder.'privacy-policy', $data);
    }
    public function termsconditions(){
        $data['page'] = $this->common_model->selectdata('cms');
        return view($this->folder.'terms-conditions',$data);
    }
    public function do_login(Request $request){
        if(!empty($request->email)){
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_verified' => 1, 'status' => [1]])) {
                    $common_model = new Common();
                    $common_model->updatedata('users',array('logged_at' => date('Y-m-d H:i:s')),array('id' => Auth::id()));
                    $data['status'] = 1;
                    $data['redirect_to'] = 0;
                    $redirect_to = Session::get('previous_url');
                    if(isset($redirect_to) && $redirect_to){
                        $data['redirect_to'] = $redirect_to;
                    }
            }else{
                $common_model = new Common();
                $check=$common_model->getfirst('users',[['email','=',$request->email],['status','=',1]]);
                if(!empty($check)){
                    if($check->is_verified != 1){
                        $data['status'] = 2;
                    }else{
                        $data['status'] = 0;
                    }
                }else{
                    $data['status'] = 0;
                }

            }
        }
        else{
            $data['status'] = 0;
        }
         return json_encode($data);
    }
    public function checking_user(Request $request)
    {
        $common_model = new Common();
        if(Auth::check()){
            $check_mail=$common_model->getfirst('users',[['email','=',$request->email],['status','!=',2],['id','!=',Auth::User()->id]]);
        }else{
            $check_mail=$common_model->getfirst('users',[['email','=',$request->email],['status','!=',2]]);
        }

           if(empty($check_mail))
           {
            echo 'true';
           }
           else{
            echo 'false';
        }
    }
    public function checking_user_forgot(Request $request)
    {
        $common_model = new Common();
        $check_mail=$common_model->getfirst('users',[['email','=',$request->email],['status','!=',2]]);
           if(empty($check_mail))
           {
            echo 'false';
           }
           else{
            echo 'true';
        }
    }
    public function forgot_password(Request $request)
    {
       if(!empty($request->email)){
            $common_model = new Common();
            $check = $common_model->getfirst('users',array('email' => $request->email));
            if(!empty($check)){
                if($check->status == 1){
                    $token = hexdec(uniqid());
                    $common_model->updatedata('users',array('token' => $token),array('id' => $check->id ));
                    $reset_link = url('/').'/resetpassword/'.$token;
                    $email_data = array('username' => $check->name, 'reset_link' => $reset_link);
                    $email_to = $check->email;
                    $name_to = $check->name.' '.$check->last_name;
                    Mail::send('emails.forgot', $email_data, function($message) use ($name_to, $email_to){
                     $message->to($email_to, $name_to)->subject
                        ('Reset Password - Share The Brick');
                     $message->from(config('app.MAIL_FROMADDRESS'),'Share The Brick');
                    });
                    $data['status'] = 1;
                }elseif($check->status == 0){
                    $data['status'] = 2;
                }else{
                    $data['status'] = 0;
                }

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
    public function resetpassword($token){
        $common_model = new Common();
        $check_token = $common_model->getfirst('users',array('token' => $token, 'status' => 1));
        if(!empty($check_token)){
           $user_id = $check_token->id;
        }
       else{
            $user_id = 0;
       }
        return view($this->folder.'resetpassword')->with('user_id',$user_id);
    }
    public function verify_email($token){
        $common_model = new Common();
        $check_token = $common_model->getfirst('users',array('verify_token' => $token));
        if(!empty($check_token)){
            $common_model->updatedata('users',array('verify_token' => '','is_verified'=>1,'email_verified_at'=>date('Y-m-d H:i:s')),array('id' => $check_token->id ));
            $data['message'] = 'Email verified successfully. Click <a href="'.url('/login').'"> <input type="button" name="submit" id="submit" class="submit" value="Login" style="background-color: #088dd3;color: #ffffff;border: none;padding: 13px 23px 13px 25px;text-align: left;border-radius: 30px;-webkit-transition: 0.5s;transition: 0.5s;position: relative;font-weight: bold;font-size: 14.5px;font-family: "Cabin", sans-serif;font-weight: 600;"></a> for login.';
        }
        else{
            $data['message'] = 'Invalid Link.';
       }
       $data['title'] = 'Verify Email';
       return view($this->folder.'error',$data);
    }
    public function logout(){
        Auth::logout();
        return redirect('login');
    }
     public function do_signup(Request $request){
        if(!empty($request->email)){
            $common_model = new Common();
             $file = $request->file('image');
            $image_name = '';
            // print_r($request->file('image'));die;
            if(!empty($file)){
                //Move Uploaded File
                $destinationPath = 'uploads/user';
                $original_name = $file->getClientOriginalName();
                $file_name = str_replace(' ','_',time().$file->getClientOriginalName());
                if($file->move($destinationPath,$file_name)){
                    $image_name = $file_name;
                }
            }

            $user_data = array(
                'name' => $request->name,
                'last_name' => $request->last_name,
                'created_at' => date('Y-m-d H:i:s'),
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'company_name' => $request->company_name,
                'company_address' => $request->company_address,
                'business_number' => $request->business_number,
                'business_email' => $request->business_email,
                'website' => $request->website,
                'image' => $image_name,
                'business_desc' => $request->business_desc,
                'facebook_lnk' => $request->facebook_lnk,
                'instagram_lnk' => $request->instagram_lnk,
                'twitter_lnk' => $request->twitter_lnk,
                'type_of_busines' => $request->type_of_busines
            );
            $insert = $common_model->insertdata('users',$user_data);
            $token = hexdec(uniqid());
            $common_model->updatedata('users',array('verify_token' => $token),array('id' => $insert ));
            $verify_link = url('/').'/verify-email/'.$token;
            $email_data = array('username' => $request->name, 'verify_link' => $verify_link);
            $email_to = $request->email;
            $name_to = $request->name.' '.$request->last_name;
            Mail::send('emails.welcome', $email_data, function($message) use ($name_to, $email_to){
             $message->to($email_to, $name_to)->subject
                ('Verify Email - Share The Brick');
             $message->from(config('app.MAIL_FROMADDRESS'),'Share The Brick');
            });
             $data['status'] = 1;
        }else{
            $data['status'] = 0;
        }
        return json_encode($data);
    }


    public function set_password(Request $request){
        if(!empty($request->password)){
            $common_model = new Common();
            $update = $common_model->updatedata('users',array('password' => Hash::make($request->password), 'token' => ''),array('id' => $request->user_id));
            if($update){
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
    public function contactus(Request $request){
        if(!empty($request->email) && !empty($request->message)){
            $cont_data = array(
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone_number,
                'message' => $request->message,
                'plateform' => 1,
                'user_id' => Auth::check() ? Auth::id() : 0
            );
            $common_model = new Common();
            $insert = $common_model->insertdata('contact_us',$cont_data);

            if($insert){
                $settings = $common_model->getfirst('settings',array('id' => '1'));
                $email_to = $settings->email;
                $cont_data['message1'] = $request->message;
                Mail::send('emails.contactus', $cont_data, function($message) use ($email_to){
                 $message->to($email_to, 'Share The Brick')->subject
                    ('Contact us - Share The Brick');
                 $message->from(config('app.MAIL_FROMADDRESS'),'Share The Brick');
                });
                echo '1';
            }
            else{
                echo '0';
            }
        }
    }
}

