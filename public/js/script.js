class AddressButton {
    constructor(label, long, lat) {
        $('#addresses').append('<li class=\'list\'> </li>');
        const button = $('.list:last-child').append('<button class=\'adresses\'>' + label + '</button>');
        this.label = label;
        this.long = long;
        this.lat = lat;
        let that = this;
        button.click(function(e)
        {
            e.preventDefault();
            $('#address').val(that.label);
            $('#long').val(that.long);
            $('#lat').val(that.lat);
        })
        return this.button;
    }
}

$('#search').click(function(e)
{
    e.preventDefault();
    $('#addresses').empty();
    let url = 'https://api-adresse.data.gouv.fr/search/?q=' + $('#address').val();
    $.getJSON(url, function(results) {
        results.features.forEach(result => 
        {
            const button = new AddressButton(result.properties.label, result.geometry.coordinates[0], result.geometry.coordinates[1]);
        })
    })

})

