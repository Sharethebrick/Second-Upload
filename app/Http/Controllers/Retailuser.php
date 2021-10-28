<?php

namespace App\Http\Controllers;
require_once('../stripe-php-sdk/init.php');
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Redirect,Hash,Session,File,Exception,DateTime,Mail;
use App\Common;
use Carbon\Carbon;
use Stripe\Error\Card;
use Cartalyst\Stripe\Stripe;
use DB;
class Retailuser extends Controller
{
    public function __construct(){
       $this->middleware('auth');
        $this->common_model = new Common();
        $this->folder = 'retail.';
    }
    // Add new meeting
     public function add_meeting(Request $request){
        if(isset($request->invited_to)){
             $data['title'] = $request->title;
             $data['created_by'] = Auth::User()->id;
            $data['invited_to'] = implode(',',$request->invited_to);
            $date_create = date_create($request->datetime);
            $data['datetime'] = date_format($date_create,"Y-m-d").'T'.date_format($date_create,"H:i:s");
            $data['created_at']  = date('Y-m-d H:i:s');
            
            $insert = $this->common_model->insertdata('calender_events',$data);
            foreach ($request->invited_to as $key ) {
                
                $user_details = $this->common_model->getfirst('users',['id'=>$key]);
                $link = url('').'/'.getUrl().'/calender';
                  $email_data = array('username' => $user_details->name.' '.$user_details->last_name, 'type' => 'Meeting', 'date' => showOnlyDateFormat3($request->datetime), 'id'=>$insert,'title'=>$request->title,'link'=>$link);
                  $email_to = $user_details->email;
                  $name_to = $user_details->name.' '.$user_details->last_name;
                  Mail::send('emails.meeting', $email_data, function($message) use ($name_to, $email_to){
                     $message->to($email_to, $name_to)->subject
                        ('Meeting Invitation');
                     $message->from(config('app.MAIL_FROMADDRESS'),'Share The Brick');
                    });
            }
            $data['status'] = 1;
        }else{
            $data['status'] = 2;
        } 
       
        return json_encode($data);
    }
    public function addservices(){
       
        $common_model = new Common();
        $data['title'] = 'Business Services';
        $data['collaboration_types'] = $common_model->selectdata('collaboration_type',['status'=>1]);
        $data['retail_categories'] = $common_model->selectdata('retail_category',['status'=>1],['name'=>'asc']);

        if(empty(Auth::User()->type_of_busines) || empty(Auth::User()->company_name) || empty(Auth::User()->company_address) || empty(Auth::User()->business_number) || empty(Auth::User()->business_desc) ){
            return redirect(url('').'/'.getUrl().'/profile-settings')->with('infomessage', 'complete the profile');
        }else{
            return view($this->folder.'user.add-services',$data);
           
        }


    }
    public function edit_service($brand_id,Request $request){
        $data['brand_details'] = $this->common_model->getfirst('listing',['id'=>$brand_id]);
        if(!empty($data['brand_details'])){
            $data['title'] = 'Edit Brand';
            $data['listing_images'] = $this->common_model->selectdata('listing_files',['listing_id'=>$brand_id,'type'=>1]);
            $data['listing_files'] = $this->common_model->selectdata('listing_files',['listing_id'=>$brand_id,'type'=>2]);
            if(!($data['brand_details']->user_id == Auth::User()->id)){
                return abort(404);
            }else{
                return view($this->folder.'user.add-services',$data);
            }
        }else{
            return abort(404);
        }


    }
    public function userservices(){
        $data['title'] = 'User Services Listings';
        $popup = $this->common_model->getlistingdetailscategory(['listing.status'=>1,'listing.type'=>7,'listing.user_id'=>Auth::User()->id],items_count());
        $data['popupstorelisting_count'] = $this->common_model->getlistingdetailscategorycount(['listing.status'=>1,'listing.type'=>7,'listing.user_id'=>Auth::User()->id]);

        if(count($popup)>0){
            foreach ($popup as $key) {
               $popup_data = array();
               $catdata =  explode(',', $key->ideal_uses);
               foreach ($catdata as $cat) {
                   $popup_data[] = $cat;
                }
               $key->ideal_uses_cat =  $this->common_model->selectdata('ideal_uses','','','','',$popup_data);
            }
        }
        $data['amenities'] = $this->common_model->selectdata('amenities',['status'=>1]);
        $data['space_type'] = $this->common_model->selectdata('space_type',['popup_status'=>1],['name'=>'asc']);
        $data['ideal_uses'] = $this->common_model->selectdata('ideal_uses',['status'=>1]);
        $data['popuplandlord'] = $popup;
        return view($this->folder.'user.listing',$data);
    }
    public function addbrick(){
        $data['brands'] = $this->common_model->getdata('name,id','listing',['type'=>1,'status' => 1,'user_id'=>Auth::User()->id],['name'=>'asc']);
        $data['title'] = 'Add Brick';
        $data['invited_members_list'] = [];
        $data['collaboration_types'] = $this->common_model->selectdata('collaboration_type',['status'=>1]);
        $data['retail_categories'] = $this->common_model->selectdata('retail_category',['status'=>1],['name'=>'asc']);
        $data['space_type'] = $this->common_model->selectdata('space_type',['brick_status'=>1],['name'=>'asc']);
        $data['users'] = $this->common_model->selectdata('users',[['status','=',1],['id','!=',Auth::User()->id]],['name'=>'asc']);
        $data['all_listings'] = $this->common_model->selectdata('listing',[['status','=',1],['type','!=',1],['type','!=',2]],['name'=>'asc']);
        if(isset($_GET['id'])){
            $data['associated'] = $_GET['id'];
        }else{
            $data['associated'] = '';
        }
        
            $checking_listing = $this->common_model->getfirst('listing',[['status','=',1],['type','!=',1],['type','!=',2],['user_id','=',Auth::User()->id]]);
            if(!empty($checking_listing)){
                 return view($this->folder.'error',array('message'=>'You cannot create brick, Because you have already created your own listing.','title'=>'Add Brick'));
            }else{
                return view($this->folder.'user.add-brick',$data);
            }

    }
     public function delete_card(Request $request){
        if(!empty($request->id)){
            $this->common_model->updatedata('user_cards',['status'=>2],['id'=>$request->id]);
            $data['status'] = 1;
        }
        else{
            $data['status'] = 0;
        }
        return json_encode($data);
    }
    public function delete_search_history(Request $request){
        if(!empty($request->id)){
            $this->common_model->deletedata('saved_search',['id'=>$request->id]);
            $data['status'] = 1;
        }
        else{
            $data['status'] = 0;
        }
        return json_encode($data);
    }
     public function save_card(Request $request){
        
        if(!empty($request->cardNumber)){
            $exp_date = explode(' / ', $request->cardExpiry);
            \Stripe\Stripe::setApiKey(config('app.STRIPE_SECRET'));
                try {
                    $token = \Stripe\Token::create([
                        'card' => [
                        'number' => $request->cardNumber,
                        'exp_month' => $exp_date[0],
                        'exp_year' => $exp_date[1],
                        'cvc' => $request->cardCVC
                        ],
                    ]);
                    if (!isset($token['id'])) {
                        $data['status'] = 0;
                        $data['msg'] = "Stripe token not created.";
                    }

                    $customer = \Stripe\Customer::create(array(
                        'name' => $request->card_holder_name,
                        'email' => Auth::User()->email,
                        'source' => $token['id']
                    ));

                    if (!empty($customer) && !empty($customer["id"])) {
                        $customerId = $customer["id"];
                        $stripe_card_id = $customer["default_source"];
                        $last_four = substr($request->cardNumber,-4);
                        if(getUrl() == 'retail'){
                            $post_data['platform'] = 1;
                        }elseif(getUrl() == 'office'){
                            $post_data['platform'] = 2;
                        }elseif(getUrl() == 'residential'){
                            $post_data['platform'] = 3;
                        }

                        $post_data['user_id']  = Auth::id();
                        $post_data['card_number']  = $last_four;
                        $post_data['card_type']  = $request->cardType;
                        $post_data['card_holder_name']  = $request->card_holder_name;
                        $post_data['customer_id']  = $customerId;
                        $post_data['stripe_card_id']  = $stripe_card_id;
                        $post_data['status']  = 1;
                        $post_data['created_at']  = date('Y-m-d H:i:s');

                       
                        $insert = $this->common_model->insertdata('user_cards',$post_data);

                        $data['status'] = 1;
                        $data['card_id'] = $insert;
                    }
                    else {
                        $data['msg'] = $this->response->responseServerError();
                        $data['status'] = 0;
                    }
                }
                catch (Exception $e) {
                    $data['msg'] = $e->getMessage();
                    $data['status'] = 0;
                } catch(\Cartalyst\Stripe\Exception\CardErrorException $e) {
                    $data['msg'] = $e->getMessage();
                    $data['status'] = 0;
                } catch(\Cartalyst\Stripe\Exception\MissingParameterException $e) {
                    $data['msg'] = $e->getMessage();
                    $data['status'] = 0;
                }

        }
        else{
            $data['status'] = 0;
            $data['msg'] = "Error while adding card, please try later.";
        }
        return json_encode($data);
    }
    public function addbrand(){
       
        $common_model = new Common();
        $data['title'] = 'Brand Profile';
        $data['collaboration_types'] = $common_model->selectdata('collaboration_type',['status'=>1]);
        $data['retail_categories'] = $common_model->selectdata('retail_category',['status'=>1],['name'=>'asc']);
      
        if(empty(Auth::User()->type_of_busines) || empty(Auth::User()->company_name) || empty(Auth::User()->company_address) || empty(Auth::User()->business_number) || empty(Auth::User()->business_desc) ){
            return redirect(url('').'/'.getUrl().'/profile-settings')->with('infomessage', 'complete the profile');
        }else{
            return view($this->folder.'user.add-brand',$data);
            // return abort(404);
        }


    }
    public function add_resource_comment(Request $request)
    {
        $post = $request->all();
        $save_data['name'] = $post['name'];
        $save_data['comment'] = $post['comment'];
        $save_data['website'] = $post['website'];
        $save_data['resource_id'] = $post['resource_id'];
        $save_data['email'] = $post['email'];
        $save_data['user_id'] = Auth::User()->id;
        $save_data['created_at'] = date('Y-m-d H:i:s');
        $insert = $this->common_model->insertdata('resource_comments',$save_data);
        $data['status'] = 1;
        return json_encode($data);
    }
    public function addretailcategory(){
        return view($this->folder.'user.add-retail-category');
    }
    public function saved_searches(){
        $data['search_history'] = $this->common_model->selectdata('saved_search',['user_id'=>Auth::User()->id],['id'=>'desc']);
        return view($this->folder.'user.saved-searches',$data);
    }
    public function addfullspacelandlord(){
        $data['title'] = 'Full Space Listing';
        $data['space_type'] = $this->common_model->selectdata('space_type',['full_space_status'=>1],['name'=>'asc']);
        $data['ideal_uses'] = $this->common_model->selectdata('ideal_uses',['status'=>1]);
        $data['amenities'] = $this->common_model->selectdata('amenities',['status'=>1]);
        $data['bricks'] = $this->common_model->selectdata('listing',['type'=>2,'user_id'=>Auth::User()->id],['name'=>'asc']);
      
        if(empty(Auth::User()->type_of_busines) || empty(Auth::User()->company_name) || empty(Auth::User()->company_address) || empty(Auth::User()->business_number) || empty(Auth::User()->business_desc) ){
            return redirect(url('').'/'.getUrl().'/profile-settings')->with('infomessage', 'complete the profile');
        }else{
          return view($this->folder.'user.add-full-space-landlord',$data);
        }
       
    }
    public function addpartialspacelandlord(){
        $data['title']  = 'Partial Space Landlord';
        $data['categories'] = $this->common_model->selectdata('categories',['status'=>1],['name'=>'asc']);
        $data['amenities'] = $this->common_model->selectdata('amenities',['status'=>1]);
        $data['bricks'] = $this->common_model->selectdata('listing',['type'=>2,'user_id'=>Auth::User()->id],['name'=>'asc']);
       
        if(empty(Auth::User()->type_of_busines) || empty(Auth::User()->company_name) || empty(Auth::User()->company_address) || empty(Auth::User()->business_number) || empty(Auth::User()->business_desc) ){
            return redirect(url('').'/'.getUrl().'/profile-settings')->with('infomessage', 'complete the profile');
        }
        else{
          return view($this->folder.'user.add-partial-space-landlord',$data);
        }
        
    }
    public function addpopuplandlord(){
        $data['title'] = 'Pop-Up Landlord';
        $data['space_type'] = $this->common_model->selectdata('space_type',['popup_status'=>1],['name'=>'asc']);
        $data['ideal_uses'] = $this->common_model->selectdata('ideal_uses',['status'=>1]);
        $data['amenities'] = $this->common_model->selectdata('amenities',['status'=>1]);
        $data['bricks'] = $this->common_model->selectdata('listing',['type'=>2,'user_id'=>Auth::User()->id],['name'=>'asc']);
     
        if(empty(Auth::User()->type_of_busines) || empty(Auth::User()->company_name) || empty(Auth::User()->company_address) || empty(Auth::User()->business_number) || empty(Auth::User()->business_desc) ){
            return redirect(url('').'/'.getUrl().'/profile-settings')->with('infomessage', 'complete the profile');
        }
        else{
          return view($this->folder.'user.add-popup-landlord',$data);
        }
        

    }
    public function addeventsfairsmarkets(){
        $data['title'] = 'Events Fairs Markets';
        $data['retail_categories'] = $this->common_model->selectdata('retail_category',['status'=>1],['name'=>'asc']);
        $data['amenities'] = $this->common_model->selectdata('amenities',['status'=>1]);
        $data['bricks'] = $this->common_model->selectdata('listing',['type'=>2,'user_id'=>Auth::User()->id],['name'=>'asc']);
     
          return view($this->folder.'user.add-events-fairs-markets',$data);
       

    }
    public function profilesettings(){
        return view($this->folder.'user.profile-settings');
    }
    public function categories(){
        return view($this->folder.'user.categories');
    }
    public function edit_brick($brick_id,Request $request){
        $data['brick_details'] = $this->common_model->getfirst('listing',['id'=>$brick_id]);
        if(!empty($data['brick_details'])){
            $data['title'] = 'Edit Brick';
            $data['brands'] = $this->common_model->getdata('name,id','listing',['type'=>1,'user_id'=>Auth::User()->id],['name'=>'asc']);
            $members = $this->common_model->getdata('user_id','members',['listing_id'=>$brick_id]);
            $data['invited_members'] = [];
            $data['invited_members_list'] = [];
            if(count($members)>0){
                foreach ($members as $key) {
                    if($key->user_id){
                        $data['invited_members'][] = $key->user_id;
                        $data['invited_members_list'][] = $this->common_model->getfirst('users',['id'=>$key->user_id]);
                    }
                }
            }
            $data['retail_categories'] = $this->common_model->selectdata('retail_category',['status'=>1],['name'=>'asc']);
            $data['space_type'] = $this->common_model->selectdata('space_type',['brick_status'=>1],['name'=>'asc']);
            $data['users'] = $this->common_model->selectdata('users',[['status','=',1],['id','!=',Auth::User()->id]],['name'=>'asc']);
            $data['all_listings'] = $this->common_model->selectdata('listing',[['status','=',1],['type','!=',1],['type','!=',2]],['name'=>'asc']);
            $data['listing_images'] = $this->common_model->selectdata('listing_files',['listing_id'=>$brick_id,'type'=>1]);
            $data['collaboration_types'] = $this->common_model->selectdata('collaboration_type',['status'=>1]);
            $data['collaboration_types_arr'] = explode(',',$data['brick_details']->collaboration_type);
            $data['listing_files'] = $this->common_model->selectdata('listing_files',['listing_id'=>$brick_id,'type'=>2]);
            if(!($data['brick_details']->user_id == Auth::User()->id)){
                return abort(404);
            }else{
                return view($this->folder.'user.add-brick',$data);
            }
        }else{
            return abort(404);
        }


    }
    public function edit_brand($brand_id,Request $request){
        $data['brand_details'] = $this->common_model->getfirst('listing',['id'=>$brand_id]);
        if(!empty($data['brand_details'])){
            $data['title'] = 'Edit Brand';
            $data['collaboration_types'] = $this->common_model->selectdata('collaboration_type',['status'=>1]);
            $data['collaboration_types_arr'] = explode(',',$data['brand_details']->collaboration_type);
            $data['retail_categories'] = $this->common_model->selectdata('retail_category',['status'=>1],['name'=>'asc']);
            $data['listing_images'] = $this->common_model->selectdata('listing_files',['listing_id'=>$brand_id,'type'=>1]);
            $data['listing_files'] = $this->common_model->selectdata('listing_files',['listing_id'=>$brand_id,'type'=>2]);
            if(!($data['brand_details']->user_id == Auth::User()->id)){
                return abort(404);
            }else{
                return view($this->folder.'user.add-brand',$data);
            }
        }else{
            return abort(404);
        }


    }
    public function edit_fullspace($fullspace_id,Request $request){
        $data['fullspace_details'] = $this->common_model->getfirst('listing',['id'=>$fullspace_id]);
        if(!empty($data['fullspace_details'])){
            $data['title'] = 'Edit Full Space Listing';
            $data['space_type'] = $this->common_model->selectdata('space_type',['full_space_status'=>1],['name'=>'asc']);
            $data['ideal_uses'] = $this->common_model->selectdata('ideal_uses',['status'=>1]);
            $data['ideal_uses_arr'] = explode(',', $data['fullspace_details']->ideal_uses);
            $data['amenities'] = $this->common_model->selectdata('amenities',['status'=>1]);
            $data['bricks'] = $this->common_model->selectdata('listing',['type'=>2,'user_id'=>Auth::User()->id],['name'=>'asc']);
            $data['avail_date'] = showDateFormatreturn($data['fullspace_details']->availability_date);
            $data['amenities_arr'] =  explode(',', $data['fullspace_details']->amenities);
            $data['listing_images'] = $this->common_model->selectdata('listing_files',['listing_id'=>$fullspace_id,'type'=>1]);
            $data['listing_files'] = $this->common_model->selectdata('listing_files',['listing_id'=>$fullspace_id,'type'=>2]);
            if(!($data['fullspace_details']->user_id == Auth::User()->id)){
                return abort(404);
            }else{
                return view($this->folder.'user.add-full-space-landlord',$data);
            }
        }else{
            return abort(404);
        }


    }

