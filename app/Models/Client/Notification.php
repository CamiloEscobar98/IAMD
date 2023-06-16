<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\Admin\NotificationType;
use Carbon\Carbon;

class Notification extends BaseModel
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'notifications';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'notification_type_id', 'message', 'checked_at'];

    /**
     * Get the Difference in Minutes
     *
     * @param  string  $value
     * @return string
     */
    public function getMinutesAttribute($value)
    {
        $createdAt = $this->getAttribute('created_at');
        $now = Carbon::now();
        $diff = $now->diff($createdAt);
    
        $hours = $diff->h;
        $minutes = $diff->i;
        $seconds = $diff->s;
    
        $timeComponents = [];
    
        if ($hours > 0) {
            $timeComponents[] = $hours . ' horas';
        }
    
        if ($minutes > 0) {
            $timeComponents[] = $minutes . ' minutos';
        }
    
        if ($seconds > 0) {
            $timeComponents[] = $seconds . ' segundos';
        }
    
        return implode(', ', $timeComponents);
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function notification_type(): BelongsTo
    {
        return $this->belongsTo(NotificationType::class);
    }

    /**
     * Scope a query to only include User
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param array|string $user
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByUser($query, $user)
    {
        if (is_array($user) && !empty($user)) {
            return $query->whereIn("{$this->getTable()}.user_id", $user);
        }
        return $query->where("{$this->getTable()}.user_id", $user);
    }
}
