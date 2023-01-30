{{--
    COMPONENTS:

    input fields, readonly fields,
    fields with the valid state, fields with the invalid state,
    pagination

--}}


<div class="row-demo">

    {{-- INPUTS --}}
    <div class="col-demo">
        <b>Inputs</b>
        <div class="s-group">
            <label class="s-control" for="test">Username</label>
            <input class="s-control"
                   type="text"
                   name="test"
                   id="test"
                   placeholder="I`m Skiff"
            >
        </div>

        <div class="s-group">
            <label class="s-control" for="city">City</label>
            <select class="s-control"
                    name="city"
                    id="city"
            >
                <option>London</option>
                <option>Berlin</option>
                <option>Kyiv</option>
                <option>Lviv</option>
                <option>Herson</option>
            </select>
        </div>
    </div>


    {{--READONLY--}}
    <div class="col-demo">
        <b>Readonly</b>
        <div class="s-group">
            <label class="s-control" for="test">Username</label>
            <input class="s-control"
                   type="text"
                   name="test"
                   id="test"
                   placeholder="I`m Skiff"
                   readonly
            >
        </div>

        <div class="s-group">
            <label class="s-control" for="city">City</label>
            <select class="s-control"
                    name="city"
                    id="city"
            >
                <option disabled>London</option>
                <option disabled>Berlin</option>
                <option selected>Kyiv</option>
                <option disabled>Lviv</option>
                <option disabled>Herson</option>
            </select>
        </div>
    </div>


    {{-- VALID --}}
    <div class="col-demo">
        <b>Valid</b>
        <div class="s-group">
            <label class="s-control" for="test">Username</label>
            <input class="s-control"
                   type="text"
                   name="test"
                   id="test"
                   placeholder="I`m Skiff"
                   valid
            >
            <span class="s-valid">Success! You’ve done it.</span>
        </div>

        <div class="s-group">
            <label class="s-control" for="city">City</label>
            <select class="s-control"
                    name="city"
                    id="city"
                    valid
            >
                <option>London</option>
                <option>Berlin</option>
                <option>Kyiv</option>
                <option>Lviv</option>
                <option>Herson</option>
            </select>
            <span class="s-valid">Good job, man!</span>
        </div>
    </div>


    {{--INVALID--}}
    <div class="col-demo">
        <b>Invalid</b>
        <div class="s-group">
            <label class="s-control" for="test">Username</label>
            <input class="s-control"
                   type="text"
                   name="test"
                   id="test"
                   placeholder="I`m Skiff"
                   invalid
            >
            <span class="s-invalid">Error! Try again?</span>
        </div>

        <div class="s-group">
            <label class="s-control" for="city">City</label>
            <select class="s-control"
                    name="city"
                    id="city"
                    invalid
            >
                <option>London</option>
                <option>Berlin</option>
                <option>Kyiv</option>
                <option>Lviv</option>
                <option>Herson</option>
            </select>
            <span class="s-invalid">WTF? I hate you!</span>
        </div>
    </div>


    {{-- PAGINATION --}}
    <div class="col-demo">
        <b>Pagination</b>
        <div class="s-group">
            <button class="btn btn-pagination primary">
                1
            </button>
            <button class="btn btn-pagination secondary">
                2
            </button>
            <button class="btn btn-pagination secondary">
                3
            </button>
            <button class="btn btn-pagination secondary">
                4
            </button>
            <button class="btn btn-icon secondary">
                <span class="material-icons">double_arrow</span>
            </button>
        </div>
    </div>
</div>
