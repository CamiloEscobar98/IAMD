<?php

namespace App\Models\Admin\IntellectualPropertyRight;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

use App\Models\Admin\BaseModel;

use App\Models\Admin\IntellectualPropertyRight\IntellectualPropertyRightSubcategory;
use App\Models\Admin\IntellectualPropertyRight\IntellectualPropertyRightProduct;

class IntellectualPropertyRightCategory extends BaseModel
{
    use HasFactory;

    public const PROPERTY_RIGHTS = 'derechos de autor';
    public const INDUSTRIAL_PROPERTY = 'propiedad industrial';
    public const OTHER_FORMS = 'otras formas de propiedad';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Get all Subcategories of Intellectual Property Rights.
     * 
     * @return HasMany
     */
    public function intellectual_property_right_subcategories(): HasMany
    {
        return $this->hasMany(IntellectualPropertyRightSubcategory::class);
    }

    /**
     * Get all products of Intellectual Property Rights
     * 
     * @return HasManyThrough
     */
    public function intellectual_property_right_products()
    {
        return $this->hasManyThrough(IntellectualPropertyRightProduct::class, IntellectualPropertyRightSubcategory::class);
    }

    /**
     * Scope a query to only include Id
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfId($query, $value)
    {
        return !isset($value) && !$value ? $query : $query->where("{$this->getTable()}.id", $value);
    }

    /**
     * Scope a query to only include Name
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfNameLike($query, $value)
    {
        return !isset($value) && !$value ? $query : $query->where("{$this->getTable()}.name", 'like', "%{$value}%");
    }

    /**
     * Scope a query to only include Date From
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfDateFrom($query, $value)
    {
        return !isset($value) && !$value ? $query : $query->where("{$this->getTable()}.updated_at", '>=', $value);
    }

    /**
     * Scope a query to only include Date To
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfDateTo($query, $value)
    {
        return !isset($value) && !$value ? $query : $query->where("{$this->getTable()}.updated_at", '<=', $value);
    }
}
