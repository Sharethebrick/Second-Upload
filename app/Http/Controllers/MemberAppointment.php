<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Common;
use Illuminate\Support\Facades\Auth;
use App\MemberAppointment as AppointmentModel;
use App\User;
use Mail;
class MemberAppointment extends Controller
{
    public function __construct(){
        $this->common_model = new Common();
        $this->middleware('auth');
    }
    /**
    Display a listing of the appointment
    **/
    public function index( $group_id ){
        $member_appointments = $this->get_appointment( $group_id );
        $group_info = $this->common_model->getfirst("groups",[ ['id' , $group_id] , ['group_admin' , Auth::id() ] ]);
        if( $group_info )
            return view('retail.member-appointment.listing',compact('member_appointments','group_info'));
        else
            abort(404);
    }

    /** 
    Appointment add edit
    **/
    public function createEdit( $group_id , $appointment_id = null ){
        $group_info = $this->common_model->getfirst("groups",[ ['id' , $group_id] , ['group_admin' , Auth::id() ] ]);
        if( empty( $group_info ) ){
            abort(404);
        }
        $mapping_users = get_group_members($group_id)->pluck('user_id')->toArray();
        $other_members = User::where('id','!=',Auth::id())
        ->where('status','1')->whereIn('id',$mapping_users)->get();
        if( !$other_members->count() ){
            return redirect()->route('retail.add-group');
        }
        $view_data = compact( 'other_members' , 'group_info' );
        if( $appointment_id ){
            $view_data['member_appointment'] = $this->get_appointment( $group_id , $appointment_id );
            if( $view_data['member_appointment'] ){
                $view_data['member_appointment'] = $view_data['member_appointment']->toArray();
            }
        }

        return view('retail.member-appointment.create-edit', $view_data );
    }

    /**
    Appointment store or update
    **/
    public function StoreUpdate(Request $request){
        $response = [
            'status'    =>  1,
            'message'   =>  $request->filled('appointment_id') ? 'Appointment updated successfully!' : 'Appointment created successfully!'
        ];
        $input_values = $request->all();
        unset( $input_values['_token'] , $input_values['appointment_id'] );
        $input_values['created_by'] = Auth::id();
        if( $request->filled('appointment_id') ){
            AppointmentModel::where( 'id', $request->appointment_id )->first()->update( $input_values );
            $appointment = AppointmentModel::find( $request->appointment_id );
            $appointment_status = "updated";
        }else{
            $appointment = AppointmentModel::create( $input_values );
            $appointment_status = "created";
        }
        Mail::send('emails.member-appointment', ['appointment' => $appointment,'appointment_status'=>$appointment_status], function ($m) use ( $request , $appointment ) {
            foreach( $appointment->members as $single_member ){
                if( $single_member = User::find($single_member) )
                    $m->to( $single_member->email , $single_member->name );
            }
            $m->subject( "Appointment " . ($request->filled('appointment_id') ? "updated" : "assigned") );
        });
        return response()->json($response);
    }

    /**
    Delete appointment
    **/
    public function delete( $group_id , $appointment_id ){
        $response = [
            'status'    =>  1,
            'message'   =>  "Appointment removed successfully!"
        ];
        $appointment = $this->get_appointment( $group_id , $appointment_id );
        if( $appointment ){
         $appointment->delete(); 
     }
     return response()->json($response);
 }

    /**
    Get appointment of loged in User
    **/
    public function get_appointment( $group_id , $appointment_id = null ){
        if( $appointment_id ){
            $return_appointment = AppointmentModel::where( 'created_by' , Auth::id() )
            ->where('group_id',$group_id)->find( $appointment_id );
        }else{
            $return_appointment = AppointmentModel::where( 'created_by' , Auth::id() )
            ->where('group_id',$group_id)->orderBy('id','desc')->get();
        }
        return $return_appointment;
    }
}
