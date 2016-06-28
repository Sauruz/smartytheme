<!-- footer -->     
<div class="container-fluid footer">
    <div class="container">
        <div class="row">
            <div class="row-sm-height">
                <div class="col-xs-12 col-sm-4 col-sm-height">
                    <div class="inner">
                        {foreach from=$footermenu key=k item=v}
                            <a href="{$v->url}">{$v->title}</a><br/>
                        {/foreach}     
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-sm-height logo">
                    <div class="inner">
                        <img src="{$wp_path}/img/logo-grey.png">
                        <hr>
                        <a href="http://www.de-rus.nl">&copy; de.Rus 2015</a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-sm-height">
                    <div class="inner">
                        {$adres->post_content}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- #footer -->

<script src="{$wp_path}/js/app.js"></script>
</body> 
</html>
