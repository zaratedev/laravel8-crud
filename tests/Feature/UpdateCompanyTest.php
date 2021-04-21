<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UpdateCompanyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_loads_the_edit_company_page()
    {
        $user = User::factory()->create();
        $company = Company::factory()->create();

        $this->actingAs($user)
            ->get(route('companies.edit', $company))
            ->assertSuccessful()
            ->assertViewIs('companies.edit')
            ->assertViewHas('company', fn ($retrieve) => $retrieve->is($company));
    }


    /** @test */
    public function it_can_updates_an_company()
    {
        Storage::fake('public');

        $user = User::factory()->create();

        $oldLogo = UploadedFile::fake()->image('logo.jpeg')->store('companies', 'public');
        $company = Company::factory()->create([
            'logo' => $oldLogo,
        ]);

        $this->actingAs($user)
            ->put(route('companies.update', $company), [
            'name' => 'Company Updated',
            'email' => 'test@test.com',
            'logo' => $updatedLogo = UploadedFile::fake()->image('updated_logo.jpeg', 100, 100),
            'website' => 'https://example.test',
        ])
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('companies.index'));

        tap($company->refresh(), function ($company) use ($oldLogo, $updatedLogo) {
            $this->assertEquals('Company Updated', $company->name);
            $this->assertEquals('test@test.com', $company->email);
            $this->assertEquals('https://example.test', $company->website);
            Storage::disk('public')->assertMissing($oldLogo);
            Storage::disk('public')->assertExists($company->logo);
            $this->assertFileEquals($updatedLogo->path(), Storage::disk('public')->path($company->logo));
        });
    }
}
