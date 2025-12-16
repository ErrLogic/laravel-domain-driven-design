<?php

namespace App\Domain\Accounting\Entities;

use App\Domain\Accounting\Exceptions\ControlAccountPostingException;
use App\Domain\Accounting\Exceptions\PostingToNonPostableAccountException;
use App\Domain\Accounting\ValueObjects\AccountCode;
use App\Domain\Accounting\ValueObjects\AccountId;
use App\Domain\Accounting\ValueObjects\Enums\AccountType;

final readonly class Account
{
    public function __construct(
        private AccountId $id,
        private ?AccountId $parentId,
        private AccountCode $code,
        private string $name,
        private AccountType $type,
        private bool $isPostable,
        private bool $isControl
    ) {}

    public function id(): AccountId
    {
        return $this->id;
    }

    public function parentId(): ?AccountId
    {
        return $this->parentId;
    }

    public function code(): AccountCode
    {
        return $this->code;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function type(): AccountType
    {
        return $this->type;
    }

    public function isPostable(): bool
    {
        return $this->isPostable;
    }

    public function isControl(): bool
    {
        return $this->isControl;
    }

    public function assertCanPost(): void
    {
        if (!$this->isPostable) {
            throw new PostingToNonPostableAccountException();
        }

        if ($this->isControl) {
            throw new ControlAccountPostingException();
        }
    }
}
