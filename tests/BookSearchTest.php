<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BookSearchTest extends TestCase
{
    /**
     *A test to verify that $results is a subset of $books containing the following titles:
    *Learning JavaScript Design Patterns
    *Object Oriented JavaScript
    *JavaScript Web Applications
     *by calling find('javascript') on a BookSearch class instance
     * @return void
     */
    public function testBookSearch1()
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
      $results = $search->find('javascript');
      $success = True;
      $numResults = count($results);
      if($numResults !== 3){
        $success = False;
        echo "Number of results is $numResults, instead of 3.\n";
      }else{
        foreach($results as $book){
          if(strcmp($book['title'], 'Learning JavaScript Design Patterns') !== 0
              && strcmp($book['title'], 'Object Oriented JavaScript') !== 0
              && strcmp($book['title'], 'JavaScript Web Applications') !== 0){
            $success = False;
            echo "Book title isn't any of the expected titles.\n";
            break;
          }
          if(!array_search($book, $books)){
                $success = False;
                echo "A result isn't contained in the set of books.\n";
                break;
          }
        }
      }

      $this->assertTrue($success);
    }

}
