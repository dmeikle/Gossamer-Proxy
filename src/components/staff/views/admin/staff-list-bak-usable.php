
<!--- javascript start --->
@components/staff/includes/js/admin-staff-list.js
<!--- javascript end --->

<!--- css start --->
@components/staff/includes/css/admin-staff-list.css
<!--- css end --->
<style>
    #members .tr {
        display: block;
        width:90%;
        clear: both;
    }
    #members .tr .td {
        float: left;
        margin-right: 15px;
    }
    #members .tr .logged-in {
        float: right;
        margin: 5px 0px 0px 20px;
    }

    #members .tr img {
        float: right;
    }

    #members .tr .name {
        width: 20%
    }

    #members .tr .title {
        width: 20%
    }

    #members .tr .department {
        width: 20%
    }

    #members .tr .mobile {
        clear: both;
        width: 20%
    }

    #members .tr .telephone {
        width: 20%
    }

    #members .tr .email {
        width: 40%
    }
    #members .edit-pane {
        float: right;
        margin: 5px 0px 0px 10px;
    }
    #members .edit-pane .nav {
        width: 100px;
    }
</style>
<link rel="stylesheet" type="text/css" href="//css.phoenixrestorations.com/dropdowns.css" />
<script language="javascript">
    $(document).ready(function () {
        $('#show-panes').click(function () {
            $('.staff-member').removeClass('tr');
            $('.staff-member').addClass('pane');
            $('#show-rows').toggle(true);
            $(this).toggle(false);
        })
        $('#show-rows').click(function () {
            $('.staff-member').addClass('tr');
            $('.staff-member').removeClass('pane');
            $('#show-panes').toggle(true);
            $(this).toggle(false);
        })
        $('.edit-pane').click(function () {
            var nav = $('.nav');
            $(this).find(nav).toggle();
        })


        function DropDown(el) {
            this.dd = el;
            this.initEvents();
        }

        DropDown.prototype = {
            initEvents: function () {
                var obj = this;
                obj.dd.on('click', function (event) {
                    $(this).toggleClass('active');
                    event.stopPropagation();
                });
            }
        }

        $(function () {
            var dd = new DropDown($('#dd'));
            $(document).click(function () {
                $('.wrapper-dropdown-2').removeClass('active');
            });
        });

        $('#on-call-list').click(function () {

        })
    });

</script>


<div id="loading" style="display:none"><img src="/css/jqm/images/ajax-loader.gif"></div>

<div class="panel panel-default">
    <div class="panel-heading ">
        <div style="float: right">
            <span class="fa fa-user-plus" id="add-user"></span>
            <span class="glyphicon glyphicon-align-justify" id="show-rows" style="display: none"></span>
            <span class="glyphicon glyphicon-th" id="show-panes"></span>
            <span class="fa fa-calendar" id="on-call-list"></span>
        </div>
        Staff List
    </div>
    <div id="members">
        <?php
        $count = 0;

        foreach ($Staffs as $staff) {
            if ($staff['firstname'] == '') {
                continue;
            }
            ?>
            <div class="col-xs-10 col-s-3 col-md-3 staff-member tr" data-id="<?php echo $staff['id']; ?>">
                <div class="edit-pane dropdown">
                    <ul>
                        <li class="has-sub"><span class="glyphicon glyphicon-cog"></span>
                            <ul>
                                <li><a href="#" data-id="<?php echo $staff['id']; ?>" class="btn btn-primary btn-xs schedule">Schedule</a></li>
                                <li><a href="#" data-id="<?php echo $staff['id']; ?>" class="btn btn-primary btn-xs edit">Edit</a></li>
                                <li><a href="#" class="btn btn-primary btn-xs credentials" data-id="<?php echo $staff['id']; ?>">Credentials</a></li>
                                <li><a href="#" class="btn btn-primary btn-xs permissions" data-id="<?php echo $staff['id']; ?>">Permissions</a></li>
                                <li><a href="#" class="btn btn-primary btn-xs emergency" data-id="<?php echo $staff['id']; ?>">Emergency Contacts</a></li>
                                <li><a href="#" data-id="<?php echo $staff['id']; ?>" class="btn btn-primary btn-xs delete">Delete</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="logged-in"><?php echo (time() - strtotime($staff['lastLogin'])) < 20000 ? '<span class="glyphicon glyphicon-star"></span>' : '<span class="glyphicon glyphicon-star-empty"></span>'; ?></div>

                <img src="/images/feature.png" width="50" />
                <div class="td name"><?php echo $staff['lastname']; ?>, <?php echo $staff['firstname']; ?></div>
                <div class="td title"><?php echo $staff['title']; ?></div>
                <div class="td department"><?php echo (isset($staff['Departments_id']) ? $DepartmentsList[$staff['Departments_id']] : '(not specified)'); ?></div>
                <div class="td mobile">Mobile: <?php echo $staff['mobile']; ?></div>
                <div class="td telephone">Extension: <?php echo $staff['telephone']; ?></div>
                <div class="td email"><?php echo $staff['email']; ?></div>
                <div>
                    <div class="td status-select" style="display:none">
                        <select class="staffStatus">
                            <option <?php echo ($staff['status'] == 'active') ? 'selected' : ''; ?>>active</option>
                            <option <?php echo ($staff['status'] == 'suspended') ? 'selected' : ''; ?>>suspended</option>
                            <option <?php echo ($staff['status'] == 'locked') ? 'selected' : ''; ?>>locked</option>
                        </select>
                    </div>
                    <a data-type="status" onclick="return false;" class="status"><?php echo $staff['status']; ?></a>
                </div>

                <div>last Login: <?php echo $staff['lastLogin']; ?></div>
            </div>
            <?php
        }
        ?>
    </div>
</div>


<?php echo $pagination; ?>

