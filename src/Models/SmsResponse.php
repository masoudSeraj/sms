<?php

namespace Sunnyr\Sms\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SmsResponse extends Model
{
    use HasFactory;
    protected $table = 'sms_responses';
    protected $guarded = [];

    public function user() :BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
