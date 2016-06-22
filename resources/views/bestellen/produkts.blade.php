<div class="col-sm-7 no-padding border-right">

        <div class="lieferdatum carterer-lieferdatum">
                <span class="bestellen-etap">1</span>
                <label>
                        <span>Apero-Bestelliste</span>
                    <input type="text" id="datetimepicker4">
                </label>
        </div>

        @for($i=0;$i<2;$i++)
           @include('bestellen/items/produkt')  
        @endfor

        <div class="bestellung-produkts-total">
                Total <span>21.70</span>
        </div>

        <div class="bestellung-bestellen">
                <a href="#">Bestellen</a>
        </div>

</div>
