<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/back/base.php");

function setDisciplines($disciplines)
{
  if (!empty($disciplines)) {
    $data["status"] = 0;

    connect();
    global $link;
    $resInstitute = mysqli_query($link, "SELECT 	MAX(institute_id)
                       FROM 	institutes 
                       WHERE 	UPPER(name) = UPPER('" . $disciplines['institute_id'] . "')");
    if (mysqli_num_rows($resInstitute) == 0) {
      mysqli_query($link, "INSERT INTO `institutes` (`name`) VALUES ('" . $disciplines['institute_id'] . "')");
      $resInstitute = mysqli_query($link, "SELECT 	MAX(institute_id)
                         FROM 	institutes 
                         WHERE 	`name` = '" . $disciplines['institute_id'] . "'");
    };
    if (mysqli_num_rows($resInstitute) == 0) {
      $inst_id = null;
    } else {
      while ($p1 = mysqli_fetch_array($resInstitute)) {
        $inst_id = (int) $p1[0];
      }
    }


    $resPulpit = mysqli_query($link, "SELECT	MAX(pulpit_id)
                               FROM 	pulpits 
                               WHERE 	UPPER(name) = UPPER(" . $disciplines['pulpit_id'] . ") 
                                   AND institute_id = " . $inst_id . "");
    if (!$resPulpit || mysqli_num_rows($resPulpit) == 0) {
      mysqli_query($link, "INSERT INTO `pulpits` (`institute_id`, `name`) VALUES (" . $inst_id . ",'" . $disciplines['pulpit_id'] . "')");
      $resPulpit = mysqli_query($link, "SELECT 	MAX(pulpit_id)
                                 FROM 	pulpits 
                                 WHERE 	`name` = '" . $disciplines['pulpit_id'] . "' 
                                     AND institute_id = " . $inst_id . "");
    };
    if (!$resPulpit || mysqli_num_rows($resPulpit) == 0) {
      $pulpitValue = null;
    } else {
      while ($p1 = mysqli_fetch_array($resPulpit)) {
        $pulpitValue = $p1[0];
      }
    }

    $resModule = mysqli_query($link, "SELECT 	MAX(module_id)
                               FROM 	modules 
                               WHERE 	UPPER(name) = UPPER('" . $disciplines['module_id'] . "')");

    if (mysqli_num_rows($resModule) == 0) {
      mysqli_query($link, "INSERT INTO `modules` (`name`) VALUES ('" . $disciplines['module_id'] . "')");

      $resModule = mysqli_query($link, "SELECT 	MAX(module_id)
                                 FROM 	modules 
                                 WHERE 	UPPER(name) = UPPER('" . $disciplines['module_id'] . "')");
    }
    if (mysqli_num_rows($resModule) == 0) {
      $moduleValue = null;
    } else {
      while ($p1 = mysqli_fetch_array($resModule)) {
        $moduleValue = $p1[0];
      }
    }
    close();


    $sql_insert = "INSERT INTO `disciplines` (`pulpit_id`, `name`, `part_id`, `module_id`, `index_info`, `time`) VALUES ('" . $pulpitValue . "','" . $disciplines['name'] . "', '" . $disciplines['part_id'] . "', '" . $moduleValue . "','" . $disciplines['index'] . "','" . $disciplines['time'] . "')";

    connect();
    global $link;
    mysqli_query($link, $sql_insert);
    close();

    $data['message'] = 'Данные успешно загружены';
  } else {
    $data["status"] = 1;
    $data["message"] = 'Ошибка чтения';
  }
  header('Content-type: application/json');
  echo json_encode($data);
}

setDisciplines($_POST['disciplines']);
