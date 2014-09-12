<html>
    <head>

    </head>
    <body>
        this is a line<br>

        <?php
        foreach($Documents as $document):
            echo $document['title'].'<br>';
            echo $document['description'].'<br>';
            echo $document['locale'].'<br>';
            echo $document['id'].'<br><br>';
        endforeach;
        ?><br>
        this is a 3rd line
        <?php echo 'this is a php executed line' . $replaceme;?>
    </body>
</html>