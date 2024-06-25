<?php include __DIR__ . '/../partials/header.php'; ?>
<?php include __DIR__ . '/../partials/nav.php'; ?>

<div class="container mt-5">
  <h3 class="mb-4">Adicionar Usuário</h3>
  <form id="createUserForm" action="/users/store" method="post">
    <div class="row">
      <div class="col-6">
        <div class="form-group">
          <label for="name">Nome</label>
          <input name="name" type="text" class="form-control" id="name" placeholder="Nome do Usuário">
        </div>
      </div>
      <div class="col-6">
        <div class="form-group">
          <label for="email">Email</label>
          <input name="email" type="email" class="form-control" id="email" placeholder="Email do Usuário">
        </div>
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Adicionar</button>
  </form>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>
