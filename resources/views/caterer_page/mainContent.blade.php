<div class="apero-carterer clearfix">

    <h2 class="clearfix">Ihr Warenkorb bei Spitzen-Apero Caterer 
            <img src="images/layer7.png" alt="">
    </h2>

    <div class="lieferdatum carterer-lieferdatum">
            <label>
                    <span>Lieferdatum</span>
                <input type="text" id="datetimepicker4">
            </label>
    </div>

    @for($i=0;$i<2;$i++)
      @include('caterer/items/produkt')
    @endfor

  

    <div class="bestellung-produkts-total">
            Total <span>21.70</span>
    </div>

    <div class="bestellung-bestellen">
            <a href={!! url('bestellen') !!}>Bestellen</a>
    </div>

</div>
