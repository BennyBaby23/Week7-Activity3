<?php
// connect to db
require_once 'database.php';
$conn = db_connect();
?>

<?php
include_once 'shared/top.php';

// build a sql query
$sql = "SELECT * FROM games";
$games = db_queryAll($sql, $conn);
?>

<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Title</th>
            <th scope="col">Year</th>
            <th scope="col">Genre</th>
            <th scope="col" class="col-1">URL</th>
            <th scope="col" class="col-1">Edit</th>
            <th scope="col" class="col-1">Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($games as $game) { ?>
        <tr>
            <th scope="row"><?php echo $game['title']; ?></th>
            <td><?php echo $game['year']; ?></td>
            <td><?php echo $game['genre']; ?></td>
            <td><a class="btn btn-primary" target="_blank" href="<?php echo $game['url']; ?>"> Play <i
                        class="bi bi-box-arrow-up-right"></i></a>
            </td>
            <td><a href="game-edit.php?game_id=<?php echo $game['game_id']; ?>" class="btn btn-secondary">Edit <i class="bi bi-pencil-square"></i></a>
            </td>
            <td>
                <a href="game-delete.php?game_id=<?php echo $game['game_id']; ?>" class="btn btn-warning"><span class="visually-hidden">Delete </span><i class="bi bi-trash"></i></a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<?php

include_once 'shared/footer.php';
?>