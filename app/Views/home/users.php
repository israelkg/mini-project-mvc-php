<h1><?php echo $title; ?></h1>

<?php if (empty($users)): ?>
    <p>Nenhum usuário encontrado.</p>
<?php else: ?>
    <h2>Usuários Cadastrados:</h2>
    <ul>
        <?php foreach ($users as $user): ?>
            <li>
                <strong>ID:</strong> <?php echo htmlspecialchars($user['id']); ?><br>
                <strong>Nome:</strong> <?php echo htmlspecialchars($user['name']); ?><br>
                <strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?><br>
                <strong>Cargo:</strong> <?php echo htmlspecialchars($user['role']); ?>
                <hr>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<p><a href="<?php echo $basePath; ?>/">Voltar para a Página Inicial</a></p> <p><a href="<?php echo $basePath; ?>/users/create">Cadastrar Novo Usuário</a></p> ```