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
    public function an_admin_cannot_create_company_with_no_name()
    {
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

    /** @test */
    public function an_admin_can_see_all_companies()
    {
        $this->withoutMiddleware();
        Storage::fake('img');

        //Given an admin and some companies
        $admin = factory(User::class)->create();
        
        $company = factory(Company::class)->create([
            'logo' => UploadedFile::fake()->image('logo.jpg', 100, 100),
        ]);                

        //When the admin send a get request to the company page
        $response = $this->actingAs($admin)
             ->get('/admin/companies');        
        
        //Then the admin will see all the companies
        $response->assertSee($company->name);             
    }

    /** @test */
    public function an_admin_can_only_see_ten_company_per_page()
    {
        $this->withoutMiddleware();
        Storage::fake('img');

        //Given an admin and 11 companies
        $admin = factory(User::class)->create();
        
        $companies = factory(Company::class, 11)->create([
            'logo' => UploadedFile::fake()->image('logo.jpg', 100, 100),
        ]);                

        
        //When the admin send a get request to the company second page
        $queryParameters = 'page=2';
        $response = $this->actingAs($admin)
             ->get('/admin/companies' . '?page=2');        
        
        $this->assertEquals(11, Company::all()->count());
        //Then the admin will see only one company

        $response->assertDontSee($companies[9]->name);  
        $response->assertSee($companies[10]->name);  

    }

    /** @test */
    public function an_admin_can_see_a_single_company()
    {
        $this->withoutMiddleware();
        Storage::fake('img');

        //Given an admin and a company
        $admin = factory(User::class)->create();
        
        $company = factory(Company::class)->create([
            'logo' => UploadedFile::fake()->image('logo.jpg', 100, 100),
        ]);                

        //When the admin send a get request to see a single company
        $response = $this->actingAs($admin)
             ->get('/admin/companies/'.$company->id);        
        
        //Then he will see all the data of the company requested
        $response->assertSee($company->name)
            ->assertSee($company->website);  
    }

    /** @test */
    public function an_admin_can_update_a_single_company()
    {
        $this->withoutMiddleware();
        Storage::fake('img');

        //Given an admin and a company
        $admin = factory(User::class)->create();
        
        $company = factory(Company::class)->create([
            'logo' => UploadedFile::fake()->image('logo.jpg', 100, 100),
        ]);         

        $company->name = "NewName";

        $this->put('/admin/companies/'.$company->id, $company->toArray());
        //The task should be updated in the database.
        $this->assertDatabaseHas('companies',['id'=> $company->id , 'name' => 'NewName']);

    }

    
}
