<?php

namespace App\Models\Client\Creator;

use App\Models\Client\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Traits\UuidPrimaryModel;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

use App\Models\Client\IntangibleAsset\IntangibleAsset;

class Creator extends BaseModel
{
    use HasFactory, UuidPrimaryModel;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'phone', 'email'];

    /**
     * Get the Creator Type
     *
     * @param  string  $value
     * @return string
     */
    public function getCreatorTypeAttribute()
    {
        return !is_null($this->getAttribute('internal')) ? 'Interno' : 'Externo';
    }

    /**
     * Get the Creator Type Route
     *
     * @param  string  $value
     * @return string
     */
    public function getCreatorTypeRouteAttribute()
    {
        return !is_null($this->getAttribute('internal')) ? 'creators.internal' : 'creators.external';
    }

    /**
     * Get The Document.
     * 
     * @return HasOne
     */
    public function document(): HasOne
    {
        return $this->hasOne(CreatorDocument::class);
    }

    /**
     * Get Intangible Assets.
     * 
     * @return BelongsToMany
     */
    public function intangibleAssets(): BelongsToMany
    {
        return $this->belongsToMany(IntangibleAsset::class);
    }

    /**
     * Get the Internal
     */
    public function internal(): HasOne
    {
        return $this->hasOne(CreatorInternal::class);
    }

    /**
     * Get the Internal
     */
    public function external(): HasOne
    {
        return $this->hasOne(CreatorInternal::class);
    }
}
