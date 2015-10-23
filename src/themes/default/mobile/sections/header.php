<div style="display: none" id="dialog" title="Select Language">
    <ul>
        <?php
        foreach ($SystemLocalesList as $key => $locale) {
            echo '<li class="select-locale" data-id="' . $key . '">' . $locale['languageName'] . '</li>';
        }
        ?>
    </ul>
    <form method="post" action="/locale/change" id="locale-change">
        <input type="hidden" name="locale" id="locale" />
    </form>
</div>
