<?php
namespace Tests\Feature;

use App\Models\Employee;
use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EmployeeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test a user can create an employee.
     */
    public function test_a_user_can_create_an_employee()
    {
        // Create a user and authenticate
        $user = User::factory()->create();
        $this->actingAs($user);

        $company = Company::factory()->create();
        $employeeData = [
            'company_id'    => $company->id,
            'first_name_en' => 'John',
            'last_name_en'  => 'Doe',
            'first_name_hi' => 'जॉन',
            'last_name_hi'  => 'डो',
            'email'         => 'johndoe@example.com',
            'phone'         => '9876543210',
        ];
        $response = $this->post(route('employees.store'), $employeeData);
        $response->assertRedirect(route('employees.index'));
        $this->assertDatabaseHas('employees', [
            'company_id'    => $company->id,
            'first_name_en' => 'John',
            'last_name_en'  => 'Doe',
            'first_name_hi' => 'जॉन',
            'last_name_hi'  => 'डो',
            'email'         => 'johndoe@example.com',
        ]);
    }

    /**
     * Test a user can view an employee.
     */
    public function test_a_user_can_view_an_employee()
    {
        // Create a user and authenticate
        $user = User::factory()->create();
        $this->actingAs($user);

        $employee = Employee::factory()->create();
        $response = $this->get(route('employees.show', $employee->id));
        $response->assertStatus(200);
        $response->assertSee($employee->first_name_en);
        $response->assertSee($employee->last_name_en);
        $response->assertSee($employee->email);
    }

    /**
     * Test a user can update an employee.
     */
    public function test_a_user_can_update_an_employee()
    {
        // Create a user and authenticate
        $user = User::factory()->create();
        $this->actingAs($user);

        $employee = Employee::factory()->create();
        $updatedData = [
            'first_name_en' => 'Updated John',
            'last_name_en'  => 'Updated Doe',
            'first_name_hi' => 'अपडेटेड जॉन',
            'last_name_hi'  => 'अपडेटेड डो',
            'email'         => 'updated@example.com',
            'phone'         => '9999999999',
            'company_id'    => $employee->company_id,
        ];
        $response = $this->put(route('employees.update', $employee->id), $updatedData);
        $response->assertRedirect(route('employees.index'));
        $this->assertDatabaseHas('employees', [
            'id'            => $employee->id,
            'first_name_en' => 'Updated John',
            'last_name_en'  => 'Updated Doe',
            'email'         => 'updated@example.com',
        ]);
    }

    /**
     * Test a user can delete an employee.
     */
    public function test_a_user_can_delete_an_employee()
    {
        // Create a user and authenticate
        $user = User::factory()->create();
        $this->actingAs($user);

        $employee = Employee::factory()->create();
        $response = $this->delete(route('employees.destroy', $employee->id));
        $response->assertRedirect(route('employees.index'));
        $this->assertDatabaseMissing('employees', ['id' => $employee->id]);
    }
}
