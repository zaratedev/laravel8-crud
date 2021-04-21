<?php

namespace Tests\Unit\Models;

use App\Models\Company;
use App\Models\Employee;
use App\Models\Traits\Presentable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Tests\TestCase;

class EmployeeTest extends TestCase
{
    /** @test */
    public function it_uses_the_presentable_trait()
    {
        $employee = new Employee;

        $this->assertContains(Presentable::class, class_uses($employee));
    }

    /** @test */
    public function it_belongs_to_a_company()
    {
        $relation = (new Employee)->company();

        $this->assertInstanceOf(BelongsTo::class, $relation);
        $this->assertInstanceOf(Company::class, $relation->getRelated());
    }
}
