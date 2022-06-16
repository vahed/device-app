<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Device extends Model
{
    use HasFactory;

    const CREATED_AT = 'created_datetime';
    const UPDATED_AT = 'update_datetime';


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'devices';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['model', 'brand', 'release_date', 'os', 'is_new', 'received_datatime', 'created_datetime', 'update_datetime'];

    protected $primarykey = 'id';

    protected $keyType = 'string';

    public $incrementing = false;

    /**
     * Set the id to uuid and not auto incremented
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if(empty($model->id)) {
                $model->id = Str::uuid();
            }
        });
    }
}
