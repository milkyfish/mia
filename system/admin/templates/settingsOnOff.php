<?php 
$settings = AdminModel::getOnOffSettings();
if(isset($_POST['saveOnOff']))
{
	AdminModel::addOnOffSettings($_POST['isActive'], $_POST['inActiveMessage']);
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
							<h3>Включение / Отключение MiA</h3>
							<form method="post">
								<div class="form-group row">
									<label class="col-sm-3 form-control-label">Состояние системы</label>
									<div class="col-sm-9">
										<select class="form-control" name="isActive">
											<option value="1" <?php if($settings['isActive'] == 1): ?>selected<?php endif ?>>Включена</option>
											<option value="0" <?php if($settings['isActive'] == 0): ?>selected<?php endif ?>>Выключена</option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-3 form-control-label">Сообщение, если система отключена</label>
									<div class="col-sm-9">
										<textarea class="form-control" name="inActiveMessage"><?=$settings['inActiveMessage']?></textarea>
									</div>
								</div>
								<button type="submit" class="btn btn-primary" name="saveOnOff">Сохранить</button>
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