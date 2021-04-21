<?php

namespace Tests\Unit\Models;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    /** @test */
    public function it_uses_traits()
    {
        $user = new User;

        $traits = collect(class_uses($user))->flatten()->toArray();

        $this->assertEquals([
            'Illuminate\Database\Eloquent\Factories\HasFactory',
            'Illuminate\Notifications\Notifiable',
        ], $traits);
    }
}