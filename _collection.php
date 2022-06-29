<?
$sql="SELECT name,metadata FROM collections WHERE token_id=:token_id AND network_id=:network_id LIMIT 1";
try
{
	$q=$GLOBALS['dbh']->prepare($sql);
	$q->bindParam(':token_id',$_GET["token_id"], PDO::PARAM_STR);
	$q->bindParam(':network_id',$GLOBALS['network_id'], PDO::PARAM_STR);
	$q->execute();
	if ($q->rowCount()>0)
	{
		$row=$q->fetch(PDO::FETCH_ASSOC);
		$metadata=json_decode($row["metadata"]);
		$name=$row["name"];
		title($row["name"]);
		?>
		<div class="bg-dark text-secondary">
			<div class="container">
				<div class="p-1 bg-dark">
					<div class="container-fluid py-0">
						<div class="row">
							<div class="col-md-4">
								<img class="img-thumbnail" src="<?=ipfs_to_url($metadata->image)?>" style="max-height: 300px;width: auto"/>
							</div>
							<div class="col-md-8">
								<h4 class="display-5 fw-bold"><?=$name?></h4>
								<p class="col-md-8 fs-4"><?=$metadata->description?></p>
								<p class="col-md-8 fs-4">Category : <?=$metadata->category?></p>
								<a class="btn btn-primary" target="_blank" href="<?=$metadata->external_url?>"><i class="fas fa-link"></i>&nbsp;<?=$metadata->external_url?></a>
							</div>
						</div>
						<h5 class="mt-5">NFTs on sale in this collection</h5>
						<div class="row">
						<?
						$sql="SELECT
						orders.metadata,
						orders.token_id,
						orders.nft_id,
						orders.nft_order
						FROM orders
						WHERE 
						orders.token_id=:token_id
						AND is_valid=1";
						$q=$GLOBALS['dbh']->prepare($sql);
						$q->bindParam(':token_id',$_GET["token_id"], PDO::PARAM_STR);
						$q->execute();
						if ($q->rowCount()>0)
						{
							while ($row=$q->fetch(PDO::FETCH_ASSOC))
							{
								$nft=json_decode($row["metadata"]);
								$nft_order=json_decode($row["nft_order"]);
								$metadata=json_decode($nft->metadata);
								$name=$row["name"];
								?>
								<div class="col-md-3 m-3">
									<div class="card bg-black text-secondary" style="max-width: 18rem;">
									<?
										$media_type=explode("/",$metadata->attributes->content_type)[0];
										if ($media_type=="image")
										{
										?>
										<img src="<?=ipfs_to_url($metadata->attributes->thumbnail_url)?>" class="card-img-top" alt="<?=$metadata->name?>">
										<?
										}
										else if ($media_type=="audio")
										{
										?>
										<audio class="mt-3" controls style="width:100%" class="p-1">
											<source src="<?=ipfs_to_url($metadata->image)?>" type="audio/ogg">
											<source src="<?=ipfs_to_url($metadata->image)?>" type="audio/mpeg">
											Your browser does not support the audio element.
										</audio>
										<?
										}
										else if ($media_type=="video")
										{
										?>
										<video controls playsinline style="width:100%" class="p-1">
											<source src="<?=ipfs_to_url($metadata->image)?>" type="video/mp4">
											<source src="<?=ipfs_to_url($metadata->image)?>" type="video/ogg">
											Your browser does not support the video element.
										</video>
										<?
										}
										?>
										<div class="card-body">
											<h5 class="card-title"><?=$metadata->name?><span class="float-end">#<?=$row["nft_id"]?></span></h5>
											<p><?=$name?></p>
											<p class="card-text"><?=$metadata->description?><span class="float-end"><img style="width:12px;height:12px;" src="images/xnav-logo-white-no-border.png"/>&nbsp;<?=navoshi_to_nav($nft_order->pay[0]->amount)?></span></p>
											<a href="assets/<?=$row["token_id"]?>/<?=$row["nft_id"]?>" class="btn btn-outline-secondary stretched-link">BUY</a>
										</div>
									</div>
								</div>
								<?
							}
						}
						else
						{
							?>
							<p class="col-md-8 fs-4">No NFT sale order found</p>
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
						<p class="col-md-8 fs-4">Collection not found</p>
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
