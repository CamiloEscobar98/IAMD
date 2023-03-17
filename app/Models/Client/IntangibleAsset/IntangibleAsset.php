<?php

namespace App\Models\Client\IntangibleAsset;

use App\Models\Client\BaseModel;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Illuminate\Support\Str;


use App\Observers\IntangibleAssetObserver;

use App\Models\Admin\IntangibleAssetState;
use App\Models\Admin\IntellectualPropertyRight\IntellectualPropertyRightProduct;

use App\Models\Client\User;
use App\Models\Client\Creator\Creator;
use App\Models\Client\Project\Project;
use App\Models\Client\SecretProtectionMeasure;
use App\Models\Client\IntangibleAsset\IntangibleAssetDPI;

class IntangibleAsset extends BaseModel
{
    use HasFactory;

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        IntangibleAsset::observe(IntangibleAssetObserver::class);
    }

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
        'date'
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
     * Get the research units.
     * 
     * @return BelongsToMany
     */
    public function research_units(): BelongsToMany
    {
        return $this->belongsToMany(\App\Models\Client\ResearchUnit::class, 'intangible_asset_research_unit');
    }

    /**
     * @return BelongsTo
     */
    public function classification(): BelongsTo
    {
        return $this->belongsTo(IntellectualPropertyRightProduct::class, 'classification_id');
    }

    /**
     * Get Localization in UFPS.
     * 
     * @return HasOne
     */
    public function intangible_asset_localization(): HasOne
    {
        return $this->hasOne(IntangibleAssetLocalization::class);
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
     * @return HasOne
     */
    public function intangible_asset_academic_record() : HasOne
    {
        return $this->hasOne(IntangibleAssetAcademicRecord::class);
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
     * Scope a query to only include Classification
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param string $classification
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByClassification($query, string $classification)
    {
        return $query->where("{$this->getTable()}.classification_id", $classification);
    }

    /**
     * Scope a query to only include Project
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param array|string $project
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */

    public function scopeByProject($query, $projectId)
    {
        if (is_array($projectId) && !empty($projectId)) {
            return $query->whereIn("{$this->getTable()}.project_id", $projectId);
        }

        return $query->where("{$this->getTable()}.project_id", $projectId);
    }

    /**
     * Scope a query to only include Intangible Asset State
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param array|string $stateId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByState($query, $stateId)
    {
        if (is_array($stateId) && !empty($projectId)) {
            return $query->wherenIn("{$this->getTable()}.intangible_asset_state_id", $stateId);
        } else {
            return $query->where("{$this->getTable()}.intangible_asset_state_id", $stateId);
        }
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
        $query->where("{$this->getTable()}.date", '>=', $dateFrom);
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
        $query->where("{$this->getTable()}.date", '<=', $dateTo);
    }

    /**
     * Scope a query to only include Phases
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param array|string $phase
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByPhases($query, $phase)
    {
        if (is_array($phase) && !empty($phase)) {
            $phasesQuery = (array) getPhasesByNumber($phase, true);
            return $query->where($phasesQuery);
        }

        return $query->where("{$this->getTable()}.phase_id", $phase);
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
    public function hasCode(): bool
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

    public function hasAcademicRecord(): bool
    {
        return !is_null($this->intangible_asset_academic_record);
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



    /** Intangible Asset Confidenciality Contract File Methods */

    /**
     * @return bool
     */
    public function hasFileOfAcademicRecord(): bool
    {
        /** @var \App\Models\Client\IntangibleAsset\IntangibleAssetAcademicRecord $confidencialityContract */
        $confidencialityContract = $this->intangible_asset_academic_record;
        return $this->hasAcademicRecord() && !is_null($confidencialityContract->file_path && $confidencialityContract->file);
    }

    public function hasDummyFileOfAcademicRecord(): bool
    {
        /** @var \App\Models\Client\IntangibleAsset\IntangibleAssetAcademicRecord $confidencialityContract */
        $confidencialityContract = $this->intangible_asset_academic_record;
        return $this->hasAcademicRecord() && $confidencialityContract->file == 'example.txt';
    }

    /** ./Intangible Asset Confidenciality Contract File Methods */    /** ./Intangible Asset Session Right File Methods */


    /** Phases for Intangible Asset */

    /**
     * @return bool
     */
    public function hasPhaseOneCompleted(): bool
    {
        return $this->intangible_asset_phases->phase_one_completed;
    }

    /**
     * @return bool
     */
    public function hasPhaseTwoCompleted(): bool
    {
        return $this->intangible_asset_phases->phase_two_completed;
    }

    /**
     * @return bool
     */
    public function hasPhaseThreeCompleted(): bool
    {
        return $this->intangible_asset_phases->phase_three_completed;
    }

    /**
     * @return bool
     */
    public function hasPhaseFourCompleted(): bool
    {
        return $this->intangible_asset_phases->phase_four_completed;
    }

    /**
     * @return bool|null
     */
    public function hasPhaseFiveCompleted(): bool|null
    {
        return $this->intangible_asset_phases->phase_five_completed;
    }

    /**
     * @return bool
     */
    public function hasPhaseSixCompleted(): bool
    {
        return $this->intangible_asset_phases->phase_six_completed;
    }

    /** 
     * @return bool|null
     */
    public function hasPhaseSevenCompleted(): bool|null
    {
        return $this->intangible_asset_phases->phase_seven_completed;
    }

    /**
     * @return bool
     */
    public function hasPhaseEightCompleted(): bool
    {
        if ($this->dpis->isEmpty()) {
            return true;
        }
        return $this->intangible_asset_phases->phase_eight_completed;
    }

    /**
     * @return bool
     */
    public function hasPhaseNineCompleted(): bool
    {
        return $this->intangible_asset_phases->phase_nine_completed;
    }

    /**
     * @return bool
     */
    public function hasAllPhasesCompleted()
    {
        return $this->hasPhaseOneCompleted() &&
            $this->hasPhaseTwoCompleted() &&
            $this->hasPhaseThreeCompleted() &&
            $this->hasPhaseFourCompleted() &&
            $this->hasPhaseFiveCompleted() &&
            $this->hasPhaseSixCompleted() &&
            $this->hasPhaseSevenCompleted() &&
            $this->hasPhaseEightCompleted() &&
            $this->hasPhaseNineCompleted();
    }

    public function progressPhases()
    {
        $phases = [
            'hasPhaseOneCompleted', 'hasPhaseTwoCompleted', 'hasPhaseThreeCompleted', 'hasPhaseFourCompleted',
            'hasPhaseFiveCompleted', 'hasPhaseSixCompleted', 'hasPhaseSevenCompleted', 'hasPhaseEightCompleted', 'hasPhaseNineCompleted'
        ];

        $cont = 0;

        foreach ($phases as $value) {
            if ($this->$value()) {
                $cont++;
            }
        }

        if (($percent = $cont / count($phases) * 100) == 0) {
            return 1;
        } else {
            return $percent;
        }
    }
    /** ./Phases for Intangible Asset */
}
