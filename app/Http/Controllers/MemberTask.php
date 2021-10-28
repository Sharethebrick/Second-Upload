<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Common;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\MemberTask as TaskModel;
use App\User;
use App\TaskChat;
use Mail;

class MemberTask extends Controller
{
	public function __construct(){
		$this->middleware('auth');
	}
    /*
    Display a listing of the tasks
    **/
    public function index(){

		
		$task = TaskModel::where('assigned_by' , Auth::id() )->orderBy('id','desc')->get();
		$task1 = TaskModel::where('assigned_to' , Auth::id() )->orderBy('id','desc')->get();
		$data['member_tasks'] = $task->merge($task1);
    	return view('retail.member-task.listing',$data);
    }

    /*
    Task add edit
    */
    public function createEdit( $task_id = null ){
    	$other_members = User::where('id','!=',Auth::id())
    	->where('status','1')->get();
    	$view_data = compact( 'other_members' );
    	if( $task_id ){
    		$view_data['member_task'] = $this->get_task( $task_id );
    		if( $view_data['member_task'] ){
    			$view_data['member_task'] = $view_data['member_task']->toArray();
    		}
    	}
    	return view('retail.member-task.create-edit', $view_data );
	}

	/*
	 Get task by task Id 
	*/ 

	// public function getTaskById(Request $request){
	// 	if($request->task_id != ""){
	// 		$view_data = $this->get_task( $request->task_id );
    // 		if( $view_data){
    // 			$view_data = $view_data['member_task']->toArray();
	// 		}
	// 		$response = [
    //             'status'    =>  1,
    //             'data'   =>  $view_data
	// 		];
	// 		return response()->json($response);
	// 	}
	// }

    /*
    Task store or update
    */
    public function StoreUpdate(Request $request){	

		if(!$request->filled('update_task_id')){
			$validator = Validator::make($request->all() , [
				'assigned_to' => 'required|numeric',
			]);
		}
		$validator = Validator::make($request->all() , [
            'title' => 'required|string',
            'description' => 'required',
		]);
		
        if ($validator->fails() && $request->ajax())
        {
            $response = [
                'status'    =>  0,
                'message'   =>  $validator->getMessageBag()->first()
			];
			return response()->json($response);
		}			
    	if( $request->update_task_id){
			$updateArray = [
				'title' => $request->title,
				'description' => $request->description,
			]; 

			$task_id = TaskModel::where('id', $request->update_task_id)->where('brick_id',$request->brick_id)->update($updateArray);
			    $response = [
					'status'    =>  1,
					'message'   =>  'Task updated successfully!'
				];
			
			
    		$task = $this->get_task($request->update_task_id );
    		$task_status = "updated";
		}else{
		
			$task = new TaskModel;
			$task->title = $request->title;
			$task->description = $request->description;
			$task->note = $request->note;
			$task->assigned_to = $request->assigned_to;
			$task->assigned_by = Auth::id();
			$task->brick_id = $request->brick_id;
			$task->due_date = date('Y-m-d', strtotime($request->due_date)); 		
			$task->save();
			
			$task_id = $task->id;
			if($task_id){
				// Mail::send('emails.member-task-assign', ['task' => $task], function ($m) use ( $request , $task ) {
				// 	$m->to($task->assigned_to_user->email , $task->assigned_to_user->name)
				// 	->subject( "Task " . ($request->filled('task_id') ? "updated" : "assigned") );
				// });				
				$response = [
					'status'    =>  1,
					'message'   =>  'Task addedd successfully!'
				];
			}else{
				$response = [
					'status'    =>  0,
					'message'   =>  'Something went wrong'
				];
			}
    	}
    	return response()->json($response);
    }

    /*
    	Delete task
    */
    public function delete( $task_id ){
    	$response = [
    		'status'    =>  1,
    		'message'   =>  "Task removed successfully!"
    	];
    	$task = $this->get_task( $task_id );
    	if( $task ){
    		$task->delete(); 
    	}
    	return response()->json($response);
	}

	//Mark as complete Task
	public function completeTask(Request $request){
    	$response = [
    		'status'    =>  1,
    		'message'   =>  "Task completed successfully!"
		];
		$task_id = $request->task_id;
		if($task_id != ""){
			$task = TaskModel::where('id',$task_id)->update(['is_completed' => 'yes']);
			if($task){
				return response()->json($response);
			}	
		}else{
			$response = [
				'status'    =>  0,
				'message'   =>  "Something went wrong"
			];
			return response()->json($response);
		}		
    }

    /*
    	Get task of logged in User
    */
    public function get_task( $task_id = null ){
    	if( $task_id ){
    		$return_task = TaskModel::where( 'assigned_by' , Auth::id() )->find( $task_id );
    	}else{
    		$return_task = TaskModel::where( 'assigned_by' , Auth::id() )->with('assigned_to_user')->orderBy('id','desc')->get();
    	}
    	return $return_task;
	}
	
	function save_task_msgs(Request $request){
        if(!Auth::check()){
            return redirect()->route('login');
          }
          if(empty($request->message) || $request->message == ""){
                $data['status'] = 4;
                return json_encode($data);
          }
        $msgArr= [
            'task_id' => $request->task_id,          
            'sent_by' => $request->sent_by,
            'sent_to' => Auth::user()->id,
            'status' => 1,
            'note_message' => $request->message,
            'created_at' => date('Y-m-d H:i:s')
        ];
		
		$insertId = TaskChat::create($msgArr);
		if($insertId){
			$data['status'] = 1;
			return json_encode($data);
		}else{
			$data['status'] = 0;
			return json_encode($data);
		}
	}
	
	function getTaskById(Request $request){
		$data = [];
		if($request->task_id != ""){
			$task = TaskModel::where('id',$request->task_id)->first();
			if($task){
				$data['status'] = 1;
				$data['data'] =$task;
			}else{
				$data['status'] = 0;
			}
		}else{
			$data['status'] = 0;
		}
		return json_encode($data);
	}
}
