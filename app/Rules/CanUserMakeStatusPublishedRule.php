<?php

namespace App\Rules;

use App\Enums\ProductStatus;
use App\Exceptions\InvalidRuleArgumentException;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Auth\User as Authenticatable;


class CanUserMakeStatusPublishedRule implements Rule
{
    private $statuses = [];

    public function __construct(Authenticatable $user)
    {
        $this->user = $user;
        $this->statuses = ProductStatus::getStatuses();
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     * @throws InvalidRuleArgumentException
     */
    public function passes($attribute, $value): bool
    {
        if ($attribute !== 'status') {
            throw new InvalidRuleArgumentException();
        }

        if ($this->user->isAdmin()) {
            return true;
        }

        if (ProductStatus::PUBLISHED === $value) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'You are not allowed to change product status to ' . ProductStatus::PUBLISHED;
    }
}
