<?php ?>
<div class="clearfix">
    <div class="footer">
        <div class="social-block">
            <div class="container">
                <a href="" style="display: none!important" class="social-block-item twitter" target="_blank">twitter</a>
                <a href="https://www.facebook.com/GagikTsarukyan/" class="social-block-item facebook" target="_blank">facebook</a>
                <a href="#" style="display: none!important" class="social-block-item youtube" target="_blank">youtube</a>
            </div>
        </div>
        <div class="footer-content">
            <div class="container">
                <div class="row">
                    <p>
                        Բոլոր իրավունքները պաշտպանված են<br>
                        © <?php echo date("Y"); ?> ԳԱԳԻԿ ԾԱՌՈՒԿՅԱՆ
                    </p>
                    
                    powered by <a target="_blank" href="https://peyotto.com">Peyotto</a>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var $ = jQuery.noConflict();
</script>
<?php wp_footer(); ?> 
<script id="img-wrapper-tmpl" type="text/x-jquery-tmpl">	
    <div class="rg-image-wrapper">
    {{if itemsCount > 1}}
    <div class="rg-image-nav">
    <a href="#" class="rg-image-nav-prev">Previous Image</a>
    <a href="#" class="rg-image-nav-next">Next Image</a>
    </div>
    {{/if}}
    <div class="rg-image"></div>
    <div class="rg-loading"></div>
    <div class="rg-caption-wrapper">
    <div class="rg-caption" style="display:none;">
    <p></p>
    </div>
    </div>
    </div>
</script>
</body>
</html>