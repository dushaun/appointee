<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Appointment extends Model
{
    use SoftDeletes, Notifiable;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['date', 'deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'info', 'date', 'unique_link',
    ];

    public function scopeFindByUID($query, $id)
    {
        return $query->where('unique_link', $id)
            ->first();
    }
}
