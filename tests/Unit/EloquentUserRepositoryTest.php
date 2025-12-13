<?php

namespace Tests\Unit;

use App\Domain\User\Entities\User;
use App\Domain\User\ValueObjects\UserEmail;
use App\Domain\User\ValueObjects\UserName;
use App\Infrastructure\Persistence\Eloquent\Repositories\EloquentUserRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EloquentUserRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_save_and_find_by_id()
    {
        $repo = new EloquentUserRepository;

        $domainUser = User::create(
            new UserName('Agik'),
            new UserEmail('agik@example.test'),
            password: bcrypt('secret')
        );

        $saved = $repo->save($domainUser);

        $this->assertNotNull($saved->id());
        $found = $repo->findById($saved->id());
        $this->assertNotNull($found);
        $this->assertEquals('agik@example.test', $found->email()->value());
    }
}
