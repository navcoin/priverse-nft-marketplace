<?=title("Profile")?>
<div class="bg-dark text-white">
	<div class="container">
		<div class="p-1 bg-dark">
			<div class="container-fluid py-0">
				<div class="row">
					<div class="col-md-12 mb-5">
						<?
						if (empty($_GET["section"])||$_GET["section"]=="wallet")
						{
						?>
						<h5 class="display-6 fw-bold"><i class="fa-solid fa-wallet"></i>&nbsp;Wallet</h5>
						<?
						}
						else if ($_GET["section"]=="nft-collections")
						{
						?>
						<h5 class="display-6 fw-bold"><i class="fa-solid fa-images"></i>&nbsp;My NFT Collections</h5>
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
							<a type="button" href="profile?section=nft-collections" class="list-group-item list-group-item-action list-group-item-dark <?=($_GET["section"]=="nft-collections"?"active":"")?>" aria-current="true"><i class="fa-solid fa-images"></i>&nbsp;NFT Collections</a>
							<a type="button" href="profile?section=list-nft-sell-orders" class="list-group-item list-group-item-action list-group-item-dark <?=($_GET["section"]=="list-nft-sell-orders"?"active":"")?>" aria-current="true"><i class="fa-solid fa-list-check"></i>&nbsp;NFT Sell Orders</a>
						</div>
					</div>
					<div class="col-md-9">
						<?
						if ((empty($_GET["section"])||$_GET["section"]=="wallet") && is_wallet_logged_in())
						{
							?>
							<div class="row" id="app">
								<div class="col-md-12">
									<div class="card text-white bg-dark mb-3">
										<div class="card-header">
											Balance
										</div>
										<div class="card-body">
											<p><img style="width:32px;height:32px;"  src="images/nav-logo-border.png"/> &nbsp;{{formatBalance(wallet_info.nav.confirmed)}} NAV</p>
											<p><img style="width:32px;height:32px;"  src="images/xnav-logo-border.png"/> &nbsp;{{formatBalance(wallet_info.xnav.confirmed)}} xNAV</p>
										</div>
									</div>
								</div>
							</div>
							<script>
							var app = new Vue({
								el: '#app',
								data:
								{
									is_connected:false,
									wallet_info:{},
									b_wallet_info_loaded:false
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
											vm.GetWalletInfo();
										}
									}, false);
								},
								methods:
								{
									GetWalletInfo:function()
									{
										Web3.GetWalletInfo({});
									},
									formatBalance: n =>
									{
										if (n==0) return n;
										if (n)
										{
											var amount=sb.toBitcoin(n);
											var parts=amount.toString().split(".");
											return parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",") + (parts[1] ? "." + parts[1] : "");
										}
										else
										{
											return "";
										}
									},
								}
							});
							function get_wallet_info(wallet_details)
							{
								app.wallet_info=wallet_details;
								console.log("get wallet details");
								console.log(wallet_details);
							}
							</script>
							<?
						}
						else if ($_GET["section"]=="nft-collections")
						{
							?>
							<div class="row" id="app">
								<div class="modal" id="modal-create-sell-order" tabindex="-1">
									<div class="modal-dialog modal-lg">
										<div class="modal-content bg-dark">
									<div class="modal-header">
										<h5 class="modal-title text-white">Confirm NFT Sell Order</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cancel"></button>
									</div>
									<div class="modal-body bg-dark">
										<div class="row">
											<div class="col-md-6">
												<div v-if="nft.attributes">
													<img v-if="nft.attributes.content_type&&nft.attributes.content_type.split('/')[0]=='image'" class="img-thumbnail" :src="ipfs_to_url(nft.image)"/>
													<i class="fas fa-image fa-9x text-secondary" v-else></i>
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
									<div class="form-group mb-3 float-end">
										<a class="btn btn-primary" href="/create-collection">
											<i class="fa-solid fa-add"></i> Create NFT Collection
										</a>
									</div>
								</div>
								<div class="col-md-12">
									<div v-if="is_connected">
										<div class="text-warning mb-2 fa-fade" style="--fa-animation-duration: 2s; --fa-fade-opacity: 0.6;" v-if="b_collections_loaded&&private_tokens.filter((e) => e.version == '1').length&&!selected_collection">
											<i class="fa-solid fa-info"></i>&nbsp;Please select a collection...
										</div>
										<div class="card text-white bg-dark mb-2" v-if="b_collections_loaded&&private_tokens.filter((e) => e.version == '1').length">
											<div class="card-header">
											<i class="fa-solid fa-images"></i>&nbsp;NFT Collections ({{private_tokens.filter((e) => e.version == "1").length}})
											</div>
											<div class="card-body" style="height: 180px;overflow-y: scroll;">
												<div class="row">
													<div class="col-md-3 col-md-offset-2" v-if="item.version=='1'" v-for="(item,key,index) in private_tokens">
														<div class="card card-collection bg-dark mb-3" :class="{ 'card-active': item.id==(selected_collection?selected_collection.id:0) }">
															<div class="card-body">
																<a class="stretched-link" style="text-decoration: none;" v-on:click="selectCollection(item)">
																	<img v-if="parseJSON(item.code).attributes&&parseJSON(item.code).attributes.thumbnail_url" class="img-fluid rounded" style="max-height:64px;" :src="ipfs_to_url(parseJSON(item.code).attributes.thumbnail_url)"/>
																	<i v-else class="ml-3 fas fa-image fa-4x text-secondary"></i>
																	<div class="mt-3 mb-3">
																		<small class="text-secondary">
																			{{item.name}}
																		</small>
																		<br/>
																		<small class="text-secondary float-start">
																			<i class="fa-solid fa-images"></i>&nbsp;
																			<span class="text-white">
																				{{getConfirmedNftByTokenId(item.id)}}
																			</span>
																			<span class="text-secondary">
																				/ {{item.supply/100000000}} Item
																			</span>
																		</small>
																	</div>
																</a>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div v-if="Object.keys(collections).length>0">
											<!--<p>You have {{Object.keys(collections).length}} NFT collection(s) in your wallet.</p>!-->
											<div class="card text-white bg-dark mb-5" v-if="selected_collection&&key==selected_collection.id" v-for="(item,key,index) in collections" v-if="parseJSON(item.scheme).version==1">
												<div class="card-header">
													<i class="fa-solid fa-image"></i>&nbsp;{{item.name}}
													<a class="btn btn-primary btn-sm float-end" :href="'/create-nft/'+key+'/'+getAvailableNftId(key,item.confirmed,item.supply)">
														<i class="fa-solid fa-add"></i> Add New Item
													</a>
												</div>
												<div class="card-body">
													<div class="row">
														<div class="col-md-3 bg-dark" style="border-radius: 5px;border:1px solid #292929">
															<img v-if="parseJSON(item.scheme).image&&ipfs_to_url(parseJSON(item.scheme).image)" class="img-fluid" :src="ipfs_to_url(parseJSON(item.scheme).image)"/>
															<i class="fas fa-image fa-9x text-secondary" v-else></i>
															<div class="pt-3 text-secondary">{{parseJSON(item.scheme).description}}</div>
															<a class="btn btn-outline-secondary text-truncate" target="_blank" v-if="parseJSON(item.scheme).external_url" :title="'Visit '+parseJSON(item.scheme).external_url" :href="parseJSON(item.scheme).external_url"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
														</div>
														<div class="col-md-9 bg-dark">
															<div class="row">
																<div class="col-md-4 mb-5" v-for="(item2,key2,index) in item.confirmed">
																	<div class="align-middle" style="min-height:196px;">
																		<img v-if="parseJSON(item2).attributes.content_type&&parseJSON(item2).attributes.content_type.split('/')[0]=='image'" class="img-fluid rounded" style="max-height:196px !important;" v-else onerror="this.style.display='none'" :src="ipfs_to_url(parseJSON(item2).image)"/>
																		<i class="fas fa-image fa-9x text-secondary" v-else></i>
																	</div>
																	<div class="pt-3">
																		<small>
																			<i v-if="parseJSON(item2).attributes.content_type&&parseJSON(item2).attributes.content_type.split('/')[0]=='audio'" class="fa-solid fa-music mr-3"></i>
																			<i v-if="parseJSON(item2).attributes.content_type&&parseJSON(item2).attributes.content_type.split('/')[0]=='video'" class="fa-solid fa-circle-play mr-3"></i>
																			{{parseJSON(item2).name}}
																			<span class="float-start text-secondary">#{{key2}}&nbsp;</span>
																		</small>
																	</div>
																	<div class="text-secondary">
																		<small>
																			{{(parseJSON(item2).description?parseJSON(item2).description:"No description...")}}
																		</small>
																	</div>
																	<div class="pt-3" style="height: 46px;">
																		<a class="btn btn-outline-secondary text-truncate" :title="'Visit '+parseJSON(item2).external_url" target="_blank" v-if="parseJSON(item2).external_url" :href="parseJSON(item2).external_url"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
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
																	<a class="btn btn-primary mt-3" v-on:click="createNftSellOrder(key,item2,key2,item.name)"><i class="fa-solid fa-store"></i>&nbsp;Sell</a>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div v-if="selected_collection&&!selected_collection_nft_length">
											<div class="card text-white bg-dark mb-5">
												<div class="card-header">
													<i class="fa-solid fa-image"></i>&nbsp;{{selected_collection.name}}
												</div>
												<div class="card-body">
													<p>You don't have any NFT in selected collection...</p>
													<a class="btn btn-primary" :href="'/create-nft/'+selected_collection.id+'/0'">
														<i class="fa-solid fa-add"></i> Create First NFT
													</a>
												</div>
											</div>
										</div>
										<div v-if="!b_collections_loaded">
											<i class="fa-solid fa-circle-notch fa-spin"></i>&nbsp;Loading NFT Collections...
										</div>
										<div v-if="b_collections_loaded && Object.keys(collections).length<1">
											<p>
												<i class="fa-solid fa-exclamation fa-beat-fade"></i>&nbsp;You don't have any NFT collection.
											</p>
											<p>
												<a class="btn btn-primary" href="create-collection"><i class="fas fa-plus"></i>&nbsp;Create Collection</a>
											</p>
										</div>
									</div>
									<div v-else>
										<p>Please connect your wallet first.<p>
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
									selected_collection:undefined,
									selected_collection_nft_length:undefined,
									price:'',
									availableTokenIds:[],
									collections:{},
									private_tokens:{},
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
									selectCollection: function(collection)
									{
										this.selected_collection=collection;
										if (this.collections[collection.id])
										{
											this.selected_collection_nft_length=Object.keys(this.collections[collection.id].confirmed).length;
										}
										else
										{
											this.selected_collection_nft_length=0;
										}
									},
									listNftCollections: function()
									{
										console.log("Listing collections...");
										Web3.ListNftCollections();
									},
									getAvailableNftId: function(token_id,items,supply)
									{
										let keys=[];
										let id=undefined;
										Object.entries(items).forEach(entry =>
										{
											const [key, value] = entry;
											keys.push(parseInt(key));
										});
										for (let i = 0; i < supply; i++)
										{
											if (!keys.includes(i))
											{
												id=i;
												break;
											}
										}
										return id;
									},
									getAvailableNftIds: function()
									{
										let vm=this;
										Object.entries(vm.collections).forEach(collection =>
										{
											let keys=[];
											let id=undefined;
											const [key, value] = collection;
											console.log(key);
											console.log(value.confirmed);
											Object.entries(value.confirmed).forEach(entry =>
											{
												const [key2, value2] = entry;
												keys.push(parseInt(key2));
											});
											for (let i = 0; i < value.supply; i++)
											{
												if (!keys.includes(i))
												{
													id=i;
													const obj = {"token_id":key,"available_id":id,"confirmed":Object.keys(value.confirmed).length};
													vm.availableTokenIds.push(obj);
													break;
												}
											}
										});
									},
									getAvailableNftIdByTokenId: function(token_id)
									{
										for (const [key, value] of Object.entries(this.availableTokenIds))
										{
											if (value.token_id === token_id)
											{
												return value.available_id;
											}
										}
										return 0;
									},
									getConfirmedNftByTokenId: function(token_id)
									{
										for (const [key, value] of Object.entries(this.availableTokenIds))
										{
											if (value.token_id === token_id)
											{
												return value.confirmed;
											}
										}
										return 0;
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
							function list_nft_collections(collections,private_tokens)
							{
								console.log("list_nft_collections");
								console.log(collections);
								console.log(private_tokens);
								app.collections=collections;
								app.private_tokens=private_tokens;
								app.b_collections_loaded=true;
								app.getAvailableNftIds();
							}
							function accept_create_nft_sell_order(result,token_id,nft_id)
							{
								console.log("create nft sell order -> " + result);
								console.log("token id -> " + token_id);
								console.log("nft id -> " + nft_id);
								if (result)
								{
									Swal.fire({
										title: 'NFT sell order has been created.',
										text: "Your NFT sell order has been successfully created, would you like to go to the order detail page?",
										icon: 'question',
										showCancelButton: true,
										confirmButtonColor: '#3085d6',
										cancelButtonColor: '#d33',
										confirmButtonText: 'Yes!'
									}).then((result) => 
									{
										if (result.isConfirmed)
										{
											window.location.href="assets/"+token_id+"/"+nft_id;
										}
									});
								}
								else
								{
									Swal.fire({
											position: 'top-end',
											icon: 'warning',
											title: "Create NFT Sell Order",
											text: "Rejected",
											showConfirmButton: false,
											timer: 3000
										})
								}
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
									<div v-if="is_connected">
										<div v-if="Object.keys(collections).length>0">
											<p v-if="nft_sell_order_count>0">You have {{nft_sell_order_count}} active NFT sell order</p>
											<div v-for="(token,token_id,index) in collections" v-if="parseJSON(token.scheme).version==1">
												<div class="d-flex flex-row bd-highlight mb-3" v-for="(nft,nft_id,index) in token.confirmed" v-if="parseJSON(nft)&&isNftSellOrderMine(token_id,nft_id)">
													<div class="p-2 bd-highlight">
														<img style="width:128px;height:auto;" class="img-thumbnail rounded" v-if="parseJSON(nft).attributes.content_type&&parseJSON(nft).attributes.content_type.split('/')[0]=='image'" v-else onerror="this.style.display='none'" :src="ipfs_to_url(parseJSON(nft).image)">
														<i v-else class="ml-3 fas fa-image fa-8x"></i>
													</div>
													<div class="p-2 bd-highlight">
														<a v-on:click="cancelNFTSellOrder(token_id,nft_id)" title="Cancel Order" class="btn btn-dark"><i class="fa-solid fa-trash"></i></a>
													</div>
													<div class="p-2 bd-highlight flex-fill">
														<strong class="text-white">{{parseJSON(nft).name}} (#{{nft_id}})</strong>
														<br/>
														<span class="text-secondary"><i class="fa-solid fa-images"></i>&nbsp;{{token.name}}</span>
													</div>
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
											<i class="fa-solid fa-circle-notch fa-spin"></i>&nbsp;Loading sell orders...
										</div>
										<div v-if="b_collections_loaded && nft_sell_order_count==0">
											<i class="fa-solid fa-exclamation fa-beat-fade"></i>&nbsp;You don't have any NFT sell order.
										</div>
									</div>
									<div v-else>
										<p>Please connect your wallet first.<p>
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
									collections:{},
									nft_sell_order_count:0
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
									isNftSellOrderMine : function(token_id,nft_id)
									{
										if (this.orders.includes(token_id+'-'+nft_id))
										{
											return true;
										}
										else
										{
											return false;
										}
									},
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
								app.nft_sell_order_count=0;
								console.log("list_nft_collections");
								console.log(collections);
								app.collections=collections;
								app.b_collections_loaded=true;
								for (const [token_id, collection] of Object.entries(app.collections))
								{
									console.log(token_id);
									console.log(collection);
									for (const [nft_id, nft] of Object.entries(collection.confirmed))
									{
										console.log(nft_id);
										console.log(nft);
										if (app.isNftSellOrderMine(token_id,nft_id))
										{
											console.log("NFT is mine -> " + token_id + ":" + nft_id);
											app.nft_sell_order_count++;
										}
									}
								}
							}
							function accept_cancel_nft_order(token_id,nft_id)
							{
								console.log("accept cancel nft order");
								console.log("token_id -> " + token_id);
								console.log("nft_id ->" + nft_id);
								app.collections[token_id]['confirmed'][nft_id]=undefined;
								app.nft_sell_order_count--;
								Swal.fire({
									icon: 'success',
									title: 'Cancel NFT Sell Order',
									text: 'NFT sell order has been successfully canceled.',
								})
							}
							function reject_cancel_nft_order(token_id,nft_id)
							{
								console.log("reject cancel nft order");
								console.log("token_id -> " + token_id);
								console.log("nft_id ->" + nft_id);
								Swal.fire({
									icon: 'warning',
									title: 'Cancel NFT Sell Order',
									text: 'NFT sell order cancellation rejected by wallet.',
								})
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
.card-collection:hover {
	border-color: rgb(13, 110, 253);
	box-shadow: 0px 0px 10px 2px rgb(13, 110, 253);
	cursor: pointer;
}

.card-active {
	border-color: #ffcc00;
	box-shadow: 0px 0px 10px 2px #ffcc00;
}
</style>