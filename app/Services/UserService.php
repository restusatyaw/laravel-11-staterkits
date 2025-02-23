<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\DTOs\UserDTO;
use Illuminate\Support\Collection;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Exception;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAll(): Collection
    {
        try {
            $data = $this->userRepository->getAll();
            return $data->map(fn($item) => $this->toDTO($item));
        } catch (Exception $e) {
            Log::error("Error getting all user: " . $e->getMessage());
            return collect([]);
        }
    }

    public function findById($id)
    {
        try {
            $item = $this->userRepository->findById($id);
            return $item ? $this->toDTO($item) : null;
        } catch (Exception $e) {
            Log::error("Error finding user with ID {$id}: " . $e->getMessage());
            return null;
        }
    }

    public function create(array $data)
    {
        DB::beginTransaction();
        try {
            $item = $this->userRepository->create($data);
            DB::commit();
            return $this->toDTO($item);
        } catch (Exception $e) {
            DB::rollback();
            Log::error("Error creating user: " . $e->getMessage());
            return null;
        }
    }

    public function update($id, array $data)
    {
        DB::beginTransaction();
        try {
            $item = $this->userRepository->update($id, $data);
            DB::commit();
            return $item ? $this->toDTO($item) : null;
        } catch (Exception $e) {
            DB::rollback();
            Log::error("Error updating user with ID {$id}: " . $e->getMessage());
            return null;
        }
    }

    public function delete($id): bool
    {
        DB::beginTransaction();
        try {
            $deleted = $this->userRepository->delete($id);
            DB::commit();
            return $deleted;
        } catch (Exception $e) {
            DB::rollback();
            Log::error("Error deleting user with ID {$id}: " . $e->getMessage());
            return false;
        }
    }

    public function getFilteredData(array $filterData)
    {
        try {
            $query = $this->userRepository->getFilteredData($filterData);

            return $query;
        } catch (Exception $e) {
            Log::error("Error getting datatable for user: " . $e->getMessage());
            return response()->json(['error' => 'Failed to load data'], 500);
        }
    }

    public function getDatatable(array $filterData)
    {
        try {
            $query = $this->userRepository->getFilteredData($filterData);

            return DataTables::of($query)
                ->addColumn('action', function ($row) {
                    return view('backoffice.components.actionDatatable', [
                        'id' => $row->id,
                        'url_edit' => route('backoffice.user.edit', $row->id),
                        'url_delete' => route('backoffice.user.destroy', $row->id),
                    ])->render();
                })
                ->rawColumns(['action'])
                ->make(true);
        } catch (Exception $e) {
            Log::error("Error getting datatable for user: " . $e->getMessage());
            return response()->json(['error' => 'Failed to load data'], 500);
        }
    }

    private function toDTO($model): UserDTO
    {
        return new UserDTO($model->toArray());
    }
}