    public function edit_partialspace($partialspace_id,Request $request){
        $data['partialspace_details'] = $this->common_model->getfirst('listing',['id'=>$partialspace_id]);
        if(!empty($data['partialspace_details'])){
            $data['title'] = 'Edit Partial Space Listing';
            $data['amenities'] = $this->common_model->selectdata('amenities',['status'=>1]);
            $data['avail_date'] = showDateFormatreturn($data['partialspace_details']->availability_date);
            $data['amenities_arr'] =  explode(',', $data['partialspace_details']->amenities);
            $data['categories'] = $this->common_model->selectdata('categories',['status'=>1],['name'=>'asc']);
            $data['listing_images'] = $this->common_model->selectdata('listing_files',['listing_id'=>$partialspace_id,'type'=>1]);
            $data['listing_files'] = $this->common_model->selectdata('listing_files',['listing_id'=>$partialspace_id,'type'=>2]);
            $data['bricks'] = $this->common_model->selectdata('listing',['type'=>2,'user_id'=>Auth::User()->id],['name'=>'asc']);
            if(!($data['partialspace_details']->user_id == Auth::User()->id)){
                return abort(404);
            }else{
                return view($this->folder.'user.add-partial-space-landlord',$data);
            }
        }else{
            return abort(404);
        }


    }
    public function edit_popuplandlord($popup_id,Request $request){
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
            $data['bricks'] = $this->common_model->selectdata('listing',['type'=>2,'user_id'=>Auth::User()->id],['name'=>'asc']);
            if(!($data['popuplandlord_details']->user_id == Auth::User()->id)){
                return abort(404);
            }else{
                return view($this->folder.'user.add-popup-landlord',$data);
            }
        }else{
            return abort(404);
        }


    }
    public function edit_eventsfairs($eventfairs_id,Request $request){
        $data['eventsfairs_details'] = $this->common_model->getfirst('listing',['id'=>$eventfairs_id]);
        if(!empty($data['eventsfairs_details'])){
            $data['title'] = 'Edit Events Fairs Markets';
            $data['amenities'] = $this->common_model->selectdata('amenities',['status'=>1]);
            $data['retail_categories'] = $this->common_model->selectdata('retail_category',['status'=>1],['name'=>'asc']);
            $data['amenities_arr'] =  explode(',', $data['eventsfairs_details']->amenities);
            $data['retail_categories_arr'] =  explode(',', $data['eventsfairs_details']->retail_category);
            $data['bricks'] = $this->common_model->selectdata('listing',['type'=>2,'user_id'=>Auth::User()->id],['name'=>'asc']);
            $data['listing_images'] = $this->common_model->selectdata('listing_files',['listing_id'=>$eventfairs_id,'type'=>1]);
            $data['listing_files'] = $this->common_model->selectdata('listing_files',['listing_id'=>$eventfairs_id,'type'=>2]);
            $data['start_avail_date'] = showDateFormat($data['eventsfairs_details']->start_date_time);
            $data['end_avail_date'] =showDateFormat($data['eventsfairs_details']->end_date_time);
            if(!($data['eventsfairs_details']->user_id == Auth::User()->id)){
                return abort(404);
            }else{
                return view($this->folder.'user.add-events-fairs-markets',$data);
            }
        }else{
            return abort(404);
        }


    }
    // $members = $this->common_model->getdata('user_id','members',['listing_id'=>$brick_id]);
    public function userbricks(){
        $data['title'] = 'User Bricks';
        $data['retail_categories'] = $this->common_model->selectdata('retail_category',['status'=>1],['name'=>'asc']);
        $data['space_type'] = $this->common_model->selectdata('space_type',['brick_status'=>1],['name'=>'asc']);
        $bricks= $this->common_model->getlistingdetails(['listing.status'=>1,'listing.type'=>2,'listing.user_id'=>Auth::User()->id],items_count());
        //get bricks has member
        $memberBricks = $this->common_model->getMemberBricks(Auth::user()->id);
        // dd($data['bricks']);
        $data['bricks'] = $bricks;
        if(!empty($memberBricks)){
            
            $data['bricks'] = $bricks->merge($memberBricks);
        }
        
      
        $data['bricks_count'] = $this->common_model->getlistingdetails_count(['listing.status'=>1,'listing.type'=>2,'listing.user_id'=>Auth::User()->id]);
        
        return view($this->folder.'user.listing',$data);
    }
    public function userbrands(){
        $data['title'] = 'User Brands';
        $data['retail_categories'] = $this->common_model->selectdata('retail_category',['status'=>1],['name'=>'asc']);
        $data['collaboration_types'] = $this->common_model->selectdata('collaboration_type',['status'=>1]);
        $brands = $this->common_model->getlistingdetailscategory(['listing.status'=>1,'listing.type'=>1,'listing.user_id'=>Auth::User()->id],items_count());
        $data['brands_count'] = $this->common_model->getlistingdetailscategorycount(['listing.status'=>1,'listing.type'=>1,'listing.user_id'=>Auth::User()->id]);

        if(count($brands)>0){
            foreach ($brands as $key) {
               $brands_data = array();
               $catdata =  explode(',', $key->collaboration_type);
               foreach ($catdata as $cat) {
                   $brands_data[] = $cat;
                }
               $key->collaboration_cat =  $this->common_model->selectdata('collaboration_type','','','','',$brands_data);
            }
        }
        $data['brands'] = $brands;

        return view($this->folder.'user.listing',$data);
    }
    public function userfullspace(){
        $data['title'] = 'User Full Space Listings';
        $data['ideal_uses'] = $this->common_model->selectdata('ideal_uses',['status'=>1]);
        $data['amenities'] = $this->common_model->selectdata('amenities',['status'=>1]);
        $data['fullspace'] = $this->common_model->getlistingdetailscategory(['listing.status'=>1,'listing.type'=>3,'listing.user_id'=>Auth::User()->id],items_count());
        $data['fullspacelisting_count'] = $this->common_model->getlistingdetailscategorycount(['listing.status'=>1,'listing.type'=>3,'listing.user_id'=>Auth::User()->id]);
        return view($this->folder.'user.listing',$data);
    }
    public function userpartialspaces(){
        $data['title'] = 'User Partial Space Listings';
        $data['ideal_uses'] = $this->common_model->selectdata('ideal_uses',['status'=>1]);
        $data['amenities'] = $this->common_model->selectdata('amenities',['status'=>1]);
        $data['partialspace'] = $this->common_model->getlistingdetailscategory(['listing.status'=>1,'listing.type'=>4,'listing.user_id'=>Auth::User()->id],items_count());
        $data['partialspacelisting_count'] = $this->common_model->getlistingdetailscategorycount(['listing.status'=>1,'listing.type'=>4,'listing.user_id'=>Auth::User()->id]);
        return view($this->folder.'user.listing',$data);
    }
    public function userpopuplandloard(){
        $data['title'] = 'User Pop Up Landloard Listings';
        $popup = $this->common_model->getlistingdetailscategory(['listing.status'=>1,'listing.type'=>5,'listing.user_id'=>Auth::User()->id],items_count());
        $data['popupstorelisting_count'] = $this->common_model->getlistingdetailscategorycount(['listing.status'=>1,'listing.type'=>5,'listing.user_id'=>Auth::User()->id]);

        if(count($popup)>0){
            foreach ($popup as $key) {
               $popup_data = array();
               $catdata =  explode(',', $key->ideal_uses);
               foreach ($catdata as $cat) {
                   $popup_data[] = $cat;
                }
               $key->ideal_uses_cat =  $this->common_model->selectdata('ideal_uses','','','','',$popup_data);
            }
        }
        $data['amenities'] = $this->common_model->selectdata('amenities',['status'=>1]);
        $data['space_type'] = $this->common_model->selectdata('space_type',['popup_status'=>1],['name'=>'asc']);
        $data['ideal_uses'] = $this->common_model->selectdata('ideal_uses',['status'=>1]);
        $data['popuplandlord'] = $popup;
        return view($this->folder.'user.listing',$data);
    }
    public function usereventsfairs(){
        $data['title'] = 'User Events Fairs Markets';
        $data['retail_categories'] = $this->common_model->selectdata('retail_category',['status'=>1],['name'=>'asc']);
        $data['amenities'] = $this->common_model->selectdata('amenities',['status'=>1]);
        //$data['event_fair_listing'] = $this->common_model->getlistingdetails(['listing.status'=>1,'listing.type'=>6]);
        $data['eventsfairs'] = $this->common_model->getlistingdetails(['listing.status'=>1,'listing.type'=>6,'listing.user_id'=>Auth::User()->id],items_count());
        $data['event_fair_listing_count'] = $this->common_model->getlistingdetails_count(['listing.status'=>1,'listing.type'=>6,'listing.user_id'=>Auth::User()->id]);
        return view($this->folder.'user.listing',$data);
    }
    public function bookings(){
        $data['bookings'] = $this->common_model->getbookingRequests(['listing.status'=>1,'listing.plateform' => 1,'booking_requests.request_to'=>Auth::User()->id]);
        
       
       foreach($data['bookings'] as $book)
       {
          
            $chat = $this->common_model->chat_unread_count(['sent_to'=>Auth::User()->id,'listing_id' =>$book->listing_id,'read'=>0,'sent_by'=>$book->request_from]);
            $book->chat=$chat;
            
       }
       
       return view($this->folder.'user.bookings',$data);
    }
    public function sent_bookings(){
        $data['bookings'] = $this->common_model->getsentbookingRequests(['listing.status'=>1,'listing.plateform' => 1,'booking_requests.request_from'=>Auth::User()->id]);
        
          
       foreach($data['bookings'] as $book)
       {
          
            $chat = $this->common_model->chat_unread_count(['sent_to'=>Auth::User()->id,'listing_id' =>$book->listing_id,'read'=>0,'sent_by'=>$book->request_from]);
            $book->chat=$chat;
            
       }
        
        return view($this->folder.'user.sent-bookings',$data);
    }
    public function partners(){
        return view($this->folder.'user.partners');
    }
    public function transactions(){
        return view($this->folder.'user.transactions');
    }
    public function partnerdetails(){
        return view($this->folder.'user.partner-details');
    }
    public function paymentcards(){
        $data['cards'] = $this->common_model->selectdata('user_cards',['status'=>1,'platform' => 1,'user_id'=>Auth::User()->id],['id'=>'DESC']);
        return view($this->folder.'user.payment-cards',$data);
    }
    public function pricing(){
        return view($this->folder.'user.pricing');
    }
    public function update_profile(Request $request){
        if(!empty($request->email)){
            $common_model = new Common();
             $file = $request->file('image');
             $image_name = Auth::User()->image;
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
                'updated_at' => date('Y-m-d H:i:s'),
                'email' => $request->email,
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
            $update = $common_model->updatedata('users',$user_data,['id'=>Auth::User()->id]);
             $data['status'] = 1;
        }else{
            $data['status'] = 0;
        }
        return json_encode($data);
    }

    /**
    ** Get members of the Brick list
    **/
    public function brick_list_members( Request $request ){
        $brick_id = $request->brick_id;
        $brick_details = $this->common_model->getfirst('listing',['id'=>$brick_id]);
      
        $users = $this->common_model->getRespondedUser($brick_details->associated_listing,$brick_details->user_id);
        // $users = $this->common_model->selectdata('users',[['status','=',1],['id','!=',$brick_details->user_id]],['name'=>'asc']);
        $members = $this->common_model->getdata('user_id','members',['listing_id'=>$brick_id])->pluck('user_id')->toArray();

        return view($this->folder.'user.brick-members',compact('brick_details','users','members'));
    }
    /**
    ** Update members of the Brick list
    **/
    public function update_brick_members( Request $request ){
        $data = [];
        try{
            DB::table('members')->where('listing_id',$request->brick_id)->whereNotIn("user_id",$request->input("invited_to",[]))->delete();
            foreach( $request->input("invited_to",[]) as $invite_to ){
                $record = $this->common_model->getfirst("members",[ [ 'listing_id',$request->brick_id ] , ["user_id",$invite_to] ]);
                if( !$record ){
                    $this->common_model->insertdata("members",[
                        'listing_id' => $request->brick_id,
                        'user_id'   =>  $invite_to
                    ]);
                }
            }
            $data['status'] = 1;
            return json_encode($data);
        } catch(\Exception $e) {
            $data['status'] = 0;   
            return json_encode($data);        
        }
    }

    public function brickMessages($brick_id){
        $listing = $this->common_model->getfirst('listing',['id'=>$brick_id]);
       
        $data['bookings'] = $this->common_model->getbookingRequests([ ['listing.status' , 1], ['booking_requests.listing_id' , $listing->associated_listing],['listing.plateform' , 1],['booking_requests.request_from','!=', Auth::User()->id]]);
        
        foreach($data['bookings'] as $book)
        {
           
             $chat = $this->common_model->chat_unread_count(['sent_to'=>Auth::User()->id,'listing_id' =>$book->listing_id,'read'=>0,'sent_by'=>$book->request_from]);
             $book->chat=$chat;
             
        }
        $data['brick_id'] = $brick_id;
       return view($this->folder.'user.bookings',$data);
    }
    public function addBrickMembers( Request $request ){
        $data = [];
        try{
            $memberes =  $this->common_model->getfirst("members",[ [ 'listing_id',$request->brick_id ] , ["user_id",$request->member_id]]);
        
            if($memberes && $memberes != null){
                $data['status'] = 0;
                return json_encode($data);
            }
           
            if( !$memberes ){
                $this->common_model->insertdata("members",[
                    'listing_id' => $request->brick_id,
                    'user_id'   =>  $invite_to
                ]);
            }
            
            $data['status'] = 1;
            return json_encode($data);
        } catch(\Exception $e) {
            $data['status'] = 0;   
            return json_encode($data);        
        }
    }
}
