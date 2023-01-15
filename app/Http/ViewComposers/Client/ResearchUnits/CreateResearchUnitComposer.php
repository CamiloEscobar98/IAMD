<?php

namespace App\Http\ViewComposers\Client\ResearchUnits;

use App\Repositories\Client\AcademicDepartmentRepository;
use Illuminate\View\View;

use App\Repositories\Client\AdministrativeUnitRepository;
use App\Repositories\Client\ResearchUnitCategoryRepository;
use App\Repositories\Client\CreatorRepository;

class CreateResearchUnitComposer
{
    /** @var ResearchUnitCategoryRepository */
    protected $researchUnitCategoryRepository;

    /** @var AdministrativeUnitRepository */
    protected $administrativeUnitRepository;

    /** @var AcademicDepartmentRepository */
    protected $academicDepartmentRepository;

    /** @var CreatorRepository */
    protected $creatorRepository;

    public function __construct(
        ResearchUnitCategoryRepository $researchUnitCategoryRepository,
        AdministrativeUnitRepository $administrativeUnitRepository,
        AcademicDepartmentRepository $academicDepartmentRepository,
        CreatorRepository $creatorRepository
    ) {
        $this->researchUnitCategoryRepository = $researchUnitCategoryRepository;
        $this->administrativeUnitRepository = $administrativeUnitRepository;
        $this->academicDepartmentRepository = $academicDepartmentRepository;
        $this->creatorRepository = $creatorRepository;
    }

    public function compose(View $view)
    {
        $creators = $this->creatorRepository->all(['id', 'name']);

        $researchUnitCategories = $this->researchUnitCategoryRepository->all(['id', 'name'])->pluck('name', 'id')->prepend('---Selecciona una Categoría para la Unidad Investigativa');
        $administrativeUnits = $this->administrativeUnitRepository->all(['id', 'name'])->pluck('name', 'id')->prepend('---Selecciona una facultad', -1);
        $academicDepartments = $this->academicDepartmentRepository->all(['id', 'name'])->pluck('name', 'id')->prepend('---Selecciona un Departamento Académico', -1);
        $directors = $creators->pluck('name', 'id')->prepend('---Selecciona un Director', -1);
        $inventoryManagers = $creators->pluck('name', 'id')->prepend('---Selecciona un Director de Inventario', -1);

        $view->with(compact('researchUnitCategories', 'administrativeUnits', 'academicDepartments',  'directors', 'inventoryManagers'));
    }
}
