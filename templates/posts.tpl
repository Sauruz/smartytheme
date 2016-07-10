{include file="parts/header.tpl"}    
{include file="parts/menu.tpl"}   

<div class="container content">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            {foreach from=$posts key=k item=v}
                <h3>{$v->post_title}</h3>
                {$v->dutch_post_date}<br>
                {$v->post_content}<br>
                <hr>
            {/foreach}
        </div>
    </div>

    {if count($paging) > 1}
        <div class="row">
            <div class="col-md-6 col-md-offset-3 text-center">
                {foreach from=$paging key=k item=v}
                        <a href="{$page['permalink']}?page={$k}" class="paging-item {$v['active']}">
                            <span class="fa-stack fa-fw fa-lg text-center">
                                <i class="fa fa-stack-2x"></i>
                                {$k}
                            </span>
                        </a>
                {/foreach}
            </div>
        </div>
    {/if}
</div>

{include file="parts/footer.tpl"}