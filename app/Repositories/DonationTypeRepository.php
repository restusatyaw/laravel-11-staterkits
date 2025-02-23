<?php

namespace App\Repositories;

use App\Models\DonationType;

class DonationTypeRepository
{
    public function getAll()
    {
        return DonationType::all();
    }

    public function findById($id)
    {
        return DonationType::find($id);
    }

    public function create(array $data)
    {
        return DonationType::create($data);
    }

    public function update($id, array $data)
    {
        $model = DonationType::find($id);
        if ($model) {
            $model->update($data);
            return $model;
        }
        return null;
    }

    public function delete($id)
    {
        return DonationType::destroy($id);
    }

    public function getFilteredData($filterData)
    {
        $query = DonationType::query();

        // Dynamic search based on searchable columns
        // if (isset($filterData['search']) && $filterData['search'] != '') {
            
        // }

        return $query;
    }
}