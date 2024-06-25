<?php include __DIR__ . '/../partials/header.php'; ?>
<?php include __DIR__ . '/../partials/nav.php'; ?>
<?php include __DIR__ . '/../partials/filter.php'; ?>

<div class="container custom-container mt-5">
    <table class="table table-hover">
        <thead class="thead-light">
            <tr>
                <th>Nome do Usuário</th>
                <th>Cores Vinculadas</th>
            </tr>
        </thead>
        <tbody id="results-table">
        </tbody>
    </table>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>

<script>
    $(document).ready(function() {
        $('.select2').select2();

        $('#filter-btn').click(function() {
            const userId = $('#user-select').val();
            const colorId = $('#colors-select').val();

            $.ajax({
                url: '/reports/filter',
                method: 'POST',
                data: {
                    user_id: userId,
                    color_id: colorId
                },
                success: function(data) {
                    const results = JSON.parse(data);
                    let tableRows = '';
                    if (results.length > 0) {
                        results.forEach(function(result) {
                            tableRows += `<tr>
                            <td>${result.user_name}</td>
                            <td>${result.color_name}</td>
                        </tr>`;
                        });
                    } else {
                        tableRows = '<tr><td class="text-center" colspan="2">Nenhum dado encontrado</td></tr>';
                    }
                    $('#results-table').html(tableRows);
                },
                error: function() {
                    const errorMessage = '<tr><td class="text-center" colspan="2">Erro ao buscar dados</td></tr>';
                    $('#results-table').html(errorMessage);
                }
            });
        });
    });
</script>
