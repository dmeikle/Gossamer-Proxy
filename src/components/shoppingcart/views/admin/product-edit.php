<!--- css start --->
@components/shoppingcart/includes/css/product-edit.css
<!--- css end --->

<!--- javascript start --->
@components/shoppingcart/includes/js/bootstrap-wysiwyg.js
@components/shoppingcart/includes/js/jquery.hotkeys.js
components/shoppingcart/includes/js/product-edit-init.js
<!--- javascript end --->

<?php
$product = current($CartProduct);
?>

<form method="post" class="form-horizontal" role="form" accept-charset="utf-8">
    <table width="540" border="0" cellpadding="2">
        <tr>
            <td colspan="2">

                <ul class="nav nav-tabs" role="tablist">
                    <?php
                    foreach ($locales as $locale) {

                        if ($locale['isDefault']) {
                            echo "<li class=\"active\"><a href=\"#{$locale['locale']}\" role=\"tab\" data-toggle=\"tab\">{$locale['locale']}</a></li>\r\n";
                        } else {
                            echo "<li><a href=\"#{$locale['locale']}\" role=\"tab\" data-toggle=\"tab\">{$locale['locale']}</a></li>\r\n";
                        }
                    }
                    ?>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <?php
                    foreach ($locales as $locale) {
                        // if($locale['isPrimary']) {
                        ?>

                        <div class="tab-pane<?php echo ($locale['isDefault']) ? ' active' : ''; ?>" id="<?php echo $locale['locale']; ?>">
                            <table width="100%">
                                <tr>
                                    <td width="120"><?php echo $this->getString('LABEL_TITLE'); ?>:</td>
                                    <td><input class="form-control" type="text" name="product[locale][<?php echo $locale['locale']; ?>][title]" value="<?php echo htmlspecialchars($product['locales'][$locale['locale']]['title'], ENT_NOQUOTES, 'UTF-8'); ?>"/></td>
                                </tr>
                                <tr>
                                    <td><?php echo $this->getString('LABEL_BRIEF_DESCRIPTION'); ?>:</td>
                                    <td><textarea cols="40" class="form-control" name="product[locale][<?php echo $locale['locale']; ?>][briefDescription]"><?php echo $product['locales'][$locale['locale']]['briefDescription']; ?></textarea></td>
                                </tr>
                                <tr>
                                    <td>Description:</td>
                                    <td>

                                        <textarea class="form-control" name="product[locale][<?php echo $locale['locale']; ?>][description]"><?php echo $product['locales'][$locale['locale']]['description']; ?></textarea></td>
                                </tr>
                            </table>
                        </div>

                        <?php
                    }
                    ?>
                </div>
            </td>
        </tr>
        <tr>
            <td width="120">product code</td>
            <td><input class="form-control" name="product[product_code]" type="text" value="<?php echo $product['product_code'] ?>" size="12" id="product_code"></td>
        </tr>
        <tr>
            <td>Categories</td>
            <td class="form-group">
                <select class="form-control" name="product[categories][id]" size="5" multiple="multiple">
                    <?php
                    echo $categoryOptions;
