<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect,Hash,Session,File,Exception,DateTime;
use App\Common;

class FilesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
         $this->common_model = new Common();
     }


    function uploadFiles(Request $request){
        if(!$request->brick_id){
            $data['status'] =0;
            return json_encode($data);
        }
        $file = $request->file('file_name'); 
       
        if(!empty($file) && $request->type){
            $fileSize = $file->getSize();
            if($fileSize > 4000000){
                $data['status'] = 2;
                return json_encode($data);
            }
            $ext = $request->file('file_name')->extension();

            //Move Uploaded File
            $destinationPath = 'uploads/files';
            $original_name = $file->getClientOriginalName();    
                
            $file_name = str_replace(' ','_',time().$file->getClientOriginalName());
            $contentType = $file->getMimeType();
            
            if($request->type == 1){
                $allowedMimeTypes = ['image/jpeg','image/jpg','image/gif','image/png'];
                $file_type = 1;

            }elseif($request->type == 2){
                $allowedMimeTypes = ['application/pdf','text/plain','text/csv','application/msword','text/xls','text/xlsx','application/vnd.ms-excel','application/vnd.openxmlformats-officedocument.wordprocessingml.document','application/doc','application/ms-doc','application/octet-stream'];
                $file_type = 2;
            }
            
            if(!in_array($contentType, $allowedMimeTypes)){
               
                $data['status'] = 3;
                return json_encode($data);
            }
                   
            if($file->move($destinationPath,$file_name)){
                $flag = 1; 
            } 
            if($request->hasFile('file_name')){
                $msgId = $this->common_model->insertdata('group_documents',['listing_id' => $request->brick_id,'name' => $file_name, 'type' => $file_type,'visibility' => 'private' ,'extension' => $ext, 'created_at'=>date('Y-m-d H:i:s')]);
                $data['status'] = 1;
                return json_encode($data);
            }
            $data['status'] = 0;
            return json_encode($data);
        }
    }
    //Get Files and Images
    public function getChatFiles(Request $request){
        $id = $request->brick_id;

        $type = $request->type;
        $data = [];
        $list = "";
        if($id != "" && $type != ""){
            if($type == 1){
                $group_images = $this->common_model->getGroupFiles($id,$type);
                if(count($group_images) > 0){
                    foreach($group_images as $images){
                    $list .= '<div class="listing-details-image text-center">
                       
                        <img src="'.url('/').'/uploads/files/'.$images->name.'" alt="image">
                    </div>';
                    }
                    $data['list'] = $list;
                }else{
                    $data['list'] = '<div style="flex:1;text-align:center">No image found</div>';
                }
                $data['list'] = "<div class='listing-details-image-slides owl-carousel owl-theme heigt-ctaa'>{$data['list']}</div>";
            }elseif($type == 2){
                $group_files = $this->common_model->getGroupFiles($id,$type);
                if(count($group_files) > 0){
                    foreach($group_files as $files) {
                        $list .= '<div class="col-md-3">
                            <a download href="'.url('/').'/uploads/files/'.$files->name.'" target="_blank" class="text-center d-block">'.
                                get_file_image( $files->extension ). $files->name.'
                            </a>
                            </div>';
                    }
                    $data['list'] = $list;

                   
                }else{
                    $data['list'] = '<div style="flex:1;text-align:center">No file found </div>';
                }
            }else{
                $data['list'] = "Something went wrong";
            }
        }else{
            $data['list'] = "Something went wrong";
        }
        return json_encode($data);

    }
}
