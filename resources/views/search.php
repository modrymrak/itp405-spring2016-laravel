<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>DVD Search</title>
        <link rel="stylesheet" type="text/css" href="../css/main.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </head>
    <body>

          <div id="SearchBarFixed">
            <h1>DVD Search</h1>
            <div class="panel panel-default col-md-10" >
                <div class="panel-body">
                <form action="../dvds" method="get" role="form" class="form-horizontal">
                    <div class="form-group">
                        <label for="title" class="col-md-2 control-label">DVD title:</label>
                        <div class="col-md-10">
                          <input type="text" name="dvd_title" id="title" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="genresList" class="col-md-2 control-label">Genres: </label>
                        <div class="col-md-3">
                          <select class="form-control" id="genresList" name="dvd_genre">
                              <?php foreach ($myGenres as $genre) : ?>
                                  <?php echo "<option>$genre->genre_name</option>"?>
                              <?php endforeach?>
                              <option>All</option>
                          </select>
                        </div>

                        <label for="ratingsList" class="col-md-2 control-label">Ratings: </label>
                        <div class="col-md-3">
                          <select class="form-control" id="ratingsList" name="dvd_rating">
                              <?php foreach ($myRatings as $rating) : ?>
                                  <?php echo "<option>$rating->rating_name</option>"?>
                              <?php endforeach?>
                              <option>All</option>
                          </select>
                        </div>
                        <div class="col-md-2">
                          <input type="submit" value="Search" class="btn btn-primary">
                        </div>
                    </div>
                </form>
              </div>
            </div>
          </div>
          <div class="rightSideBar">
            <div class="headingFixed">
                <h5><b>List DVDs by genre: </b></h5>
            </div>
            <ul>
              <?php foreach ($myGenres as $genre) : ?>
                  <?php echo "<a href='/genres/$genre->genre_name/dvds'><li>$genre->genre_name</li> </a>" ?>
              <?php endforeach ?>
            </ul>
          </div>
    </body>
</html>
