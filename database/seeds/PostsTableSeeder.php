<?php

use Illuminate\Database\Seeder;

use App\post;

use App\category;

use App\tag;

 use Illuminate\Support\Facades\Hash;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $author1 = App\User::create([
            'name' => 'John Doe',
            'email' => 'john@doe.com',
            'password' => Hash::make('password')
            
        ]);

        $author2 = App\User::create([
            'name' => 'Jane Doe',
            'email' => 'jane@doe.com',
            'password' => Hash::make('password')
            
        ]);


        $category1 = category::create([
            'name' => 'News'
        ]);

        $category2 = category::create([
            'name' => 'Marketing'
        ]);
        $category3 = category::create([
            'name' => 'Partnership'
        ]);

        $tag1 = tag::create([
            'name' => 'Jobs'
        ]);

        $tag2 = tag::create([
            'name' => 'Customers'
        ]);
        $tag3 = tag::create([
            'name' => 'Record'
        ]);
        
        $post1 = $author1->posts()->create([
            'title' => 'We relocated our office to a new designed garage',
            'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever 
            since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but",
             'content' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the
              1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap 
              into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release
              of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
            'category_id' => $category1->id,
            'image' => 'Posts/1.jpg'
        ]);

        $post2 = $author2->posts()->create([
            'title' => 'Top 5 brilliant content marketing strategies',
            'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever 
            since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but",
             'content' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the
              1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap 
              into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release
              of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
            'category_id' => $category2->id,
            'image' => 'Posts/2.jpg'
        ]);
 
        $post3 = $author2->posts()->create([
            'title' => 'Best practices for minimalist design with example',
            'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever 
            since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but",
             'content' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the
              1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap 
              into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release
              of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
            'category_id' => $category3->id,
            'image' => 'Posts/3.jpg'
        ]);

        $post4 = $author1->posts()->create([
            'title' => 'Top 5 brilliant content marketing strategies',
            'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever 
            since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but",
             'content' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the
              1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap 
              into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release
              of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
            'category_id' => $category2->id,
            'image' => 'Posts/4.jpg'
        ]);

        $post1->tags()->attach([$tag1->id, $tag2->id]);

        $post2->tags()->attach([$tag2->id, $tag3->id]);

        $post3->tags()->attach([$tag1->id, $tag3->id]);
    }
}
