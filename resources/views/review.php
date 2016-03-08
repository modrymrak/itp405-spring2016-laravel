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
      <h1> DVD Review for    <em><?php echo $dvd[0]->title ?></em></h1>
      <div class="col-md-4">
        <div class="panel panel-default " >
          <div class="panel-heading"><h4> Information </h4></div>
          <div class="panel-body">

            <div class="label label-primary col-xs-2 "> Genre:</div>
            <div class=" col-xs-10"><?php echo $dvd[0]->genre_name ?></div>
            <div class="label label-primary col-xs-2 "> Label:</div>
            <div class=" col-xs-10"><?php echo $dvd[0]->label_name ?></div>
            <div class="label label-primary col-xs-2 "> Award:</div>
            <div class=" col-xs-10">
              <?php if(!$dvd[0]->award){
                      echo "None";
                    }else{
                    echo $dvd[0]->award;
                    }
              ?>
            </div>
            <div class="label label-primary col-xs-2 "> Sound:</div>
            <div class=" col-xs-10"><?php echo $dvd[0]->sound_name ?></div>
            <div class="label label-primary col-xs-2 "> Rating:</div>
            <div class=" col-xs-10"><?php echo $dvd[0]->rating_name ?></div>
      </div>
    </div>
  </div>

<div class="col-md-8">
  <div class="panel panel-default " >
    <div class="panel-heading" align='center'><h4> Submit a review </h4></div>
    <div class="panel-body">
            <form action="/dvds/<?php echo $dvdID?>" method="post" role="form" class = "form-horizontal">
              <?php if(count($errors) > 0) : ?>
                <ul style="list-style-type: none; color: red;">
                  <?php foreach($errors->all() as $error) :?>
                    <li>
                      <?php echo $error ?>
                    </li>
                  <?php endforeach ?>
                </ul>
              <?php endif ?>
              <?php if(session('success')) :?>
                <p style="color: green;">Your review was added successfully.</p>
              <?php endif ?>
                <div class="form-group">
                    <?php echo "<input type = \"hidden\" name=\"dvdID\" value=\"$dvdID\">" ?>
                    <?php echo csrf_field() ?>
                    <label for = "title" class = "col-md-2 control-label ">Title: </label>
                    <div class = " col-md-4">
                      <input type = "text" class="form-control" id="title"  value="<?php echo old('title')?>"  name="title">
                    </div>

                    <label for = "rating"  class = " control-label col-md-2" >Rating:</label>
                    <div class = " col-md-4">
                      <select name="rating" id="rating" class="form-control"  value="<?php echo old('rating')?>">
                      <?php for ($i = 1; $i <= 10; $i++) : ?>
                          <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                      <?php endfor; ?>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description"  class = " control-label col-md-2 "  >Description: </label>
                    <div class = " col-md-10">
                      <textarea class="form-control" id="description" name="description"  ><?php echo old('description')?></textarea>
                    </div>
                </div>
                <div class = "form-group">
                  <div class = "col-md-5" >
                    <input type="submit" value="Submit Review" class="form-control btn btn-primary">
                  </div>
                </div>
            </form>
          </div>
      </div>
    </div>
</div>
<div class =  "col-md-2" ></div>
<div class="col-md-8"> <!--Reviews table list -->
  <div class="panel panel-default">
    <div class="panel-heading" align='center'>
      <h3>Other Reviews</h3>
      <p> Click on table entry for full description </p>
    </div>
      <div class="panel-body">
        <table class="table table-condensed" style="border-collapse:collapse;">
          <thead>
            <tr>
              <th>Title</th>
              <th>Rating</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($reviews as $review ) : ?>
              <?php echo "<tr data-toggle=\"collapse\" data-target=\"#$review->id\" class=\"accordion-toggle\"> " ?>
              <?php echo "<td>$review->title</td>" ?>
              <?php echo "<td>$review->rating</td>" ?>
            <?php echo "</tr>" ?>
            <?php echo "<tr>" ?>
              <?php echo "<td colspan=\"2\"> " ?>
                <?php echo "<div class=\"accordian-body collapse\" id=\"$review->id\">" ?>
                  <?php echo "$review->description" ?>
                <?php echo "</div>" ?>
              <?php echo "</td>" ?>
            <?php echo "</tr>" ?>

            <?php endforeach?>
          </tbody>
        </table>
      </div>
    </div>
  </div><!--End of Reviews table list -->


</div>
</body>
</html>
