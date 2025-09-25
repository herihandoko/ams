<?php

/**
 * Created by PhpStorm.
 * User: elfani.egotypalas
 * Date: 7/24/2018
 * Time: 11:12 AM
 */

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class User extends Model implements Authenticatable
{
    use AuthenticableTrait;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'job_title',
        'avatar',
        'mobile_no',
        'home_no',
        'office_no',
        'nik',
        'about_me',
        'gender',
        'birthdate',
        'opd_id'
    ];
    protected $connection = 'mysql';
    public $timestamps = false;
    protected $table = 'users';
    protected $guard_name = 'web';
}
