<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/back/base.php");

function setProfstandarts($prof)
{
  if (!empty($prof)) {
    connect();
    global $link;

    $resProfId = mysqli_query($link, "SELECT 	MAX(prof_standard_id) 
											   FROM 	prof_standards 
											   WHERE 	`code` = '" . $prof['code_prof'] . "' 
											   		AND `name` = '" . $prof['name_prof'] . "'");
    if (mysqli_num_rows($resProfId) == 0) {
      $profIdValue = null;
    } else {
      while ($p1 = mysqli_fetch_array($resProfId)) {
        $profIdValue = $p1[0];
      }
    }

    close();

    $sql_insert = "INSERT INTO `general_work_functions` (`code`, `name`, `level`, `prof_standard_id`) VALUES ('" . $prof['otf_code'] . "','" . $prof['otf_name'] . "','" . $prof['otf_level'] . "','" . $profIdValue . "')";

    connect();
    global $link;

    mysqli_query($link, $sql_insert);

    close();

    connect();
    global $link;

    $resFuncId = mysqli_query($link, "SELECT 	MAX(general_work_function_id)
											   FROM 	general_work_functions 
											   WHERE 	`code`  = '" . $prof['otf_code'] . "' 
											   		AND `name`  = '" . $prof['otf_name'] . "' 
                          AND `level` = '" . $prof['otf_level'] . "'");
    if (mysqli_num_rows($resFuncId) == 0) {
      $funcIdValue = null;
    } else {
      while ($p1 = mysqli_fetch_array($resFuncId)) {
        $funcIdValue = $p1[0];
      }
    }

    $resCompId = mysqli_query($link, "SELECT 	MAX(competence_type_id), SUBSTRING_INDEX('" . $prof["comp_code"] . "','-',1), name
													   FROM 	competence_types 
                             WHERE 	code = SUBSTRING_INDEX('" . $prof["comp_code"] . "','-',1)");
    while ($p1 = mysqli_fetch_array($resCompId)) {
      $compIdValue = $p1[0];
      $compNumberValue = $p1[1];
      $compNameValue = $p1[2];
    }

    $resFgosId = mysqli_query($link, "SELECT 	fg.fgos_id
													  , MAX(prof.prof_standard_id) 
											   FROM 	prof_standards 	prof
											   		  , fgos 			fg
											   WHERE 	prof.code 		= '" . $prof['code_prof'] . "' 
													AND prof.name 		= '" . $prof['name_prof'] . "'
													AND prof.fgos_id 	= fg.fgos_id"); # <---------------если не отработает, выкинуть таблицу fgos из запроса
    if (mysqli_num_rows($resFgosId) == 0) {
      $fgosIdValue = null;
    } else {
      while ($p1 = mysqli_fetch_array($resFgosId)) {
        $fgosIdValue = $p1[0];
      }
    }

    $resActivityKnowlege = mysqli_query($link, "SELECT 	MAX(activity_type_id)
													   FROM 	activity_types 
													   WHERE 	UPPER(name) = UPPER('Необходимые знания')");
    while ($p1 = mysqli_fetch_array($resActivityKnowlege)) {
      $activityKnowlegeValue = $p1[0];
    }

    $resActivitySkills = mysqli_query($link, "SELECT 	MAX(activity_type_id)
  FROM 	activity_types 
  WHERE 	UPPER(name) = UPPER('Необходимые умения')");
    while ($p1 = mysqli_fetch_array($resActivitySkills)) {
      $activitySkillsValue = $p1[0];
    }

    $resActivityActions = mysqli_query($link, "SELECT 	MAX(activity_type_id)
													   FROM 	activity_types 
													   WHERE 	UPPER(name) = UPPER('Трудовые действия')");
    while ($p1 = mysqli_fetch_array($resActivityActions)) {
      $activityActionsValue = $p1[0];
    }

    $resWorkFunc = mysqli_query($link, "SELECT 	MAX(tf.work_function_id)
											   FROM 	work_functions 				tf
											   		  , general_work_functions 		otf
											   WHERE 	tf.code 					= '" . $prof['tf_code'] . "' 
													AND tf.name 					= '" . $prof['tf_name'] . "'
													AND tf.general_work_function_id = otf.general_work_function_id
													AND otf.code 					= '" . $prof['otf_code'] . "'
													AND otf.name 					= '" . $prof['otf_name'] . "'
                          AND otf.level 					= '" . $prof['otf_level'] . "'");

    if (mysqli_num_rows($resWorkFunc) == 0) {
      $workFuncValue = null;
    } else {
      while ($p1 = mysqli_fetch_array($resWorkFunc)) {
        $workFuncValue = $p1[0];
      }
    }

    $resCompetence = mysqli_query($link, "SELECT 	MAX(comp.competence_id)
											   FROM 	competencies 				comp
											   		  , prof_standards 				prof
													  , fgos						fg
											   WHERE 	prof.code 					= '" . $prof['code_prof'] . "' 
													AND prof.name 					= '" . $prof['name_prof'] . "'
													AND prof.fgos_id 				= fg.fgos_id
													AND fg.fgos_id					= comp.fgos_id
													AND comp.competence_type_id		= '" . $compIdValue . "' 
													AND comp.number 				= '" . $compNumberValue . "'
                          AND comp.name 					= '" . $compNameValue . "'"); # <---------------тут может быть ошибка
    if (mysqli_num_rows($resCompetence) == 0) {
      $competenceValue = null;
    } else {
      while ($p1 = mysqli_fetch_array($resCompetence)) {
        $competenceValue = $p1[0];
      }
    }

    close();


    $sql_insert2 = "INSERT INTO `work_functions` (`code`, `name`, `general_work_function_id`) VALUES ('" . $prof['tf_code'] . "','" . $prof['tf_name'] . "','" . $funcIdValue . "')";
    $sql_insert3 = "INSERT INTO `competencies` (`competence_type_id`, `number`, `name`, `fgos_id`) VALUES ('" . $compIdValue . "','" . $compNumberValue . "','" . $prof['comp_name'] . "','" . $fgosIdValue . "')";
    $sql_insert4_1 = "INSERT INTO `activities` (`activity_type_id`, `name`, `work_function_id`, `competence_id`) VALUES ('" . $activityKnowlegeValue . "','" . $prof['knowlege'] . "', '" . $workFuncValue . "', '" . $competenceValue . "')";
    $sql_insert4_2 = "INSERT INTO `activities` (`activity_type_id`, `name`, `work_function_id`, `competence_id`) VALUES ('" . $activitySkillsValue . "','" . $prof['skill'] . "', '" . $workFuncValue . "', '" . $competenceValue . "')";
    $sql_insert4_3 = "INSERT INTO `activities` (`activity_type_id`, `name`, `work_function_id`, `competence_id`) VALUES ('" . $activityActionsValue . "','" . $prof['action'] . "', '" . $workFuncValue . "', '" . $competenceValue . "')";

    echo $sql_insert;
    echo $sql_insert2;
    echo $sql_insert3;
    echo $sql_insert4_1;
    echo $sql_insert4_2;
    echo $sql_insert4_3;

    connect();
    global $link;

    mysqli_query($link, $sql_insert2);
    mysqli_query($link, $sql_insert3);
    mysqli_query($link, $sql_insert4_1);
    mysqli_query($link, $sql_insert4_2);
    mysqli_query($link, $sql_insert4_3);
    close();

    $data["status"] = 0;
    $data['message'] = 'Данные успешно загружены';
  } else {
    $data["status"] = 1;
    $data["message"] = 'Ошибка чтения';
  }

  header('Content-type: application/json');
  echo json_encode($data);
}

setProfstandarts($_POST['prof']);
