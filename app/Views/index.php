<?= $this->extend("layouts/default")?>

<?= $this->section("title")?>

    Customer Reviews

<?= $this ->endSection() ?>

<?= $this->section("content")?>

    <div class="w-75 mx-auto">
    <h1 class="my-5">Customer Reviews</h1>
        <div class="row justify-content-center">

        <div class="mb-5">
            <label for="query" class="mx-5 float-right">
                <div class="form-outline">
                    <input type="search" id="query" class="form-control" name="query" placeholder="Search" aria-label="Search" />
                    <i class="fa-solid fa-magnifying-glass float-right mr-2" style="position:relative; top:-25px;"></i>
                </div>
            </label>
        </div>
        
        <div class="message" style="display: none;">
            <h2>No Result Found.</h2>
        </div>
        
        <?php foreach($results as $result): ?>
            
            
        <div class="col-3 border rounded m-3 py-2 px-3 hover-shadow review-card">
            

            <a href="<?= site_url('/review/show/' . $result->id)?>" class="text-dark text-decoration-none">
            <div class="row">
                <div class="col-5 border-right border-secondary d-flex align-items-center">
                    <img src="<?= site_url('/images/' . $result->stall_pic) ?> " alt="A Review Photo" class=" img-fluid rounded border" style="">
                </div>
            
                <div class="col-7">
                    <h1 class="text-truncate display-6 restaurant"><?= esc($result->restaurant) ?></h1>
                    <h4><?= $result->rating ?> <i class="fa-solid fa-star"></i></h4>
                    <h5 class="text-truncate desc"><?= esc($result->description) ?></h5>

                    <p class="lead">By <?= esc($result->username) ?></p>
                </div>
            </div>
            </a>
                
            
        </div>
        
        <?php endforeach ?>
        
            

        </div>
    </div>

    
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
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

    <script>
        $(document).ready(function(){
            

            $("#query").keyup(function(){

                var i = 0;
                var msg = document.querySelectorAll(".message");

                
                var query = document.getElementById("query").value;
                const filter = query.toLowerCase();
                const listItem = document.querySelectorAll(".review-card");

                
                
                listItem.forEach((item) => {
                    let text = item.textContent;
                    if(text.toLowerCase().includes(filter.toLowerCase())){
                        item.style.display ="";
                        
                    } else {
                        item.style.display ="none";
                        i++;
                    }
                });

                var count = $('div.review-card:hidden').length;
                var div_count = $('div.review-card').length;
                
                if(div_count == count) {
                    msg[0].style.display="";
                } else {
                    msg[0].style.display="none";
                }

              
            });
        })

    </script>

    
<?= $this ->endSection() ?>