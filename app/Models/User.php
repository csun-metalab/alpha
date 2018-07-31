<?php

namespace Alpha\Models;

use CSUNMetaLab\Authentication\MetaUser;

class User extends MetaUser
{

    /**
     * @var string
     */
    protected $primaryKey = 'user_id';

    /**
     * @var string
     */
    protected $keyType = 'string';

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'display_name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $appends = [
        'profile_image',
        'email_uri'
    ];

    protected function scopeIsStudent($query)
    {
        return $query->where('affiliation', 'student');
    }

    public function getProfileImageAttribute()
    {
        return env('PROFILE_IMAGE_URL').$this->email_uri.'/avatar';
    }

    public function getEmailUriAttribute()
    {
        return strtok($this->email, '@');
    }
}
