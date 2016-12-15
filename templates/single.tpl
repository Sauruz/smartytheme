{include file="parts/header.tpl"}    
{include file="parts/menu.tpl"}   

<div class="container content">
    <div class="row">
        <div class="col-md-2 col-md-offset-1">
            <a href="{$blogPermalink}" class="back-to-blogs">
                 <img src="{$wp_path}/dist/img/arrow.png">
                 <span>Back to overview</span>
            </a>
        </div>
        <div class="col-md-6">
            <h1>{$page['title']}</h1>
            <hr>
            {$page['content']}
        </div>
    </div>
</div>

{include file="parts/footer.tpl"}