<?php
// connect to db
require_once 'database.php';
$conn = db_connect();

//if statement this gameid is fetched ia GET then display with a confirmation page
if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    $id = filter_var($_GET['game_id'], FILTER_SANITIZE_NUMBER_INT);

    $sql = "SELECT * FROM games WHERE game_id = " . $id;
    $game = db_queryOne($sql, $conn);

    $title = $game['title'];
    $year = $game['year'];
    $genre = $game['genre'];
    $url = $game['url'];

    include_once 'shared/top.php';
?>

//html form
<h1 class="text-center mt-5 display-1 text-warning"><i class="bi bi-x-circle"></i></h1>
<h1 class="text-center mt-5">Are you sure you want to delete this?</h1>

<div class="row mt-5 justify-content-center">
    <form class="col-6 mb-5" action="game-delete.php" method="POST">
        <div class="row mb-4">
            <label class="col-2 col-form-label fs-4" for="title">Title</label>
            <div class="col-10">
            <input readonly class="form-control form-control-lg" type="text" name="title" value="<?php echo $title; ?>">
            </div>
        </div>

        <div class="row mb-4">
            <label class="col-2 col-form-label fs-4" for="year">Year</label>
            <div class="col-10">
                <input readonly class="form-control form-control-lg" type="text" name="year" value="<?php echo $year; ?>">
            </div>
        </div>

        <div class="row mb-4">
            <label class="col-2 col-form-label fs-4" for="genre">Genre</label>
            <div class="col-10">
                <input readonly class="form-control form-control-lg" type="text" name="genre" value="<?php echo $genre; ?>">
            </div>
        </div>

        <div class="row mb-4">
            <label class="col-2 col-form-label fs-4" for="url">URL</label>
            <div class="col-10">
                <input readonly class="form-control form-control-lg" type="text" name="url" value="<?php echo $url; ?>">
            </div>
        </div>

        <div class="d-grid">
        <input readonly class="form-control form-control-lg" type="hidden" name="game_id" value="<?php echo $id; ?>">
            <button class="btn btn-danger btn-lg">Delete Forever</button>
        </div>
    </form>
</div>
<?php
}
//elseif statement this gameid is fetched via POST then delete
else if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $id = filter_var($_POST['game_id'], FILTER_SANITIZE_NUMBER_INT);
    echo "id is $id";
    $sql = "DELETE FROM games WHERE game_id=" .$id;

    $cmd = $conn->prepare($sql);
    $cmd -> execute();

    header("Location: games.php");
}

?>