<?= $this->extend("layouts/default")?>

<?= $this->section("title")?>

    Show Review

<?= $this ->endSection() ?>

<?= $this->section("content")?>

<div class="w-50 mx-auto mb-5">
<h1 class="my-5"><?= $review->username?>'s Review</h1>

        <img src="<?= site_url("images/" . $review->stall_pic)?>" class="mb-5" style="width: 100%">

        <div class="border rounded p-5">

            <h1><i class="fa-solid fa-utensils"></i> <?= $review->restaurant ?></h1>
            
            <h3>
                <?= $review->rating?> 
                <?php 
                for($i=0; $i < $review->rating; $i++){ echo '<i class="fa-solid fa-star"></i>'; } ?>
            </h3>
            <br>
            <h4>Review:</h4>
            <h4><?= $review->description ?></h4>

            <h6 class="my-5">Reviewed by <?=$review->username ?></h6>

            <a href="<?= site_url("/review/edit/" . $review->id)?>"><button class="btn mb-3">Edit</button></a>

            <?= form_open("/review/delete/" . $review->id) ?>

                <button class="btn btn-danger">Delete</button></a>

            </form>
        </div>

    </form>
</div>

<?= $this ->endSection() ?>