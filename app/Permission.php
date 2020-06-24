<?php

namespace App;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model {

    protected  $fillable = ['name', 'label'];


    /**
     * Get Profiles
     */
    public function profiles()
    {
        return $this->belongsToMany(Profile::class);
    }

    public function roles() {
        return $this->belongsToMany(\App\Role::class);
    }



}
