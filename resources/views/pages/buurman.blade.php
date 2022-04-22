@extends('layouts.onepager')
@section('content')
    <div class="col-md-12 logo_image">
        <img src="Images/logo.png" width="60%"/>
    </div>
    <div class="col-md-12">
        <div style="width: 80%; background-color:#ffffff; margin-left: auto; margin-right: auto; margin-top:-20px; padding-top:5px; padding-bottom: 66px;">
            <h1>Hand gemaakt, goed gesmaakt!</h1>
        </div>
    </div>
    <div class="col-md-12">
        <div style="width: 80%; background-color:#ffffff; margin-left: auto; margin-right: auto; margin-top:-20px; padding-top:20px;">
            <h1>Menu</h1>
            <p style="max-width:60%;">Alle pizza’s en salades kunnen sporen van noten, gluten en lactose bevatten. Raadpleeg ons personeel bij allergieën!
                Een geheel glutenvrije pizza hebben we helaas nog niet voor u. Maar we zijn u graag van dienst met een spelt pizza. Laat ons dat a.u.b. wel één dag van tevoren weten!
            </p>
        </div>
    </div>
    <div class="col-md-12 menu-list">
        <div style="width: 80%; background-color:#ffffff; margin-left: auto; margin-right: auto; margin-top:-10px; padding-top:10px; padding-bottom:10px; margin-bottom:-10px;">
            <h3 style="margin-right: 54%;">Pizza's</h3>
            <table class="table table-hover" style="max-width:60%; margin-left: auto; margin-right: auto;">
                <tbody>
                    <tr class="menu-card-item">
                        <td width="850">
                            <strong>Truffel Parma</strong>
                            <br>
                            <span class="ingredrients">tomatensaus, buffelmozzarella, Parmaham, huisgemaakte hazelnoot-truffelmayo, kappertjes, pijnboompitten, Parmezaan en rucola.</span>
                        </td>
                        <td width="100"><span class="price">€ 14.50</span></td>
                    </tr>
                    <tr class="menu-card-item">
                        <td width="850">
                            <strong>Hahaham</strong>
                            <br>
                            <span class="ingredrients">crème fraîche, gekruide achterham, kastanje champignons, lente ui, kruidige honing-mosterdsaus, Parmezaan en red chard.</span>
                        </td>
                        <td width="100"><span class="price">€ 14.50</span></td>
                    </tr>
                    <tr class="menu-card-item">
                        <td width="850">
                            <strong>Pizza di Massimo</strong>
                            <br>
                            <span class="ingredrients">witte truffelsaus, pancetta, rode ui, zongedroogde tomaten, pijnboompitten, Parmezaan en red chard.</span>
                        </td>
                        <td width="100"><span class="price">€ 14.50</span></td>
                    </tr>
                    <tr class="menu-card-item">
                        <td width="850">
                            <strong>Spicey Beef</strong><img src="Images/spicy.png" width="16" height="16"/><img src="Images/spicy.png" width="16" height="16"/>
                            <br>
                            <span class="ingredrients">tomatensaus, buffelmozzarella, huis gemarineerde biefstuk reepjes, gegrilde paprika , zongedroogde tomaatjes, jalapeños, chili cheddar, Parmezaan en red chard</span>
                        </td>
                        <td width="100"><span class="price">€ 14.50</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-12">
        <img src="http://buurman-groningen.nl/assets/images/achtergronden/bg-pizza-buurman-grunn-v2.jpg" width="80%"/>
        <div style="background-color:#f5f5f5; width:80%; margin-left: auto; margin-right: auto; margin-top: -20px; text-align:left; padding:20px;"> 
            <h1>Buurman & Buurman Groningen De Rodeweg</h1>
            <h4 style="font-weight: normal;">Wij zijn Koen en Paul, trotse eigenaars van Eetwinkel Buurman & Buurman Groningen. Ja, dat is inderdaad de eetwinkel waar je de lekkerste pizza’s van stad Groningen krijgt. Bij ons draait alles om kwaliteit. Daarom krijg je bij Buurman en Buurman geen telefoongids met honderd verschillende pizza’s. Wij hebben gewoon alleen de lekkersten.</h4>
            <p>Jarenlange ervaring in de horeca heeft ons geleerd wat wel en wat niet lekker, gezellig en goed aanvoelt. Buurman en Buurman is al die kennis bij elkaar en meer. We zijn informeel, persoonlijk en recht voor z'n raap. Ons team - zie hieronder - staat wekelijks van woensdag t/m zondag voor jullie klaar.</p>
            <p>Alles wat we maken is dagvers, huisgemaakt en komt uit een traditionele op houtgestookte steenoven. </p>
            <p>Pizzabakkers genoeg in Groningen. Waarom heeft Buurman & Buurman dan de beste pizza’s? Kom langs, see for yourself and be amazed. :-)</p>
        </div>
        <img src="http://buurman-groningen.nl/assets/images/achtergronden/bg-pizza-buurman-grunn-westend.jpg" width="80%">
    </div>
    <div class="col-md-12">
        <div style="width: 80%; background-color:#ffffff; margin-left: auto; margin-right: auto; margin-top:-20px; padding-top:5px; padding-bottom: 66px;">
            <div class="col-md-6" style="text-align:left;">
                <h1 style="font-weight:lighter;">Rodeweg</h1>
            </div>
            <div class="col-md-6" style="text-align:left;">
                <h1 style="font-weight:lighter;">Westend</h1>
            </div>
        </div>
        <div style="width: 80%; background-color:#ffffff; margin-left: auto; margin-right: auto; margin-top:-20px; padding-top:5px; padding-bottom: 66px;">
            <div class="col-md-3" style="text-align:left;">
                <h4>Adres</h4>
            </div>
            <div class="col-md-3" style="text-align:left;">
                <h4>Telefoonnummer</h4>
            </div>
        </div>
    </div>
@stop