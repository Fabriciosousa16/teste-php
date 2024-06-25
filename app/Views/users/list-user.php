<?php include __DIR__ . '/../partials/header.php'; ?>
<?php include __DIR__ . '/../partials/nav.php'; ?>

<div class="container custom-container mt-5">
  <h2 class="mb-4">Usuários</h2>
  <table class="table table-bordered table-hover">
    <thead class="thead-light">
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>E-Mail</th>
        <th class="col-3">Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($users) && is_array($users)) : ?>
        <?php foreach ($users as $user) : ?>
          <?php if (is_object($user)) : ?>
            <tr>
              <td><?php echo htmlspecialchars($user->getId()); ?></td>
              <td><?php echo htmlspecialchars($user->getName()); ?></td>
              <td><?php echo htmlspecialchars($user->getEmail()); ?></td>
              <td class="col-3">
                <div class="btn-group" role="group">

                  <a href='/users-colors/add-colors-to-user/<?php echo htmlspecialchars($user->getId()); ?>' class='btn btn-success btn-sm mr-1'>Vincular</a>
                  <a href='/users-colors/remove-colors/<?php echo htmlspecialchars($user->getId()); ?>' class='btn btn-primary btn-sm mr-1'>Desvincular</a>
                  <a href='/users/edit/<?php echo htmlspecialchars($user->getId()); ?>' class='btn btn-warning btn-sm mr-1'>Editar</a>
                  <a href='#' class='btn btn-danger btn-sm mr-1 delete-user' data-id='<?php echo htmlspecialchars($user->getId()); ?>'>Excluir</a>

                </div>
              </td>
            </tr>
          <?php endif; ?>
        <?php endforeach; ?>
      <?php else : ?>
        <tr>
          <td colspan="4" class="text-center">Nenhum Usuário Cadastrado.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>
