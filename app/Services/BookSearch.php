<?php
namespace App\Services;

class BookSearch{
  protected $books;
  //Function overloading
  public function __call($name, $args) {
        switch ($name) {
            case 'find':
                switch (count($args)) {
                    case 1:
                        return call_user_func_array(array($this, 'find1'), $args);
                    case 2:
                        return call_user_func_array(array($this, 'find2'), $args);
                 }
        }
  }

  public function __construct($books){
    $this->books = $books;
  }

  public function find1($searchTerm){
    $resultBooks = [];
    $searchTerm = strtolower($searchTerm);
    foreach ($this->books as $book){
      $bookTitle = strtolower($book['title']);
      if(strpos($bookTitle, $searchTerm) !== false){
        $resultBooks[] = $book;
      }
    }
    if(count($resultBooks) == 0){
      return false;
    }
    return $resultBooks;
  }

  public function find2($searchTerm, $exactMatch){
    $resultBooks = [];
    $searchTerm = strtolower($searchTerm);
    foreach ($this->books as $book){
      $bookTitle = strtolower($book['title']);
      if(strpos($bookTitle, $searchTerm) !== false && $exactMatch == false){
        $resultBooks[] = $book;
      }
      if($bookTitle == $searchTerm && $exactMatch == true){
        $resultBooks[] = $book;
      }
    }
    if(count($resultBooks) == 0){
      return false;
    }
    return $resultBooks;
  }

}
 ?>
