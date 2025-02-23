<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class TransactionController extends Controller
{
    protected $TransactionService;

    public function __construct(TransactionService $TransactionService)
    {
        $this->TransactionService = $TransactionService;
    }

    public function index()
    {
        try {
            return view('backoffice.pages.transaction.index', [
                'page_title' => 'Transaction',
            ]);
        } catch (Exception $e) {
            Log::error("Error loading index page for Transaction: " . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to load page.');
        }
    }

    public function create()
    {
        
    }

    public function show($id)
    {
        try {
            return view('backoffice.pages.transaction.show', [
                'page_title' => 'Detail Transaction',
                'data' => $this->TransactionService->findById($id)
            ]);
        } catch (Exception $e) {
            Log::error("Error loading show page for Transaction with ID {$id}: " . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to load page.');
        }
    }

    public function edit($id)
    {
        
    }

    public function store(Request $request)
    {
       
    }

    public function update(Request $request, $id)
    {
        try {
            $this->TransactionService->update($id, $request->all());
            return redirect()->route('transaction.index')->with('success', 'Transaction updated successfully.');
        } catch (Exception $e) {
            Log::error("Error updating Transaction with ID {$id}: " . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update data.');
        }
    }

    public function destroy($id)
    {
        
    }

    public function getDatatable(Request $request)
    {
        try {
            return $this->TransactionService->getDatatable($request->all());
        } catch (Exception $e) {
            Log::error("Error getting datatable for Transaction: " . $e->getMessage());
            return response()->json(['error' => 'Failed to load data'], 500);
        }
    }
}