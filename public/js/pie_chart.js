
var discount = 300; 
var customer, item, operation, location, price;

$.ajax({
    url: URL+"/discounts/paichart",
    dataType: "json",
    type: "GET",
    success: function(data) {
      addPiechart(data.discount, data.item, data.operation, data.customer, data.location);
    },
    error: function(error) {
          console.log(error);
    }
});

function addPiechart(discount, item, operation, customer, location) {

  var chart = AmCharts.makeChart( "chartdiv", {
    "type": "pie",
    "theme": "light",
    "dataProvider": [ {
      "country": "Discount",
      "value": discount
    }, {
      "country": "Customer",
      "value": customer
    }, {
      "country": "Item",
      "value": item
    }, {
      "country": "Operation",
      "value": operation
    }, {
      "country": "Location",
      "value": location
    }, {
      "country": "Price",
      "value": price
    } ],
    "valueField": "value",
    "titleField": "country",
    "outlineAlpha": 0.4,
    "depth3D": 15,
    "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
    "angle": 30,
    "export": {
      "enabled": true
    }
  } );
  jQuery( '.chart-input' ).off().on( 'input change', function() {
    var property = jQuery( this ).data( 'property' );
    var target = chart;
    var value = Number( this.value );
    chart.startDuration = 0;

    if ( property == 'innerRadius' ) {
      value += "%";
    }

    target[ property ] = value;
    chart.validateNow();
  } );

}