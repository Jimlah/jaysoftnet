<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'closed_at',
        'created_at',
        'updated_at',
    ];


    protected static function booted()
    {
        if (auth()->user() && !auth()->user()->is_admin) {
            static::addGlobalScope('user_tickets', function ($builder) {
                $builder->where('user_id', auth()->user()->id);
            });

            static::creating(function ($model) {
                $model->user_id = auth()->user()->id;
            });
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function closeTicket()
    {
        if ($this->closed_at) {
            return false;
        }

        $this->closed_at = now()->toDateTimeString();
        $this->save();

        return true;
    }


    public function scopeClosed($query)
    {
        return $query->whereNotNull('closed_at');
    }

    public function scopeOpen($query)
    {
        return $query->whereNull('closed_at');
    }

    public function getStatusAttribute()
    {
        if ($this->closed_at) {
            return 'closed';
        }

        return 'open';
    }
}
