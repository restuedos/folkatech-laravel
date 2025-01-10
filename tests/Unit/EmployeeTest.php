<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Employee;
use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmployeeTest extends TestCase
{
    use RefreshDatabase;

    public function it_can_create_an_employee()
    {
        $company = Company::factory()->create();

        $data = [
            'firstname' => 'John',
            'lastname' => 'Doe',
            'company_id' => $company->id,
            'email' => 'john.doe@test.com',
            'phone' => '1234567890',
        ];

        $employee = Employee::create($data);

        $this->assertDatabaseHas('employees', $data);
    }

    public function it_requires_a_firstname_to_create_an_employee()
    {
        $company = Company::factory()->create();

        $this->expectException(\Illuminate\Database\QueryException::class);

        Employee::create([
            'lastname' => 'Doe',
            'company_id' => $company->id,
            'email' => 'john.doe@test.com',
            'phone' => '1234567890',
        ]);
    }

    public function it_can_update_an_employee()
    {
        $employee = Employee::factory()->create();

        $updatedData = [
            'firstname' => 'Jane',
        ];

        $employee->update($updatedData);

        $this->assertDatabaseHas('employees', $updatedData);
    }

    public function it_can_delete_an_employee()
    {
        $employee = Employee::factory()->create();

        $employee->delete();

        $this->assertDatabaseMissing('employees', ['id' => $employee->id]);
    }
}
