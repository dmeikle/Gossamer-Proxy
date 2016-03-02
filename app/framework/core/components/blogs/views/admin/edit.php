<h3>Add/Edit Blog</h3>

<script src="https://cdn.ckeditor.com/4.4.5.1/standard/ckeditor.js"></script>

<script language="javascript">

    $(document).ready(function () {
        $("#tabs").tabs();

        $('.patterned').keyup(function () {
            var text = $(this).val();
            if (!validate(text)) {
                $(".page_name_container").addClass('has-error');
                $('.page_name_message').toggle(true);
                return;
            } else {
                $(".page_name_container").removeClass('has-error');
                $('.page_name_message').toggle(false);
            }
        });

        $(".subject").keyup(function () {
            var text = $(this).val();
            var name = $(this).attr('name');
            name = name.replace('Blog[locale][', '');
            var locale = name.replace('][subject]', '');
            var permalinkId = "#Blog_locale_" + locale + "_permalink";
            var permalink = $(permalinkId).val();

            //add to permalink if it's not already holding a value
            if (permalink == '') {
                text = text.replace(/ /g, '-');
                $(permalinkId).val(text);
                $(permalinkId).trigger('keyup');//fire the change event
            }
        });

        $('.patterned').keyup(function () {
            $(this).val($(this).val().replace(/ /g, '-'));
            // $('#page_name_display').text($("#permalink").val());
        });

        function validate(text) {

            var reg = /[!@#$&*()=,^<>:.\']+/;

            if (reg.test(text)) {
                return false;
            }

            return true;
        }

        //setup before functions
        var typingTimer;                //timer identifier
        var doneTypingInterval = 1000;  //time in ms, 1 seconds

        //on keyup, start the countdown
        $('#page_name').keyup(function () {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(checkPageNameExists, doneTypingInterval);
        });

        //on keydown, clear the countdown
        $('#page_name').keydown(function () {
            clearTimeout(typingTimer);
        });

        //user is "finished typing," do something
        function checkPageNameExists() {
            $.post('/admin/cms/pages/search/' + $('#Blog_pageId').val(), {'permalink': $("#page_name_display").text()}, function (data) { //make ajax call to check
                // $("#user-result").html(data); //dump the data received from PHP page
                if (data.result != false) {
                    $('.page_name_exists').show();
                    $('#update_page').attr('disabled', 'disabled');
                } else {
                    $('.page_name_exists').hide();
                    $('#update_page').removeAttr('disabled');
                }
            });
        }

        $('#edit-permalink').click(function () {
            $('#permalink-container').show();
        });

        $('#save-permalink').click(function () {
            $.post('/admin/cms/pages/permalink/save', {'pagename': $("#permalink").val()}, function (data) { //make ajax call to save
                // $("#user-result").html(data); //dump the data received from PHP page
                if (data.result == true) {
                    $('#permalink-container').hide();
                }
            });
        });


        $('#page_content').change(function () {

            var txt = $('#page_content').text()
                    , charCount = txt.length
                    , wordCount = txt.replace(/[^\w ]/g, "").split(/\s+/).length
                    ;
            $('#wordcount').text(wordCount);
        });

        $('#update_page').click(function (e) {
            e.stopPropagation();
            CKupdate();
            $.ajax({
                type: "POST",
                url: '/admin/blogs/' + $('#Blog_pageId').val(),
                data: $("#form1").serialize(), // serializes the form's elements.
                success: function (data)
                {
                    alert('save successful'); // show response from the php script.
                    $('#update_warning').hide();
                }
            });
        });

        $('#show-preview').click(function () {
            updatePreview();
            var dialog = $("#preview-container");
            dialog.position({
                my: "center",
                at: "center",
                of: window
            });

            $("#preview").html($('#page_content').val());
            dialog.show();
        });

        function updatePreview() {
            CKupdate();
            $.ajax({
                type: "POST",
                url: '/admin/cms/pages/' + $('#Blog_pageId').val(),
                data: 'name[locale][en_US][preview]=' + $('#page_content'), // serializes the form's elements.
                success: function (data)
                {
                    //$('#update_warning').hide();
                }
            });
        }

        var currentStatus = '';
        var isPublished = '';

        $('#edit-visibility').click(function () {

            $(this).prev('#Blog_isPublic').toggle();
            if ($(this).text() == 'cancel') {
                $(this).text(currentStatus);
            } else {
                $(this).text('cancel');
                currentStatus = $(this).prev('#Blog_isPublic').children("option").filter(":selected").text();
            }
        });

        $('#Blog_isPublic').change(function () {
            if ($(this).val() != currentStatus && confirm("are you sure you want to change the status of this page?")) {
                $(this).next().text($(this).children("option").filter(":selected").text());
                $('#update_warning').show();
            } else {
                $(this).next().text(currentStatus);
            }
            $(this).toggle();
        });


        $('#edit-status').click(function () {

            // $(this).prev('#Blog_isPublished').toggle();
            $('#Blog_isPublished').toggle();
            if ($(this).text() == 'cancel') {
                $(this).text(isPublished);
            } else {
                isPublished = $(this).prev('#Blog_isPublished').children("option").filter(":selected").text();
                $(this).text('cancel');
            }
        });

        $('#Blog_isPublished').change(function () {
            if ($(this).val() != isPublished && confirm("are you sure you want to change the publishing of this page?")) {
                $(this).next().text($(this).children("option").filter(":selected").text());
                $('#update_warning').show();
            } else {
                $(this).next().text(isPublished);
            }
            $(this).toggle();
        });

        function CKupdate() {
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
        }

        $('#undo_page').click(function () {
            location.reload();
        });

        $('#hide-preview').click(function () {
            $('#preview-container').hide();
            $('#preview').html('');
        });

        $('#view-existing').click(function () {
            $.ajax({
                type: "GET",
                url: '/admin/cms/page/preview/' + $('#Blog_pageId').val(),
                success: function (data)
                {
                    var page = data.Page;
                    if (typeof page == "undefined") {
                        return;
                    }
                    showExisting(page[0].content);
                }
            });
        });

        function showExisting(content) {

            var dialog = $("#preview-container");
            dialog.position({
                my: "center",
                at: "center",
                of: window
            });

            $("#preview").html(content);
            dialog.show();
        }
        var currentCategory = '';

        $('#page_category').change(function () {
            if ($('#page_category') != currentCategory) {
                $('#slug').html($('#page_category option:selected').text());
                $('#update_warning').show();
            }
        });
    });


</script>
<style>
    #preview-container {
        background-color: #fff;
        position: absolute;
        z-index: 10000;
        width: 900px;
    }
    #preview {
        padding: 10px
    }
