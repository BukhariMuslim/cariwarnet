<?php
include("../options/myLib.php");
$isLogin = !empty($sessionUsername);

include("warnet.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Home</title>
<?php
include("../options/initial.php");
?>
	<script>	
		$(function(){
			function init() {
				window.addEventListener('scroll', function(e){
					var distanceY = window.pageYOffset || document.documentElement.scrollTop,
						shrinkOn = 100;

					if (distanceY > shrinkOn) {
						$("header:not(.smaller)").addClass("smaller");
						$("img.profile-img:not(.small-pic)").addClass("small-pic");
					} else {
						$("header.smaller").removeClass("smaller");
						$("img.profile-img.small-pic").removeClass("small-pic");
					}
				});

				$("img.profile").parent().parent().on({
					mouseenter: function () {
						$("img.profile:not(z-depth-1)").addClass("z-depth-1");
					},
					mouseleave: function () {
						$("img.profile.z-depth-1").removeClass("z-depth-1");
					}
				});
                
                setProfileSize();
			}
			
			window.onload = init();

            function setProfileSize() {
                $(".profile-container").width($("#inputImg").parent().parent().parent().parent().width()
                    - $("#inputImg").parent().parent().width() - 45);
                $(".profile-container").height($("#inputImg").parent().parent().parent().height());
            }
			
			$(".button-collapse").sideNav({
					closeOnClick: true // Closes side-nav on <a> clicks, useful for Angular/Meteor
				}
			);
						
			$('.dropdown-button').dropdown({
					gutter: 0, // Spacing from edge
					belowOrigin: true, // Displays dropdown below the button
					alignment: 'left' // Displays dropdown with edge aligned to the left of button
				}
			);
			
			function check(input) {
				if (input.value != document.getElementById('password').value) {
					input.setCustomValidity('Password Must be Matching.');
				} else {
					// input is valid -- reset the error message
					input.setCustomValidity('');
					input.validity.valid = checkValidity();
				}
			}
			
            var par = getParameterByName("success");
            if (par) {
                if (par == "1" || par == "4") $("#modalSuccess").openModal();
                else if (par == "2" || par == "3" || par == "5") $("#modalFail").openModal();
            }
            
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    
                    reader.onload = function (e) {
                        $('#inputImg').attr('src', e.target.result);
                    }
                    
                    reader.readAsDataURL(input.files[0]);
                    setProfileSize();
                }
            }
            
            $("#uplImg").change(function(){
                readURL(this);
            });
            
            $("#uplImgBtn").click(function(){
                $("#uplImg").click();
            });
            
            $("#phone").keydown(function (e) {
                // Allow: backspace, delete, tab, escape, enter and .
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                    // Allow: Ctrl+A
                    (e.keyCode == 65 && e.ctrlKey === true) ||
                    // Allow: Ctrl+C
                    (e.keyCode == 67 && e.ctrlKey === true) ||
                    // Allow: Ctrl+X
                    (e.keyCode == 88 && e.ctrlKey === true) ||
                    // Allow: home, end, left, right
                    (e.keyCode >= 35 && e.keyCode <= 39)) {
                        // let it happen, don't do anything
                        return;
                }
                // Ensure that it is a number and stop the keypress
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });
            
            $(".detailW").hover(function() {
                var c = $(this).children(this.children.length);
                var s = $(this).siblings().children(this.children.length);
                for (var i = 0; i < s.children().length; i++) {
                    var x = s.children(i);
                    if (x.hasClass("hide")) x.addClass("hide")
                }
                c.children().toggleClass("hide");
                return false;
            });
            
		});
	</script>
