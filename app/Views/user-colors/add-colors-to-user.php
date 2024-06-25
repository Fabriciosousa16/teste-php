<?php include __DIR__ . '/../partials/header.php'; ?>
<?php include __DIR__ . '/../partials/nav.php'; ?>

<div class="container mt-5">
  <div class="row">
    <div class="col-md-6">
      <form id="linkUserColorByIdForm" action="/users-colors/store-colors-to-user/<?php echo htmlspecialchars($user->getId()); ?>" method="POST">

        <div class="row">
          <div class="col-6">
            <div class="form-group">
              <label for="userName">Nome do Usuário</label>
              <input type="text" class="form-control" id="userName" name="userName" value="<?php echo htmlspecialchars($user->getName()); ?>" disabled>
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

    const userId = <?php echo json_encode($user->getId()); ?>;
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
</script>
