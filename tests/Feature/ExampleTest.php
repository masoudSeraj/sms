<?php

namespace Sunnyr\Company\Tests\Feature;

use App\Models\User;
use Sunnyr\Sms\Enums\Status;
use Tests\CreatesApplication;
use Sunnyr\Company\Models\Agent;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Notification;
use Sunnyr\Sms\Notifications\TestNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

class ExampleTest extends BaseTestCase
{
    use RefreshDatabase, CreatesApplication;

    public function test_example()
    {
        $this->assertTrue(true);
    }

    public function test_farazsms_message_is_sent()
    {
        // Notification::fake();
        // Queue::fake();
        
        $users = User::factory()->count(2)
            ->has(Agent::factory()->state(
                    new Sequence(
                            ['company_name' => 'sunnyr'], 
                            ['company_name' => 'lubetech']
                        )
                ))->create();   

        $this->assertDatabaseHas('agents', [
            'id' => $users->first()->agent->id
        ]);
        $this->assertDatabaseHas('users', [
            'id' => $users->first()->id
        ]);

        Notification::send($users, new TestNotification('hello'));

        $this->assertDatabaseHas('sms_responses', [
            'id' => $users->first()->id,
            'driver' => 'farazsms',
            'message' => 'hello',
        ]);
        // Notification::assertSentTo($users, TestNotification::class); 
    }

    // public function test_enum()
    // {
    //     // $sending = constant('SENDING');

    //     // dd(Status::from((constant) 'SENDING')->key());
    //     dd(Status::getStatus('SENDING'));
    // }
}


