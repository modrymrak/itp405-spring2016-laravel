<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>DVD Search</title>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            <h1>DVD Search</h1>
            <form action="../dvds" method="get" role="form">
                <div class="form-group">
                    <label for="title">DVD title:</label>
                    <input type="text" name="dvd_title" id="title" class="form-control">
                </div>
                <div class="form-group">
                    <label for="genresList">Genres: </label>
                    <select class="form-control" id="genresList" name="dvd_genre">
                        <?php foreach ($myGenres as $genre) : ?>
                            <?php echo "<option>$genre->genre_name</option>"?>
                        <?php endforeach?>
                        <option>All</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="ratingsList">Ratings: </label>
                    <select class="form-control" id="ratingsList" name="dvd_rating">
                        <?php foreach ($myRatings as $rating) : ?>
                            <?php echo "<option>$rating->rating_name</option>"?>
                        <?php endforeach?>
                        <option>All</option>
                    </select>
                </div>
                <input type="submit" value="Search" class="btn btn-primary">
            </form>
        </div>
    </body>
</html>