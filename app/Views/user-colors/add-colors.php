<?php include __DIR__ . '/../partials/header.php'; ?>
<?php include __DIR__ . '/../partials/nav.php'; ?>

<div class="container mt-5">
  <div class="row">
    <div class="col-md-6">
      <form id="linkUserColorForm" action="/users-colors/store-add-colors" method="POST">

        <div class="row">
          <div class="col-6">
            <div class="form-group">
              <label for="users">Usuários</label>
              <select class="form-control select2" id="users" name="users">
                <option value="" selected disabled>Selecione um usuário</option>
                <?php foreach ($users as $user) : ?>
                  <option value="<?php echo htmlspecialchars($user->getId()); ?>"><?php echo htmlspecialchars($user->getName()); ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <div class="col-6">
            <div class="form-group">
              <label for="colors">Cores</label>
              <select class="form-control select2" id="colors" name="colors[]" multiple="multiple">
                <?php foreach ($colors as $color) : ?>
                  <option value="<?php echo htmlspecialchars($color->getId()); ?>"><?php echo htmlspecialchars($color->getName()); ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
        </div>

        <button type="submit" class="btn btn-primary">Vincular</button>
      </form>
    </div>
  </div>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>

<script>
  $(document).ready(function() {
    $('.select2').select2();

    $('#users').change(function() {
      const userId = $(this).val();
      const userColors = <?php echo json_encode($userColors); ?>;
      console.log('User ID:', userId);
      console.log('User Colors:', userColors);

      $('#colors option').each(function() {
        $(this).prop('disabled', false);
        const colorId = $(this).val();
        if (userColors[userId] && userColors[userId].includes(colorId)) {
          console.log('Disabling color ID:', colorId);
          $(this).prop('disabled', true);
        }
      });

      $('#colors').select2();
    });
  });
</script>
