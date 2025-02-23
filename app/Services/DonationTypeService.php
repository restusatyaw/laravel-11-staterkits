<?php

namespace App\Services;

use App\Repositories\DonationTypeRepository;
use App\DTOs\DonationTypeDTO;
use Illuminate\Support\Collection;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Exception;

class DonationTypeService
{
    protected $donationtypeRepository;

    public function __construct(DonationTypeRepository $donationtypeRepository)
    {
        $this->donationtypeRepository = $donationtypeRepository;
    }

    public function getAll(): Collection
    {
        try {
            $data = $this->donationtypeRepository->getAll();
            return $data->map(fn($item) => $this->toDTO($item));
        } catch (Exception $e) {
            Log::error("Error getting all donationtype: " . $e->getMessage());
            return collect([]);
        }
    }

    public function findById($id)
    {
        try {
            $item = $this->donationtypeRepository->findById($id);
            return $item ? $this->toDTO($item) : null;
        } catch (Exception $e) {
            Log::error("Error finding donationtype with ID {$id}: " . $e->getMessage());
            return null;
        }
    }

    public function create(array $data)
    {
        DB::beginTransaction();
        try {
            $item = $this->donationtypeRepository->create($data);
            DB::commit();
            return $this->toDTO($item);
        } catch (Exception $e) {
            DB::rollback();
            Log::error("Error creating donationtype: " . $e->getMessage());
            return null;
        }
    }

    public function update($id, array $data)
    {
        DB::beginTransaction();
        try {
            $item = $this->donationtypeRepository->update($id, $data);
            DB::commit();
            return $item ? $this->toDTO($item) : null;
        } catch (Exception $e) {
            DB::rollback();
            Log::error("Error updating donationtype with ID {$id}: " . $e->getMessage());
            return null;
        }
    }

    public function delete($id): bool
    {
        DB::beginTransaction();
        try {
            $deleted = $this->donationtypeRepository->delete($id);
            DB::commit();
            return $deleted;
        } catch (Exception $e) {
            DB::rollback();
            Log::error("Error deleting donationtype with ID {$id}: " . $e->getMessage());
            return false;
        }
    }

    public function getDatatable(array $filterData)
    {
        try {
            $query = $this->donationtypeRepository->getFilteredData($filterData);

            return DataTables::of($query)
                ->addColumn('action', function ($row) {
                    return view('backoffice.components.actionDatatable', [
                        'id' => $row->id,
                        'url_edit' => route('backoffice.donationtype.edit', $row->id),
                        'url_delete' => route('backoffice.donationtype.destroy', $row->id),
                    ])->render();
                })
                ->editColumn('name', function ($row) {
                    return view('backoffice.components.customField', [
                        'photo' => $row->name,
                        'name' => $row->name,
                    ])->render();
                })
                ->editColumn('is_active', function ($row) {
                    return view('backoffice.components.customField', [
                        'status' => $row->is_active
                    ])->render();
                })
                ->rawColumns(['action', 'is_active','name'])
                ->make(true);
        } catch (Exception $e) {
            Log::error("Error getting datatable for donationtype: " . $e->getMessage());
            return response()->json(['error' => 'Failed to load data'], 500);
        }
    }

    private function toDTO($model): DonationTypeDTO
    {
        return new DonationTypeDTO($model->toArray());
    }
}