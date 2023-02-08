<?php

namespace App\Http\Controllers\Api;

use App\Data\PaymentData;
use App\Data\PaymentStoreData;
use App\Data\PaymentStatusFormData;
use App\Data\PaymentUpdateData;
use App\Data\UserData;
use App\Enum\Currency;
use App\Enum\PaymentStatus;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;

class PaymentController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param Payment $payments
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request, Payment $payments): \Illuminate\Http\JsonResponse
    {
        $payments = $payments
            ->with(['user'])
            ->when(!empty($request->query('search')), fn($q) => $q->whereHas('user', fn($q) => $q->where('name', 'like', $request->query('search') . '%')))
            ->when(!empty($request->query('sort')), function ($q) use ($request) {
                $sortAttribute = $request->query('sort');
                $sortDirection = 'ASC';
                if (strncmp($sortAttribute, '-', 1) === 0) {
                    $sortDirection = 'DESC';
                    $sortAttribute = substr($sortAttribute, 1);
                }

                $q->orderBy($sortAttribute, $sortDirection);
            }, fn($q) => $q->orderBy('id', 'DESC'))
            ->paginate();


        return $this->sendResponse([
            'payments' => PaymentData::collection($payments),
            'statuses' => PaymentStatus::toArray(),
            'currency' => Currency::toArray(),
        ], 'User payments');
    }

    /**
     * Get data to create a payment.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(): \Illuminate\Http\JsonResponse
    {
        return $this->sendResponse([
            'users' => UserData::collection(User::all()),
            'statuses' => PaymentStatus::toArray(),
            'currency' => Currency::toArray()
        ], 'Payment create');
    }

    /**
     * Create the specified resource in storage.
     *
     * @param PaymentStoreData $data
     * @param Payment $payment
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PaymentStoreData $data, Payment $payment): \Illuminate\Http\JsonResponse
    {
        return $this->sendResponse(['payment' => PaymentData::from($payment->create($data->toArray()))], 'Payment create');
    }

    /**
     * Display the specified resource.
     *
     * @param Payment $payment
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Payment $payment): \Illuminate\Http\JsonResponse
    {
        return $this->sendResponse([
            'payment' => PaymentData::from($payment->load(['user'])),
            'statuses' => PaymentStatus::toArray(),
            'currency' => Currency::toArray(),
        ], 'Payment list');
    }

    /**
     * Get data to edit a payment.
     *
     * @param PaymentData $payment
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Payment $payment): \Illuminate\Http\JsonResponse
    {
        return $this->sendResponse([
            'payment' => PaymentData::from($payment),
            'users' => UserData::collection(User::all()),
            'statuses' => PaymentStatus::toArray(),
            'currency' => Currency::toArray()
        ], 'Payment edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PaymentUpdateData $data
     * @param Payment $payment
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(PaymentUpdateData $data, Payment $payment): \Illuminate\Http\JsonResponse
    {
        $payment->update($data->toArray());
        return $this->sendResponse(['payment' => PaymentData::from($payment)], 'Payment update');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PaymentStatusFormData $data
     * @param Payment $payment
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateStatus(PaymentStatusFormData $data, Payment $payment): \Illuminate\Http\JsonResponse
    {
        $payment->update($data->toArray());
        return $this->sendResponse(['payment' => PaymentData::from($payment)], 'Payment status update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Payment $payment
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Payment $payment): \Illuminate\Http\JsonResponse
    {
        $payment->delete();
        return $this->sendResponse([], 'Payment delete');
    }

}
