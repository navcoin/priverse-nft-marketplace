<?=title("Asset Details")?>
<?
$sql="SELECT name,metadata FROM collections WHERE token_id=:token_id LIMIT 1";
try
{
	$q=$GLOBALS['dbh']->prepare($sql);
	$q->bindParam(':token_id',$_GET["token_id"], PDO::PARAM_STR);
	$q->execute();
	if ($q->rowCount()>0)
	{
		$row=$q->fetch(PDO::FETCH_ASSOC);
		$metadata=json_decode($row["metadata"]);
		$name=$row["name"];
		?>
		<div class="bg-dark text-secondary">
			<div class="container">
				<div class="p-1 bg-dark">
					<div class="container-fluid py-0">
						<div class="row">
							<div class="col-md-4">
								<?
								if ($metadata->image)
								{
								?>
								<img class="img-thumbnail" src="<?=ipfs_to_url($metadata->image)?>" style="max-height: 300px;width: auto"/>
								<?
								}
								?>
							</div>
							<div class="col-md-8">
								<h4 class="display-5 fw-bold"><?=$name?></h4>
								<p class="col-md-8 fs-4"><?=$metadata->description?></p>
								<p class="col-md-8 fs-4">Category : <?=$metadata->category?></p>
								<a class="btn btn-primary" target="_blank" href="<?=$metadata->external_url?>"><i class="fas fa-link"></i>&nbsp;<?=$metadata->external_url?></a>
							</div>
						</div>
						<?
						$sql="SELECT
						orders.metadata,
						orders.token_id,
						orders.nft_id,
						orders.nft_order
						FROM orders
						WHERE 
						orders.token_id=:token_id
						AND orders.nft_id=:nft_id
						AND is_valid=1 LIMIT 1";
						try
						{
							$q=$GLOBALS['dbh']->prepare($sql);
							$q->bindParam(':token_id',$_GET["token_id"], PDO::PARAM_STR);
							$q->bindParam(':nft_id',$_GET["nft_id"], PDO::PARAM_STR);
							$q->execute();
							if ($q->rowCount()>0)
							{
								$row=$q->fetch(PDO::FETCH_ASSOC);
								$nft=json_decode($row["metadata"]);
								$nft_order=json_decode($row["nft_order"]);
								$metadata=json_decode($nft->metadata);
								?>
								<div class="modal" tabindex="-1" id="myModal">
									<div class="modal-dialog modal-dialog-centered modal-lg">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title">Purchase with QR Code</h5>
												<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
											</div>
											<div class="modal-body">
												<div class="row">
													<div class="col-md-6">
														<?
														$media_type=explode("/",$metadata->attributes->content_type)[0];
														if ($media_type=="image")
														{
														?>
														<img src="<?=ipfs_to_url($metadata->attributes->thumbnail_url)?>" class="img-thumbnail" style="width: 256px;height: auto" alt="<?=$metadata->name?>">
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
														<h5 class="card-title mt-2"><?=$metadata->name?> #<?=$row["nft_id"]?></h5>
														<p class="card-text"><?=$metadata->description?></p>
														<p class="card-text">Price : <img style="width:32px;height:32px;" src="images/xnav-logo-no-border.svg"/><?=navoshi_to_nav($nft_order->pay[0]->amount)?></p>
													</div>
													<div class="col-md-6">
														<div id="canvas"></div>
														<p class="card-text mt-3">Tap Marketplace in your NEXT mobile wallet and scan the QR Code to complete the purchase.</p>
													</div>
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3 mt-5">
										<div class="card bg-dark">
											<?
											$media_type=explode("/",$metadata->attributes->content_type)[0];
											if ($media_type=="image")
											{
											?>
											<img src="<?=ipfs_to_url($metadata->attributes->thumbnail_url)?>" class="img-thumbnail rounded shadow" alt="<?=$metadata->name?>">
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
										</div>
									</div>
									<div class="col-md-9 mt-5" id="app">
										<div class="card bg-dark text-white border border-secondary">
											<div class="card-body">
												<h4>Buy Asset</h4>
												<h5 class="card-title"><?=$metadata->name?><span class="float-end">#<?=$row["nft_id"]?></span></h5>
												<p class="card-text"><?=$metadata->description?><span class="float-end" style="font-size:12pt;font-weight: normal;"><img style="width:12px;height:12px;"  src="images/xnav-logo-white-no-border.png"/>&nbsp;<?=navoshi_to_nav($nft_order->pay[0]->amount)?></span></p>
												<button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#myModal"><i class="fa-solid fa-qrcode"></i>&nbsp;Purchase with QR Code</button>
												<button type="button" class="btn btn-primary mb-3" v-on:click="purchaseNftWithWallet()"><i class="fa-solid fa-wallet"></i>&nbsp;Purchase with Web Wallet</button>
											</div>
										</div>
									</div>
								</div>
								<script type="text/javascript">
									const qrCode = new QRCodeStyling({
										width: 300,
										height: 300,
										type: "svg",
										data: "navcoin-nft-order:<?=$_GET["token_id"].":".$_GET["nft_id"]?>",
										image: "https://raw.githubusercontent.com/anquii/navcoin-assets/main/xnav/xnav-logo-border.svg",
										dotsOptions: {
											color: "#4267b2",
											type: "rounded"
										},
										backgroundOptions: {
											color: "#e9ebee",
										},
										imageOptions: {
											crossOrigin: "anonymous",
											margin: 20
										}
									});
									qrCode.append(document.getElementById("canvas"));
								</script>
								<script>
								var app = new Vue({
									el: '#app',
									methods:
									{
										purchaseNftWithWallet()
										{
											let order=<?=json_encode($nft_order)?>;
											console.log("Purchase NFT with wallet");
											console.log(order);
											Web3.AcceptOrder({order:order});
										}
									}
								});
								</script>
							<?
							}
							else
							{
								?>
								<p class="col-md-8 fs-4">No NFT sale order found</p>
								<?
							}
						}
						catch (PDOException $e)
						{
							echo $e->getMessage();
						}
						?>
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
