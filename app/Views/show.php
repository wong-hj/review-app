<?= $this->extend("layouts/default")?>

<?= $this->section("title")?>

    Show Review

<?= $this ->endSection() ?>

<?= $this->section("content")?>

<div class="w-50 mx-auto mb-5">
<h1 class="my-5"><?= $review->username?>'s Review</h1>

        <img src="<?= site_url("images/" . $review->stall_pic)?>" alt="A Review Photo" class="mb-5 rounded" style="width: 100%">

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

            <p class="text-muted">Created at: <?= $review->created_at?></p>
            <p class="text-muted">Updated at: <?= $review->updated_at?></p>



            <a href="<?= site_url("/review/edit/" . $review->id)?>"><button class="btn mb-3"><i class="fa-solid fa-pen-to-square"></i> Edit</button></a><br>

            

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa-solid fa-trash-can"></i>
            Delete
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="exampleModalLongTitle">Delete Review</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Confirm Delete <?= $review->username ?> Record?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    <?= form_open("/review/delete/" . $review->id) ?>

                        <button class="btn btn-danger">Confirm Delete</button>

                    </form>
                </div>
                </div>
            </div>
            </div>

            <a href="<?= site_url("/review/index")?>"><button class="btn float-right">Back to Main Page</button></a>

        </div>

    </form>
</div>

<?= $this ->endSection() ?>