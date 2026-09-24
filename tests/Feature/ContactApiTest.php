<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Inquiry;

class ContactApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test GET /api/health returns 200 and healthy JSON response.
     */
    public function test_health_check_endpoint_returns_ok(): void
    {
        $response = $this->getJson('/api/health');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'service',
                'timestamp',
                'php_version',
                'laravel_version',
                'environment',
                'database',
            ])
            ->assertJson([
                'status'   => 'ok',
                'database' => 'connected',
            ]);
    }

    /**
     * Test POST /api/contact validates required fields.
     */
    public function test_contact_submission_requires_mandatory_fields(): void
    {
        $response = $this->postJson('/api/contact', []);

        $response->assertStatus(422)
            ->assertJsonStructure([
                'success',
                'message',
                'errors' => ['name', 'email', 'phone', 'message'],
            ])
            ->assertJson([
                'success' => false,
            ]);
    }

    /**
     * Test POST /api/contact validates email format.
     */
    public function test_contact_submission_rejects_invalid_email(): void
    {
        $payload = [
            'name'    => 'Sarah Jenkins',
            'email'   => 'not-an-email',
            'phone'   => '+254712345678',
            'message' => 'We are looking for wedding pricing.',
        ];

        $response = $this->postJson('/api/contact', $payload);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    }

    /**
     * Test POST /api/contact successfully saves inquiry and returns 201 Created.
     */
    public function test_contact_submission_creates_inquiry_successfully(): void
    {
        $payload = [
            'name'             => 'Wanjiku Mwangi',
            'email'            => 'wanjiku@example.com',
            'phone'            => '+254722000111',
            'event_type'       => 'wedding',
            'estimated_guests' => 350,
            'event_date'       => '2026-11-20',
            'message'          => 'Inquiring about lawn availability and bridal suite access for 350 guests.',
        ];

        $response = $this->postJson('/api/contact', $payload);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'id',
                    'reference',
                    'name',
                    'email',
                    'phone',
                    'event_type',
                    'estimated_guests',
                    'event_date',
                    'status',
                    'created_at',
                ],
            ])
            ->assertJson([
                'success' => true,
                'data' => [
                    'name'             => 'Wanjiku Mwangi',
                    'email'            => 'wanjiku@example.com',
                    'phone'            => '+254722000111',
                    'event_type'       => 'wedding',
                    'estimated_guests' => 350,
                    'event_date'       => '2026-11-20',
                    'status'           => 'new',
                ],
            ]);

        $this->assertDatabaseHas('inquiries', [
            'email'            => 'wanjiku@example.com',
            'estimated_guests' => 350,
            'status'           => 'new',
        ]);
    }

    /**
     * Test honeypot spam protection prevents database pollution.
     */
    public function test_contact_submission_honeypot_absorbs_bot(): void
    {
        $initialCount = Inquiry::count();

        $botPayload = [
            'name'      => 'Spam Bot',
            'email'     => 'spambot@example.com',
            'phone'     => '+18005550199',
            'message'   => 'Buy cheap watches and pills here http://spam.xyz',
            'website'   => 'http://spam.xyz', // Bot fills hidden field
            'bot_check' => 'http://spam.xyz',
        ];

        $response = $this->postJson('/api/contact', $botPayload);

        // Honeypot should return 200 without saving into database
        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);

        $this->assertEquals($initialCount, Inquiry::count());
    }
}
