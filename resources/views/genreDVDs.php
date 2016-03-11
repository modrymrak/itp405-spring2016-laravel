<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>DVD Results</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</head>
<body>
    <div class="container">
        <h1>
           <?php echo $myGenre->genre_name ?> DVDs
        </h1>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Title</th>
                <th>Rating</th>
                <th>Genre</th>
                <th>Label</th>
            </tr>
            </thead>
            <tbody>

            <?php foreach ($myDvds as $dvd ) : ?>
                <?php echo "<tr>"; ?>

                <?php echo  "<td>$dvd->title </td>"?>
                <?php
                  $rating = $dvd->rating;
                  if(is_object($rating)){
                     echo  "<td>$rating->rating_name </td>";
                  }else{
                    echo "<td> </td>";
                  }

                ?>
                <?php
                  $genre = $dvd->genre;
                  if(is_object($genre)){
                    echo "<td> $genre->genre_name </td>";
                  }else{
                    echo "<td> </td>";
                  }
                ?>
                <?php
                  $label = $dvd->label;
                  if(is_object($label)){
                    echo  "<td> $label->label_name </td>";
                  }else{
                    echo "<td> </td>";
                  }
                ?>
                <?php echo
                  "<td>
                    <form action=\"/dvds/$dvd->id\" method=\"get\" role=\"form\">
                      <input type=\"submit\" value=\"Review\" class=\"btn btn-info\">
                    </form>
                  </td>"
                ?>

                <?php echo "</tr>" ?>
            <?php endforeach?>
            </tbody>
        </table>
        </div>
</body>
</html>
