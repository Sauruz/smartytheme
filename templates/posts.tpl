{include file="parts/header.tpl"}    
{include file="parts/menu.tpl"}   

<div class="container content">
    <div class="row">
        <div class="col-md-6 offset-3">
            {foreach from=$posts key=k item=v}
                <h3><a href="{get_permalink($v->ID)}">{$v->post_title}</a></h3>
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
                    <div class="row blog-block">
                        <div class="col-xs-10">
                            <h3>{$v->post_title}</h3>
                        </div>
                        <div class="col-xs-2">
                            <div class="date-circle pull-right">
                                <span class="day">{$v->post_day}</span>
                                <span class="month">{$v->post_month}</span>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            {$v->short_content}
                            <br><br>
                            <a href="{$v->permalink}">Read more</a>
                        </div>
                    </div>
                {/foreach}
            </div>
        </div>
    {/if}
</div>

{include file="parts/footer.tpl"}