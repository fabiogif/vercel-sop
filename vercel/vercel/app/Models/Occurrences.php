<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Occurrences extends Model
{
    protected $fillable = ['title', 'name', 'description', 'cpf', 'rg', 'address', 'users_id', 'email', 'issuings_id', 'type_occurrences_id', 'phone', 'latitude', 'longitude', 'status_occurrences_id', 'clients_id', 'nameType', 'nameStatus'];
    use HasFactory;

    public function search($filter = null)
    {
        $result = $this->where('title', 'ILIKE', "%{$filter}%")
            ->orWhere('name', 'ILIKE', "%{$filter}%")
            ->orderBy('updated_at', 'desc')->orderBy('created_at', 'desc')
            ->paginate(10);

        return $result;
    }


    public function Occurrence($filter = null)
    {

        $occurrences = $this->select(
            'occurrences.*',
            'issuings.id as idIssuings',
            'issuings.name as nameIssuings',
            'type_occurrences.id as idType',
            'type_occurrences.name as nameType',
            'status_occurrences_id as status_occurrences_id',
            'status_occurrences.name as nameStatus'
        )->join('issuings', 'issuings.id', '=', 'occurrences.issuings_id')
            ->join('status_occurrences', 'status_occurrences.id', '=', 'occurrences.status_occurrences_id')
            ->join('type_occurrences', function ($join) {
                $join->on('occurrences.type_occurrences_id', '=', 'type_occurrences.id');

            })->where(function ($queryFilter) use ($filter) {
            if ($filter) {
                $queryFilter->where('occurrences.title', 'ILIKE', "%{$filter}%")->orWhere('occurrences.name', 'ILIKE', "%{$filter}%");
            }
        })->orderBy('occurrences.updated_at', 'desc')->orderBy('occurrences.created_at', 'desc')->paginate();

        return $occurrences;
    }

    public function OccurrenceByClientId($filter = null)
    {

        $occurrences = $this->select(
            'occurrences.*',
            'issuings.id as idIssuings',
            'issuings.name as nameIssuings',
            'type_occurrences.id as idType',
            'type_occurrences.name as nameType',
            'status_occurrences_id as status_occurrences_id',
            'status_occurrences.name as nameStatus'
        )->join('issuings', 'issuings.id', '=', 'occurrences.issuings_id')
            ->join('status_occurrences', 'status_occurrences.id', '=', 'occurrences.status_occurrences_id')
            ->join('type_occurrences', function ($join) {
                $join->on('occurrences.type_occurrences_id', '=', 'type_occurrences.id');

            })->where(function ($queryFilter) use ($filter) {
            if ($filter) {
                $queryFilter->where('occurrences.clients_id', '=', "{$filter}");
            }
        })->paginate();

        return $occurrences;
    }


    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
    public function statusOccurence()
    {
        return $this->belongsTo(StatusOccurrence::class);
    }

    public function imagens()
    {
        return $this->belongsTo(OccurrencesImagens::class);
    }
}