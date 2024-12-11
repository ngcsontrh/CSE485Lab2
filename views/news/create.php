<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a news</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <form action="index.php?controller=news&action=store" method = "POST" enctype="multipart/form-data">
        <label class="form-label" for = "title">Title:</label><br>
        <input class="form-control"  type = "text" name = "title" id = "title" require><br><br>
        <label class="form-label" for = "content">Content: </label><br>
        <textarea class="form-control" type = "text" name = "content" id = "content" require></textarea><br><br>
        <label class="form-label" for= "image">Image: </label><br>
        <input class="form-control"  type ="file" name = "image" id='image ' accept = "image/*" size="25" ><br><br> 
        <label class="form-label" for = "category">Category:</label><br>
        <input class="form-control"  type = "text" name = "category" id = "category" require><br><br>
        <button class="btn btn-primary" type ="submit">Add a news</button> 
        
    </form>
    <button type="submit" class="btn btn-primary my-3" name = "cancel"><a class="text-light" style = "text-decoration:none" href="view_flower_admin.php">Cancel</a></butto>

</body>
</html>