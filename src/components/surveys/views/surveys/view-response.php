
<div class="page <?php echo $page['cssClass']; ?>"><?php echo $page['name']; ?>
    <div class="title"><?php echo $page['title']; ?></div>

    <?php foreach ($panes as $pane) { ?>
        <div class="pane <?php echo $pane['cssClass']; ?>">
            <div class="pane-text"><?php echo $pane['title']; ?></div>
            <?php if (strlen($pane['description']) > 0) { ?>
                <div class="description"><?php echo $pane['description']; ?></div>
            <?php } ?>

            <?php foreach ($pane['questions'] as $question) { ?>
                <div class="question"><?php echo $question['question']; ?>
                    <?php foreach ($question['answers'] as $answer) { ?>
                        <div class="answer"><?php echo (array_key_exists('answer', $answer) ? $answer['answer'] : $answer['openResponse']); ?></div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
</div>
