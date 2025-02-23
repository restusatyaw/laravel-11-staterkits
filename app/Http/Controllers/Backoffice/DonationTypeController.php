<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Services\DonationTypeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class DonationTypeController extends Controller
{
    protected $DonationTypeService;

    public function __construct(DonationTypeService $DonationTypeService)
    {
        $this->DonationTypeService = $DonationTypeService;
    }

    public function index()
    {
        try {
            return view('backoffice.pages.donationtype.index', [
                'page_title' => 'DonationType',
                'urlCreate' => route('backoffice.donationtype.create'),
                'permission_create' => 'donationtype.create',
            ]);
        } catch (Exception $e) {
            Log::error("Error loading index page for DonationType: " . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to load page.');
        }
    }

    public function create()
    {
        try {
            return view('backoffice.pages.donationtype.form', [
                'page_title' => 'Create DonationType',
                'data' => null,
                'isForm' => true,
                'urlBack' => route('backoffice.donationtype.index'),
            ]);
        } catch (Exception $e) {
            Log::error("Error loading create page for DonationType: " . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to load page.');
        }
    }

    public function show($id)
    {
        try {
            return view('backoffice.pages.donationtype.show', [
                'page_title' => 'Detail DonationType',
                'data' => $this->DonationTypeService->findById($id)
            ]);
        } catch (Exception $e) {
            Log::error("Error loading show page for DonationType with ID {$id}: " . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to load page.');
        }
    }

    public function edit($id)
    {
        try {
            return view('backoffice.pages.donationtype.form', [
                'page_title' => 'Edit DonationType',
                'data' => $this->DonationTypeService->findById($id),
                'isForm' => true,
                'urlBack' => route('backoffice.donationtype.index'),
            ]);
        } catch (Exception $e) {
            Log::error("Error loading edit page for DonationType with ID {$id}: " . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to load page.');
        }
    }

    public function store(Request $request)
    {
        try {
            $this->DonationTypeService->create($request->all());
            return redirect()->route('backoffice.donationtype.index')->with('success', 'DonationType created successfully.');
        } catch (Exception $e) {
            Log::error("Error storing DonationType: " . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to create data.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $this->DonationTypeService->update($id, $request->all());
            return redirect()->route('backoffice.donationtype.index')->with('success', 'DonationType updated successfully.');
        } catch (Exception $e) {
            Log::error("Error updating DonationType with ID {$id}: " . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update data.');
        }
    }

    public function destroy($id)
    {
        try {
            $this->DonationTypeService->delete($id);
            return response()->json([
                'status' => true,
                'message' => 'DonationType deleted successfully.'
            ], 200);
        } catch (Exception $e) {
            Log::error("Error deleting DonationType with ID {$id}: " . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Failed to delete data.'
            ], 500);
        }
    }

    public function getDatatable(Request $request)
    {
        try {
            return $this->DonationTypeService->getDatatable($request->all());
        } catch (Exception $e) {
            Log::error("Error getting datatable for DonationType: " . $e->getMessage());
            return response()->json(['error' => 'Failed to load data'], 500);
        }
    }
}