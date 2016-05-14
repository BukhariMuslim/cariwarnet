<?php
include("../options/myLib.php");
if (!empty($sessionUsername)) {
	header("location:../home");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Document</title>
<?php
include("../options/initial.php");
?>
	<script>
		$(function() {
			var par = getParameterByName("status");
			if (par) {
				if (par == "0") $("#modalFail").openModal();
			}	
		});
	</script>
</head>
<body class="blue-grey lighten-5">
	<div class="container">
		<div class="row center-form" style="margin-top: 15%;">
			<div class="col offset-m3 card-panel hoverable blue lighten-5 teal-text text-darken-5 login-form">
				<form name="form_login" method="post" action="cek_login.php">
                    <div class="row">
                        <div class="col s10">
                            <h3 clas="valign">Login</h3>
                        </div>
                        <div class="col s2 valign-wrapper">
                            <a href="../home" class="valign waves-effect waves btn-floating tooltipped" data-tooltip="Batal">
                                <i class="material-icons">close</i>
                            </a>
                        </div>
                    </div>
					<div class="row">
						<div class="input-field col s12">
							<i class="material-icons prefix">account_circle</i>
							<input id="username" type="text" name="username" placeholder="Username" class="validate" autofocus>
							<label for="username">Username</label>
						</div>
						<div class="input-field col s12">
							<i class="material-icons prefix">lock</i>
							<input id="password" type="password" name="password" placeholder="Password" class="validate">
							<label for="password">Password</label>
						</div>
					</div>
					<div class="left">
						<a href="../register" class="waves-effect waves btn-flat tooltipped" data-tooltip="Belum memiliki akun?">Mendaftar</a>
					</div>
					<div class="right">
						<button class="btn waves-effect waves-light" type="submit" name="action">
							Login
							<i class="material-icons right">send</i>
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div id="modalFail" class="modal">
		<div class="modal-content">
			<h4>Pemberitahuan</h4>
			<p>Kombinasi Username dan Password tidak tersedia.</p>
		</div>
		<div class="modal-footer">
			<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Tutup</a>
		</div>
	</div>
	
</body>
</html>