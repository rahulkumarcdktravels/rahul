<?php
// Run once from localhost after importing database/schema.sql, then DELETE this file.
require_once __DIR__.'/includes/bootstrap.php';
$message='';$error='';
try {
  $count=(int)db()->query("SELECT COUNT(*) FROM admins")->fetchColumn();
  if($count>0){$message='An administrator already exists. For security, delete create-admin.php now.';}
  elseif($_SERVER['REQUEST_METHOD']==='POST'){
    csrf_check();$name=trim($_POST['name']??'');$username=trim($_POST['username']??'');$email=trim($_POST['email']??'');$password=$_POST['password']??'';
    if($name===''||$username===''||!filter_var($email,FILTER_VALIDATE_EMAIL)||strlen($password)<12){$error='Enter all fields, a valid email, and a password with at least 12 characters.';}
    else{$st=db()->prepare("INSERT INTO admins (name,username,email,password_hash) VALUES (?,?,?,?)");$st->execute([$name,$username,$email,password_hash($password,PASSWORD_DEFAULT)]);$message='Administrator created. Delete create-admin.php immediately, then sign in at admin/login.php.';}
  }
}catch(Throwable $e){$error='Database connection failed. Import database/schema.sql and check config/database.php.';}
?><!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Create Admin</title><link rel="stylesheet" href="<?=e(url('assets/css/style.css'))?>"></head><body class="admin-login-wrap"><main class="login-card"><h1>Create administrator</h1><p>One-time setup tool. Remove this file after creating the first admin.</p><?php if($message):?><div class="notice notice-success"><?=e($message)?></div><?php endif;?><?php if($error):?><div class="notice notice-error"><?=e($error)?></div><?php endif;?><?php if(empty($count)&&!$message):?><form method="post"><input type="hidden" name="csrf" value="<?=e(csrf_token())?>"><div class="form-row"><label>Name</label><input class="admin-input" name="name" required></div><div class="form-row"><label>Username</label><input class="admin-input" name="username" required></div><div class="form-row"><label>Email</label><input class="admin-input" type="email" name="email" required></div><div class="form-row"><label>Password (12+ characters)</label><input class="admin-input" type="password" name="password" minlength="12" required></div><button class="btn btn-primary" type="submit">Create Admin</button></form><?php endif;?></main></body></html>