<div class="container">
    <div class="row mt-4">
        <div class="col-md-3">
            <label for="user-select">Usuários</label>
            <select id="user-select" class="form-control select2">
                <option value="all">Todos</option>
                <?php foreach ($users as $user) : ?>
                    <option value="<?= $user['id'] ?>"><?= htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8') ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-3">
            <label for="colors-select">Cores</label>
            <select id="colors-select" class="form-control select2">
                <option value="all">Todas</option>
                <?php foreach ($colors as $color) : ?>
                    <option value="<?= $color['id'] ?>"><?= htmlspecialchars($color['name'], ENT_QUOTES, 'UTF-8') ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-3">
            <button id="filter-btn" class="btn btn-primary mt-4">Filtrar</button>
        </div>
    </div>
</div>
