<?=title("Profile")?>
<div class="bg-dark text-white">
	<div class="container">
		<div class="p-1 bg-dark">
			<div class="container-fluid py-0">
				<div class="row">
					<div class="col-md-12 mb-5">
						<?
						if ($_GET["section"]=="wallet")
						{
						?>
						<h5 class="display-6 fw-bold"><i class="fa-solid fa-id-card"></i>&nbsp;Wallet</h5>
						<?
						}
						else if ($_GET["section"]=="create-nft-sell-order")
						{
						?>
						<h5 class="display-6 fw-bold"><i class="fa-solid fa-store"></i>&nbsp;Create NFT Sell Order</h5>
						<?
						}
						else if ($_GET["section"]=="list-nft-sell-orders")
						{
						?>
						<h5 class="display-6 fw-bold"><i class="fa-solid fa-list-check"></i>&nbsp;My NFT Sell Orders</h5>
						<?
						}
						?>
					</div>
					<div class="col-md-3">
						<div class="list-group mb-5" role="tablist">
							<a type="button" href="profile?section=wallet" class="list-group-item list-group-item-action list-group-item-dark <?=(((empty($_GET["section"])||$_GET["section"]=="wallet")&&is_wallet_logged_in())?"active":"")?>" aria-current="true"><i class="fa-solid fa-wallet"></i>&nbsp;Wallet</a>
							<a type="button" href="profile?section=create-nft-sell-order" class="list-group-item list-group-item-action list-group-item-dark <?=($_GET["section"]=="create-nft-sell-order"?"active":"")?>" aria-current="true"><i class="fa-solid fa-store"></i>&nbsp;Create NFT Sell Order</a>
							<a type="button" href="profile?section=list-nft-sell-orders" class="list-group-item list-group-item-action list-group-item-dark <?=($_GET["section"]=="list-nft-sell-orders"?"active":"")?>" aria-current="true"><i class="fa-solid fa-list-check"></i>&nbsp;My NFT Sell Orders</a>
						</div>
					</div>
					<div class="col-md-9">
						<?
						if ((empty($_GET["section"])||$_GET["section"]=="wallet") && is_wallet_logged_in())
						{
							?>
							<div class="row">
								<div class="col-md-12">
									<h3>Welcome</h3>
									<p>
										Using the left menu, you can create a sell order for your NFTs in your wallet or cancel the sell orders you have created before.
									</p>
								</div>
							</div>
							<?
						}
						else if ($_GET["section"]=="create-nft-sell-order")
						{
							?>
							<div class="row" id="app">
								<div class="modal" id="modal-create-sell-order" tabindex="-1">
									<div class="modal-dialog modal-lg">
										<div class="modal-content bg-dark">
									<div class="modal-header">
										<h5 class="modal-title">Confirm NFT Sell Order</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cancel"></button>
									</div>
									<div class="modal-body bg-dark">
										<div class="row">
											<div class="col-md-6">
												<div v-if="nft.attributes">
													<img v-if="nft.attributes.content_type&&nft.attributes.content_type.split('/')[0]=='image'" class="img-thumbnail" :src="ipfs_to_url(nft.image)"/>
													<img v-else/>
													<div style="margin-top:5px;" v-if="nft.attributes.content_type&&nft.attributes.content_type.split('/')[0]=='audio'">
														<audio controls style="width:100%">
															<source :src="ipfs_to_url(nft.image)" type="audio/ogg">
															<source :src="ipfs_to_url(nft.image)" type="audio/mpeg">
															Your browser does not support the audio element.
														</audio>
													</div>
													<div style="margin-top:5px;" v-if="nft.attributes.content_type&&nft.attributes.content_type.split('/')[0]=='video'">
														<video controls playsinline style="width:100%">
															<source :src="ipfs_to_url(nft.image)" type="video/mp4">
															<source :src="ipfs_to_url(nft.image)" type="video/ogg">
															Your browser does not support the audio element.
														</video>
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<p>Collection : {{collection_name}}</p>
												<p>NFT Name : {{nft.name}}</p>
												<p>NFT ID : {{nft_id}}</p>
												<p v-if="nft.attributes&&nft.attributes.content_type">Content Type : {{nft.attributes.content_type}}</p>
												<p>Sale Price (xNAV) : </p>
												<input type="number" step="0.01" class="form-control bg-dark text-white" placeholder="Price" id="price" v-model="price"/>
											</div>
										</div>
									</div>
									<div class="modal-footer bg-dark">
										<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
										<button type="button" class="btn btn-primary" :disabled="!price" data-bs-dismiss="modal" v-on:click="confirmNftSellOrder()">Confirm</button>
									</div>
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div v-if="is_connected">
											<div v-if="Object.keys(collections).length>0">
											<p>You have {{Object.keys(collections).length}} NFT collection(s) in your wallet.</p>
											<div class="card text-white bg-dark mb-5" v-for="(item,key,index) in collections" v-if="parseJSON(item.scheme).version==1">
												<div class="card-header">
													{{item.name}}
												</div>
												<div class="card-body">
													<div class="row">
														<div class="col-md-3 bg-dark" style="border-right:1px dotted #121212">
															<img v-if="parseJSON(item.scheme).image&&ipfs_to_url(parseJSON(item.scheme).image)" class="img-fluid" :src="ipfs_to_url(parseJSON(item.scheme).image)"/>
															<i class="fas fa-image fa-9x text-secondary" v-else></i>
															<div class="pt-3">{{parseJSON(item.scheme).description}}</div>
															<a class="btn btn-outline-secondary text-truncate" target="_blank" :href="parseJSON(item.scheme).external_url"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
														</div>
														<div class="col-md-9 bg-dark">
															<div class="row">
																<div class="col-md-4 mb-5" v-for="(item2,key2,index) in item.confirmed">
																	<div class="align-middle" style="min-height:196px;">
																		<img v-if="parseJSON(item2).attributes.content_type&&parseJSON(item2).attributes.content_type.split('/')[0]=='image'" class="card-img-top rounded" style="max-height:196px !important;" v-else onerror="this.style.display='none'" :src="ipfs_to_url(parseJSON(item2).image)"/>
																		<i class="fas fa-image fa-9x text-secondary" v-else></i>
																	</div>
																	<div>
																		<small>
																			<i v-if="parseJSON(item2).attributes.content_type&&parseJSON(item2).attributes.content_type.split('/')[0]=='audio'" class="fa-solid fa-music mr-3"></i>
																			<i v-if="parseJSON(item2).attributes.content_type&&parseJSON(item2).attributes.content_type.split('/')[0]=='video'" class="fa-solid fa-circle-play mr-3"></i>
																			{{parseJSON(item2).name}}
																			<span class="float-start text-secondary">#{{key2}}&nbsp;</span>
																		</small>
																	</div>
																	<div>
																		<small>
																			{{(parseJSON(item2).description?parseJSON(item2).description:"No description...")}}
																		</small>
																	</div>
																	<div class="pt-3">
																		<a class="btn btn-outline-secondary text-truncate" target="_blank" :href="parseJSON(item2).external_url"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
																	</div>
																	<div style="margin-top:5px;" v-if="parseJSON(item2).attributes.content_type&&parseJSON(item2).attributes.content_type.split('/')[0]=='audio'">
																		<audio controls style="width:100%">
																			<source :src="ipfs_to_url(parseJSON(item2).image)" type="audio/ogg">
																			<source :src="ipfs_to_url(parseJSON(item2).image)" type="audio/mpeg">
																			Your browser does not support the audio element.
																		</audio>
																	</div>
																	<div style="margin-top:5px;" v-if="parseJSON(item2).attributes.content_type&&parseJSON(item2).attributes.content_type.split('/')[0]=='video'">
																		<video onplay="this.webkitEnterFullscreen();" controls playsinline style="width:100%">
																			<source :src="ipfs_to_url(parseJSON(item2).image)" type="video/mp4">
																			<source :src="ipfs_to_url(parseJSON(item2).image)" type="video/ogg">
																			Your browser does not support the audio element.
																		</video>
																	</div>
																	<a class="btn btn-primary mt-3" v-on:click="createNftSellOrder(key,item2,key2,parseJSON(item.scheme).name)"><i class="fa-solid fa-store"></i>&nbsp;Sell</a>
																	</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div v-else>
											Loading NFTs...
										</div>
									</div>
									<div v-else>
										<p>Please connect your wallet first...<p>
									</div>
								</div>
							</div>
							<script>
							var app = new Vue({
								el: '#app',
								data:
								{
									is_connected:false,
									nft:{},
									token_id:undefined,
									nft_id:undefined,
									collection_name:undefined,
									price:'',
									collections:{},
									b_collections_loaded:false
								},
								mounted:function()
								{
									let vm=this;
									document.addEventListener('on_wallet_connected', function (e)
									{
										console.log("on_wallet_connected -> " + mapp.status);
										console.log("Status -> " + mapp.status);
										vm.is_connected=(mapp.status==0?false:true);
										if (mapp.status==0)
										{
											Swal.fire({
												position: 'top-end',
												icon: 'error',
												title: "Wallet not connected",
												showConfirmButton: false,
												timer: 1500
											})
										}
										else
										{
											vm.listNftCollections();
										}
									}, false);
								},
								methods:
								{
									ipfs_to_url: function(link)
									{
										let base_url="https://ipfs.nextwallet.org/ipfs/";
										let e=link.split("ipfs://");
										return base_url+e[1];
									},
									listNftCollections: function()
									{
										console.log("Listing collections...");
										Web3.ListNftCollections();
									},
									parseJSON: function(str)
									{
										try
										{
											return JSON.parse(str);
										}
										catch(err)
										{
											return false;
										}
									},
									createNftSellOrder:function(token_id,nft,nft_id,collection_name)
									{
										this.token_id=token_id;
										this.nft=JSON.parse(nft);
										this.nft_id=nft_id;
										this.collection_name=collection_name;
										this.price="";
										console.log(collection_name);
										console.log(nft);
										console.log(token_id);
										console.log(nft_id);
										var myModal = new bootstrap.Modal(document.getElementById('modal-create-sell-order'), {});
										document.getElementById('modal-create-sell-order').addEventListener('shown.bs.modal', function ()
										{
											document.getElementById("price").focus();
										})
										myModal.show();
									},
									confirmNftSellOrder:function()
									{
										console.log("Confirming nft sell order...")
										console.log(this.token_id);
										console.log(this.nft_id);
										console.log(this.price);
										Web3.CreateNftSellOrder({
												return_order:false,
												submit_order:true,
												api_url:"https://api.nextwallet.org/<?=$GLOBALS['network']?>/",
												token_id:this.token_id,
												nft_id:this.nft_id,
												price:this.price
											});
									}
								}
							});
							function list_nft_collections(collections)
							{
								console.log("list_nft_collections");
								console.log(collections);
								app.collections=collections;
							}
							function accept_create_nft_sell_order(result)
							{
								console.log("create nft sell order -> " + result);
								Swal.fire({
											position: 'top-end',
											icon: 'warning',
											title: "Create NFT Sell Order",
											text: (result?"Success":"Rejected"),
											showConfirmButton: false,
											timer: 3000
										})
							}
							function reject_create_nft_sell_order()
							{
								console.log("create nft sell order rejected.");
								Swal.fire({
											position: 'top-end',
											icon: 'warning',
											title: "Create NFT Sell Order",
											text: "Create NFT sell order request has been rejected by wallet",
											showConfirmButton: false,
											timer: 3000
										})
							}
							function accept_get_nft_sell_order(order)
							{
								console.log("get nft sell order");
								console.log(order);
							}
							</script>
							<?
						}
						else if ($_GET["section"]=="list-nft-sell-orders")
						{
							?>
							<div class="row" id="app">
								<div class="col-md-12">
									<h3>NFT Sell Orders</h3>
									<div v-if="is_connected">
										<div v-if="Object.keys(collections).length>0">
											<div v-for="(token,token_id,index) in collections" v-if="parseJSON(token.scheme).version==1">
												<div class="d-flex text-muted pt-3" v-for="(nft,nft_id,index) in token.confirmed" v-if="(orders.includes(token_id+'-'+nft_id))">
													<img style="width:128px;height:auto;" class="img-thumbnail rounded" v-if="parseJSON(nft).attributes.content_type&&parseJSON(nft).attributes.content_type.split('/')[0]=='image'" v-else onerror="this.style.display='none'" :src="ipfs_to_url(parseJSON(nft).image)">
													<p class="p-3 pb-3 mb-0 small lh-sm">
														{{token_id}}
														<br/>
														{{parseJSON(token.scheme).name}}
														<br/>
														<strong class="d-block text-gray-dark"><a v-on:click="cancelNFTSellOrder(token_id,nft_id)" class="btn btn-dark"><i class="fa-solid fa-trash"></i></a>&nbsp;{{parseJSON(nft).name}} (#{{nft_id}})</strong>
													</p>
												</div>
											</div>
											<?
											$orders=array();
											$sql="SELECT * FROM `orders` WHERE is_valid=1 AND network_id=".$GLOBALS['network_id'];
											$q=$GLOBALS['dbh']->prepare($sql);
											$q->execute();
											if ($q->rowCount()>0)
											{
												while ($row=$q->fetch(PDO::FETCH_ASSOC))
												{
													array_push($orders,$row["token_id"]."-".$row["nft_id"]);
												}
											}
											?>
										</div>
										<div v-if="!b_collections_loaded">
											Loading sell orders...
										</div>
									</div>
									<div v-else>
										<p>Please connect your wallet first...<p>
									</div>
								</div>
							</div>
							<script>
							var app = new Vue({
								el: '#app',
								data:
								{
									is_connected:false,
									orders:<?=json_encode($orders,true)?>,
									collections:{}
								},
								mounted:function()
								{
									let vm=this;
									document.addEventListener('on_wallet_connected', function (e)
									{
										console.log("Status -> " + mapp.status);
										vm.is_connected=(mapp.status==0?false:true);
										if (mapp.status==0)
										{
											Swal.fire({
												position: 'top-end',
												icon: 'error',
												title: "Wallet not connected",
												showConfirmButton: false,
												timer: 1500
											})
										}
										else
										{
											vm.listNftCollections();
										}
									}, false);
								},
								methods:
								{
									ipfs_to_url: function(link)
									{
										let base_url="https://ipfs.nextwallet.org/ipfs/";
										let e=link.split("ipfs://");
										return base_url+e[1];
									},
									listNftCollections: function()
									{
										this.b_collections_loaded=false;
										console.log("Listing collections...");
										Web3.ListNftCollections();
									},
									cancelNFTSellOrder: function(token_id,nft_id)
									{
										console.log("Cancelling nft sell order...");
										Web3.CancelNftSellOrder(
										{
											token_id:token_id,
											nft_id:nft_id
										});
									},
									parseJSON: function(str)
									{
										try
										{
											return JSON.parse(str);
										}
										catch(err)
										{
											return false;
										}
									},
								}
							});
							function list_nft_collections(collections)
							{
								console.log("list_nft_collections");
								console.log(collections);
								app.collections=collections;
								app.b_collections_loaded=true;
							}
							function accept_cancel_nft_order()
							{
								console.log("accept cancel nft order");
							}
							function reject_cancel_nft_order()
							{
								console.log("reject cancel nft order");
							}
						</script>
						<?
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<style>
.img-thumbnail
{
	min-width: 128px;
	min-height: 128px;
	background-color: #121212 !important;
	border:1px solid #232323;
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
.bg-black
{
	border-color:  #454545;
}
</style>