<?php

namespace App\Models\Client\IntangibleAsset;

use App\Models\Client\BaseModel;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Illuminate\Support\Str;

use App\Traits\Client\IntangibleAsset\HasPhases;

use App\Models\Admin\IntangibleAssetState;
use App\Models\Admin\IntellectualPropertyRight\IntellectualPropertyRightProduct;
use App\Models\Client\Creator\Creator;
use App\Models\Client\Project\Project;
use App\Models\Client\User;
use App\Models\Client\SecretProtectionMeasure;
use App\Models\Client\IntangibleAsset\IntangibleAssetDPI;

class IntangibleAsset extends BaseModel
{
    use HasFactory, HasPhases;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_id',
        'classification_id',
        'intangible_asset_state_id',
        'name',
        'description',
        'code',
        'path',
    ];

    /**
     * Relations with the model IntangibleAsset
     */

    /**
     * Get Project.
     * 
     * @return BelongsTo
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * @return BelongsTo
     */
    public function classification(): BelongsTo
    {
        return $this->belongsTo(IntellectualPropertyRightProduct::class, 'classification_id');
    }

    /**
     * Get Intangible Asset State.
     * 
     * @return BelongsTo
     */
    public function intangible_asset_state(): BelongsTo
    {
        return $this->belongsTo(IntangibleAssetState::class);
    }

    /**
     * Get the Intangible Asset Published
     * 
     * @return HasOne
     */
    public function intangible_asset_published(): HasOne
    {
        return $this->hasOne(IntangibleAssetPublished::class);
    }

    /**
     * @return HasOne
     */
    public function intangible_asset_commercial(): HasOne
    {
        return $this->hasOne(IntangibleAssetCommercial::class);
    }

    /**
     * @return HasOne
     */
    public function intangible_asset_confidenciality_contract(): HasOne
    {
        return $this->hasOne(IntangibleAssetConfidentialityContract::class);
    }

    /**
     * @return HasOne
     */
    public function intangible_asset_session_right_contract(): HasOne
    {
        return $this->hasOne(IntangibleAssetSessionRightContract::class);
    }

    /**
     * @return  HasOne
     */
    public function intangible_asset_contability()
    {
        return $this->hasOne(IntangibleAssetContability::class);
    }

    /**
     * @return HasOne
     */
    public function intangible_asset_protection_action(): HasOne
    {
        return $this->hasOne(IntangibleAssetProtectionAction::class);
    }

    /**
     * Get all DPIS
     * 
     * @return  HasMany
     */
    public function dpis()
    {
        return $this->hasMany(IntangibleAssetDPI::class);
    }

    /**
     * Get Creators
     * 
     * @return BelongsToMany
     */
    public function creators(): BelongsToMany
    {
        return $this->belongsToMany(Creator::class, 'intangible_asset_creators');
    }

    /**
     * @return BelongsToMany
     */
    public function user_messages(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'intangible_asset_comments')->withPivot('message', 'updated_at')->orderByPivot('updated_at');
    }

    /**
     * @return BelongsToMany
     */
    public function secret_protection_measures(): BelongsToMany
    {
        return $this->belongsToMany(SecretProtectionMeasure::class);
    }

    /**
     * @return HasMany
     */
    public function priority_tools(): HasMany
    {
        return $this->hasMany(IntangibleAssetDpiPriorityTool::class);
    }

    /**
     * @return HasMany
     */
    public function strategies(): HasMany
    {
        return $this->hasMany(IntangibleAssetStrategy::class);
    }

    /**
     * @return HasOne
     */
    public function intangible_asset_phases(): HasOne
    {
        return $this->hasOne(IntangibleAssetPhase::class);
    }

    /**
     * Scope a query to only include Id
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param int $id
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeById($query, int $id)
    {
        return $query->where("{$this->getTable()}.id", $id);
    }

    /**
     * Scope a query to only include Name
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param string $name
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByName($query, string $name)
    {
        $query->where("{$this->getTable()}.name", 'like', "%{$name}%");
    }

    /**
     * Scope a query to only include Code
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param string $code
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByCode($query, string $code)
    {
        return $query->where("{$this->getTable()}.code", $code);
    }

    /**
     * Scope a query to only include Project
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param array|string $administrativeUnit
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */

    public function scopeByAdministrativeUnit($query, $administrativeUnit)
    {
        $table = $this->getTable();
        $joinResearchUnit = 'research_units';
        $joinProject = 'projects';

        $query->join($joinProject, "{$table}.project_id", "{$joinProject}.id");
        $query->join($joinResearchUnit, "{$joinProject}.research_unit_id", "{$joinResearchUnit}.id");

        if (is_array($administrativeUnit) && !empty($administrativeUnit)) {
            return $query->whereIn("{$joinResearchUnit}.administrative_unit_id", $administrativeUnit);
        }

        return $query->where("{$joinResearchUnit}.administrative_unit_id", $administrativeUnit);
    }

    /**
     * Scope a query to only include Project
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param array|string $researchUnit
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */

    public function scopeByResearchUnit($query, $researchUnit)
    {
        $table = $this->getTable();
        $joinProject = 'projects';

        $query->join($joinProject, "{$table}.project_id", "{$joinProject}.id");

        if (is_array($researchUnit) && !empty($researchUnit)) {
            return $query->whereIn("{$joinProject}.research_unit_id", $researchUnit);
        }

        return $query->where("{$joinProject}.research_unit_id", $researchUnit);
    }

    /**
     * Scope a query to only include Project
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param array|string $project
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */

    public function scopeByProject($query, $project)
    {
        if (is_array($project) && !empty($project)) {
            return $query->whereIn("{$this->getTable()}.project_id", $project);
        }

        return $query->where("{$this->getTable()}.project_id", $project);
    }

    /**
     * Scope a query to only include Date From
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param string $dateFrom
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSinceDate($query, string $dateFrom)
    {
        $query->where("{$this->getTable()}.updated_at", '>=', $dateFrom);
    }

    /**
     * Scope a query to only include Date To
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param string $dateTo
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeToDate($query, string $dateTo)
    {
        $query->where("{$this->getTable()}.updated_at", '<=', $dateTo);
    }

    /**
     * @return bool
     */
    public function hasDpis(): bool
    {
        return $this->dpis->count() > 0;
    }

    /**
     * @return bool
     */
    public function hasClassification(): bool
    {
        return !is_null($this->classification);
    }

    /**
     * @return bool
     */
    public function hasDescription(): bool
    {
        return !is_null($this->description);
    }

    /**
     * @return bool
     */
    public function hasState(): bool
    {
        return !is_null($this->intangible_asset_state);
    }

    /**
     * @return bool
     */
    public function hasCode() : bool    
    {
        return !is_null($this->code);
    }

    /**
     * @return bool
     */
    public function hasCreators(): bool
    {
        return $this->creators->count() > 0;
    }

    /**
     * @return bool
     */
    public function hasProject(): bool
    {
        return !is_null($this->project_id);
    }

    /**
     * @return bool
     */
    public function hasBeenPublished(): bool
    {
        return !is_null($this->intangible_asset_published);
    }

    /**
     * @return bool
     */
    public function hasConfidencialityContract(): bool
    {
        return !is_null($this->intangible_asset_confidenciality_contract);
    }

    /**
     * @return bool
     */
    public function hasSessionRightContract(): bool
    {
        return !is_null($this->intangible_asset_session_right_contract);
    }

    /**
     * @return bool
     */
    public function hasContability(): bool
    {
        return !is_null($this->intangible_asset_contability);
    }

    /**
     * @return bool
     */
    public function hasMessages(): bool
    {
        return !is_null($this->user_messages);
    }

    /**
     * @return bool
     */
    public function hasProtectionAction(): bool
    {
        return !is_null($this->intangible_asset_protection_action);
    }

    /**
     * @return bool
     */
    public function hasSecretProtectionMeasure(): bool
    {
        return $this->secret_protection_measures->count() > 0;
    }

    /**
     * @return bool
     */
    public function hasPriorityTools(): bool
    {
        return $this->priority_tools->count() > 0;
    }

    /**
     * @return bool
     */
    public function isCommercial(): bool
    {
        return !is_null($this->intangible_asset_commercial);
    }

    /**
     * @return bool
     */
    public function hasStrategies(): bool
    {
        return $this->intangible_asset_phases->has_strategies;
    }



    /** Intangible Asset Confidenciality Contract File Methods */

    /**
     * @return bool
     */
    public function hasFileOfConfidencialityContract(): bool
    {
        /** @var \App\Models\Client\IntangibleAsset\IntangibleAssetConfidentialityContract $confidencialityContract */
        $confidencialityContract = $this->intangible_asset_confidenciality_contract;
        return $this->hasConfidencialityContract() && !is_null($confidencialityContract->file_path && $confidencialityContract->file);
    }

    public function hasDummyFileOfConfidencialityContract(): bool
    {
        /** @var \App\Models\Client\IntangibleAsset\IntangibleAssetConfidentialityContract $confidencialityContract */
        $confidencialityContract = $this->intangible_asset_confidenciality_contract;
        return $this->hasConfidencialityContract() && $confidencialityContract->file == 'example.txt';
    }

    /** ./Intangible Asset Confidenciality Contract File Methods */


    /** Intangible Asset Session Right File Methods */

    /**
     * @return bool
     */
    public function hasFileOfSessionRightContract(): bool
    {
        /** @var \App\Models\Client\IntangibleAsset\IntangibleAssetSessionRightContract $sessionRightContract */
        $sessionRightContract = $this->intangible_asset_session_right_contract;
        return $this->hasSessionRightContract() && !is_null($sessionRightContract->file_path && $sessionRightContract->file);
    }

    public function hasDummyFileOfSessionRightContract(): bool
    {
        /** @var \App\Models\Client\IntangibleAsset\IntangibleAssetSessionRightContract $sessionRightContract */
        $sessionRightContract = $this->intangible_asset_session_right_contract;
        return $this->hasSessionRightContract() && $sessionRightContract->file == 'example.txt';
    }

    /** ./Intangible Asset Session Right File Methods */
}
