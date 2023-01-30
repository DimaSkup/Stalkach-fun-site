{{--
    COMPONENTS:

    checkout and radio buttons,
    check list
--}}


<div class="row-demo">
    <div class="col-demo">
        <b>Checkout</b>
        <label class="s-checkbox">
            <div class="check">
                <input type="checkbox" id="demo-check"/>
                <div class="box"></div>
            </div>
            <div class="s-label">Kyiv</div>
        </label>

        <label class="s-checkbox">
            <div class="check">
                <input type="checkbox" id="demo-check1"/>
                <div class="box"></div>
            </div>
            <div class="s-label">Lviv</div>
        </label>

        <label class="s-checkbox">
            <div class="check">
                <input type="checkbox" id="demo-check2" disabled/>
                <div class="box"></div>
            </div>
            <div class="s-label">Kharkiv</div>
        </label>
    </div>

    <div class="col-demo">
        <b>Radio button</b>
        <label class="s-radio">
            <div class="check">
                <input name="demo-radio" type="radio" id="demo-radio"/>
                <div class="box"></div>
            </div>
            <label class="s-control" for="demo-radio">France</label>
        </label>

        <label class="s-radio">
            <div class="check">
                <input name="demo-radio" type="radio" id="demo-radio1"/>
                <div class="box"></div>
            </div>
            <label class="s-control" for="demo-radio1">Germany</label>
        </label>

        <label class="s-radio">
            <div class="check">
                <input name="demo-radio" type="radio" id="demo-radio2"/>
                <div class="box"></div>
            </div>
            <label class="s-control" for="demo-radio2">Spain</label>
        </label>
    </div>

    <div class="col-demo">
        <b>Check list</b>
        <label class="s-checklist">
            <input type="checkbox" id="demo-checklist2"/>
            <div class="s-checklist__body">
                <div class="check">
                    <div class="box"></div>
                </div>
                <div class="s-label">Nastya</div>
            </div>
        </label>

        <label class="s-checklist">
            <input type="checkbox" id="demo-checklist2"/>
            <div class="s-checklist__body">
                <div class="check">
                    <div class="box"></div>
                </div>
                <div class="s-label">Vera</div>
            </div>
        </label>

        <label class="s-checklist">
            <input type="checkbox" id="demo-checklist2" disabled checked/>
            <div class="s-checklist__body">
                <div class="check">
                    <div class="box"></div>
                </div>
                <div class="s-label">Sasha</div>
            </div>
        </label>
    </div>
</div>