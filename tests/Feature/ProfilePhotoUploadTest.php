<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\FinancialAssistance;

class ProfilePhotoUploadTest extends TestCase
{
    use RefreshDatabase;
    
    protected function setUp(): void
    {
        parent::setUp();
        // Disable middleware for this test
        $this->withoutMiddleware();
    }

    /** @test */
    public function it_can_upload_profile_photo()
    {
        // Create a fake image file
        $file = \Illuminate\Http\UploadedFile::fake()->image('profile.jpg', 600, 600)->size(1000);

        // Submit form with profile photo
        $response = $this->post(route('financial-assistance.store'), [
            'applicant' => 'Test Applicant',
            'name' => 'Test Name',
            'request_date' => '2025-09-08',
            'financial_asst_type' => 'education',
            'financial_asst_for' => 'Education',
            'aadhar_number' => '123456789012',
            'date_of_birth' => '2000-01-01',
            'birth_place' => 'Test City',
            'student_first_name' => 'Test',
            'last_name' => 'Student',
            'marital_status' => 'single',
            'native_place' => 'Test Place',
            'age' => 25,
            'nationality' => 'Indian',
            'gender' => 'male',
            'religion' => 'Hindu',
            'student_email' => 'test@example.com',
            'student_mobile' => '9876543210',
            'flat_no' => '101',
            'floor' => '1st',
            'name_of_building' => 'Test Building',
            'area' => 'Test Area',
            'lane' => 'Test Lane',
            'landmark' => 'Test Landmark',
            'pincode' => '123456',
            'status' => 'Active',
            'city' => 'Test City',
            'postal_address' => 'Test Postal Address',
            'district' => 'Test District',
            'chapter' => 'Test Chapter',
            'profile_photo' => $file,
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        // Check if the record was created in the database
        $this->assertDatabaseHas('financial_assistance', [
            'applicant' => 'Test Applicant',
            'student_email' => 'test@example.com',
        ]);

        // Check if the profile photo path is stored
        $record = FinancialAssistance::where('student_email', 'test@example.com')->first();
        $this->assertNotNull($record->profile_photo_path);
        $this->assertStringContainsString('profile_photos/', $record->profile_photo_path);
    }
}