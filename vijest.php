<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->
<?php include('header.php'); 
    include('connection.php');
    
    $sql = "SELECT * FROM obavijesti WHERE aktivan=1 and obavijest_id=".$_GET['id'];
    $result = $conn->query($sql);
    
    $row = $result->fetch_assoc();
?>

			<section id="breadcrumbs" class="breadcrumbs_section cs section_padding_25 gradient table_section table_section_md">
				<div class="container">
					<div class="row">
						<div class="col-md-6 text-center text-md-left">
						</div>
						<div class="col-md-6 text-center text-md-right">
							<ol class="breadcrumb">
								<li>
									<a href="/">
										<span>
											<i class="rt-icon2-home"></i>
										</span>
									</a>
								</li>
								<li>
									<a href="obavijesti.html">Obavijesti</a>
								</li>
								<li class="active"><?= $row['naslov'] ?></li>
							</ol>
						</div>
					</div>
				</div>
			</section>

			<section id="content" class="ls section_padding_top_100 section_padding_bottom_75">
				<div class="container">
					<div class="row">

						<div class="col-sm-10 col-sm-push-1">

							<article class="post type-post with-share-buttons">
								<header class="entry-header">

									<h1 class="entry-title"><?= $row['naslov'] ?></h1>

									<span class="date">
											<time datetime="<?= $row['datum'] ?>" class="entry-date">
												<i class="rt-icon2-calendar5 highlight2"></i>
												<?php $date = new DateTime($row['datum']);
												echo date_format($date, 'd.m.Y') ?>
											</time>
										</span>

								</header>
								<!-- .entry-header -->


								<div class="entry-thumbnail divider_40">
									<img src="<?= $row['url'] ?>" alt="<?= $row['naslov'] ?>">
								</div>

								<div class="entry-excerpt">
								    <?= $row['tekst'] ?>
								</div>
								<!-- .entry-content -->


							

								

							</article>


						

						</div>
						<!--eof .col-sm-10 (main content)-->

					</div>
				</div>
			</section>


			

			<?php include('footer.php'); ?>