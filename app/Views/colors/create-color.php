<?php include __DIR__ . '/../partials/header.php'; ?>
<?php include __DIR__ . '/../partials/nav.php'; ?>

<div class="container mt-5">
  <h3 class="mb-4">Adicionar Cor</h3>
  <form id="createColorForm" action="/colors/store" method="post">

    <div class="row">

      <div class="col-6">
        <div class="form-group">
          <label for="name">Nome</label>
          <input name="name" type="text" class="form-control" id="name" placeholder="Nome da Cor">
        </div>
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Cadastrar</button>
  </form>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>
