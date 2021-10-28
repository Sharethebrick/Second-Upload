<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberAppointment extends Model
{
    //
    protected $guarded = ['id'];

    protected $appends = ['member_names'];

    /** Appointment created by user **/
    public function created_by_user(){
        return $this->belongsTo(User::class,'created_by');
    }

    /**
    Set members of appointment
    **/
    public function setMembersAttribute($value){
        if( !is_array($value) ){
            $value = [];
        }

        $this->attributes['members'] = implode(",",$value);
    }
    /**
    Get members of appointment
    **/
    public function getMembersAttribute( $value ){
        $value = explode(",",$value);
        if( !is_array($value) )
            $value = [];
        return $value;
    }
    /** 
    Get names of the member
    **/
    public function getMemberNamesAttribute(){
        $user_ids = $this->members;
        if( empty($user_ids) )
            return 'NA';
        return User::whereIn('id',$user_ids)->get()->implode('name', ', ');;
    }
    
}
