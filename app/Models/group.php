<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class group extends Model
{
    use HasFactory;
    protected $guarded = [];
// get admin id from user 
public function user()
    {
        return $this->belongsTo('App\Models\User', 'admin_id');
    }

// get Subscribers from group_participant according join to Models\User   
   public function participants()
    {
        return $this->belongsToMany('App\Models\User', 'group_participants', 'group_id', 'user_id');
    }
// get all messages according group id from Models\Message
    public function messages()
    {
        return $this->hasMany('App\Models\Message', 'group_id');
    }
}
