<?php

namespace App\Services;

use App\Repositories\PaymentRepository;
use App\Services\Interfaces\PaymentServiceInterface;
use App\StateMachine\Config\StateConfiguration;
use App\StateMachine\States\BaseState;

class PaymentService extends BaseService implements PaymentServiceInterface
{
    private $stateConfiguration;

    public function __construct(StateConfiguration $stateConfiguration)
    {
        $this->stateConfiguration = $stateConfiguration;
    }

    private array $availableSearchParams = [];

    public function getRepository()
    {
        return app(PaymentRepository::class);
    }

    public function getAllSearch()
    {
        return parent::getAll($this->availableSearchParams);
    }

    public function add(array $request)
    {
        $state = BaseState::CreateState('PROCESSING', $this);

        return $state->store($request);
    }

    public function update(array $request, int $id)
    {
        $payment = $this->getById($id);

        $state = $this->stateConfiguration->stateMap()[$payment->status];

        $state = BaseState::CreateState($payment->status, $this);

        return $state->update($request, $id);
    }
}
