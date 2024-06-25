<?php include __DIR__ . '/../partials/header.php' ?>
<?php include __DIR__ . '/../partials/nav.php' ?>

<div class="container custom-container mt-5">
  <h2 class="mb-4">Cores</h2>
  <table class="table table-bordered table-hover">
    <thead class="thead-light">
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th class="col-1">Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($colors) && is_array($colors)) : ?>
        <?php foreach ($colors as $color) : ?>
          <?php if (is_object($color)) : ?>
            <tr>
              <td><?php echo htmlspecialchars($color->getId()); ?></td>
              <td><?php echo htmlspecialchars($color->getName()); ?></td>
              <td class="col-1">
                <div class="btn-group" role="group">
                  <a href='/colors/edit/<?php echo htmlspecialchars($color->getId()); ?>' class='btn btn-warning btn-sm mr-1'>Editar</a>
                  <a href='#' class='btn btn-danger btn-sm mr-1 delete-color' data-id='<?php echo htmlspecialchars($color->getId()); ?>'>Excluir</a>
                </div>
              </td>
            </tr>
          <?php endif; ?>
        <?php endforeach; ?>
      <?php else : ?>
        <tr>
          <td colspan="4" class="text-center">Nenhuma Cor Cadastrada.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>

</div>

<?php include __DIR__ . '/../partials/footer.php' ?>
