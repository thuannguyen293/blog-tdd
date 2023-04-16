<?php

namespace Tests\Feature;

use App\Models\Blog;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BlogTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_visit()
    {
        //prepare
        $blog = $this->createBlog();

        //act
        $res = $this->get('/blog/' . $blog->id);

        //assert
        $res->assertStatus(200);
        $res->assertSee($blog->title);
    }

    /** @test */
    public function user_can_store_a_blog()
    {
        //prepare
        $blog = Blog::factory()->raw();
        //act
        $res = $this->post('blog', $blog);

        //assert
        $res->assertRedirect('/blog');
        $this->assertDatabaseHas('blogs', $blog);
    }

    /** @test */
    public function user_can_delete_a_blog()
    {
        //prepare
        $blog = $this->createBlog();
        
        //act
        $res = $this->delete('/blog/' . $blog->id);

        //assert
        $res->assertRedirect('/blog');
        $this->assertDatabaseMissing('blogs', ['title' => $blog->title]);
    }

    /** @test */
    public function user_can_update_a_blog()
    {
        //prepare
        $blog = $this->createBlog();
        
        //act
        $res = $this->patch('/blog/' . $blog->id, ['title' => 'Updated title']);

        //assert
        $res->assertRedirect('/blog');
        $this->assertDatabaseHas('blogs', ['id' => $blog->id, 'title' => 'Updated title']);
    }

    /** @test */
    public function user_can_visit_a_form_to_store_blog()
    {
        //prepare

        //act
        $res = $this->get('blog/create');

        //assert
        $res->assertStatus(200);
        $res->assertSee('Create New Blog');
    }

    
}
