<?php
	if (isset($_GET["id"])){
		$current_obj = $_GET["id"];
		
	} else {

	};
?>
<div class="form-group">
	<h4 id="page_title">Аккаунты</h3>
</div>
<div class="form-group">
	<input class="btn btn-success btn-sm" onclick="location.href='../pages/sign_up.php'" type="button" value="Добавить">
</div>
<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th scope="col" style="width: 2rem">№</th>
			<th scope="col">Логин</th>
			<th scope="col">Пароль</th>
			<th scope="col">Админ</th>
			<th scope="col">Фамилия</th>
			<th scope="col">Имя</th>
			<th scope="col">Отчество</th>
		</tr>
	</thead>
	<tbody>
		<?php
			connect();
			global $link;
			$sql = "select value from `constants` where `key` = 'limitObj'";
			$result = mysqli_query($link, $sql);
			$limit = mysqli_fetch_array($result);
			$counter = 0;
			$sql = "select    acc.account_id 
							, acc.login
							, acc.grant_id
							, teach.second_name
							, teach.first_name
							, teach.middle_name
					FROM  `accounts` acc
						, `teachers` teach 
					WHERE acc.teacher_id = teach.teacher_id 
					LIMIT ".$limit[0]."";
			$result = mysqli_query($link, $sql);
			while($row = mysqli_fetch_array($result)){
				$counter++;
				if ($row[2] = 2){
					$admin = "Да";
				} else {
					$admin = "";
				}
				echo '<tr>'. "\n" . '<td>'.$counter .'</td>'."\n";
				echo '<td><a href="?id='.$row[0].'" title="Открыть аккаунт">'.$row[1].'</td>'. "\n";
				echo '<td>********</td>'. "\n";
				echo '<td>'.$admin.'</td>'. "\n";
				echo '<td>'.$row[3].'</td>'. "\n";
				echo '<td>'.$row[4].'</td>'. "\n";
				echo '<td>'.$row[5].'</td>'. "\n";
				echo '</tr>'. "\n";
			};
			close();
		?>
	</tbody>
</table>
<nav>
	<ul class="pagination pagination-sm">
		<?php if (isset($_GET["limit"])){
		
		} else {
			echo '
			<li class="page-item disabled">
				<a class="page-link" href="#">Предыдущая</a>
			</li>
			<li class="page-item active">
				<a class="page-link" href="#">1</a>
			</li>
			<li class="page-item disabled">
				<a class="page-link" href="#">2</a>
			</li>
			<li class="page-item disabled">
				<a class="page-link" href="#">3</a>
			</li>
			<li class="page-item disabled">
				<a class="page-link" href="#">Следующая</a>
			</li>' . "\n"; 
		}
		?>
	</ul>
</nav>