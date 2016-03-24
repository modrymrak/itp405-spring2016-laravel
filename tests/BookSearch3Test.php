<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BookSearch3Test extends TestCase
{
    /**
     * A basic test example.
     *Let's pass the find method a book that doesn't exist. When we call find(), it should return false.

*$search = new \App\Services\BookSearch($books);
*$search->find('The Definitive Guide to Symfony', true); // false

     * @return void
     */
     public function testBookSearch3()
     {
       $books = [
         [ 'title' => 'Introduction to HTML and CSS', 'pages' => 432 ],
         [ 'title' => 'Learning JavaScript Design Patterns', 'pages' => 32 ],
         [ 'title' => 'Object Oriented JavaScript', 'pages' => 42 ],
         [ 'title' => 'JavaScript Web Applications', 'pages' => 99 ],
         [ 'title' => 'PHP Object Oriented Solutions', 'pages' => 80 ],
         [ 'title' => 'PHP Design Patterns', 'pages' => 300 ],
         [ 'title' => 'Head First Java', 'pages' => 200 ]
       ];
       $search = new \App\Services\BookSearch($books);
       $results = $search->find('The Definitive Guide to Symfony', true);
       $success = True;
       if($results !== False){
         $success = False;
       }
       $this->assertTrue(!$results);
     }
}
