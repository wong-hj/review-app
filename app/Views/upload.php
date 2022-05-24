<?= $this->extend("layouts/default")?>

<?= $this->section("title")?>

    Upload Reviews

<?= $this ->endSection() ?>

<?= $this->section("content")?>
<div class="mx-auto w-50">
    <h1 class="my-5">Upload Reviews</h1>

    <?php if (session()->has('errors')): ?>
        <ul>
            <?php foreach(session('errors') as $error): ?>
                <li class="text-danger"><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif ?>

    <?= form_open_multipart("/review/upload") ?>

    
        <div class="form-group">
            <label for="username" > Name</label>
            <input type="text" name="username" id="username" class="form-control" value="<?= old('username')?>">
        </div>   

        <div class="form-group">
            <label for="restaurant"> Restaurant</label>
            <input type="text" name="restaurant" id="restaurant" class="form-control" value="<?= old('restaurant')?>">
        </div>   

        <label class="form-label" for="rating">Rating</label>
            <div class="range range-field">
                <input type="range" name ="rating" class="form-range range-field" min="0" max="5" step="1" id="rating" />
            </div>

        
        <div class="form-group">
            <label for="description"> Description </label>
            <input type="textarea" name="description" id="description" class="form-control" value="<?= old('description')?>">
        </div>

        <div class="form-group">
            <label for="stall_pic"> Attachments </label>
            <input type="file" name="stall_pic" id="stall_pic" class="form-control">
        </div>
            

        

        <button class="btn btn-light btn-outline-dark">Submit</button>
    </form>
    <br>
    <a href="<?= site_url("/review")?>"><button class="btn">Back to Main Page</button></a>
    </div>
    


<?= $this ->endSection() ?>