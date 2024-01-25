<?php

namespace App\Services;

use App\Http\Requests\SearchObjects\PaymentSearchObject;
use App\Models\Payment;
use App\Repositories\PaymentRepository;
use App\Services\Interfaces\PaymentServiceInterface;
use App\StateMachine\States\BaseState;

class PaymentService extends BaseService implements PaymentServiceInterface
{

    public function __construct()
    { }

    public function getRepository()
    {
        return app(PaymentRepository::class);
    }

    public function add(array $request)
    {
        $state = BaseState::CreateState('PROCESSING');

        return $state->store($request);
    }

    public function update(array $request, int $id)
    {
        $payment = $this->getById($id);

        $state = BaseState::CreateState($payment->status);

        return $state->update($request, $id);
    }

    protected function getModelClass()
    {
        return Payment::class;
    }

    public function includeRelation($searchObject, $query){

        if ($searchObject->includeReservation) {
            $query = $query->with('reservation');
        }

        return $query;
    }

    public function getSearchObject()
    {
        return PaymentSearchObject::class;
    }
}
