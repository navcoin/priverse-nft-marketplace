<?=title("Stats")?>
<?
$sql="SELECT COUNT(id) AS t from collections";
$q=$GLOBALS['dbh']->prepare($sql);
$q->execute();
if ($q->rowCount()>0)
{
	$row=$q->fetch(PDO::FETCH_ASSOC);
	$t_collections=$row["t"];
}
$sql="SELECT COUNT(id) AS t FROM `orders` WHERE is_valid=1";
$q=$GLOBALS['dbh']->prepare($sql);
$q->execute();
if ($q->rowCount()>0)
{
	$row=$q->fetch(PDO::FETCH_ASSOC);
	$t_active_order=$row["t"];
}
$sql="SELECT COUNT(id) AS t FROM `orders` WHERE is_valid=0";
$q=$GLOBALS['dbh']->prepare($sql);
$q->execute();
if ($q->rowCount()>0)
{
	$row=$q->fetch(PDO::FETCH_ASSOC);
	$t_completed_order=$row["t"];
}
?>
<div class="bg-dark text-white">
	<div class="container">
		<div class="p-1 bg-dark">
			<div class="container-fluid py-0">
				<div class="container px-4 py-5" id="featured-3">
					<h1 class="mb-3">Stats</h1>
					<div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
						<div class="feature col">
							<div class="feature-icon bd-bg-purple-bright bg-gradient">
								<i class="bi fa-solid fa-images" width="1em" height="1em"></i>
							</div>
							<h3>Collections</h3>
							<p><?=$t_collections?></p>
						</div>
						<div class="feature col">
							<div class="feature-icon bg-warning bg-gradient">
								<i class="bi fa-solid fa-clock" width="1em" height="1em"></i>
							</div>
							<h3>Active Orders</h3>
							<p><?=$t_active_order?></p>
						</div>
						<div class="feature col">
							<div class="feature-icon bg-success bg-gradient">
								<i class="bi fa-solid fa-circle-check" width="1em" height="1em"></i>
							</div>
							<h3>Completed Orders</h3>
							<p><?=$t_completed_order?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>