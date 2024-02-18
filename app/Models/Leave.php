<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;

    protected $fillable=['reason','start_date', 'end_date','applied_user_id','leave_type','status','mark','authorizer_user_id'];

    public function users()
    {
        return $this->belongsTo(User::class,'applied_user_id','id');
    }
}
