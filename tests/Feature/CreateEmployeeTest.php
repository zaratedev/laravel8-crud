<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateEmployeeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_loads_the_new_employee_page()
    {
        $user = User::factory()->create();
        $company = Company::factory()->create();

        $this->actingAs($user)
            ->get(route('employees.create'))
            ->assertViewIs('employees.create')
            ->assertViewHas('companies', fn ($retrieve) => $retrieve->contains($company));
    }

    /** @test */
    public function it_creates_a_new_employee()
    {
        $user = User::factory()->create();
        $company = Company::factory()->create();

        $this->actingAs($user)
            ->from(route('employees.create'))
            ->post(route('employees.store'), [
                'first_name' => 'Joe',
                'last_name' => 'Doe',
                'company_id' => $company->id,
                'email' => 'joe@example.com',
                'phone' => '5555555555',
            ])->assertRedirect(route('employees.index'));

        tap(Employee::first(), function ($employee) use ($company) {
            $this->assertEquals('Joe', $employee->first_name);
            $this->assertEquals('Doe', $employee->last_name);
            $this->assertEquals($company->id, $employee->company_id);
            $this->assertEquals('joe@example.com', $employee->email);
            $this->assertEquals('5555555555', $employee->phone);
        });
    }

    /** @test */
    public function the_first_name_field_is_required()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('employees.store'), [
                'first_name' => null,
            ])->assertSessionHasErrors('first_name');
    }

    /** @test */
    public function the_first_name_field_must_be_string()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('employees.store'), [
                'first_name' => true,
            ])->assertSessionHasErrors('first_name');
    }

    /** @test */
    public function the_first_name_field_must_have_at_least_2_characters()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('employees.store'), [
                'first_name' => 'x',
            ])->assertSessionHasErrors('first_name');
    }

    /** @test */
    public function the_first_name_field_must_have_at_up_to_255_characters()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('employees.store'), [
                'first_name' => str_repeat('x', 256),
            ])->assertSessionHasErrors('first_name');
    }

    /** @test */
    public function the_last_name_field_is_required()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('employees.store'), [
                'last_name' => null,
            ])->assertSessionHasErrors('last_name');
    }

    /** @test */
    public function the_last_name_field_must_be_string()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('employees.store'), [
                'last_name' => true,
            ])->assertSessionHasErrors('last_name');
    }

    /** @test */
    public function the_last_name_field_must_have_at_least_2_characters()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('employees.store'), [
                'last_name' => 'x',
            ])->assertSessionHasErrors('last_name');
    }

    /** @test */
    public function the_last_name_field_must_have_at_up_to_255_characters()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('employees.store'), [
                'last_name' => str_repeat('x', 256),
            ])->assertSessionHasErrors('last_name');
    }

    /** @test */
    public function the_company_id_field_is_required()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('employees.store'), [
                'company_id' => null,
            ])->assertSessionHasErrors('company_id');
    }

    /** @test */
    public function the_company_id_field_must_be_valid()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('employees.store'), [
                'company_id' => 1,
            ])->assertSessionHasErrors('company_id');
    }

    /** @test */
    public function the_email_field_must_be_string()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('employees.store'), [
                'email' => false,
            ])->assertSessionHasErrors('email');
    }

    /** @test */
    public function the_email_field_must_be_valid()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('employees.store'), [
                'email' => 'email-test',
            ])->assertSessionHasErrors('email');
    }

    /** @test */
    public function the_phone_field_must_be_valid()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('employees.store'), [
                'phone' => false,
            ])->assertSessionHasErrors('phone');
    }

    /** @test */
    public function the_phone_field_must_have_at_least_10_characters()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('employees.store'), [
                'phone' => str_repeat('x', 9),
            ])->assertSessionHasErrors('phone');
    }
}
