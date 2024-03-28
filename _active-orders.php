<div class="bg-dark text-secondary">
	<div class="container">
		<div class="p-1 bg-dark">
			<div class="container-fluid py-0">
				<h5 class="mt-3 mb-3">Active Orders</h5>
				<div class="row">
				<?
				$sql="SELECT
				orders.metadata,
				orders.token_id,
				orders.nft_id,
				orders.nft_order
				FROM orders
				WHERE 
				is_valid=1";
				$q=$GLOBALS['dbh']->prepare($sql);
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
						<div class="col-md-3 mb-3">
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
									<h6 class="card-title"><?=$metadata->name?><span class="float-end">#<?=$row["nft_id"]?></span></h6>
									<p><?=$name?></p>
									<p class="card-text card-nft-desc">
										<?=$metadata->description?>
									</p>
									<a href="assets/<?=$row["token_id"]?>/<?=$row["nft_id"]?>" class="btn btn-outline-secondary stretched-link">BUY</a>
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
					<p class="col-md-8 fs-4">No NFT sale order found</p>
					<?
				}
				?>
				</div>
			</div>
		</div>
	</div>
</div>