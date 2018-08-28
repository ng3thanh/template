<?php

namespace App\Services;

use App\Repositories\Clients\ClientsRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Exception;

class ClientService
{
    /**
     * @var ClientsRepositoryInterface
     */
    protected $clientsRepository;

    /**
     * ClientService constructor.
     * @param ClientsRepositoryInterface $clientsRepository
     */
    public function __construct(
        ClientsRepositoryInterface $clientsRepository
    ) {
        $this->clientsRepository = $clientsRepository;
    }

    public function getAllClient($limit)
    {
        $data = $this->clientsRepository->getAllPaginate($limit);
        return $data;
    }

    public function createClient($data)
    {
        try {
            DB::beginTransaction();

            $this->deleteAllClient();

            if (isset($data['image'])) {
                $file = $data['image'];
                unset($data['image']);
            }

            $data = formatDataBaseOnTable('clients', $data);
            $result = $this->clientsRepository->create($data);
            if ($result) {
                $newName = uploadImage($result->id, $file, 'client');
                $this->clientsRepository->update(
                    $result->id,
                    ['image' => config('upload.client') . $result->id . '/' . $newName
                    ]);
            }
            DB::commit();
            return true;
        } catch (Exception $e) {
            logger(__METHOD__ . ' - Error: '. $e->getMessage());
            DB::rollBack();
            return false;
        }
    }

//    public function updateClient($id, $data)
//    {
//        try {
//            DB::beginTransaction();
//
//            if (isset($data['image'])) {
//                $newName = uploadImage($id, $data['image'], 'client');
//                $data['image'] = config('upload.client') . $id . '/' . $newName;
//            }
//
//            $data = formatDataBaseOnTable('clients', $data);
//            $this->clientsRepository->update($id, $data);
//            DB::commit();
//            return true;
//        } catch (Exception $e) {
//            DB::rollBack();
//            return false;
//        }
//    }

    public function getClientLimit($limit)
    {
        $data = $this->clientsRepository->getDataLimit($limit)->get();
        return $data;
    }

//    public function countClient()
//    {
//        $data = $this->clientsRepository->countAll();
//        return $data;
//    }
//
//    /**
//     * @param $id
//     * @return mixed
//     */
//    public function deleteClient($id)
//    {
//        $delete = $this->clientsRepository->delete($id);
//        return $delete;
//    }

    public function deleteAllClient()
    {
        $clients = $this->clientsRepository->getAll();
        foreach ($clients as $client) {
            $this->clientsRepository->delete($client->id);
        }
    }
}