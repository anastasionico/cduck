<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Company;
use App\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;


class CompanyTest extends TestCase
{
    use RefreshDatabase;

    // /** @test */
    // public function an_admin_can_read_all_the_company()
    // {
    //     //Given we have company in the database
    //     $company = factory(Company::class)->create();
        
    //     //When user visit the tasks page
    //     $response = $this->get('/admin/companies');
        
    //     //He should be able to read the task
    //     $response->assertSee($company->name);
    // }

    /** @test */
    public function an_admin_can_create_a_company()
    {
        $this->withoutMiddleware();
        Storage::fake('img');

        //Given an admin and a company
        $admin = factory(User::class)->create();

        $company = factory(Company::class)->make([
            'logo' => UploadedFile::fake()->image('logo.jpg', 100, 100),
        ]);

        //When admin create company by submitting a post request
        $response = $this->actingAs($admin)
            ->post('/admin/companies', $company->toArray());

        //company gets stored in the database
        $this->assertEquals(1, Company::all()->count());
    }

    /** @test */
    public function an_admin_cannot_create_company_with_no_name(){
        $this->withoutMiddleware();
        Storage::fake('img');

        //Given an admin and a company
        $admin = factory(User::class)->create();

        $company = factory(Company::class)->make([
            'name' => null,
            'logo' => UploadedFile::fake()->image('logo.jpg', 100, 100),
        ]);
        
        $response = $this->actingAs($admin)
             ->post('/admin/companies', $company->toArray());


        $response->assertSessionHasErrors('name');
    }
}
