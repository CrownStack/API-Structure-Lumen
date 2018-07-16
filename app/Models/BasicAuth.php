<?php

namespace App\Model;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;

class BasicAuth extends Model {
    # Use UUID Trait to generate the uuid
    use UuidTrait;

    # Store table name
    protected $table = 'basic_auth';

    # Fields retrieved when the querying records
    protected $hidden = ['id', 'user_agent', 'app_id', 'password', 'created_at', 'updated_at'];   # Can also use visible

    # Write fill able for fields to be inserted
    protected $fillable  = ['name', 'email', 'password', 'user_agent', 'access_token',
            'refresh_token', 'expire', 'app_id'];

    # Stop auto incrementing uuid
    public $incrementing = false;

    # Write functions to process request and store and retrieve item
    # Follow tendency of Fat models and slim controller
    # Controller should handle valid request

}