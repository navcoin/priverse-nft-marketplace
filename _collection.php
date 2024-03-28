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
						<div class="d-flex flex-row bd-highlight mb-3">
							<div class="p-2 bd-highlight">
								<?
								if ($metadata->attributes->thumbnail_url)
								{
								?>
								<img class="img-thumbnail" src="<?=ipfs_to_url($metadata->image)?>" style="max-height: 128px;width: auto"/>
								<?
								}
								else
								{
								?>
								<center>
									<i class="fas fa-image fa-9x text-secondary" style="height: 40vh"></i>
								</center>
								<?
								}
								?>
							</div>
							<div class="p-2 bd-highlight flex-fill">
								<h4><?=$name?></h4>
								<p class="col-md-8 fs-4"><?=$metadata->description?></p>
								<p class="col-md-8 fs-6">Category : <?=$metadata->category?></p>
								<?
								if ($metadata->external_url)
								{
								?>
								<a class="btn btn-primary" target="_blank" href="<?=$metadata->external_url?>"><i class="fas fa-link"></i>&nbsp;External URL</a>
								<?
								}
								?>
							</div>
						</div>
						<h5 class="mt-5"><i class="fa-solid fa-cart-arrow-down"></i>&nbsp;NFTs on sale in this collection</h5>
						<div class="row">
						<?
						$sql="SELECT
						orders.id,
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
								<div class="col-md-3 mr-3 mt-3 mb-3" title="<?=$row["id"]?>">
									<div class="card bg-black text-secondary" style="max-width: 18rem;">
									<?
										$media_type=explode("/",$metadata->attributes->content_type)[0];
										if ($media_type=="image")
										{
											if ($metadata->attributes->thumbnail_url)
											{
											?>
											<img src="<?=ipfs_to_url($metadata->attributes->thumbnail_url)?>" class="card-img-top" alt="<?=$metadata->name?>">
											<?
											}
											else
											{
											?>
											<center>
												<i class="fas fa-image fa-9x text-secondary" style="height: 40vh"></i>
											</center>
											<?
											}
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
										else
										{
											?>
											<center>
												<i class="fas fa-image fa-9x text-secondary" style="height: 40vh"></i>
											</center>
											<?
										}
										?>
										<div class="card-body">
											<h6 class="card-title"><?=$metadata->name?><span class="float-end">#<?=$row["nft_id"]?></span></h6>
											<p><?=$name?></p>
											<p class="card-text card-nft-desc">
												<?=$metadata->description?>
											</p>
											<a href="assets/<?=$row["token_id"]?>/<?=$row["nft_id"]?>" class="btn btn-outline-secondary">BUY</a>
											<span class="float-end">
												<img style="width:32px;height:32px;"  src="images/xnav-logo-border.png"/>
												<?=navoshi_to_nav($nft_order->pay[0]->amount)?>
											</span>
										</div>
									</div>
								</div>
								<?
							}
						}
						else
						{
							?>
							<p class="col-md-8 fs-6">No NFT sale order found in this collection.</p>
							<?
						}
						?>
					</div>
						<h5 class="mt-5"><i class="fa-solid fa-images"></i>&nbsp;Available NFTs in this collection</h5>
						<div class="row">
						<?
						$sql="SELECT
						nfts.nft_id,
						nfts.metadata
						FROM nfts
						WHERE 
						nfts.token_id=:token_id";
						$q=$GLOBALS['dbh']->prepare($sql);
						$q->bindParam(':token_id',$_GET["token_id"], PDO::PARAM_STR);
						$q->execute();
						if ($q->rowCount()>0)
						{
							while ($row=$q->fetch(PDO::FETCH_ASSOC))
							{
								$metadata=json_decode($row["metadata"]);
								$name=$row["name"];
								?>
								<div class="col-md-3 mr-3 mt-3 mb-3">
									<div class="card bg-black text-secondary" style="max-width: 18rem;">
									<?
										$media_type=explode("/",$metadata->attributes->content_type)[0];
										if ($media_type=="image")
										{
											if ($metadata->attributes->thumbnail_url)
											{
											?>
											<img src="<?=ipfs_to_url($metadata->attributes->thumbnail_url)?>" class="card-img-top" alt="<?=$metadata->name?>">
											<?
											}
											else
											{
											?>
											<center>
												<i class="fas fa-image fa-9x text-secondary" style="height: 40vh"></i>
											</center>
											<?
											}
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
										else
										{
											?>
											<center>
												<i class="fas fa-image fa-9x text-secondary" style="height: 40vh"></i>
											</center>
											<?
										}
										?>
										<div class="card-body">
											<h6 class="card-title"><?=$metadata->name?><span class="float-end">#<?=$row["nft_id"]?></span></h6>
											<p><?=$name?></p>
											<p class="card-text card-nft-desc">
												<?=$metadata->description?>
											</p>
										</div>
									</div>
								</div>
								<?
							}
						}
						else
						{
							?>
							<p class="col-md-8 fs-6">No NFT found in this collection.</p>
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
