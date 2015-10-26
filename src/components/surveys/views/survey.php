
<style type="text/css">
    #survey {
        width: 800px;
        border: 1px solid #666;
    }
    #survey .pane {
        margin-top: 10px;
        margin-right: 5px;
        margin-bottom: 10px;
        margin-left: 5px;
        padding: 5px;
        border: 1px solid #333;
    }
    #survey .pane .name {
        font-weight: 600;
        font-size: 18px;
        text-transform: capitalize;
    }
    #survey .pane .description {
        margin-bottom: 10px;
    }
    #survey .pane .question {
        margin-top: 5px;
        margin-right: 5px;
        margin-bottom: 10px;
        margin-left: 5px;
        padding: 5px;
    }
    #survey .pane .question .question-text {
        font-weight: 600;
    }
    #survey .pane .question .answer {
        display: block;
    }
</style>
<form method="post">
    <div id="survey" style="border:solid 1px black">
        <h3><?php echo $survey['name']; ?></h3>

        <?php foreach ($form['panelist'] as $pane) {
            ?>
            <div class="pane" class="<?php echo $pane['cssClass']; ?>">
                <div class="name"><?php echo $pane['title']; ?></div>
                <div class="description"><?php echo $pane['description']; ?></div>

                <?php
                if (!is_null($pane['questions'])) {
                    foreach ($pane['questions'] as $question) {
                        ?>
                        <?php echo $question; ?>
                        <?php
                    }
                }
                ?>
            </div>
        <?php } ?>
        <div id="buttons">
            <?php echo $form['previous']; ?>
            <?php echo $form['next']; ?>
        </div>
    </div>

</form>