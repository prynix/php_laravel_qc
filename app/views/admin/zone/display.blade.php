<?php
//print_r($_SERVER); die();
switch($_SERVER['SERVER_NAME']){
	case 'localhost':
		$hostname='http://localhost/qc/public/';
	break;
	case 'sqc.tintuc.vn':
		$hostname='http://sqc.tintuc.vn/';
	break;
	case 'qc.tintuc.vn':
		$hostname='http://qc.tintuc.vn/';
	break;
	default: 
		$hostname='http://qc.tintuc.vn/';
}
?>
<script src='<?php echo $hostname; ?>assets/js/jquery-1.11.1.min.js'></script>
<script type="text/javascript" src='<?php echo $hostname; ?>assets/js/adman.js'></script>
@if(isset($timeout))
	<script type="text/javascript">displayBannerSlideShow({{$zoneid}},"{{$website_url}}",{{$timeout}});</script>
@else
	<script type="text/javascript">displayBanners({{$zoneid}},"{{$website_url}}");</script>
@endif
<div class="ads-{{$zoneid}}"></div>