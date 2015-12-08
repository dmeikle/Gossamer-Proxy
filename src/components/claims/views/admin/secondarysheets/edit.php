
<table class="table">
    <tr>
        <td><?php echo $this->getString('CLAIMS_DATE'); ?></td>
        <td> </td>
        <td><?php echo $this->getString('CLAIMS_TECHNICIANS_ATTENDED'); ?></td>
        <td> </td>
    </tr>
    <tr>
        <td><?php echo $this->getString('CLAIMS_UNIT_NO'); ?></td>
        <td> </td>
        <td><?php echo $this->getString('CLAIMS_ADDRESS'); ?></td>
        <td> </td>
    </tr>
    <tr>
        <td><?php echo $this->getString('CLAIMS_ROOM'); ?></td>
        <td> </td>
        <td><?php echo $this->getString('CLAIMS_CITY'); ?></td>
        <td> </td>
    </tr>

    <tr>
        <td colspan="4">EXTRACTION</td>
    </tr>
    <tr>
        <td colspan="4">Carpet Lino Tile Hardwood Other Leech Wan SqFt</td>
    </tr>
</table>
<?php
$category = '';
foreach ($Actions as $category => $questionList) {
    echo "<h3>$category</h3>";
    foreach ($questionList as $question) {
        echo '<input name="action[' . $question['id'] . '" type="checkbox" id="qwe" value="1" ' . (('1' == $question['isActive']) ? 'checked="checked"' : '') . '/> ' .
        $question['action'] . '&nbsp;&nbsp;';
    }
}
?>
<?php pr($this->data); ?>