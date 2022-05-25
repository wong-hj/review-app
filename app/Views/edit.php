<?= $this->extend("layouts/default")?>

<?= $this->section("title")?>

    Edit Review

<?= $this ->endSection() ?>

<?= $this->section("content")?>

<div class="w-50 mx-auto">
<h1 class="my-5">Edit <?= $review->username?>'s Review on <?= $review->restaurant?></h1>


    <!-- Tabs navs -->
<ul class="nav nav-tabs mb-3" id="ex1" role="tablist">
  <li class="nav-item" role="presentation">
    <a
      class="nav-link <?php if(! session()->has('update')): echo "active"; endif?>"
      id="ex1-tab-1"
      data-mdb-toggle="tab"
      href="#ex1-tabs-1"
      role="tab"
      aria-controls="ex1-tabs-1"
      aria-selected="true"
      >Edit Details</a
    >
  </li>
  <li class="nav-item" role="presentation">
    <a
      class="nav-link <?php if(session('update') == 'no_update'): echo "active"; endif?>"
      id="ex1-tab-2"
      data-mdb-toggle="tab"
      href="#ex1-tabs-2"
      role="tab"
      aria-controls="ex1-tabs-2"
      aria-selected="false"
      >Edit Picture</a
    >
  </li>
</ul>
<!-- Tabs navs -->

<!-- Tabs content -->
<div class="tab-content" id="ex1-content">
  <div
    class="tab-pane fade <?php if(! session()->has('update')): echo "show active"; endif?>"
    id="ex1-tabs-1"
    role="tabpanel"
    aria-labelledby="ex1-tab-1"
  >
        <?= form_open("/review/update/" . $review->id) ?>


        <?php if (session()->has('errors')): ?>
            <ul>
                <?php foreach(session('errors') as $error): ?>
                    <li class="text-danger"><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif ?>

        <div class="form-group">
            <label for="username" > Name</label><span class="text-danger"> * </span></label>
            <input type="text" name="username" id="username" class="form-control" value="<?= old('username', esc($review->username)) ?>">
        </div>   

        <div class="form-group">
            <label for="restaurant"> Restaurant</label><span class="text-danger"> * </span></label>
            <input type="text" name="restaurant" id="restaurant" class="form-control" value="<?= old('restaurant', esc($review->restaurant))?>">
        </div>   

        <label class="form-label" for="rating">Rating</label><span class="text-danger"> * </span></label>
            <div class="range range-field">
                <input type="range" name="rating" class="form-range range-field" min="1" max="5" step="1" id="rating" value ="<?= old('rating', esc($review->rating))?>"/>
                
            </div>
        </label>


        <div class="form-group">
            <label for="description"> Description </label><span class="text-danger"> * </span></label>
            <textarea type="textarea" name="description" id="description" class="form-control"><?= old('description', esc($review->description))?></textarea>
        </div>


        <button class="btn btn-light btn-outline-dark my-2">Submit</button>


        </form>

  </div>

  <div class="tab-pane fade <?php if(session('update') == 'no_update'): echo "show active"; endif?> " id="ex1-tabs-2" role="tabpanel" aria-labelledby="ex1-tab-2">
    
    
        <h2> Current Photo: </h2>

        <img src="<?= site_url("images/" . $review->stall_pic)?>" alt="A Review Photo" class="mb-5" style="width: 100%">

        <div class="border rounded p-5">

            <?= form_open_multipart("/review/updatePhoto/" .$review->id) ?>

                <h3> Change Photo To: </h3>

                <div class="form-group">
                    <label for="stall_pic"> File Upload </label>
                    <input type="file" name="stall_pic" id="stall_pic" class="form-control">
                    <p class="text-muted">The attachment must be smaller than 5 MB. Allowed file types: jpg / jpeg / png.</p>

                </div>
                
                <button class="btn btn-light btn-outline-dark">Submit</button>
                
            </form>
        </div>
    

  </div>

</div>
<!-- Tabs content -->
<a href="<?= site_url("/review/index")?>"><button class="btn float-right my-3">Back to Main Page</button></a>


</div>
 


<?= $this ->endSection() ?>