<?=title("Categories")?>
<div class="bg-dark text-secondary">
	<div class="container">
		<div class="row flex-lg-row-reverse align-items-center py-5">
			<div class="col-lg-12">
				<h1 class="display-5 fw-bold lh-1 mt-3 mb-3 text-white">Explore Collections</h1>
			</div>
		</div>
	</div>
</div>
<?
$sql="SELECT id,name,tag,icon FROM categories";
try
{
	$q=$GLOBALS['dbh']->prepare($sql);
	$q->execute();
	if ($q->rowCount()>0)
	{
	?>
	<div class="bg-dark text-white">
		<div class="container">
			<div class="p-1 bg-dark">
				<div class="container-fluid py-0">
					<div class="row">
					<?
					while ($row=$q->fetch(PDO::FETCH_ASSOC))
					{
						$sqlx="SELECT * FROM `collections` WHERE JSON_EXTRACT(metadata, '$.category')=:category AND network_id=:network_id";
						$qx=$GLOBALS['dbh']->prepare($sqlx);
						$qx->bindParam(':category',$row["tag"], PDO::PARAM_STR);
						$qx->bindParam(':network_id',$GLOBALS['network_id'], PDO::PARAM_STR);
						$qx->execute();
						?>
						<div class="col-md-4">
							<div class="card text-white bg-dark mb-3">
								<div class="card-header">
									<a href="category/<?=$row["tag"]?>" class="text-decoration-none text-white stretched-link">
										<i class="<?=$row["icon"]?>"></i>&nbsp;<?=$row["name"]?>
									</a>
									<span class="text-secondary float-end"><?=$qx->rowCount()?> Collection</span>
								</div>
								<div class="card-body" style="height: 200px; background-repeat: no-repeat;background-size: cover;background-image: url('images/category/<?=$row["tag"]?>.jpg');">
								</div>
							</div>
						</div>
						<?
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?
	}
	else
	{
		?>
		<div class="bg-dark text-secondary">
			<div class="container">
				<div class="p-1 bg-dark">
					<div class="container-fluid py-5">
						<h1 class="display-5 fw-bold">Not Found</h1>
						<p class="col-md-8 fs-4">Category not found</p>
					</div>
				</div>
			</div>
		</div>
		<?
	}
}
catch (PDOException $e)
{
	echo $e->getMessage();
}
?>
