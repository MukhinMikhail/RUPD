<?php require_once($_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/back/base.php");
?>
<div class="px-4 py-3" <?php echo ((isset($_FILES['userfile'])) ? 'hidden' : ''); ?>>
    <div class="row">
        <div class="col">
            <div class="card border-primary form-group" style="width: 35rem;">
                <div class="card-body">
                    <h5 class="card-title">Массовое создание</h5>
                    <div class="input-group input-group-sm" style="width: 30rem;">
                        <select class="custom-select" id="bulk_type">
                            <option value="0" class="d-none">Выбрать тип массового создания</option>
                            <option value="teachers">Преподаватели</option>
                            <option value="disciplines">Дисциплины</option>
                            <option value="courses_fgos_profstandards">Направления</option>
                            <option value="profstandards_otf_tf_activities">Трудовые функции</option>
                        </select>
                        <!-- <div class="input-group-append">
                            <button class="btn btn-primary btn-sm" id="get_template" type="button" disabled style="width: 9rem;">Получить шаблон</button>
                        </div> -->
                    </div>
                </div>
                <div class="added-props card-body">
                    <form id="teachers" class="select_field d-none">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="teachers_name">Имя</label>
                            </div>
                            <input type="text" class="form-control" data-name="Имя" id="teachers_name">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="teachers_lastname">Фамилия</label>
                            </div>
                            <input type="text" id="teachers_lastname" data-name="Фамилия" class="form-control">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="teachers_patronymic">Отчество</label>
                            </div>
                            <input type="text" id="teachers_patronymic" data-name="Отчество" class="form-control">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="teachers_email">E-mail</label>
                            </div>
                            <input type="text" id="teachers_email" data-name="E-mail" class="form-control">
                        </div>
                        <?php
                        connect();
                        global $link;

                        $result = mysqli_query($link, "SELECT * FROM academic_ranks");

                        $select = '<div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <label class="input-group-text" for="teachers_rank">Научное звание</label>
                        </div>
                        <select class="custom-select" data-name="Научное звание" id="teachers_rank">
                        <option class="d-none" selected>Выберите...</option>';
                        for ($c = 0; $c < mysqli_num_rows($result); $c++) {
                            $array = mysqli_fetch_array($result);
                            $select .= '<option value="' . $array['full_name'] . '">' . $array['full_name'] . '</option>';
                        }
                        $select .= '</select>
                        </div>';

                        echo $select;

                        close();
                        ?>
                        <?php
                        connect();
                        global $link;

                        $result = mysqli_query($link, "SELECT * FROM academic_degrees");

                        $select = '<div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <label class="input-group-text" for="teachers_degree">Научная степень</label>
                        </div><select class="custom-select" data-name="Научная степень" id="teachers_degree">
                        <option class="d-none" selected>Выберите...</option>';
                        for ($c = 0; $c < mysqli_num_rows($result); $c++) {
                            $array = mysqli_fetch_array($result);
                            $select .= '<option value="' . $array['short_name'] . '">' . $array['full_name'] . '</option>';
                        }
                        $select .= '</select>
                        </div>';

                        echo $select;

                        close();
                        ?>
                        <?php
                        connect();
                        global $link;

                        $result = mysqli_query($link, "SELECT * FROM positions");

                        $select = '<div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <label class="input-group-text" for="teachers_post">Должность</label>
                        </div>
                        <select class="custom-select" data-name="Должность" id="teachers_post">
                        <option class="d-none" selected>Выберите...</option>';
                        for ($c = 0; $c < mysqli_num_rows($result); $c++) {
                            $array = mysqli_fetch_array($result);
                            $select .= '<option value="' . $array['name'] . '">' . $array['name'] . '</option>';
                        }
                        $select .= '</select>
                        </div>';

                        echo $select;

                        close();
                        ?>
                        <button class="btn btn-primary" id="teachers_append" type="submit">Отправить</button>
                    </form>
                    <form id="disciplines" class="select_field d-none">
                        <?php
                        connect();
                        global $link;

                        $result = mysqli_query($link, "SELECT * FROM institutes");

                        $select = '<div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <label class="input-group-text" for="disciplines_institute">Институт</label>
                        </div>
                        <select class="custom-select" data-name="Институт" id="disciplines_institute">
                        <option class="d-none" selected>Выберите...</option>';
                        for ($c = 0; $c < mysqli_num_rows($result); $c++) {
                            $array = mysqli_fetch_array($result);
                            $select .= '<option value="' . $array['institute_id'] . '">' . $array['name'] . '</option>';
                        }
                        $select .= '</select>
                        </div>';

                        echo $select;

                        close();
                        ?>

                        <?php
                        connect();
                        global $link;

                        $result = mysqli_query($link, "SELECT * FROM  pulpits");

                        $select = '<div class="input-group mb-3 disciplines_pulpit">
                        <div class="input-group-prepend">
                          <label class="input-group-text" for="disciplines_pulpit">Кафедра</label>
                        </div>
                        <select class="custom-select" disabled data-name="Кафедра" id="disciplines_pulpit">
                        <option class="d-none" selected>Выберите...</option>';
                        for ($c = 0; $c < mysqli_num_rows($result); $c++) {
                            $array = mysqli_fetch_array($result);
                            $select .= '<option class="d-none" data-institute="' . $array['institute_id'] . '" value="' . $array['name'] . '">' . $array['name'] . '</option>';
                        }
                        $select .= '</select>
                        </div>';

                        echo $select;

                        close();
                        ?>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="disciplines_name">Название дисциплины</label>
                            </div>
                            <input type="text" id="disciplines_name" data-name="Название дисциплины" class="form-control">
                        </div>

                        <?php
                        connect();
                        global $link;

                        $result = mysqli_query($link, "SELECT * FROM  parts");

                        $select = '<div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <label class="input-group-text" for="disciplines_part">Место в образовательной системе</label>
                        </div>
                        <select class="custom-select" data-name="Место в образовательной системе" id="disciplines_part">
                        <option class="d-none" selected>Выберите...</option>';
                        for ($c = 0; $c < mysqli_num_rows($result); $c++) {
                            $array = mysqli_fetch_array($result);
                            $select .= '<option value="' . $array['part_id'] . '">' . $array['name'] . '</option>';
                        }
                        $select .= '</select>
                        </div>';

                        echo $select;

                        close();
                        ?>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="disciplines_index">Индекс</label>
                            </div>
                            <input type="text" id="disciplines_index" data-name="Индекс" class="form-control">
                        </div>

                        <!-- <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="disciplines_module">Модуль</label>
                            </div>
                            <input type="text" id="disciplines_module" data-name="Модуль" class="form-control">
                        </div> -->

                        <?php
                        connect();
                        global $link;

                        $result = mysqli_query($link, "SELECT * FROM  modules");

                        $select = '<div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <label class="input-group-text" for="disciplines_module">Модуль</label>
                        </div>
                        <select class="custom-select" data-name="Модуль" id="disciplines_module">
                        <option class="d-none" selected>Выберите...</option>';
                        for ($c = 0; $c < mysqli_num_rows($result); $c++) {
                            $array = mysqli_fetch_array($result);
                            $select .= '<option value="' . $array['name'] . '">' . $array['name'] . '</option>';
                        }
                        $select .= '</select>
                        </div>';

                        echo $select;

                        close();
                        ?>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="disciplines_time">Нагрузка, ч.</label>
                            </div>
                            <input type="text" id="disciplines_time" data-name="Нагрузка" class="form-control">
                        </div>
                        <button class="btn btn-primary" id="disciplines_append" type="submit">Отправить</button>
                    </form>
                    <form id="courses_fgos_profstandards" class="select_field d-none">
                        <div id="courses">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="courses_code">Код направления</label>
                                </div>
                                <input type="text" class="form-control" data-mask="__.__.__" data-name="Код направления" id="courses_code">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="courses_name">Назание направления</label>
                                </div>
                                <input type="text" class="form-control" data-name="Назание направления" id="courses_name">
                            </div>
                            <?php
                            connect();
                            global $link;

                            $result = mysqli_query($link, "SELECT * FROM qualifications");

                            $select = '<div class="input-group mb-3">
                            <div class="input-group-prepend">
                            <label class="input-group-text" for="courses_quality">Квалификация</label>
                            </div>
                            <select class="custom-select" data-name="Квалификация" id="courses_quality">
                            <option class="d-none" selected>Выберите...</option>';
                            for ($c = 0; $c < mysqli_num_rows($result); $c++) {
                                $array = mysqli_fetch_array($result);
                                $select .= '<option value="' . $array['qualification_id'] . '">' . $array['name'] . '</option>';
                            }
                            $select .= '</select>
                            </div>';

                            echo $select;

                            close();
                            ?>
                        </div>
                        <div id="fgos">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="fgos_number">Номер ФГОС</label>
                                </div>
                                <input type="text" class="form-control" data-mask="___" data-name="Номер ФГОС" id="fgos_number">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="fgos_date">Дата ФГОС</label>
                                </div>
                                <input type="date" class="form-control" data-name="Дата ФГОС" data-provide="datepicker" id="fgos_date">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="fgos_registration">Номер регистрации ФГОС</label>
                                </div>
                                <input type="text" class="form-control" data-mask="_____" data-name="Номер регистрации ФГОС" id="fgos_registration">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="fgos_date_reg">Дата регистрации ФГОС</label>
                                </div>
                                <input type="date" class="form-control" data-name="Дата регистрации ФГОС" data-provide="datepicker" id="fgos_date_reg">
                            </div>
                        </div>
                        <div id="profstandards">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="prof_code">Код ПрофСтандарта</label>
                                </div>
                                <input type="text" class="form-control" data-name="Код ПрофСтандарта" data-mask="__.___" id="prof_code">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="prof_name">Название ПрофСтандарта</label>
                                </div>
                                <input type="text" class="form-control" data-name="Название ПрофСтандарта" id="prof_name">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="prof_number">Номер ПрофСтандарта</label>
                                </div>
                                <input type="text" class="form-control" data-name="Номер ПрофСтандарта" data-mask="___н" id="prof_number">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="prof_date">Дата ПрофСтандарта</label>
                                </div>
                                <input type="date" class="form-control" data-name="Дата ПрофСтандарта" data-provide="datepicker" id="prof_date">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="prof_number_reg">Номер регистрации ПрофСтандарта</label>
                                </div>
                                <input type="text" class="form-control" data-name="Номер регистрации ПрофСтандарта" id="prof_number_reg">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="prof_date_reg">Дата регистрации ПрофСтандарта</label>
                                </div>
                                <input type="date" class="form-control" data-name="Дата регистрации ПрофСтандарта" data-provide="datepicker" id="prof_date_reg">
                            </div>
                        </div>
                        <button class="btn btn-primary" id="cfp_append" type="submit">Отправить</button>
                    </form>
                    <form id="profstandards_otf_tf_activities" class="select_field d-none">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="otf_code">Код ПрофСтандарта</label>
                            </div>
                            <input type="text" class="form-control" data-name="Код ПрофСтандарта" data-mask="__.___" id="prof_otf_code">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="otf_name">Название ПрофСтандарта</label>
                            </div>
                            <input type="text" class="form-control" data-name="Название ПрофСтандарта" id="prof_otf_name">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="otf_code">Код ОТФ</label>
                            </div>
                            <input type="text" class="form-control" maxlength="1" onkeyup="this.value = this.value.toUpperCase();" data-name="Код ОТФ" id="otf_code">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="otf_name">Название ОТФ</label>
                            </div>
                            <input type="text" class="form-control" data-name="Название ОТФ" id="otf_name">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="otf_level">Уровень ОТФ</label>
                            </div>
                            <input type="text" class="form-control" data-name="Уровень ОТФ" id="otf_level">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="tf_code">Код ТФ</label>
                            </div>
                            <input type="text" class="form-control" disabled data-name="Код ТФ" id="tf_code">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="tf_code">Название ТФ</label>
                            </div>
                            <textarea type="text" class="form-control" data-name="Название ТФ" id="tf_name"></textarea>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="competence_knowledge">Необходимые знания</label>
                            </div>
                            <textarea type="text" class="form-control" data-name="Необходимые знания" rows="3" id="competence_knowledge"></textarea>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="competence_skills">Необходимые умения</label>
                            </div>
                            <textarea type="text" class="form-control" data-name="Необходимые умения" rows="1" id="competence_skills"></textarea>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="competence_activities">Трудовые действия</label>
                            </div>
                            <textarea type="text" class="form-control" data-name="Трудовые действия" rows="1" id="competence_activities"></textarea>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="comp_code">КОД компетенции</label>
                            </div>
                            <input type="text" class="form-control" data-name="КОД компетенции" id="comp_code">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="comp_name">Название компетенции</label>
                            </div>
                            <textarea type="text" class="form-control" data-name="Название компетенции" rows="3" id="comp_name"></textarea>
                        </div>
                        <button class="btn btn-primary" id="profstandarts_append" type="submit">Отправить</button>
                    </form>
                </div>
                <!--Загрузка файлов-->
                <!-- <div class="card-footer btn-group" id="file_loader" hidden>
                    <form method="post" enctype="multipart/form-data">
                        <input type="text" id="file_type" name="file_type" value="" hidden>
                        <input type="text" id="file_type_ru" name="file_type_ru" value="" hidden>
                        <p class="btn-group" role="group" style="width: 30rem;">
                            <input type="file" name="userfile" accept=".xlsx" class="btn btn-secondary btn-sm">
                            <input type="submit" value="Загрузить" id="start_upload" class="btn btn-success btn-sm">
                        </p>
                    </form>
                </div> -->
                <!--!Загрузка файлов-->
            </div>
        </div>
    </div>
</div>
<!--Подтверждение загрузки-->
<!-- <form id="content_form" <?php echo ((isset($_FILES['userfile'])) ? '' : 'hidden'); ?> >
	<div class="px-4 py-3 bg-light">
        <div class="form-group">
            <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/back/uploader.php"); ?>
        </div>
    </div>
</form> -->
<!--Подтверждение загрузки-->
<script>
    $(document).ready(function() {
        Array.prototype.forEach.call($("*[data-mask]"), applyDataMask);

        function applyDataMask(field) {
            var mask = field.dataset.mask.split('');

            // For now, this just strips everything that's not a number
            function stripMask(maskedData) {
                function isDigit(char) {
                    return /\d/.test(char);
                }
                return maskedData.split('').filter(isDigit);
            }

            // Replace `_` characters with characters from `data`
            function applyMask(data) {
                return mask.map(function(char) {
                    if (char != '_') return char;
                    if (data.length == 0) return char;
                    return data.shift();
                }).join('')
            }

            function reapplyMask(data) {
                return applyMask(stripMask(data));
            }

            function changed() {
                var oldStart = field.selectionStart;
                var oldEnd = field.selectionEnd;

                field.value = reapplyMask(field.value);

                field.selectionStart = oldStart;
                field.selectionEnd = oldEnd;
            }

            field.addEventListener('click', changed)
            field.addEventListener('keyup', changed)
        }

        $('#teachers_append').click(function(e) {
            e.preventDefault();

            $.post("../back/setTeachers.php", {
                teachers: {
                    'name': $('#teachers_name').val(),
                    'lastname': $('#teachers_lastname').val(),
                    'patronymic': $('#teachers_patronymic').val(),
                    'email': $('#teachers_email').val(),
                    'rank': $('#teachers_rank').val(),
                    'degree': $('#teachers_degree').val(),
                    'post': $('#teachers_post').val()
                },
            }, function(result) {
                alert(result.message);
            });
        });

        $('#disciplines_append').click(function(e) {
            e.preventDefault();

            $.post("../back/setDisciplines.php", {
                disciplines: {
                    'institute_id': $('#disciplines_institute').attr('text-name'),
                    'pulpit_id': $('#disciplines_pulpit').val(),
                    'name': $('#disciplines_name').val(),
                    'part_id': $('#disciplines_part').val(),
                    'module_id': $('#disciplines_module').val(),
                    'index': $('#disciplines_index').val(),
                    'time': $('#disciplines_time').val()
                },
            }, function(result) {
                alert(result.message);
            });
        });



        $('#cfp_append').click(function(e) {
            e.preventDefault();

            $.post("../back/setCfp.php", {
                cfp: {
                    'number': $('#courses_code').val(),
                    'name': $('#courses_name').val(),
                    'quality': $('#courses_quality').val(),
                    'fgos_number': $('#fgos_number').val(),
                    'fgos_date': $('#fgos_date').val(),
                    'fgos_reg': $('#fgos_registration').val(),
                    'fgos_date_reg': $('#fgos_date_reg').val(),
                    'prof_code': $('#prof_code').val(),
                    'prof_name': $('#prof_name').val(),
                    'prof_number': $('#prof_number').val(),
                    'prof_date': $('#prof_date').val(),
                    'prof_number_reg': $('#prof_number_reg').val(),
                    'prof_date_reg': $('#prof_date_reg').val(),
                }
            }, function(result) {
                alert(result.message);
            });
        });

        $('#profstandarts_append').click(function(e) {
            e.preventDefault();

            $.post("../back/setProfstandarts.php", {
                prof: {
                    'code_prof': $('#prof_otf_code').val(),
                    'name_prof': $('#prof_otf_name').val(),
                    'otf_code': $('#otf_code').val(),
                    'otf_name': $('#otf_name').val(),
                    'otf_level': $('#otf_level').val(),
                    'tf_code': $('#tf_code').val(),
                    'tf_name': $('#tf_name').val(),
                    'knowlege': $('#competence_knowledge').val(),
                    'skill': $('#competence_skills').val(),
                    'action': $('#competence_activities').val(),
                    'comp_code': $('#comp_code').val(),
                    'comp_name': $('#comp_name').val(),
                },
            }, function(result) {
                alert(result.message);
            });
        });


        $('#otf_code').on('keydown', function(e) {
            var key = event.charCode || event.keyCode || 0;
            if (
                key == 8 ||
                key == 9 ||
                key == 46 ||
                (key >= 37 && key <= 40) ||
                (key >= 65 && key <= 90)) {} else {
                event.preventDefault();

            }
        }).on('input', function(e) {
            if ($(this).val().length > 0) {
                $('#tf_code').removeAttr('disabled');
                $('#tf_code').attr('data-mask', $(this).val() + '/__._');
                $('#tf_code').val($(this).val() + '/__._');
                Array.prototype.forEach.call($("#tf_code[data-mask]"), applyDataMask);
            } else {
                $('#tf_code').attr('disabled', '');
            }
        });

        $('#disciplines_institute').change(function(e) {
            var selectOption = $(this).val();
            $(this).attr('text-name', $('#disciplines_institute option[value=' + $(this).val() + ']').text());
            var pulpitsInput = $('#disciplines_pulpit option');

            $.post("../back/dbInteraction.php", {
                institute: selectOption
            }, function(data) {
                if (data.status == 1) {
                    $('#disciplines_pulpit').removeAttr('disabled')
                    pulpitsInput.each(function(i, item) {
                        if (data.value == $(item).data('institute')) {
                            $(item).removeClass('d-none');
                        } else {
                            $(item).addClass('d-none')
                        }
                    })
                } else {
                    alert(data.message)
                }
            });
        });

        $("#bulk_type").change(function() {
            var bulk_type = $("#bulk_type").val();
            var bulk_type_ru = $("#bulk_type option:selected").text();
            if (bulk_type == 0) {
                $('#get_template').prop('disabled', true);
                $('#file_loader').prop('hidden', true);
            } else {
                $('.select_field').each(function(i, item) {
                    var itemId = $(item).attr('id');
                    if (bulk_type == itemId) {
                        $(item).removeClass('d-none');
                    } else {
                        $(item).addClass('d-none');
                    }
                });

                //код для xlsx
                /* $('#get_template').prop('disabled', false);
                $('#file_loader').prop('hidden', false);
                $("#file_type").val(bulk_type);
                $("#file_type_ru").val(bulk_type_ru);
                $("#get_template").click(function() {
                    location.href = "../templates/bulk_templates/" + bulk_type + ".xlsx";
                }); */
            };
        });
    });
</script>