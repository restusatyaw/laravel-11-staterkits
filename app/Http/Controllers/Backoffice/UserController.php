<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class UserController extends Controller
{
    protected $UserService;

    public function __construct(UserService $UserService)
    {
        $this->UserService = $UserService;
    }

    public function index()
    {
        try {
            return view('backoffice.pages.user.index', [
                'page_title' => 'User',
                'urlCreate' => route('backoffice.user.create'),
                'permission_create' => 'user.create',
            ]);
        } catch (Exception $e) {
            Log::error("Error loading index page for User: " . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to load page.');
        }
    }

    public function create()
    {
        try {
            return view('backoffice.pages.user.form', [
                'page_title' => 'Create User',
                'data' => null,
                'isForm' => true,
                'urlBack' => route('backoffice.user.index'),
            ]);
        } catch (Exception $e) {
            Log::error("Error loading create page for User: " . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to load page.');
        }
    }

    public function show($id)
    {
        try {
            return view('backoffice.pages.user.show', [
                'page_title' => 'Detail User',
                'data' => $this->UserService->findById($id)
            ]);
        } catch (Exception $e) {
            Log::error("Error loading show page for User with ID {$id}: " . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to load page.');
        }
    }

    public function edit($id)
    {
        try {
            return view('backoffice.pages.user.form', [
                'page_title' => 'Edit User',
                'data' => $this->UserService->findById($id),
                'isForm' => true,
                'urlBack' => route('backoffice.user.index'),
            ]);
        } catch (Exception $e) {
            Log::error("Error loading edit page for User with ID {$id}: " . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to load page.');
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->only([
                'name',
                'email',
                'password'
            ]);
            $data['role_id'] = Role::where('name', 'Petugas')->first()->id;

            if($request->password != $request->confirm_password){
                return redirect()->back()->with('error', 'password & confirm password tidak sama!');
            }
            $this->UserService->create($data);
            return redirect()->route('backoffice.user.index')->with('success', 'User created successfully.');
        } catch (Exception $e) {
            Log::error("Error storing User: " . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to create data.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $data = $request->only([
                'name',
                'email',
                'password'
            ]);
            if($request->password != '' && $request->password != $request->confirm_password){
                return redirect()->back()->with('error', 'password & confirm password tidak sama!');
            }
            $this->UserService->update($id, $data);
            return redirect()->route('backoffice.user.index')->with('success', 'User updated successfully.');
        } catch (Exception $e) {
            Log::error("Error updating User with ID {$id}: " . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update data.');
        }
    }

    public function destroy($id)
    {
        try {
            $this->UserService->delete($id);
            return response()->json([
                'status' => true,
                'message' => 'User deleted successfully.'
            ], 200);
        } catch (Exception $e) {
            Log::error("Error deleting User with ID {$id}: " . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Failed to delete data.'
            ], 500);
        }
    }

    public function getDatatable(Request $request)
    {
        try {
            $data['role_id'] = Role::where('name', 'Petugas')->first()->id;
            return $this->UserService->getDatatable($data);
        } catch (Exception $e) {
            Log::error("Error getting datatable for User: " . $e->getMessage());
            return response()->json(['error' => 'Failed to load data'], 500);
        }
    }
}