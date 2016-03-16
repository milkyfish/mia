<?php
$data = AdminModel::getStats();
?>
<!doctype html>
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Панель управления | MiA HQ</title>
<link rel="stylesheet" href="/system/admin/css/style.css" />
<link rel="stylesheet" href="/system/admin/css/bootstrap.min.css" />
</head>
<body>
<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12">
			<div class="block dashboard">
			<?php require_once('navigation.php') ?>
				<div class="dashboard-inner">
					<div class="content-inner">
						<h4>С возвращением в панель управления MiA, Командер!</h4>
						<div class="col-xs-12 col-sm-12 col-md-6">
							<div class="tile">
								<div class="tile-inner">
									<div class="tile-header tile-about">Информация о системе</div>
									<div class="tile-content">
										<ul>
											<li>Версия ядра: <span><?=$data['coreVersion']?></span></li>
											<li>Модулей подключено: <span><?=$data['modules']?></span></li>
											<li>Ошибок найдено: <span><?=$data['errors']?></span></li>
										</ul>
									</div>
								</div>
							</div>
							<div class="tile">
								<div class="tile-inner">
									<div class="tile-header tile-about">Доска заметок</div>
									<div class="tile-content">
										<textarea class="form-control"><?=$data['notes']?></textarea>
										<button class="btn">Сохранить изменения</button>
									</div>
								</div>
							</div>
						</div>
						<div class="tile col-xs-12 col-sm-12 col-md-6">
							<div class="tile-inner">
								<div class="tile-header tile-notify">Оповещения</div>
								<div class="tile-content notify-list">
									<div class="item item-update">
										<div class="item-content">
											Доступно новое обновление для ядра: 1.0.0 - Alpha 1.1
										</div>
										<div class="item-date">
											10.03.2016 | 02:24
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>	
</div>
</body>
</html>