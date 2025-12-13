<?php

namespace Tests\Unit;

use App\Application\Security\PasswordHasher;
use App\Application\User\DTO\CreateUserDTO;
use App\Application\User\UseCases\CreateUserHandler;
use App\Domain\User\Entities\User;
use App\Domain\User\Repositories\UserRepositoryInterface;
use App\Domain\User\ValueObjects\UserId;
use Mockery;
use PHPUnit\Framework\TestCase;

class CreateUserHandlerTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
    }

    public function test_handle_saves_user_via_repository(): void
    {
        $repo = Mockery::mock(UserRepositoryInterface::class);
        $repo->shouldReceive('save')
            ->once()
            ->andReturnUsing(
                fn (User $user) => $user->withId(new UserId('019b13cd-a0e3-70fd-833a-b6e567931585'))
            );

        $hasher = Mockery::mock(PasswordHasher::class);
        $hasher->shouldReceive('hash')
            ->once()
            ->with('secret')
            ->andReturn('hashed-secret');

        $handler = new CreateUserHandler($repo, $hasher);

        $dto = new CreateUserDTO(
            name: 'Bang',
            email: 'bang@example.test',
            password: 'secret'
        );

        $user = $handler->handle($dto);

        $this->assertNotNull($user->id());
    }
}
