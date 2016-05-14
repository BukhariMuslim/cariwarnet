<?php
include("../options/myLib.php");

$isLogin = !empty($sessionUsername);

include("home.php");

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
	<link type="text/css" rel="stylesheet" href="../css/page.init.css" />
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
			}
			
			window.onload = init();
			
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
							<form name="search_1" method="get" action="<?=$_SERVER['PHP_SELF']?>">
								<div class="input-field">
									<input id="search1" type="search" name="search" placeholder="Pencarian" value="<?php echo $par ?>">
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
							<form name="search_2" method="get" action="<?=$_SERVER['PHP_SELF']?>">
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
			<div class="row">
				<div class="col s3">&nbsp;</div>
				<div class="col s9">
					<?php
                    if($isParExists) {
                        ?>
                        <div class="card teal lighten-4">
                            <div class="card-content">
                                <?php
                                    $kata = "Menampilkan <b>$jumlah</b> data";
                                    if ($jumlah == 0) $kata = "Tidak ada data yang ditemukan";
                                    echo "$kata berdasarkan kata kunci <b>\"$par\"</b>."
                                ?>
                            </div>
                        </div>
                        <?php
                    }
                    
					$tes = 1;
					while ($data=mysql_fetch_array($hasil))
					{
					?>
					<div class="card small">
						<div class="card-image">
							<img src="../img/<?=$tes?>.jpg" width="36px" alt="">
							<span class="card-title strokeme"><?=$data["wrnet_name"]?></span>
						</div>
						<div class="card-content">
                            <small class="grey-text text-lighten-1">- Dipublikasikan oleh "<i><?=$data["wrnet_owner_nm"]?>"</i></small>
							<p><?=$data["wrnet_alamat"]?></p>
						</div>
						<div class="card-action" style="text-align: right">
							<a href="../warnet?id=<?=$data["wrnet_id"]?>" class="waves-effect waves-light btn white-text">Baca lebih lanjut</a>
						</div>
					</div>
					<?php
						$tes++;
						if ($tes == 4) $tes = 1;
					}
					?>
				</div>
			</div>
		</div>
	</main>
	<footer class="page-footer teal lighten-2 main">
		<!--<div class="container">
			<div class="row">
				<div class="col l6 s12">
					<h5 class="white-text">Footer Content</h5>
					<p class="grey-text text-lighten-4">You can use rows and columns here to organize your footer content.</p>
				</div>
				<div class="col l4 offset-l2 s12">
					<h5 class="white-text">Links</h5>
					<ul>
						<li><a class="grey-text text-lighten-3" href="#!">Link 1</a></li>
						<li><a class="grey-text text-lighten-3" href="#!">Link 2</a></li>
						<li><a class="grey-text text-lighten-3" href="#!">Link 3</a></li>
						<li><a class="grey-text text-lighten-3" href="#!">Link 4</a></li>
					</ul>
				</div>
			</div>
		</div>-->
		<div class="footer-copyright">
			<div class="container">© 2015 Copyright Text<div>
		</div>
	</footer>            
</body>
</html>