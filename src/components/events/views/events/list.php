

<style type="text/css">
    #events {
        width: 500px;
        padding-top: 30px;
        padding-bottom: 30px;
        padding-right: 50px;
        padding-left: 50px;
    }
    #events .event {
        width: 100%;
    }
    #events .event a .date {
        width: 60px;
        float: left;
    }
    #events .event a .date .panel.panel-default .day {
        text-align: center;
        font-size: 30px;
        line-height: 35px;
        font-weight: bold;
    }
    #events .event a .date .panel.panel-default .dayOfWeek {
        text-align: center;
        color: #000;
    }
    #events .event .description {
        float: left;
        width: 400px;
        margin-left: 10px;
    }
    #events .event .description .name {
        font-weight: bold;
        font-size: 16px;
    }
    #events .event .description .time {
        color: #333;
        font-weight: bolder;
    }
</style>

<?php
foreach ($Events as $event) {
    if (count($event) == 0) {
        continue;
    };
    ?>



    <div id="events">
        <div class="event">
            <a href="../<?php echo $event['id']; ?>">
                <div class="date">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php echo date('M', strtotime($event['eventDate'])); ?>
                        </div>
                        <div class="day">
                            <?php echo date('d', strtotime($event['eventDate'])); ?>
                        </div>
                        <div class="dayOfWeek">
                            <?php echo date('D', strtotime($event['eventDate'])); ?>
                        </div>
                    </div>
                </div>
            </a>
            <div class="description">
                <div class="toggle"><span class="glyphicon glyphicon-plus"></span></div>
                <div class="name">
                    <?php echo $event['name']; ?> @ The Vancouver Club
                </div>
                <div class="time">
                    <?php echo date('M', strtotime($event['eventDate'])); ?> <?php echo date('d', strtotime($event['eventDate'])); ?> @ <?php echo $event['fromTime']; ?>
                    - <?php echo $event['toTime']; ?>
                </div>
                <div class="details">
                    <?php //echo $event['description'];  ?>
                    <?php if ($event['cost'] > 0) { ?>
                        Tickets: $<?php echo number_format($event['cost'], 2); ?>
                    <?php } ?>

                    <?php if ($event['logo'] <> '') { ?>
                        <img src="<?php echo $event['logo']; ?>" width="150" />
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>



<?php } ?>