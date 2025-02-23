<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function getAll()
    {
        return User::all();
    }

    public function findById($id)
    {
        return User::find($id);
    }

    public function create(array $data)
    {
        return User::create($data);
    }

    public function update($id, array $data)
    {
        $model = User::find($id);
        if ($model) {
            $model->update($data);
            return $model;
        }
        return null;
    }

    public function delete($id)
    {
        return User::destroy($id);
    }

    public function getFilteredData($filterData)
    {
        $query = User::query();

        // Dynamic search based on searchable columns
        if (isset($filterData['role_id']) && $filterData['role_id'] != '') {
            $query->where('role_id', $filterData['role_id']);
        }
        if (isset($filterData['email']) && $filterData['email'] != '') {
            $query->where('email', $filterData['email']);
        }

        return $query;
    }
}