//                foreach($categoryList as $categoryId => $category) {
//                    echo "<option value=\"{$categoryId}\"".((isset($category['itemId']))?" selected":"").">{$category}</option>";
//                }
                    ?>
                </select>    </td>
        </tr>
        <tr>
            <td>price USD</td>
            <td><input class="form-control" name="product[priceUSD]" type="text" value="<?php echo $product['priceUSD'] ?>" size="8" id="priceUSD"></td>
        </tr>
        <tr>
            <td>price CAD</td>
            <td><input class="form-control" name="product[priceCAD]" type="text" value="<?php echo $product['priceCAD'] ?>" size="8" id="priceCAD"></td>
        </tr>
        <tr>
            <td>sale Price USD</td>
            <td><input class="form-control" name="product[salePriceUSD]" type="text" value="<?php echo $product['salePriceUSD'] ?>" size="8" id="salePriceUSD"></td>
        </tr>
        <tr>
            <td>sale PriceCAD</td>
            <td><input class="form-control" name="product[salePriceCAD]" type="text" value="<?php echo $product['salePriceCAD'] ?>" size="8" id="salePriceCAD"></td>
        </tr>
        <tr>
            <td>list priceUSD</td>
            <td><input class="form-control" name="product[listPriceUSD]" type="text" value="<?php echo $product['listPriceUSD'] ?>" size="8" id="listPriceUSD"></td>
        </tr>
        <tr>
            <td>list priceCAD</td>
            <td><input class="form-control" name="product[listPriceCAD]" type="text" value="<?php echo $product['listPriceCAD'] ?>" size="8" id="listPriceCAD"></td>
        </tr>
        <tr>
            <td>On sale</td>
            <td><input class="form-control" type="checkbox" name="product[isOnSale]" value="1" <?php echo (($product['isOnSale']) ? "checked" : "") ?>></td>
        </tr>
        <tr>
            <td>thumbnail</td>
            <td><select class="form-control" name="product[thumbnail]">
                    <?php
                    $baseFolder = __SITE_PATH . "/web/images/cart/thumbnails/";

                    $dirlist = getFileList($baseFolder, true);
                    foreach ($dirlist as $file) {
                        echo '<option value="' . str_replace($baseFolder, "", $file["name"]) . '"';
                        if (str_replace($baseFolder, "", $file["name"]) == $product['thumbnail'])
                            echo " selected";
                        echo '>' . str_replace($baseFolder, "", $file["name"]) . '</option>\n';
                    }
                    ?>
                </select></td>
        </tr>
        <tr>
            <td>picture</td>
            <td><select class="form-control" name="product[picture]">
                    <?php
                    $baseFolder = __SITE_PATH . "/web/images/cart/";

                    $dirlist = getFileList($baseFolder, true);
                    foreach ($dirlist as $file) {
                        if (!strpos($file['name'], "thumbnails")) {
                            echo '<option value="' . str_replace($baseFolder, "", $file["name"]) . '"';
                            if (str_replace($baseFolder, "", $file["name"]) == $product['picture'])
                                echo " selected";
                            echo '>' . str_replace($baseFolder, "", $file["name"]) . '</option>';
                        }
                    }
                    ?>
                </select>    </td>
        </tr>
        <tr>
            <td>items / box </td>
            <td><input class="form-control" name="product[numPerBox]" type="text" id="numPerBox" size="5" value="<?php echo $product['numPerBox'] ?>" /></td>
        </tr>
        <tr>
            <td>min quantity </td>
            <td><input class="form-control" name="product[minOrderQuantity]" type="text" id="minOrderQuantity" size="5" value="<?php echo $product['minOrderQuantity'] ?>" /></td>
        </tr>
        <tr>
            <td>delivery time </td>
            <td><select class="form-control" name="product[deliveryTime]">
                    <option value="1"<?php echo (("1" == $product['deliveryTime']) ? " selected" : "Ships Immediately + Delivery Time") ?>>Ships Immediately + Delivery Time</option>
                    <option value="2"<?php echo (("2" == $product['deliveryTime']) ? " selected" : "Ships in 7 Business Days + Delivery Time") ?>>Ships in 7 Business Days + Delivery Time</option>
                    <option value="3"<?php echo (("3" == $product['deliveryTime']) ? " selected" : "Ships in 2 Weeks + Delivery Time") ?>>Ships in 2 Weeks + Delivery Time</option>
                    <option value="4"<?php echo (("4" == $product['deliveryTime']) ? " selected" : "") ?>>Pre Order</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>customers rating</td>
            <td><input class="form-control" name="product[customers_rating]" type="text" value="<?php echo $product['customers_rating'] ?>" id="customers_rating"></td>
        </tr>
        <tr>
            <td>customer votes</td>
            <td><input class="form-control" name="product[customer_votes]" type="text" value="<?php echo $product['customer_votes'] ?>" id="customer_votes"></td>
        </tr>
        <tr>
            <td>items sold</td>
            <td><input class="form-control" name="product[items_sold]" type="text" value="<?php echo $product['items_sold'] ?>" id="items_sold"></td>
        </tr>
        <tr>
            <td>big picture</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>weight</td>
            <td><input class="form-control" name="product[weight]" type="text" value="<?php echo $product['weight'] ?>" size="8" id="weight"></td>
        </tr>
        <tr>
            <td>dateIn</td>
            <td><input class="form-control" name="product[dateIn]" type="text" value="<?php echo $product['dateIn'] ?>" id="dateIn"></td>
        </tr>
        <tr>
            <td>hasCustomText</td>
            <td><input class="form-control" name="product[hasCustomText]" type="checkbox" id="hasCustomText" value="1" <?php echo (($product['hasCustomText']) ? "checked" : "") ?>>
                This will display a text field in the user display area </td>
        </tr>
        <tr>
            <td>shippingOffset</td>
            <td><input class="form-control" name="product[shippingOffset]" type="text" value="<?php echo $product['shippingOffset'] ?>" size="8" id="shippingOffset">
                <br>
                Some items cost extra to ship by weight or dimension. This will add a surcharge to the calculated shipping amount to help recoup expenses for shipping this item. </td>
        </tr>
        <tr>
            <td>in_stock</td>
            <td><input class="form-control" name="product[in_stock]" type="checkbox" id="in_stock" value="1" <?php echo (($product['in_stock']) ? "checked" : "") ?>></td>
        </tr>
        <tr>
            <td>enabled</td>
            <td><input class="form-control" name="product[enabled]" type="checkbox" id="enabled" value="1" <?php echo (($product['enabled']) ? "checked" : "") ?>>
                <br>
                Clicking this will display the item in the user front end shopping area as long is it is not overridden by 'discontinued'. </td>
        </tr>
        <tr>
            <td valign="top">discontinued</td>
            <td><input class="form-control" name="product[discontinued]" type="checkbox" id="discontinued" value="1" <?php echo (($product['discontinued']) ? "checked" : "") ?>>
                <br>
                Clicking this will prevent it from displaying in admin - the item is effectively invisible to everyone, preventing accidental 'enable' during bulk edits. Once clicked this item can only be retrieved by an administrator with database access.</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><input class="btn-warning" type="submit" name="Submit" value="Cancel">
                <input type="reset" name="Submit2" value="Reset">
                <input name="Submit" type="submit" id="Submit" value="Submit"></td>
        </tr>
    </table>
    <input type="hidden" name="productID" value="<?php echo $product['id'] ?>"/>
    <?php if (isset($_REQUEST["clone"]) && "true" == $_REQUEST["clone"]) { ?>
        <input type="hidden" name="clone" value="true"/>
    <?php } ?>
</form>

<?php

function getFileList($dir, $recurse = false) {
    # array to hold return value
    $retval = array();

    # add trailing slash if missing
    if (substr($dir, -1) != "/")
        $dir .= "/";

    # open pointer to directory and read list of files
    $d = @dir($dir) or die("getFileList: Failed opening directory $dir for reading");
    while (false !== ($entry = $d->read())) {
        # skip hidden files
        if ($entry[0] == "." || strpos($entry[0], 'thumbnails'))
            continue;
        if (is_dir("$dir$entry")) {
            $retval[] = array(
                "name" => "$dir$entry/",
                "type" => filetype("$dir$entry"),
                "size" => 0,
                "lastmod" => filemtime("$dir$entry")
            );
            if ($recurse && is_readable("$dir$entry/")) {
                $retval = array_merge($retval, getFileList("$dir$entry/", true));
            }
        } elseif (is_readable("$dir$entry")) {
            $retval[] = array(
                "name" => "$dir$entry",
                "type" => mime_content_type("$dir$entry"),
                "size" => filesize("$dir$entry"),
                "lastmod" => filemtime("$dir$entry")
            );
        }
    }
    $d->close();

    return $retval;
}

$item = null;
?>