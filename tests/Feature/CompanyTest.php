<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Company;
use App\Models\User;

class CompanyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_a_user_can_create_a_company()
    {
        // Create a test user and log in
        $user = User::factory()->create();
        $this->actingAs($user);

        $companyData = [
            'name_en' => 'Test Company',
            'name_hi' => 'परीक्षण कंपनी',
            'email' => 'test@company.com',
            'website' => 'http://testcompany.com',
        ];

        $response = $this->post(route('companies.store'), $companyData);

        $response->assertRedirect(route('companies.index'));
        $this->assertDatabaseHas('companies', ['name_en' => 'Test Company']);
    }
 
    /** @test */
    public function test_a_user_can_view_a_company()
    {
        // Create a test user and log in
        $user = User::factory()->create();
        $this->actingAs($user);

        $company = Company::factory()->create();

        $response = $this->get(route('companies.show', $company->id));

        $response->assertStatus(200);
        $response->assertSee($company->name_en);
    }
 
    /** @test */
    public function test_a_user_can_update_a_company()
    {
        // Create a test user and log in
        $user = User::factory()->create();
        $this->actingAs($user);
    
        $company = Company::factory()->create();
        $updatedData = [
            'name_en' => 'Updated Company',
            'name_hi' => 'अपडेटेड कंपनी',
            'email'   => 'updated@example.com',
        ];
        $response = $this->put(route('companies.update', $company->id), $updatedData);
        $response->assertRedirect(route('companies.index'));
        $this->assertDatabaseHas('companies', [
            'name_en' => 'Updated Company',
            'name_hi' => 'अपडेटेड कंपनी',
            'email'   => 'updated@example.com',
        ]);
    }
    
 
    /** @test */
    public function test_a_user_can_delete_a_company()
    {
        // Create a test user and log in
        $user = User::factory()->create();
        $this->actingAs($user);

        $company = Company::factory()->create(); 
        $response = $this->delete(route('companies.destroy', $company->id));
        $response->assertRedirect(route('companies.index'));
        $this->assertDatabaseMissing('companies', ['id' => $company->id]);
    }
}
