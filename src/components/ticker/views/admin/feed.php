<?php
/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */
?>


<!--- javascript start --->
@components/ticker/includes/js/ticker.js
<!--- javascript end --->

<!--- css start --->
@components/ticker/includes/css/ticker.css
<!--- css end --->

<input type="hidden" id="ticker-token" value="<?php echo $token; ?>" >
<div class="panel panel-default">
    <div class="panel-heading">
        Work Activity Updates
    </div>
    <div class="chat_wrapper">
        <div id="message_box" class="message_box">

        </div>
        <div class="panel">
            <a href="#" id="history" class="ui-link">view more results</a>
        </div>
    </div>
</div>