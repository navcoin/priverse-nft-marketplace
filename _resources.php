<?=title("Resources")?>
<?
$resources = array (
array("What is NFT Collection?","<p>NFT collections are used to group a particular group of NFTs with similar attributes. For example, if you are a painting artist and you intend to sell your works as NFTs, you can create an NFT collection for these works.</p><p>When creating an NFT collection, you must specify in advance how many digital works to be included in your collection. It will not be possible to change this number later.</p>"),
array("What is NFT?","<p>A non-fungible token (NFT) is a financial security consisting of digital data stored in a blockchain, a form of distributed ledger. The ownership of an NFT is recorded in the blockchain, and can be transferred by the owner, allowing NFTs to be sold and traded. NFTs can be created by anybody, and require few or no coding skills to create. NFTs typically contain references to digital files such as photos, videos, and audio. Because NFTs are uniquely identifiable assets, they differ from cryptocurrencies, which are fungible.</p><p><a type='button' target='_blank' class='btn btn-outline-secondary' href='https://en.wikipedia.org/wiki/Non-fungible_token'>Learn More</a></p>"),
array("Why are NFTs on Priverse Marketplace private?","<p>Private and public NFTs are two types of NFTs. By nature, they are both non-fungible, meaning that they are tokens that are non-divisible and hold their own, distinct values. The records of subsequent transactions for both private and public NFTs appear on the blockchain.</p>
<p>However, despite the similarities, the fundamental difference between private and public NFTs is the way in which ownership is displayed. Private NFTs allow for private ownership, ensuring assets and transactions do not need to be exposed to everyone. On the other hand, ownership and all transactions pertaining to traditional NFTs are open for everyone to see. In other words, anyone who owns a traditional NFT can be openly identified.</p>
<p>Private NFTs solve this problem by protecting ownership visibility with private NFTs the validation of fungibility happens without opening verifiability to everyone. This means that the process of validation occurs without compromising private data, including transfers and proofs of authenticity.</p>"),
array("Why should I care about privacy?","<p>Privacy is important because even for small crypto holdings, if your transactions or digital assets are revealed to an audience that you did not intend, you could face potentially negative social impacts: you might use crypto to pay for sensitive products, create or buy digital assets, or information subscriptions that you would rather not tell others about in some cases, its discovery could make you a potential target for blackmail or harassment.</p>"),
array("What are schemes?","<p>Schemes contains basic informations about the NFT collection or NFTs, such as a description, URL, and an image representing the NFT collections or NFT items.</p><p><a type='button' class='btn btn-outline-secondary' target='_blank' href='https://docs.priverse.org/en/nfts'>Learn More</a></p>"),
array("How do I create an NFT?","<p>Creating an NFT on Priverse Marketplace is easy!</p>
<p>This guide explains how to set up your first NFT.</p>
<p>Setting up your first NFT collection</p>
<ol>
<li>From marketplace.priverse.org, click '<b>Create</b>' dropdown on the top menu and click 'Create Collection'.</li>
<li>You'll be taken to the NFT collection creation page. This page will allow you to upload your image for your NFT collection, name it and add a description.</li>
<li>Click '<b>Create Collection</b>' button to create collection in your wallet.</li>
<li>The Navcoin wallet window will open in your browser and it will ask you for confirmation to create the NFT collection. Please confirm it.</li>
<li>It will take approximately 30 seconds for your NFT collection to be created on the blockchain.</li>
</ol>
<p>Setting up your first NFT</p>
<ol>
<li>From marketplace.priverse.org, click '<b>Create</b>' dropdown on the top menu and click 'Create NFT'.</li>
<li>You'll be taken to the NFT creation page. This page will allow you to upload your digital content for your NFT, name it and add a description.</li>
<li>Click '<b>Create NFT</b>' button to create nft in your wallet.</li>
<li>The Navcoin wallet window will open in your browser and it will ask you for confirmation to create the NFT. Please confirm it.</li>
<li>It will take approximately 30 seconds for your NFT to be created on the blockchain.</li>
</ol>"),
array("How do I change the properties of my NFT?","Because NFTs exist on blockchains, it is not possible to change their properties after they are created on the wallet."),
array("How can i sell my NFT?","<ol>
	<li>After creating your NFTs on your wallet, click on the 'Wallet' button in the upper right corner of the screen.</li>
	<li>Click 'Create NFT Sell Order' from left side menu. Priverse Marketplace will try to get NFT list on your wallet.</li>
	<li>After logging into your Navcoin wallet, you will see the list of NFTs in your wallet on the page.</li>
	<li>Click the 'Sell' button below the NFT you want to sell.</li>
	<li>Set and confirm a sale price for your NFT.</li>
	<li>Your Navcoin wallet will ask you for a confirmation for the NFT order. Please confirm.</li>
	<li>After the approval process, your sell order will be displayed on the site within seconds.</li>
	<ol>"),
array("How can i purchase NFTs?","<ol>
	<li>Go to the asset page by clicking the NFT you want to purchase on the site.</li>
	<li>If you are using the Navcoin NEXT mobile wallet, you can continue your purchase on the wallet by scanning the QR code.</li>
	<li>If you want to purchase with your Navcoin wallet running on the browser, click the 'Purchase with Web Wallet' button.</li>
	<li>Your Navcoin wallet will ask you for a confirmation for the NFT purchase. Please confirm.</li>
	<li>After the approval process, the purchase will be made within seconds and the NFT you have purchased will be displayed in your wallet and the sale amount will be transferred to the seller's wallet.</li>
	<ol>"),
);
?>
<div class="bg-dark text-white">
	<div class="container">
		<div class="p-1 bg-dark">
			<div class="container-fluid py-0">
				<h1 class="mb-3">Resources</h1>
				<p>Learn how to create your first NFT collection and NFTs</p>
				<div class="accordion" id="accordionPanelsStayOpenExample">
					<?
					foreach ($resources as $k=>$v)
					{
					?>
					<div class="accordion-item bg-dark">
						<h2 class="accordion-header bg-dark text-white" id="p_<?=$k?>">
							<button class="accordion-button collapsed bg-dark text-white" type="button" data-bs-toggle="collapse" data-bs-target="#c_<?=$k?>" aria-expanded="false" aria-controls="#c_<?=$k?>">
							<?=$v[0]?>
							</button>
						</h2>
						<div id="c_<?=$k?>" class="accordion-collapse collapse text-white" aria-labelledby="p_<?=$k?>">
							<div class="accordion-body">
								<?=$v[1]?>
							</div>
						</div>
					</div>
					<?
					}
					?>
				</div>
			</div>
		</div>
	</div>
</div>
<style>
.accordion-button:after
{
	background-image: url("data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23FFFFFF'><path fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/></svg>") !important;
}
.accordion-header:collapse 
{
	background-color:black !important;
}
.accordion-button collapse
{
	color: rgb(224, 16, 176);
}
</style>