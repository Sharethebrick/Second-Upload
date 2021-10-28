<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Redirect,Hash,Session,File,Exception,DateTime,Mail;
use App\Common;
use Carbon\Carbon;



class Listing extends Controller
{
  
    public function __construct(){
       // $this->middleware('auth');
        $this->common_model = new Common();
    }
    public function add_service(Request $request){
        
       $post = $request->all();
       unset($post['terms']);unset($post['_token']);

       $all_uploadec_pictures = json_decode($post['all_uploaded_pictures']);
       $all_uploaded_files = json_decode($post['all_uploaded_files']);
       unset($post['all_uploaded_files']);unset($post['all_uploaded_pictures']);
        if($post['brand_id'] == 0){
          $post['created_at'] = date('Y-m-d H:i:s');
         }else{
          $post['updated_at'] = date('Y-m-d H:i:s');
         }
       $post['type'] = 7;
       
        if(getUrl() == 'retail'){
            $post['plateform'] = 1;
        }elseif(getUrl() == 'office'){
            $post['plateform'] = 2;
        }elseif(getUrl() == 'residential'){
            $post['plateform'] = 3;
        }

        if($post['brand_id'] == 0){
          unset($post['brand_id']);
          $post['user_id'] = Auth::User()->id;
          $insert = $this->common_model->insertdata('listing',$post);
       }else{
          $insert = $post['brand_id'];
          unset($post['brand_id']);
          $this->common_model->updatedata('listing',$post,['id'=>$insert]);
          $listing_rel_files = $this->common_model->selectdata('listing_files',['listing_id'=>$insert]);
          if(count($listing_rel_files) > 0 ){
            foreach ($listing_rel_files as $key1) {
              if(!in_array($key1->name, $all_uploadec_pictures) && !in_array($key1->name, $all_uploaded_files) ){
                  $this->delete_file_server($key1->name);
              }
            }
          }
          $this->common_model->deletedata('listing_files',['listing_id'=>$insert]);
       }
       if(!empty($all_uploadec_pictures)){
          foreach ($all_uploadec_pictures as $key) {
             if($key != '0'){
                   $ext = pathinfo(storage_path().'/uploads/files/'.$key.'', PATHINFO_EXTENSION);
                   $allowedMimeTypes = ['image/jpeg','image/jpg','image/gif','image/png'];
                   $contentType = mime_content_type('uploads/files/'.$key.'');
                   if(! in_array($contentType, $allowedMimeTypes) ){
                     $image = 2;
                   }else{
                     $image = 1;
                   }
                   $this->common_model->insertdata('listing_files',['name'=>$key,'type'=>$image,'extension'=>$ext,'listing_id'=>$insert,'created_at'=>date('Y-m-d H:i:s')]);
             }

         }
         $check_files_avail = $this->common_model->getfirst('listing_files',['listing_id'=>$insert,'type'=>1]);
         if(empty($check_files_avail)){
            $this->common_model->insertdata('listing_files',['name'=>'dummy_listing.jpg','type'=>1,'extension'=>'jpg','listing_id'=>$insert,'created_at'=>date('Y-m-d H:i:s')]);
          }
       }else{
           $this->common_model->insertdata('listing_files',['name'=>'dummy_listing.jpg','type'=>1,'extension'=>'jpg','listing_id'=>$insert,'created_at'=>date('Y-m-d H:i:s')]);
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
                   $this->common_model->insertdata('listing_files',['name'=>$key,'type'=>$image,'extension'=>$ext,'listing_id'=>$insert,'created_at'=>date('Y-m-d H:i:s')]);
             }
         }
       }

       $data['status'] = 1;
       return json_encode($data);
    }
    public function upload_resource_files(Request $request){
       $file = $request->file('file');
        if(!empty($file)){
            //Move Uploaded File
            $destinationPath = 'uploads/files';
            $original_name = $file->getClientOriginalName();
            $file_name = str_replace(' ','_',time().$file->getClientOriginalName());
            if($file->move($destinationPath,$file_name)){
                $image_name = $file_name;
                $data['status'] = 1;
                $data['image_name'] = $image_name;
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
    public function upload_files(Request $request){
        $file = $request->file('file');
        if(!empty($file)){
            //Move Uploaded File
            $destinationPath = 'uploads/files';
            $original_name = $file->getClientOriginalName();
            $file_name = str_replace(' ','_',time().$file->getClientOriginalName());
            if($file->move($destinationPath,$file_name)){
                $image_name = $file_name;
                $data['status'] = 1;
                $data['image_name'] = $image_name;
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
    public function delete_listing_res_image(Request $request){
        
        if(!empty($request->image_name)){
            $destinationPath = 'uploads/files';
            File::delete($destinationPath.'/'.$request->image_name);
            $data['status'] = 1;
        }
        else{
            $data['status'] = 0;
        }
        return json_encode($data); 
    }
    public function delete_listing_image(Request $request){

        if(!empty($request->image_name)){
            $destinationPath = 'uploads/files';
            File::delete($destinationPath.'/'.$request->image_name);
            $data['status'] = 1;
        }
        else{
            $data['status'] = 0;
        }
        return json_encode($data);
    }
    public function chat(Request $request,$booking_id){
        $data['booking_details'] = $this->common_model->getfirst('booking_requests',['id'=>$booking_id]);
      
        $data['listing_details'] = $this->common_model->getlistingdetails(['listing.id'=>$data['booking_details']->listing_id]);
       
        $data['chat'] = $this->common_model->listing_chat($data['booking_details']->request_from,$data['booking_details']->request_to,$data['booking_details']->listing_id);
      
       foreach($data['chat'] as $chat)
       {
           
           $this->common_model->updatedata('chat',['read'=>1],['sent_to'=>Auth::User()->id,'id'=>$chat->id]);
       }
        
      if($data['booking_details']->request_from == Auth::User()->id){
        $data['other_user'] = $this->common_model->getfirst('users',['id'=>$data['booking_details']->request_to]);
      }else{
        $data['other_user'] = $this->common_model->getfirst('users',['id'=>$data['booking_details']->request_from]);
      } 
        return view('user.chat',$data);
    }
    public function delete_file_server($filename){
        if(!empty($filename) && $filename != 'dummy_listing.jpg'){
            $destinationPath = 'uploads/files';
            File::delete($destinationPath.'/'.$filename);

        }
    }
    public function save_listing_message(Request $request){
      $post = $request->all();
      $data_to_save['message'] = $post['message'];
      $data_to_save['sent_to'] = $post['receiver'];
      $data_to_save['sent_by'] = $post['sender'];
      $data_to_save['listing_id'] = $post['listing_id'];
      $data_to_save['sent_on'] = date('Y-m-d H:i:s');
      $insert = $this->common_model->insertdata('chat',$data_to_save);
      $data['status'] = 1;
      return json_encode($data);
    }
    public function get_members_dropdown(Request $request){
      $post = $request->all();

      $list = $this->common_model->get_members_list($post,Auth::User()->id);
      $data['html'] = '';
      if(count($list)>0){
        $data['html'] .= '<ul>';
        foreach ($list as $key) {
           $data['html'] .= ' <li class="list_selection select_from_list'.$key->id.'" data-id="'.$key->id.'">'.$key->name.' '.$key->last_name.'</li>';
        }
        $data['html'] .= '</ul>';
      }else{
        $data['html'] = '<ul><li>No results found.</li></ul>';
      }

      return json_encode($data);

    }
    public function get_chat(Request $request){
      $post = $request->all();
      $chat = $this->common_model->listing_chat($post['sender'],$post['receiver'],$post['listing_id'],$post['start']);
      if(!empty($chat)){
              $send_data['html'] = '';
              foreach ($chat as $key) {
                      if($key->senderid == Auth::User()->id){
                              $send_data['html'] .= '<li class="right-msg">
                                                <div class="msg-ic">
                                                  '.convertLinksClickable($key->message).'
                                                </div>
                                                <span class="time-msg"><i class="fa fa-clock-o"></i> '.get_time($key->sent_on).'';
                                    if(get_time($key->sent_on) != 'just now'){
                                      $send_data['html'] .= ' ago';
                                    }
                                       $send_data['html'] .= '  </span>
                                              </li>';
                      }else{
                            $send_data['html'] .='<li>
                                            <img src="';
                                            if($key->senderimage){
                                             $send_data['html'] .= url('/uploads/user/').'/'.$key->senderimage;
                                            }else{
                                             $send_data['html'] .=   url('/').'/img/user.png';
                                            }
                                      $send_data['html'] .='" class="user-img">
                                            <div class="msg-ic">
                                              '.convertLinksClickable($key->message).'
                                            </div>
                                            <span class="time-msg"><i class="fa fa-clock-o"></i> '.get_time($key->sent_on).'';
                                            if(get_time($key->sent_on) != 'just now'){
                                                $send_data['html'] .= ' ago';
                                            }
                                            $send_data['html'] .= '</span>
                                                    </li>';
                      }


              }
              $send_data['count'] = count($chat);
      }else{
        $send_data['html'] .= ''; $send_data['count'] = '0';
      }
        echo json_encode($send_data);
    }
    public function delete_listing(Request $request){
        // dd($request);
        if(!empty($request->id)){
            $this->common_model->updatedata('listing',['status'=>2],['id'=>$request->id]);
            $data['status'] = 1;
        }
        else{
            $data['status'] = 0;
        }
        return json_encode($data);
    }
    public function update_booking_status(Request $request){
        if(!empty($request->booking_id)){
            $booking_details = $this->common_model->getfirst('booking_requests',['id'=>$request->booking_id]);
            $check = $this->common_model->getfirst('users',['id'=>$booking_details->request_from]);
            $listing_data = $this->common_model->getfirst('listing',['id'=>$booking_details->listing_id]);
            $link = url('/sent-bookings');
            $email_data = array('username' => $check->name,'list_details'=>$listing_data,'link'=>$link,'status'=>$request->status);
            $email_to = $check->email;
            $name_to = $check->name.' '.$check->last_name;
            $status = $request->status;
            Mail::send('emails.update_booking_status', $email_data, function($message) use ($name_to, $email_to,$status){
             if($status == 2){
              $message->to($email_to, $name_to)->subject
                ('Booking Request Rejected - Share The Brick');
             }else{
              $message->to($email_to, $name_to)->subject
                ('Booking Request Accepted - Share The Brick');
             }

             $message->from(config('app.MAIL_FROMADDRESS'),'Share The Brick');
            });
            $this->common_model->updatedata('booking_requests',['status'=>$request->status],['id'=>$request->booking_id]);
            $data['status'] = 1;
        }
        else{
            $data['status'] = 0;
        }
        return json_encode($data);
    }
    public function send_message(Request $request){
       
        $data=$request->all();
        $insert = $this->common_model->insertdata('booking_requests',array('request_from'=>Auth::User()->id,'request_to'=>$data['request_to'],'listing_id'=>$data['listing_id'],'subject'=>$data['subject'],'created_at'=>date('Y-m-d H:i:s')));
        
         $insert1 = $this->common_model->insertdata('chat',array('message'=>$data['message'],
         'sent_to'=>$data['request_to'],
         'sent_by'=>Auth::User()->id,
         'listing_id'=>$data['listing_id'],
         'sent_on'=>date('Y-m-d H:i:s')));
         
         $data['status'] = 1;
        return json_encode($data);
        
        
    }
    public function apply_listing(Request $request){
      $listing_data = $this->common_model->getfirst('listing',['id'=>$request->listing_id]);
      $check = $this->common_model->getfirst('users',['id'=>$listing_data->user_id]);
      $link = url('/bookings');
      $email_data = array('username' => $check->name,'list_details'=>$listing_data,'link'=>$link);
      $email_to = $check->email;
      $name_to = $check->name.' '.$check->last_name;
      Mail::send('emails.booking_request', $email_data, function($message) use ($name_to, $email_to){
       $message->to($email_to, $name_to)->subject
          ('New Booking Request - Share The Brick');
       $message->from(config('app.MAIL_FROMADDRESS'),'Share The Brick');
      });
      $insert = $this->common_model->insertdata('booking_requests',array('request_from'=>Auth::User()->id,'request_to'=>$listing_data->user_id,'listing_id'=>$request->listing_id,'created_at'=>date('Y-m-d H:i:s')));
         $data['status'] = 1;
        return json_encode($data);
    }
    public function accept_reject_invite(Request $request){
         $post = $request->all();
         $this->common_model->updatedata('members',['status'=>$post['status']],['id'=>$post['id']]);
         $data['status'] = 1;
        return json_encode($data);
    }
    public function add_brand(Request $request){
       $post = $request->all();
       unset($post['terms']);unset($post['_token']);
       if($post['open_to_collaborations'] == '1'){
        $post['collaboration_type'] = implode(',', $post['collaboration_type']);
      }else{
        $post['collaboration_type'] = 0;
      }

       $all_uploadec_pictures = json_decode($post['all_uploaded_pictures']);
       $all_uploaded_files = json_decode($post['all_uploaded_files']);
       unset($post['all_uploaded_files']);unset($post['all_uploaded_pictures']);
        if($post['brand_id'] == 0){
          $post['created_at'] = date('Y-m-d H:i:s');
         }else{
          $post['updated_at'] = date('Y-m-d H:i:s');
         }
       $post['type'] = 1;
       $price = explode(';', $post['filter_by_price']);
       unset($post['filter_by_price']);
       $post['price_from'] = $price[0];
       $post['price_to'] = $price[1];

        if(getUrl() == 'retail'){
            $post['plateform'] = 1;
        }elseif(getUrl() == 'office'){
            $post['plateform'] = 2;
        }elseif(getUrl() == 'residential'){
            $post['plateform'] = 3;
        }

        if($post['brand_id'] == 0){
          unset($post['brand_id']);
          $post['user_id'] = Auth::User()->id;
          $insert = $this->common_model->insertdata('listing',$post);
       }else{
          $insert = $post['brand_id'];
          unset($post['brand_id']);
          $this->common_model->updatedata('listing',$post,['id'=>$insert]);
          $listing_rel_files = $this->common_model->selectdata('listing_files',['listing_id'=>$insert]);
          if(count($listing_rel_files) > 0 ){
            foreach ($listing_rel_files as $key1) {
              if(!in_array($key1->name, $all_uploadec_pictures) && !in_array($key1->name, $all_uploaded_files) ){
                  $this->delete_file_server($key1->name);
              }
            }
          }
          $this->common_model->deletedata('listing_files',['listing_id'=>$insert]);
       }
       if(!empty($all_uploadec_pictures)){
          foreach ($all_uploadec_pictures as $key) {
             if($key != '0'){
                   $ext = pathinfo(storage_path().'/uploads/files/'.$key.'', PATHINFO_EXTENSION);
                   $allowedMimeTypes = ['image/jpeg','image/jpg','image/gif','image/png'];
                   $contentType = mime_content_type('uploads/files/'.$key.'');
                   if(! in_array($contentType, $allowedMimeTypes) ){
                     $image = 2;
                   }else{
                     $image = 1;
                   }
                   $this->common_model->insertdata('listing_files',['name'=>$key,'type'=>$image,'extension'=>$ext,'listing_id'=>$insert,'created_at'=>date('Y-m-d H:i:s')]);
             }

         }
         $check_files_avail = $this->common_model->getfirst('listing_files',['listing_id'=>$insert,'type'=>1]);
         if(empty($check_files_avail)){
            $this->common_model->insertdata('listing_files',['name'=>'dummy_listing.jpg','type'=>1,'extension'=>'jpg','listing_id'=>$insert,'created_at'=>date('Y-m-d H:i:s')]);
          }
       }else{
           $this->common_model->insertdata('listing_files',['name'=>'dummy_listing.jpg','type'=>1,'extension'=>'jpg','listing_id'=>$insert,'created_at'=>date('Y-m-d H:i:s')]);
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
                   $this->common_model->insertdata('listing_files',['name'=>$key,'type'=>$image,'extension'=>$ext,'listing_id'=>$insert,'created_at'=>date('Y-m-d H:i:s')]);
             }
         }
       }

       $data['status'] = 1;
       return json_encode($data);
    }
    public function add_fullspace(Request $request){
       $post = $request->all();
       $data_to_save = array();
       $data_to_save['name'] = $post['title'];
       $data_to_save['location_city'] = $post['address'];
       $data_to_save['description'] = $post['description'];
       $data_to_save['space_type'] = $post['property_type'];

       $data_to_save['street'] = $post['street'];
       $data_to_save['street_no'] = $post['street_no'];
       $data_to_save['city'] = $post['city'];
       $data_to_save['zip'] = $post['zip'];
       $data_to_save['country'] = $post['country'];
       $data_to_save['state'] = $post['state'];

       if(isset($post['floors']) && $post['floors']){
          $data_to_save['floors'] = $post['floors'];
       }
       if(isset($post['floor_no']) && $post['floor_no']){
          $data_to_save['floor_no'] = $post['floor_no'];
       }
       if(isset($post['amenities']) && $post['amenities']){
          $data_to_save['amenities'] = implode(',', $post['amenities']);
       }else{
        $data_to_save['amenities'] = '';
       }
       $data_to_save['lat'] = $post['lat'];
       $data_to_save['lng'] = $post['lng'];
       $data_to_save['size'] = $post['size'];
       $data_to_save['size_unit'] = $post['size_unit'];
       if(isset($post['lease_price']) && $post['lease_price']){
          $data_to_save['price_from'] = $post['lease_price'];
       }
       $data_to_save['price_unit'] = $post['lease_price_unit'];
       $data_to_save['lease_term'] = $post['lease_term'];
       $data_to_save['lease_type'] = $post['lease_type'];
       $data_to_save['max_renters'] = $post['max_renters'];
       $data_to_save['include_with_lease'] = $post['include_with_lease'];
      // $data_to_save['brand'] = $post['brand'];
       $data_to_save['amenities_other_option'] = $post['amenities_other_option'];
       $data_to_save['file_upload_viewer'] = $post['file_upload_viewer'];
       $data_to_save['email_listing_owner'] = $post['email_listing_owner'];
       $data_to_save['availability_date'] = date('Y-m-d',strtotime($post['availability_date']));
       $data_to_save['ideal_uses'] = implode(',', $post['ideal_uses']);


        if(getUrl() == 'retail'){
            $data_to_save['plateform'] = 1;
        }elseif(getUrl() == 'office'){
            $data_to_save['plateform'] = 2;
        }elseif(getUrl() == 'residential'){
            $data_to_save['plateform'] = 3;
        }



       if($post['fullspace_id'] == 0){
          $data_to_save['created_at'] = date('Y-m-d H:i:s');
       }else{
        $data_to_save['updated_at'] = date('Y-m-d H:i:s');
       }
       $data_to_save['type'] = 3;
       $all_uploadec_pictures = json_decode($post['all_uploaded_pictures']);
       // echo "<pre>";
       // print_r($all_uploadec_pictures);
       // exit;
       $all_uploaded_files = json_decode($post['all_uploaded_files']);
       if($post['fullspace_id'] == 0){
          $data_to_save['user_id'] = Auth::User()->id;
          $insert = $this->common_model->insertdata('listing',$data_to_save);
       }else{
          $insert = $post['fullspace_id'];
          $this->common_model->updatedata('listing',$data_to_save,['id'=>$insert]);
          $listing_rel_files = $this->common_model->selectdata('listing_files',['listing_id'=>$insert]);
          if(count($listing_rel_files) > 0 ){
            foreach ($listing_rel_files as $key1) {
              if(!in_array($key1->name, $all_uploadec_pictures) && !in_array($key1->name, $all_uploaded_files) ){
                  $this->delete_file_server($key1->name);
              }
            }
          }
          $this->common_model->deletedata('listing_files',['listing_id'=>$insert]);
       }
       if(!empty($all_uploadec_pictures)){
           foreach ($all_uploadec_pictures as $key) {
               if($key != '0'){
                     $ext = pathinfo(storage_path().'/uploads/files/'.$key.'', PATHINFO_EXTENSION);
                     $allowedMimeTypes = ['image/jpeg','image/jpg','image/gif','image/png'];
                     $contentType = mime_content_type('uploads/files/'.$key.'');
                     if(! in_array($contentType, $allowedMimeTypes) ){
                       $image = 2;
                     }else{
                       $image = 1;
                     }
                     $this->common_model->insertdata('listing_files',['name'=>$key,'type'=>$image,'extension'=>$ext,'listing_id'=>$insert,'created_at'=>date('Y-m-d H:i:s')]);
               }
           }
          $check_files_avail = $this->common_model->getfirst('listing_files',['listing_id'=>$insert,'type'=>1]);
          if(empty($check_files_avail)){
            $this->common_model->insertdata('listing_files',['name'=>'dummy_listing.jpg','type'=>1,'extension'=>'jpg','listing_id'=>$insert,'created_at'=>date('Y-m-d H:i:s')]);
          }
       }else{
           $this->common_model->insertdata('listing_files',['name'=>'dummy_listing.jpg','type'=>1,'extension'=>'jpg','listing_id'=>$insert,'created_at'=>date('Y-m-d H:i:s')]);
       }
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
                 $this->common_model->insertdata('listing_files',['name'=>$key,'type'=>$image,'extension'=>$ext,'listing_id'=>$insert,'created_at'=>date('Y-m-d H:i:s')]);
           }
       }
       $data['status'] = 1;
       return json_encode($data);
    }
    public function add_partialspace(Request $request){
       $post = $request->all();
       $data_to_save = array();
       $data_to_save['name'] = $post['title'];
       $data_to_save['location_city'] = $post['address'];
       $data_to_save['description'] = $post['description'];
       if(isset($post['floors']) && $post['floors']){
          $data_to_save['floors'] = $post['floors'];
       }
       if(isset($post['floor']) && $post['floor']){
          $data_to_save['floor_no'] = $post['floor'];
       }
       if(isset($post['tenant_rent_type']) && $post['tenant_rent_type']){
          $data_to_save['lease_type'] = $post['tenant_rent_type'];
       }
       if(isset($post['amenities']) && $post['amenities']){
          $data_to_save['amenities'] = implode(',', $post['amenities']);
       }else{
        $data_to_save['amenities'] = '';
       }
       if(isset($post['lease_price']) && $post['lease_price']){
          $data_to_save['price_from'] = $post['lease_price'];
       }


        if(getUrl() == 'retail'){
            $data_to_save['plateform'] = 1;
        }elseif(getUrl() == 'office'){
            $data_to_save['plateform'] = 2;
        }elseif(getUrl() == 'residential'){
            $data_to_save['plateform'] = 3;
        }

       $data_to_save['street'] = $post['street'];
       $data_to_save['street_no'] = $post['street_no'];
       $data_to_save['city'] = $post['city'];
       $data_to_save['zip'] = $post['zip'];
       $data_to_save['country'] = $post['country'];
       $data_to_save['state'] = $post['state'];

       $data_to_save['partial_spacetype'] = $post['type'];
       $data_to_save['lat'] = $post['lat'];
       $data_to_save['lng'] = $post['lng'];
       $data_to_save['size'] = $post['floor_size'];
       $data_to_save['size_unit'] = $post['floor_size_unit'];
       $data_to_save['price_unit'] = $post['lease_price_duration'];
       $data_to_save['lease_term'] = $post['lease_term'];
       $data_to_save['lease_term_unit'] = $post['lease_term_duration'];
       $data_to_save['include_with_lease'] = $post['include_with_lease'];
       $data_to_save['amenities_other_option'] = $post['amenities_other_option'];
       $data_to_save['file_upload_viewer'] = $post['file_upload_viewer'];
       $data_to_save['email_listing_owner'] = $post['email_listing_owner'];
       $data_to_save['current_use'] = $post['current_use'];
       if(isset($post['brand']) && $post['brand']){
        $data_to_save['brand'] = $post['brand'];
       }else{
        $data_to_save['brand'] = 0;
       }

       $data_to_save['availability_date'] = date('Y-m-d',strtotime($post['availability_date']));
       if($post['partialspace_id'] == 0){
          $data_to_save['created_at'] = date('Y-m-d H:i:s');
       }else{
        $data_to_save['updated_at'] = date('Y-m-d H:i:s');
       }
       $data_to_save['type'] = 4;
       $all_uploadec_pictures = json_decode($post['all_uploaded_pictures']);
       $all_uploaded_files = json_decode($post['all_uploaded_files']);
       if($post['partialspace_id'] == 0){
          $data_to_save['user_id'] = Auth::User()->id;
          $insert = $this->common_model->insertdata('listing',$data_to_save);
       }else{
          $insert = $post['partialspace_id'];
          $this->common_model->updatedata('listing',$data_to_save,['id'=>$insert]);
          $listing_rel_files = $this->common_model->selectdata('listing_files',['listing_id'=>$insert]);
          if(count($listing_rel_files) > 0 ){
            foreach ($listing_rel_files as $key1) {
              if(!in_array($key1->name, $all_uploadec_pictures) && !in_array($key1->name, $all_uploaded_files) ){
                  $this->delete_file_server($key1->name);
              }
            }
          }
          $this->common_model->deletedata('listing_files',['listing_id'=>$insert]);
       }
       if(!empty($all_uploadec_pictures)){
             foreach ($all_uploadec_pictures as $key) {
                 if($key != '0'){
                       $ext = pathinfo(storage_path().'/uploads/files/'.$key.'', PATHINFO_EXTENSION);
                       $allowedMimeTypes = ['image/jpeg','image/jpg','image/gif','image/png'];
                       $contentType = mime_content_type('uploads/files/'.$key.'');
                       if(! in_array($contentType, $allowedMimeTypes) ){
                         $image = 2;
                       }else{
                         $image = 1;
                       }
                        $this->common_model->insertdata('listing_files',['name'=>$key,'type'=>$image,'extension'=>$ext,'listing_id'=>$insert,'created_at'=>date('Y-m-d H:i:s')]);
                 }
             }

            $check_files_avail = $this->common_model->getfirst('listing_files',['listing_id'=>$insert,'type'=>1]);
            if(empty($check_files_avail)){
              $this->common_model->insertdata('listing_files',['name'=>'dummy_listing.jpg','type'=>1,'extension'=>'jpg','listing_id'=>$insert,'created_at'=>date('Y-m-d H:i:s')]);
            }
       }else{
           $this->common_model->insertdata('listing_files',['name'=>'dummy_listing.jpg','type'=>1,'extension'=>'jpg','listing_id'=>$insert,'created_at'=>date('Y-m-d H:i:s')]);
       }
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
                  $this->common_model->insertdata('listing_files',['name'=>$key,'type'=>$image,'extension'=>$ext,'listing_id'=>$insert,'created_at'=>date('Y-m-d H:i:s')]);
           }
       }
       $data['status'] = 1;
       return json_encode($data);
    }
    public function add_events_fairs(Request $request){
       $post = $request->all();
       $data_to_save = array();
       $data_to_save['name'] = $post['title'];
       $data_to_save['location_city'] = $post['address'];
       $data_to_save['description'] = $post['description'];
       $data_to_save['lat'] = $post['lat'];

       $data_to_save['street'] = $post['street'];
       $data_to_save['street_no'] = $post['street_no'];
       $data_to_save['city'] = $post['city'];
       $data_to_save['zip'] = $post['zip'];
       $data_to_save['country'] = $post['country'];
       $data_to_save['state'] = $post['state'];

       $data_to_save['lng'] = $post['lng'];
       $data_to_save['size'] = $post['space_size'];
       $data_to_save['size_unit'] = $post['space_size_unit'];
       $data_to_save['price_from'] = $post['fee'];
       if(isset($post['brand']) && $post['brand']){
        $data_to_save['brand'] = $post['brand'];
       }else{
        $data_to_save['brand'] = 0;
       }
       $data_to_save['price_unit'] = $post['fee_unit'];
       $data_to_save['additional_fee'] = $post['additional_fee'];
       $data_to_save['start_date_time'] = date('Y-m-d H:i:s',strtotime($post['start_datetime']));
       $data_to_save['end_date_time'] = date('Y-m-d H:i:s',strtotime($post['end_datetime']));
       $data_to_save['include_with_lease'] = $post['include_with_lease'];
       $data_to_save['amenities_other_option'] = $post['amenities_other_option'];
       $data_to_save['file_upload_viewer'] = $post['file_upload_viewer'];
       $data_to_save['email_listing_owner'] = $post['email_listing_owner'];
       if(isset($post['amenities']) && $post['amenities']){
          $data_to_save['amenities'] = implode(',', $post['amenities']);
       }else{
        $data_to_save['amenities'] = '';
       }
       if(isset($post['retail_category']) && $post['retail_category']){
          $data_to_save['retail_category'] = implode(',', $post['retail_category']);
       }else{
        $data_to_save['retail_category'] = '';
       }
       if($post['eventfairs_id'] == 0){
          $data_to_save['created_at'] = date('Y-m-d H:i:s');
       }else{
        $data_to_save['updated_at'] = date('Y-m-d H:i:s');
       }
       $data_to_save['type'] = 6;
       $all_uploadec_pictures = json_decode($post['all_uploaded_pictures']);
       $all_uploaded_files = json_decode($post['all_uploaded_files']);
        if($post['eventfairs_id'] == 0){
          $data_to_save['user_id'] = Auth::User()->id;
          $insert = $this->common_model->insertdata('listing',$data_to_save);
       }else{
          $insert = $post['eventfairs_id'];
          $this->common_model->updatedata('listing',$data_to_save,['id'=>$insert]);
          $listing_rel_files = $this->common_model->selectdata('listing_files',['listing_id'=>$insert]);
          if(count($listing_rel_files) > 0 ){
            foreach ($listing_rel_files as $key1) {
              if(!in_array($key1->name, $all_uploadec_pictures) && !in_array($key1->name, $all_uploaded_files) ){
                  $this->delete_file_server($key1->name);
              }
            }
          }
          $this->common_model->deletedata('listing_files',['listing_id'=>$insert]);
       }
       if(!empty($all_uploadec_pictures)){
           foreach ($all_uploadec_pictures as $key) {
               if($key != '0'){
                     $ext = pathinfo(storage_path().'/uploads/files/'.$key.'', PATHINFO_EXTENSION);
                     $allowedMimeTypes = ['image/jpeg','image/jpg','image/gif','image/png'];
                     $contentType = mime_content_type('uploads/files/'.$key.'');
                     if(! in_array($contentType, $allowedMimeTypes) ){
                       $image = 2;
                     }else{
                       $image = 1;
                     }
                     $this->common_model->insertdata('listing_files',['name'=>$key,'type'=>$image,'extension'=>$ext,'listing_id'=>$insert,'created_at'=>date('Y-m-d H:i:s')]);
               }
           }
           $check_files_avail = $this->common_model->getfirst('listing_files',['listing_id'=>$insert,'type'=>1]);
           if(empty($check_files_avail)){
            $this->common_model->insertdata('listing_files',['name'=>'dummy_listing.jpg','type'=>1,'extension'=>'jpg','listing_id'=>$insert,'created_at'=>date('Y-m-d H:i:s')]);
           }
       }else{
           $this->common_model->insertdata('listing_files',['name'=>'dummy_listing.jpg','type'=>1,'extension'=>'jpg','listing_id'=>$insert,'created_at'=>date('Y-m-d H:i:s')]);
       }
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
                 $this->common_model->insertdata('listing_files',['name'=>$key,'type'=>$image,'extension'=>$ext,'listing_id'=>$insert,'created_at'=>date('Y-m-d H:i:s')]);
           }
       }
       $data['status'] = 1;
       return json_encode($data);
    }
    public function add_popuplandlord(Request $request){
       $post = $request->all();
       $data_to_save = array();
       $data_to_save['name'] = $post['title'];
       $data_to_save['location_city'] = $post['address'];
       $data_to_save['description'] = $post['description'];
       $data_to_save['space_type'] = $post['property_type'];
       if(isset($post['floors']) && $post['floors']){
          $data_to_save['floors'] = $post['floors'];
       }
       if(isset($post['floor_no']) && $post['floor_no']){
          $data_to_save['floor_no'] = $post['floor_no'];
       }
       if(isset($post['daily_rate']) && $post['daily_rate']){
          $data_to_save['daily_rate'] = $post['daily_rate'];
       }
       if(isset($post['monthly_rate']) && $post['monthly_rate']){
          $data_to_save['monthly_rate'] = $post['monthly_rate'];
       }
       if(isset($post['weekly_rate']) && $post['weekly_rate']){
          $data_to_save['weekly_rate'] = $post['weekly_rate'];
       }
       if(isset($post['minimum_rental']) && $post['minimum_rental']){
          $data_to_save['min_rental'] = $post['minimum_rental'];
       }
       if(isset($post['max_rental']) && $post['max_rental']){
          $data_to_save['max_rental'] = $post['max_rental'];
       }


        if(getUrl() == 'retail'){
            $data_to_save['plateform'] = 1;
        }elseif(getUrl() == 'office'){
            $data_to_save['plateform'] = 2;
        }elseif(getUrl() == 'residential'){
            $data_to_save['plateform'] = 3;
        }

       $data_to_save['street'] = $post['street'];
       $data_to_save['street_no'] = $post['street_no'];
       $data_to_save['city'] = $post['city'];
       $data_to_save['zip'] = $post['zip'];
       $data_to_save['country'] = $post['country'];
       $data_to_save['state'] = $post['state'];

       $data_to_save['lat'] = $post['lat'];
       $data_to_save['lng'] = $post['lng'];
       $data_to_save['size'] = $post['size'];
       $data_to_save['size_unit'] = $post['size_unit'];
       $data_to_save['renters_access'] = $post['renters_access'];
       $data_to_save['min_rental_unit'] = $post['minimum_rental_unit'];
       $data_to_save['max_rental_unit'] = $post['max_rental_unit'];
       $data_to_save['include_with_lease'] = $post['include_with_lease'];
       $data_to_save['amenities_other_option'] = $post['amenities_other_option'];
       $data_to_save['file_upload_viewer'] = $post['file_upload_viewer'];
       $data_to_save['email_listing_owner'] = $post['email_listing_owner'];
       if(isset($post['amenities']) && $post['amenities']){
          $data_to_save['amenities'] = implode(',', $post['amenities']);
       }else{
        $data_to_save['amenities'] = '';
       }
      if(isset($post['brand']) && $post['brand']){
        $data_to_save['brand'] = $post['brand'];
       }else{
        $data_to_save['brand'] = 0;
       }
       $data_to_save['ideal_uses'] = implode(',', $post['ideal_uses']);
       if($post['popuplandlord_id'] == 0){
          $data_to_save['created_at'] = date('Y-m-d H:i:s');
       }else{
        $data_to_save['updated_at'] = date('Y-m-d H:i:s');
       }
       $data_to_save['type'] = 5;
       $all_uploadec_pictures = json_decode($post['all_uploaded_pictures']);
       $all_uploaded_files = json_decode($post['all_uploaded_files']);
       if($post['popuplandlord_id'] == 0){
          $data_to_save['user_id'] = Auth::User()->id;
          $insert = $this->common_model->insertdata('listing',$data_to_save);
       }else{
          $insert = $post['popuplandlord_id'];
          $this->common_model->updatedata('listing',$data_to_save,['id'=>$insert]);
          $listing_rel_files = $this->common_model->selectdata('listing_files',['listing_id'=>$insert]);
          if(count($listing_rel_files) > 0 ){
            foreach ($listing_rel_files as $key1) {
              if(!in_array($key1->name, $all_uploadec_pictures) && !in_array($key1->name, $all_uploaded_files) ){
                  $this->delete_file_server($key1->name);
              }
            }
          }
          $this->common_model->deletedata('listing_files',['listing_id'=>$insert]);
       }
        if(!empty($all_uploadec_pictures)){
           foreach ($all_uploadec_pictures as $key) {
               if($key != '0'){
                     $ext = pathinfo(storage_path().'/uploads/files/'.$key.'', PATHINFO_EXTENSION);
                     $allowedMimeTypes = ['image/jpeg','image/jpg','image/gif','image/png'];
                     $contentType = mime_content_type('uploads/files/'.$key.'');
                     if(! in_array($contentType, $allowedMimeTypes) ){
                       $image = 2;
                     }else{
                       $image = 1;
                     }
                     $this->common_model->insertdata('listing_files',['name'=>$key,'type'=>$image,'extension'=>$ext,'listing_id'=>$insert,'created_at'=>date('Y-m-d H:i:s')]);
               }
           }
          $check_files_avail = $this->common_model->getfirst('listing_files',['listing_id'=>$insert,'type'=>1]);
          if(empty($check_files_avail)){
            $this->common_model->insertdata('listing_files',['name'=>'dummy_listing.jpg','type'=>1,'extension'=>'jpg','listing_id'=>$insert,'created_at'=>date('Y-m-d H:i:s')]);
          }
        }else{
             $this->common_model->insertdata('listing_files',['name'=>'dummy_listing.jpg','type'=>1,'extension'=>'jpg','listing_id'=>$insert,'created_at'=>date('Y-m-d H:i:s')]);
        }
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
                 $this->common_model->insertdata('listing_files',['name'=>$key,'type'=>$image,'extension'=>$ext,'listing_id'=>$insert,'created_at'=>date('Y-m-d H:i:s')]);
           }
       }
       $data['status'] = 1;
       return json_encode($data);
    }
    public function add_brickform(Request $request){
       $post = $request->all();
       if($post['associated_listing']){
           $get_assoc_lis = $this->common_model->getfirst('listing',['id'=>$post['associated_listing']]);
           if(!empty($get_assoc_lis)){
              if($get_assoc_lis->type == 1 || $get_assoc_lis->type == 2){
                $data['status'] = 2;
                $data['message'] = 'Oops! No listing found with number '.$post['associated_listing'].'';
                return json_encode($data);
              }
           }else{
              $data['status'] = 2;
              $data['message'] = 'Oops! No listing found with number '.$post['associated_listing'].'';
              return json_encode($data);
           }
       }
       $all_uploadec_pictures = json_decode($post['all_uploaded_pictures']);
       $all_uploaded_files = json_decode($post['all_uploaded_files']);
       $invite_members = $post['invite_member'];
       $post['invited_members'] = implode(',', $post['invite_member']);
       unset($post['invited_members']);
       $file = $request->file('thumbnail');
       $image_name = '';
       if(!empty($file)){
                //Move Uploaded File
                $destinationPath = 'uploads/files';
                $original_name = $file->getClientOriginalName();
                $file_name = str_replace(' ','_',time().$file->getClientOriginalName());
                if($file->move($destinationPath,$file_name)){
                    $image_name = $file_name;
                }
        }
       unset($post['thumbnail']);
       if($post['brick_id'] == 0){
			$post['thumbnail'] = $image_name;
			$post['created_at'] = date('Y-m-d H:i:s');
       }else{
			if($image_name != ''){
			$post['thumbnail'] = $image_name;
			}
        	$post['updated_at'] = date('Y-m-d H:i:s');
       }

       $post['type'] = 2;
       $post['location_city'] = $post['location'];
       //$price = explode(';', $post['filter_by_price']);
       $post['collaboration_type'] = implode(',', $post['collaboration_type']);
      // unset($post['filter_by_price']);
       // $post['price_from'] = $price[0];
       // $post['price_to'] = $price[1];
        if(getUrl() == 'retail'){
            $post['plateform'] = 1;
        }elseif(getUrl() == 'office'){
            $post['plateform'] = 2;
        }elseif(getUrl() == 'residential'){
            $post['plateform'] = 3;
        }
       $post['name'] = $post['title'];
       unset($post['_token']);unset($post['all_uploaded_files']);unset($post['all_uploaded_pictures']);unset($post['location']);unset($post['title']);unset($post['invite_member']);
       if($post['brick_id'] == 0){
          	$post['user_id'] = Auth::User()->id;
			unset($post['brick_id']);
			$link_data = $this->fetchData('http://api.linkpreview.net/?key=763d18f7832ab9b029c1bf369117f140&q='.$post['link'].'');
			$new_link_data = json_decode($link_data,true);
          	if(!empty($new_link_data)){
				$post['link_title'] = $new_link_data['title'];
				$post['link_desc'] = $new_link_data['description'];
				$post['link_image'] = $new_link_data['image'];
				$post['link_url'] = $new_link_data['url'];
          	}
      $insert = $this->common_model->insertdata('listing',$post);
      //add group detail

			$postArr =[
				'listing_id' =>$insert,
				'group_admin' => Auth::User()->id,
				'status' =>1
			];
      $insertGroup = $this->common_model->insertdata('groups',$postArr);
      
			if($post['landlord_email']){
				$link = url('/brickdetails').'/'.$insert;
				$email_data = array('username' => Auth::User()->name.' '.Auth::User()->last_name, 'type' => 'Brick', 'id'=>$insert,'title'=>$post['name'],'link'=>$link,'landlord_link'=>$post['landlord_email']);
				$email_to = $post['landlord_email'];
                //   dd($email_to, config('app.MAIL_FROMADDRESS'));
                 // $name_to = $user_details->name.' '.$user_details->last_name;
                  	Mail::send('emails.added-inbrick', $email_data, function($message) use ($email_to){
                    $message->to($email_to)->subject
                        ('Property Added');
                    $message->from(config('app.MAIL_FROMADDRESS'),'Share The Brick');
                    });

                    // dd('hi');
          	}
       	}else{
			$insert = $post['brick_id'];
			$old_data = $this->common_model->getfirst('listing',['id'=>$insert]);
			if($post['link'] != $old_data->link){
				$link_data = $this->fetchData('http://api.linkpreview.net/?key=763d18f7832ab9b029c1bf369117f140&q='.$post['link'].'');
				$new_link_data = json_decode($link_data,true);
				if(!empty($new_link_data)){
				$post['link_title'] = $new_link_data['title'];
				$post['link_desc'] = $new_link_data['description'];
				$post['link_image'] = $new_link_data['image'];
				$post['link_url'] = $new_link_data['url'];
				}
          	}
			unset($post['brick_id']);
			$this->common_model->updatedata('listing',$post,['id'=>$insert]);
			$listing_rel_files = $this->common_model->selectdata('listing_files',['listing_id'=>$insert]);
			if(count($listing_rel_files) > 0 ){
            	foreach ($listing_rel_files as $key1) {
					if(!in_array($key1->name, $all_uploadec_pictures) && !in_array($key1->name, $all_uploaded_files) ){
						$this->delete_file_server($key1->name);
					}
            	}
          	}
			$this->common_model->deletedata('listing_files',['listing_id'=>$insert]);
			if($post['landlord_email']){
				if($post['landlord_email'] != $old_data->landlord_email){
				$link = url('/brickdetails').'/'.$insert;
				$email_data = array('username' => Auth::User()->name.' '.Auth::User()->last_name, 'type' => 'Brick', 'id'=>$insert,'title'=>$post['name'],'link'=>$link,'landlord_link'=>$post['landlord_email']);
				$email_to = $post['landlord_email'];
				// dd($email_to);
				// $name_to = $user_details->name.' '.$user_details->last_name;
				Mail::send('emails.added-inbrick', $email_data, function($message) use ($email_to){
					$message->to($email_to)->subject
						('Property Added');
					$message->from(config('app.MAIL_FROMADDRESS'),'Share The Brick');
					});
				}
          	}
       }
       if(!empty($all_uploadec_pictures)){
          foreach ($all_uploadec_pictures as $key) {
               if($key != '0'){
                     $ext = pathinfo(storage_path().'/uploads/files/'.$key.'', PATHINFO_EXTENSION);
                     $allowedMimeTypes = ['image/jpeg','image/jpg','image/gif','image/png'];
                     $contentType = mime_content_type('uploads/files/'.$key.'');
                     if(! in_array($contentType, $allowedMimeTypes) ){
                       $image = 2;
                     }else{
                       $image = 1;
                     }

                     $this->common_model->insertdata('listing_files',['name'=>$key,'type'=>$image,'extension'=>$ext,'listing_id'=>$insert,'created_at'=>date('Y-m-d H:i:s')]);
               }
           }
            $check_files_avail = $this->common_model->getfirst('listing_files',['listing_id'=>$insert,'type'=>1]);
            if(empty($check_files_avail)){
              $this->common_model->insertdata('listing_files',['name'=>'dummy_listing.jpg','type'=>1,'extension'=>'jpg','listing_id'=>$insert,'created_at'=>date('Y-m-d H:i:s')]);
            }
       }else{
           $this->common_model->insertdata('listing_files',['name'=>'dummy_listing.jpg','type'=>1,'extension'=>'jpg','listing_id'=>$insert,'created_at'=>date('Y-m-d H:i:s')]);
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
                   $this->common_model->insertdata('listing_files',['name'=>$key,'type'=>$image,'extension'=>$ext,'listing_id'=>$insert,'created_at'=>date('Y-m-d H:i:s')]);
             }
         }
       }
       if(!empty($invite_members)){
        	$previous_members = $this->common_model->selectdata('members',['listing_id'=>$insert]);
			if(count($previous_members)>0){
			foreach ($previous_members as $key) {
				if(!in_array($key->user_id, $invite_members)){
					$this->common_model->deletedata('members',['user_id'=>$key->user_id,'listing_id'=>$insert]);
				}
			}

			}
			foreach ($invite_members as $key) {
				$check_invited = $this->common_model->getfirst('members',['user_id'=>$key,'listing_id'=>$insert]);
				if(empty($check_invited)){
					$this->common_model->insertdata('members',['user_id'=>$key,'listing_id'=>$insert,'status'=>0,'created_at'=>date('Y-m-d H:i:s')]);
					$user_details = $this->common_model->getfirst('users',['id'=>$key]);
					$link = url('/brickdetails').'/'.$insert;
					$email_data = array('username' => $user_details->name.' '.$user_details->last_name, 'type' => 'Brick', 'id'=>$insert,'title'=>$post['name'],'link'=>$link);
					$email_to = $user_details->email;
					$name_to = $user_details->name.' '.$user_details->last_name;
					Mail::send('emails.invite-user', $email_data, function($message) use ($name_to, $email_to){
					$message->to($email_to, $name_to)->subject
						('Brick Invitation');
						$message->from(config('app.MAIL_FROMADDRESS'),'Share The Brick');
					});
				}
			}

			
        }
       $data['status'] = 1;
       return json_encode($data);
    }
    //Get selected brand details on create brick form
    public function get_brand_detals_ajax(Request $request){
       
        $brand_details = $this->common_model->getfirst('listing',['id'=>$request->id]);
        if(!empty($brand_details)){
            $image = $this->common_model->getfirst('listing_files',['listing_id'=>$request->id,'type'=>1]);
            $images = $this->common_model->selectdata('listing_files',['listing_id'=>$request->id,'type'=>1]);
            $data['brand_details'] = '<div class="col-lg-12 col-sm-12 col-md-6">
                                            <div class="single-listing-item new-stl-lyt bg-syr selected">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="listing-image">
                                                            <a href="javascript:void(0);" data-toggle="modal" data-target="#listing-popup" class="d-block lists">
                                                                <img src="'.url('/uploads/files').'/'.$image->name.'" alt="image">
                                                            </a>

                                                            <div class="listing-tag">
                                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#listing-popup" class="d-block">';
              $data['brand_details'] .=   'Brands';

              $data['brand_details'] .= '</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="listing-content pl-0">
                                                            <h3><a href="javascript:void(0);" data-toggle="modal" data-target="#listing-popup" class="d-inline-block">'.$brand_details->name.'</a>
                                                            <span class="right-srls"> <i class="bx bx-check"></i> Selected </span>
                                                            </h3>
                                                            <p class="mt-2 mb-2">'.Getdesc($brand_details->description,200,1).'</p>
                                                            <div class="d-flex align-items-center justify-content-between">
                                                                <div class="price">
                                                                    <b data-toggle="tooltip" data-placement="top">
                                                                        $'.$brand_details->price_from.' - $'.$brand_details->price_to.'
                                                                    </b>
                                                                </div>
                                                                <span class="location"><i class="bx bx-map"></i>'.$brand_details->location_city.'</span>
                                                            </div>
                                                        </div>
                                                        <div class="listing-box-footer br-st-a">
                                                            <span class="add-bt"> <b> Listed By: </b> '.Auth::User()->name.' '.Auth::User()->last_name.' <span>
                                                            <a href="javascript:void(0);" data-toggle="modal" data-target="#listing-popup" class="bts-aea"> View Details </a>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>';
            $data['listing_details'] = '<div class="modal-dialog modal-review modal-lg" role="document">
                        <div class="modal-content contnt-design-new">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Listing Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body pt-5 pb-5">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="list-str">
                                            <div class="listing-details-image-slides owl-carousel owl-theme heigt-ctaa">';
            foreach ($images as $key) {
                $data['listing_details'] .= '<div class="listing-details-image text-center">
                                                    <img src="'.url('/uploads/files').'/'.$key->name.'" alt="image">
                                                </div>';
            }



              $data['listing_details'] .= '</div>
                                            <span class="list-cla">';


              $data['listing_details'] .=   'Brands';
              $data['listing_details'] .= '</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single-listing-item new-stl-lyt pop-bxs">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="listing-content pl-0 pt-0">
                                                        <h3><a href="'.url('/branddetails').'/'.$brand_details->id.'" class="d-inline-block">'.$brand_details->name.'</a></h3>
                                                        <div class="mt-2 mb-4">
                                                            <span class="lista-a"><b> Owner: </b> '.Auth::User()->name.' '.Auth::User()->last_name.' </span>
                                                            <span class="price-a">   $'.$brand_details->price_from.' - $'.$brand_details->price_to.' </span>
                                                        </div>

                                                        <p class="mt-2 mb-4">'.Getdesc($brand_details->description,200,1).'</p>
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <span class="location"><i class="bx bx-map"></i> '.$brand_details->location_city.'</span>
                                                        </div>
                                                    </div>
                                                    <a href="'.url('/').'/'.getUrl().'/branddetails/'.$brand_details->id.'" class="bts-aea float-left font-14"> View Full Details </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>';

        }else{
            $data['brand_details'] = '';
            $data['listing_details'] = '';
        }
        return json_encode($data);
    }
    public function get_listing_details_ajax(Request $request){
        $list_details = $this->common_model->getfirst('listing',['id'=>$request->id]);
        if(!empty($list_details)){
            $images = $this->common_model->selectdata('listing_files',['listing_id'=>$request->id,'type'=>1]);
            $owner = $this->common_model->getfirst('users',['id'=>$list_details->user_id]);
            $data['listing_details'] = '<div class="modal-dialog modal-review modal-lg" role="document">
                        <div class="modal-content contnt-design-new">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Listing Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body pt-5 pb-5">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="list-str">
                                            <div class="listing-details-image-slides owl-carousel owl-theme heigt-ctaa">';
            foreach ($images as $key) {
                $data['listing_details'] .= '<div class="listing-details-image text-center">
                                                    <img src="'.url('/uploads/files').'/'.$key->name.'" alt="image">
                                                </div>';
            }



              $data['listing_details'] .= '</div>
                                            <span class="list-cla">';
              if($list_details->type==1){
                     $data['listing_details'] .=   'Brands';

                }elseif($list_details->type==2){
                  $data['listing_details'] .=   'Bricks';
                }

             $data['listing_details'] .= '</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single-listing-item new-stl-lyt pop-bxs">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="listing-content pl-0 pt-0">
                                                        <h3>';
              if($list_details->type==1){
                $data['listing_details'] .= '<a href="'.url('/branddetails').'/'.$list_details->id.'" class="d-inline-block">'.$list_details->name.'</a>';
              }elseif($list_details->type==2){
                $data['listing_details'] .= '<a href="'.url('/brickdetails').'/'.$list_details->id.'" class="d-inline-block">'.$list_details->name.'</a>';
              }
              $data['listing_details'] .= '</h3>
                                                        <div class="mt-2 mb-4">
                                                            <span class="lista-a"><b> Owner: </b> '.$owner->name.' '.$owner->last_name.' </span>
                                                            <span class="price-a">';
             if($list_details->type==1 || $list_details->type==2){
              $data['listing_details'] .= '$'.$list_details->price_from.' - $'.$list_details->price_to.'';
             }
             $data['listing_details'] .= '</span>
                                                        </div>

                                                        <p class="mt-2 mb-4">'.Getdesc($list_details->description,200,1).'</p>
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <span class="location"><i class="bx bx-map"></i> '.$list_details->location_city.'</span>
                                                        </div>
                                                    </div>';
              if($list_details->type==1){
                $data['listing_details'] .= '<a href="'.url('/branddetails').'/'.$list_details->id.'" class="bts-aea float-left font-14"> View Full Details </a>';
              }elseif($list_details->type==2){
                $data['listing_details'] .= '<a href="'.url('/brickdetails').'/'.$list_details->id.'" class="bts-aea float-left font-14"> View Full Details </a>';
              }
              $data['listing_details'] .= '</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>';

        }else{
            $data['listing_details'] = '';
        }
        return json_encode($data);
    }
    //Display searched lising data
    public function searched_listings(Request $request){
      $post = $request->all();
      $data['listing'] = $this->common_model->listingSearch($post,items_count());
      $data['total_count'] = $this->common_model->listingSearchcount($post);
      $data['post'] = $post;
      $data['is_featured'] = 0;
      if(Auth::check() && ($post['keyword'] || $post['location'] || $post['type'])){
        $insert = $this->common_model->insertdata('saved_search',['type'=>$post['keyword'],'results'=>$data['total_count'],'location'=>$post['location'],'category'=>$post['type'],'created_at'=>date('Y-m-d H:i:s'),'user_id'=>Auth::User()->id]);
      }
      if(getUrl() == 'retail'){
         return view('retail.listing',$data);
      }else{
        return view('listing',$data);
      }

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
    //Used to display details in popup when user clicks on any listing.
    public function get_listing_details_associated_ajax(Request $request){

        $list_details = $this->common_model->getfirst('listing',['id'=>$request->id]);
        // dd($list_details);
        if($list_details->type != 1 ){
          $associated = $this->common_model->getlistingdetails(['listing.status'=>1,'listing.id'=>$list_details->brand]);
          
          $associated_listing = $this->common_model->getlistingdetails(['listing.status'=>1,'listing.id'=>$list_details->associated_listing]);
        }else{
          $associated = $this->common_model->getlistingdetails(['listing.status'=>1,'listing.brand'=>$list_details->id]);
        }
        if(!empty($list_details)){
            $owner = $this->common_model->getfirst('users',['id'=>$list_details->user_id]);
            $images = $this->common_model->selectdata('listing_files',['listing_id'=>$request->id,'type'=>1]);
            if($list_details->type==1){
               $listname = 'Brands';
               $name_listing = 'Brand';
               $listurl = url('').'/'.getUrl().'/branddetails'.'/'.$list_details->id;
               $price = '$'.$list_details->price_from.' - $'.$list_details->price_to;

            }elseif($list_details->type==2){
               $listname = 'Bricks';
               $name_listing = 'Brick';
               $listurl = url('').'/'.getUrl().'/brickdetails'.'/'.$list_details->id;
               $price = '$'.$list_details->price_from.' - $'.$list_details->price_to;
            }elseif($list_details->type==3){
               $listname = 'Full Space'; $name_listing = 'Full Space';
               $listurl =  url('').'/'.getUrl().'/fullspacedetails'.'/'.$list_details->id;
               if($list_details->price_from){
                $price = '$'.$list_details->price_from.$list_details->price_unit;
               }else{
                $price = '';
               }

            }elseif($list_details->type==4){
               $listname = 'Partial Space';
               $name_listing = 'Partial Space';
               $listurl =  url('').'/'.getUrl().'/partialspacedetails'.'/'.$list_details->id;
               if($list_details->price_from){
                $price = '$'.$list_details->price_from.$list_details->price_unit;
               }else{
                $price = '';
               }

            }elseif($list_details->type==5){
               $listname = 'Popup Store'; $name_listing = 'Popup Store';
               $listurl =  url('').'/'.getUrl().'/popupstoredetails'.'/'.$list_details->id;
               if($list_details->daily_rate){
                $price = ' <ul class="list-stra-al">
                                                    <li class="main-prc"> Price: </li>
                                                    <li> $'.$list_details->daily_rate.'/day </li>
                                                    <li> $'.$list_details->weekly_rate.'/week </li>
                                                    <li> $'.$list_details->monthly_rate.'/month </li>
                                                </ul>' ;
               }else{
                $price = '';
               }

            }elseif($list_details->type==6){
               $listname = 'Event Fairs'; $name_listing = 'Event Fairs';
               $listurl =  url('').'/'.getUrl().'/eventdetails'.'/'.$list_details->id;
               if($list_details->price_from){
                $price = '$'.$list_details->price_from.'/'.$list_details->price_unit;
               }else{
                $price = '';
               }

            }


            $data['listing_details'] = '<div class="modal-dialog modal-review modal-lg" role="document">
                        <div class="modal-content contnt-design-new">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">'.$name_listing.' Listing Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body pt-4 pb-4">
                                <div class="row">';


          $data['listing_details'] .='            <div class="col-md-6">
                                        <div class="list-str">
                                            <div class="listing-details-image-slides owl-carousel owl-theme heigt-ctaa">';
            foreach ($images as $key) {
                $data['listing_details'] .= '<div class="listing-details-image text-center">
                                                    <img src="'.url('/uploads/files').'/'.$key->name.'" alt="image">
                                                </div>';
            }



              $data['listing_details'] .= '</div>
                                            <span class="list-cla">'.$listname.'</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single-listing-item new-stl-lyt pop-bxs">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="listing-content pl-0 pt-0">
                                                        <h3><a href="'.$listurl.'" class="d-inline-block">'.$list_details->name.'</a>';
              $data['listing_details'] .= '</h3>';
              if(count($associated)>0 && $list_details->type==2){
                  foreach ($associated as $key) {
                     if($key->type==1){
                        $url =  url('').'/'.getUrl().'/branddetails'.'/'.$key->id;
                        $name = 'Brands';
                     }elseif($key->type==2){
                        $url =  url('').'/'.getUrl().'/brickdetails'.'/'.$key->id;
                        $name = 'Bricks';
                     }
                     $title = $list_details->link_title;
                     $description = $list_details->link_desc;
                    
                     $external_link = $list_details->link_image;
                     if (@getimagesize($external_link)) {
                        $external_link = $external_link;
                      } else {
                        $external_link = url("/").'/uploads/files/dummy_listing.jpg';
                      }


                      $data['listing_details'] .= '<div class="listing-sidebar-widget">
                      <div class="listing-contact-info"><ul class="bg-othsr memberslist brde-n">
                              <li>
                              <img src="'.url('/').'/uploads/files/'.$key->image.'" class="rounded-circle"/>
                              <h2><a href="'.$url.'"> '.$key->name.'</a>
                                <span class="loca"> <i class="bx bx-map"></i> '.$key->location_city.'</span>
                              </h2>

                            </li></ul></div></div>';

                  }


                 }
                 if($list_details->type!=2){
                    $data['listing_details'] .= '   <div class="mt-2 mb-4">
                                                            <span class="lista-a"><b> Owner: </b> '.$owner->name.' '.$owner->last_name.' </span>
                                                            ';
                       if($price != ''){
                            $data['listing_details'] .= '<span class="price-a">'.$price.'</span>';
                       }
                 }

             $data['listing_details'] .= '
                                                        </div>

                                                        <p class="mt-2 mb-4">'.Getdesc($list_details->description,200,1).'</p>
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <span class="location"><i class="bx bx-map"></i> '.$list_details->location_city.'</span>
                                                        </div>
                                                    </div><a href="'.$listurl.'" class="bts-aea float-left font-14"> View Full Details </a>';
              $data['listing_details'] .= '</div>
                                            </div>
                                        </div>
                                    </div>';

                                    if($list_details->type==2){
                                             if(count($associated_listing)>0){
                                              foreach ($associated_listing as $key) {
                                                 if($key->type==1){
                                                    $url =  url('').'/'.getUrl().'/branddetails'.'/'.$key->id;
                                                    $name = 'Brands';
                                                    $associatedprice = '$'.$key->price_from.' - $'.$key->price_to;
                                                 }elseif($key->type==2){
                                                    $url =  url('').'/'.getUrl().'/brickdetails'.'/'.$key->id;
                                                    $name = 'Bricks';
                                                    $associatedprice = '$'.$key->price_from.' - $'.$key->price_to;
                                                 }elseif($key->type==3){
                                                    $url =  url('').'/'.getUrl().'/fullspacedetails'.'/'.$key->id;
                                                    $name = 'Full Space';
                                                    if($key->price_from){
                                                      $associatedprice = '$'.$key->price_from.$key->price_unit;
                                                     }else{
                                                      $associatedprice = '';
                                                     }
                                                 }elseif($key->type==4){
                                                    $url =  url('').'/'.getUrl().'/partialspacedetails'.'/'.$key->id;
                                                    $name = 'Partial Space';
                                                    if($key->price_from){
                                                      $associatedprice = '$'.$key->price_from.$key->price_unit;
                                                     }else{
                                                      $associatedprice = '';
                                                     }
                                                 }elseif($key->type==5){
                                                    $url =  url('').'/'.getUrl().'/popupstoredetails'.'/'.$key->id;
                                                    $name = 'Popup Store';
                                                    if($key->daily_rate){
                                                      $associatedprice = ' <ul class="list-stra-al">
                                                                                          <li class="main-prc"> Price: </li>
                                                                                          <li> $'.$key->daily_rate.'/day </li>
                                                                                          <li> $'.$key->weekly_rate.'/week </li>
                                                                                          <li> $'.$key->monthly_rate.'/month </li>
                                                                                      </ul>' ;
                                                     }else{
                                                      $associatedprice = '';
                                                     }
                                                 }elseif($key->type==6){
                                                    $url =  url('').'/'.getUrl().'/eventdetails'.'/'.$key->id;
                                                    $name = 'Event Fairs';
                                                     if($key->price_from){
                                                      $associatedprice = '$'.$key->price_from.'/'.$key->price_unit;
                                                     }else{
                                                      $associatedprice = '';
                                                     }
                                                 }



                                                  $data['listing_details'] .= '<div class="col-lg-12 col-sm-12 col-md-6">
                                                                        <div class="single-listing-item new-stl-lyt bg-syr">
                                                                            <div class="row">
                                                                                <div class="col-md-3">
                                                                                    <div class="listing-image">

                                                          <a href="'.$url.'" class="d-block lists heg-170"><img src="'.url('/uploads/files').'/'.$key->image.'" alt="image"></a><div class="listing-tag"><a href="'.$url.'" class="d-block">'.$name.'</a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    <div class="listing-content pl-0 pb-10">
                                                                                        <h3 class="font-adds"><a href="'.$url.'" class="d-inline-block">'.$key->name.' </a>  <span class="addc"> | Associated Listing </span>';
                                                                                  if($associatedprice != ''){
                                                                                    $data['listing_details'] .=   '<span class="price-a">'.$associatedprice.'</span>';
                                                                                  }
                                                                                   $data['listing_details'] .=   '</h3>
                                                                                        <p class="mt-2 mb-0">'.Getdesc($key->description,200,1).'</p>
                                                                                    </div>
                                                                                    <div class="listing-box-footer br-st-a ptb-10">
                                                                                        <span class="add-bt"> <b> Listed By: </b> '.$key->fname.' '.$key->lname.' <span>
                                                                                        <a href="'.$url.'" class="bts-aea"> View Details </a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>';
                                                }
                                              }

                                           }

          $data['listing_details'] .=   '</div>
                            </div>
                        </div>
                      </div>';


        }else{
            $data['listing_details'] = '';
        }
        return json_encode($data);
    }
    public function search_listing(Request $request){
        $post = $request->all();

        $listing = $this->common_model->listingSearch($post,items_count());
        // dd($listing);
        $totallisting = $this->common_model->listingSearchcount($post);
        if((isset($post['is_featured']) && $post['is_featured'] == 0) && (isset($post['search_save']) && $post['search_save'] == 1) && Auth::check() && ($post['keyword'] || $post['location'] || $post['type'])){
          $insert = $this->common_model->insertdata('saved_search',['type'=>$post['keyword'],'results'=>$totallisting,'location'=>$post['location'],'category'=>$post['type'],'created_at'=>date('Y-m-d H:i:s'),'user_id'=>Auth::User()->id]);
        }
        $data['html'] = '';
        if(count($listing)>0){
            foreach($listing as $key){
              if(isset($post['user_id']) && $post['user_id']){
                if($key->type==2){
                  $url = url('').'/'.getUrl().'/brickdetails'.'/'.$key->id;
                  $editurl = url('').'/'.getUrl().'/edit-brick'.'/'.$key->id;
                  $tag = $key->no_of_openings.' Openings';
                  if($key->lease_term){
                    $righttag = '<i class="bx bx-calendar"></i> '.$key->lease_term.' '.$key->lease_term_unit.'';
                  }else{
                    $righttag = '';
                  }

                  $associatedprice = '';
                }elseif($key->type==1){
                  $url = url('').'/'.getUrl().'/branddetails'.'/'.$key->id;
                  $editurl = url('').'/'.getUrl().'/edit-brand'.'/'.$key->id;
                  $catdata =  explode(',', $key->collaboration_type);
                  $brands_data = [];
                  foreach ($catdata as $cat) {
                       $brands_data[] = $cat;
                  }
                  $tag = '';
                  $collaboration_cat =  $this->common_model->selectdata('collaboration_type','','','','',$brands_data);
                  if(count($collaboration_cat)>0){
                    $total = count($collaboration_cat);
                    $check = 1;
                      foreach($collaboration_cat as $value){
                          $tag .= $value->name;
                          if($total != $check){
                            $tag .= ', ';
                          }
                          $check++;
                      }
                  }
                  $righttag = '<i class="bx bx-tags"></i> Category: '.$key->category_name;
                  $associatedprice = '$'.$key->price_from.' - $'.$key->price_to;
                }elseif($key->type==3){
                  $url = url('').'/'.getUrl().'/fullspacedetails'.'/'.$key->id;
                  $editurl = url('/edit-full-space-landlord').'/'.$key->id;
                  $tag = $key->space_category;
                  $righttag = '<i class="bx bx-tags"></i> Lease Term: '.$key->lease_term.' Years ';
                  if($key->price_from){
                    $associatedprice = '$'.$key->price_from.$key->price_unit;
                   }else{
                    $associatedprice = '';
                   }
                }elseif($key->type==4){
                  $url = url('').'/'.getUrl().'/partialspacedetails'.'/'.$key->id;
                  $editurl = url('').'/'.getUrl().'/edit-partial-space-landlord'.'/'.$key->id;
                  $tag = $key->lease_type;
                  $righttag = '<i class="bx bx-tags"></i> Current Use: ';
                  if($key->current_use == '-1'){
                    $righttag .= 'All';
                  }elseif($key->current_use == '-2'){
                    $righttag .= 'Not in use';
                  }else{
                    $righttag .= $key->current_use_name;
                  }

                  if($key->price_from){
                      $associatedprice = '$'.$key->price_from.$key->price_unit;
                     }else{
                      $associatedprice = '';
                     }
                }elseif($key->type==5){
                  $url = url('').'/'.getUrl().'/popupstoredetails'.'/'.$key->id;
                  $editurl = url('').'/'.getUrl().'/edit-popup-landlord'.'/'.$key->id;
                  $catdata =  explode(',', $key->ideal_uses);
                  $brands_data = [];
                  foreach ($catdata as $cat) {
                       $brands_data[] = $cat;
                  }
                  $tag = '';
                  $collaboration_cat =  $this->common_model->selectdata('ideal_uses','','','','',$brands_data);
                  if(count($collaboration_cat)>0){
                    $total = count($collaboration_cat);
                    $check = 1;
                      foreach($collaboration_cat as $value){
                          $tag .= $value->name;
                          if($total != $check){
                            $tag .= ', ';
                          }
                          $check++;
                      }
                  }


                  $associatedprice = 'Account ID: #'.$key->id;
                  if($key->daily_rate){
                      $righttag = ' <ul class="list-stra-al">
                                                      <li class="main-prc"> Price: </li>
                                                      <li> $'.$key->daily_rate.'/day </li>
                                                      <li> $'.$key->weekly_rate.'/week </li>
                                                      <li> $'.$key->monthly_rate.'/month </li>
                                                  </ul>' ;
                  }else{
                    $righttag = '' ;
                  }


                }elseif($key->type==6){
                    $url = url('').'/'.getUrl().'/eventdetails'.'/'.$key->id;
                    $editurl = url('').'/'.getUrl().'/edit-events-fairs-markets'.'/'.$key->id;
                    $tag = '';
                     if($key->price_from){
                      $associatedprice = '$'.$key->price_from.' '.$key->price_unit;
                      $righttag = '<ul class="list-stra-al">
                                                        <li class="main-prc"> Fee: </li>
                                                        <li> $'.$key->price_from.'/'.$key->price_unit.'</li>
                                                    </ul>';
                     }else{
                      $associatedprice = '';
                      $righttag = '';
                     }
                }elseif($key->type==7){
                    $url = url('').'/'.getUrl().'/servicedetails'.'/'.$key->id;
                    $editurl = url('').'/'.getUrl().'/edit-service'.'/'.$key->id;
                    $tag = $key->business_category;
                     
                      $associatedprice = 'Account ID: #'.$key->id.'';
                      $righttag = '';
                     
                }


                  $data['html'] .= '  <div class="col-lg-12 col-sm-12 col-md-6 single_listing_item'.$key->id.'">
                                <div class="single-listing-item new-stl-lyt">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="listing-image">
                                                <a href="'.$url.'" class="d-block"><img src="'.url('/').'/uploads/files/'.$key->image.'" alt="image"></a>';
                  if($tag != ''){
                    $data['html'] .= '<div class="listing-tag">
                                                    <a href="'.$url.'" class="d-block">'.$tag.'</a>
                                                </div>';
                  }

                         $data['html'] .= '
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="listing-content pl-0">
                                                <h3><a href="'.$url.'" class="d-inline-block">'.$key->name.'</a></h3>
                                                <p class="mt-2 mb-2 fontsizepara">'.Getdesc($key->description,200,1).'</p>
                                                <div class="d-flex align-items-center justify-content-between">
                                                     <div class="price">
                                                         <b data-toggle="tooltip" data-placement="top">';
                                                          if($associatedprice != ''){
                                                           $data['html'] .= $associatedprice;
                                                          }
                                                     $data['html'] .= ' </b>
                                                    </div>
                                                    <span class="location"><i class="bx bx-map"></i> '.$key->location_city.'</span>
                                                </div>
                                            </div>
                                            <div class="listing-box-footer br-st-a">
                                                <a href="'.$url.'" class="view-ayr"> <i class="fa fa-eye"></i> </a>
                                                <a href="'.$editurl.'" class="edit-ayr"> <i class="bx bx-pencil"></i> </a>
                                                <a href="javascript:void(0);" data-id="'.$key->id.'" data-toggle="modal" data-target="#delete-pop" class="delete_listing delete-ayr"> <i class="bx bx-trash"></i> </a>
                                                <span class="tcts-yt"> '.$righttag.' </span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div> ';
              }else{
                $data['html'] .= '<div class="col-lg-4 col-sm-12 col-md-6">
                    <div class="single-listing-item ';
                            if($key->type==2) $data['html'] .= 'bricks-borsr';
                            elseif($key->type==1) $data['html'] .= 'brands-brosr';
                            elseif($key->type==3) $data['html'] .= 'full-spce-brdr';
                            elseif($key->type==4) $data['html'] .= 'partial-brdrs';
                            elseif($key->type==5) $data['html'] .= 'popup-list';
                            elseif($key->type==6) $data['html'] .= 'events-yell';
                          $data['html'] .= '">
                        <div class="listing-image">
                            <a href="javascript:void(0);" data-id="'.$key->id.'" data-toggle="modal" data-target="#listing-popup" class="get_list_details_popup d-block"><img src="'.url('/').'/uploads/files/'.$key->image.'" alt="image"></a>
                            </a>

                            <div class="listing-tag">
                                <a href="javascript:void(0);" data-id="'.$key->id.'" data-toggle="modal" data-target="#listing-popup" class="get_list_details_popup d-block"><b> ID: </b>#'.$key->id.'</a>
                            </div>
                            <span class="lis-str-cat">';
                            if($key->type==2) $data['html'] .= 'Bricks';
                            elseif($key->type==1) $data['html'] .= 'Brands';
                            elseif($key->type==3) $data['html'] .= 'Full Space';
                            elseif($key->type==4) $data['html'] .= 'Partial Space';
                            elseif($key->type==5) $data['html'] .= 'Popup Stores';
                            elseif($key->type==6) $data['html'] .= 'Event Fairs';
                         $data['html'] .=' </span>
                        </div>
                        <a href="javascript:void(0);" data-id="'.$key->id.'" data-toggle="modal" data-target="#listing-popup" class="get_list_details_popup d-inline-block">
                        <div class="listing-content">

                            <h3>'.$key->name.'</h3>
                            <p class="mt-2">'.Getdesc($key->description,100,1).'</p>


                        </div>
                        </a>

                    </div>
                </div>';
              }
            }
         }else{
               $data['html'] .=' <div class="col-lg-12 col-sm-12 col-md-6">
                    <div class="single-listing-item new-stl-lyt">
                          <center><h4>  No Data Found.</h4></center>
                    </div>
                </div>';
        }
        $data['count'] = count($listing);
        $data['total_count'] = $totallisting;
        return json_encode($data);
    }
    //Used for load implementation of load more button
    public function load_more_listing(Request $request){
        $post = $request->all();
        // dd($post);
        $listing = $this->common_model->listingSearch($post,'',$post['data'],items_count());
        // dd($listing);
        $data['html'] = '';
        if(count($listing)>0){
            foreach($listing as $key){
              if(isset($post['user_id']) && $post['user_id']){
                if($key->type==2){
                  $url = url('/brickdetails').'/'.$key->id;
                  $editurl = url('/edit-brick').'/'.$key->id;
                  $tag = $key->no_of_openings.' Openings';
                  $righttag = '<i class="bx bx-calendar"></i> '.$key->lease_term.' '.$key->lease_term_unit.'';
                  $associatedprice = '';
                }elseif($key->type==1){
                  $url = url('/branddetails').'/'.$key->id;
                  $editurl = url('/edit-brand').'/'.$key->id;
                  $catdata =  explode(',', $key->collaboration_type);
                  $brands_data = [];
                  foreach ($catdata as $cat) {
                       $brands_data[] = $cat;
                  }
                  $tag = '';
                  $collaboration_cat =  $this->common_model->selectdata('collaboration_type','','','','',$brands_data);
                  if(count($collaboration_cat)>0){
                    $total = count($collaboration_cat);
                    $check = 1;
                      foreach($collaboration_cat as $value){
                          $tag .= $value->name;
                          if($total != $check){
                            $tag .= ', ';
                          }
                          $check++;
                      }
                  }
                  $righttag = '<i class="bx bx-tags"></i> Category: '.$key->category_name;
                  $associatedprice = '$'.$key->price_from.' - $'.$key->price_to;
                }elseif($key->type==3){
                  $url = url('/fullspacedetails').'/'.$key->id;
                  $editurl = url('/edit-full-space-landlord').'/'.$key->id;
                  $tag = $key->space_category;
                  $righttag = '<i class="bx bx-tags"></i> Lease Term: '.$key->lease_term.' Years ';
                  if($key->price_from){
                    $associatedprice = '$'.$key->price_from.$key->price_unit;
                   }else{
                    $associatedprice = '';
                   }
                }elseif($key->type==4){
                  $url = url('/partialspacedetails').'/'.$key->id;
                  $editurl = url('/edit-partial-space-landlord').'/'.$key->id;
                  $tag = $key->lease_type;
                  $righttag = '<i class="bx bx-tags"></i> Current Use: ';
                  if($key->current_use == '-1'){
                    $righttag .= 'All';
                  }elseif($key->current_use == '-2'){
                    $righttag .= 'Not in use';
                  }else{
                    $righttag .= $key->current_use_name;
                  }

                  if($key->price_from){
                      $associatedprice = '$'.$key->price_from.$key->price_unit;
                     }else{
                      $associatedprice = '';
                     }
                }elseif($key->type==5){
                  $url = url('/popupstoredetails').'/'.$key->id;
                  $editurl = url('/edit-popup-landlord').'/'.$key->id;
                  $catdata =  explode(',', $key->ideal_uses);
                  $brands_data = [];
                  foreach ($catdata as $cat) {
                       $brands_data[] = $cat;
                  }
                  $tag = '';
                  $collaboration_cat =  $this->common_model->selectdata('ideal_uses','','','','',$brands_data);
                  if(count($collaboration_cat)>0){
                    $total = count($collaboration_cat);
                    $check = 1;
                      foreach($collaboration_cat as $value){
                          $tag .= $value->name;
                          if($total != $check){
                            $tag .= ', ';
                          }
                          $check++;
                      }
                  }


                  $associatedprice = 'Account ID: #'.$key->id;
                  if($key->daily_rate){
                      $righttag = ' <ul class="list-stra-al">
                                                      <li class="main-prc"> Price: </li>
                                                      <li> $'.$key->daily_rate.'/day </li>
                                                      <li> $'.$key->weekly_rate.'/week </li>
                                                      <li> $'.$key->monthly_rate.'/month </li>
                                                  </ul>' ;
                  }else{
                    $righttag = '' ;
                  }


                }elseif($key->type==6){
                    $url = url('/eventdetails').'/'.$key->id;
                    $editurl = url('/edit-events-fairs-markets').'/'.$key->id;
                    $tag = '';
                     if($key->price_from){
                      $associatedprice = '$'.$key->price_from.' '.$key->price_unit;
                      $righttag = '<ul class="list-stra-al">
                                                        <li class="main-prc"> Fee: </li>
                                                        <li> $'.$key->price_from.'/'.$key->price_unit.'</li>
                                                    </ul>';
                     }else{
                      $associatedprice = '';
                      $righttag = '';
                     }
                }


                  $data['html'] .= '  <div class="col-lg-12 col-sm-12 col-md-6 single_listing_item'.$key->id.'">
                                <div class="single-listing-item new-stl-lyt">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="listing-image">
                                                <a href="'.$url.'" class="d-block"><img src="'.url('/').'/uploads/files/'.$key->image.'" alt="image"></a>';
                  if($tag != ''){
                    $data['html'] .= '<div class="listing-tag">
                                                    <a href="'.$url.'" class="d-block">'.$tag.'</a>
                                                </div>';
                  }

                         $data['html'] .= '
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="listing-content pl-0">
                                                <h3><a href="'.$url.'" class="d-inline-block">'.$key->name.'</a></h3>
                                                <p class="mt-2 mb-2 fontsizepara">'.Getdesc($key->description,200,1).'</p>
                                                <div class="d-flex align-items-center justify-content-between">
                                                     <div class="price">
                                                         <b data-toggle="tooltip" data-placement="top">';
                                                          if($associatedprice != ''){
                                                           $data['html'] .= $associatedprice;
                                                          }
                                                     $data['html'] .= ' </b>
                                                    </div>
                                                    <span class="location"><i class="bx bx-map"></i> '.$key->location_city.'</span>
                                                </div>
                                            </div>
                                            <div class="listing-box-footer br-st-a">
                                                <a href="'.$url.'" class="view-ayr"> <i class="fa fa-eye"></i> </a>
                                                <a href="'.$editurl.'" class="edit-ayr"> <i class="bx bx-pencil"></i> </a>
                                                <a href="javascript:void(0);" data-id="'.$key->id.'" data-toggle="modal" data-target="#delete-pop" class="delete_listing delete-ayr"> <i class="bx bx-trash"></i> </a>
                                                <span class="tcts-yt"> '.$righttag.' </span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div> ';
              }else{
                $data['html'] .= '<div class="col-lg-4 col-sm-12 col-md-6">
                    <div class="single-listing-item ';
                            if($key->type==2) $data['html'] .= 'bricks-borsr';
                            elseif($key->type==1) $data['html'] .= 'brands-brosr';
                            elseif($key->type==3) $data['html'] .= 'full-spce-brdr';
                            elseif($key->type==4) $data['html'] .= 'partial-brdrs';
                            elseif($key->type==5) $data['html'] .= 'popup-list';
                            elseif($key->type==6) $data['html'] .= 'events-yell';
                          $data['html'] .= '">
                        <div class="listing-image">
                            <a href="javascript:void(0);" data-id="'.$key->id.'" data-toggle="modal" data-target="#listing-popup" class="get_list_details_popup d-block"><img src="'.url('/').'/uploads/files/'.$key->image.'" alt="image"></a>
                            </a>

                            <div class="listing-tag">
                                <a href="javascript:void(0);" data-id="'.$key->id.'" data-toggle="modal" data-target="#listing-popup" class="get_list_details_popup d-block"><b> ID: </b>#'.$key->id.'</a>
                            </div>
                            <span class="lis-str-cat">';
                            if($key->type==2) $data['html'] .= 'Bricks';
                            elseif($key->type==1) $data['html'] .= 'Brands';
                            elseif($key->type==3) $data['html'] .= 'Full Space';
                            elseif($key->type==4) $data['html'] .= 'Partial Space';
                            elseif($key->type==5) $data['html'] .= 'Popup Stores';
                            elseif($key->type==6) $data['html'] .= 'Event Fairs';
                         $data['html'] .=' </span>
                        </div>
                        <a href="javascript:void(0);" data-id="'.$key->id.'" data-toggle="modal" data-target="#listing-popup" class="get_list_details_popup d-inline-block">
                        <div class="listing-content">

                            <h3>'.$key->name.'</h3>
                            <p class="mt-2">'.Getdesc($key->description,100,1).'</p>


                        </div>
                        </a>

                    </div>
                </div>';
              }
            }
         }else{
               $data['html'] .=' <div class="col-lg-12 col-sm-12 col-md-6">
                    <div class="single-listing-item new-stl-lyt">
                          <center><h4>  No Data Found.</h4></center>
                    </div>
                </div>';
        }
        $data['count'] = count($listing);
        return json_encode($data);
    }

    public function pricing(){
        return view('retail.user.pricing');
    }
    //Display add group page
    public function add_group(){  
        if(!Auth::check()){
            return redirect()->route('login');
        }
        $data= [];
        $id = "";
        if(Auth::check()){
            $id = Auth::User()->id;
        }    
        $data['groups'] = $this->common_model->getAdminGroups($id);
        $data['unseenMsg'] = $this->common_model->getUnseenMsgs($id);
        
        $msgIds = array_column($data['unseenMsg'], 'group_id');
        $data['unseenMsg'] = $msgIds;
        
        $data['getOtherGroups'] = $this->common_model->getOtherGroups($id);
        return view('retail.user.add-group',$data);
    }

    //add group in database
    public function save_group(Request $request){
        $groupArr= [
            'group_name' => $request->groupName,
            'group_admin' => Auth::User()->id,
            'status'=> 1,
            'created_at' => date('Y-m-d H:i:s')
        ];
        $insert = $this->common_model->insertdata('groups',$groupArr);
        if($insert){
            $data['status'] = 1;
        }else{
            $data['status'] = 0;
        }        
        return json_encode($data);
    }

    //display page to add users in group
    function invite_group_members(Request $request,$group_id){
        if(!Auth::check()){
            return redirect()->route('login');
        }
        $users = $this->common_model->checkUserExist($request->group_id, Auth::User()->id);
        $admin = $this->common_model->checkGroupAdmin(Auth::User()->id,$request->group_id);
        if($admin == null){
            if($users == null ){
                return redirect()->route('retail.add-group');
            }
        }
        $data =[];
        $data['groupData'] = $this->common_model->getGroupBygroupId($group_id);        
        $data['allUser'] = $this->common_model->getAllUsers(Auth::User()->id);
        $filteredUser=[];
        $allUsers=[];

        foreach($data['allUser'] as $users){
            $abc = $this->common_model->checkUserExist($group_id, $users->id);
            if($abc == "" && $abc == null){
                $filteredUser['name'] = $users->name;
                $filteredUser['email'] = $users->email;
                $filteredUser['id'] = $users->id;
                array_push($allUsers,$filteredUser);
            }
        }
        $data['users'] = $allUsers;
        $data['groupUsers'] = $this->common_model->getUsers($group_id);
        return view('retail.user.invite-group-users',$data);
    }
    //Add users to group chat
    function add_group_users(Request $request){
        if(!empty($request->group_id) && $request->group_id != '' && $request->users != ''){
            $users = explode (",",$request->users);
            //update user's group
            $insertId ='';
            foreach($users as $user){
                $insertId = $this->common_model->insertdata('group_user_mapping',['group_id' => $request->group_id,'user_id' => $user,'created_at'=>date('Y-m-d H:i:s')]);
            }
            if($insertId){
                $data['status'] = 1;
            }else{
                $data['status'] = 0;
            }
        }else{
            $data['status'] = 0;
        }
        return json_encode($data);
    }

    function group_chat($group_id){
        if(!Auth::check()){
            return redirect()->route('login');
        }
        //update mesg status
        $unSeenMsg = $this->common_model->checkMsgSeenOrNot($group_id, Auth::User()->id);
        $msgIds = array_column($unSeenMsg, 'id');
        $this->common_model->update_msg_status($group_id, Auth::User()->id,$msgIds);

        //check valid group user
        $users = $this->common_model->checkUserExist($group_id, Auth::User()->id);
        $admin = $this->common_model->checkGroupAdmin(Auth::User()->id,$group_id);
      
        if($admin == null){
            if($users == null ){
                return redirect()->route('retail.add-group');
            }
        }
        $data= [];
        $data['admin'] = $admin;
        $data['groupData'] = $this->common_model->getGroupBygroupId($group_id);      
        return view('retail.user.group-chat',$data);
    }

    function get_group_chat(Request $request){
      if(!Auth::check()){
        return redirect()->route('login');
      }
		
      $data = [];
      $data['brickDetail'] = $this->common_model->getfirst('listing',['id'=>$request->brick_id]);
	    $data['groupMsgs'] = $this->common_model->getGroupMsg($request->brick_id);  

        return view('retail.user.get-group-chat',$data);
    }

    function save_group_msgs(Request $request){
        if(!Auth::check()){
            return redirect()->route('login');
          }
          if(empty($request->message) || $request->message == ""){
                $data['status'] = 4;
                return json_encode($data);
          }
       
		$groupDetail = $this->common_model->getfirst('groups',['listing_id'=>$request->brick_id]);
        $msgArr= [
            'group_id' => $groupDetail->id,          
            'sent_by' => $request->sent_by,
            'seen' => 0,
            'status' => 1,
            'message_text' => $request->message,
            'created_at' => date('Y-m-d H:i:s')
        ];
        
        $insertId = $this->common_model->insertdata('group_msgs',$msgArr);
        //insert data to read/unread table
        $this->common_model->insertdata('group_read_unread_msgs',['msg_id' => $insertId]);
        $data['status'] = 1;
        return json_encode($data);
    }

    public function create_reminder(){
        if(!Auth::check()){
            return redirect()->route('login');
        }
        $data['users'] = $this->common_model->selectdata('users',[['status','=',1]],['name'=>'asc']);
        return view('retail.user.create-reminder',$data);
    }

    public function save_reminder(Request $request){
        if(!Auth::check()){
            return redirect()->route('login');
          }
        if(isset($request->reminder_to)){
            $data['title'] = $request->title;
            $data['added_by'] = Auth::User()->id;
            $data['reminder_to'] = implode(',',$request->reminder_to);
            $date_create = date_create($request->reminder_at);
            $data['reminder_at'] = date_format($date_create,"Y-m-d").'T'.date_format($date_create,"H:i:s");
            $data['created_at']  = date('Y-m-d H:i:s');         
            $insert = $this->common_model->insertdata('reminder',$data);    
            $data['status'] = 1;
        }else{
            $data['status'] = 2;
        } 
        return json_encode($data);
    }

    public function left_group(Request $request){
        if(!Auth::check()){
            return redirect()->route('login');
          }
        if(isset($request->group_id) && $request->group_id != ""){
            $this->common_model->deleteMember('group_user_mapping',$request->group_id, Auth::User()->id);
            $data['status'] = 1;
        }else{
            $data['status'] = 2;
        }
	}
	public function deleteMsg(Request $request){
        if(!Auth::check()){
            return redirect()->route('login');
          }
        if(isset($request->msgId) && $request->msgId != ""){
			$this->common_model->deletedata('group_msgs',['id'=>$request->msgId]);
			$this->common_model->deletedata('group_documents',['msg_id'=>$request->msgId]);
            $data['status'] = 1;
        }else{
            $data['status'] = 2;
		}
		return json_encode($data);
    }

    public function mark_as_read(Request $request){
        if(!Auth::check()){
          return redirect()->route('login');
        }
          if(isset($request->group_id) && $request->group_id != ""){
               //update mesg status
              $unSeenMsg = $this->common_model->checkMsgSeenOrNot($request->group_id, Auth::User()->id);
              $msgIds = array_column($unSeenMsg, 'id');
              $this->common_model->update_msg_status($request->group_id, Auth::User()->id,$msgIds);
              $data['status'] = 1;
          }else{
              $data['status'] = 2;
          }
      }
}
