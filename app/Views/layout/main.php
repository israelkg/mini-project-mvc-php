<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'Meu Projeto MVC'; ?></title>

    <style>
        body { font-family: 'Arial', sans-serif; margin: 0; padding: 0; background-color: #f4f4f4; color: #333; }
        header { background-color: #333; color: #fff; padding: 10px 20px; text-align: center; }
        nav { margin-top: 10px; }
        nav a { color: #fff; text-decoration: none; margin: 0 15px; font-weight: bold; }
        nav a:hover { text-decoration: underline; }
        main { padding: 20px; max-width: 800px; margin: 20px auto; background-color: #fff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        footer { text-align: center; padding: 10px; margin-top: 20px; background-color: #eee; color: #666; }
        h1 { color: #0056b3; }
    </style>

</head>
<body>
    <header>
        <h1>Meu Projeto MVC</h1>
        <nav>
            <a href="<?php echo $basePath; ?>/">Home</a>          
            <a href="<?php echo $basePath; ?>/about">Sobre Nós</a> 
            <a href="<?php echo $basePath; ?>/users">Usuários</a> 
            <a href="<?php echo $basePath; ?>/users/create">Cadastrar Usuário</a>
        </nav>
    </header>
    <main>
        <!--  variável $content contém todo o HTML gerado pela View específica 
          sim(home/index.php ou home/about.php) que o Router capturou usando ob_start() e ob_get_clean() -->
        <?php echo $content;?>
    </main>
    <footer>
        <p>&copy; <?php echo date('Y'); ?> Meu Projeto MVC. Todos os direitos reservados.</p>
    </footer>

</body>
</html>