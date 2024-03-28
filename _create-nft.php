<?=title("Create NFT")?>
<div class="bg-dark text-white">
	<div class="container">
		<div class="p-1 bg-dark">
			<div class="container-fluid py-0">
				<div class="row">
					<div class="col-md-12">
						<h5 class="display-6 fw-bold"><i class="fa-solid fa-image"></i>&nbsp;<?=($_GET["id"]?"Update NFT":"Create NFT")?></h5>
						<p class="text-secondary">Please choose an image file, specify a name, unique ID and description for your NFT.</p>
					</div>
				</div>
				<div class="row" id="app">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-4">
								<div style="margin-top:15px;">
									<!--<img v-show="uploadSuccess" class="img-thumbnail" style="max-width:256px;height:auto;" :src="preview_url"/>
									<div v-show="!preview_url">
										<i  class="fas fa-image fa-9x"></i>
									</div>!-->
									<p class="text-secondary">Please select an image that represents your nft...</p>
									<p class="text-secondary"><small>Supported file formats: .gif, .jpg, .jpeg, .png, .svg, .webp, .wav, .ogg, .mp3, .webm, .mp4, .mov</small></p>
								</div>
								<label class="custom-file-upload">
									<input type="file" ref="doc" @change="readFile()" />
									 <i class="fa-solid fa-upload"></i>&nbsp;Choose file
								</label>
								<div class="card mt-3 bg-black text-secondary">
									<span class="badge bg-success">Preview</span>
									<img v-show="uploadSuccess" class="card-img-top" style="max-width:256px;height:auto;" :src="preview_url"/>
									<div class="m-3" v-show="!preview_url">
										<i  class="ml-3 fas fa-image fa-9x"></i>
									</div>
									<div class="card-body">
										<h5 class="card-title">{{(name?name:"Name")}}</h5>
										<p class="card-text card-nft-desc">{{(description?description:"Description")}}</p>
									</div>
								</div>
							</div>
							<div class="col-md-8">
								<div class="form-group mt-3" v-if="collection_id">
									<span class="text-secondary">Collection ID : </span>
									<input readonly class="form-control bg-dark text-white" type="text" style="width:100%;" v-model="collection_id"/>
								</div>
								<div class="form-group mt-3">
									<span class="text-secondary">Category : </span>
									<select class="form-select bg-dark text-white" style="width: 100%" v-model="category" v-on:change="sub_category=undefined">
										<option v-bind:value="item" v-for="(item,index) in categories">{{item.name}}</option>
									</select>
								</div>
								<div class="form-group mt-3" v-if="category&&category.sub_categories">
									<span class="text-secondary">Sub Category : </span>
									<select class="form-select bg-dark text-white" style="width: 100%" v-model="sub_category">
										<option v-bind:value="item" v-for="(item,index) in category.sub_categories">{{item.name}}</option>
									</select>
								</div>
								<div class="form-group mt-3">
									<input class="form-control bg-dark text-white" placeholder="NFT ID" type="number" style="width:100%;" min="0" v-model="nft_id"/>
									<small class="text-secondary">Specify the sequence number in your NFT collection. ID's will be numeric and starts from 0.</small>
								</div>
								<div class="form-group mt-3">
									<input class="form-control bg-dark text-white" placeholder="NFT Name" type="text" style="width:100%;" v-model="name"/>
									<small class="text-secondary">Specify a name that represents your NFT.</small>
								</div>
								<div class="form-group mt-3">
									<textarea rows="5" class="form-control bg-dark text-white" placeholder="Description" type="text" style="width:100%;" v-model="description"></textarea>
									<small class="text-secondary">The description will be included on the item's detail page underneath its image.</small>
								</div>
								<div class="form-group mt-3">
									<input class="form-control bg-dark text-white" placeholder="External URL" type="text" style="width:100%;" v-model="external_url"/>
									<small class="text-secondary">Priverse Marketplace will include a link to this URL on this item's detail page, so that users can click to learn more about it. You are welcome to link to your own webpage with more details.</small>
								</div>
								<div class="form-group mt-3">
									<input class="form-control bg-dark text-white" placeholder="NFT Family ID" type="text" style="width:100%;" v-model="family_id"/>
									<span class="badge bg-secondary mt-2">Optional</span>
									<small class="text-secondary">Represents an identifier for grouping items of the same type. For example: nature, sports, science</small>
								</div>
								<div class="form-group mt-3">
									<div class="collapse" id="collapseExample">
										<span class="text-secondary">Scheme :</span> 
										<pre class="border" v-html="JSON.stringify(JSON.parse(scheme), null, 2)"></pre>
									</div>
								</div>
								<div class="form-group mt-3">
									<button class="btn btn-warning" v-on:click="confirmImportNFT()" :disabled="nft_id.length<1 || !name || !scheme"><i class="fa-solid fa-wallet"></i>&nbsp;Create NFT</button>
									<a class="btn btn-outline-secondary float-end" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="fa-solid fa-code"></i>&nbsp;Show Scheme</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<style>