</style>

<form method="post" id="form1">





    <div id="preview-container" style="display: none;" class="panel panel-default">
        <div id="hide-preview" style="float:right; width: 20px; padding: 5px">x</div>
        <div class="panel-heading">Pages</div>
        <div id="preview">

        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">Pages</div>
        <?php echo $form['pageId']; ?>
        <table class="table">
            <tr>
                <td>left col</td>
                <td>
                    <div id="tabs">
                        <ul class="nav nav-tabs" role="tablist">
                            <?php
                            foreach ($locales as $locale) {
                                if ($locale['isDefault']) {
                                    echo "<li class=\"active\"><a href=\"#{$locale['locale']}\" role=\"tab\" data-toggle=\"tab\">{$locale['languageName']}</a></li>\r\n";
                                } else {
                                    echo "<li><a href=\"#{$locale['locale']}\" role=\"tab\" data-toggle=\"tab\">{$locale['languageName']}</a></li>\r\n";
                                }
                            }
                            ?>
                        </ul>

                        <div class="tab-content">
                            <?php foreach ($locales as $key => $locale) { ?>
                                <div class="tab-pane<?php echo ($locale['isDefault']) ? ' active' : ''; ?>" id="<?php echo $key; ?>">
                                    <table width="100%" class="table">
                                        <tr>
                                            <td>Subject:</td>
                                            <td><?php echo $form['subject']['locales'][$key]; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Permalink:</td>
                                            <td>
                                                <p class="btn bg-danger" style="display:none" class="page_name_message">Invalid characters in Page name. Please remove</p>
                                                <p class="btn bg-danger" style="display:none" class="page_name_exists">Page name exists.</p>
                                                <div class="form-group" class="page_name_container">
                                                    <?php echo $form['permalink']['locales'][$key]; ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Comments:</td>
                                            <td><?php echo $form['comments']['locales'][$key]; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Tags:</td>
                                            <td><?php echo $form['tags']['locales'][$key]; ?></td>
                                        </tr>
                                    </table>
                                </div>
                                <script>
                                    // Replace the <textarea id="editor1"> with a CKEditor
                                    // instance, using default configuration.
                                    CKEDITOR.replace('Blog_locale_<?php echo $key; ?>_comments');
                                </script>
                            <?php } ?>
                        </div>
                    </div>

                </td>
                <td scope="col">
                    <p>Publish</p>
                    <p>
                        <input type="button" id="show-preview" name="preview" class="btn btn-xs btn-primary preview" value="Preview Changes" />
                        <br />
                        Status:
                        <?php echo $form['isPublished']; ?>

                        <a href="#" onclick="return false;" class="btn-xs" id="edit-status">Offline</a><br />

                        Visibility:
                        <?php echo $form['isPublic']; ?>
                        <?php echo $form['visibility']; ?><br />

                    <p>
                        <input type="button" name="update" id="undo_page" class="btn btn-xs btn-primary" value="Undo Changes" />
                        <input type="button" name="update" id="update_page" class="btn btn-xs btn-primary" value="Update" />
                    <div class="bg-warning" style="display:none" id="update_warning">
                        Changes have been made. Please click the 'Update' button to save these changes<br /><br/>To undo these changes click the 'Undo Changes' button.
                    </div>
                    </p>

                </td>
            </tr>

            <tr>
                <td></td>
                <td align="right">
                    Last edited by Dave M on <?php echo $form['lastModified']; ?>
                </td>
                <td></td>
            </tr>
        </table>

</form>
