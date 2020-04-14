<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/back/base.php");

function setTeachers($teachers)
{
  if (!empty($teachers)) {
    $data["status"] = 0;

    connect();
    global $link;

    $resRank = mysqli_query($link, "SELECT 	MAX(academic_rank_id)
													   FROM 	academic_ranks 
													   WHERE 	UPPER(full_name) = UPPER('" . $teachers['rank'] . "')");

    if (mysqli_num_rows($resRank) == 0) {
      $rankValue = null;
    } else {
      while ($p1 = mysqli_fetch_array($resRank)) {
        $rankValue =  $p1[0];
      }
    }

    $resDegree = mysqli_query($link, "SELECT 	MAX(academic_degree_id)
													   FROM 	academic_degrees 
													   WHERE 	UPPER(short_name) = UPPER('" . $teachers['degree'] . "')");
    if (mysqli_num_rows($resDegree) == 0) {
      $degreeValue = null;
    } else {
      while ($p1 = mysqli_fetch_array($resDegree)) {
        $degreeValue = $p1[0];
      }
    }

    $resPost = mysqli_query($link, "SELECT 	MAX(position_id)
    FROM 	positions 
    WHERE 	`name` = '" . $teachers['post'] . "'");
    if (mysqli_num_rows($resPost) == 0) {
      mysqli_query($link, "INSERT INTO `positions` (`name`) VALUES ('" . $teachers['post'] . "')");
      $resPost = mysqli_query($link, "SELECT 	MAX(position_id)
      FROM 	positions 
      WHERE 	`name` = '" . $teachers['post'] . "'");
    }
    if (mysqli_num_rows($resPost) == 0) {
      $postValue = null;
    } else {
      while ($p1 = mysqli_fetch_array($resPost)) {
        $postValue = $p1[0];
      }
    }
    
    close();

    $sql_insert = "INSERT INTO `teachers` (`second_name`, `first_name`, `middle_name`, `email`, `academic_rank_id`, `academic_degree_id`) VALUES ('" . $teachers['name'] . "', '" . $teachers['lastname'] . "',  '" . $teachers['patronymic'] . "',  '" . $teachers['email'] . "', '" . $rankValue . "', '" . $degreeValue . "')";

    connect();
    global $link;

    mysqli_query($link, $sql_insert);

    $resTeacher = mysqli_query($link, "SELECT 	MAX(teacher_id)
    FROM 	teachers 
    WHERE 	second_name = '" . $teachers['lastname'] . "' 
        AND first_name  = '" . $teachers['name'] . "' 
     AND middle_name = '" . $teachers['patronymic'] . "'");
    if (mysqli_num_rows($resTeacher) == 0) {
      $teacherValue = null;
    } else {
      while ($p1 = mysqli_fetch_array($resTeacher)) {
        $teacherValue = $p1[0];
      }
    }
    close();

    $sql_insert2 = "INSERT INTO `teacher_positions` (`position_id`, `teacher_id`, `main_position`) VALUES ('" . $postValue . "', '" . $teacherValue . "', '1')";

    connect();
    global $link;
    mysqli_query($link, $sql_insert2);
    close();

    echo $sql_insert;
    echo $sql_insert2;

    $data["message"] = 'Данные успешно загружены';
  } else {
    $data["status"] = 1;

    $data["message"] = 'Ошибка чтения';
  }
  header('Content-type: application/json');
  echo json_encode($data);
}

setTeachers($_POST['teachers']);
