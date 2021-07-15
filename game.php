<?php

include_once 'shared/top.php';

?>


<h1 class="text-center mt-5">Add New Game <i class="bi bi-joystick"></i></h1>

<div class="row mt-5 justify-content-center">
    <form class="col-6 mb-5" action="save-game.php" method="POST" novalidate>
        <div class="row mb-4">
            <label class="col-2 col-form-label fs-4" for="title">Title</label>
            <div class="col-10">
                <input class="form-control form-control-lg" type="text" name="title">
            </div>
        </div>

        <div class="row mb-4">
            <label class="col-2 col-form-label fs-4" for="year">Year</label>
            <div class="col-10">
                <input class="form-control form-control-lg" type="text" name="year">
            </div>
        </div>

        <div class="row mb-4">
            <label class="col-2 col-form-label fs-4" for="genre">Genre</label>
            <div class="col-10">
                <select name="genre" id="" class="form-select form-select-lg">
                    <option value="action">Action</option>
                    <option value="racing">Racing</option>
                    <option value="puzzle">Puzzle</option>
                </select>
            </div>
        </div>

        <div class="row mb-4">
            <label class="col-2 col-form-label fs-4" for="url">URL</label>
            <div class="col-10">
                <input class="form-control form-control-lg" type="text" name="url">
            </div>
        </div>

        <div class="d-grid">
            <button class="btn btn-success btn-lg">Submit</button>
        </div>
    </form>
</div>

  
<?php

include_once 'shared/footer.php';

?>