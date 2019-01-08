const adresse = $('#addresses');

class Button {
    constructor(label) {
        $(adresse).append('<li class=\'list\'> </li>');
        const button = $('.list:last-child').append('<button class=\'adresses\'>' + label + '</button>');
        this.label = label;
        console.log(this.label);
        let that = this;
        button.click(function()
        {
            $('#address').val(that.label);
        })
        return this.button;
    }
}

$('#search').click(function()
{
    $('.list').remove();
    let url = 'https://api-adresse.data.gouv.fr/search/?q=' + $('#address').val();
    $.getJSON(url, function(results) {
        results.features.forEach(result => 
        {
            const button = new Button(result.properties.label);
            /*$(button).click(function()
            {
                console.log('test');
                console.log(this.label);
            });*/
        })
    })

})