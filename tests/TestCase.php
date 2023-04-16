<?php

namespace Tests;

use App\Models\Blog;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
    }

    protected function createBlog($args = [], $num = null)
    {
        return Blog::factory()->count($num)->create($args);
    }
}
