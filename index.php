<?php include("functions/db.php");?><!-- Gives access to db.php -->
<?php include("functions/functions.php");?><!-- Gives access to functions.php -->


<!doctype html>
<html lang="sv">
    <head>
       <!-- Metatags that must come first -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.4/css/bootstrap.min.css" integrity="2hfp1SzUoho7/TsGGGDaFdsuuDL0LX2hnUp6VkX3CUQ2K4K+xjboZdsXyp4oUHZj" crossorigin="anonymous">
        <link rel="stylesheet" href="css/stylesheet.css">
        
        <title>Todolist</title>
        
    </head>
    <body>
        <main>
            <div class="flex-grid" id="heading">
                <div class="col">
                    <h1>To do list</h1>
                </div><!-- .col -->
            </div><!-- .flex-grid #heading -->
            <div class="flex-grid">
                <div class="col">
                    <?php deleteTask(); ?><!-- Gives access to function deleteTask -->
                    <?php completeTask() ?><!-- Gives access to function completeTask -->
                    <?php addTask() ?><!-- Gives access to function addTask -->
                </div><!-- .col -->
            </div><!-- .flex-grid -->
            <div class="flex-grid-meny">
                <div class="col textcol"><p>Sortera:</p></div><!-- .col .textcol -->
                <div class="col"><a href="index.php?sort=name">Namn</a></div><!-- .col -->
                <div class="col"><a href="index.php?sort=asc">Prioritet stigande</a></div><!-- .col -->
                <div class="col"><a href="index.php?sort=desc">Prioritet fallande</a></div><!-- .col -->
                <div class="col"><a href="index.php?sort=done">Klara</a></div><!-- .col -->
                <div class="col"><a href="index.php?sort=none">Original</a></div><!-- .col -->          
            </div><!-- .flex-grid-meny -->
            <div class="flex-grid">
                <div class="col"><?php displayTasks(); ?></div><!-- .col Gives access to function displayTask -->
            </div><!-- .flex-grid -->
            <div class="flex-grid">
                <div class="col">
                    <form method="post" action="index.php">
                        <input type="text" name="taskname">
                        <select name="prio">
                            <option value="0">Ingen prioritet</option>
                            <option value="1">Bråttom</option>
                            <option value="2">Jättebråttom</option>
                            <option value="3">Superbråttom</option>
                        </select>
                        <input type="submit" name="addtask" value="Lägg till">
                    </form>
                </div><!-- .col -->
            </div><!-- .flex-grid -->
            <div class="flex-grid">
                <div class="col"><?php displayToDo(); ?></div><!-- .col Gives access to function displayToDo -->
                <div class="col"><?php displayFinished(); ?></div><!-- .col Gives access to function displayFinished -->
            </div><!-- .flex-grid -->
        </main>
        
    
    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js" integrity="sha384-THPy051/pYDQGanwU6poAc/hOdQxjnOEXzbT+OuUAFqNqFjL+4IGLBgCJC3ZOShY" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.2.0/js/tether.min.js" integrity="sha384-Plbmg8JY28KFelvJVai01l8WyZzrYWG825m+cZ0eDDS1f7d/js6ikvy1+X+guPIB" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.4/js/bootstrap.min.js" integrity="VjEeINv9OSwtWFLAtmc4JCtEJXXBub00gtSnszmspDLCtC0I4z4nqz7rEFbIZLLU" crossorigin="anonymous"></script>
    </body>
</html>



