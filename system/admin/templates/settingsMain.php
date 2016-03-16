<?php 
$settings = AdminModel::getMainSettings();
if(isset($_POST['saveMain']))
{
	AdminModel::addMainSettings($_POST['projectName'], $_POST['projectDescription'], $_POST['projectCharset'], $_POST['projectRobots'], $_POST['cssLibraries'],
								$_POST['jQueryLibrary']);
}
?>
<!doctype html>
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Dashboard | MiA HQ</title>
<link rel="stylesheet" href="/system/admin/css/style.css" />
<link rel="stylesheet" href="/system/admin/css/bootstrap.min.css" />
</head>
<body>
<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12">
			<div class="block">
			<?php require_once('navigation.php') ?>
				<div class="dashboard-inner">
					<div class="col-xs-3 col-sm-3 col-md-3 settings-navigation">
						<?php require_once('navigation-settings.php') ?>
					</div>
					<div class="col-xs-9 col-sm-9 col-md-9">
						<div class="content-inner">
							<h3>Основные настройки</h3>
							<form method="post">
								<div class="form-group row">
									<label for="projectName" class="col-sm-3 form-control-label">Название проекта</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="projectName" name="projectName" placeholder="Название проекта" value="<?=$settings['projectName']?>" />
									</div>
								</div>
								<div class="form-group row">
									<label for="projectDescription" class="col-sm-3 form-control-label">Описание проекта</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="projectDescription" name="projectDescription" placeholder="Описание проекта" value="<?=$settings['projectDescription']?>" />
									</div>
								</div>
								<div class="form-group row">
									<label for="projectCharset" class="col-sm-3 form-control-label">Кодировка страниц</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="projectCharset" name="projectCharset" placeholder="Кодировка страниц" value="<?=$settings['projectCharset']?>" />
									</div>
								</div>
								<div class="form-group row">
									<label for="projectRobots" class="col-sm-3 form-control-label">Правило для мета-тега robots</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="projectRobots" name="projectRobots" placeholder="Правило для meta-тега robots" value="<?=$settings['projectRobots']?>" />
									</div>
								</div>
								<div class="form-group row">
									<label for="cssLibraries" class="col-sm-3 form-control-label">CSS библиотеки</label>
									<div class="col-sm-9">
										<textarea class="form-control" id="cssLibraries" name="cssLibraries" rows="3"><?=$settings['cssLibraries']?></textarea>
									</div>
								</div>
								<div class="form-group row">
									<label for="jQueryLibrary" class="col-sm-3 form-control-label">jQuery</label>
									<div class="col-sm-9">
										<select class="form-control" name="jQueryLibrary">
											<option value="0" <?php if($settings['jQueryLibrary'] == 0): ?>selected<?php endif ?>>Отключить</option>
											<option value="1" <?php if($settings['jQueryLibrary'] == 1): ?>selected<?php endif ?>>Google Ajax API CDN</option>
											<option value="2" <?php if($settings['jQueryLibrary'] == 2): ?>selected<?php endif ?>>Microsoft CDN</option>
											<option value="3" <?php if($settings['jQueryLibrary'] == 3): ?>selected<?php endif ?>>jQuery CDN</option>
										</select>
									</div>
								</div>
								<button type="submit" class="btn btn-primary" name="saveMain">Сохранить</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>	
</div>
</body>
</html>