</head>
<body id="main-page" class="blue-grey lighten-5">
	<header>
		<nav class="teal lighten-2">
			<div class="container">
				<div class="nav-wrapper">
					<a href="../home" class="brand-logo">CariWarnet</a>
					<a href="#" data-activates="mobile-demo" class="button-collapse right"><i class="material-icons">menu</i></a>
					<ul class="right hide-on-med-and-down">
						<li>
							<form name="search_1" method="get" action="../home">
								<div class="input-field">
									<input id="search1" type="search" name="search" placeholder="Pencarian">
									<label for="search1"><i class="material-icons">search</i></label>
									<i class="material-icons">close</i>
								</div>
							</form>
						</li>
						<li <?php if ($isLogin) echo "class=\"hide\""; ?>>
							<a href="../login" class="waves-effect waves-light">Login</a>
						</li>
						<li <?php if ($isLogin) echo "class=\"hide\""; ?>>
							<a href="../register" class="waves-effect waves-light">Daftar</a>
						</li>
						<li <?php if (!$isLogin) echo "class=\"hide\""; ?>>
							<a href="#" class="waves-effect waves-light dropdown-button" data-activates="dropdownUser1">
                                <img src="<?= $prefix . "profile/display.php?id=" .$sessionId?>" alt="profile image" class="circle responsive-img profile profile-img">
								<?php echo $sessionName; ?>
							</a>
							<ul id="dropdownUser1" class='dropdown-content'>
								<li><a href="../home" class="waves-effect">Home</a></li>
								<li><a href="../profile?id=<?=$sessionId?>" class="waves-effect">Profile</a></li>
								<li><a href="../warnet" class="waves-effect">Warnet</a></li>
								<li class="divider"></li>
								<li><a href="../login/logout.php" class="waves-effect">Logout</a></li>
							</ul>
						</li>
					</ul>
					<ul class="side-nav" id="mobile-demo">
						<li>
							<form name="search_2" method="get" action="../home">
								<div class="input-field">
									<input id="search2" type="search" name="search" placeholder="Pencarian" value="<?php echo $par ?>">
									<label for="search2"><i class="material-icons">search</i></label>
									<i class="material-icons">close</i>
								</div>
							</form>
						</li>
						<li <?php if ($isLogin) echo "class=\"hide\""; ?>><a href="../login" class="waves-effect waves-light">Login</a></li>
						<li <?php if ($isLogin) echo "class=\"hide\""; ?>><a href="../register" class="waves-effect waves-light">Daftar</a></li>
						<li class="no-padding<?php if (!$isLogin) echo " hide"; ?>">
							<ul class="collapsible collapsible-accordion">
								<li>
									<a href="#" class="waves-effect waves-light collapsible-header">
                                        <img src="<?= $prefix . "profile/display.php?id=" .$sessionId?>" alt="profile image" class="circle responsive-img profile profile-img">
										<?php echo $sessionName; ?>
									</a>
									<div class="collapsible-body">
										<ul>
											<li><a href="../home" class="waves-effect">Home</a></li>
											<li><a href="../profile?id=<?=$sessionId?>" class="waves-effect">Profile</a></li>
											<li><a href="../warnet" class="waves-effect">Warnet</a></li>
											<li class="divider"></li>
											<li><a href="../login/logout.php" class="waves-effect">Logout</a></li>
										</ul>
									</div>
								<li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	</header>
	<main>
		<div class="container">
            <?php
            if ($isDetail) {
            ?>
			<form name="form_profile" method="post" action="<?=$_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
				<div class="row">
					<div class="col s12 m9 push-m3">
                        <div class="row">
                            <div class="col m3">
                                <div class="card">
                                    <div class="card-image">
                                        <?php 
                                            if (!empty($netImageNm)) {
                                        ?>
                                        <img id="inputImg" src="<?= $prefix . "warnet/display.php?id=" .$curId?>" width="100%" alt="">
                                        <?php 
                                            } else {
                                        ?>
                                        <img id="inputImg" src="<?= $prefix . "img/empty_profile.jpg"; ?>" width="100%" alt="">								
                                        <?php 
                                            }
                                        ?>
                                    </div>
                                    <div class="card-content <?php if (!$isEdit) echo "hide" ?>">
                                        <div class="file-field input-field tooltipped" data-tooltip="Upload Gambar Profile">
                                            <div class="btn">
                                                <span><i id="uplImgBtn" class="material-icons">system_update_alt</i></span>
                                                <input type="hidden" name="MAX_FILE_SIZE" value="99999999" />
                                                <input type="file" name="gambar" id="uplImg">
                                            </div>
                                            <div class="file-path-wrapper">
                                                <input class="file-path validate" type="text">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col m9 s12">
                                <div class="profile-container">
                                    <div class="profile-info">
                                        <div class="row valign-wrapper">
                                            <div class="col m12">
                                                <div class="input-field col s12" style="padding-left: 0;">
                                                    <input id="id" type="hidden" name="id" value="<?=$curId?>">
                                                    <input id="name" type="text" name="name" placeholder="Nama Warnet" value="<?=$netName?>" class="validate h3" autofocus <?php if (!$isEdit) echo "disabled" ?> tabindex="1">
                                                </div>
                                            </div>
                                            <div class="col m1 offset-m1 <?php if ($isEdit) echo "hide" ?>">
                                                <a href="?id=<?= $netId ?>&edit=1" class="waves-effect waves-light btn white-text valign right tooltipped" data-tooltip="Edit" tabindex="1"><i class="material-icons">toc</i></a>
                                            </div>
                                            <div class="col m1 offset-m1 <?php if (!$isEdit) echo "hide" ?>">
                                                <div class="col m12" style="margin-bottom: 5px">
                                                    <button class="waves-effect waves-light btn white-text valign right tooltipped" type="submit" name="simpan" data-tooltip="Simpan" tabindex="7">
                                                        <i class="material-icons">done</i>
                                                    </button>
                                                </div>
                                                <div class="col m12">
                                                    <a href="../warnet" class="waves-effect waves-light btn white-text valign right tooltipped" data-tooltip="Batal" tabindex="8"><i class="material-icons">cancel</i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						<div class="card">
							<div class="card-content">
                                <div class="row">
                                    <div class="col m12">
                                        <small class="grey-text text-lighten-1">- Dipublikasikan oleh :<?=$netOwnerName?></small>
                                    </div>
                                </div>
								<div class="row">
									<div class="input-field col m6">
										<input id="born" name="kota" placeholder="Kota" type="text" class="validate" value="<?=$netKota?>" <?php if (!$isEdit) echo "disabled" ?> tabindex="2">
										<label for="born">Kota</label>
									</div>
									<div class="input-field col m6">
										<input id="phone" name="phone" placeholder="Telepon" type="text" class="validate" value="<?=$netPhone?>" <?php if (!$isEdit) echo "disabled" ?> tabindex="5">
										<label for="phone">Telepon</label>
									</div>
                                    <div class="input-field col m12">
										<input id="alamat" name="alamat" placeholder="Alamat" type="text" class="validate" value="<?=$netAlamat?>" <?php if (!$isEdit) echo "disabled" ?> tabindex="6">
										<label for="alamat">Alamat</label>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col s12 m3 pull-m9">
						<div class="card hide">
							<div class="card-image">
							
							</div>
							<div class="card-content">
								<p>I am a very simple card. I am good at containing small bits of information.
								I am convenient because I require little markup to use effectively.</p>
							</div>
						</div>
					</div>
				</div>
			</form>
            <?php
            }
            else {
            ?>
            <div class="card">
                <div class="card-content">
                    <div class="row">
                        <div class="col s6">
                            <a href="../warnet?add=1" class="waves-effect waves-light btn white-text tooltipped" data-tooltip="Tambah Warnet"><i class="material-icons">add</i></a>               
                        </div>
                        <div class="col s6">
                            <form name="form_cari_warnet" method="get" action="<?=$_SERVER['PHP_SELF']?>">
                                <div class="input-field">
                                    <input id="searchWarnet" name="cari" type="search">
                                    <label for="searchWarnet"><i class="material-icons">search</i></label>
                                    <i class="material-icons">close</i>
                                </div>
                            </form>               
                        </div>
                    </div>
                    <table class="warnet-lst striped responsive-table">
                        <thead>
                            <tr>
                                <th style="width: 100px">No.</th>
                                <th>Nama Warnet</th>
                                <th>Pemilik</th>
                                <th>Kota</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $noUrut = 1;
                        if ($hasil) {
                            
                            $jlh = mysql_num_rows($hasil);
                            if ($jlh > 0) {
                                while ($data=mysql_fetch_array($hasil)) {
                        ?>
                            <tr id="r<?=$noUrut?>" class="detailW">
                                <td><?=$noUrut?></td>
                                <td><?=$data["wrnet_name"]?></td>
                                <td><?=$data["wrnet_owner_nm"]?></td>
                                <td><?=$data["wrnet_kota"]?></td>
                                <td>
                                    <a href="../warnet?id=<?=$data["wrnet_id"]?>&edit=1" class="waves-effect waves-light btn white-text tooltipped hide" data-tooltip="Edit"><i class="material-icons">reorder</i></a>
                                    <a href="../warnet?id=<?=$data["wrnet_id"]?>&del=1" class="waves-effect waves-light btn white-text tooltipped hide" data-tooltip="Hapus" onclick="return confirm('Yakin ingin menghapus Warnet <?=$data["wrnet_name"]?> ?')"><i class="material-icons">delete</i></a>
                                </td>
                            </tr>
                        <?php
                                    $noUrut++;
                                }
                            }
                            else {
                        ?>
                            <tr>
                                <td colspan="5" class="center-text">Tidak ada data untuk ditampilkan</td>
                            </tr>
                        <?php
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php
            }
            ?>
		</div>
	</main>
	<footer class="page-footer teal lighten-2 main">
		<div class="footer-copyright">
			<div class="container">© 2015 Copyright Text<div>
		</div>
	</footer>
	
	<!-- Modal Structure -->
	<div id="modalSuccess" class="modal">
		<div class="modal-content">
			<h4>Pemberitahuan</h4>
			<p>
				<?php
					if (!empty($_GET["success"])) {
                        if ($_GET["success"] == "1") echo "Data Berhasil Diupdate"; 
                        else if ($_GET["success"] == "4") echo "Data Berhasil Dihapus";                         
                    } 
				?>
			</p>
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
					if (!empty($_GET["success"])) {
                        if ($_GET["success"] == "2") echo "Data Gagal Diupdate"; 
                        else if ($_GET["success"] == "3") echo "Input Tanggal Salah (harus \"yyyy-mm-dd\", y=tahun, m=bulan, d=tanggal)";
                        else if ($_GET["success"] == "5") echo "Data Gagal Dihapus";                         
                    } 
				?>
			</p>
		</div>
		<div class="modal-footer">
			<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Tutup</a>
		</div>
	</div> 
</body>
</html>