<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>DVD Display</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</head>
<body>
    <div class="container">
        <h1>
           DVD Search Result
        </h1>
        <?php
        echo "<p>$searchedString</p>";
        ?>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Title</th>
                <th>Rating</th>
                <th>Genre</th>
                <th>Label</th>
                <th>Sound</th>
                <th>Format</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($myDvds as $dvd) : ?>
                <?php echo "<tr>"; ?>

                <?php echo  "<td>$dvd->title </td>"?>
                <?php echo  "<td>$dvd->rating_name </td>"?>
                <?php echo  "<td>$dvd->genre_name </td>"?>
                <?php echo  "<td>$dvd->label_name </td>"?>
                <?php echo  "<td>$dvd->sound_name </td>"?>
                <?php echo  "<td>$dvd->format_name </td>"?>
                <?php echo "</tr>"; ?>
            <?php endforeach?>
            </tbody>
        </table>
        </div>
</body>
</html>