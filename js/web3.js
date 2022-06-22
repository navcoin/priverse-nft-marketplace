class Web3SDK
{
  constructor(options)
  {
    options = options || {};
    this.network = options.network || "mainnet";
    this.log = options.log || false;
    this.Log("Web3 SDK loaded");
    window.addEventListener("message", (event) =>
    {
      if (event.data)
      {
        console.log(event);
        if (event.data.type=="extension")
        {
          window.dispatchEvent(new CustomEvent('extension_found',{"detail": event.data}));
        }
      }
    }, true);
    window.dispatchEvent(new CustomEvent('sdk_loaded',{
      "detail": {
        "network":this.network
      }
    }));
   }
  getNetwork()
  {
    return this.network;
  }
  async Connect()
  {
    console.log("Connect");
    this.RequestToWallet({method: "connect"});
  }
  async CreateNftCollection(param)
  {
    this.Log("CreateNftCollection");
    this.Log(param);
    this.RequestToWallet({method:"create_nft_collection",name:param.name,scheme:param.scheme,max_supply:param.max_supply});
  }
  async CreateNft(param)
  {
    this.Log("CreateNft");
    this.Log(param);
    this.RequestToWallet({method:"create_nft",token_id:param.token_id,nft_id:param.nft_id,scheme:param.scheme});
  }
  async CreateNftSellOrder(param)
  {
    this.Log("createNftSellOrder");
    this.Log(param);
    this.RequestToWallet({method:"create_nft_sell_order",return_order:param.return_order,submit_order:param.submit_order,api_url:param.api_url,token_id:param.token_id,nft_id:param.nft_id,price:param.price});
  }
  async CancelNftSellOrder(param)
  {
    this.Log("CancelNftSellOrder");
    this.Log(param);
    this.RequestToWallet({method:"cancel_nft_sell_order",token_id:param.token_id,nft_id:param.nft_id});
  }
  async AcceptOrder(param)
  {
    this.Log("AcceptOrder");
    this.Log(param);
    this.RequestToWallet({method:"accept_order",order:param.order});
  }
  async ListNftCollections()
  {
    this.Log("ListNftCollections");
    this.RequestToWallet({method: "list_nft_collections"});
  }
  async CreatePrivateToken(param)
  {
    this.Log("CreatePrivateToken");
    this.Log(param);
    this.RequestToWallet({method:"create_private_token",name:param.name,symbol:param.symbol,max_supply:param.max_supply});
  }
  async MintPrivateToken(param)
  {
    this.Log("MintPrivateToken");
    this.Log(param);
    this.RequestToWallet({method:"mint_private_token",token_id:param.token_id,amount:param.amount});
  }
  async CreateTransaction(param)
  {
    this.Log("CreateTransaction");
    this.Log(param);
    this.RequestToWallet({method:"create_transaction",address:param.address,amount:param.amount});
  }
  async SignMessage(param)
  {
    this.Log("SignMessage");
    this.Log(param);
    this.RequestToWallet({method:"sign_message",message:param.message});
  }
  async RequestToWallet(param)
  {
    param.network=this.network;
    this.Log(param);
    window.postMessage(param,"*");
  }
  async Log(o)
  {
    if (!this.log) return;
    console.log(o);
  }
}