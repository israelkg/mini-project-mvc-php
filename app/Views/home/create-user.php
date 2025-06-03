<h1><?php echo htmlspecialchars($title ?? 'Cadastrar Novo Usuário'); ?></h1>

<?php
    if (!empty($errors)) {
        echo '<div style="color: red; border: 1px solid red; padding: 10px; margin-bottom: 15px; background-color: #ffe6e6;">';
        echo '<strong>Erros no Formulário:</strong>';
        echo '<ul>';
        foreach ($errors as $error) {
            echo '<li>' . htmlspecialchars($error) . '</li>';
        }
        echo '</ul>';
        echo '</div>';
    }

    if (!empty($successMessage)) {
        echo '<div style="color: green; border: 1px solid green; padding: 10px; margin-bottom: 15px; background-color: #e6ffe6;">';
        echo '<strong>Sucesso:</strong> ' . htmlspecialchars($successMessage);
        echo '</div>';
    }
?>

<form action="<?php echo htmlspecialchars($basePath); ?>/users/create" method="POST">
    <div>
        <div class="campos">
            <label for="name">Nome:</label><br>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($old['name'] ?? ''); ?>" required><br>
        </div>

        <div class="campos">
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($old['email'] ?? ''); ?>" required><br>
        </div>

        <div class="campos">
            <label for="role">Cargo:</label><br>
            <select id="role" name="role" required>
                <option value="">-- Selecione um cargo --</option>
                <option value="user" <?php echo (isset($old['role']) && $old['role'] === 'user') ? 'selected' : ''; ?>>Usuário</option>
                <option value="editor" <?php echo (isset($old['role']) && $old['role'] === 'editor') ? 'selected' : ''; ?>>Editor</option>
                <option value="admin" <?php echo (isset($old['role']) && $old['role'] === 'admin') ? 'selected' : ''; ?>>Administrador</option>
            </select><br>
        </div>
    </div>
    <br>
    <button type="submit" style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">Cadastrar Usuário</button>
</form>

<p><a href="<?php echo htmlspecialchars($basePath); ?>/users">Voltar para a Lista de Usuários</a></p>
<p><a href="<?php echo htmlspecialchars($basePath); ?>/">Voltar para a Página Inicial</a></p>