<?php

namespace App\Services;

use App\Repositories\Services\ServicesRepositoryInterface;
use App\Repositories\ServicesTranslate\ServicesTranslateRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Exception;

class ServiceService
{
    /**
     * @var ServicesRepositoryInterface
     */
    protected $servicesRepository;

    /**
     * @var ServicesTranslateRepositoryInterface
     */
    protected $servicesTransRepository;

    /**
     * ServiceService constructor.
     * @param ServicesRepositoryInterface $servicesRepository
     * @param ServicesTranslateRepositoryInterface $servicesTransRepository
     */
    public function __construct(
        ServicesRepositoryInterface $servicesRepository,
        ServicesTranslateRepositoryInterface $servicesTransRepository
    )
    {
        $this->servicesRepository = $servicesRepository;
        $this->servicesTransRepository = $servicesTransRepository;
    }

    public function getAllService()
    {
        $data = $this->servicesRepository->getAllPaginate(config('constant.number.service.paginate.admin'));
        return $data;
    }

    public function createService($data)
    {
        try {
            DB::beginTransaction();

            if (isset($data['image'])) {
                $file = $data['image'];
                unset($data['image']);
            }

            $dataBaseService = formatDataBaseOnTable('services', $data);
            $result = $this->servicesRepository->create($dataBaseService);
            if ($result) {
                $newName = uploadImage($result->id, $file, 'service');
                $this->servicesRepository->update(
                    $result->id,
                    ['image' => config('upload.service') . $result->id . '/' . $newName
                    ]);
            }

            // Save translate data
            $dataTranslates = $data['trans'];
            foreach ($dataTranslates as $key => $value) {
                $dataServiceTrans = $value;
                $dataServiceTrans['locale'] = $key;
                $dataServiceTrans['services_id'] = $result->id;
                $this->servicesTransRepository->create($dataServiceTrans);
            }

            DB::commit();
            return true;
        } catch (Exception $e) {
            logger(__METHOD__ . ' - Error: '. $e->getMessage());
            DB::rollBack();
            return false;
        }
    }

    public function updateService($id, $data)
    {
        try {
            DB::beginTransaction();

            if (isset($data['image'])) {
                $newName = uploadImage($id, $data['image'], 'service');
                $data['image'] = config('upload.service') . $id . '/' . $newName;
            }

            $dataBaseService = formatDataBaseOnTable('services', $data);
            $this->servicesRepository->update($id, $dataBaseService);

            $dataTranslates = $data['trans'];
            foreach ($dataTranslates as $key => $value) {
                $this->servicesTransRepository->updateTrans('services_id', $id, $key, $value);
            }
            DB::commit();
            return true;
        } catch (Exception $e) {
            logger(__METHOD__ . ' - Error: '. $e->getMessage());
            DB::rollBack();
            return false;
        }
    }

    public function getServiceLimit($limit)
    {
        $data = $this->servicesRepository->getDataLimit($limit)->get();
        return $data;
    }

    public function countService()
    {
        $data = $this->servicesRepository->countAll();
        return $data;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteService($id)
    {
        $delete = $this->servicesRepository->delete($id);
        return $delete;
    }
    /**
     * Find by slug
     * @param $id
     * @return mixed
     */
    public function findServiceBySlugId($id)
    {
        $service = $this->servicesRepository->findBySlugRelatedId($id);
        return $service;
    }
}