
<style type="text/css">
    #blog {
        width: 700px;
    }
    #blog #dateEntered {
        text-align: right;
        font-weight: bold;
    }
    #blog #subject {
        display: block;
        font-size: 16px;
        clear: both;
    }
    #blog #tags {
        padding: 10px;
    }
</style>

<?php
$rawdate = date_create($blog['dateEntered']);
?>
<div id="blog">
    <div style="float: right"><?php echo $this->getMenu('website_blogs_minimenu', array($blog['id'])); ?></div>
    <h3>
        <?php echo $blog['subject']; ?>
    </h3>
    <div id=author">
        Written by <?php echo $staffName; ?>
    </div>
    <div id="tags">

        <?php echo $blog['tags']; ?>
    </div>
    <div class="share_social">
        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $_SERVER['REQUEST_URI']; ?>" target="_blank"><img style="float:left;" src="/images/facebook.png"></a>
        <a href="https://twitter.com/home?status=<?php echo $_SERVER['REQUEST_URI']; ?>" target="_blank"><img style="float:left;" src="/images/twitter.png"></a>
        <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $_SERVER['REQUEST_URI']; ?>&amp;title=<?php echo $blog['subject']; ?>"><img src="/images/linkedin.jpg"></a>
    </div>
    <div id="dateEntered">
        <?php echo date_format($rawdate, ' F j\, Y'); ?>
    </div>


    <div id="subject">
        <?php echo $blog['comments']; ?>
    </div>

    <div id="numViews">
        <?php // can't do numview since we are caching page... echo $blog['numViews']; ?>
    </div>

</div>
