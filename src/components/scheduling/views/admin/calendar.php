<style>
    #calendar-header .cell {
        width: 14%;
        float: left;
    }
    #calendar-days .cell {
        width: 14%;
        float: left;
        border-left: solid 1px rgb(228, 225, 225);
        border-top: solid 1px rgb(228, 225, 225);
        padding-left: 2px;
        height: 100px;
    }
    #calendar-header, #calendar-days {
        clear: both;
    }
    #calendar-schedule {
        clear: both;
        position: absolute;
    }
    .day {
        font-weight: bold;
        background-color: aliceblue;
    }
    .padding {
        background-color: ghostwhite;
    }

    .schedule-cell {
        width: 14%;
        float: left;
        border-left: solid 1px rgb(228, 225, 225);
        border-top: solid 1px rgb(228, 225, 225);
        padding-left: 2px;
        height: 100px;
    }
    .type-2 {
        background-color: #F60;
    }
    .type-1 {
        background-color: moccasin;
    }
    #calendar {

    }
</style>
<script language="javascript">
    $(function () {
        $("#addStaff").click(function (e) {
            window.location.replace(window.location + "/add");
        });
    });
</script>
<br />
<form role="form">
    <div id="calendar">
        <div id="calendar-header">
            <div class="cell">Sunday</div>
            <div class="cell">Monday</div>
            <div class="cell">Tuesday</div>
            <div class="cell">Wednesday</div>
            <div class="cell">Thursday</div>
            <div class="cell">Friday</div>
            <div class="cell">Saturday</div>
        </div>
        <div id="calendar-days">
            <?php
            $displayed = false;
            foreach ($calendar['frontPadding'] as $day) {
                ?>
                <div class="cell padding">
                    <div class="day">
                        <?php
                        echo ((!$displayed) ? $this->getString($calendar['months'][$calendar['month'] - 1]) . '-' : '') . $day;
                        $displayed = true
                        ?>

                    </div>
                </div>
                <?php
            }
            $displayed = false;
            foreach ($calendar['currentMonth'] as $day) {
                ?>

                <div class="cell">
                    <div class="day">
                        <?php
                        echo ((!$displayed) ? $this->getString($calendar['months'][$calendar['month']]) . '-' : '') . $day;
                        $displayed = true
                        ?>
                    </div>
                </div>
                <?php
            }
            $displayed = false;
            foreach ($calendar['rearPadding'] as $day) {
                ?>
                <div class="cell padding">
                    <div class="day">
                        <?php
                        echo ((!$displayed) ? $this->getString($calendar['months'][$calendar['month'] + 1]) . '-' : '') . $day;
                        $displayed = true
                        ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <div id="calendar-schedule">
        <?php
//        pr($schedule);
//        die;
        $lastDayStaff = array();
        foreach ($schedule as $date => $row) {
            ?>
            <div class="schedule-cell">
                <?php foreach ($row as $typeId => $staff) { ?>
                    <div class="type-<?php echo $typeId; ?>">
                        <?php
                        foreach ($staff as $id => $name) {
                            echo $name . ' ';
                        }
                        ?>
                    </div>
                    <?php
                }
                ?>
            </div>
        <?php } ?>
    </div>

</form>