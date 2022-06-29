<?
$sql="SELECT id,name,tag,icon FROM categories WHERE tag=:tag LIMIT 1";
try
{
	$q=$GLOBALS['dbh']->prepare($sql);
	$q->bindParam(':tag',$_GET["tag"], PDO::PARAM_STR);
	$q->execute();
	if ($q->rowCount()>0)
	{
		$row=$q->fetch(PDO::FETCH_ASSOC);
		title($row["name"]);
		$sql="SELECT * FROM `collections` WHERE JSON_EXTRACT(metadata, '$.category')=:category AND network_id=:network_id";
		$q=$GLOBALS['dbh']->prepare($sql);
		$q->bindParam(':category',$_GET["tag"], PDO::PARAM_STR);
		$q->bindParam(':network_id',$GLOBALS['network_id'], PDO::PARAM_STR);
		$q->execute();
		?>
		<div class="bg-dark text-white">
			<div class="container">
				<div class="p-1 bg-dark">
					<div class="container-fluid py-0">
						<div class="row">
							<div class="col-md-12">
								<h4 class="display-5 fw-bold"><i class="<?=$row["icon"]?>"></i>&nbsp;<?=$row["name"]?></h4>
								<p class="text-secondary"><?=$q->rowCount()?> Collection</p>
							</div>
						</div>
						<div class="row">
						<?
						if ($q->rowCount()>0)
						{
							while ($row=$q->fetch(PDO::FETCH_ASSOC))
							{
								$metadata=json_decode($row["metadata"]);
								?>
								<div class="col-md-3 mt-3 mb-3 text-secondary">
									<div class="card bg-black text-secondary">
										<img src="<?=ipfs_to_url($metadata->attributes->thumbnail_url)?>" class="card-img-top" alt="<?=$metadata->name?>">
										<div class="card-body">
											<h5 class="card-title">
												<?=$metadata->name?>
											</h5>
											<p><?=$metadata->description?></p>
											<!--<p class="card-text">Max Supply : <?=$row["supply"]?></p>!-->
											<a href="collection/<?=$row["token_id"]?>" class="btn btn-outline-secondary stretched-link"><i class="fa-solid fa-eye"></i>&nbsp;VIEW</a>
										</div>
									</div>
								</div>
								<?
							}
						}
						else
						{
							?>
							<p class="col-md-8 fs-4">No collection found in this category</p>
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
