<html>
	<head>
		<base href="/">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="bootstrap-5.1.3-dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<link href="css/features.css" rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
		<link rel="apple-touch-icon" sizes="180x180" href="images/favicons/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="images/favicons/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="images/favicons/favicon-16x16.png">
		<link rel="manifest" href="images/favicons/site.webmanifest">
		<script type="text/javascript" src="bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
		<script type="text/javascript" src="https://unpkg.com/qr-code-styling@1.5.0/lib/qr-code-styling.js"></script>
		<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@5/dark.css">
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
		<script src="js/web3.js?token=123456"></script>
		<script src="js/sb.js"></script>
		<style>
			footer a
			{
				color: inherit;
				text-decoration: none;
				transition: all 0.3s;
			}
			footer a:hover, a:focus {
				text-decoration: none;
			}
			.card-img-top {
				width: 100%;
				height: 40vh;
				object-fit: contain;
			}
			.card-nft-desc {
				height: 70px;
				overflow-y: hidden;
			}
			.img-thumbnail {
				background-color: #25282d;
				border: 1px solid #25282d;
			}
			.bd-bg-purple-bright {
				background-color: #7952b3;
			}
			.bg-black
			{
				background-color: #121212 !important;
						}
			.modal-backdrop
			{
				display: none;
			}
			.modal
			{
				background: rgba(0,0,0,0.5);
			}
			.modal-header
			{
				border-bottom-color: #343434;
			}
			.modal-footer
			{
				border-top-color: #343434;
			}
			.btn-circle.btn-xl {
			    width: 70px;
			    height: 70px;
			    padding: 10px 16px;
			    border-radius: 35px;
			    font-size: 24px;
			    line-height: 1.33;
			}
			.btn-circle {
			    width: 26px;
			    height: 26px;
			    padding: 6px 0px;
			    border-radius: 15px;
			    text-align: center;
			    font-size: 12px;
			    line-height: 1.42857;
			}
			::-webkit-scrollbar {
			    background-color: rgba(33,37,41);
			    width: 16px;
			}

			/* background of the scrollbar except button or resizer */
			::-webkit-scrollbar-track {
			    background-color: rgba(33,37,41);
			}

			/* scrollbar itself */
			::-webkit-scrollbar-thumb {
			    background-color: #121212;
			    border-radius: 16px;
			    border: 4px solid rgba(33,37,41);
			}

			/* set button(top and bottom of the scrollbar) */
			::-webkit-scrollbar-button {
			    display:none;
			}
		</style>
	</head>
	<body class="d-flex flex-column h-100 bg-dark">
	<header class="p-3 bg-dark text-white">
		<div class="container">
			<div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
				<a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
					<img class="bi me-2" width="48" height="48" src="images/logo.png"/>
				</a>
				<ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
					<li><a href="stats" class="nav-link px-2 text-white">Stats</a></li>
					<li><a href="resources" class="nav-link px-2 text-white">Resources</a></li>
					<li class="nav-item dropdown">
						<a class="nav-link px-2 text-white dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
						Create
						</a>
						<ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
							<li style="height: 40px;">
								<a class="dropdown-item" href="create-collection">
									<i class="fa-solid fa-hammer"></i>&nbsp;Create Collection
								</a>
							</li>
							<!--<li style="height: 40px;">
								<a class="dropdown-item" href="create-nft">
									<i class="fa-solid fa-image"></i>&nbsp;Create NFT
								</a>
							</li>!-->
						</ul>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link px-2 text-white dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
						Explore
						</a>
						<ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
						<li style="height: 40px;">
							<a class="dropdown-item" href="category/all">
								<i class="fas fa-list"></i>&nbsp;All Collections
							</a>
						</li>
						<div class="dropdown-divider"></div>
						<?
							$sql="SELECT
							id,
							name,
							tag,
							icon
							FROM categories";
							$q=$GLOBALS['dbh']->prepare($sql);
							$q->execute();
							if ($q->rowCount()>0)
							{
								while ($row=$q->fetch(PDO::FETCH_ASSOC))
								{
									?>
									<li style="height: 40px;">
										<a class="dropdown-item" href="category/<?=$row["tag"]?>">
											<i class="<?=$row["icon"]?>"></i>&nbsp;<?=$row["name"]?>
										</a>
									</li>
									<?
								}
							}
							?>
						</ul>
					</li>
				</ul>
				<form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" method="get" action="search">
					<div class="input-group">
						<span class="bg-dark border border-secondary text-secondary input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
						<input type="search" name="q" id="q" class="form-control form-control-dark bg-dark text-secondary border border-secondary" placeholder="Search..." aria-label="Search">
					</div>
				</form>
				<div class="text-end" id="mapp">
					<div class="btn-group">
						<button type="button" class="btn btn-outline-secondary"><i class="fa-solid fa-globe"></i>&nbsp;<?=$GLOBALS['network']?></button>
						<button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
							<span class="visually-hidden">Toggle Dropdown</span>
						</button>
						<ul class="dropdown-menu dropdown-menu-dark">
							<li><a class="dropdown-item" href="switch-network?network=mainnet"><i class="fa-solid fa-m"></i>&nbsp;Mainnet</a></li>
							<li><a class="dropdown-item" href="switch-network?network=testnet"><i class="fa-solid fa-flask"></i>&nbsp;Testnet</a></li>
						</ul>
					</div>
					<span v-if="is_extension_installed">
						<span v-if="status==0">
							<a v-on:click="connectWallet" class="btn btn-info"><i class="fa-solid fa-wallet"></i>&nbsp;Connect</a>
						</span>
						<span v-else>
							<a v-if="status==1" type="button" href="profile" class="btn btn-outline-secondary me-2"><i class="fa-solid fa-wallet"></i>&nbsp;Wallet</a>
							<span class="badge bg-success p-2" :title="address"><i class="fa-solid fa-check"></i>&nbsp;Connected</span>
						</span>
					</span>
					<span v-else>
						<a target="_blank" href="https://chrome.google.com/webstore/detail/navcoin-wallet/mehadhhadnkkdajgmdoebkgfldobcded" class="btn btn-outline-secondary"><i class="fa-solid fa-puzzle-piece"></i>&nbsp;Install Extension</a>
					</span>
				</div>
			</div>
		</div>
	</header>
	<script>
		var Web3 = new Web3SDK({
			"network":"<?=$GLOBALS['network']?>",
			"log":true
		});
		const event_on_wallet_connected = new Event('on_wallet_connected');
		const event_on_wallet_disconnected = new Event('on_wallet_disconnected');
		var mapp = new Vue({
			el: '#mapp',
			data:
			{
				status:0,
				is_extension_installed:false,
				address:undefined
			},
			methods:
			{
				connectWallet: function()
				{
					console.log("connecting to extension...");
					Web3.Connect();
				},
				disconnectWallet:function()
				{
					this.status=0;
					this.address=undefined;
				},
				loginWallet:function()
				{
					console.log("Login by wallet address -> " + this.address);
					axios.post('_wallet-login.php',{wallet_address:this.address},{headers:{'Content-Type':'multipart/form-data'}}).then(function(response)
					{
						console.log(response.data);
						if (response.data.success)
						{
							console.log("Wallet login success!");
							document.dispatchEvent(event_on_wallet_connected);
						}
						else
						{
							console.log("Wallet login failed!");
							console.log("Reason:"+response.data.message);
						}
					})
					.catch(function()
					{
						console.log("Wallet login failed!");
					});
				},
				logoutWallet:function()
				{
					console.log("Logging out...");
					axios.post('_wallet-logout.php',{},{headers:{'Content-Type':'multipart/form-data'}}).then(function(response)
					{
						console.log(response);
						if (response.data.success)
						{
							console.log("Wallet logout success!");
							document.dispatchEvent(event_on_wallet_disconnected);
						}
						else
						{
							console.log("Wallet logout failed!");
							console.log("Reason:"+response.data.message);
						}
					})
					.catch(function()
					{
						console.log("Wallet logout failed!");
					});
				}
			}
		});
		window.addEventListener("message", (event) =>
		{
			if (event.data)
			{
				console.log(event);
				if (event.data.type=="extension")
				{
					mapp.is_extension_installed=true;
					console.log('Extension version: ', event.data.version);
					console.log('Is connected: ', event.data.connected);
					console.log('Address : ', event.data.address);
					if (event.data.connected)
					{
						mapp.status=1;
						mapp.address=event.data.address;
						mapp.loginWallet();
					}
					else
					{
						mapp.logoutWallet();
					}
				}
			}
		}, true);
		function accept_connection(address)
		{
			console.log("accept connection -> " + address);
			mapp.status=1;
			mapp.address=address;
			mapp.loginWallet();
			Swal.fire({
					  position: 'top-end',
					  icon: 'success',
					  title: "Wallet Connect",
					  text: "Connection request has been accepted",
					  showConfirmButton: false,
					  timer: 3000
					})
		}
		function reject_connection()
		{
			console.log("connection request rejected");
			Swal.fire({
					  position: 'top-end',
					  icon: 'warning',
					  title: "Wallet Connect",
					  text: "Connection request has been rejected by wallet",
					  showConfirmButton: false,
					  timer: 3000
					})
		}
		function reject_wrong_network(network)
		{
			console.log("connection request rejected/wrong network");
			Swal.fire({
					  position: 'top-end',
					  icon: 'warning',
					  title: "Wrong Network",
					  text: "Your network (<?=$GLOBALS['network']?>) is different than wallet's network ("+network+"). Please change your network or close your active wallet and retry...",
					  showConfirmButton: false,
					  timer: 5000
					})
		}
		function create_nft_collection(result,tx)
		{
			console.log("create nft collection");
			console.log("result -> " + result);
			if (result)
			{
				console.log(tx.hashes[0]);
				Swal.fire({
					title: 'The NFT collection has been created.',
					text: "Your NFT collection has been successfully created, would you like to go to the page to add items to your NFT collection?",
					icon: 'question',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Yes!'
				}).then((result) => 
				{
					if (result.isConfirmed)
					{
						window.location.href="profile?section=nft-collections";
					}
				});
			}
			else
			{
				Swal.fire({
					icon: 'warning',
					title: 'Create NFT Collection',
					text: 'Create NFT Collection request rejected by wallet.',
				})
			}
		}
		function create_nft(result)
		{
			if (result)
			{
				console.log("create nft -> " + result);
				Swal.fire({
					title: 'The NFT has been created.',
					text: "Your NFT has been successfully created, would you like to go to the NFT's collection page?",
					icon: 'question',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Yes!'
				}).then((result) => 
				{
					if (result.isConfirmed)
					{
						window.location.href="profile?section=nft-collections";
					}
				});
			}
			else
			{
				Swal.fire({
					icon: 'warning',
					title: 'Create NFT',
					text: 'Create NFT request rejected by wallet.',
				})
			}
		}
	</script>