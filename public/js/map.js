var map = 
{
    initMap: function () {
        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 48.866667, lng: 2.333333},
            zoom: 12
        });
    },
}


map.initMap();
$('#panneau').hide();

var Restaurant = {
    name: "",
    marker: null,
    i: 0,
    this: "",
    //la méthode init permet de récupérer et de stocker les infos du restaurant dans l'objet afin de les réutiliser 
    init: function (restaurant) {
        this.id = restaurant[0];
        this.name = restaurant[1];
        this.adresse = restaurant[2];
        this.lng = parseFloat(restaurant[3]);
        this.lat = parseFloat(restaurant[4]);
        this.position = {lat: this.lat, lng: this.lng};
    },
    setMarker: function () {
        this.marker = new google.maps.Marker({position: this.position, map: map});
    },
    clicMarker: function () {
        var that = this;
        this.marker.addListener("click", function () 
        {
            //console.log(that.name);
            $('#restaurantName').text(that.name);
            $('#restaurantPlace').text(that.adresse);
            $('#panneau').show('slow');
            $('#linktopost').attr('href', ('index.php?action=showpost&publicationId=' + that.id));
        })
    }
};

$.getJSON('index.php?action=api', function(results)
{
    results.forEach(result =>
    {
        var restaurant = Object.create(Restaurant);
        restaurant.init(result);
        restaurant.setMarker();
        restaurant.clicMarker();
    })
})