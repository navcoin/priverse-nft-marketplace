<?=title("Create NFT Collection")?>
<div class="bg-dark text-white">
	<div class="container">
		<div class="p-1 bg-dark">
			<div class="container-fluid py-0">
				<div class="row">
					<div class="col-md-12">
						<h5 class="display-6 fw-bold"><i class="fa-solid fa-hammer"></i>&nbsp;<?=($_GET["id"]?"Update NFT Collection":"Create NFT Collection")?></h5>
						<p class="text-secondary">Please provide a name, description and maximum supply for your private NFT collection.</p>
					</div>
				</div>
				<div class="row" id="app">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-4">
								<div class="form-group" style="margin-top:20px;margin-bottom:20px;">
									<small>Supported file formats: .gif, .jpg, .jpeg, .png, .svg, .webp</small>
								</div>
								<label class="custom-file-upload">
									<input type="file" ref="doc" @change="readFile()" />
									 <i class="fa-solid fa-upload"></i>&nbsp;Choose file
								</label>
								<div style="margin-top:15px;">
									<button :disabled="!uploadEnabled" v-on:click="addFile" class="btn btn-primary"><i class="fa fa-cloud-upload"></i>&nbsp;Upload file to IPFS</button>
								</div>
								<div style="margin-top:15px;" v-show="uploadSuccess">
									<img class="img-thumbnail" style="max-width:256px;height:auto;" :src="preview_url"/>
								</div>
							</div>
							<div class="col-md-8">
								<div class="form-group mt-3">
									Category : 
									<select class="form-select bg-dark text-white" style="width: 100%" v-model="category">
										<option v-bind:value="item.id" v-for="(item,index) in categories">{{item.name}}</option>
									</select>
								</div>
								<div class="form-group mt-3">
									<input class="form-control bg-dark text-white" placeholder="Collection Name" type="text" style="width:100%;" v-model="name"/>
								</div>
								<div class="form-group mt-3">
									<textarea rows="5" class="form-control bg-dark text-white" placeholder="Description" type="text" style="width:100%;" v-model="description"></textarea>
								</div>
								<div class="form-group mt-3">
									<input class="form-control bg-dark text-white" placeholder="External URL" type="text" style="width:100%;" v-model="external_url"/>
								</div>
								<div class="form-group mt-3">
									<input class="form-control bg-dark text-white" placeholder="Max Supply" type="number" style="width:100%;" v-model="max_supply"/>
								</div>
								<div class="form-group mt-3">
									Scheme : 
									<pre class="border" v-html="JSON.stringify(JSON.parse(scheme), null, 2)"></pre>
								</div>
								<div class="form-group mt-3">
									<button class="btn btn-warning" v-on:click="importNFTCollection()" :disabled="!category || !scheme || !max_supply"><i class="fa-solid fa-wallet"></i>&nbsp;Import Collection to Wallet</button>
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
				{"id":"art",name:"Art"},
				{"id":"game_content",name:"Game Content"},
				{"id":"collectibles",name:"Collectibles"},
				{"id":"music",name:"Music"},
				{"id":"photography",name:"Photography"},
				{"id":"sports",name:"Sports"},
				{"id":"trading_cards",name:"Trading Cards"},
				{"id":"utility",name:"Utility"}
			],
			uploadEnabled:false,
			uploadSuccess:false,
			category:undefined,
			file:undefined,
			file_type_collection:undefined,
			preview_url:undefined,
			url:undefined,
			name:undefined,
			description:undefined,
			external_url:undefined,
			scheme:undefined,
			max_supply:undefined,
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
			importNFTCollection: function()
			{
				let vm=this;
				console.log(this.name);
				console.log(this.scheme);
				console.log(this.max_supply);
				console.log("Importing collection...");
				Web3.CreateNftCollection({
					name:this.name,
					scheme:this.scheme,
					max_supply:parseInt(this.max_supply)
				});
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
						console.log("Success!");
						console.log("URL:"+response.data.url);
						console.log("CID:"+response.data.cid);
						vm.uploadSuccess=true;
						vm.preview_url=response.data.url+response.data.cid;
						vm.url="ipfs://"+response.data.cid;
						vm.file_type_collection=vm.getFileMIMEType(vm.$refs.doc.files[0].name);
					}
					else
					{
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
					default:
						type="undefined";
				}
				return type;
			},
			getScheme: function()
			{
				this.scheme=JSON.stringify({
					version:this.version,
					category:this.category,
					description:this.description,
					image:this.url,
					external_url:this.external_url,
					attributes:
					{
						thumbnail_url:this.url,
						content_type:this.file_type_collection
					}
				});
			},
			readFile: function()
			{
				const reader = new FileReader();
				let f=this.$refs.doc.files[0];
				console.log(f.name);
				console.log(f);
				if (f.name.includes(".jpg")
					||f.name.includes(".jpeg")
					||f.name.includes(".png")
					||f.name.includes(".gif")
					||f.name.includes(".webp")
					||f.name.includes(".svg"))
				{
					console.log("Image file selected.");
					this.file = this.$refs.doc.files[0];
					this.uploadEnabled=true;
					reader.onload = (res) =>
					{
						//console.log(res.target.result);
					};
					reader.onerror = (err) => console.log(err);
					reader.readAsText(this.$refs.doc.files[0]);
				}
				else
				{
					console.log("Unsupported file type.");
					alert("Unsupported file type.",{title:"Error"});
				}
			}
		}
	})
</script>