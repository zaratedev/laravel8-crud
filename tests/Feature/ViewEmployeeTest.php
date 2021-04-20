<?php

namespace Tests\Feature;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewEmployeeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_shows_the_employees_list()
    {
        $user = User::factory()->create();
        Employee::factory()->count(10)->create();

        $this->actingAs($user)
            ->get(route('employees.index'))
            ->assertViewIs('employees.index')
            ->assertViewHas('employees', fn ($retrieve) => $retrieve->count() === 10);
    }

    /** @test */
    public function it_shows_the_pagination_links()
    {
        $user = User::factory()->create();
        Employee::factory()->count(20)->create();

        $employees = Employee::query()
            ->latest()
            ->simplePaginate(10);

        $employees->setPath(config('app.url').'/employees');

        $this->actingAs($user)
            ->get(route('employees.index'))
            ->assertViewIs('employees.index')
            ->assertSee($employees->links());
    }

    /** @test */
    public function it_displays_the_employee_details()
    {
        $user = User::factory()->create();
        $employee = Employee::factory()->create();

        $this->actingAs($user)
            ->get(route('employees.show', $employee))
            ->assertViewHas('employee', fn ($retrieve) => $retrieve->is($employee))
            ->assertSee($employee->present()->name)
            ->assertSee($employee->email)
            ->assertSee($employee->phone)
            ->assertSee($employee->company->present()->name);
    }

    /** @test */
    public function it_displays_a_404_error_if_the_employee_is_not_found()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('employees.show', 1))
            ->assertNotFound();
    }

}
