<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Category</title>
</head>
<body>
    <div class ="container">
        <h3 class = "text-center text-primary my-3">Category</h3>
        <a class="bi bi-plus-square-fill">ADD</a>
        <a class="bi bi-plus-square-fill">Insert</a>
        <a class="bi bi-plus-square-fill">Delete</a>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
            </tr>
            </thead>
            <tbody>
            <?php
                foreach($category as $categories){
            ?>
            <tr>
                <th scope="row"><?= $categories->getID();?></th>
                <th scope="row"><?= $categories->getName();?></th>
            </tr>
            <?php
                }
            ?>

            </tbody>
        </table>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
