<!DOCTYPE html>
<html>
    <head>
        <title>
            <?= isset($title) ? h($title): 'Agenda electronique' ; ?>
        </title>
        <meta charset="utf-8"/>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" 
        rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" 
        crossorigin="anonymous">

        <link rel="stylesheet" href="css/calendar.css">

    </head>

    <body>
        
    <nav class="navbar navbardark bg-primary mb-3">
        <a href="/index.php" class="navbar-brand">Agenda</a>
    </nav>