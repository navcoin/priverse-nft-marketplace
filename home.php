<?=title("Private NFT Marketplace")?>
<div class="bg-dark text-secondary">
	<div class="container">
		<div class="row flex-lg-row-reverse align-items-center py-5">
			<div class="col-12 col-sm-8 col-lg-6">
				<img src="images/hero_02.jpg" class="d-block mx-lg-auto img-fluid shadow rounded thumbnail-box-shadow" alt="Bootstrap Themes" width="600" height="400" loading="lazy">
			</div>
			<div class="col-lg-6">
				<h1 class="display-5 fw-bold lh-1 mt-3 mb-3 text-white">Discover, collect, and sell Private NFTs</h1>
				<p class="lead">Priverse NFT Marketplace is the world's first and largest private NFT marketplace built on Navcoin blockchain.</p>
				<div class="d-grid gap-2 d-md-flex justify-content-md-start">
					<a type="button" class="btn btn-primary btn-lg px-4 me-md-2" href="categories"><i class="fa-solid fa-layer-group"></i>&nbsp;Explore</a>
					<a type="button" class="btn btn-outline-secondary btn-lg px-4" href="create-collection"><i class="fa-solid fa-file-circle-plus"></i>&nbsp;Create</a>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="bg-dark text-secondary">
	<div class="container px-4 py-5" id="featured-3">
		<h2 class="pb-2">Create and sell your NFTs</h2>
		<div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
			<div class="feature col">
				<div class="feature-icon bg-primary bg-gradient">
					<i class="bi fa-solid fa-eye-low-vision" width="1em" height="1em"></i>
				</div>
				<h3>For Creators</h3>
				<p>NFT artists get to enjoy the freedom to create the art of their imagination without any concern of privacy. Navcoin privacy technology blsCT keeps sender and receiver identity private.</p>
			</div>
			<div class="feature col">
				<div class="feature-icon bg-primary bg-gradient">
					<i class="bi fa-solid fa-user-lock" width="1em" height="1em"></i>
				</div>
				<h3>For Buyers</h3>
				<p>NFT buyers can make purchases anonymously through their own wallets without sharing any personal information.</p>
			</div>
			<div class="feature col">
				<div class="feature-icon bg-primary bg-gradient">
					<i class="bi fa-solid fa-earth-americas" width="1em" height="1em"></i>
				</div>
				<h3>Decentralized</h3>
				<p>Marketplace is completely decentralized. No user data is stored and all NFTs trading is done on user wallets.</p>
			</div>
		</div>
	</div>
</div>

<div class="bg-dark text-secondary">
	<div class="container px-4 py-5">
		<div class="row flex-lg-row-reverse align-items-center g-5 py-5">
			<div class="col-12 col-sm-12 col-lg-6">
				<img src="images/nft_01.jpg" class="d-block mx-lg-auto rounded img-fluid" alt="Bootstrap Themes" width="700" height="500" loading="lazy">
			</div>
			<div class="col-lg-6">
				<h2 class="display-5 fw-bold lh-1 mb-3">Private NFTs</h2>
				<p class="lead">With NFTs gaining traction, we're seeing such incredible creativity blossom from the minds of artists, and collectors fighting to get their hands on new timeless art pieces. However, public blockchains have shown to leak NFT metadata at large scale (e.g. ownership information) for everyone to see on block explorers. With Navcoin's private NFTs, there's no longer cause for concern.</p>
				<div class="d-grid gap-2 d-md-flex justify-content-md-start">
					<a type="button" class="btn btn-outline-secondary btn-lg px-4" href="https://medium.com/nav-coin/navcoin-is-becoming-a-high-utility-privacy-platform-c05945828c02" target="_blank">Learn More</a>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="bg-dark text-secondary">
	<div class="container px-4 py-5" id="hanging-icons">
		<div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
			<div class="col d-flex align-items-start">
				<div class="icon-square bg-light text-dark flex-shrink-0 me-3">
					<i class="bi fa-solid fa-wallet" width="1em" height="1em"></i>
				</div>
				<div>
					<h3>Get Started</h3>
					<p>You will need a wallet to create, sell and buy NFTs. Click to buton below to install Navcoin Wallet Chrome Extension.</p>
					<a href="download-wallet" class="btn btn-outline-secondary">
						<i class="fa-solid fa-puzzle-piece"></i>&nbsp;Install Extension
					</a>
				</div>
			</div>
			<div class="col d-flex align-items-start">
				<div class="icon-square bg-light text-dark flex-shrink-0 me-3">
					<i class="bi fa-solid fa-images" width="1em" height="1em"></i>
				</div>
				<div>
					<h3>Create NFTs</h3>
					<p>Go to our NFT creation page and quickly create your NFTs in your wallet by providing the necessary information.</p>
					<a href="create-collection" class="btn btn-outline-secondary">
						<i class="fa-solid fa-hammer"></i>&nbsp;Create Collection
					</a>
				</div>
			</div>
			<div class="col d-flex align-items-start">
				<div class="icon-square bg-light text-dark flex-shrink-0 me-3">
					<i class="bi fa-solid fa-users-line" width="1em" height="1em"></i>
				</div>
				<div>
					<h3>Join the Community</h3>
					<p>Join our discord server to share knowledge about NFT technology and meet other NFT creators.</p>
					<a target="_blank" href="https://discord.com/invite/y4Vu9jw" class="btn btn-outline-secondary">
						<i class="fa-brands fa-discord"></i>&nbsp;Join Discord Server
					</a>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="bg-dark text-secondary">
	<div class="container">
		<div class="row">
			<?
			$sql="SELECT
			orders.id,
			orders.metadata,
			orders.nft_order,
			orders.token_id,
			orders.nft_id,
			collections.name
			FROM orders 
			LEFT JOIN collections 
			ON orders.token_id=collections.token_id 
			WHERE orders.is_valid=1 
			AND collections.network_id=".$GLOBALS['network_id']." 
			AND orders.is_featured=1 ORDER BY RAND() LIMIT 8";
			try
			{
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
						<div class="col-md-3 mb-3" title="<?=$row["id"]?>">
								<div class="card bg-black text-secondary">
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
			}
			catch (PDOException $e)
			{
				echo $e->getMessage();
			}
			?>
		</div>
	</div>
</div>