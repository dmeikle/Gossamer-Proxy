
<!-- 1. Include style for add to calendar button -->
<link href="http://addtocalendar.com/atc/1.5/atc-style-blue.css" rel="stylesheet" type="text/css">

<style type="text/css">

    .event {
        width: 100%;
    }
    .event a .date {
        width: 60px;
        float: left;
    }
    .event a .date .panel.panel-default .day {
        text-align: center;
        font-size: 30px;
        line-height: 35px;
        font-weight: bold;
    }
    .event a .date .panel.panel-default .dayOfWeek {
        text-align: center;
        color: #000;
    }
    .event .description {
        float: left;
        width: 400px;
        margin-left: 10px;
    }
    .event .description .name {
        font-weight: bold;
        font-size: 16px;
    }
    .event .description .time {
        color: #333;
        font-weight: bolder;
    }
</style>

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
            <?php echo $event['name']; ?> @ <?php echo $location['name']; ?>
        </div>
        <div class="time">
            <?php echo date('M', strtotime($event['eventDate'])); ?> <?php echo date('d', strtotime($event['eventDate'])); ?> @ <?php echo $event['fromTime']; ?>
            - <?php echo $event['toTime']; ?>
        </div>
        <div class="details">
            <?php if ($event['logo'] <> '') { ?>
                <img src="<?php echo $event['logo']; ?>" width="100"/>
            <?php } ?>
            <?php echo $event['description']; ?>

            <?php if ($event['cost'] > 0) { ?>
                <?php echo $this->getString('EVENT_COST'); ?>: $<?php echo number_format($event['cost'], 2); ?>
            <?php } ?>

            <?php if ($event['rsvpRequired'] == 1) { ?>
                <form method="post">
                    <button class="btn btn-primary">+ <?php echo $this->getString('EVENT_RSVP'); ?></button>
                    <span class="addtocalendar atc-style-blue">
                        <var class="atc_event">
                            <var class="atc_date_start"><?php echo $event['eventDate']; ?> <?php echo DATE("H:i", STRTOTIME($event['fromTime'])); ?>:00</var>
                            <var class="atc_date_end"><?php echo $event['eventDate']; ?> <?php echo DATE("H:i", STRTOTIME($event['toTime'])); ?>:00</var>
                            <var class="atc_timezone">America/Vancouver</var>
                            <var class="atc_title"><?php echo $event['name']; ?></var>
                            <var class="atc_description"><?php echo $event['description']; ?></var>
                            <var class="atc_location">Tatooine</var>
                            <var class="atc_organizer">Luke Skywalker</var>
                            <var class="atc_organizer_email">luke@starwars.com</var>
                        </var>
                    </span>

                </form>
            <?php } ?>
        </div>
    </div>
    <div id="location">
        <h3>Location - need formatting</h3>
        name <?php echo $location['name']; ?> <br />
        address <?php echo $location['address']; ?> <br />
        room <?php echo $location['room']; ?> <br />
        city <?php echo $location['city']; ?> <br />
        postalCode <?php echo $location['postalCode']; ?> <br />
        mapUrl <?php echo $location['mapUrl']; ?> <br />

    </div>
</div>

<!-- 2. Include script -->
<script language="javascript">
    (function () {
        if (window.addtocalendar)
            if (typeof window.addtocalendar.start == "function")
                return;
        if (window.ifaddtocalendar == undefined) {
            window.ifaddtocalendar = 1;
            var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
            s.type = 'text/javascript';
            s.charset = 'UTF-8';
            s.async = true;
            s.src = ('https:' == window.location.protocol ? 'https' : 'http') + '://addtocalendar.com/atc/1.5/atc.min.js';
            var h = d[g]('body')[0];
            h.appendChild(s);
        }
    })();
</script>



<h3>screen dump of event details</h3>
<?php
pr($event);
?>