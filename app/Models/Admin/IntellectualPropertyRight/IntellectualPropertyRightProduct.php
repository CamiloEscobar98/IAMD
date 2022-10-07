<?php

namespace App\Models\Admin\IntellectualPropertyRight;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\Admin\BaseModel;

use App\Models\Admin\IntellectualPropertyRight\IntellectualPropertyRightSubcategory;

class IntellectualPropertyRightProduct extends BaseModel
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['intellectual_property_right_subcategory_id', 'name'];

    /**
     * Get the Intellectual Property Right Subcategory.
     * 
     * @return BelongsTo
     */
    public function intellectual_property_right_subcategory(): BelongsTo
    {
        return $this->belongsTo(IntellectualPropertyRightSubcategory::class);
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
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfCategory($query, $categoryId)
    {
        $joinIntellectualPropertyRightCategory = 'intellectual_property_right_categories';
        $joinIntellectualPropertyRightSubcategory = 'intellectual_property_right_subcategories';

        $query->join($joinIntellectualPropertyRightSubcategory, "{$joinIntellectualPropertyRightSubcategory}.id", "{$this->getTable()}.intellectual_property_right_subcategory_id");
        $query->join($joinIntellectualPropertyRightCategory, "{$joinIntellectualPropertyRightCategory}.id", "{$joinIntellectualPropertyRightSubcategory}.intellectual_property_right_category_id");

        if (is_array($categoryId) && !empty($categoryId)) {
            return $query->whereIn("{$joinIntellectualPropertyRightCategory}.id", $categoryId);
        }

        return !$categoryId ? $query : $query->where("{$joinIntellectualPropertyRightCategory}.id", $categoryId);
    }

    /**
     * Scope a query to only include Subcategory
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param array|int $categoryId
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfSubcategory($query, $subCategoryId)
    {
        if (is_array($subCategoryId) && !empty($subCategoryId)) {
            return $query->whereIn("{$this->getTable()}.intellectual_property_right_subcategory_id", $subCategoryId);
        }

        return !$subCategoryId ? $query : $query->where("{$this->getTable()}.intellectual_property_right_subcategory_id", $subCategoryId);
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
