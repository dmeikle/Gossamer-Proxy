<style>
    ul {
        list-style: none;
        width: 200px;
    }

    ul > li{
        background-color: pink;
    }

    ul > li > ul > li{
        background-color: red;
    }

    ul li > ul {
        display: block;
        clear: both;
        margin: 0;
        padding: 0;
    }
</style>


<div id="ceilingbar" class="" role="navigation">
    <ul id="menu">
        <li><a href="#">Main Tab</a>
            <ul>
                <li><a href="#">This is link A</a></li>
                <li><a href="#">This is link B</a></li>
            </ul>
        </li>
    </ul>
</div>