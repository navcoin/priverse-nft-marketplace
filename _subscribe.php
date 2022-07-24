<?=title("Subscribe")?>
<div class="bg-dark text-white">
	<div class="container">
		<div class="p-1 bg-dark">
			<div class="container-fluid py-0">
				<div class="row">
					<div class="col-md-3">
						<img class="rounded shadow mb-3" style="width:256px;height:256px;" src="images/subscribe.jpg">
					</div>
					<div class="col-md-9">
						<h1>Thanks!</h1>
						<p>We will be sharing news, announcements and developments about the Private NFT marketplace with you.</p>
						<?
							$sql="SELECT id FROM subscribers WHERE email=:email LIMIT 1";
							$q=$GLOBALS['dbh']->prepare($sql);
							$q->bindParam(':email',$_POST["email"], PDO::PARAM_STR);
							$q->execute();
							if ($q->rowCount()>0)
							{
								?>
								<p>This e-mail already subscribed.</p>
								<?
							}
							else
							{
								$sql="INSERT INTO subscribers SET email=:email,created_at='".date("Y-m-d H:i:s")."'";
								$q=$GLOBALS['dbh']->prepare($sql);
								$q->bindParam(':email',$_POST["email"], PDO::PARAM_STR);
								$q->execute();
								if ($q)
								{
								?>
								<p>Subscription successful.</p>
								<?
								}
								else
								{
								?>
								<p>Subscription failed.</p>
								<?
								}
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
