<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateEmployeeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_loads_the_edit_employee_page()
    {
        $user = User::factory()->create();
        $employee = Employee::factory()->create();
        $company = Company::factory()->create();

        $this->actingAs($user)
            ->get(route('employees.edit', $employee))
            ->assertSuccessful()
            ->assertViewHas('employee', fn ($retrieve) => $retrieve->is($employee))
            ->assertViewHas('companies', fn ($retrieve) => $retrieve->contains($company));
    }

    /** @test */
    public function it_updates_a_employee()
    {
        $user = User::factory()->create();
        $employee = Employee::factory()->create();
        $newCompany = Company::factory()->create();

        $this->actingAs($user)
            ->put(route('employees.update', $employee), $data = [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'company_id' => $newCompany->id,
                'email' => 'john@example.test',
                'phone' => '5555555555',
            ])->assertRedirect(route('employees.index'));

        $this->assertDatabaseHas('employees', $data);
    }
}
