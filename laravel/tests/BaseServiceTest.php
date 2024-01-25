<?php

namespace Tests;

use App\Http\Requests\SearchObjects\RentalCarSearchObject;
use App\Models\RentalCar;
use Illuminate\Database\Eloquent\Collection;
use Mockery;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Services\RentalCarService;

class BaseServiceTest extends TestCase
{
    public function testGetAll()
    {
        $mockSearchObject = Mockery::mock(RentalCarSearchObject::class);
        $mockModelClass = Mockery::mock('App\Models\RentalCar');
        $mockRequest = Mockery::mock(Request::class);

        $mockRequest->shouldReceive('query')->andReturn([]);

        app()->instance(RentalCarSearchObject::class, $mockSearchObject);
        app()->instance(RentalCar::class, $mockModelClass);

        $mockSearchObject->shouldReceive('fill')->with([]);
        $mockSearchObject->page = 1;
        $mockSearchObject->size = 10;

        $mockModelQuery = Mockery::mock(Builder::class);
        $mockModelQuery->shouldReceive('skip')->once()->with(0)->andReturnSelf();
        $mockModelQuery->shouldReceive('take')->once()->with(10)->andReturnSelf();
        $mockModelQuery->shouldReceive('get')->once()->andReturn(collect([]));

        $mockModelClass->shouldReceive('query')->andReturn($mockModelQuery);

        $service = new RentalCarService();
        $result = $service->getAll();

        $this->assertInstanceOf(Collection::class, $result);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
