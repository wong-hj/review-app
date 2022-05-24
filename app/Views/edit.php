<?= $this->extend("layouts/default")?>

<?= $this->section("title")?>

    Edit Review

<?= $this ->endSection() ?>

<?= $this->section("content")?>

<div class="w-50 mx-auto">
<h1 class="my-5">Edit <?= $review->username?>'s Review on <?= $review->restaurant?></h1>

<?= form_open("/review/update/" . $review->id) ?>


        <?php if (session()->has('errors')): ?>
            <ul>
                <?php foreach(session('errors') as $error): ?>
                    <li class="text-danger"><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif ?>

        <div class="form-group">
            <label for="username" > Name</label>
            <input type="text" name="username" id="username" class="form-control" value="<?= old('username', esc($review->username)) ?>">
        </div>   

        <div class="form-group">
            <label for="restaurant"> Restaurant</label>
            <input type="text" name="restaurant" id="restaurant" class="form-control" value="<?= old('restaurant', esc($review->restaurant))?>">
        </div>   

        <label class="form-label" for="rating">Rating</label>
            <div class="range range-field">
                <input type="range" name="rating" class="form-range range-field" min="0" max="5" step="1" id="rating" value ="<?= old('rating', esc($review->rating))?>"/>
            </div>

        
        <div class="form-group">
            <label for="description"> Description </label>
            <input type="textarea" name="description" id="description" class="form-control" value="<?= old('description', esc($review->description))?>">
        </div>

        <!-- <div class="form-group">
            <label for="stall_pic"> Attachments </label>
            <input type="file" name="stall_pic" id="stall_pic" class="form-control">
        </div> -->
            

        

        <button class="btn btn-light btn-outline-dark my-2">Submit</button>

        
        

    

    </form>
    <a href="<?= site_url("/review/changePhoto/" . $review->id)?>"><button class="btn btn-light btn-outline-dark">Change Photo</button></a>

    </div>


<?= $this ->endSection() ?>