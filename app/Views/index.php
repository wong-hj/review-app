<?= $this->extend("layouts/default")?>

<?= $this->section("title")?>

    Customer Reviews

<?= $this ->endSection() ?>

<?= $this->section("content")?>

    <div class="w-75 mx-auto">
    <h1 class="my-5">Customer Reviews</h1>
        <div class="row justify-content-center">

        <div class="mb-5">
            <label for="query" class="mx-5 rounded border float-right">
                <input type="query" id="query" name="query" placeholder="Search" >
            </label>
        </div>
        
            <?php foreach($results as $result): ?>
            <div class="col-3 border border-secondary rounded m-3 p-2">
                

                <a href="<?= site_url('/review/show/' . $result->id)?>" class="text-dark text-decoration-none">
                <div class="row">
                    <div class="col-5 border-right border-secondary">
                        <img src="<?= site_url('/images/' . $result->stall_pic) ?> " class="mt-4 img-fluid" style="">
                    </div>
                
                    <div class="col-7">
                        <h3 class="text-truncate"><?= esc($result->restaurant) ?></h3>
                        <h4><?= $result->rating ?> <i class="fa-solid fa-star"></i></h4>
                        <h5 class="text-truncate"><?= esc($result->description) ?></h5>

                        <p>By <?= esc($result->username) ?></p>
                    </div>
                </div>
                </a>
                    
                
            </div>
            <?php endforeach ?>
            

        </div>
    </div>

    <script src="<?= site_url("/js/auto-complete.min.js")?>"></script>

    <script>
        var searchUrl = "<?= site_url('/review/search?q=')?>";
        var showUrl = "<?= site_url('/review/show/')?>";
        
        var data;
        var i;


        var searchAutoComplete = new autoComplete({
            selector: 'input[name="query"]',
            cache: false,
            source: function(term, response){

                var request = new XMLHttpRequest();

                request.open('GET', searchUrl + term, true);

                request.onload = function() {

                    data = JSON.parse(this.response);

                    i = 0;

                    var suggestions = data.map(review => review.restaurant);

                    response(suggestions);

                };

                request.send();

            },
            renderItem: function (item, search) {

                var id = data[i].id;

                i++;

                return "<div class='autocomplete-suggestion' data-id='" + id + "'>" + item + "</div>";
            },
            onSelect: function(e, term, item){

                window.location.href = showUrl + item.getAttribute('data-id');
            }
        });
        
    </script>

<?= $this ->endSection() ?>