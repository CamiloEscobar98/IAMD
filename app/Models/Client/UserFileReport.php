<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserFileReport extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'report_type', 'file_name'];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
