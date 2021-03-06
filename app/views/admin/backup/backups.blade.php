@extends('layout.main')
@section('content')
<?php include("lib/Bootstrap.php"); ?>
<?php
//$config=Config::get('local/database');
$config=Config::get('production/database'); print_r($config); die();
$host=$config['connections']['mysql']['host'];
$username=$config['connections']['mysql']['username'];
$password=$config['connections']['mysql']['password'];
$database=$config['connections']['mysql']['database'];

$config['db.host'] = $host;
$config['db.username'] = $username;
$config['db.password'] = $password;
$config['db.name'] = $database;
$config['db.port']="";

// Security
if(!defined("WRAPPER")){ echo "You cannot load a page directly!"; exit; }

$File->SetPath($Server->GetBackupPath());
$files = $File->Listing(array("zip", "small"), array(".htaccess", ".DS_Store"), array("__MACOSX"), false);

$databases = $Server->CommandMysqldatabases();

// Check if database is connectable
$db_valid = true;
$host = $config['db.host'];
$user = $config['db.username'];
$pass = $config['db.password'];
$name = $config['db.name'];
$port = $config['db.port'];
if($port == "") 
  //$port = 3306;
  $port = 80;
$link = @mysql_connect($host.":".$port,$user,$pass);
if(!$link){
	$db_valid = false;
}

if(!@mysql_select_db($name,$link)){
	$db_valid = false;
}

?>
<section class="content-header">
                    <h1>
					<img src="../assets/img/icon/green-backup-icon.png" alt="" width="26px"/>
                        Database overview
                        <!-- <small>advanced tables</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="database"> Database backups</a></li>
                        <li class="active">Database overview</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                	<div class="row">
                        <div class="col-xs-12">
                        <div class="box">
                                <div class="box-header">
                                </div><!-- /.box-header -->
                                <div class="box-body">  	
                                	<div class="successbox" id="success2" style="display:none">New backup is created</div>
									<div class="warningbox" id="warning2" style="display:none">New backup is created</div>
									<?php if($db_valid){ ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="base">
<thead>
  <tr>
  	<th width="5%"><img src="../assets/img/icon/database.png" width="16" height="16" alt="database" /></th>
    <th width="75%">Name</th>
    <th width="20%">Download</th>
  </tr>
  </thead>
  <tbody>
  <?php foreach($databases as $database){ ?>
  <tr>
  	<td><img src="../assets/img/icon/database.png" width="16" height="16" alt="database" /></td>
    <td><?php echo $database ?></td>
    <td align="right"><a id="<?php echo $database; ?>_runButton" onclick="doDatabaseBackup('<?php echo $database; ?>');return false;" class="button">Backup</a><img src="../assets/img/icon/ajax.gif" width="16" height="16" alt="loader" style="display:none" id="<?php echo $database; ?>_loadImage" /></td>
  </td>
  </tr>
  <?php } ?>
  </tbody>
</table>
<?php }else{ ?>
<div class="warningbox">Could not connect to your database server. Check if the credentials in the config file are correct.</div>
<?php } ?>
<div class="spacer"><!--SPACER--></div>
<p></p>
<h2>Backup overview</h2>
<div class="successbox" id="success" style="display:none">New backup is created</div>
<div class="warningbox" id="warning" style="display:none">New backup is created</div>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="base" id="resultTable">
<thead>
  <tr>
  	<th width="5%"><img src="../assets/img/icon/database.png" width="16" height="16" alt="database" /></th>
    <th width="25%">Name</th>
    <th width="15%">Date</th>
    <th width="10%">Time</th>
    <th width="15%">Size</th>
    <th width="10%">Download</th>
    <th width="10%">Delete</th>
    <th width="10%">Rollback</th>
  </tr>
  </thead>
  <tbody>
  <?php foreach($files as $file){ if($file['type'] == "dir") continue;?>
  <tr class="row_<?php echo md5($file['filename']) ?>">
  	<td width="5%"><img src="../assets/img/icon/database.png" width="16" height="16" alt="database" /></td>
    <td width="25%"><?php echo $Server->GetDatabaseName($file['filename']) ?></td>
    <td width="15%"><?php echo $Server->GetDatePart($file['filename']) ?></td>
    <td width="10%"><?php echo $Server->GetTimePart($file['filename']) ?></td>
    <td width="15%"><?php echo $Server->GetByteFormat($file['size']) ?></td>
    <td width="10%" align="right"><a href="database-download-<?php echo $file['filename']; ?>" class="button">Download</a></td>
  	<td width="10%" align="right">
    	<a id="<?php echo md5($file['filename']); ?>_delete_link" onclick="doDelete('<?php echo $file['filename']; ?>', '<?php echo md5($file['filename']); ?>');return false;" class="button">Delete</a>
    	<img id="<?php echo md5($file['filename']); ?>_delete_load" class="loader" width="16" height="16" style="display: none;" alt="loader" src="../assets/img/icon/ajax.gif"/>
    </td>
    <td width="10%" align="right">
    <?php if($db_valid){ ?>
    	<a id="<?php echo md5($file['filename']); ?>_rollback_link" onclick="doDatabaseRollback('<?php echo $file['filename']; ?>', '<?php echo md5($file['filename']); ?>');return false;" class="button">Rollback</a>
		<img id="<?php echo md5($file['filename']); ?>_rollback_load" class="loader" width="16" height="16" style="display: none;" alt="loader" src="../assets/img/icon/ajax.gif"/>
    <?php }else{ ?>
    	<i>Inactive</i>
    <?php } ?>
    </td>
  </td>
  </tr>
  <?php } ?>
  <tr class="norows" <?php if(count($files) != 0) echo 'style="display:none"'; ?>><td colspan="8" class="warningbox">There are no database backups found on the server.</td></tr>
  </tbody>
</table>

                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                </section><!-- /.content -->
@stop