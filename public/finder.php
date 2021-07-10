<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>elFinder 2.0</title>

		<!-- jQuery and jQuery UI (REQUIRED) -->
		<link rel="stylesheet" type="text/css" media="screen" href="assets/css/jquery-ui-1.8.18.css">
		<script type="text/javascript" src="assets/js/jquery-1.7.2.min.js"></script>
		<script type="text/javascript" src="assets/js/jquery-ui-1.8.18.min.js"></script>

		<!-- elFinder CSS (REQUIRED) -->
		<link rel="stylesheet" type="text/css" media="screen" href="assets/css/elfinder.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="assets/css/theme.css">
		
		<!-- elFinder JS (REQUIRED) -->
		<script type="text/javascript" src="assets/js/elfinder.min.js"></script>

		<!-- elFinder translation (OPTIONAL)
		<script type="text/javascript" src="js/i18n/elfinder.ru.js"></script> -->

		<!-- elFinder initialization (REQUIRED) -->
		<script type="text/javascript" charset="utf-8">
			$().ready(function() {
				var elf = $('#elfinder').elfinder({
					url : 'lib/connector.php'  // connector URL (REQUIRED)
					// lang: 'ru',             // language (OPTIONAL)
				}).elfinder('instance');
			});
		</script>
	</head>
	<body style="background-color:#003366 !important;">

		<!-- Element where elFinder will be created (REQUIRED) -->
		<div id="elfinder"></div>
		<a href="admin/dashboard" style="color:#FFF;display:inline-block;margin:5px 0 0 0;">Back</a>
	</body>
</html>
