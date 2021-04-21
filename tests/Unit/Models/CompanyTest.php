<?php

namespace Tests\Unit\Models;

use App\Models\Company;
use App\Models\Employee;
use App\Models\Traits\Presentable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    /** @test */
    public function it_uses_the_presentable_trait()
    {
        $company = new Company;

        $this->assertContains(Presentable::class, class_uses($company));
    }

    /** @test */
    public function it_has_many_employees()
    {
        $relation = (new Company)->employees();

        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertInstanceOf(Employee::class, $relation->getRelated());
    }
}