

<script>
    $(function () {

        $('.selectable').on('mouseup', 'label', function () {
            var el = $(this);
            console.info(el);
            if (el.hasClass('ui-selected')) {
                el.removeClass('ui-selected');
            } else {
                el.addClass('ui-selected');
            }

        })

        $("#accordion").accordion({
            heightStyle: "content",
            active: false,
            collapsible: true
        });

    });
</script>
<h2>Bedroom 1 Scoping Details</h2>
<div id="accordion">

    <h3>Notice</h3>
    <div>
        <p>
        <table class="table table-striped">
            <tr>
                <td width="1%"><input type="checkbox" name="checkbox" id="checkbox" />
                </td>
                <td width="63%">For the purpose of this scope Entry door to unit is considered North</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td><div>S/I NEW:</div>
                    <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td><div>Remove and Dispose of:</div>

                    <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
            </tr>
        </table>
        </p>
    </div>

    <h3>Drywall &amp; Paint</h3>
    <div>
        <p>
        <table class="table table-striped">

            <tr>
                <td width="4%">&nbsp;</td>
                <td width="56%">

                    S/I Insulation to Walls
                    <p class="selectable"><label><input type="checkbox" name="variant[1][1]" value="1">Batt</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Styrofoam</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Cellulose</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Blown-in</label>
                    </p>
                    Size: <input type="text" /><br />
                    R: <input type="text" />
                </td>
                <td width="38%">SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td width="2%">&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>S/I Insulation to Ceiling
                    <p class="selectable"><label><input type="checkbox" name="variant[1][1]" value="1">Batt</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Styrofoam</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Cellulose</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Blown-in</label>
                    </p>

                </td>
                <td> <div class="col-xs-10">
                        SF<input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>

                    <div class="col-xs-10">
                        Size: 	<input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>

                    <div class="col-xs-10">
                        R: <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td><p class="selectable">S/I 6mil Vapour Barrier to
                        <label><input type="checkbox" name="variant[1][1]" value="1">Walls</label>

                        or
                        <label><input type="checkbox" name="variant[1][1]" value="1">Ceiling</label></p></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td><p class="selectable">S/I <label><input type="checkbox" name="variant[1][1]" value="1">Drywall</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">M.R. Board</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Cement Board</label> to Ceiling

                        <label><input type="checkbox" name="variant[1][1]" value="1">Double</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Triple</label> 1/2&quot;<br />
                        Firetape between each layer of drywall</p></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox9" id="checkbox9" /></td>
                <td><p class="selectable">S/I <label><input type="checkbox" name="variant[1][1]" value="1">Drywall</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">M.R. Board</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Cement Board</label> to Ceiling

                        <label><input type="checkbox" name="variant[1][1]" value="1">Double</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Triple</label> 5/8&quot;<br />
                        Firetape between each layer of drywall</p></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox4" id="checkbox4" /></td>
                <td><p class="selectable">S/I <label><input type="checkbox" name="variant[1][1]" value="1">Drywall</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">M.R. Board</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Cement Board</label> to Walls

                        <label><input type="checkbox" name="variant[1][1]" value="1">Double</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Triple</label> 1/2&quot;<br />
                        Firetape between each layer of drywall</p></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox10" id="checkbox10" /></td>
                <td><p class="selectable">S/I <label><input type="checkbox" name="variant[1][1]" value="1">Drywall</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">M.R. Board</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Cement Board</label> to Walls

                        <label><input type="checkbox" name="variant[1][1]" value="1">Double</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Triple</label> 5/8&quot;<br />
                        Firetape between each layer of drywall</p></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox11" id="checkbox11" /></td>
                <td>S/I Drywall Resilient Channel/ Sound Bar</td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox12" id="checkbox12" /></td>
                <td>S/I Corner Bead [rounded] / J Bead / Plastic J Mould to window returns [ 1/2&quot; ] [5/8&quot;]</td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox13" id="checkbox13" /></td>
                <td>Remove red fire tape to drywall installed during emergencies, tape and fill drywall to paint ready</td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox14" id="checkbox14" /></td>
                <td><p class="selectable">Drywall repair to wall pressurization [holes] [cuts]
                        <label><input type="checkbox" name="variant[1][1]" value="1">North</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">South</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">East</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">West</label>
                    </p>
                </td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox15" id="checkbox15" /></td>
                <td>
                    <p class="selectable">Repair Drywall to Walls or Ceiling [holes] [cuts]
                        <label><input type="checkbox" name="variant[1][1]" value="1">North</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">South</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">East</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">West</label></p></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox16" id="checkbox16" /></td>
                <td>
                    <p class="selectable">Repair Tape Seam to Walls or Ceiling [holes] [cuts]
                        <label><input type="checkbox" name="variant[1][1]" value="1">North</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">South</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">East</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">West</label></p></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox17" id="checkbox17" /></td>
                <td>
                    <p class="selectable">Seal Water Stain On Ceiling or Wall [holes] [cuts]
                        <label><input type="checkbox" name="variant[1][1]" value="1">North</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">South</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">East</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">West</label></p></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox18" id="checkbox18" /></td>
                <td><p class="selectable">Texture Ceiling:
                        <label><input type="checkbox" name="variant[1][1]" value="1">Complete</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">To Blend</label>
                        Scrape Back Texture T.F.W.</td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox19" id="checkbox19" /></td>
                <td>Paint Ceiling Complete <br />
                    continuous to
                    <input type="text" />
                    <br />
                    Ceiling Height:
                    <input type="text"  /></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox20" id="checkbox20" /></td>
                <td>Paint Drop Ceiling or Bulkhead Complete Ceiling Height: <input type="text"  /></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox21" id="checkbox21" /></td>
                <td><p class="selectable">Paint Walls Complete or Affected
                    <p class="selectable">Seal Water Stain On Ceiling or Wall [holes] [cuts]
                        <label><input type="checkbox" name="variant[1][1]" value="1">North</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">South</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">East</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">West</label></p></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox22" id="checkbox22" /></td>
                <td><p class="selectable">[S/I new] [Remove] [reinstall] wallcovering (of L.K.Q.) (and report) (T.F.W.)
                    <p class="selectable">Seal Water Stain On Ceiling or Wall [holes] [cuts]
                        <label><input type="checkbox" name="variant[1][1]" value="1">North</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">South</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">East</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">West</label></p></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox23" id="checkbox23" /></td>
                <td><p class="selectable">Paint / Finish Door to Pre Loss Condition
                        <label><input type="checkbox" name="variant[1][1]" value="1">Entry Door</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Bi-Fold</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Bypass</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Pocket</label></p></td>
                <td>EA</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox24" id="checkbox24" /></td>
                <td>Paint / Finish door frame to Pre Loss condition</td>
                <td>EA</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox25" id="checkbox25" /></td>
                <td>S/I Ceiling Tile (Acoustic) <br />
                    size of tile <input type="text"  /> <br />
                    how many <input type="text"  /></td>
                <td>EA/SQ</td>
                <td>&nbsp;</td>
            </tr>

        </table>



        </p>
    </div>
    <h3>Plumbing / Cabinetry</h3>
    <div>
        <p>
        <table class="table">
            <tr>
                <td width="1%"><input type="checkbox" name="checkbox" id="checkbox" />
                </td>
                <td width="63%">For the purpose of this scope Entry door to unit is considered North</td>
                <td width="1%">SF</td>
                <td width="35%">&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox2" id="checkbox2" /></td>
                <td>S/I NEW:</td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox3" id="checkbox3" /></td>
                <td>Remove and Dispose of:
                    <label for="textfield"></label>
                    <input class="form-control" type="text" name="textfield" id="textfield" /></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>Drywall &amp; Paint</td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox5" id="checkbox5" /></td>
                <td>S/I [Batt] [Styrofoam] [cellulose] [blown-in] Insulation to Walls</td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox6" id="checkbox6" /></td>
                <td>S/I [Batt] [Styrofoam] [cellulose] [blown-in] Insulation to Ceiling</td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox7" id="checkbox7" /></td>
                <td><p class="selectable">S/I 6mil Vapour Barrier to
                        <label><input type="checkbox" name="variant[1][1]" value="1">Walls</label>

                        or
                        <label><input type="checkbox" name="variant[1][1]" value="1">Ceiling</label></p></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox8" id="checkbox8" /></td>
                <td><p class="selectable">S/I <label><input type="checkbox" name="variant[1][1]" value="1">Drywall</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">M.R. Board</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Cement Board</label> to Ceiling

                        <label><input type="checkbox" name="variant[1][1]" value="1">Double</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Triple</label> 1/2&quot;<br />
                        Firetape between each layer of drywall</p></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox9" id="checkbox9" /></td>
                <td><p class="selectable">S/I <label><input type="checkbox" name="variant[1][1]" value="1">Drywall</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">M.R. Board</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Cement Board</label> to Ceiling

                        <label><input type="checkbox" name="variant[1][1]" value="1">Double</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Triple</label> 5/8&quot;<br />
                        Firetape between each layer of drywall</p></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox4" id="checkbox4" /></td>
                <td><p class="selectable">S/I <label><input type="checkbox" name="variant[1][1]" value="1">Drywall</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">M.R. Board</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Cement Board</label> to Walls

                        <label><input type="checkbox" name="variant[1][1]" value="1">Double</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Triple</label> 1/2&quot;<br />
                        Firetape between each layer of drywall</p></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox10" id="checkbox10" /></td>
                <td><p class="selectable">S/I <label><input type="checkbox" name="variant[1][1]" value="1">Drywall</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">M.R. Board</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Cement Board</label> to Walls

                        <label><input type="checkbox" name="variant[1][1]" value="1">Double</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Triple</label> 5/8&quot;<br />
                        Firetape between each layer of drywall</p></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox11" id="checkbox11" /></td>
                <td>S/I Drywall Resilient Channel/ Sound Bar</td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox12" id="checkbox12" /></td>
                <td>S/I Corner Bead [rounded] / J Bead / Plastic J Mould to window returns [ 1/2&quot; ] [5/8&quot;]</td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox13" id="checkbox13" /></td>
                <td>Remove red fire tape to drywall installed during emergencies, tape and fill drywall to paint ready</td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox14" id="checkbox14" /></td>
                <td><p class="selectable">Drywall repair to wall pressurization [holes] [cuts]
                        <label><input type="checkbox" name="variant[1][1]" value="1">North</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">South</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">East</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">West</label>
                    </p>
                </td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox15" id="checkbox15" /></td>
                <td>
                    <p class="selectable">Repair Drywall to Walls or Ceiling [holes] [cuts]
                        <label><input type="checkbox" name="variant[1][1]" value="1">North</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">South</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">East</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">West</label></p></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox16" id="checkbox16" /></td>
                <td>
                    <p class="selectable">Repair Tape Seam to Walls or Ceiling [holes] [cuts]
                        <label><input type="checkbox" name="variant[1][1]" value="1">North</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">South</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">East</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">West</label></p></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox17" id="checkbox17" /></td>
                <td>
                    <p class="selectable">Seal Water Stain On Ceiling or Wall [holes] [cuts]
                        <label><input type="checkbox" name="variant[1][1]" value="1">North</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">South</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">East</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">West</label></p></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox18" id="checkbox18" /></td>
                <td><p class="selectable">Texture Ceiling:
                        <label><input type="checkbox" name="variant[1][1]" value="1">Complete</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">To Blend</label>
                        Scrape Back Texture T.F.W.</td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox19" id="checkbox19" /></td>
                <td>Paint Ceiling Complete <br />
                    continuous to
                    <input type="text" />
                    <br />
                    Ceiling Height:
                    <input type="text"  /></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox20" id="checkbox20" /></td>
                <td>Paint Drop Ceiling or Bulkhead Complete Ceiling Height: <input type="text"  /></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox21" id="checkbox21" /></td>
                <td><p class="selectable">Paint Walls Complete or Affected
                    <p class="selectable">Seal Water Stain On Ceiling or Wall [holes] [cuts]
                        <label><input type="checkbox" name="variant[1][1]" value="1">North</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">South</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">East</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">West</label></p></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox22" id="checkbox22" /></td>
                <td><p class="selectable">[S/I new] [Remove] [reinstall] wallcovering (of L.K.Q.) (and report) (T.F.W.)
                    <p class="selectable">Seal Water Stain On Ceiling or Wall [holes] [cuts]
                        <label><input type="checkbox" name="variant[1][1]" value="1">North</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">South</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">East</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">West</label></p></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox23" id="checkbox23" /></td>
                <td><p class="selectable">Paint / Finish Door to Pre Loss Condition
                        <label><input type="checkbox" name="variant[1][1]" value="1">Entry Door</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Bi-Fold</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Bypass</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Pocket</label></p></td>
                <td>EA</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox24" id="checkbox24" /></td>
                <td>Paint / Finish door frame to Pre Loss condition</td>
                <td>EA</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox25" id="checkbox25" /></td>
                <td>S/I Ceiling Tile (Acoustic) <br />
                    size of tile <input type="text"  /> <br />
                    how many <input type="text"  /></td>
                <td>EA/SQ</td>
                <td>&nbsp;</td>
            </tr>

        </table>


        </p>
    </div>
    <h3>Baseboads &amp; Trim</h3>
    <div>
        <p>
        <table class="table">
            <tr>
                <td width="1%"><input type="checkbox" name="checkbox" id="checkbox" />
                </td>
                <td width="63%">For the purpose of this scope Entry door to unit is considered North</td>
                <td width="1%">SF</td>
                <td width="35%">&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox2" id="checkbox2" /></td>
                <td>S/I NEW:</td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox3" id="checkbox3" /></td>
                <td>Remove and Dispose of:
                    <label for="textfield"></label>
                    <input class="form-control" type="text" name="textfield" id="textfield" /></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>Drywall &amp; Paint</td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox5" id="checkbox5" /></td>
                <td>S/I [Batt] [Styrofoam] [cellulose] [blown-in] Insulation to Walls</td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox6" id="checkbox6" /></td>
                <td>S/I [Batt] [Styrofoam] [cellulose] [blown-in] Insulation to Ceiling</td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox7" id="checkbox7" /></td>
                <td><p class="selectable">S/I 6mil Vapour Barrier to
                        <label><input type="checkbox" name="variant[1][1]" value="1">Walls</label>

                        or
                        <label><input type="checkbox" name="variant[1][1]" value="1">Ceiling</label></p></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox8" id="checkbox8" /></td>
                <td><p class="selectable">S/I <label><input type="checkbox" name="variant[1][1]" value="1">Drywall</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">M.R. Board</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Cement Board</label> to Ceiling

                        <label><input type="checkbox" name="variant[1][1]" value="1">Double</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Triple</label> 1/2&quot;<br />
                        Firetape between each layer of drywall</p></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox9" id="checkbox9" /></td>
                <td><p class="selectable">S/I <label><input type="checkbox" name="variant[1][1]" value="1">Drywall</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">M.R. Board</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Cement Board</label> to Ceiling

                        <label><input type="checkbox" name="variant[1][1]" value="1">Double</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Triple</label> 5/8&quot;<br />
                        Firetape between each layer of drywall</p></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox4" id="checkbox4" /></td>
                <td><p class="selectable">S/I <label><input type="checkbox" name="variant[1][1]" value="1">Drywall</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">M.R. Board</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Cement Board</label> to Walls

                        <label><input type="checkbox" name="variant[1][1]" value="1">Double</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Triple</label> 1/2&quot;<br />
                        Firetape between each layer of drywall</p></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox10" id="checkbox10" /></td>
                <td><p class="selectable">S/I <label><input type="checkbox" name="variant[1][1]" value="1">Drywall</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">M.R. Board</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Cement Board</label> to Walls

                        <label><input type="checkbox" name="variant[1][1]" value="1">Double</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Triple</label> 5/8&quot;<br />
                        Firetape between each layer of drywall</p></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox11" id="checkbox11" /></td>
                <td>S/I Drywall Resilient Channel/ Sound Bar</td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox12" id="checkbox12" /></td>
                <td>S/I Corner Bead [rounded] / J Bead / Plastic J Mould to window returns [ 1/2&quot; ] [5/8&quot;]</td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox13" id="checkbox13" /></td>
                <td>Remove red fire tape to drywall installed during emergencies, tape and fill drywall to paint ready</td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox14" id="checkbox14" /></td>
                <td><p class="selectable">Drywall repair to wall pressurization [holes] [cuts]
                        <label><input type="checkbox" name="variant[1][1]" value="1">North</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">South</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">East</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">West</label>
                    </p>
                </td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox15" id="checkbox15" /></td>
                <td>
                    <p class="selectable">Repair Drywall to Walls or Ceiling [holes] [cuts]
                        <label><input type="checkbox" name="variant[1][1]" value="1">North</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">South</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">East</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">West</label></p></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox16" id="checkbox16" /></td>
                <td>
                    <p class="selectable">Repair Tape Seam to Walls or Ceiling [holes] [cuts]
                        <label><input type="checkbox" name="variant[1][1]" value="1">North</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">South</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">East</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">West</label></p></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox17" id="checkbox17" /></td>
                <td>
                    <p class="selectable">Seal Water Stain On Ceiling or Wall [holes] [cuts]
                        <label><input type="checkbox" name="variant[1][1]" value="1">North</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">South</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">East</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">West</label></p></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox18" id="checkbox18" /></td>
                <td><p class="selectable">Texture Ceiling:
                        <label><input type="checkbox" name="variant[1][1]" value="1">Complete</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">To Blend</label>
                        Scrape Back Texture T.F.W.</td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox19" id="checkbox19" /></td>
                <td>Paint Ceiling Complete <br />
                    continuous to
                    <input type="text" />
                    <br />
                    Ceiling Height:
                    <input type="text"  /></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox20" id="checkbox20" /></td>
                <td>Paint Drop Ceiling or Bulkhead Complete Ceiling Height: <input type="text"  /></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox21" id="checkbox21" /></td>
                <td><p class="selectable">Paint Walls Complete or Affected
                    <p class="selectable">Seal Water Stain On Ceiling or Wall [holes] [cuts]
                        <label><input type="checkbox" name="variant[1][1]" value="1">North</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">South</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">East</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">West</label></p></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox22" id="checkbox22" /></td>
                <td><p class="selectable">[S/I new] [Remove] [reinstall] wallcovering (of L.K.Q.) (and report) (T.F.W.)
                    <p class="selectable">Seal Water Stain On Ceiling or Wall [holes] [cuts]
                        <label><input type="checkbox" name="variant[1][1]" value="1">North</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">South</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">East</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">West</label></p></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox23" id="checkbox23" /></td>
                <td><p class="selectable">Paint / Finish Door to Pre Loss Condition
                        <label><input type="checkbox" name="variant[1][1]" value="1">Entry Door</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Bi-Fold</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Bypass</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Pocket</label></p></td>
                <td>EA</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox24" id="checkbox24" /></td>
                <td>Paint / Finish door frame to Pre Loss condition</td>
                <td>EA</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox25" id="checkbox25" /></td>
                <td>S/I Ceiling Tile (Acoustic) <br />
                    size of tile <input type="text"  /> <br />
                    how many <input type="text"  /></td>
                <td>EA/SQ</td>
                <td>&nbsp;</td>
            </tr>

        </table>

        </p>

    </div>

    <h3>Doors &amp; Electrical</h3>
    <div>
        <p>
        <table class="table">
            <tr>
                <td width="1%"><input type="checkbox" name="checkbox" id="checkbox" />
                </td>
                <td width="63%">For the purpose of this scope Entry door to unit is considered North</td>
                <td width="1%">SF</td>
                <td width="35%">&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox2" id="checkbox2" /></td>
                <td>S/I NEW:</td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox3" id="checkbox3" /></td>
                <td>Remove and Dispose of:
                    <label for="textfield"></label>
                    <input class="form-control" type="text" name="textfield" id="textfield" /></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>Drywall &amp; Paint</td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox5" id="checkbox5" /></td>
                <td>S/I [Batt] [Styrofoam] [cellulose] [blown-in] Insulation to Walls</td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox6" id="checkbox6" /></td>
                <td>S/I [Batt] [Styrofoam] [cellulose] [blown-in] Insulation to Ceiling</td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox7" id="checkbox7" /></td>
                <td><p class="selectable">S/I 6mil Vapour Barrier to
                        <label><input type="checkbox" name="variant[1][1]" value="1">Walls</label>

                        or
                        <label><input type="checkbox" name="variant[1][1]" value="1">Ceiling</label></p></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox8" id="checkbox8" /></td>
                <td><p class="selectable">S/I <label><input type="checkbox" name="variant[1][1]" value="1">Drywall</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">M.R. Board</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Cement Board</label> to Ceiling

                        <label><input type="checkbox" name="variant[1][1]" value="1">Double</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Triple</label> 1/2&quot;<br />
                        Firetape between each layer of drywall</p></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox9" id="checkbox9" /></td>
                <td><p class="selectable">S/I <label><input type="checkbox" name="variant[1][1]" value="1">Drywall</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">M.R. Board</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Cement Board</label> to Ceiling

                        <label><input type="checkbox" name="variant[1][1]" value="1">Double</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Triple</label> 5/8&quot;<br />
                        Firetape between each layer of drywall</p></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox4" id="checkbox4" /></td>
                <td><p class="selectable">S/I <label><input type="checkbox" name="variant[1][1]" value="1">Drywall</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">M.R. Board</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Cement Board</label> to Walls

                        <label><input type="checkbox" name="variant[1][1]" value="1">Double</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Triple</label> 1/2&quot;<br />
                        Firetape between each layer of drywall</p></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox10" id="checkbox10" /></td>
                <td><p class="selectable">S/I <label><input type="checkbox" name="variant[1][1]" value="1">Drywall</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">M.R. Board</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Cement Board</label> to Walls

                        <label><input type="checkbox" name="variant[1][1]" value="1">Double</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Triple</label> 5/8&quot;<br />
                        Firetape between each layer of drywall</p></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox11" id="checkbox11" /></td>
                <td>S/I Drywall Resilient Channel/ Sound Bar</td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox12" id="checkbox12" /></td>
                <td>S/I Corner Bead [rounded] / J Bead / Plastic J Mould to window returns [ 1/2&quot; ] [5/8&quot;]</td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox13" id="checkbox13" /></td>
                <td>Remove red fire tape to drywall installed during emergencies, tape and fill drywall to paint ready</td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox14" id="checkbox14" /></td>
                <td><p class="selectable">Drywall repair to wall pressurization [holes] [cuts]
                        <label><input type="checkbox" name="variant[1][1]" value="1">North</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">South</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">East</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">West</label>
                    </p>
                </td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox15" id="checkbox15" /></td>
                <td>
                    <p class="selectable">Repair Drywall to Walls or Ceiling [holes] [cuts]
                        <label><input type="checkbox" name="variant[1][1]" value="1">North</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">South</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">East</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">West</label></p></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox16" id="checkbox16" /></td>
                <td>
                    <p class="selectable">Repair Tape Seam to Walls or Ceiling [holes] [cuts]
                        <label><input type="checkbox" name="variant[1][1]" value="1">North</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">South</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">East</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">West</label></p></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox17" id="checkbox17" /></td>
                <td>
                    <p class="selectable">Seal Water Stain On Ceiling or Wall [holes] [cuts]
                        <label><input type="checkbox" name="variant[1][1]" value="1">North</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">South</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">East</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">West</label></p></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox18" id="checkbox18" /></td>
                <td><p class="selectable">Texture Ceiling:
                        <label><input type="checkbox" name="variant[1][1]" value="1">Complete</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">To Blend</label>
                        Scrape Back Texture T.F.W.</td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox19" id="checkbox19" /></td>
                <td>Paint Ceiling Complete <br />
                    continuous to
                    <input type="text" />
                    <br />
                    Ceiling Height:
                    <input type="text"  /></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox20" id="checkbox20" /></td>
                <td>Paint Drop Ceiling or Bulkhead Complete Ceiling Height: <input type="text"  /></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox21" id="checkbox21" /></td>
                <td><p class="selectable">Paint Walls Complete or Affected
                    <p class="selectable">Seal Water Stain On Ceiling or Wall [holes] [cuts]
                        <label><input type="checkbox" name="variant[1][1]" value="1">North</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">South</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">East</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">West</label></p></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox22" id="checkbox22" /></td>
                <td><p class="selectable">[S/I new] [Remove] [reinstall] wallcovering (of L.K.Q.) (and report) (T.F.W.)
                    <p class="selectable">Seal Water Stain On Ceiling or Wall [holes] [cuts]
                        <label><input type="checkbox" name="variant[1][1]" value="1">North</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">South</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">East</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">West</label></p></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox23" id="checkbox23" /></td>
                <td><p class="selectable">Paint / Finish Door to Pre Loss Condition
                        <label><input type="checkbox" name="variant[1][1]" value="1">Entry Door</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Bi-Fold</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Bypass</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Pocket</label></p></td>
                <td>EA</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox24" id="checkbox24" /></td>
                <td>Paint / Finish door frame to Pre Loss condition</td>
                <td>EA</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox25" id="checkbox25" /></td>
                <td>S/I Ceiling Tile (Acoustic) <br />
                    size of tile <input type="text"  /> <br />
                    how many <input type="text"  /></td>
                <td>EA/SQ</td>
                <td>&nbsp;</td>
            </tr>

        </table>

        </p>

    </div>
    <h3>Flooring</h3>
    <div>
        <p>
        <table class="table">
            <tr>
                <td width="1%"><input type="checkbox" name="checkbox" id="checkbox" />
                </td>
                <td width="63%">For the purpose of this scope Entry door to unit is considered North</td>
                <td width="1%">SF</td>
                <td width="35%">&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox2" id="checkbox2" /></td>
                <td>S/I NEW:</td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox3" id="checkbox3" /></td>
                <td>Remove and Dispose of:
                    <label for="textfield"></label>
                    <input class="form-control" type="text" name="textfield" id="textfield" /></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>Drywall &amp; Paint</td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox5" id="checkbox5" /></td>
                <td>S/I [Batt] [Styrofoam] [cellulose] [blown-in] Insulation to Walls</td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox6" id="checkbox6" /></td>
                <td>S/I [Batt] [Styrofoam] [cellulose] [blown-in] Insulation to Ceiling</td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox7" id="checkbox7" /></td>
                <td><p class="selectable">S/I 6mil Vapour Barrier to
                        <label><input type="checkbox" name="variant[1][1]" value="1">Walls</label>

                        or
                        <label><input type="checkbox" name="variant[1][1]" value="1">Ceiling</label></p></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox8" id="checkbox8" /></td>
                <td><p class="selectable">S/I <label><input type="checkbox" name="variant[1][1]" value="1">Drywall</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">M.R. Board</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Cement Board</label> to Ceiling

                        <label><input type="checkbox" name="variant[1][1]" value="1">Double</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Triple</label> 1/2&quot;<br />
                        Firetape between each layer of drywall</p></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox9" id="checkbox9" /></td>
                <td><p class="selectable">S/I <label><input type="checkbox" name="variant[1][1]" value="1">Drywall</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">M.R. Board</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Cement Board</label> to Ceiling

                        <label><input type="checkbox" name="variant[1][1]" value="1">Double</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Triple</label> 5/8&quot;<br />
                        Firetape between each layer of drywall</p></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox4" id="checkbox4" /></td>
                <td><p class="selectable">S/I <label><input type="checkbox" name="variant[1][1]" value="1">Drywall</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">M.R. Board</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Cement Board</label> to Walls

                        <label><input type="checkbox" name="variant[1][1]" value="1">Double</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Triple</label> 1/2&quot;<br />
                        Firetape between each layer of drywall</p></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox10" id="checkbox10" /></td>
                <td><p class="selectable">S/I <label><input type="checkbox" name="variant[1][1]" value="1">Drywall</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">M.R. Board</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Cement Board</label> to Walls

                        <label><input type="checkbox" name="variant[1][1]" value="1">Double</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Triple</label> 5/8&quot;<br />
                        Firetape between each layer of drywall</p></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox11" id="checkbox11" /></td>
                <td>S/I Drywall Resilient Channel/ Sound Bar</td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox12" id="checkbox12" /></td>
                <td>S/I Corner Bead [rounded] / J Bead / Plastic J Mould to window returns [ 1/2&quot; ] [5/8&quot;]</td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox13" id="checkbox13" /></td>
                <td>Remove red fire tape to drywall installed during emergencies, tape and fill drywall to paint ready</td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox14" id="checkbox14" /></td>
                <td><p class="selectable">Drywall repair to wall pressurization [holes] [cuts]
                        <label><input type="checkbox" name="variant[1][1]" value="1">North</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">South</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">East</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">West</label>
                    </p>
                </td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox15" id="checkbox15" /></td>
                <td>
                    <p class="selectable">Repair Drywall to Walls or Ceiling [holes] [cuts]
                        <label><input type="checkbox" name="variant[1][1]" value="1">North</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">South</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">East</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">West</label></p></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox16" id="checkbox16" /></td>
                <td>
                    <p class="selectable">Repair Tape Seam to Walls or Ceiling [holes] [cuts]
                        <label><input type="checkbox" name="variant[1][1]" value="1">North</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">South</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">East</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">West</label></p></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox17" id="checkbox17" /></td>
                <td>
                    <p class="selectable">Seal Water Stain On Ceiling or Wall [holes] [cuts]
                        <label><input type="checkbox" name="variant[1][1]" value="1">North</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">South</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">East</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">West</label></p></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox18" id="checkbox18" /></td>
                <td><p class="selectable">Texture Ceiling:
                        <label><input type="checkbox" name="variant[1][1]" value="1">Complete</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">To Blend</label>
                        Scrape Back Texture T.F.W.</td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox19" id="checkbox19" /></td>
                <td>Paint Ceiling Complete <br />
                    continuous to
                    <input type="text" />
                    <br />
                    Ceiling Height:
                    <input type="text"  /></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox20" id="checkbox20" /></td>
                <td>Paint Drop Ceiling or Bulkhead Complete Ceiling Height: <input type="text"  /></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox21" id="checkbox21" /></td>
                <td><p class="selectable">Paint Walls Complete or Affected
                    <p class="selectable">Seal Water Stain On Ceiling or Wall [holes] [cuts]
                        <label><input type="checkbox" name="variant[1][1]" value="1">North</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">South</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">East</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">West</label></p></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox22" id="checkbox22" /></td>
                <td><p class="selectable">[S/I new] [Remove] [reinstall] wallcovering (of L.K.Q.) (and report) (T.F.W.)
                    <p class="selectable">Seal Water Stain On Ceiling or Wall [holes] [cuts]
                        <label><input type="checkbox" name="variant[1][1]" value="1">North</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">South</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">East</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">West</label></p></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox23" id="checkbox23" /></td>
                <td><p class="selectable">Paint / Finish Door to Pre Loss Condition
                        <label><input type="checkbox" name="variant[1][1]" value="1">Entry Door</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Bi-Fold</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Bypass</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Pocket</label></p></td>
                <td>EA</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox24" id="checkbox24" /></td>
                <td>Paint / Finish door frame to Pre Loss condition</td>
                <td>EA</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox25" id="checkbox25" /></td>
                <td>S/I Ceiling Tile (Acoustic) <br />
                    size of tile <input type="text"  /> <br />
                    how many <input type="text"  /></td>
                <td>EA/SQ</td>
                <td>&nbsp;</td>
            </tr>

        </table>

        </p>

    </div>
    <h3>General</h3>
    <div>
        <p>
        <table class="table">
            <tr>
                <td width="1%"><input type="checkbox" name="checkbox" id="checkbox" />
                </td>
                <td width="63%">For the purpose of this scope Entry door to unit is considered North</td>
                <td width="1%">SF</td>
                <td width="35%">&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox2" id="checkbox2" /></td>
                <td>S/I NEW:</td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox3" id="checkbox3" /></td>
                <td>Remove and Dispose of:
                    <label for="textfield"></label>
                    <input class="form-control" type="text" name="textfield" id="textfield" /></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>Drywall &amp; Paint</td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox5" id="checkbox5" /></td>
                <td>S/I [Batt] [Styrofoam] [cellulose] [blown-in] Insulation to Walls</td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox6" id="checkbox6" /></td>
                <td>S/I [Batt] [Styrofoam] [cellulose] [blown-in] Insulation to Ceiling</td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox7" id="checkbox7" /></td>
                <td><p class="selectable">S/I 6mil Vapour Barrier to
                        <label><input type="checkbox" name="variant[1][1]" value="1">Walls</label>

                        or
                        <label><input type="checkbox" name="variant[1][1]" value="1">Ceiling</label></p></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox8" id="checkbox8" /></td>
                <td><p class="selectable">S/I <label><input type="checkbox" name="variant[1][1]" value="1">Drywall</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">M.R. Board</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Cement Board</label> to Ceiling

                        <label><input type="checkbox" name="variant[1][1]" value="1">Double</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Triple</label> 1/2&quot;<br />
                        Firetape between each layer of drywall</p></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox9" id="checkbox9" /></td>
                <td><p class="selectable">S/I <label><input type="checkbox" name="variant[1][1]" value="1">Drywall</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">M.R. Board</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Cement Board</label> to Ceiling

                        <label><input type="checkbox" name="variant[1][1]" value="1">Double</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Triple</label> 5/8&quot;<br />
                        Firetape between each layer of drywall</p></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox4" id="checkbox4" /></td>
                <td><p class="selectable">S/I <label><input type="checkbox" name="variant[1][1]" value="1">Drywall</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">M.R. Board</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Cement Board</label> to Walls

                        <label><input type="checkbox" name="variant[1][1]" value="1">Double</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Triple</label> 1/2&quot;<br />
                        Firetape between each layer of drywall</p></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox10" id="checkbox10" /></td>
                <td><p class="selectable">S/I <label><input type="checkbox" name="variant[1][1]" value="1">Drywall</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">M.R. Board</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Cement Board</label> to Walls

                        <label><input type="checkbox" name="variant[1][1]" value="1">Double</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Triple</label> 5/8&quot;<br />
                        Firetape between each layer of drywall</p></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox11" id="checkbox11" /></td>
                <td>S/I Drywall Resilient Channel/ Sound Bar</td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox12" id="checkbox12" /></td>
                <td>S/I Corner Bead [rounded] / J Bead / Plastic J Mould to window returns [ 1/2&quot; ] [5/8&quot;]</td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox13" id="checkbox13" /></td>
                <td>Remove red fire tape to drywall installed during emergencies, tape and fill drywall to paint ready</td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox14" id="checkbox14" /></td>
                <td><p class="selectable">Drywall repair to wall pressurization [holes] [cuts]
                        <label><input type="checkbox" name="variant[1][1]" value="1">North</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">South</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">East</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">West</label>
                    </p>
                </td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox15" id="checkbox15" /></td>
                <td>
                    <p class="selectable">Repair Drywall to Walls or Ceiling [holes] [cuts]
                        <label><input type="checkbox" name="variant[1][1]" value="1">North</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">South</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">East</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">West</label></p></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox16" id="checkbox16" /></td>
                <td>
                    <p class="selectable">Repair Tape Seam to Walls or Ceiling [holes] [cuts]
                        <label><input type="checkbox" name="variant[1][1]" value="1">North</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">South</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">East</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">West</label></p></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox17" id="checkbox17" /></td>
                <td>
                    <p class="selectable">Seal Water Stain On Ceiling or Wall [holes] [cuts]
                        <label><input type="checkbox" name="variant[1][1]" value="1">North</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">South</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">East</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">West</label></p></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox18" id="checkbox18" /></td>
                <td><p class="selectable">Texture Ceiling:
                        <label><input type="checkbox" name="variant[1][1]" value="1">Complete</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">To Blend</label>
                        Scrape Back Texture T.F.W.</td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox19" id="checkbox19" /></td>
                <td>Paint Ceiling Complete <br />
                    continuous to
                    <input type="text" />
                    <br />
                    Ceiling Height:
                    <input type="text"  /></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox20" id="checkbox20" /></td>
                <td>Paint Drop Ceiling or Bulkhead Complete Ceiling Height: <input type="text"  /></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox21" id="checkbox21" /></td>
                <td><p class="selectable">Paint Walls Complete or Affected
                    <p class="selectable">Seal Water Stain On Ceiling or Wall [holes] [cuts]
                        <label><input type="checkbox" name="variant[1][1]" value="1">North</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">South</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">East</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">West</label></p></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox22" id="checkbox22" /></td>
                <td><p class="selectable">[S/I new] [Remove] [reinstall] wallcovering (of L.K.Q.) (and report) (T.F.W.)
                    <p class="selectable">Seal Water Stain On Ceiling or Wall [holes] [cuts]
                        <label><input type="checkbox" name="variant[1][1]" value="1">North</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">South</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">East</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">West</label></p></td>
                <td>SF <div class="col-xs-10">
                        <input class="form-control" type="text" name="textfield" id="textfield" />
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox23" id="checkbox23" /></td>
                <td><p class="selectable">Paint / Finish Door to Pre Loss Condition
                        <label><input type="checkbox" name="variant[1][1]" value="1">Entry Door</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Bi-Fold</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Bypass</label>
                        <label><input type="checkbox" name="variant[1][1]" value="1">Pocket</label></p></td>
                <td>EA</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox24" id="checkbox24" /></td>
                <td>Paint / Finish door frame to Pre Loss condition</td>
                <td>EA</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="checkbox25" id="checkbox25" /></td>
                <td>S/I Ceiling Tile (Acoustic) <br />
                    size of tile <input type="text"  /> <br />
                    how many <input type="text"  /></td>
                <td>EA/SQ</td>
                <td>&nbsp;</td>
            </tr>

        </table>

        </p>

    </div>
</div>
<label for="notes">Notes:</label>
<textarea class="form-control">

</textarea>

<button>Save</button>






</div>