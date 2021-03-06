<form>
	<div class="px-4 py-3 bg-light">
		<div class="form-group">
			<h4 id="page_title">Преподаватели</h3>
		</div>
		<div class="form-group">
			<input class="btn btn-success btn-sm" type="button" id="create_teacher" value="Добавить">
		</div>
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th scope="col" style="width: 2rem">№</th>
					<th scope="col">ФИО</th>
					<th scope="col">Email</th>
					<th scope="col">Степень</th>
					<th scope="col">Звание</th>
					<th scope="col">Основная должность</th>
					<th scope="col">Аккаунт</th>
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
					$sql = "select    tech.teacher_id
									, tech.second_name
									, tech.first_name
									, tech.middle_name
									, tech.email
									, deg.full_name
									, ac_rank.full_name 
									, pos.name
									, acc.login
							FROM  `academic_degrees` deg
								, `academic_ranks` ac_rank
								, `teachers` tech
							LEFT JOIN (`teacher_positions` poses, `positions` pos) 
								ON tech.teacher_id = poses.teacher_id and poses.main_position = pos.position_id
							LEFT JOIN (`accounts` acc) 
								ON tech.teacher_id = acc.teacher_id
							WHERE tech.academic_degree_id = deg.academic_degree_id
							  and tech.academic_rank_id = ac_rank.academic_rank_id
							LIMIT ".$limit[0]."";
					$result = mysqli_query($link, $sql);
					while($row = mysqli_fetch_array($result)){
						$counter++;
						echo '<tr>'. "\n" . '<td>'.$counter .'</td>'."\n";
						echo '<td> <a href="?page=teachers&id='.$row[0].'">'.$row[1].' '.$row[2].' '.$row[3].'</a></td>'. "\n";
						echo '<td>'.$row[4].'</td>'. "\n";
						echo '<td>'.$row[5].'</td>'. "\n";
						echo '<td>'.$row[6].'</td>'. "\n";
						echo '<td>'.$row[7].'</td>'. "\n";
						echo '<td>'.$row[8].'</td>'. "\n";
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
	</div>
</form>	