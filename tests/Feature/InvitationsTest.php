<?php

namespace Tests\Feature;

use App\User;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\MockObject\Stub;
use Tests\TestCase;

class InvitationsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function non_owner_may_not_invite_users()
    {
        $this->actingAs(factory(User::class)->create())
            ->post(ProjectFactory::create()->path() . '/invitations')
            ->assertStatus(403);
    }

    /** @test */
    public function a_project_owner_can_invite_a_user()
    {
        $project = ProjectFactory::create();

        $userToInvite = factory(User::class)->create();

        $this->actingAs($project->owner)
            ->post($project->path().'/invitations',[
            'email' => $userToInvite->email
        ])
            ->assertRedirect($project->path());//invite a user

        $this->assertTrue($project->members->contains($userToInvite));
    }

    /** @test */
    public function the_email_address_must_be_associated_with_a_valid_birdboard_account()
    {

        $project = ProjectFactory::create();

        $this->actingAs($project->owner)
            ->post($project->path().'/invitations',[
            'email' => 'notauser@email.com'
            ])
            ->assertSessionHasErrors([
                'email' => 'The user you are inviting must have a Birdboard account.'
            ]);
    }

    /** @test */
    public function invited_user_may_update_project_details()
    {
//        $this->withoutExceptionHandling();
        //given I have a project
        $project = ProjectFactory::create();

        //project owner can invite a user
        $project->invite($newUser = factory(User::class)->create());

        //then, that new user will have permission to add task
        $this->signIn($newUser);
        $this->post(action('ProjectTasksController@store', $project), $task = ['body' => 'foo task']);

        $this->assertDatabaseHas('tasks', $task);
    }
}
