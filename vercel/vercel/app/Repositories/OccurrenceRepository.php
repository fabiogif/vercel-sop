<?php

namespace App\Repositories;

use App\Models\Occurrences;
use App\Repositories\Contracts\OccurrenceRepositoryInterface;

class OccurrenceRepository implements OccurrenceRepositoryInterface
{
    protected $entity;

    public function __construct(Occurrences $occurrence)
    {
        $this->entity = $occurrence;
    }
    public function getAllOccurrences(int $pre_page)
    {
        //return $this->entity->paginate($pre_page);
        return $this->entity->Occurrence();
    }

    public function getOccurrenceById(string $id)
    {
        return $this->entity->where('id', $id)->first();
    }

    public function getOccurrenceByClientId(int $clientId)
    {
        return $this->entity->OccurrenceByClientId($clientId);

    }

    public function create(string $name, string $description, string $cpf, string $cnpj, string $rg, string $address, string $email, int $users_id, int $issuings_id, int $type_occurrences_id, string $latitude, string $longitude, string $status_occurrences_id, string $comment, string $subscription, $clients_id)
    {
    //    return $this->entity->create($data);

    }
    public function createNewOccurrence(array $data)
    {
        //dd($data);
        return $this->entity->create($data);

    }

}
