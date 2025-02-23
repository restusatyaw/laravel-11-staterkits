<?php

namespace App\Repositories;

use App\Models\Transaction;

class TransactionRepository
{
    public function getAll()
    {
        return Transaction::all();
    }

    public function findById($id)
    {
        return Transaction::find($id);
    }

    public function create(array $data)
    {
        return Transaction::create($data);
    }

    public function update($id, array $data)
    {
        $model = Transaction::find($id);
        if ($model) {
            $model->update($data);
            return $model;
        }
        return null;
    }

    public function delete($id)
    {
        return Transaction::destroy($id);
    }

    public function getFilteredData($filterData)
    {
        $query = Transaction::query();

        // Dynamic search based on searchable columns
        if (isset($filterData['start_date']) && $filterData['start_date'] != '') {
            $query->whereDate('created_at', $filterData['start_date']);
        }
        if (isset($filterData['end_date']) && $filterData['end_date'] != '') {
            $query->whereDate('created_at', $filterData['end_date']);
        }

        return $query;
    }
}