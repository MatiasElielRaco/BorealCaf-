<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BorealCafé - <?php echo $titulo; ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Elms+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/build/css/app.min.css">
</head>
<body class="dashboard">
    <?php 
        include_once __DIR__ .'/templates/admin-header.php';
    ?>
    
    <div class="dashboard__grid">
        <?php
            include_once __DIR__ .'/templates/admin-sidebar.php';  
        ?>

        <main class="dashboard__contenido">
            <?php 
                echo $contenido; 
            ?> 
        </main>
    </div>

    <script src="/build/js/app.min.js" defer></script>
</body>
</html>