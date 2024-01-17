<?php

namespace App\Services;

use App\Repositories\PaymentRepository;
use App\Services\Interfaces\PaymentServiceInterface;

class PaymentService extends BaseService implements PaymentServiceInterface
{
    private array $availableSearchParams = [];

    public function getRepository()
    {
        return app(PaymentRepository::class);
    }

    public function getAllSearch()
    {
        return parent::getAll($this->availableSearchParams);
    }
}
