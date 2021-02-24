<?php

namespace Tests\Unit\Rules;

use App\Enums\ProductStatus;
use App\Exceptions\InvalidRuleArgumentException;
use App\Models\User;
use App\Rules\CanUserMakeStatusPublishedRule;
use PHPUnit\Framework\TestCase;

class PublishProductRuleTest extends TestCase
{
    private $rule;
    /**
     * @var User|\PHPUnit\Framework\MockObject\MockObject
     */
    private $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = $this->createMock(User::class);
    }

    public function test_editor_cant_make_product_status_to_published()
    {
        $this->user->method('isAdmin')
            ->willReturn(false);

        $this->rule = new CanUserMakeStatusPublishedRule($this->user);

        $this->assertFalse($this->rule->passes('status', ProductStatus::PUBLISHED));
    }

    public function test_admin_can_change_status_to_publish()
    {
        $this->user->method('isAdmin')
            ->willReturn(true);

        $this->rule = new CanUserMakeStatusPublishedRule($this->user);

        $this->assertTrue($this->rule->passes('status', ProductStatus::PUBLISHED));
    }

    public function test_expects_exception_when_attribute_name_does_not_equal_status()
    {
        $this->rule = new CanUserMakeStatusPublishedRule($this->user);

        $this->expectException(InvalidRuleArgumentException::class);

        $this->rule->passes('not_status', ProductStatus::PUBLISHED);
    }
}
