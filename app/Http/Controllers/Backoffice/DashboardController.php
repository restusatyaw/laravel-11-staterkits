<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Services\DonationTypeService;
use App\Services\TransactionService;
use App\Services\UserService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    protected $userService, $transactionServices, $donationTypesServices;

    function __construct(UserService $userService, TransactionService $transactionService, DonationTypeService $donationTypeService)
    {
        $this->transactionServices = $transactionService;
        $this->userService = $userService;
        $this->donationTypesServices = $donationTypeService;
    }

    function index() {

        $donationType = $this->donationTypesServices->getAll();

        $donationData = [];

        $transactionData = $this->transactionServices->getAll();

        foreach ($donationType as $key => $value) {
            $donationData [] = [
                'name' => $value->name,
                'photo' => $value->photo,
                'payment_pending' => $transactionData->where('donation_type_id', $value->id)->where('status','pending')->sum('total_payment'),
                'payment_proccessing' => $transactionData->where('donation_type_id', $value->id)->where('status','proccessing')->sum('total_payment'),
                'payment_completed' => $transactionData->where('donation_type_id', $value->id)->where('status','completed')->sum('total_payment'),
                'total' => $transactionData->where('donation_type_id', $value->id)->whereNotIn('status', ['expired', 'canceled'])->sum('total_payment')
            ];
        }


        usort($donationData, function ($a, $b) {
            return $b['total'] <=> $a['total']; // Descending order
        });

        $role = Role::where('name','Customer')->first()->id;
        return view('backoffice.pages.dashboard.index', [
            'nomination_donation' => $donationData,
            'page_title' => 'Dashbord',
            'datas' => $this->transactionServices->getAll(),
            'total_customer' => $this->userService->getAll()->where('role_id', $role)->count()
        ]);
    }
}
