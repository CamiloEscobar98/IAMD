<?php

namespace App\Models\Admin\IntellectualPropertyRight;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Support\Str;

use App\Models\Admin\BaseModel;

use App\Models\Admin\IntellectualPropertyRight\IntellectualPropertyRightCategory;

class IntellectualPropertyRightSubcategory extends BaseModel
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['intellectual_property_right_category_id', 'name'];

    /**
     * Get the Name
     *
     * @param  string  $value
     * @return string
     */
    public function getUpperNameAttribute()
    {
        return Str::upper($this->name);
    }

    /**
     * Get the Intellectual Property Right Category.
     * 
     * @return BelongsTo
     */
    public function intellectual_property_right_category(): BelongsTo
    {
        return $this->belongsTo(IntellectualPropertyRightCategory::class);
    }

    /**
     * Get the Intellectual Property Right Products.
     * 
     * @return HasMany
     */
    public function intellectual_property_right_products(): HasMany
    {
        return $this->hasMany(IntellectualPropertyRightProduct::class);
    }

    /**
     * Scope a query to only include Id
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param int $value
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfId($query, $value)
    {
        return !isset($value) && !$value ? $query : $query->where("{$this->getTable()}.id", $value);
    }

    /**
     * Scope a query to only include Category
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param array|int $categoryId
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfCategory($query, $categoryId)
    {
        if (is_array($categoryId) && !empty($categoryId)) {
            return $query->whereIn("{$this->getTable()}.intellectual_property_right_category_id", $categoryId);
        }

        return !$categoryId ? $query : $query->where("{$this->getTable()}.intellectual_property_right_category_id", $categoryId);
    }

    /**
     * Scope a query to only include Name
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $value
     * 
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
     * @param mixed $value
     * 
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
     * @param mixed $value
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfDateTo($query, $value)
    {
        return !isset($value) && !$value ? $query : $query->where("{$this->getTable()}.updated_at", '<=', $value);
    }
}
