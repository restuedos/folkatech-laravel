<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CompanyTest extends TestCase
{
    use RefreshDatabase;

    public function it_can_create_a_company()
    {
        $data = [
            'name' => 'Test Company',
            'email' => 'test@company.com',
            'website' => 'https://testcompany.com',
        ];

        $company = Company::create($data);

        $this->assertDatabaseHas('companies', $data);
    }

    public function it_requires_a_name_to_create_a_company()
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        Company::create([
            'email' => 'test@company.com',
            'website' => 'https://testcompany.com',
        ]);
    }

    public function it_can_update_a_company()
    {
        $company = Company::factory()->create();

        $updatedData = [
            'name' => 'Updated Company',
        ];

        $company->update($updatedData);

        $this->assertDatabaseHas('companies', $updatedData);
    }

    public function it_can_delete_a_company()
    {
        $company = Company::factory()->create();

        $company->delete();

        $this->assertDatabaseMissing('companies', ['id' => $company->id]);
    }
}
