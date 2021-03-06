<?php
include("register.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Daftar</title>
<?php
include("../options/initial.php");
?>
	<script>
		function check(input) {
			if (input.value != document.getElementById('password').value) {
				input.setCustomValidity('Password Must be Matching.');
			} else {
				// input is valid -- reset the error message
				input.setCustomValidity('');
				input.validity.valid = checkValidity();
			}
		}
		
		$(function() {
			var par = getParameterByName("success");
			if (par) {
				if (par == "1") $("#modalSuccess").openModal();
				else if (par == "2" || par == "3") $("#modalFail").openModal();
			}	
		});
	</script>
</head>
<body class="blue-grey lighten-5">
	<div class="container">
		<div class="row">
			<div class="col card-panel hoverable blue lighten-5 teal-text text-darken-5 login-form">
				<form name="form_register" method="post" action="<?= $_SERVER['PHP_SELF']?>" class="card-content">
                    <div class="row">
                        <div class="col s10">
                            <h3 clas="valign">Daftar Akun</h3>
                        </div>
                        <div class="col s2">
                            <div class="valign-wrapper">
                                <a href="../home" class="valign waves-effect waves btn-floating tooltipped" data-tooltip="Batal">
                                    <i class="material-icons">close</i>
                                </a>
                            </div>
                        </div>
                    </div>
					<div class="row">
						<div class="input-field col m12 s12">
							<input id="username" name="username" placeholder="Username" type="text" class="validate" autofocus required>
							<label for="username">User ID</label>
						</div>
						<div class="input-field col m6 s12">
							<input id="password" name="password" placeholder="Password" type="password" class="validate" required>
							<label for="password">Password</label>
						</div>
						<div class="input-field col m6 s12">
							<input id="confPassword" name="confPass" placeholder="Konfirmasi Password" type="password" class="validate" oninput="check(this)" required>
							<label for="confPassword">Konfirmasi Password</label>
						</div>
						<div class="input-field col m6 s12">
							<input id="name" name="name" placeholder="Nama" type="text" class="validate" required>
							<label for="name">Nama</label>
						</div>
						<div class="input-field col m6 s12">
							<input id="email" name="email" placeholder="E-mail" type="email" class="validate" required>
							<label for="email">E-mail</label>
						</div>
						<div class="input-field col m6 s12">
							<input id="born" name="tempatLahir" placeholder="Tempat Lahir" type="text" class="validate">
							<label for="born">Tempat Lahir</label>
						</div>
						<div class="col m6 s12 left-align">
							<label for="dateLahir">Tanggal Lahir</label>
							<input id="date" type="date" name="dateLahir" class="datepicker" style="height: 2.5rem !important" required>
						</div>
						<div class="input-field col m6 s12">
							<input id="phone" name="phone" pattern="[0-9]{10}" placeholder="Telepon" type="text" class="validate">
							<label for="phone">Telepon</label>
						</div>
						<div class="input-field col m6 s12">
							<select id="mode" name="mode" required>
								<option value="" disabled selected>Pilih Mode Pengguna</option>
								<option value="1">Pengguna</option>
								<option value="2">Pemilik Warnet</option>
							</select>
							<label>Mode Pengguna</label>
						</div>
					</div>
					<div class="left">
						<a href="../login" class="waves-effect waves btn-flat tooltipped" data-tooltip="Sudah memiliki akun?">
							Login
						</a>
					</div>
					<div class="right" style="margin-left: 10px !important">
						<button class="btn waves-effect waves-light" type="submit" name="action">
							Daftar
							<i class="material-icons right">send</i>
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<!-- Modal Structure -->
	<div id="modalSuccess" class="modal">
		<div class="modal-content">
			<h4>Pemberitahuan</h4>
			<p>Data Berhasil diinput</p>
		</div>
		<div class="modal-footer">
			<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Tutup</a>
		</div>
	</div>
	
	<div id="modalFail" class="modal">
		<div class="modal-content">
			<h4>Pemberitahuan</h4>
			<p>
				<?php
					if (!empty($_GET["success"]) && $_GET["success"] == "3") echo "Input Tanggal Salah (harus \"yyyy-mm-dd\", y=tahun, m=bulan, d=tanggal)";
					else echo "Data Gagal diinput";
				?>
			</p>
		</div>
		<div class="modal-footer">
			<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Tutup</a>
		</div>
	</div>
</body>
</html>