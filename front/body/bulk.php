<div class="px-4 py-3">
	<div class="row">
		<div class="col">
			<div class="card border-primary form-group" style="width: 35rem; height: 11rem">
				<div class="card-body">
					<h5 class="card-title">Массовое создание</h5>
                    <div class="input-group input-group-sm" style="width: 30rem;">
                        <select class="custom-select" id="bulk_type">
                            <option value="0" selected>Выбрать тип массового создания</option>
                            <option value="teachers">Преподаватели</option>
                            <option value="disciplines">Дисциплины</option>
                            <option value="courses_fgos_profstandards">Направления</option>
                            <option value="profstandards_otf_tf_activities">Трудовые функции</option>
                        </select>
                        <div class="input-group-append">
                            <button class="btn btn-primary btn-sm" id="get_template" type="button" disabled style="width: 9rem;">Получить шаблон</button>
                        </div>
                    </div>
                </div>
				<div class="card-footer btn-group" id="file_loader" hidden>
                    <form method="post" enctype="multipart/form-data">
                        <p class="btn-group" role="group" style="width: 30rem;">
                            <input type="file" name="userfile" accept=".xlsx" class="btn btn-secondary btn-sm">
                            <input type="submit" value="Загрузить" class="btn btn-success btn-sm">
                        </p>
                    </form>
                </div>
			</div>
		</div>	
	</div>
</div>
<form id="content_form" <?php echo ((isset($_FILES['userfile'])) ? '' : 'hidden');?> >
	<div class="px-4 py-3 bg-light">
        <div class="form-group">
            <?php require_once ($_SERVER['DOCUMENT_ROOT']."/back/uploader.php"); ?>
        </div>
    </div>
</form>	
<script>
    $(document).ready(function() {
        $("#bulk_type").change(function() {
            var bulk_type = $("#bulk_type").val();
            if (bulk_type == 0) {
                $('#get_template').prop('disabled', true);
                $('#file_loader').prop('hidden', true);
                $('#content_form').prop('hidden', true);
            } else {
                $('#get_template').prop('disabled', false);
                $('#file_loader').prop('hidden', false);
                $('#content_form').prop('hidden', false);
                $("#get_template").click( function() {
                    location.href = "../templates/bulk_templates/"+bulk_type+".xlsx";
                });
            };
        });
    });
</script>