<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewCompanyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_view_the_list_of_company()
    {
        $user = User::factory()->create();
        Company::factory()->count(10)->create();

        $this->actingAs($user)
            ->get(route('companies.index'))
            ->assertViewIs('companies.index')
            ->assertViewHas('companies', fn ($retrieve) => $retrieve->count() === 10);
    }

    /** @test */
    public function can_view_pagination_in_index()
    {
        $user = User::factory()->create();
        Company::factory()->count(20)->create();

        $companies = Company::query()
            ->latest()
            ->paginate(10);

        $companies->setPath(config('app.url').'/companies');

        $this->actingAs($user)
            ->get(route('companies.index'))
            ->assertViewIs('companies.index')
            ->assertSee($companies->links());
    }

    /** @test */
    public function can_view_a_company()
    {
        $user = User::factory()->create();
        $company = Company::factory()->create();

        $this->actingAs($user)
            ->get(route('companies.show', $company))
            ->assertViewHas('company', fn ($retrieve) => $retrieve->is($company))
            ->assertSee($company->present()->name)
            ->assertSee($company->email)
            ->assertSee($company->website)
            ->assertSee($company->present()->logo);
    }

}
