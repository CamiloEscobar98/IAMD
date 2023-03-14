<?php

namespace App\Services\Client;

use App\Services\AbstractServiceModel;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Repositories\Client\CreatorRepository;
use App\Repositories\Client\CreatorDocumentRepository;
use App\Repositories\Client\CreatorInternalRepository;

class CreatorInternalService extends AbstractServiceModel
{
    /** @var CreatorRepository */
    protected $creatorRepository;

    /** @var CreatorInternalRepository */
    protected $creatorInternalRepository;

    /** @var CreatorDocumentRepository */
    protected $creatorDocumentRepository;

    public function __construct(
        CreatorInternalRepository $creatorInternalRepository,
        CreatorRepository $creatorRepository,
        CreatorDocumentRepository $creatorDocumentRepository,
    ) {
        $this->repository = $this->creatorInternalRepository = $creatorInternalRepository;
        $this->creatorRepository = $creatorRepository;
        $this->creatorDocumentRepository = $creatorDocumentRepository;
    }

    /**
     * Store a new resource.
     * 
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function save(array $data)
    {
        $data = collect($data);
        $creatorData = $data->only(['name', 'email', 'phone']);

        /** @var \App\Models\Client\Creator\Creator $creator */
        $creator = $this->creatorRepository->create($creatorData->toArray());

        $creatorDocumentData = $data->only(['document', 'document_type_id', 'expedition_place_id']);
        $creatorDocumentData['creator_id'] = $creator->id;

        $this->creatorDocumentRepository->create($creatorDocumentData->toArray());

        $creatorInternalData = $data->only(['linkage_type_id', 'assignment_contract_id']);
        $creatorInternalData['creator_id'] = $creator->id;

        $this->creatorInternalRepository->create($creatorInternalData->toArray());
        return $creator;
    }

    /**
     * Update a resource.
     * 
     * @param array $data
     * @param mixed $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(array $data, mixed $id)
    {
        $data = collect($data);
        $creatorData = $data->only(['name', 'email', 'phone']);

        $creatorInternal = $this->creatorInternalRepository->getByIdWithRelations($id, [
            'creator', 'creator.document', 'creator.document.document_type', 'creator.document.expedition_place',
            'linkage_type', 'assignment_contract'
        ], 'creator_id');

        $creator = $creatorInternal->creator;

        $this->creatorRepository->update($creator, $creatorData->toArray());

        $creatorDocumentData = $data->only(['document', 'document_type_id', 'expedition_place_id']);
        $creatorDocumentData['creator_id'] = $creator->id;

        $creatorDocument = $creatorInternal->creator->document;

        $this->creatorDocumentRepository->update($creatorDocument, $creatorDocumentData->toArray());

        $creatorInternalData = $data->only(['linkage_type_id', 'assignment_contract_id']);
        $creatorInternalData['creator_id'] = $creator->id;

        $creatorInternal = $this->creatorInternalRepository->update($creatorInternal, $creatorInternalData->toArray());
        return $creator;
    }

    /**
     * @param array $params
     * 
     * @return array<string,string>
     */
    public function transformParams($params)
    {
        if (empty($params)) {
            // $params = set_sub_month_date_filter($params, 'date_from', 1);
        }

        # Clean empty keys
        $params = array_filter($params);

        return $params;
    }

    /**
     * @param $query
     * @param array $params
     * @param int $pageNumber
     * @param int $total
     * 
     * @return LengthAwarePaginator $items
     */
    public function customPagination($query, $params, $pageNumber, $total)
    {
        try {

            $perPage = $this->creatorInternalRepository->getPerPage();
            $pageName = 'page';
            $offset = ($pageNumber -  1) * $perPage;

            $page = Paginator::resolveCurrentPage($pageName);

            $query->skip($offset)
                ->take($perPage);

            if (isset($params['order_by'])) {
                if ($params['order_by'] == 1) {
                    $query->orderBy('name', 'ASC');
                } else {
                    $query->orderBy('name', 'DESC');
                }
            } else {
                $query->orderBy('name', 'ASC');
            }
            $items = $query->get();

            $items = new LengthAwarePaginator($items, $total, $perPage, $page, [
                'path' => Paginator::resolveCurrentPath(),
                'pageName' => $pageName
            ]);

            $items->appends($params);

            return $items;
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }
}
