/* 
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */


$(window).load(function () { // This runs when the window has loaded

    var img = $("").attr('src', 'YourImagePath/img.jpg').load(function () {
        $("#a1").append(img);
        // When the image has loaded, stick it in a div
    });

    var img2 = $("").attr('src', 'YourImagePath/img2.jpg').load(function () {
        $("#a2").append(img2);
    });
});