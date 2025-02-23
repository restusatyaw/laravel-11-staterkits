<?php

namespace App\Services;

use App\Repositories\TransactionRepository;
use App\DTOs\TransactionDTO;
use Illuminate\Support\Collection;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Exception;

class TransactionService
{
    protected $transactionRepository;

    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    public function getAll(): Collection
    {
        try {
            $data = $this->transactionRepository->getAll();
            return $data->map(fn($item) => $this->toDTO($item));
        } catch (Exception $e) {
            Log::error("Error getting all transaction: " . $e->getMessage());
            return collect([]);
        }
    }

    public function findById($id)
    {
        try {
            $item = $this->transactionRepository->findById($id);
            return $item ? $this->toDTO($item) : null;
        } catch (Exception $e) {
            Log::error("Error finding transaction with ID {$id}: " . $e->getMessage());
            return null;
        }
    }

    public function create(array $data)
    {
        DB::beginTransaction();
        try {
            $item = $this->transactionRepository->create($data);
            DB::commit();
            return $this->toDTO($item);
        } catch (Exception $e) {
            DB::rollback();
            Log::error("Error creating transaction: " . $e->getMessage());
            return null;
        }
    }

    public function update($id, array $data)
    {
        DB::beginTransaction();
        try {
            $item = $this->transactionRepository->update($id, $data);
            DB::commit();
            return $item ? $this->toDTO($item) : null;
        } catch (Exception $e) {
            DB::rollback();
            Log::error("Error updating transaction with ID {$id}: " . $e->getMessage());
            return null;
        }
    }

    public function delete($id): bool
    {
        DB::beginTransaction();
        try {
            $deleted = $this->transactionRepository->delete($id);
            DB::commit();
            return $deleted;
        } catch (Exception $e) {
            DB::rollback();
            Log::error("Error deleting transaction with ID {$id}: " . $e->getMessage());
            return false;
        }
    }

    public function getDatatable(array $filterData)
    {
        try {
            $query = $this->transactionRepository->getFilteredData($filterData);

            return DataTables::of($query)
                ->addColumn('action', function ($row) {
                    return view('backoffice.components.actionDatatable', [
                        'id' => $row->id,
                        'url_detail' => route('backoffice.transaction.detail', $row->id),
                    ])->render();
                })
                ->rawColumns(['action'])
                ->make(true);
        } catch (Exception $e) {
            Log::error("Error getting datatable for transaction: " . $e->getMessage());
            return response()->json(['error' => 'Failed to load data'], 500);
        }
    }

    private function toDTO($model): TransactionDTO
    {
        return new TransactionDTO($model->toArray());
    }
}