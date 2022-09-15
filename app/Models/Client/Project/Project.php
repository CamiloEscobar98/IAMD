<?php

namespace App\Models\Client\Project;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

use Database\Factories\Client\ProjectFactory;

use App\Models\Client\BaseModel;

class Project extends BaseModel
{
    use HasFactory;

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory<static>
     */
    protected static function newFactory()
    {
        return ProjectFactory::new();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'research_unit_id',
        'director_id',
        'name',
        'description',
    ];

    /**
     * Get the research unit.
     * 
     * @return BelongsTo
     */
    public function research_unit(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Client\ResearchUnit::class, 'research_unit_id');
    }

    /**
     * Get the director.
     * 
     * @return BelongsTo
     */
    public function director(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Client\Creator\Creator::class, 'director_id');
    }

    /**
     * Get projects.
     * 
     * @return HasMany
     */
    public function intangible_assets(): HasMany
    {
        return $this->hasMany(\App\Models\Client\IntangibleAsset\IntangibleAsset::class);
    }

    /**
     * @return HasOne
     */
    public function project_financing(): HasOne
    {
        return $this->hasOne(\App\Models\Client\Project\ProjectFinancing::class);
    }
}
