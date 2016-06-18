{* Meine Bestellungen / Downloadlink *}
{block name='frontend_account_order_item_downloadlink'}
	{if $SkloeEsdLink.active}
		{if $article.esdarticle && $offerPosition.cleared|in_array:$sDownloadAvailablePaymentStatus || !$article.price}
			<p class="download">
				<strong>
					<a href="{$article.esdLink}">
						{se name="OrderItemInfoInstantDownload" namespace="frontend/account/order_item"}{/se}
					</a>
				</strong>
			</p>
		{/if}
	{else}
		{$smarty.block.parent}
	{/if}
{/block}

{* Meine Sofortdownloads / Seriennummern *}
{block name='frontend_account_downloads_serial'}
	{if $SkloeEsdLink.active}
		{if $article.serial && $offerPosition.cleared|in_array:$sDownloadAvailablePaymentStatus || $article.serial && $article.price=="0"}
		<p>
			{se name="DownloadsSerialnumber" namespace="frontend/account/downloads"}{/se} <strong>{$article.serial}</strong>
		</p>
		{/if}
	{else}
		{$smarty.block.parent}
	{/if}
{/block}

{* Meine Sofortdownloads / Downloadlink *}
{block name='frontend_account_downloads_link'}
	{if $SkloeEsdLink.active}
		{if $article.esdarticle && $offerPosition.cleared|in_array:$sDownloadAvailablePaymentStatus || $article.price=="0"}
			<div class="center">
			<a href="{$article.esdLink}" title="{s name='DownloadsLink' namespace='frontend/account/downloads'}{/s} {$article.name}" class="button-right small_right">
				{se name="DownloadsLink" namespace="frontend/account/downloads"}{/se}
			</a>
			</div>
		{/if}
	{else}
		{$smarty.block.parent}
	{/if}
{/block}
