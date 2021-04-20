<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CreateCompanyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_loads_the_create_company_page()
    {
        $user = User::factory()->create();
        $company = Company::factory()->create();

        $this->actingAs($user)
            ->get(route('companies.create', $company))
            ->assertSuccessful()
            ->assertViewIs('companies.create');
    }

    /** @test */
    public function it_can_creates_an_company()
    {
        Storage::fake('public');

        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('companies.store'), [
                'name' => 'Company Fake',
                'email' => 'test@test.com',
                'logo' => $file = UploadedFile::fake()->image('company.jpeg', 100, 100),
                'website' => 'https://example.test',
            ])
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('companies.index'));

        tap(Company::first(), function ($company) use ($file) {
            Storage::disk('public')->assertExists($company->logo);
            $this->assertFileEquals($file->path(), Storage::disk('public')->path($company->logo));
            $this->assertNotNull($company->logo);
            $this->assertEquals('Company Fake', $company->name);
            $this->assertEquals('test@test.com', $company->email);
            $this->assertEquals('https://example.test', $company->website);
        });

    }

    /** @test */
    public function the_name_field_is_required()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('companies.store'), [
                'name' => null,
            ])->assertSessionHasErrors('name');
    }

    /** @test */
    public function the_name_field_must_be_a_string()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('companies.store'), [
                'name' => [
                    'foo' => 'bar'
                ],
            ])->assertSessionHasErrors('name');
    }

    /** @test */
    public function the_name_field_must_have_at_least_2_characters()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('companies.store'), [
                'name' => 'x',
            ])->assertSessionHasErrors('name');
    }

    /** @test */
    public function the_name_field_must_have_at_up_to_255_characters()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('companies.store'), [
                'name' => str_repeat('x', 256),
            ])->assertSessionHasErrors('name');
    }

    /** @test */
    public function the_email_field_must_be_a_string()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('companies.store'), [
                'email' => [
                    'foo' => 'bar',
                ],
            ])->assertSessionHasErrors('email');
    }

    /** @test */
    public function the_email_field_must_be_a_valid_email()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('companies.store'), [
                'email' => 'NOT_A_VALID_EMAIL',
            ])->assertSessionHasErrors('email');
    }

    /** @test */
    public function the_email_field_must_have_at_up_to_255_characters()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('companies.store'), [
                'email' => str_repeat('x', 256),
            ])->assertSessionHasErrors('email');
    }

    /** @test */
    public function the_logo_field_must_be_an_image()
    {
        Storage::fake();

        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('companies.store'), [
                'logo' => UploadedFile::fake()->create('not-an-image.pdf'),
            ])->assertSessionHasErrors('logo');
    }

    /** @test */
    public function the_logo_field_must_have_dimensions_with_width_100_and_height_100()
    {
        Storage::fake();

        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('companies.store'), [
                'logo' => UploadedFile::fake()->image('not-an-image.jpeg', 10, 10),
            ])->assertSessionHasErrors('logo');
    }

    /** @test */
    public function the_website_field_must_be_string()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('companies.store'), [
                'website' => [
                    'foo' => 'bar'
                ],
            ])->assertSessionHasErrors('website');
    }

    /** @test */
    public function the_website_field_must_be_an_valid_url()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('companies.store'), [
                'website' => 'NOT_VALID_URL',
            ])->assertSessionHasErrors('website');
    }
}
