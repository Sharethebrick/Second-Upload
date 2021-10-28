<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberTask extends Model
{
    public $timestamps = false;
    protected $guarded = ['id'];

    /** Task assigned to user **/
    public function assigned_to_user(){
        return $this->belongsTo(User::class,'assigned_to');
    }

    /** Task assigned by user **/
    public function assigned_by_user(){
        return $this->belongsTo(User::class,'assigned_by');
    }
}
