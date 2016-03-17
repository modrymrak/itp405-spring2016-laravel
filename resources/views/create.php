<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>DVD Display</title>
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</head>
<body>

    <div class="container">
      <h1> DVD Creation</h1>
      <div class="col-md-12">
        <div class="panel panel-default " >
          <div class="panel-heading"><h4>Fill in the table to add new DVD entry. </h4></div>
          <div class="panel-body">
            <form action="/dvds" method="post" role="form" class = "form-horizontal">
              <?php if(count($errors) > 0) : ?>
                <ul class="errorListRed">
                  <?php foreach($errors->all() as $error) :?>
                    <li>
                      <?php echo $error ?>
                    </li>
                  <?php endforeach ?>
                </ul>
              <?php endif ?>
              <?php if(session('success')) :?>
                <p class="successParagraph">Your review was added successfully.</p>
              <?php endif ?>
                <div class="form-group">
                    <?php echo csrf_field() ?>
                    <label for = "title" class = "col-md-2 control-label ">Title: </label>
                    <div class = " col-md-4">
                      <input type = "text" class="form-control" id="title"  value="<?php echo old('title')?>"  name="title">
                    </div>

                    <label for = "label"  class = " control-label col-md-2" >Label:</label>
                    <div class = " col-md-4">
                      <select name="label" id="label" class="form-control">
                      <?php foreach ($labels as $label) : ?>
                          <?php if($label->label_name) : ?>
                            <option value="<?php echo $label->id; ?>" <?php if(old('label') == $label->id){echo 'selected';}?> ><?php echo $label->label_name; ?></option>
                          <?php endif ?>
                      <?php endforeach; ?>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                  <label for = "award" class = "col-md-2 control-label ">Award: </label>
                  <div class = " col-md-4">
                    <input type = "text" class="form-control" id="award"  value="<?php echo old('award')?>"  name="award">
                  </div>

                  <label for = "genre"  class = " control-label col-md-2" >Genre:</label>
                  <div class = " col-md-4">
                    <select name="genre" id="genre" class="form-control">
                    <?php foreach ($genres as $genre) : ?>
                        <?php if($genre->genre_name) : ?>
                          <option value="<?php echo $genre->id;?>" <?php if(old('genre') == $genre->id){echo 'selected';}?>><?php echo $genre->genre_name; ?></option>
                        <?php endif ?>
                    <?php endforeach; ?>
                    </select>
                  </div>
              </div>
              <div class="form-group">
                <label for = "sound"  class = " control-label col-md-2" >Sound:</label>
                <div class = " col-md-4">
                  <select name="sound" id="sound" class="form-control">
                  <?php foreach ($sounds as $sound) : ?>
                      <?php if($sound->sound_name) : ?>
                        <option value="<?php echo $sound->id; ?>" <?php if(old('sound') == $sound->id){echo 'selected';}?> ><?php echo $sound->sound_name; ?></option>
                      <?php endif ?>
                  <?php endforeach; ?>
                  </select>
                </div>
                    <label for = "rating"  class = " control-label col-md-2" >Rating:</label>
                    <div class = " col-md-4">
                      <select name="rating" id="rating" class="form-control">
                      <?php foreach ($ratings as $rating) : ?>
                          <?php if($rating->rating_name) : ?>
                            <option value="<?php echo $rating->id;?>" <?php if(old('rating') == $label->id){echo 'rating';}?>><?php echo $rating->rating_name; ?></option>
                          <?php endif ?>
                      <?php endforeach; ?>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                  <label for = "format"  class = " control-label col-md-2" >Format:</label>
                  <div class = " col-md-4">
                    <select name="format" id="format" class="form-control">
                    <?php foreach ($formats as $format) : ?>
                        <?php if($format->format_name) : ?>
                          <option value="<?php echo $format->id;?>" <?php if(old('format') == $format->id){echo 'selected';}?> ><?php echo $format->format_name; ?></option>
                        <?php endif ?>
                    <?php endforeach; ?>
                    </select>
                  </div>
                <div class = "col-md-4 col-md-offset-2" >
                  <input type="submit" value="Submit Review" class="form-control btn btn-primary">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</body>
</html>
