<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_creates_an_company()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->from(route('company.create'))
            ->post(route('company.store', [
                'name' => 'Company Fake',
                'email' => 'test@test.com',
                'website' => 'https://example.test'
            ]))
            ->assertSuccessful()
            ->assertRedirect(route('company.index'));

        $this->assertDatabaseHas('companies', [
            'name' => 'Company Fake',
            'email' => 'test@test.com',
            'website' => 'https://example.test',
        ]);
    }

}
