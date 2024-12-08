<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News detail</title>
</head>
<body>
    <h1><?=$news[0]->getTitle()?></h1>
    <p><?=$news[0]->getContent()?></p>
    <img style ="width:500px;" src="/CSE485Lab2/images/<?=$news[0]->getImage()?>">
    <p>Category: <?=$news[0]->getCategoryName()?></p>
    <p>Created at: <?=$news[0]->getCreatedAt()?></p>
</body>
</html>