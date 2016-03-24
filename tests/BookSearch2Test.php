<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BookSearch2Test extends TestCase
{
    /**
     * A basic test example.

     * @return void
     */
    public function testBookSearch2()
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
      $results = $search->find('javascript web applications', True);
      $success = True;
      $numResults = count($results);
      if($numResults !== 1){
        $success = False;
        echo "Number of results is $numResults, instead of 1.\n";
      }else{
        foreach($results as $book){
          if(strcmp($book['title'], 'JavaScript Web Applications') !== 0){
            $success = False;
            echo "Book title isn't the expected title: JavaScript Web Applications.\n";
            break;
          }
          if(!array_search($book, $books)){
                $success = False;
                echo "The result isn't contained in the set of books.\n";
                break;
          }
        }
      }

      $this->assertTrue($success);
    }
}
