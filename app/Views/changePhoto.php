<?= $this->extend("layouts/default")?>

<?= $this->section("title")?>

    Change Photo

<?= $this ->endSection() ?>

<?= $this->section("content")?>

<div class="w-50 mx-auto mb-5">
<h1 class="my-5">Change <?= $review->username?>'s Review Photo</h1>

        <h2> Current Photo: </h2>

        <img src="<?= site_url("images/" . $review->stall_pic)?>" class="mb-5" style="width: 100%">

        <div class="border rounded p-5">

            <?= form_open_multipart("/review/updatePhoto/" .$review->id) ?>

                <h3> Change Photo To: </h3>

                <div class="form-group">
                    <label for="stall_pic"> Attachments </label>
                    <input type="file" name="stall_pic" id="stall_pic" class="form-control">
                </div>
                
                <button class="btn btn-light btn-outline-dark">Submit</button>
                
            </form>
        </div>

        

        

        


    </form>
</div>

<?= $this ->endSection() ?>