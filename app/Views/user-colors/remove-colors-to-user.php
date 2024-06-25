<?php include __DIR__ . '/../partials/header.php' ?>
<?php include __DIR__ . '/../partials/nav.php' ?>

<div class="container mt-5">
    <h2 class="mb-4">Cores Vinculadas ao Usuário <?php echo htmlspecialchars($user->getName()); ?> </h2>
    <table class="table table-bordered table-hover">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>ID</th>
                <th>Nome</th>
                <th class="col-1">Ações</th>
            </tr>
        </thead>

        <tbody>
            <?php if (!empty($colors) && is_array($colors)) : ?>
                <?php $counter = 1; ?>
                <?php foreach ($colors as $color) : ?>
                    <tr>
                        <td><?php echo $counter++; ?></td>
                        <td><?php echo htmlspecialchars($color['color_id']); ?></td>
                        <td><?php echo htmlspecialchars($color['name']); ?></td>
                        <td class="col-1">
                            <div class="btn-group" role="group">
                                <a href="#" class="btn btn-danger btn-sm delete-user-color" data-user-id="<?php echo htmlspecialchars($color['user_id']); ?>" data-color-id="<?php echo htmlspecialchars($color['color_id']); ?>">Excluir</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="4" class="text-center">Nenhuma cor associada ao usuário.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include __DIR__ . '/../partials/footer.php' ?>
