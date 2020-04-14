<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/back/base.php");

function setCfp($cfp)
{
  if (!empty($cfp)) {
    connect();
    global $link;

    $resCourse = mysqli_query($link, "SELECT 	MAX(course_id)
  FROM 	courses 
  WHERE 	`number` = '" . $cfp['number'] . "' 
      AND `name`   = '" . $cfp['name'] . "'");
    if (mysqli_num_rows($resCourse) == 0) {
      $courseValue = null;
    } else {
      while ($p1 = mysqli_fetch_array($resCourse)) {
        $courseValue = $p1[0];
      }
    }

    $resFgos = mysqli_query($link, "SELECT 	MAX(fgos_id)
											   FROM 	fgos 
											   WHERE 	`number` 	 = '" . $cfp['fgos_number'] . "' 
											   		AND `date` 		 = '" . $cfp['fgos_date'] . "' 
													AND `reg_number` = '" . $cfp['fgos_reg'] . "' 
													AND `reg_date` 	 = '" . $cfp['fgos_date_reg'] . "'");
    if (mysqli_num_rows($resFgos) == 0) {
      $fgosValue = null;
    } else {
      while ($p1 = mysqli_fetch_array($resFgos)) {
        $fgosValue = $p1[0];
      }
    }

    close();

    $sql_insert = "INSERT INTO `courses` (`number`, `name`, `qualification_id`) VALUES ('" . $cfp['number'] . "','" . $cfp['name'] . "','" . $cfp['quality'] . "')";
    $sql_insert2 = "INSERT INTO `fgos` (`number`, `date`, `reg_number`, `reg_date`, `course_id`) VALUES ('" . $cfp['fgos_number'] . "','" . $cfp['fgos_date'] . "','" . $cfp['fgos_reg'] . "','" . $cfp['fgos_date_reg'] . "','" . $courseValue . "')";
    $sql_insert3 = "INSERT INTO `prof_standards` (`code`, `name`, `number`, `date`, `reg_number`, `reg_date`, `fgos_id`) VALUES ('" . $cfp['prof_code'] . "','" . $cfp['prof_name'] . "','" . $cfp['prof_number'] . "','" . $cfp['prof_date'] . "','" . $cfp['prof_number_reg'] . "','" . $cfp['prof_date_reg'] . "','" . $fgosValue . "')";

    /* echo $sql_insert;
  echo $sql_insert2;
  echo $sql_insert3; */

    connect();
    global $link;

    mysqli_query($link, $sql_insert);
    mysqli_query($link, $sql_insert2);
    mysqli_query($link, $sql_insert3);
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

setCfp($_POST['cfp']);
