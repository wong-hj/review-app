<?= $this->extend("layouts/default")?>

<?= $this->section("title")?>

    Upload Reviews

<?= $this ->endSection() ?>

<?= $this->section("content")?>
<div class="mx-auto w-50">
    <h1 class="my-5">Add Reviews</h1>

    <?php if (session()->has('errors')): ?>
        <ul>
            <?php foreach(session('errors') as $error): ?>
                <li class="text-danger"><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif ?>

    <?= form_open_multipart("/review/upload") ?>

    
        <div class="form-group">
            <label for="username" > Name <span class="text-danger"> * </span></label>
            <input type="text" name="username" id="username" class="form-control" value="<?= old('username')?>">
        </div>   

        <div class="form-group">
            <label for="restaurant"> Restaurant <span class="text-danger"> * </span></label>
            <input type="text" name="restaurant" id="restaurant" class="form-control" value="<?= old('restaurant')?>">
        </div>   

        <label class="form-label" for="rating">Rating <span class="text-danger"> * </span></label>
            <div class="range range-field">
                <input type="range" name ="rating" class="form-range range-field" min="1" max="5" step="1" id="rating" value ="<?= old('rating')?>"/>
            </div>

        <div class="form-group">
            <label for="description"> Description <span class="text-danger"> * </span></label>
            <textarea type="textarea" name="description" id="description" class="form-control"><?= old('description')?></textarea>
        </div>

        <div class="form-group">
            <label for="stall_pic"> Image Upload <span class="text-danger"> * </span></label>
            <input type="file" name="stall_pic" id="stall_pic" class="form-control">
            <p class="text-muted">The attachment must be smaller than 5 MB. Allowed file types: jpg / jpeg / png.</p>
        </div>
            

        

        <button class="btn btn-light btn-outline-dark">Submit</button>
    </form>
    <br>
    <a href="<?= site_url("/review")?>"><button class="btn">Back to Main Page</button></a>
    </div>
    


<?= $this ->endSection() ?>