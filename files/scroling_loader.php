<?php
?>
<div id="myScroll"></div>
<script type="text/javascript">
			var counter=0;
        jQuery(window).scroll(function () {
            if (jQuery(window).scrollTop() == jQuery(document).height() - jQuery(window).height() && counter < 10) {
                appendData();
            }
        });
        function appendData() {
            var html = '';
            for (i = 0; i < 10; i++) {
                html += '<div class="list-item"></div>';
            }
            jQuery('#myScroll').append(html);
			counter++;
			
        }
</script>