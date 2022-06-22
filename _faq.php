<?=title("Frequently Asked Questions")?>
<?
$questions = array (
array("What is a Non-Fungible Token (NFT)?","<p>Non-Fungible Tokens (NFTs) are unique digital items with blockchain-managed ownership. There are many kinds and applications of NFTs - but before we dive into the details, let's learn about a key term: fungibility.</p>
<p>What is fungibility?</p>
<p>If something is fungible, it is easily exchanged with something of equal value. Don't get overwhelmed by the idea of fungibility; it's just the ability of a good or item to be interchanged with other individual goods or items of the same type.</p>
<p>Fungible items like a dollar bill, gold - even cryptocurrencies like Bitcoin and Ethereum - can be substituted with one another without losing value. They are fungible.</p>
<p>Non-fungibility and NFTs
<p>If something is non-fungible, it means that it cannot be replaced. It represents something unique in value - and that's what an NFT is!</p>
<p>The token part of Non-Fungible Token refers to a digital certificate stored on a publicly verifiable distributed database, also known as a blockchain.</p>
<p>The information on this digital certificate, also known as a smart contract, makes each NFT unique. No two NFTs can be swapped, and this makes them non-fungible. Examples of NFTs include digital art, collectibles, virtual reality items, crypto domain names, ownership records for physical items, and more!</p>
"),
 array("What is a crypto wallet? ","<p>What is a wallet?</p>
<p>“Wallet” is a pretty poor metaphor for a crypto/NFT wallet. The word “wallet” makes you think that securing a crypto wallet is the same as securing the wallet you keep in your pocket. Most importantly, it seems that if you have your crypto wallet then no one else can have it at the same time. Unfortunately, this is not the case.</p>
<p>Since we are stuck with the term, what exactly is a wallet?</p>
<p>A wallet is a private key.</p>
<p>Well then… What is a private key?</p>
<p><p>Private keys are like a personal signature. In the real world, it’s common to use your personal signature to authorize documents or contracts. In the web3 space, only you can produce this signature (the private key), but the entire world knows how to check it by looking at your wallet address.</p>
<p>To get slightly more technical, both public and private keys are a string of random letters and numbers that are associated directly with each other. Each public key can verify one private key, and each private key can produce a message that can be verified by one public key.</p>
<p>In web3, the public key is the wallet address. The wallet address on Navcoin is the string of random letters and numbers that starts with “xN”.  Everyone can know your wallet address, and knowing your wallet address does not give any control over your wallet.</p>
<p>In summary, the private key grants full control over the wallet. The seed phrase, usually 12-words long, is a shortcut to the private key and to the wallet itself. This is why it is so important to protect your seed phrase.</p>"),
array("What crypto wallets can I use with Priverse?","<p>Currently, you can only use the Navcoin Wallet Chrome extension.</p><p><a type='button' class='btn btn-outline-secondary' href='download-wallet'>Learn More</a></p>"),
array("Why do I need a wallet before buying and selling on Priverse?","<p>Priverse is a tool you use to interact with the blockchain.</p>
	<p>We never take possession of your items or store your NFTs.</p><p>Instead, we provide a system for peer-to-peer exchanges. Since you’ll be using Priverse to interact directly with others on the blockchain, you’ll need a wallet to help you turn your actions in the browser into transactions on the blockchain.</p>"),
array("Which blockchains does Priverse support?","Priverse currently only works on the Navcoin blockchain."),
array("How do I purchase Navcoin (NAV)?","<p>NAV is the native currency of the Navcoin blockchain and it’s commonly abbreviated to NAV, which is its ticker symbol.</p>
<p>You need xNAV (Private coin) to pay for some of your interactions with the blockchain and to pay for the items you buy.</p>
<p>You can buy it from an exchange like Binance, Bittrex and send them to your wallet.</p>
<p>After purchasing your NAVs, you need to convert them to xNAV in order to perform NFT-related transactions on the wallet.</p>
<a type='button' class='btn btn-outline-secondary' href='https://navcoin.org/get-started' target='_blank'>Learn More</a>"),
);
?>
<div class="bg-dark text-white">
	<div class="container">
		<div class="p-1 bg-dark">
			<div class="container-fluid py-0">
				<h1 class="mb-3">Frequently asked questions</h1>
				<p>Below are some frequently asked questions and answers.</p>
				<div class="accordion" id="accordionPanelsStayOpenExample">
					<?
					foreach ($questions as $k=>$v)
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