<?php

namespace Tests\Unit;

use App\Application\Auth\Contracts\PasswordVerifier;
use App\Application\Auth\Contracts\TokenIssuer;
use App\Application\Auth\DTO\LoginUserDTO;
use App\Application\Auth\UseCases\LoginUserHandler;
use App\Domain\User\Entities\User;
use App\Domain\User\Exceptions\InvalidCredentialsException;
use App\Domain\User\Repositories\UserRepositoryInterface;
use App\Domain\User\ValueObjects\UserEmail;
use App\Domain\User\ValueObjects\UserId;
use App\Domain\User\ValueObjects\UserName;
use Mockery;
use PHPUnit\Framework\TestCase;

class LoginUserHandlerTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
    }

    public function test_login_returns_token_when_credentials_valid(): void
    {
        $user = new User(
            id: new UserId('019b13cd-a0e3-70fd-833a-b6e567931585'),
            name: new UserName('Bang'),
            email: new UserEmail('bang@example.test'),
            password: 'hashed-password'
        );

        $repo = Mockery::mock(UserRepositoryInterface::class);
        $repo->shouldReceive('findByEmail')
            ->once()
            ->with(Mockery::type(UserEmail::class))
            ->andReturn($user);

        $verifier = Mockery::mock(PasswordVerifier::class);
        $verifier->shouldReceive('verify')
            ->once()
            ->with('secret', 'hashed-password')
            ->andReturnTrue();

        $issuer = Mockery::mock(TokenIssuer::class);
        $issuer->shouldReceive('issue')
            ->once()
            ->with($user->id()->value())
            ->andReturn('fake-token');

        $handler = new LoginUserHandler($repo, $verifier, $issuer);

        $dto = new LoginUserDTO(
            email: 'bang@example.test',
            password: 'secret'
        );

        $token = $handler->handle($dto);

        $this->assertSame('fake-token', $token);
    }

    public function test_login_throws_exception_when_password_invalid(): void
    {
        $this->expectException(InvalidCredentialsException::class);

        $user = new User(
            id: new UserId('019b13cd-a0e3-70fd-833a-b6e567931585'),
            name: new UserName('Bang'),
            email: new UserEmail('bang@example.test'),
            password: 'hashed-password'
        );

        $repo = Mockery::mock(UserRepositoryInterface::class);
        $repo->shouldReceive('findByEmail')->andReturn($user);

        $verifier = Mockery::mock(PasswordVerifier::class);
        $verifier->shouldReceive('verify')->andReturnFalse();

        $issuer = Mockery::mock(TokenIssuer::class);

        $handler = new LoginUserHandler($repo, $verifier, $issuer);

        $handler->handle(
            new LoginUserDTO('bang@example.test', 'wrong-password')
        );
    }
}