input[type="file"]
{
	display: none;
}
.custom-file-upload
{
	border: 1px solid #ccc;
	display: inline-block;
	padding: 6px 12px;
	cursor: pointer;
}
</style>
<script>
	var app = new Vue({
		el: '#app',
		data:
		{
			categories:
			[
				{
					"id": "art",
					"name": "Art"
				},
				{
					"id": "game_content",
					"name": "Game Content",
					"sub_categories": [
						{
							"id": "character_skin",
							"name": "Character Skin"
						},
						{
							"id": "weapon",
							"name": "Weapon"
						},
						{
							"id": "weapon_camouflage",
							"name": "Weapon Camouflage"
						},
						{
							"id": "player_accessory",
							"name": "Player Accessory"
						},
						{
							"id": "trading_card",
							"name": "Trading Card"
						},
						{
							"id": "emblem",
							"name": "Emblem"
						},
						{
							"id": "sticker",
							"name": "Sticker"
						}
					]
				},
				{
					"id": "collectibles",
					"name": "Collectibles"
				},
				{
					"id": "music",
					"name": "Music"
				},
				{
					"id": "photography",
					"name": "Photography"
				},
				{
					"id": "sports",
					"name": "Sports"
				},
				{
					"id": "trading_cards",
					"name": "Trading Cards"
				},
				{
					"id": "utility",
					"name": "Utility"
				}
			],
			category:undefined,
			sub_category:undefined,
			collections:[],
			uploadEnabled:false,
			uploadSuccess:false,
			collection_id:<?=($_GET["collection_id"]?"'".$_GET["collection_id"]."'":"undefined")?>,
			nft_id:<?=($_GET["nft_id"]?"'".$_GET["nft_id"]."'":'0')?>,
			file:undefined,
			file_type:undefined,
			preview_url:undefined,
			url:undefined,
			name:undefined,
			family_id:undefined,
			description:undefined,
			external_url:undefined,
			scheme:'',
			version:1
		},
		mounted:function()
		{
			this.getScheme();
		},
		updated:function()
		{
			this.getScheme();
		},
		methods:
		{
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
			importNFT: function()
			{
				let vm=this;
				console.log(vm.name);
				console.log(vm.scheme);
				console.log(vm.nft_id);
				console.log("Importing NFT...");
				Web3.CreateNft({
					token_id:vm.collection_id,
					nft_id:parseInt(vm.nft_id),
					scheme:vm.scheme
				});
			},
			confirmImportNFT: function()
			{
				let vm=this;
				if (!vm.uploadSuccess)
				{
					Swal.fire({
						title: 'Are you sure?',
						text: "You did not specify a file for your NFT. Do you want to continue?",
						icon: 'warning',
						showCancelButton: true,
						confirmButtonColor: '#3085d6',
						cancelButtonColor: '#d33',
						confirmButtonText: 'Yes!'
					}).then((result) => 
					{
						if (result.isConfirmed)
						{
							vm.importNFT();
						}
					});
				}
				else
				{
					vm.importNFT();
				}
			},
			addFile: function()
			{
				let vm=this;
				let formData = new FormData();
				formData.append('file', this.$refs.doc.files[0]);
				axios.post('https://ipfs.nextwallet.org/add.php',formData,{headers:{'Content-Type':'multipart/form-data'}}).then(function(response)
				{
					if (response.data.success)
					{
						Swal.fire({
						  position: 'top-end',
						  icon: 'success',
						  title: 'Upload success',
						  text: "Your file successfully uploaded",
						  showConfirmButton: false,
						  timer: 3000
						});
						console.log("Success!");
						console.log("URL:"+response.data.url);
						console.log("CID:"+response.data.cid);
						vm.uploadSuccess=true;
						vm.preview_url=response.data.url+response.data.cid;
						vm.url="ipfs://"+response.data.cid;
						vm.file_type=vm.getFileMIMEType(vm.$refs.doc.files[0].name);
					}
					else
					{
						Swal.fire({
						  position: 'top-end',
						  icon: 'error',
						  title: 'Upload failed',
						  text: "Reason : " + response.data.message,
						  showConfirmButton: false,
						  timer: 3000
						});
						console.log("Failed!");
						console.log("Reason:"+response.data.message);
					}
				})
				.catch(function()
				{
					console.log("Failed!");
				});
			},
			getFileMIMEType: function(filename)
			{
				let type="";
				let ext=filename.split('.').pop();
				switch(ext)
				{
					case "gif":
						type="image/gif";
						break;
					case "jpg":
						type="image/jpeg";
						break;
					case "jpeg":
						type="image/jpeg";
						break;
					case "png":
						type="image/png";
						break;
					case "webp":
						type="image/webp";
						break;
					case "svg":
						type="image/svg";
						break;
					case "webp":
						type="image/webp";
						break;
					case "wav":
						type="audio/wav";
						break;
					case "ogg":
						type="audio/ogg";
						break;
					case "mp3":
						type="audio/mp3";
						break;
					case "webm":
						type="video/webm";
						break;
					case "mp4":
						type="video/mp4";
						break;
					case "mov":
						type="video/mov";
						break;
					default:
						type="undefined";
				}
				return type;
			},
			getScheme: function()
			{
				this.scheme=JSON.stringify({
					version:this.version,
					category:(this.sub_category?this.sub_category.id:null),
					name:this.name,
					description:this.description,
					image:this.url,
					external_url:this.external_url,
					attributes:
					{
						thumbnail_url:this.url,
						content_type:this.file_type,
						family_id:this.family_id,
					}
				});
			},
			readFile: function()
			{
				const reader = new FileReader();
				let f=this.$refs.doc.files[0];
				console.log(f.name);
				console.log(f);
				let ext=f.name.split('.').pop();
				console.log(ext);
				if (
					ext.includes("gif")
					||ext.includes("jpg")
					||ext.includes("jpeg")
					||ext.includes("png")
					||ext.includes("svg")
					||ext.includes("webp")
					||ext.includes("wav")
					||ext.includes("ogg")
					||ext.includes("mp3")
					||ext.includes("webm")
					||ext.includes("mp4")
					||ext.includes("mov")
				)
				{
					console.log("NFT file selected.");
					this.file = this.$refs.doc.files[0];
					this.uploadEnabled=true;
					this.addFile();
					reader.onload = (res) =>
					{
						//console.log(res.target.result);
					};
					reader.onerror = (err) => console.log(err);
					reader.readAsText(this.$refs.doc.files[0]);
				}
				else
				{
					console.log("Unsupported file type for your NFT.");
					alert("Unsupported file type for your NFT.",{title:"Error"});
				}
			},
		}
	})
</script>