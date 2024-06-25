<?php include __DIR__ . '/../partials/header.php'; ?>
<?php include __DIR__ . '/../partials/nav.php'; ?>

<div class="container mt-5">
  <h2 class="mb-4">Editar Cor</h2>
  <form id="editColorForm" action="/colors/update/<?php echo htmlspecialchars($color->getId()); ?>" method="post">

    <div class="row">

      <div class="col-6">
        <div class="form-group">
          <label for="name">Nome</label>
          <input name="name" type="text" class="form-control" id="name" placeholder="Nome da Cor" value="<?php echo htmlspecialchars($color->getName()); ?>">
        </div>
      </div>

    </div>
    <button type="submit" class="btn btn-primary">Atualizar</button>
  </form>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>
